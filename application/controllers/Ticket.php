<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket extends CI_Controller {

	// senarai tiket

	public function index()
	{
		$data = array();

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