<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require FCPATH.'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Reader\Xls as XlsReader;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as XlsxReader;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

/**
 * @property Audit_model $audit_model
 */
class Audit extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('audit_model');
        $this->load->helper('url');
    }

	/**
	 *
	 */
    public function index()
    {
        $data['title'] = 'Реестр плановых проверок';
        $data['audit'] = $this->audit_model->getAudit();
        $this->load->helper('form');
        $this->load->view('templates/header', $data);
        $this->load->view('audit/index', $data);
        $this->load->view('templates/footer');
    }

    /**
     *
     */
    public function create()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $data['title'] = 'Новый аудит';
        $this->form_validation->set_rules('business_name','Проверяемый СМП','required');
        $this->form_validation->set_rules('supervisor_name','Проверяющий орган','required');
        $this->form_validation->set_rules('start_date','Дата начала','required');
        $this->form_validation->set_rules('end_date','Дата завершения','required');

        if ($this->form_validation->run() === FALSE)
        {
            $data['supervisors'] = $this->audit_model->getSupervisor();
            $data['business'] = $this->audit_model->getBusiness();
            $this->load->view('templates/header', $data);
            $this->load->view('audit/create');
            $this->load->view('templates/footer');

        }
        else
        {
            $this->audit_model->setAudit();
            redirect('audit/', 'refresh');
        }
    }

    /**
     * @param int|null $id
     */
    public function edit(int $id = null)
	{
		$data['audit_item'] = $this->audit_model->getAudit($id);

		if (empty($data['audit_item']))
		{
			show_404();
		}
		$data['title'] = 'Редактировать аудит';
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('business_name','Проверяемый СМП','required');
		$this->form_validation->set_rules('supervisor_name','Проверяющий орган','required');
		$this->form_validation->set_rules('start_date','Дата начала','required');
		$this->form_validation->set_rules('end_date','Дата завершения','required');
		if ($this->form_validation->run() === FALSE)
		{
			$data['supervisors'] = $this->audit_model->getSupervisor();
			$data['business'] = $this->audit_model->getBusiness();
			$this->load->view('templates/header', $data);
			$this->load->view('audit/edit', $data);
			$this->load->view('templates/footer');

		}
		else
		{
			$this->audit_model->updateAudit($id);
			redirect('audit/', 'refresh');
		}

	}

    /**
     * @param int $id
     */
    public function delete(int $id)
    {
        $this->audit_model->deleteAudit($id);
        redirect('audit/', 'refresh');
    }

    public function importExcel()
    {
        $upload_file = $_FILES['upload_file']['name'];
        $extension = pathinfo($upload_file,PATHINFO_EXTENSION);

        if($extension == 'xls')
        {
            $reader = new XlsReader();
        }
        else if ($extension == 'xlsx')
        {
            $reader= new XlsxReader();
        }
        else
        {
            show_404();
        }
        $spreadSheet = $reader->load($_FILES['upload_file']['tmp_name']);
        $sheetData = $spreadSheet->getActiveSheet()->toArray();
        $sheetCount = count($sheetData);
        if($sheetCount>1)
        {
            $data=array();
            for ($i=0; $i < $sheetCount; $i++) {
                $data[]=array(
                    'business_name'=>$sheetData[$i][0],
                    'supervisor_name'=>$sheetData[$i][1],
                    'start_date'=>$sheetData[$i][2],
                    'end_date'=>$sheetData[$i][3],
                );
            }
            $this->audit_model->insertAuditBach($data);
            redirect('audit/', 'refresh');
        }

    }
}
