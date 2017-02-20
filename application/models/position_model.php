<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class position_model extends CI_Model {
	function get_position_list($param1b = "") {
		$this->db->select('*');
		$this->db->from('amos_position');
		if ($param1b != ""){
			$this->db->like('position_name', $param1b);
		}
		if($this->input->post('length') && $this->input->post('length') != -1){
			$this->db->limit($this->input->post('length'), $this->input->post('start'));
		}
		return $query = $this->db->get();
	}
	
	function count_get_all_position_filtered($param1b){
		$this->db->select('*');
		$this->db->from('amos_position');
		if ($param1b != "") {
		  $this->db->like('position_name',$param1b);
		}
		return $this->db->count_all_results();
	}
	
	public function count_get_all_position() {
		$this->db->select('*');
		$this->db->from('amos_position');
		return $this->db->count_all_results();
	}
	
	public function insert($data) {
		$this->db->insert('amos_position', $data); 
	}
	
	public function get_position($id){
		$query = $this->db->get_where('amos_position', array('hash_id' => $id));
		return $query->row();
	}
	
	public function update_position($data) {
		$id= $this->input->post('id');
		$this->db->where('position_id', $id);
		$this->db->update('amos_position', $data); 
	}
}