<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class maintenance_vendor_model extends CI_Model {
	
	function get_maintenance_vendor_list($filter1="",$value1="") {
		$this->db->select('amv.*,acc.contract_category_name');
		$this->db->from('amos_maintenance_vendor amv');
		$this->db->join('amos_contract_category acc','acc.contract_id = amv.contract_category_id', 'left');
		if ($filter1 != "" && $value1 != ""){
			$this->db->like($filter1, $value1);
		}
		if($this->input->post('length') && $this->input->post('length') != -1){
			$this->db->limit($this->input->post('length'), $this->input->post('start'));
		}
		return $query = $this->db->get();
	}
	
	function count_maintenance_vendor_list($filter1="",$value1=""){
		$this->db->select('amv.*,acc.contract_category_name');
		$this->db->from('amos_maintenance_vendor amv');
		$this->db->join('amos_contract_category acc','acc.contract_id = amv.contract_category_id', 'left');
		if ($filter1 != "" && $value1 != ""){
			$this->db->like($filter1, $value1);
		}
		return $this->db->count_all_results();
	}
	
	public function get_all_maintenance_vendor_list() {
		$this->db->select('amv.*,acc.contract_category_name');
		$this->db->from('amos_maintenance_vendor amv');
		$this->db->join('amos_contract_category acc','acc.contract_id = amv.contract_category_id', 'left');
		return $this->db->count_all_results();
	}
	
	public function get_unique_contract_number(){
		$this->db->select('contract_number');
		$this->db->from('amos_maintenance_vendor');
		$this->db->order_by('maintenance_vendor_id','desc');
		$query = $this->db->get();
		return $query->row();
	}
	
	public function get_contract_cat(){
		$this->db->select('*');
		$this->db->from('amos_contract_category');
		$query = $this->db->get();
		return $query;
	}
	
	public function insert($data) {
		$this->db->insert('amos_maintenance_vendor', $data); 
	}
	
	public function insertVendor($data) {
		$this->db->insert('amos_vendor', $data); 
	}
	
	public function getVendor() {
		$this->db->select('*');
		$this->db->from('amos_vendor');
		return $this->db->get();		
	}
	
	public function get_maintenance_vendor($id){
		$query = $this->db->get_where('amos_maintenance_vendor', array('hash_id' => $id));
		return $query->row();
	}
	
	public function update_maintenance_vendor($data,$id) {
		$this->db->where('maintenance_vendor_id', $id);
		$this->db->update('amos_maintenance_vendor', $data); 
		return $this->db->last_query();
	}
}