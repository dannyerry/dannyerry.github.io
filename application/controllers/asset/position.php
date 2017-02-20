<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Position extends MY_Controller {
	public $path = "asset/position";
	
	function __construct() {
        parent::__construct();
		$this->load->model('position_model');
    }
	
	function index() {
		$this->_view($this->path.'/index');
	}
	
	function insert() {
		$this->_view($this->path.'/insert');
	}
	
	function do_insert() {
		$name= $this->input->post('position_name');
		$data=array(
			'position_name'=>$name,
			'hash_id' => $this->create_hash_id('amos_position'),
			);

		$this->position_model->insert($data);
		redirect('asset/position/index');
	}
	
	function edit($id) {
		$data['position'] = $this->position_model->get_position($id);
		$this->_view($this->path.'/edit',$data);
	}
	
	function update() {
		$name= $this->input->post('position_name');
		$data=array('position_name'=>$name);
		$this->position_model->update_position($data);
		redirect('asset/position/index');

	}
	
	function get_position_list(){
		$value1 = $this->input->post('value1');
		$users = $this->position_model->get_position_list($value1)->result();
		$data = array();
		$no = $_POST['start'];
		foreach ($users as $row) {
		  $no++;
		  $rowTable = array();
		  $rowTable[] = $no;
		  $rowTable[] = $row->position_name;
		  $url_update = base_url('asset/position/edit/'.$row->hash_id);
		  $rowTable[] = '<a href="'.$url_update.'"><button class="btn btn-primary" title="edit data"><i class="fa fa-pencil"></i></button></a>';
		  $data[] = $rowTable;
		}
		$output = array(
		  "draw" => $_POST['draw'],
		  "recordsTotal" => $this->position_model->count_get_all_position(),
		  "recordsFiltered" => $this->position_model->count_get_all_position_filtered($value1),
		  "data" => $data,
		);
		echo json_encode($output);
	}

}
