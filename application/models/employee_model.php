<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class employee_model extends CI_Model {
	function get_employee_list($field="", $param1b = "") {
		$this->db->select('e.*,p.position_name,d.department_name');
		$this->db->from('amos_employee e');
		$this->db->join('amos_department d','d.department_id = e.department_id','left');
		$this->db->join('amos_position p','e.position_id=p.position_id','left');
		if ($param1b != "" && $field != ""){
			$this->db->like($field, $param1b);
		}
		if($this->input->post('length') && $this->input->post('length') != -1){
			$this->db->limit($this->input->post('length'), $this->input->post('start'));
		}
		return $query = $this->db->get();
	}
	
	function count_get_all_dept_employee($field,$param1b){
		$this->db->select('e.*,p.position_name,d.department_name');
		$this->db->from('amos_employee e');
		$this->db->join('amos_department d','d.department_id = e.department_id','left');
		$this->db->join('amos_position p','e.position_id=p.position_id','left');
		if ($param1b != "" && $field != "") {
		  $this->db->like($field,$param1b);
		}
		return $this->db->count_all_results();
	}
	
	public function count_get_all_employee() {
		$this->db->select('e.*,p.position_name,d.department_name');
		$this->db->from('amos_employee e');
		$this->db->join('amos_department d','d.department_id = e.department_id','left');
		$this->db->join('amos_position p','e.position_id=p.position_id','left');
		return $this->db->count_all_results();
	}
	
	public function insert($data) {
		$this->db->insert('amos_employee', $data); 
	}
	
	public function get_employee($id){
		$query = $this->db->get_where('amos_employee', array('hash_id' => $id));
		return $query->row();
	}
	
	public function update_employee($data) {
		$id= $this->input->post('id');
		$this->db->where('employee_id', $id);
		$this->db->update('amos_employee', $data); 
	}
}