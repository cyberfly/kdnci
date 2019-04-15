<?php

require_once 'vendor/autoload.php';

use thiagoalessio\TesseractOCR\TesseractOCR;

class Scanocr extends MY_Controller {

    public function __construct()
	{
		parent::__construct();
	}

    public function create($ocr_content=null) 
    {
        // pass data

        $data['ocr_content'] = $ocr_content;
        
        // load view
        
        $data['content'] = 'scanocr/create';

        // load JS

        $data['page_js'] = array('scanocr/create-js');

		$this->load->view('templates/simple_backend', $data);
    }

    public function process() {

        $action = $this->input->post('action');

        if ($action === 'preview') {
            $this->preview();
        }
        else {
            $this->store();
        }
    }

    public function store() 
    {
        $title = $this->input->post('title');
        $content = $this->input->post('content');
        $summary = $this->input->post('summary');

        var_dump($title);
        var_dump($content);
        var_dump($summary);

        // insert ke database
    }

    public function preview()
    {
        // 1. process upload

        $uploaded_file_data = $this->processUpload();

        // var_dump($uploaded_file_data);

        // 2. dapatkan file path uploaded file

        $file_path = $uploaded_file_data['upload_data']['full_path'];

        // 3. gunakan Tesseract untuk extract text dari file tersebut

        $tesseract = new TesseractOCR($file_path);

        $scan_text = $tesseract->run();

        // 4. Return extracted text kepada view

        $this->create($scan_text);
    }

    public function processUpload()
    {
        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 100;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('file'))
        {
            $error = array('error' => $this->upload->display_errors());

            var_dump($error);
            exit;    
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            
            return $data;
        
        }

    }
}