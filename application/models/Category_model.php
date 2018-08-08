<?php

class Category_model extends CI_Model {

	public function getAll()
	{
		$query = $this->db->get('categories');

		return $query->result();
	}
}