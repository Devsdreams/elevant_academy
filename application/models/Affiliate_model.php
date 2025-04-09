<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Affiliate_model extends CI_Model {
    public function save_affiliate($data) {
        if (isset($data['registered_manually']) && $data['registered_manually'] == 1) {
            $data['status'] = 'active';
        }
        $this->db->insert('affiliate', $data);
        $affiliate_id = $this->db->insert_id();

        // Generar un enlace de afiliado para un curso de ejemplo
        $this->generate_affiliate_link($affiliate_id, 1); // 1 es un ID de curso de ejemplo
    }

    public function generate_affiliate_link($affiliate_id, $course_id) {
        // Obtener el nombre completo del afiliado
        $affiliate = $this->db->get_where('affiliate', ['affiliate_id' => $affiliate_id])->row_array();
        $full_name = isset($affiliate['full_name']) ? $affiliate['full_name'] : 'user' . $affiliate_id;
    
        // Formatear el nombre para que sea válido en la URL
        $formatted_name = strtolower(str_replace(' ', '_', $full_name));
    
        // Generar el enlace con el parámetro ?ref=usuario123
        $generated_url = base_url("course/$course_id?ref=$formatted_name");
    
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

    public function get_all_affiliates() {
        $this->db->select('*');
        $this->db->from('affiliate');
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
}
