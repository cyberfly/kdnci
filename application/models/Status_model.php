<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Status_model extends CI_Model {

	public function getStatusByTitle($title)
	{
		$this->db->where('title', $title);

		$query = $this->db->get('statuses');

		return $query->row();
	}

	public function getAll()
	{
		$query = $this->db->get('statuses');

		return $query->result();
	}
}