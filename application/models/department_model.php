<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class department_model extends CI_Model {
	function get_department_list($param1b = "") {
		$this->db->select('*');
		$this->db->from('amos_department');
		if ($param1b != ""){
			$this->db->like('department_name', $param1b);
		}
		if($this->input->post('length') && $this->input->post('length') != -1){
			$this->db->limit($this->input->post('length'), $this->input->post('start'));
		}
		return $query = $this->db->get();
	}
	
	function count_get_all_dept_filtered($param1b){
		$this->db->select('*');
		$this->db->from('amos_department');
		if ($param1b != "") {
		  $this->db->like('department_name',$param1b);
		}
		return $this->db->count_all_results();
	}
	
	public function count_get_all_department() {
		$this->db->select('*');
		$this->db->from('amos_department');
		return $this->db->count_all_results();
	}
	
	public function insert($data) {
		$this->db->insert('amos_department', $data); 
	}
	
	public function get_department($id){
		$query = $this->db->get_where('amos_department', array('hash_id' => $id));
		return $query->row();
	}
	
	public function update_department($data) {
		$id= $this->input->post('id');
		$this->db->where('department_id', $id);
		$this->db->update('amos_department', $data); 
	}
}