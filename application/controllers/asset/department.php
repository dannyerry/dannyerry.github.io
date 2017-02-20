<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Department extends MY_Controller {
	public $path = "asset/department";
	
	function __construct() {
        parent::__construct();
		$this->load->model('department_model');
    }
	
	function index() {
		$this->_view($this->path.'/index');
	}
	
	function insert() {
		$this->_view($this->path.'/insert');
	}
	
	function do_insert() {
		$name= $this->input->post('dept_name');
		$data=array(
			'department_name'=>$name,
			'hash_id' => $this->create_hash_id('amos_department')
		);
		$this->department_model->insert($data);
		redirect('asset/department/index');
	}
	
	function edit($id) {
		$data['department'] = $this->department_model->get_department($id);
		$this->_view($this->path.'/edit',$data);
	}
	
	function update() {
		$name= $this->input->post('dept_name');
		$data=array('department_name'=>$name);
		$this->department_model->update_department($data);
		redirect('asset/department/index');

	}
	
	function get_department_list(){
		$value1 = $this->input->post('value1');
		$users = $this->department_model->get_department_list($value1)->result();
		$data = array();
		$no = $_POST['start'];
		foreach ($users as $row) {
		  $no++;
		  $rowTable = array();
		  $rowTable[] = $no;
		  $rowTable[] = $row->department_name;
		  $url_update = base_url('asset/department/edit/'.$row->hash_id);
		  $rowTable[] = '<a href="'.$url_update.'"><button class="btn btn-primary" title="edit data"><i class="fa fa-pencil"></i></button></a>';
		  $data[] = $rowTable;
		}
		$output = array(
		  "draw" => $_POST['draw'],
		  "recordsTotal" => $this->department_model->count_get_all_department(),
		  "recordsFiltered" => $this->department_model->count_get_all_dept_filtered($value1),
		  "data" => $data,
		);
		echo json_encode($output);
	}

}
