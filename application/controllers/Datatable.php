<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Datatable extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	// senarai tiket

	public function index()
	{
		$data = array();

		$data['content'] = 'datatables/index';

        // load page js files

        $data['page_js'] = array('datatables/index-js');

		$this->load->view('templates/simple_backend', $data);
	}

    function getProducts()
    {

        $this->datatables->select('product_id, product_code, product_title, product_price, categories.title as category_title');
        $this->datatables->from('products');
        $this->datatables->join('categories', 'categories.id = products.category_id');
        $this->datatables->add_column('view', edit_action('admin/posts/edit/$1') . ' ' . delete_action('$1'), "product_id, product_title");

        echo $this->datatables->generate();
    }
}