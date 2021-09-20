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
        $this->load->library('pagination');
        $this->load->library('session');
    }

	/**
	 * Выводит все записи audit
     * На текущий момент вывод с пастраничным разбиением от CI3
	 */
    public function index()
    {
        $data['title'] = 'Реестр плановых проверок';
//        $data['audit'] = $this->audit_model->getAudit();
        $pageConfig['total_rows'] = $this->audit_model->countAudits();
        $pageConfig['base_url'] = base_url('audit/page');
        $pageConfig['per_page'] = 5;
        $pageConfig['use_page_numbers'] = TRUE;
        $pageConfig['first_url'] = base_url('audit/page/1');
        $offset = ($this->uri->segment(3)) ? ($this->uri->segment(3)-1) * $pageConfig['per_page']:0;
        $data['audit'] = $this->audit_model->getAuditsPage($pageConfig['per_page'],$offset);
        $this->pagination->initialize($pageConfig);
        $data['links'] = $this->pagination->create_links();
        $this->load->helper('form');
        $this->load->view('templates/header', $data);
        $this->load->view('audit/index', $data);
        $this->load->view('templates/footer');
    }

    /**
     * Выводит отфильтрованную таблицу
     */
    public function filter()
    {
        $searchData = [];
        if($this->input->post('submit') != NULL ){
            $searchData['business_name'] = $this->input->post('business_name');
            $searchData['supervisor_name'] = $this->input->post('supervisor_name');
            $searchData['start_date'] = $this->input->post('start_date');
            $searchData['end_date'] = $this->input->post('end_date');
            $this->session->set_userdata('searchData',$searchData);

        }else{
            if($this->session->userdata('searchData') != NULL){
                $searchData = $this->session->userdata('searchData');
            }
        }
        $data['title'] = 'Списк по фильтрам';
        $pageConfig['total_rows'] = $this->audit_model->countFilteredAudits($searchData);
        $pageConfig['base_url'] = base_url('audit/filter/page');
        $pageConfig['per_page'] = 3;
        $pageConfig['use_page_numbers'] = TRUE;
        $pageConfig['first_url'] = base_url('audit/filter/page/1');
        $offset = ($this->uri->segment(4)) ? ($this->uri->segment(4)-1) * $pageConfig['per_page']:0;
        $data['audit'] = $this->audit_model->getFilteredPages($pageConfig['per_page'],$offset,$searchData);
        $this->pagination->initialize($pageConfig);
        $data['links'] = $this->pagination->create_links();
        $this->load->helper('form');
        $this->load->view('templates/header', $data);
        $this->load->view('audit/index', $data);
        $this->load->view('templates/footer');

    }

    /**
     * Создает запись о новом аудите
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
     * Редактирует существующую запись
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
     * Удалает запись
     * @param int $id
     */
    public function delete(int $id)
    {
        $this->audit_model->deleteAudit($id);
        redirect('audit/', 'refresh');
    }

    /**
     * Импортирует данные об аудитах из excel файла
     */
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
            for ($i=1; $i < $sheetCount; $i++) {
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

    /**
     * Экспортирует все записи в excel
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function exportExcel()
    {
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'. urlencode('SBS_register.xlsx').'"');
        $data = $this->audit_model->getAudit();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Реестр проверок');
        $sheet->setCellValue('A1','ID');
        $sheet->setCellValue('B1', 'Проверяемй СМП');
        $sheet->setCellValue('C1', 'Проверяющий орган');
        $sheet->setCellValue('D1','Дата начала');
        $sheet->setCellValue('E1','Дата завершения');
        $currentRow = 2;
        foreach ($data as $audit_item) {
            $sheet->setCellValue('A' . $currentRow, $audit_item['id']);
            $sheet->setCellValue('B' . $currentRow, $audit_item['business_name']);
            $sheet->setCellValue('C' . $currentRow, $audit_item['supervisor_name']);
            $sheet->setCellValue('D' . $currentRow, $audit_item['start_date']);
            $sheet->setCellValue('E' . $currentRow, $audit_item['end_date']);
            $currentRow++;
        }
        //Адаптировать ширину столбцов
        foreach ($sheet->getColumnIterator() as $column) {
            $sheet->getColumnDimension($column->getColumnIndex())->setAutoSize(true);
        }
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    /**
     * В текущей ревизии не используется
     * Метод для ajax релевантного поиска имен СМП на стороне сервера
     */
    public function liveSearch()
	{

		$search_data = $_POST['search_data'];

		$query = $this->audit_model->getLiveBusinessNames($search_data);

		foreach ($query as $row):
			echo "<li><a href='#'>" . $row->name . "</a></li>";

		endforeach;
	}

    /**
     * В текущей ревизии не используется
     * тестовый вид для ajax релевантного поиска имен смп
     */
	public function test_search(){
		$this->load->view('templates/header');
		$this->load->view('audit/test_search');
		$this->load->view('templates/footer');
	}
}
