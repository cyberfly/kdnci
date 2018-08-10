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
}


