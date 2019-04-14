<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Learnphpword extends MY_Controller {

	public function __construct()
	{
		parent::__construct();

        $this->load->library('ReportWord');
	}

	// create ticket form

	public function create()
	{
        $this->reportword->writeWord();
	}

}