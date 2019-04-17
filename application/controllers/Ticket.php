<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'vendor/autoload.php';

class Ticket extends MY_Controller {


	public function __construct()
	{
		parent::__construct();

		$this->load->model('category_model');
		$this->load->model('status_model');
		$this->load->library('notification');
	}


	// senarai tiket

	public function index()
	{
		$data = array();

		// dapatkan data dari table tickets

		$user_id = current_user_id();

		$tickets = $this->ticket_model->getUserTickets($user_id);

		// pass tickets data to view

		$data['tickets'] = $tickets;

		// load index.php from folder tickets as content

		$data['content'] = 'tickets/index';

		// load JS

		$data['page_js'] = array('tickets/index-js');

		$this->load->view('templates/simple_backend', $data);
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

			$categories = $this->category_model->get_all();

			// pass categories data to view

			$data['categories'] = $categories;

			// load index.php from folder tickets as content

			$data['content'] = 'tickets/create';

			$this->load->view('templates/simple_backend', $data);
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

			// send email notification

			$this->notification->newTicketNotification($ticket_data);

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
		$this->load->library('ReportWord');

		$this->reportword->ticketDetailReport();
	}

	// delete ticket

	public function delete()
	{
	    $ticket_id = $this->input->post('ticket_id');

	    // delete from db

	    $this->ticket_model->delete($ticket_id);

	    echo 'success';
	}

	// generate dummy tickets for development

	public function generateTickets()
	{
		// load Faker

		$faker = Faker\Factory::create();

		for($i=0; $i<4000; $i++) {

			// get open status

			$open_status = $this->status_model->getStatusByTitle('Open');

			// dummy categories id

			$categories_id = array(1, 2, 3, 4);

			$category_id = $categories_id[array_rand($categories_id)];

			$ticket_data = array(
				'subject' => $faker->word,
				'description' => $faker->text,
				'category_id' => $category_id,
				'user_id' => current_user_id(),
				'status_id' => $open_status->id,
				'created_at' => date('Y-m-d H:i:s'),
			);

			
			$this->ticket_model->insert($ticket_data);

		}		
		
		echo 'siap';

	}

	public function datatableIndex()
	{

		// load index.php from folder tickets as content

		$data['content'] = 'tickets/datatable-index';

		// load JS

		$data['page_js'] = array('tickets/datatable-index-js');

		$this->load->view('templates/simple_backend', $data);

	}

	public function getTicketsDatatable()
	{

		$this->datatables->select('tickets.id, tickets.subject, tickets.description, ticket_categories.ticket_category_name');

		$this->datatables->from('tickets');

		$this->datatables->join('ticket_categories', 'ticket_categories.ticket_category_id = tickets.category_id');

		$this->datatables->add_column('edit', edit_button('ticket/edit/$1') . ' '. delete_button('$1', '$2'), 'id, subject');

		echo $this->datatables->generate();

	}

}