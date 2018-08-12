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

		$ticket_status_count = $this->ticket_model->ticketsStatusCount();

		$label_data = array();
		$count_data = array();
		$background_data = array();

		foreach ($ticket_status_count as $status_count) {

			// set label data
			$label_data[] = $status_count->title;

			// set count data

			$count_data[] = $status_count->status_count;
				
		}

		// encode to json before pass to js


		$label_data = json_encode($label_data);
		$count_data = json_encode($count_data);
		$background_data = json_encode($background_data);

		// passkan JS data

		$data['label_data'] = $label_data;	
		$data['count_data'] = $count_data;		
		$data['background_data'] = $background_data;		

		// load page js files

		$data['page_js'] = array('dashboard/index-js');

		// set content page to show

		$data['content'] = 'dashboard/index';	

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
