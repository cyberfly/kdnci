<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();


		// check if user is logged in

		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}
	}

}

// admin controller

class Admin_Controller extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		// check if user in admin group

		$group = array('admin');

		if (!$this->ion_auth->in_group($group))
		{
			echo 'No permission';
			exit;
		}
	}
}