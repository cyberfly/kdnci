<?php

defined('BASEPATH') OR exit('No direct script access allowed');


// Ni admin ticket, hati-hati

class Ticket extends Admin_Controller {


	public function __construct()
	{
		parent::__construct();

		$this->load->model('category_model');
		$this->load->model('status_model');
	}


	// senarai tiket

	public function index()
	{
		$data = array();

		// dapatkan data dari table tickets

		$tickets = $this->ticket_model->getAll();

		// pass tickets data to view

		$data['tickets'] = $tickets;

		// dapatkan status dari table statuses

		$statuses = $this->status_model->get_all();

		$data['statuses'] = $statuses;

		// load index.php from folder tickets as content

		$data['content'] = 'admin/tickets/index';

		$this->load->view('templates/simple_backend', $data);
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

	public function printTicketReportWord()
	{
		$this->load->library('ReportWord');

		$tickets = $this->ticket_model->getAll();

		// call reportword library to generate

		$this->reportword->ticketListReport($tickets);
	}

}