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

		// load index.php from folder tickets as content

		$data['content'] = 'tickets/index';

		$this->load->view('templates/backend', $data);
	}

	// create ticket form

	public function create()
	{
		
		$this->form_validation->set_rules('subject', 'Subject', 'required');
		$this->form_validation->set_rules('category_id', 'Category', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');

		$this->form_validation->set_message('required', 'Sila masukkan medan {field}');


		// jika first time load atau validation error, paparkan page

		if ($this->form_validation->run() == FALSE)
		{
			$data = array();

			// get categories data from category model

			$categories = $this->category_model->getAll();

			// pass categories data to view

			$data['categories'] = $categories;

			// load index.php from folder tickets as content

			$data['content'] = 'tickets/create';

			$this->load->view('templates/backend', $data);
		}
		else {

			// jika berjaya validation, process form

			// get open status

			$open_status = $this->status_model->getStatusByTitle('Open');

			$ticket_data = array(
				'subject' => $this->input->post('subject'),
				'description' => $this->input->post('description'),
				'category_id' => $this->input->post('category_id'),
				'user_id' => current_user_id(),
				'status_id' => $open_status->id,
				'created_at' => date('Y-m-d H:i:s'),
			);

			
			$this->ticket_model->insert($ticket_data);

			// set success message

			$this->session->set_flashdata('success', 'Your ticket has been submitted');


			redirect('ticket/index');

		}
		
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