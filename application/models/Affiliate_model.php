<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Affiliate_model extends CI_Model {
    public function save_affiliate($data) {
        // Verificar si ya existe un registro con el mismo correo
        $existing_affiliate = $this->db->get_where('affiliate', ['email' => $data['email']])->row_array();

        if ($existing_affiliate) {
            // Reutilizar el unique_code del afiliado existente
            $affiliate_id = $existing_affiliate['affiliate_id'];
            $data['unique_code'] = $existing_affiliate['unique_code'];
        } else {
            // Crear un nuevo registro de afiliado
            $affiliate_data = [
                'full_name' => $data['full_name'],
                'email' => $data['email'],
                'unique_code' => substr(md5(uniqid(rand(), true)), 0, 6),
                'status' => 'active',
                'registration_date' => date('Y-m-d H:i:s'),
                'payment_method' => $data['payment_method'],
                'payment_identifier' => $data['payment_identifier'],
                'custom_commission' => $data['custom_commission'],
                'link_count' => 0 // Inicializar el contador de enlaces
            ];

            $this->db->insert('affiliate', $affiliate_data);
            $affiliate_id = $this->db->insert_id();
        }

        // Verificar si ya existe un enlace para el mismo curso y afiliado
        $existing_link = $this->db->get_where('affiliate_link', [
            'affiliate_id' => $affiliate_id,
            'course_id' => $data['course_id']
        ])->row_array();

        if ($existing_link) {
            // Si ya existe un enlace para este curso, no se crea uno nuevo
            throw new Exception('El afiliado ya tiene un enlace para este curso.');
        }

        // Generar el enlace de afiliado para el curso
        $this->generate_affiliate_link($affiliate_id, $data['course_id']);

        // Incrementar el contador de enlaces
        $this->db->where('affiliate_id', $affiliate_id);
        $this->db->set('link_count', 'link_count + 1', FALSE);
        $this->db->update('affiliate');
    }

    public function generate_affiliate_link($affiliate_id, $course_id) {
        // Obtener los datos del afiliado
        $affiliate = $this->db->get_where('affiliate', ['affiliate_id' => $affiliate_id])->row_array();
        $base_referral_code = strtolower(str_replace(' ', '_', $affiliate['full_name']));

        // Generar un referral_code único basado en el curso
        $referral_code = $base_referral_code . '_' . $course_id;
        $counter = 1;

        // Validar solo la parte base del código (antes del guion bajo y número)
        while ($this->db->where('referral_code', $referral_code)->get('affiliate_link')->num_rows() > 0) {
            $referral_code = $base_referral_code . '_' . $course_id . '_' . $counter;
            $counter++;
        }

        // Obtener los detalles del curso
        $course = $this->db->get_where('course', ['id' => $course_id])->row_array();
        $course_slug = isset($course['title']) ? slugify($course['title']) : 'course';

        // Generar el enlace ignorando el sufijo numérico
        $clean_referral_code = explode('_', $referral_code)[0]; // Solo toma la parte base del código
        $generated_url = base_url("home/course/$course_slug/$course_id?ref=$clean_referral_code");

        // Guardar los datos en la tabla affiliate_link
        $link_data = [
            'affiliate_id' => $affiliate_id,
            'course_id' => $course_id,
            'referral_code' => $referral_code, // Se guarda completo en la base de datos
            'generated_url' => $generated_url, // El enlace ignora el sufijo numérico
            'creation_date' => date('Y-m-d H:i:s'),
            'status' => 'active'
        ];

        $this->db->insert('affiliate_link', $link_data);
    }

    public function approve_affiliate_with_course() {
        $affiliate_id = $this->input->post('affiliate_id');
        $course_id = $this->input->post('course_id');
    
        // Generar el enlace de afiliado
        $this->load->model('Affiliate_model');
        $this->Affiliate_model->generate_affiliate_link($affiliate_id, $course_id);
    
        // Actualizar el estado del afiliado a 'active'
        $this->Affiliate_model->update_affiliate_status($affiliate_id, 'active');
    
        $this->session->set_flashdata('flash_message', get_phrase('affiliate_approved_successfully'));
        redirect(site_url('user/affiliates_approval'));
    }

    public function get_pending_affiliates() {
        $this->db->select('*');
        $this->db->from('affiliate');
        $this->db->where('status', 'inactive');
        return $this->db->get()->result_array();
    }

    public function get_all_affiliates($instructor_id = null) {
        $this->db->select('
            a.affiliate_id,
            a.full_name,
            a.email,
            a.unique_code,
            a.status,
            al.generated_url,
            c.title as course_name
        ');
        $this->db->from('affiliate a');
        $this->db->join('affiliate_link al', 'a.affiliate_id = al.affiliate_id', 'inner'); // Relación con los enlaces de afiliados
        $this->db->join('course c', 'al.course_id = c.id', 'inner'); // Relación con los cursos
        if ($instructor_id !== null) {
            $this->db->where('c.user_id', $instructor_id); // Filtrar por cursos creados por el instructor logueado
        }
        $this->db->group_by('a.affiliate_id'); // Agrupar por afiliado
        return $this->db->get()->result_array();
    }

    public function get_all_affiliates_no_filter() {
        $this->db->select('
            a.affiliate_id,
            a.full_name,
            a.email,
            a.unique_code,
            a.status,
            al.generated_url,
            c.title as course_title
        ');
        $this->db->from('affiliate a');
        $this->db->join('affiliate_link al', 'a.affiliate_id = al.affiliate_id', 'left'); // Relación con los enlaces de afiliados
        $this->db->join('course c', 'al.course_id = c.id', 'left'); // Relación con los cursos
        $this->db->group_by('a.affiliate_id'); // Agrupar por afiliado
        return $this->db->get()->result_array();
    }

    public function get_all_courses() {
        $this->db->select('id, title');
        $this->db->from('courses');
        $this->db->where('status', 'active'); // Opcional: solo cursos activos
        return $this->db->get()->result_array();
    }

    public function get_all_courses_by_instructor($instructor_id) {
        $this->db->select('id, title');
        $this->db->from('courses');
        $this->db->where('user_id', $instructor_id);
        $this->db->where('status', 'active'); // Opcional: solo cursos activos
        return $this->db->get()->result_array();
    }

    public function update_affiliate_status($affiliate_id, $status) {
        $this->db->where('affiliate_id', $affiliate_id);
        $this->db->update('affiliate', ['status' => $status]);

        // Generar el enlace de afiliado si el estado es 'active'
        if ($status === 'active') {
            $this->generate_affiliate_link_if_not_exists($affiliate_id);
        }
    }

    private function generate_affiliate_link_if_not_exists($affiliate_id) {
        // Verificar si ya existe un enlace para este afiliado
        $existing_link = $this->db->get_where('affiliate_link', ['affiliate_id' => $affiliate_id])->row_array();
        if (!$existing_link) {
            // Generar un enlace para un curso de ejemplo
            $course_id = 1; // ID de curso de ejemplo
            $referral_code = uniqid('ref_');
            $generated_url = base_url("course/$course_id?ref=$referral_code");

            $link_data = [
                'affiliate_id' => $affiliate_id,
                'course_id' => $course_id,
                'referral_code' => $referral_code,
                'generated_url' => $generated_url,
                'status' => 'active'
            ];

            $this->db->insert('affiliate_link', $link_data);
        }
    }

    public function delete_affiliate($affiliate_id) {
        // Eliminar el afiliado de la base de datos
        $this->db->where('affiliate_id', $affiliate_id);
        $this->db->delete('affiliate');
    
        // También eliminar el enlace de afiliado asociado, si existe
        $this->db->where('affiliate_id', $affiliate_id);
        $this->db->delete('affiliate_link');
    
        // Responder con un mensaje de éxito
        echo json_encode(['status' => 'success', 'message' => get_phrase('affiliate_deleted_successfully')]);
    }

    public function get_affiliates_with_data($instructor_id) {
        $this->db->select('a.full_name, a.email, c.title as course_title, COUNT(cl.click_id) as clicks, 
                           SUM(cl.converted) as leads, COUNT(p.id) as sales, SUM(p.instructor_revenue) as commission');
        $this->db->from('affiliate a');
        $this->db->join('affiliate_link al', 'a.affiliate_id = al.affiliate_id', 'left');
        $this->db->join('click cl', 'al.link_id = cl.link_id', 'left');
        $this->db->join('payment p', 'al.course_id = p.course_id AND cl.affiliate_id = p.affiliate_id', 'left');
        $this->db->join('course c', 'al.course_id = c.id', 'left');
        $this->db->where('c.user_id', $instructor_id);
        $this->db->group_by('a.affiliate_id');
        return $this->db->get()->result_array();
    }

    public function get_affiliate_data($email) {
        return $this->db->get_where('affiliate', ['email' => $email, 'status' => 'active'])->row_array();
    }

    public function get_all_affiliates_list() {
        return $this->db->get('affiliate')->result_array();
    }

    public function get_affiliate_with_links($email) {
        $this->db->select('a.*, al.link_id, al.course_id, al.referral_code, al.generated_url, al.creation_date, al.status as link_status');
        $this->db->from('affiliate a');
        $this->db->join('affiliate_link al', 'a.affiliate_id = al.affiliate_id', 'left');
        $this->db->where('a.email', $email);
        return $this->db->get()->result_array();
    }

    public function get_affiliate_dashboard_data($email) {
        $this->db->select('
            a.affiliate_id,
            a.full_name,
            a.email,
            a.custom_commission,
            al.link_id,
            al.course_id,
            al.referral_code,
            al.generated_url,
            al.creation_date,
            al.status as link_status,
            c.title as course_title,
            COUNT(DISTINCT cl.click_id) as total_clicks,
            COUNT(DISTINCT cv.conversion_id) as total_conversions,
            SUM(cv.total_amount) as total_sales
        ');
        $this->db->from('affiliate a');
        $this->db->join('affiliate_link al', 'a.affiliate_id = al.affiliate_id', 'left');
        $this->db->join('course c', 'al.course_id = c.id', 'left');
        $this->db->join('click cl', 'al.link_id = cl.link_id', 'left');
        $this->db->join('conversion cv', 'al.link_id = cv.link_id', 'left');
        $this->db->where('a.email', $email);
        $this->db->group_by('al.link_id');
        return $this->db->get()->result_array();
    }

    public function get_affiliates_with_links() {
        $this->db->select('a.*, COUNT(al.link_id) as link_count');
        $this->db->from('affiliate a');
        $this->db->join('affiliate_link al', 'a.affiliate_id = al.affiliate_id', 'left');
        $this->db->group_by('a.affiliate_id');
        return $this->db->get()->result_array();
    }

    public function get_links_by_affiliate_id($affiliate_id) {
        $this->db->select('al.referral_code, al.generated_url, c.title as course_title');
        $this->db->from('affiliate_link al');
        $this->db->join('course c', 'al.course_id = c.id', 'left');
        $this->db->where('al.affiliate_id', $affiliate_id);
        return $this->db->get()->result_array();
    }
}
