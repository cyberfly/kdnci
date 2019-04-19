<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'vendor/autoload.php';

class Learnphpexcel extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function create()
    {
        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setTitle('Sheet pertama');

        // set table header

        $sheet->setCellValue('A1', 'Id');
        $sheet->setCellValue('B1', 'Title');
        $sheet->setCellValue('C1', 'Description');

        // set table header style

        $header = 'a1:c1';

        $sheet
            ->getStyle($header)
            ->getFill()
            ->setFillType('solid')
            ->getStartColor()
            ->setARGB('00ffff00');

        // set bold header

        $style = [
            'font' => ['bold' => true],
            'alignment' => ['horizontal' => 2]
        ];

        $sheet
            ->getStyle($header)
            ->applyFromArray($style);

        // set table row

        $sheet->setCellValue('A2', '1');
        $sheet->setCellValue('B2', 'Lorem');
        $sheet->setCellValue('C2', 'Ipsum is lorem');

        $sheet->setCellValue('A3', '2');
        $sheet->setCellValue('B3', 'Where is the book?');
        $sheet->setCellValue('C3', 'There is no description');

        // set column formula
        $sheet->setCellValue('A4', '=(A2+A3)');

        // set column width

        // auto width
        $sheet->getColumnDimension('B')->setAutoSize(true);

        // fix width
        $sheet->getColumnDimension('C')->setWidth(35);

        // add new sheet

        $my_new_sheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'My New Worksheet');

        $spreadsheet->addSheet($my_new_sheet, 0);

        // write excel

        $filename = 'test.xlsx';

        $this->download($spreadsheet, $filename);

//        $writer->save('hello-excel.xlsx');
    }

    public function download($spreadsheet, $filename)
    {
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

}