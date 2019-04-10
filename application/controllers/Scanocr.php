<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'vendor/autoload.php';

class Scanocr extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{

	}

	// create ticket form

	public function create()
	{
		$this->form_validation->set_rules('subject', 'Subject', 'required');

		// first time load / validation error

		if ($this->form_validation->run() == FALSE)
		{
		    $this->preview();
		}
		else {

            $uploaded_file_path = $this->doUpload();

            $tesseractInstance = new TesseractOCR($uploaded_file_path);

            // Execute tesseract to recognize text

            $scan_text = $tesseractInstance->run();

            $this->preview($scan_text);

		}
		
	}

    public function doUpload()
    {
        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|jpeg|png';

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('scan_file'))
        {
            $error = array('error' => $this->upload->display_errors());

            var_dump($error);
            exit;
        }
        else
        {
            $upload_data = $this->upload->data();

            return $upload_data['full_path'];
        }
    }

    public function preview($scan_text=null)
    {
        $data = array();

        $data['scan_text'] = $scan_text;

        $data['content'] = 'scanocr/create';

        $this->load->view('templates/backend', $data);
    }

}