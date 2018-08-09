<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	
	public function __construct()
	{
		parent::__construct();
	}


	public function index()
	{
		
		// declare empty array
		$data = array();

		// content page file name

		$data['content'] = 'democontent';	

		$this->load->view('templates/backend', $data);
	}

	public function about()
	{
		// declare empty array
		$data = array();

		// content page file name

		$data['content'] = 'about';	

		$this->load->view('templates/backend', $data);
	}
}
