<?php
// filepath: c:\xampp\htdocs\elevant_academy\application\models\Campaign_model.php
defined('BASEPATH') or exit('No direct script access allowed');

class Campaign_model extends CI_Model
{
    // Obtener todas las campañas
    public function get_campaigns()
    {
        return $this->db->get('campaigns')->result_array();
    }

    // Obtener campaña por ID
    public function get_campaign_by_id($campaign_id)
    {
        return $this->db->get_where('campaigns', ['id' => $campaign_id])->row_array();
    }

    // Crear una nueva campaña
    public function create_campaign($data)
    {
        if ($this->db->insert('campaigns', $data)) {
            return $this->db->insert_id(); // Retorna el ID de la campaña creada
        } else {
            log_message('error', 'Error al insertar campaña: ' . $this->db->last_query());
            return false;
        }
    }

    // Obtener todos los grupos
    public function get_groups()
    {
        return $this->db->get('email_groups')->result_array();
    }

    // Crear un nuevo grupo con correos
    public function create_group($data)
    {
        return $this->db->insert('email_groups', $data);
    }

    // Procesar archivo CSV o Excel para obtener correos
    public function process_email_file($file_path)
    {
        $emails = [];
        $file_extension = pathinfo($file_path, PATHINFO_EXTENSION);

        if ($file_extension === 'csv') {
            // Leer archivo CSV
            if (($handle = fopen($file_path, 'r')) !== false) {
                while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                    $emails[] = trim($data[0]); // Asume que los correos están en la primera columna
                }
                fclose($handle);
            }
        } elseif (in_array($file_extension, ['xls', 'xlsx'])) {
            // Leer archivo Excel
            $this->load->library('PHPExcel');
            $objPHPExcel = PHPExcel_IOFactory::load($file_path);
            $sheet = $objPHPExcel->getActiveSheet();
            foreach ($sheet->getRowIterator() as $row) {
                $cell = $sheet->getCell('A' . $row->getRowIndex());
                $emails[] = trim($cell->getValue()); // Asume que los correos están en la columna A
            }
        }

        return array_filter($emails); // Filtrar valores vacíos
    }

    // Actualizar un contacto
    public function update_contact($email, $name, $number, $company, $new_group = null)
    {
        // Buscar el grupo actual que contiene el contacto
        $this->db->like('mails', $email);
        $current_group = $this->db->get('email_groups')->row_array();

        if ($current_group) {
            // Decodificar el JSON de los contactos
            $mails = json_decode($current_group['mails'], true);

            // Buscar y eliminar el contacto del grupo actual
            $updated_mails = array_filter($mails, function ($mail) use ($email) {
                return $mail['email'] !== $email;
            });

            // Actualizar el grupo actual con los contactos restantes
            $this->db->where('id', $current_group['id']);
            $this->db->update('email_groups', ['mails' => json_encode(array_values($updated_mails))]);
        }

        // Si se especifica un nuevo grupo, agregar el contacto al nuevo grupo
        if ($new_group) {
            $this->db->where('name', $new_group);
            $target_group = $this->db->get('email_groups')->row_array();

            if ($target_group) {
                $target_mails = json_decode($target_group['mails'], true);
                $target_mails[] = [
                    'name' => $name,
                    'email' => $email,
                    'number' => $number,
                    'company' => $company
                ];

                // Actualizar el nuevo grupo con el contacto agregado
                $this->db->where('id', $target_group['id']);
                return $this->db->update('email_groups', ['mails' => json_encode($target_mails)]);
            }
        }

        return false; // Si no se especifica un nuevo grupo o no se encuentra, devolver false
    }

    // Eliminar un contacto
    public function delete_contact($email)
    {
        // Obtener el grupo que contiene el contacto
        $this->db->like('mails', $email);
        $group = $this->db->get('email_groups')->row_array();

        if ($group) {
            // Decodificar el JSON
            $mails = json_decode($group['mails'], true);

            // Filtrar el contacto a eliminar
            $mails = array_filter($mails, function ($mail) use ($email) {
                return $mail['email'] !== $email;
            });

            // Volver a codificar el JSON y actualizar la base de datos
            $updated_mails = json_encode(array_values($mails)); // Reindexar el array
            $this->db->where('id', $group['id']);
            return $this->db->update('email_groups', ['mails' => $updated_mails]);
        }

        return false; // No se encontró el contacto
    }
 
    // Obtener correos por IDs de grupos
    public function get_emails_by_group_ids($group_ids)
    {
        $this->db->where_in('id', $group_ids);
        $groups = $this->db->get('email_groups')->result_array();

        $emails = [];
        foreach ($groups as $group) {
            $mails = json_decode($group['mails'], true);
            foreach ($mails as $mail) {
                $emails[] = $mail['email'];
            }
        }

        return array_unique($emails); // Eliminar duplicados
    }

    // Enviar correo de campaña
    public function send_campaign_email($campaign_id)
    {
        $this->load->model('Campaign_model');

        // Obtener los datos de la campaña
        $campaign = $this->Campaign_model->get_campaign_by_id($campaign_id);

        // Decodificar los datos dinámicos de la plantilla
        $template_data = json_decode($campaign['template_data'], true);

        // Cargar la plantilla seleccionada
        $email_body = $this->load->view('email/campains/' . $campaign['template'], $template_data, true);

        // Enviar el correo
        $this->load->model('Email_model');
        $this->Email_model->send_smtp_mail($email_body, $campaign['subject'], $campaign['user_email'], $campaign['sender_email']);
    }

    // Verificar si un grupo existe
    public function group_exists($group_id)
    {
        $this->db->where('id', $group_id);
        $query = $this->db->get('email_groups');
        return $query->num_rows() > 0;
    }
}