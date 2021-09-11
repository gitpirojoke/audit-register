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
        $this->db->select('audit.*, small_business_entity.name as business_name, supervisor.name as supervisor_name');
        $this->db->from('audit');
        if ($id === null)
      {
          $this->db->join('small_business_entity','business_id = small_business_entity.id');
          $this->db->join('supervisor', 'supervisor_id = supervisor.id');
          $query = $this->db->get();
          return $query->result_array();
      }
      else
      {
          $this->db->where('audit.id',$id);
		  $this->db->join('small_business_entity','business_id = small_business_entity.id');
		  $this->db->join('supervisor', 'supervisor_id = supervisor.id');
		  $query = $this->db->get();
          return $query->row_array();
      }
    }

	/**
	 * Проверяет и вносит данные для новой проверки
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
	 * @param int $id
	 * @return bool
	 */
    public function updateAudit(int $id):bool
	{
		$this->load->helper('url');
		$data = array(
			'business_id' => $this->getBusiness($this->input->post('business_name')),
			'supervisor_id' => $this->getSupervisor($this->input->post('supervisor_name')) ,
			'start_date' => $this->input->post('start_date'),
			'end_date' => $this->input->post('end_date')
		);
		return $this->db->update('audit', $data,array('id' => $id));
	}

    /**
     * @param int $id
     * @return false|mixed|string
     */
    public  function deleteAudit(int $id):bool
    {
        $this->load->helper('url');
        return $this->db->delete('audit', array('id' => $id));
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
     * @param string|null $name
     * @return array|array[]|mixed|object|null
     */
    public function getBusiness(string $name = null)
    {
        if ($name === null)
        {
            $query = $this->db->get('small_business_entity');
            return $query->result_array();
        }

        $query = $this->db->select('id')->where('name', $name)->get('small_business_entity');
        return $query->row('id');

    }

    public function insertAuditBach(array $data)
    {
        $this->load->helper('url');
        foreach ($data as &$data_item)
        {
            $data_item['business_id'] = $this->getBusiness($data_item['business_name']);
            $data_item['supervisor_id'] = $this->getSupervisor($data_item['supervisor_name']);
            unset($data_item['supervisor_name']);
            unset($data_item['business_name']);

        }
        return $this->db->insert_batch('audit',$data);

    }
}
