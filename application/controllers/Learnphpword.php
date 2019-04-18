<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'vendor/autoload.php';

class Learnphpword extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function create()
    {
        $phpWord = new \PhpOffice\PhpWord\PhpWord();

        $section = $phpWord->addSection();

        // set header

        $header = $section->addHeader();

//        $header->addText('This is header');

        // set watermark

        $watermark_config = [
            'positioning' => 'relative',
            'marginTop' => 1300,
            'width' => 200,
            'wrappingStyle' => 'behind'
        ];

        $header->addWatermark('./assets/images/jata-negara.png', $watermark_config);

        // set footer

        $footer = $section->addFooter();

//        $footer->addText('This is footer');
        $footer->addPreserveText('Page {PAGE} of {NUMPAGES}.', null, ['align' => 'center']);

        // add paragraph

        $textrun = $section->addTextRun();

        $textrun->addText('Hello ', ['italic' => true]);

        $textrun->addText('Word', ['bold' => true]);

        $section->addText('hello WORD!');

        // add empty space
        $section->addTextBreak(10);

        $section->addText('hello WORDF!');

        // page break

        $section->addPageBreak();

        $section->addText('hello WORDFG!');

        $section->addText('hello WORDFGH!');

        // hyperlink

        $section->addLink('https://google.com', 'Google', ['underline' => 'single']);

        $filename = 'helloworld.docx';

        // image

        $image_config = [
          'width' => 100,
          'height' => 100,
        ];

        $section->addImage('./uploads/test-ocr1.jpeg', $image_config);

        // simple table

        $table = $section->addTable();

        for ($row = 1; $row <= 8; $row++) {
            $table->addRow();

            for ($cell = 1; $cell <= 5; $cell++) {
                $table->addCell(1750)->addText("Row {$row}, Cell {$cell}");
            }
        }

        // new page for dynamic table

        $section->addPageBreak();

        $section->addTextBreak(20);

        // dynamic table style

        $fancyTableStyleName = 'Fancy Table';
        $fancyTableStyle = array('borderSize' => 6, 'borderColor' => '006699', 'cellMargin' => 80, 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER, 'cellSpacing' => 50);
        $fancyTableFirstRowStyle = array('borderBottomSize' => 18, 'borderBottomColor' => '0000FF', 'bgColor' => '66BBFF');
        $fancyTableCellStyle = array('valign' => 'center');
        $fancyTableCellBtlrStyle = array('valign' => 'center', 'textDirection' => \PhpOffice\PhpWord\Style\Cell::TEXT_DIR_BTLR);
        $fancyTableFontStyle = array('bold' => true);
        $phpWord->addTableStyle($fancyTableStyleName, $fancyTableStyle, $fancyTableFirstRowStyle);

        // dynamic table data

        $this->load->model('category_model');

        $categories = $this->category_model->get_all();

        // create table

        $table = $section->addTable($fancyTableStyleName);

        // create table head row

        $table->addRow();

        // create table head column

        $table->addCell(2000)->addText('id');
        $table->addCell(2000)->addText('title');
        $table->addCell(2000)->addText('description');

        // create table body column

        foreach ($categories as $category) {
            $table->addRow();

            $table->addCell(2000, $fancyTableCellStyle)->addText($category->id, $fancyTableFontStyle);
            $table->addCell(2000, $fancyTableCellStyle)->addText($category->title, $fancyTableFontStyle);
            $table->addCell(2000, $fancyTableCellStyle)->addText($category->description, $fancyTableFontStyle);
        }

        // set header for download

        $this->downloadWord($filename);

        // Saving the document as OOXML file...
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');

        //        $objWriter->save($filename);
        $objWriter->save("php://output");
    }

    public function downloadWord($filename)
    {
        header("Content-Description: File Transfer");
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Expires: 0');
    }

}