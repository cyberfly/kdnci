<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'vendor/autoload.php';

class Archive extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function create()
    {
        $this->form_validation->set_rules('backup_filename', 'Backup Name', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $table_list = $this->getDatabaseTables();

            $data['table_list'] = $table_list;

            $data['content'] = 'archives/create';

            $this->load->view('templates/simple_backend', $data);
        }
        else {

            $backup_filename = $this->input->post('backup_filename');
            $include_tables = $this->input->post('include_tables');
            $ignore_tables = $this->input->post('ignore_tables');

            $this->backup($backup_filename, $include_tables, $ignore_tables);
        }

    }

    public function getDatabaseTables()
    {
        // get current database name

        $db_name = $this->db->database;

        $show_table_query = $this->db->query("SHOW TABLES from $db_name");

        $table_result = $show_table_query->result_array();

        $table_list = [];

        foreach($table_result as $key => $val) {
            $table_list[] =  $val['Tables_in_' . $db_name];
        }

        return $table_list;
    }

    public function backup($backup_filename, $include_tables, $ignore_tables)
    {
        $this->load->dbutil();

        // Backup your entire database and assign it to a variable

        $sql_filename = $backup_filename .'_' . date('YmdHis') . '.sql';

        $prefs = array(
            'tables'        => $include_tables,
            'ignore'        => $ignore_tables,
            'format'        => 'zip',
            'filename'      => $sql_filename
        );

        $backup = $this->dbutil->backup($prefs);

        $this->load->helper('file');

        // compress backup

        $file_name = $backup_filename . '_' . date('YmdHis') . '.zip';

        write_file('./backups/' . $file_name, $backup);

        $this->load->helper('download');

        force_download($file_name, $backup);

    }
}