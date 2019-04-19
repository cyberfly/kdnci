<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'vendor/autoload.php';

class Imagemanipulation extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

	public function create()
	{
		$data = array();

		$data['content'] = 'image_manipulations/create';

        $this->load->view('templates/simple_backend', $data);
	}

    public function process()
    {
        $uploaded_file_data = $this->processUpload();

//        var_dump($uploaded_file_data);
//        exit;

        $file_path = $uploaded_file_data['upload_data']['full_path'];

        $file_name = $uploaded_file_data['upload_data']['file_name'];

        // resize and compress uploaded image

        $config['image_library'] = 'gd2';
        $config['source_image'] = $file_path;
//        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;

//        $config['width']         = 75;if ( ! $result)
        {
            var_dump($this->image_lib->display_errors());
            exit;
        }
    else {

        $img_path = base_url() . 'uploads/compress/' .$file_name;

        echo $compressed_file_path;

        echo '<img src="' . $img_path. '" />';
    }
//        $config['height']       = 50;
        $config['quality'] = '10%';

        $compressed_file_path = './uploads/compress/' . $file_name;

        $config['new_image'] = $compressed_file_path;

        $this->load->library('image_lib', $config);

        $result = $this->image_lib->resize();


    }

    public function processUpload()
    {
        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
//        $config['max_size']             = 100;
//        $config['max_width']            = 1024;
//        $config['max_height']           = 768;

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

