<?php

class Scanocr extends MY_Controller {

    public function __construct()
	{
		parent::__construct();
	}

    public function create() 
    {
        // load view
        
        $data['content'] = 'scanocr/create';

		$this->load->view('templates/simple_backend', $data);
    }

    public function preview()
    {
        // 1. process upload

        $uploaded_file_data = $this->processUpload();

        // var_dump($uploaded_file_data);

        // 2. dapatkan file path uploaded file

        $file_path = $uploaded_file_data['upload_data']['full_path'];

        var_dump($file_path);

        // 3. gunakan Tesseract untuk extract text dari file tersebut

        // 4. Return extracted text kepada view
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

            var_export($error);    
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            // var_export($data);
            return $data;
        
        }

    }
}