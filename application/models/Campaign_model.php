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
    public function update_contact($email, $name, $number, $company)
    {
        // Buscar el grupo que contiene el contacto
        $this->db->like('mails', $email);
        $group = $this->db->get('email_groups')->row_array();

        if ($group) {
            // Decodificar el JSON de los contactos
            $mails = json_decode($group['mails'], true);

            // Buscar y actualizar el contacto
            foreach ($mails as &$mail) {
                if ($mail['email'] === $email) {
                    $mail['name'] = $name;
                    $mail['number'] = $number;
                    $mail['company'] = $company;
                    break;
                }
            }

            // Codificar el JSON actualizado y guardar en la base de datos
            $updated_mails = json_encode($mails);
            $this->db->where('id', $group['id']);
            return $this->db->update('email_groups', ['mails' => $updated_mails]);
        }

        return false; // No se encontró el contacto
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
}