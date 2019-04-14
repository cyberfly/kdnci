<?php

// generate word report

require_once 'vendor/autoload.php';

class ReportWord
{
	public function __construct()
	{
		$this->ci = & get_instance();	
	}

	// write a new Word .docx file

	public function ticketDetailReport()
	{
		$phpWord = new \PhpOffice\PhpWord\PhpWord();

		
		$section = $phpWord->addSection();
		
		$section->addText('Hello PhpOffice');

		// Saving the document as OOXML file...
		$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');

		$objWriter->save('./helloWorld.docx');
	}

	// read and replace string in Word .docx file, and save as new file

	public function ticketListReport($tickets)
	{
		foreach ($tickets as $ticket) {
			
			$ticket_id = $ticket->id;

			$ticket_subject = $ticket->subject;

			$ticket_description = $ticket->description;

			$ticket_created_at = gov_datetime($ticket->created_at);

			$submitted_by = $ticket->email;


			// open existing word file

			$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('./sijiltemplate.docx');

			// search and replace

			$templateProcessor->setValue('{{subject}}', $ticket_subject);
			$templateProcessor->setValue('{{description}}', $ticket_description);
			$templateProcessor->setValue('{{date}}', $ticket_created_at);
			$templateProcessor->setValue('{{submitted_by}}', $submitted_by);


			// save as new file

			$filename = './sijilword/sijil_ticket_' . $ticket_id . '.docx';

			$templateProcessor->saveAs($filename);

		}
	}

    public function writeWord()
    {
        $phpWord = new \PhpOffice\PhpWord\PhpWord();

        $section = $phpWord->addSection(array('pageNumberingStart' => 1));

        // header

        $header = $section->addHeader();
        $header->addWatermark('./uploads/watermark.jpg', array('positioning' => 'relative', 'marginTop' => 1000, 'width'  => 535, 'wrappingStyle' => 'behind'));
        $header->addText('This is my fabulous header!');

        // header image

        $header->addImage('./uploads/logo-mbpj.png',['align'=>'right']);

        // footer

        $footer = $section->addFooter();
//        $footer->addText('Page {PAGE} of {NUMPAGES}.');

        $footer->addPreserveText('Page {PAGE} of {NUMPAGES}.', array('align'=>'center'));

        // paragraph

        $textrun = $section->addTextRun();
        $textrun->addText('Some text. ');
        $textrun->addText('And more Text in this Paragraph.');

        $section->addTextBreak();

        $textrun = $section->addTextRun();

        $textrun->addText('New Paragraph! ', ['bold' => true]);
        $textrun->addText('With text...', ['italic' => true]);

        $lineStyle = array('weight' => 1, 'width' => 100, 'height' => 0, 'color' => 635552);
        $section->addLine($lineStyle);

        // image

        $imageStyle = array(
            'width' => 40,
            'height' => 40,
            'wrappingStyle' => 'square',
            'positioning' => 'absolute',
            'posHorizontalRel' => 'margin',
            'posVerticalRel' => 'line',
        );

        $textrun->addImage('./uploads/posts-table.png', $imageStyle);

        $section->addTextBreak();

        // table

        $rows = 10;
        $cols = 5;

        $section->addText('Basic table', ['name' => 'Times New Roman', 'size' => 16, 'bold' => true]);

        $table = $section->addTable();

        for ($row = 1; $row <= 8; $row++) { $table->addRow();
            for ($cell = 1; $cell <= 5; $cell++) { $table->addCell(1750)->addText("Row {$row}, Cell {$cell}");
            }
        }

        // landscape

        $sectionStyle = array(
            'orientation' => 'landscape',
            'marginTop' => 600,
//            'colsNum' => 2,
        );

        $section = $phpWord->addSection($sectionStyle);

        // link

        $section->addLink('https://google.com', 'Google');

        // page break

        $section->addPageBreak();

        $section->addText('This is new page break content');

        // comment this if we want to save in disk
        $this->download();

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');

        $objWriter->save("php://output");

        // uncomment this if we want to save in disk
//        $objWriter->save('MyDocument.docx');

    }

    public function download()
    {
        $file = 'HelloWorld.docx';

        header("Content-Description: File Transfer");
        header('Content-Disposition: attachment; filename="' . $file . '"');
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Expires: 0');
    }
}


