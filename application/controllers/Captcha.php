<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'vendor/autoload.php';

class Captcha extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function create()
    {
        $captcha = generateCaptcha('test_captcha');

        var_dump($captcha);
    }

}