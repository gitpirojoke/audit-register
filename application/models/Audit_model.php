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

      $data = array(
          'business_id' => $this->getBusiness($this->input->post('business_name')),
          'supervisor_id' => $this->getSupervisor($this->input->post('supervisor_name')) ,
          'start_date' => $this->input->post('start_date'),
          'end_date' => $this->input->post('end_date')
      );
        return $this->db->insert('audit', $data);
    }

    public function getSupervisor($name = FALSE)
    {
      if ($name === FALSE)
      {
          $query = $this->db->get('supervisor');
          return $query->result_array();
      }

      $query = $this->db->select('id')->where('name', $name)->get('supervisor');
      return $query->row('id');

    }

    public function getBusiness($name = FALSE)
    {
        if ($name === FALSE)
        {
            $query = $this->db->get('small_business_entity');
            return $query->result_array();
        }

        $query = $this->db->select('id')->where('name', $name)->get('small_business_entity');
        return $query->row('id');

    }
}