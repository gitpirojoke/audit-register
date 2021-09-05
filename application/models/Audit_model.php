<?php

class Audit_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

  public function getAudit($id = FALSE)
  {
      if ($id === FALSE)
      {
          $this->db->select('audit.*, small_business_entity.name as business_name, supervisor.name as supervisor_name');
          $this->db->from('audit');
          $this->db->join('small_business_entity','business_id = small_business_entity.id');
          $this->db->join('supervisor', 'supervisor_id = supervisor.id');
          $query = $this->db->get();
          return $query->result_array();
      }
      else
      {
          $query = $this->db->get_where('audit', array('id' => $id));
          return $query->row_array();
      }
  }

  public function setAudit()
  {
      $this->load->helper('url');

  }
}