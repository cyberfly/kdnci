<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'vendor/autoload.php';

class Category extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
		$data = array();

        $search_params = $this->input->get();

        $categories = $this->category_model->search($search_params);

        $data['categories'] = $categories;

		$data['content'] = 'categories/index';

		$this->load->view('templates/simple_backend', $data);
	}

    public function edit()
    {
        // get category id from url

        $category_id = $this->uri->segment(3, 0);

        $data['content'] = 'categories/edit';

        $this->load->view('templates/simple_backend', $data);
    }
}