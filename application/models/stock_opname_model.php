<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class stock_opname_model extends CI_Model {
	function get_stock_opname_list($field = "",$value1="") {
		$this->db->select('aso.*,aw.warehouse_name,ae.employee_name');
		$this->db->from('amos_stock_opname aso');
		$this->db->join('amos_warehouse aw','aw.warehouse_id=aso.warehouse_id','left');
		$this->db->join('amos_employee ae','ae.employee_id=aso.created_by','left');
		if ($field != "" && $value1!=""){
			$this->db->like($field, $value1);
		}
		if($this->input->post('length') && $this->input->post('length') != -1){
			$this->db->limit($this->input->post('length'), $this->input->post('start'));
		}
		return $query = $this->db->get();
	}
	
	function count_get_all_stockopname_filtered($field = "",$value1=""){
		$this->db->select('aso.*,aw.warehouse_name');
		$this->db->from('amos_stock_opname aso');
		$this->db->join('amos_warehouse aw','aw.warehouse_id=aso.warehouse_id','left');
		$this->db->join('amos_employee ae','ae.employee_id=aso.created_by','left');
		if ($field != "" && $value1!=""){
			$this->db->like($field, $value1);
		}
		return $this->db->count_all_results();
	}
	
	public function count_get_all_stockopname() {
		$this->db->select('aso.*,aw.warehouse_name');
		$this->db->from('amos_stock_opname aso');
		$this->db->join('amos_warehouse aw','aw.warehouse_id=aso.warehouse_id','left');
		$this->db->join('amos_employee ae','ae.employee_id=aso.created_by','left');
		return $this->db->count_all_results();
	}
	
	public function insert($data) {
		$this->db->insert('amos_stock_opname', $data);
		$insert_id = $this->db->insert_id();
		return  $insert_id;
	}
	
	public function insert_detail_asset($data) {
		$this->db->insert('amos_stock_opname_asset_detail', $data);
	}
	
	public function insert_detail_inventory($data) {
		$this->db->insert('amos_stock_opname_inventory_detail', $data);
	}
	
	
	public function get_stock_opname($id){
		$query = $this->db->query('select aso.*,ae.employee_name, aw.warehouse_name from amos_stock_opname aso left join amos_employee ae 
		on ae.employee_id = aso.created_by left join amos_warehouse aw on aw.warehouse_id = aso.warehouse_id where aso.hash_id = "'.$id.'"');
		return $query->row();
		//$query = $this->db->get_where('amos_stock_opname', array('hash_id' => $id));
		//return $query->row();
	}
	
	public function get_stock_opname_asset($id){
		$query = $this->db->query('select asoad.*,aa.*,ad.department_name from amos_stock_opname_asset_detail asoad join amos_stock_opname aso 
			on aso.stock_opname_id  = asoad.stock_opname_id left join amos_asset aa on aa.asset_id = asoad.asset_id 
			left join amos_asset_department asd on aa.asset_id=asd.asset_id left join amos_department ad on ad.department_id=asd.department_id 
			where aso.hash_id = "'.$id.'"');
		return $query->result();
	}
	
	public function get_stock_opname_inventory($id){
		$q = 'select asoid.*,ai.inventory_name,ai.inventory_code,ai.inventory_part_number,ad.department_name from amos_stock_opname_inventory_detail asoid join amos_stock_opname aso 
			on aso.stock_opname_id = asoid.stock_opname_id left join amos_inventory ai on ai.inventory_id = asoid.inventory_id
			left join amos_inventory_department aid on ai.inventory_id=aid.inventory_id left join amos_department ad on ad.department_id=aid.department_id 
			where aso.hash_id = "'.$id.'"';
		$query = $this->db->query($q);
		return $query->result();
	}
	
	public function updateAsset($data,$id) {
		$this->db->where('stock_opname_asset_detail_id', $id);
		$this->db->update('amos_stock_opname_asset_detail', $data); 
	}
	
	public function updateInventory	($data,$id) {
		$this->db->where('stock_opname_inventory_detail_id', $id);
		$this->db->update('amos_stock_opname_inventory_detail', $data); 
	}
	
	public function get_warehouse_list(){
		$this->db->select('*');
		$this->db->from('amos_warehouse');
		return $query = $this->db->get();
	}
	
	public function get_asset_list($filter1="",$value1="",$warehouse=""){
		$this->db->select('asset.*,department.department_name');
		$this->db->from('amos_asset asset');
		$this->db->join('amos_asset_department asd','asd.asset_id=asset.asset_id','left');
		$this->db->join('amos_department department','department.department_id=asd.department_id','left');
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
		$this->db->join('amos_asset_department asd','asd.asset_id=asset.asset_id','left');
		$this->db->join('amos_department department','department.department_id=asd.department_id','left');
		$this->db->where('warehouse_id',$warehouse);
		return $this->db->count_all_results();
	}
	
	public function count_asset_list_filtered($filter1="",$value1="",$warehouse=""){
		$this->db->select('asset.*,department.department_name');
		$this->db->from('amos_asset asset');
		$this->db->join('amos_asset_department asd','asd.asset_id=asset.asset_id','left');
		$this->db->join('amos_department department','department.department_id=asd.department_id','left');
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
		$this->db->select('inventory.*,department.department_name');
		$this->db->from('amos_inventory inventory');
		$this->db->join('amos_inventory_department asd','asd.inventory_id=inventory.inventory_id','left');
		$this->db->join('amos_department department','department.department_id=asd.department_id','left');
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
		$this->db->join('amos_inventory_department asd','asd.inventory_id=inventory.inventory_id','left');
		$this->db->join('amos_department department','department.department_id=asd.department_id','left');
		$this->db->where('warehouse_id',$warehouse);
		return $this->db->count_all_results();
	}
	
	public function count_inventory_list_filtered($filter1="",$value1="",$warehouse=""){
		$this->db->select('*');
		$this->db->from('amos_inventory inventory');
		$this->db->join('amos_inventory_department asd','asd.inventory_id=inventory.inventory_id','left');
		$this->db->join('amos_department department','department.department_id=asd.department_id','left');
		$this->db->where('warehouse_id',$warehouse);
		if ($filter1 != "" && $value1 != ""){
			$this->db->like($filter1, $value1);
		}
		if($this->input->post('length') && $this->input->post('length') != -1){
			$this->db->limit($this->input->post('length'), $this->input->post('start'));
		}
		return $this->db->count_all_results();
	}
	
	function stock_opname($id,$status){
		$data = array(
               'stock_opname_approval_status' => $status,
            );

		$this->db->where('stock_opname_id', $id);
		$this->db->update('amos_stock_opname', $data);
	}
	
	
	function update_stock_opname($data,$id){
		$this->db->where('stock_opname_id', $id);
		$this->db->update('amos_stock_opname', $data);
	}
	
	function delete_stock_opname_asset($id){
		$this->db->delete('amos_stock_opname_asset_detail', array('stock_opname_id' => $id));
	}
	
	function delete_stock_opname_inventory($id){
		$this->db->delete('amos_stock_opname_inventory_detail', array('stock_opname_id' => $id));
	}
	
}