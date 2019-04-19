<?php

class Category_model extends MY_Model {

	public $table = 'categories';

    public function search($search_params)
    {
//        var_dump($search_params);
//        exit;
        $this->db->select('*');

        $this->db->from($this->table);

        // apply search by keyword only if user search

        if (isset($search_params['search']) && !empty($search_params['search'])) {

            $search_keyword = $search_params['search'];

            // specify on which table column to search

            $this->db->like('title', $search_keyword);
            $this->db->or_like('description', $search_keyword);
        }

        $query = $this->db->get();

        return $query->result();
    }
}