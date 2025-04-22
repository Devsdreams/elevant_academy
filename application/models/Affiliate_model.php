<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Affiliate_model extends CI_Model {
    public function save_affiliate($data) {
        if (isset($data['registered_manually']) && $data['registered_manually'] == 1) {
            $data['status'] = 'active';
        }
        $this->db->insert('affiliate', $data);
        $affiliate_id = $this->db->insert_id();

        // Generar el enlace de afiliado con el curso seleccionado
        if (isset($data['course_id'])) {
            $this->generate_affiliate_link($affiliate_id, $data['course_id']);
        }
    }

    public function generate_affiliate_link($affiliate_id, $course_id) {
        // Obtener los datos del afiliado
        $affiliate = $this->db->get_where('affiliate', ['affiliate_id' => $affiliate_id])->row_array();
        $full_name = isset($affiliate['full_name']) ? $affiliate['full_name'] : 'user' . $affiliate_id;

        // Formatear el nombre para que sea válido en la URL
        $formatted_name = strtolower(str_replace(' ', '_', $full_name));

        // Obtener los detalles del curso
        $course = $this->db->get_where('course', ['id' => $course_id])->row_array();
        $course_slug = isset($course['title']) ? slugify($course['title']) : 'course';

        // Generar el enlace con el parámetro ?ref=nombre_afiliado
        $generated_url = base_url("home/course/$course_slug/$course_id?ref=$formatted_name");

        // Guardar los datos en la tabla affiliate_link
        $link_data = [
            'affiliate_id' => $affiliate_id,
            'course_id' => $course_id,
            'referral_code' => $formatted_name, // Usar el nombre formateado como código de referencia
            'generated_url' => $generated_url,
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

    public function get_all_affiliates($instructor_id) {
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
        $this->db->join('affiliate_link al', 'a.affiliate_id = al.affiliate_id', 'inner'); // Relación con los enlaces de afiliados
        $this->db->join('course c', 'al.course_id = c.id', 'inner'); // Relación con los cursos
        $this->db->where('c.user_id', $instructor_id); // Filtrar por cursos creados por el instructor logueado
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
}
