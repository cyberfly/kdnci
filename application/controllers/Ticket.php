<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket extends CI_Controller {


	public function __construct()
	{
		parent::__construct();

		// check if user is logged in

		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}

		$this->load->model('category_model');
	}


	// senarai tiket

	public function index()
	{
		$data = array();

		// dapatkan data dari table tickets

		$tickets = $this->ticket_model->getAll();

		// pass tickets data to view

		$data['tickets'] = $tickets;

		// load index.php from folder tickets as content

		$data['content'] = 'tickets/index';

		$this->load->view('templates/backend', $data);
	}

	// create ticket form

	public function create()
	{
		
	}

	// edit ticket form

	public function edit()
	{

	}

	// show ticket details

	public function show()
	{

	}

	// delete ticket

	public function delete()
	{

	}

}