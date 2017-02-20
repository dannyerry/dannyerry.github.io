<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Employee extends MY_Controller {
	public $path = "asset/employee";
	
	function __construct() {
        parent::__construct();
		$this->load->model('employee_model');
		$this->load->model('department_model');
		$this->load->model('position_model');
    }
	
	function index() {
		$this->_view($this->path.'/index');
	}
	
	function insert() {
		$data['department']=$this->department_model->get_department_list("")->result();
		$data['position']=$this->position_model->get_position_list("")->result();
		$this->_view($this->path.'/insert',$data);
	}
	
	function do_insert() {
		$emp_name= $this->input->post('emp_name');
		$emp_addr= $this->input->post('emp_addr');
		$emp_phone= $this->input->post('emp_phone');
		$emp_email= $this->input->post('emp_email');
		$department= $this->input->post('department');
		$position= $this->input->post('position');
		$data=array(
			'employee_name'=>$emp_name,
			'employee_address'=>$emp_addr,
			'employee_phone'=>$emp_phone,
			'employee_email'=>$emp_email,
			'department_id'=>$department,
			'position_id'=>$position,
			'hash_id' => $this->create_hash_id('amos_employee')
			);
		$this->employee_model->insert($data);
		redirect('asset/employee/index');
	}
	
	function edit($id) {
		$data['department']=$this->department_model->get_department_list("")->result();
		$data['position']=$this->position_model->get_position_list("")->result();
		$data['employee'] = $this->employee_model->get_employee($id);
		$this->_view($this->path.'/edit',$data);
	}
	
	function update() {
		$emp_name= $this->input->post('emp_name');
		$emp_addr= $this->input->post('emp_addr');
		$emp_phone= $this->input->post('emp_phone');
		$emp_email= $this->input->post('emp_email');
		$department= $this->input->post('department');
		$position= $this->input->post('position');
		$data=array(
			'employee_name'=>$emp_name,
			'employee_address'=>$emp_addr,
			'employee_phone'=>$emp_phone,
			'employee_email'=>$emp_email,
			'department_id'=>$department,
			'position_id'=>$position
			);
		$this->employee_model->update_employee($data);
		redirect('asset/employee/index');

	}
	
	function get_employee_list(){
		$field = $this->input->post('filter1');
		$value1 = $this->input->post('value1');
		$users = $this->employee_model->get_employee_list($field,$value1)->result();
		$data = array();
		$no = $_POST['start'];
		foreach ($users as $row) {
		  $no++;
		  $rowTable = array();
		  $rowTable[] = $no;
		  $rowTable[] = $row->employee_name;
		  $rowTable[] = $row->employee_address;
		  $rowTable[] = $row->employee_phone;
		  $rowTable[] = $row->employee_email;
		  $rowTable[] = $row->department_name;
		  $rowTable[] = $row->position_name;
		  $url_update = base_url('asset/employee/edit/'.$row->hash_id);
		  $rowTable[] = '<a href="'.$url_update.'"><button class="btn btn-primary" title="edit data"><i class="fa fa-pencil"></i></button></a>';
		  $data[] = $rowTable;
		}
		$output = array(
		  "draw" => $_POST['draw'],
		  "recordsTotal" => $this->employee_model->count_get_all_employee(),
		  "recordsFiltered" => $this->employee_model->count_get_all_dept_employee($field,$value1),
		  "data" => $data,
		);
		echo json_encode($output);
	}

}
