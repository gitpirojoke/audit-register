<?php

class Audit_model extends CI_Model {

    public function __construct()
    {
		parent::__construct();
        $this->load->database();
    }

	/**
	 * @param int|null $id
	 * @return array|array[]|null
	 */
    public function getAudit(int $id = null):array
    {
      if ($id === null)
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

	/**
	 * Проверяет и вносит данный для новой проверки
	 * @return bool
	 */
    public function setAudit():bool
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

	/**
	 * Возвращает массив проверяющих либо id если задано имя
	 * @param string|null $name
	 * @return array|array[]|mixed|object|null
	 */
    public function getSupervisor(string $name = null)
    {
      if ($name === null)
      {
          $query = $this->db->get('supervisor');
          return $query->result_array();
      }

      $query = $this->db->select('id')->where('name', $name)->get('supervisor');
      return $query->row('id');

    }

	/**
	 * Возвращает массив СМП либо id если задано имя
	 * @param null $name
	 * @return array|array[]|mixed|object|null
	 */
    public function getBusiness($name = null)
    {
        if ($name === null)
        {
            $query = $this->db->get('small_business_entity');
            return $query->result_array();
        }

        $query = $this->db->select('id')->where('name', $name)->get('small_business_entity');
        return $query->row('id');

    }
}
