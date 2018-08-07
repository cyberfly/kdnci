<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket_model extends CI_Model {

	public function getAll()
	{
		$this->db->select('tickets.id, tickets.subject, tickets.description, tickets.status_id, tickets.category_id, tickets.created_at, categories.title as category_title, statuses.title as status_title');

		$this->db->from('tickets');

		// join kat sini

		$this->db->join('categories', 'categories.id = tickets.category_id', 'left');

		$this->db->join('statuses', 'statuses.id = tickets.status_id', 'left');

		$query = $this->db->get();

		// $query = $this->db->get('tickets');

		return $query->result();
	}

}