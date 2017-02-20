<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class stock_transfer_model extends CI_Model {
	
	function get_last_row(){
		$q = $this->db->query('select stock_transfer_id from amos_stock_transfer limit 1');
		return $q;
	}
	
	public function get_warehouse_list(){
		$this->db->select('*');
		$this->db->from('amos_warehouse');
		return $query = $this->db->get();
	}
	
	function get_stock_transfer_list($filter1="",$value1=""){
		$this->db->select('ast.*,awf.warehouse_name as warehouse_from,,awt.warehouse_name as warehouse_to,ae.employee_name');
		$this->db->from('amos_stock_transfer ast');
		$this->db->join('amos_warehouse awf','awf.warehouse_id=ast.from_warehouse_id','left');
		$this->db->join('amos_warehouse awt','awt.warehouse_id=ast.to_warehouse_id','left');
		$this->db->join('amos_employee ae','ae.employee_id=ast.created_by','left');
		if ($filter1 != "" && $value1!=""){
			$this->db->like($filter1, $value1);
		}
		if($this->input->post('length') && $this->input->post('length') != -1){
			$this->db->limit($this->input->post('length'), $this->input->post('start'));
		}
		return $query = $this->db->get();
	}
	
	function count_stock_transfer_list($field = "",$value1=""){
		$this->db->select('ast.*,awf.warehouse_name as warehouse_from,,awt.warehouse_name as warehouse_to,ae.employee_name');
		$this->db->from('amos_stock_transfer ast');
		$this->db->join('amos_warehouse awf','awf.warehouse_id=ast.from_warehouse_id','left');
		$this->db->join('amos_warehouse awt','awt.warehouse_id=ast.to_warehouse_id','left');
		$this->db->join('amos_employee ae','ae.employee_id=ast.created_by','left');
		if ($field != "" && $value1!=""){
			$this->db->like($field, $value1);
		}
		return $this->db->count_all_results();
	}
	
	public function get_all_stock_transfer_list() {
		$this->db->select('ast.*,awf.warehouse_name as warehouse_from,,awt.warehouse_name as warehouse_to,ae.employee_name');
		$this->db->from('amos_stock_transfer ast');
		$this->db->join('amos_warehouse awf','awf.warehouse_id=ast.from_warehouse_id','left');
		$this->db->join('amos_warehouse awt','awt.warehouse_id=ast.to_warehouse_id','left');
		$this->db->join('amos_employee ae','ae.employee_id=ast.created_by','left');
		return $this->db->count_all_results();
	}
	
	public function get_asset_list($filter1="",$value1="",$warehouse=""){
		$this->db->select('asset.*');
		$this->db->from('amos_asset asset');
		$this->db->where('warehouse_id',$warehouse);
		if ($filter1 != "" && $value1 != ""){
			$this->db->like($filter1, $value1);
		}
		if($this->input->post('length') && $this->input->post('length') != -1){
			$this->db->limit($this->input->post('length'), $this->input->post('start'));
		}
		return $query = $this->db->get();
	}
	
	public function get_all_asset_list($warehouse=""){
		$this->db->select('*');
		$this->db->from('amos_asset asset');
		$this->db->where('warehouse_id',$warehouse);
		return $this->db->count_all_results();
	}
	
	public function count_asset_list_filtered($filter1="",$value1="",$warehouse=""){
		$this->db->select('asset.*');
		$this->db->from('amos_asset asset');		
		$this->db->where('warehouse_id',$warehouse);
		if ($filter1 != "" && $value1 != ""){
			$this->db->like($filter1, $value1);
		}
		if($this->input->post('length') && $this->input->post('length') != -1){
			$this->db->limit($this->input->post('length'), $this->input->post('start'));
		}
		return $this->db->count_all_results();
	}
	
	public function get_inventory_list($filter1="",$value1="",$warehouse=""){
		$this->db->select('inventory.*');
		$this->db->from('amos_inventory inventory');
		$this->db->where('warehouse_id',$warehouse);
		if ($filter1 != "" && $value1 != ""){
			$this->db->like($filter1, $value1);
		}
		if($this->input->post('length') && $this->input->post('length') != -1){
			$this->db->limit($this->input->post('length'), $this->input->post('start'));
		}
		return $query = $this->db->get();
	}
	
	public function get_all_inventory_list($warehouse=""){
		$this->db->select('inventory.*');
		$this->db->from('amos_inventory inventory');
		$this->db->where('warehouse_id',$warehouse);
		return $this->db->count_all_results();
	}
	
	public function count_inventory_list_filtered($filter1="",$value1="",$warehouse=""){
		$this->db->select('*');
		$this->db->from('amos_inventory inventory');
		$this->db->where('warehouse_id',$warehouse);
		if ($filter1 != "" && $value1 != ""){
			$this->db->like($filter1, $value1);
		}
		if($this->input->post('length') && $this->input->post('length') != -1){
			$this->db->limit($this->input->post('length'), $this->input->post('start'));
		}
		return $this->db->count_all_results();
	}
	
	function get_stock_transfer($id){
		$query = $this->db->query('select ast.*,ae.employee_name,awf.warehouse_name as ware_from,awt.warehouse_name as ware_to 
			from amos_stock_transfer ast 
			left join amos_employee ae on ae.employee_id = ast.created_by 
			left join amos_warehouse awf on awf.warehouse_id=ast.from_warehouse_id
			left join amos_warehouse awt on awt.warehouse_id = ast.to_warehouse_id
			where ast.hash_id = "'.$id.'"');
		return $query->row();
	}
	
	public function insert($data) {
		$this->db->insert('amos_stock_transfer', $data);
		$insert_id = $this->db->insert_id();
		return  $insert_id;
	}
	
	public function insert_inventory($data) {
		$this->db->insert('amos_stock_transfer_inventory_detail', $data);
	}
	
	public function insert_asset($data) {
		$this->db->insert('amos_stock_transfer_asset_detail', $data);
	}
	
	public function get_stock_transfer_asset ($id){
		$query = $this->db->query('select aa.*,ase.actual_stock,ase.asset_name,ase.asset_id,ase.asset_code
			from amos_stock_transfer_asset_detail aa left join amos_stock_transfer ast 
			on ast.stock_transfer_id = aa.stock_transfer_id  left join amos_asset ase on  ase.asset_id = aa.asset_id 
			where ast.hash_id = "'.$id.'"');
		return $query->result();
	}
	
	public function get_stock_transfer_inventory ($id){
		$query = $this->db->query('select ai.*,aii.inventory_stock_qty,aii.inventory_id,aii.inventory_name,aii.inventory_code from amos_stock_transfer_inventory_detail ai left join amos_stock_transfer ast 
			on ast.stock_transfer_id = ai.stock_transfer_id left join amos_inventory aii on aii.inventory_id = ai.inventory_id where ast.hash_id = "'.$id.'"');
		return $query->result();
	}
	
	public function update_stock_transfer($data,$id){
		$this->db->where('stock_transfer_id', $id);
		$this->db->update('amos_stock_transfer', $data); 

	}
	
	public function delete_stock_transfer_asset($id){
		$this->db->delete('amos_stock_transfer_asset_detail', array('stock_transfer_id' => $id));
	}
	
	public function delete_stock_transfer_inventory($id){
		$this->db->delete('amos_stock_transfer_inventory_detail', array('stock_transfer_id' => $id));
	}
	
	public function update_stock_transfer_detail_asset($data,$id){
		$this->db->where('stock_transfer_asset_detail_id', $id);
		$this->db->update('amos_stock_transfer_asset_detail', $data);
	}
	
	public function update_stock_trnasfer_detail_inv($data,$id){
		$this->db->where('stock_transfer_inventory_detail_id', $id);
		$this->db->update('amos_stock_transfer_inventory_detail', $data);
	}
	

}