<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'vendor/autoload.php';

class Learnphpexcel extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function create()
	{
        $spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        // set sheet title

        $sheet->setTitle('Data');

        // set column value

        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'PRODUCT CODE');

        // set column style

        $header = 'a1:b1';

        $sheet->getStyle($header)->getFill()->setFillType('solid')->getStartColor()->setARGB('00ffff00');

        $style = array(
            'font' => array('bold' => true,),
            'alignment' => array('horizontal' => 2,),
        );

        $sheet->getStyle($header)->applyFromArray($style);

        // set column width

        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setWidth(15);

        // set another worksheet

        $myWorkSheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'My Data');

        // Attach the "My Data" worksheet as the first worksheet in the Spreadsheet object
        $spreadsheet->addSheet($myWorkSheet, 0);

        // write the excel file
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="myfile.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');

//        $writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
//        $writer->save('helloworld.xlsx');
	}

}