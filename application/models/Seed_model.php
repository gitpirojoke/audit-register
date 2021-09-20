<?php

/**
 * Модель для первичного заполнения таблиц
 */
class Seed_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
    }

    /**
     * Заполняет таблицу набором данных
     * @param string $table
     * @param array $data
     * @return false|int
     */
    public function seedData(string $table, array $data)
    {
        return $this->db->insert_batch($table ,$data);
    }
}


