<?php

class Seed_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
    }

    public function seedData(string $table, array $data)
    {
        return $this->db->insert_batch($table ,$data);
    }
}


