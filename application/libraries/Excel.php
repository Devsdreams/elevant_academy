<?php
require_once APPPATH . '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Excel
{
    public function createSpreadsheet()
    {
        return new Spreadsheet();
    }

    public function createWriter($spreadsheet, $format = 'Xlsx')
    {
        if ($format === 'Xlsx') {
            return new Xlsx($spreadsheet);
        }
        // Puedes agregar otros formatos si es necesario
    }

    public function loadSpreadsheet($filePath)
    {
        return IOFactory::load($filePath);
    }
}