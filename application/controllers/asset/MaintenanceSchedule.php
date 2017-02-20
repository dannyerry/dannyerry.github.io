<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MaintenanceSchedule extends MY_Controller {

	public $path = "asset/maintenance schedule";
	
	function __construct() {
        parent::__construct();
		$this->load->model('stock_transfer_model');
		$this->load->model('maintenance_schedule_model');
		$this->load->library('session');
    }
	
	function create_unique_contract_number(){
		$data = $this->maintenance_vendor_model->get_unique_contract_number();
		if(empty($data)){
			return 'amv_1';
		}else{
			$jadi = explode('_',$data->contract_number);
			$data = $jadi[1]+1;
			return 'amv_'.$data;
		}
	}
	
	
	function index() {
		$this->_view($this->path.'/index');
	}
	
	function get_maintenance_vendor_list(){
		$filter1 = $this->input->post('filter1');
		$value1 = $this->input->post('value1');		
		$users = $this->maintenance_schedule_model->get_maintenance_schedule_list($filter1,$value1)->result();
		$data = array();
		$no = $_POST['start'];
		foreach ($users as $row) {
			$no++;
			$rowTable = array();
			$rowTable[] = $no;
			$rowTable[] = $row->contract_number;
			$rowTable[] = $row->contract_category_name;
			$rowTable[] = date('d/m/Y',strtotime($row->contract_signed));
			$rowTable[] = date('d/m/Y',strtotime($row->contract_expired));
			$rowTable[] = $row->contract_value;
			$link_edit = base_url('asset/MaintenanceVendor/update/'.$row->hash_id);
			$rowTable[] = '<a href="'.$link_edit.'"><button class="btn btn-primary" title="Edit"><i class="fa fa-pencil"></i></button></a>';
			
			
			
			$data[] = $rowTable;
		}
		$output = array(
		  "draw" => $_POST['draw'],
		  "recordsTotal" => $this->maintenance_schedule_model->get_all_maintenance_vendor_list(),
		  "recordsFiltered" => $this->maintenance_schedule_model->count_maintenance_vendor_list($filter1,$value1),
		  "data" => $data,
		);
		echo json_encode($output);
	}
	
	

}
