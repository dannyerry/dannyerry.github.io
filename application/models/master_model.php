<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class master_model extends CI_Model {
  //============WAREHOUSE==============
  function get_warehouse( $param1a = "", $param1b = "") {
    $this->db->select('*');
    $this->db->from('amos_warehouse as a');
    //$this->db->join('user_groups as b', 'b.id = a.user_group_id');
    if ($param1a != "" && $param1b != "") {
      $this->db->like('a.'.$param1a, $param1b);
    }
    if($this->input->post('length') != -1){

      $this->db->limit($this->input->post('length'), $this->input->post('start'));
    }
    return $query = $this->db->get();
  }
  
  public function count_get_all_warehouse() {
    $this->db->select('a.warehouse_id');
    $this->db->from('amos_warehouse as a');
    return $this->db->count_all_results();
  }
  
  public function count_get_all_warehouse_filtered($param1a = "", $param1b = "") {
    $this->db->select('a.warehouse_id');
    $this->db->from('amos_warehouse as a');
    if ($param1a != "" && $param1b != "") {
      $this->db->like('a.'.$param1a, $param1b);
    }
    return $this->db->count_all_results();
  }
  
    function select_new_warehouse($limit=1, $offset=0){
		$this->db->select('warehouse_id')->order_by('warehouse_id', 'desc');
		return $this->db->get('amos_warehouse');
	}
    
  function insert_warehouse($data){
    return $this->db->insert('amos_warehouse', $data);
  }
  
    function update_warehouse($hash_id,$data){
    	$this->db->where('hash_id', $hash_id);
        return $this->db->update('amos_warehouse', $data);        
    }
    
    function select_warehouse_by_id($hash_id){
		$this->db->select('*');
        $this->db->where('hash_id',$hash_id);
		return $this->db->get('amos_warehouse');
	}
    
    function delete_warehouse($hash_id){
        $this->db->where('hash_id', $hash_id);
		return $this->db->delete('amos_warehouse');
    }
    
    //============MANUFACTURER==============
  function get_manufacturer( $param1a = "", $param1b = "") {
    $this->db->select('*');
    $this->db->from('amos_manufacturer as a');
    //$this->db->join('user_groups as b', 'b.id = a.user_group_id');
    if ($param1a != "" && $param1b != "") {
      $this->db->like('a.'.$param1a, $param1b);
    }
    if($this->input->post('length') != -1){

      $this->db->limit($this->input->post('length'), $this->input->post('start'));
    }
    return $query = $this->db->get();
  }
  
  public function count_get_all_manufacturer() {
    $this->db->select('a.manufacturer_id');
    $this->db->from('amos_manufacturer as a');
    return $this->db->count_all_results();
  }
  
  public function count_get_all_manufacturer_filtered($param1a = "", $param1b = "") {
    $this->db->select('a.manufacturer_id');
    $this->db->from('amos_manufacturer as a');
    if ($param1a != "" && $param1b != "") {
      $this->db->like('a.'.$param1a, $param1b);
    }
    return $this->db->count_all_results();
  }
  
  function insert_manufacturer($data){
    return $this->db->insert('amos_manufacturer', $data);
  }
  
    function update_manufacturer($id,$data){
    	$this->db->where('hash_id', $id);
        return $this->db->update('amos_manufacturer', $data);        
    }
    
    function select_manufacturer_by_id($id){
		$this->db->select('*');
        $this->db->where('hash_id',$id);
		return $this->db->get('amos_manufacturer');
	}
    
    function delete_manufacturer($id){
        $this->db->where('hash_id', $id);
		return $this->db->delete('amos_manufacturer');
    }
    
    //CATEGORY
    function get_category( $param1a = "", $param1b = "") {
    $this->db->select('*');
    $this->db->from('amos_category a');
    //$this->db->join('user_groups as b', 'b.id = a.user_group_id');
    if ($param1a != "" && $param1b != "") {
      $this->db->like('a.'.$param1a, $param1b);
    }
    if($this->input->post('length') != -1){

      $this->db->limit($this->input->post('length'), $this->input->post('start'));
    }
    return $query = $this->db->get();
  }
  
  public function count_get_all_category() {
    $this->db->select('a.category_id');
    $this->db->from('amos_category as a');
    return $this->db->count_all_results();
  }
  
  public function count_get_all_category_filtered($param1a = "", $param1b = "") {
    $this->db->select('a.category_id');
    $this->db->from('amos_category as a');
    if ($param1a != "" && $param1b != "") {
      $this->db->like('a.'.$param1a, $param1b);
    }
    return $this->db->count_all_results();
  }
  
  function insert_category($data){
    return $this->db->insert('amos_category', $data);
  }
  
    function update_category($id,$data){
    	$this->db->where('hash_id', $id);
        return $this->db->update('amos_category', $data);        
    }
    
    function select_category_by_id($id){
		$this->db->select('*');
        $this->db->where('hash_id',$id);
		return $this->db->get('amos_category');
	}
    
    function delete_category($id){
        $this->db->where('hash_id', $id);
		return $this->db->delete('amos_category');
    }
    
    //DIMENSION UNIT
    function get_dimension_unit( $param1a = "", $param1b = "") {
    $this->db->select('*');
    $this->db->from('amos_dimension_unit a');
    //$this->db->join('user_groups as b', 'b.id = a.user_group_id');
    if ($param1a != "" && $param1b != "") {
      $this->db->like('a.'.$param1a, $param1b);
    }
    if($this->input->post('length') != -1){

      $this->db->limit($this->input->post('length'), $this->input->post('start'));
    }
    return $query = $this->db->get();
  }
  
  public function count_get_all_dimension_unit() {
    $this->db->select('a.dimension_unit_id');
    $this->db->from('amos_dimension_unit as a');
    return $this->db->count_all_results();
  }
  
  public function count_get_all_dimension_unit_filtered($param1a = "", $param1b = "") {
    $this->db->select('a.dimension_unit_id');
    $this->db->from('amos_dimension_unit as a');
    if ($param1a != "" && $param1b != "") {
      $this->db->like('a.'.$param1a, $param1b);
    }
    return $this->db->count_all_results();
  }
  
  function insert_dimension_unit($data){
    return $this->db->insert('amos_dimension_unit', $data);
  }
  
    function update_dimension_unit($id,$data){
    	$this->db->where('hash_id', $id);
        return $this->db->update('amos_dimension_unit', $data);        
    }
    
    function select_dimension_unit_by_id($id){
		$this->db->select('*');
        $this->db->where('hash_id',$id);
		return $this->db->get('amos_dimension_unit');
	}
    
    function delete_dimension_unit($id){
        $this->db->where('hash_id', $id);
		return $this->db->delete('amos_dimension_unit');
    }
    
    //WEIGHT UNIT
    function get_weight_unit( $param1a = "", $param1b = "") {
    $this->db->select('*');
    $this->db->from('amos_weight_unit a');
    //$this->db->join('user_groups as b', 'b.id = a.user_group_id');
    if ($param1a != "" && $param1b != "") {
      $this->db->like('a.'.$param1a, $param1b);
    }
    if($this->input->post('length') != -1){

      $this->db->limit($this->input->post('length'), $this->input->post('start'));
    }
    return $query = $this->db->get();
  }
  
  public function count_get_all_weight_unit() {
    $this->db->select('a.weight_unit_id');
    $this->db->from('amos_weight_unit as a');
    return $this->db->count_all_results();
  }
  
  public function count_get_all_weight_unit_filtered($param1a = "", $param1b = "") {
    $this->db->select('a.weight_unit_id');
    $this->db->from('amos_weight_unit as a');
    if ($param1a != "" && $param1b != "") {
      $this->db->like('a.'.$param1a, $param1b);
    }
    return $this->db->count_all_results();
  }
  
  function insert_weight_unit($data){
    return $this->db->insert('amos_weight_unit', $data);
  }
  
    function update_weight_unit($id,$data){
    	$this->db->where('hash_id', $id);
        return $this->db->update('amos_weight_unit', $data);        
    }
    
    function select_weight_unit_by_id($id){
		$this->db->select('*');
        $this->db->where('hash_id',$id);
		return $this->db->get('amos_weight_unit');
	}
    
    function delete_weight_unit($id){
        $this->db->where('hash_id', $id);
		return $this->db->delete('amos_weight_unit');
    }
    
    //GROUP
    function get_group( $param1a = "", $param1b = "") {
    $this->db->select('*');
    $this->db->from('amos_group a');
    //$this->db->join('user_groups as b', 'b.id = a.user_group_id');
    if ($param1a != "" && $param1b != "") {
      $this->db->like('a.'.$param1a, $param1b);
    }
    if($this->input->post('length') != -1){

      $this->db->limit($this->input->post('length'), $this->input->post('start'));
    }
    return $query = $this->db->get();
  }
  
  public function count_get_all_group() {
    $this->db->select('a.group_id');
    $this->db->from('amos_group as a');
    return $this->db->count_all_results();
  }
  
  public function count_get_all_group_filtered($param1a = "", $param1b = "") {
    $this->db->select('a.group_id');
    $this->db->from('amos_group as a');
    if ($param1a != "" && $param1b != "") {
      $this->db->like('a.'.$param1a, $param1b);
    }
    return $this->db->count_all_results();
  }
  
  function insert_group($data){
    return $this->db->insert('amos_group', $data);
  }
  
    function update_group($id,$data){
    	$this->db->where('hash_id', $id);
        return $this->db->update('amos_group', $data);        
    }
    
    function select_group_by_id($id){
		$this->db->select('*');
        $this->db->where('hash_id',$id);
		return $this->db->get('amos_group');
	}
    
    function delete_group($id){
        $this->db->where('hash_id', $id);
		return $this->db->delete('amos_group');
    }
    
    //SUB GROUP 1
    function get_sub_group1( $param1a = "", $param1b = "", $g_hash_id) {
    $this->db->select('a.*, b.hash_id as g_hash_id');
    $this->db->from('amos_sub_group1 a');
    $this->db->join('amos_group b','a.group_id = b.group_id');
    //$this->db->join('user_sub_group1s as b', 'b.id = a.user_sub_group1_id');
    if ($param1a != "" && $param1b != "") {
      $this->db->like('a.'.$param1a, $param1b);
    }
    if($this->input->post('length') != -1){

      $this->db->limit($this->input->post('length'), $this->input->post('start'));
    }
    $this->db->where('b.hash_id', $g_hash_id);
    return $query = $this->db->get();
  }
  
  public function count_get_all_sub_group1() {
    $this->db->select('a.sub_group1_id');
    $this->db->from('amos_sub_group1 as a');
    return $this->db->count_all_results();
  }
  
  public function count_get_all_sub_group1_filtered($param1a = "", $param1b = "") {
    $this->db->select('a.sub_group1_id');
    $this->db->from('amos_sub_group1 as a');
    if ($param1a != "" && $param1b != "") {
      $this->db->like('a.'.$param1a, $param1b);
    }
    return $this->db->count_all_results();
  }
  
  function insert_sub_group1($data){
    return $this->db->insert('amos_sub_group1', $data);
  }
  
    function update_sub_group1($id,$data){
    	$this->db->where('hash_id', $id);
        return $this->db->update('amos_sub_group1', $data);        
    }
    
    function select_sub_group1_by_id($id){
		$this->db->select('*');
        $this->db->where('hash_id',$id);
		return $this->db->get('amos_sub_group1');
	}
    
    function delete_sub_group1($id){
        $this->db->where('hash_id', $id);
		return $this->db->delete('amos_sub_group1');
    }
    
    //SUB GROUP 2
    function get_sub_group2( $param1a = "", $param1b = "", $g_hash_id) {
    $this->db->select('a.*, b.hash_id as sg1_hash_id');
    $this->db->from('amos_sub_group2 a');
    $this->db->join('amos_sub_group1 b','a.sub_group1_id = b.sub_group1_id');
    //$this->db->join('user_sub_group2s as b', 'b.id = a.user_sub_group2_id');
    if ($param1a != "" && $param1b != "") {
      $this->db->like('a.'.$param1a, $param1b);
    }
    if($this->input->post('length') != -1){

      $this->db->limit($this->input->post('length'), $this->input->post('start'));
    }
    $this->db->where('b.hash_id', $g_hash_id);
    return $query = $this->db->get();
  }
  
  public function count_get_all_sub_group2() {
    $this->db->select('a.sub_group2_id');
    $this->db->from('amos_sub_group2 as a');
    return $this->db->count_all_results();
  }
  
  public function count_get_all_sub_group2_filtered($param1a = "", $param1b = "") {
    $this->db->select('a.sub_group2_id');
    $this->db->from('amos_sub_group2 as a');
    if ($param1a != "" && $param1b != "") {
      $this->db->like('a.'.$param1a, $param1b);
    }
    return $this->db->count_all_results();
  }
  
  function insert_sub_group2($data){
    return $this->db->insert('amos_sub_group2', $data);
  }
  
    function update_sub_group2($id,$data){
    	$this->db->where('hash_id', $id);
        return $this->db->update('amos_sub_group2', $data);        
    }
    
    function select_sub_group2_by_id($id){
		$this->db->select('*');
        $this->db->where('hash_id',$id);
		return $this->db->get('amos_sub_group2');
	}
    
    function delete_sub_group2($id){
        $this->db->where('hash_id', $id);
		return $this->db->delete('amos_sub_group2');
    }
    
    //SUB GROUP 3
    function get_sub_group3( $param1a = "", $param1b = "", $sg2_hash_id) {
    $this->db->select('a.*, b.hash_id as sg2_hash_id');
    $this->db->from('amos_sub_group3 a');
    $this->db->join('amos_sub_group2 b','a.sub_group2_id = b.sub_group2_id');
    //$this->db->join('user_sub_group3s as b', 'b.id = a.user_sub_group3_id');
    if ($param1a != "" && $param1b != "") {
      $this->db->like('a.'.$param1a, $param1b);
    }
    if($this->input->post('length') != -1){

      $this->db->limit($this->input->post('length'), $this->input->post('start'));
    }
    $this->db->where('b.hash_id', $sg2_hash_id);
    return $query = $this->db->get();
  }
  
  public function count_get_all_sub_group3() {
    $this->db->select('a.sub_group3_id');
    $this->db->from('amos_sub_group3 as a');
    return $this->db->count_all_results();
  }
  
  public function count_get_all_sub_group3_filtered($param1a = "", $param1b = "") {
    $this->db->select('a.sub_group3_id');
    $this->db->from('amos_sub_group3 as a');
    if ($param1a != "" && $param1b != "") {
      $this->db->like('a.'.$param1a, $param1b);
    }
    return $this->db->count_all_results();
  }
  
  function insert_sub_group3($data){
    return $this->db->insert('amos_sub_group3', $data);
  }
  
    function update_sub_group3($id,$data){
    	$this->db->where('hash_id', $id);
        return $this->db->update('amos_sub_group3', $data);        
    }
    
    function select_sub_group3_by_id($id){
		$this->db->select('*');
        $this->db->where('hash_id',$id);
		return $this->db->get('amos_sub_group3');
	}
    
    function delete_sub_group3($id){
        $this->db->where('hash_id', $id);
		return $this->db->delete('amos_sub_group3');
    }
    
    //SUB GROUP 4
    function get_sub_group4( $param1a = "", $param1b = "", $sg3_hash_id) {
    $this->db->select('a.*, b.hash_id as sg3_hash_id');
    $this->db->from('amos_sub_group4 a');
    $this->db->join('amos_sub_group3 b','a.sub_group3_id = b.sub_group3_id');
    //$this->db->join('user_sub_group4s as b', 'b.id = a.user_sub_group4_id');
    if ($param1a != "" && $param1b != "") {
      $this->db->like('a.'.$param1a, $param1b);
    }
    if($this->input->post('length') != -1){

      $this->db->limit($this->input->post('length'), $this->input->post('start'));
    }
    $this->db->where('b.hash_id', $sg3_hash_id);
    return $query = $this->db->get();
  }
  
  public function count_get_all_sub_group4() {
    $this->db->select('a.sub_group4_id');
    $this->db->from('amos_sub_group4 as a');
    return $this->db->count_all_results();
  }
  
  public function count_get_all_sub_group4_filtered($param1a = "", $param1b = "") {
    $this->db->select('a.sub_group4_id');
    $this->db->from('amos_sub_group4 as a');
    if ($param1a != "" && $param1b != "") {
      $this->db->like('a.'.$param1a, $param1b);
    }
    return $this->db->count_all_results();
  }
  
  function insert_sub_group4($data){
    return $this->db->insert('amos_sub_group4', $data);
  }
  
    function update_sub_group4($id,$data){
    	$this->db->where('hash_id', $id);
        return $this->db->update('amos_sub_group4', $data);        
    }
    
    function select_sub_group4_by_id($id){
		$this->db->select('*');
        $this->db->where('hash_id',$id);
		return $this->db->get('amos_sub_group4');
	}
    
    function delete_sub_group4($id){
        $this->db->where('hash_id', $id);
		return $this->db->delete('amos_sub_group4');
    }
    
    function get_all_by_group($hash_id){
        $query = "select a.group_name, group_concat(b.hash_id) as sg1, group_concat(c.hash_id) as sg2, group_concat(d.hash_id) as sg3, group_concat(e.hash_id) as sg4 from
                amos_group a left join amos_sub_group1 b on a.group_id = b.group_id
                left join amos_sub_group2 c on b.sub_group1_id = c.sub_group1_id
                left join amos_sub_group3 d on c.sub_group2_id = d.sub_group2_id
                left join amos_sub_group4 e on d.sub_group3_id = e.sub_group3_id
                where a.hash_id = '".$hash_id."'";
        $sql = $this->db->query($query);
		return $sql;
    }
    
    function get_all_by_sub_group1($sg1_hash_id){
        $query = "select b.sub_group1_id, group_concat(c.hash_id) as sg2, group_concat(d.hash_id) as sg3, group_concat(e.hash_id) as sg4 from
                amos_sub_group1 b left join amos_sub_group2 c on b.sub_group1_id = c.sub_group1_id
                left join amos_sub_group3 d on c.sub_group2_id = d.sub_group2_id
                left join amos_sub_group4 e on d.sub_group3_id = e.sub_group3_id
                where b.hash_id = '".$sg1_hash_id."'";
        $sql = $this->db->query($query);
		return $sql;
    }
    
    function get_all_by_sub_group2($sg2_hash_id){
        $query = "select c.sub_group2_id, group_concat(d.hash_id) as sg3, group_concat(e.hash_id) as sg4 from
                amos_sub_group2 c left join amos_sub_group3 d on c.sub_group2_id = d.sub_group2_id
                left join amos_sub_group4 e on d.sub_group3_id = e.sub_group3_id
                where c.hash_id = '".$sg2_hash_id."'";
        $sql = $this->db->query($query);
		return $sql;
    }
    
    function get_all_by_sub_group3($sg3_hash_id){
        $query = "select d.sub_group3_id, group_concat(e.hash_id) as sg4 from
                amos_sub_group3 d left join amos_sub_group4 e on d.sub_group3_id = e.sub_group3_id
                where d.hash_id = '".$sg3_hash_id."'";
        $sql = $this->db->query($query);
		return $sql;
    }
    
    //INVENTORY
    function get_inventory( $param1a = "", $param1b = "") {
        $this->db->select('a.*, b.*, a.hash_id as i_hash_id');
        $this->db->from('amos_inventory as a');
        $this->db->join('amos_warehouse as b', 'a.warehouse_id = b.warehouse_id');
        if ($param1a != "" && $param1b != "") {
          $this->db->like('a.'.$param1a, $param1b);
        }
        if($this->input->post('length') != -1){
    
          $this->db->limit($this->input->post('length'), $this->input->post('start'));
        }
        $this->db->where('a.inventory_status',1);
        return $query = $this->db->get();
    }
  
    public function count_get_all_inventory() {
        $this->db->select('a.inventory_id');
        $this->db->from('amos_inventory as a');
        return $this->db->count_all_results();
    }
    
    public function count_get_all_inventory_filtered($param1a = "", $param1b = "") {
        $this->db->select('a.inventory_id');
        $this->db->from('amos_inventory as a');
        if ($param1a != "" && $param1b != "") {
          $this->db->like('a.'.$param1a, $param1b);
        }
        return $this->db->count_all_results();
    }
    
    function getWarehouse(){
        $sql="select * from amos_warehouse order by warehouse_name asc";		
		$query = $this->db->query($sql);
		return $query;
    }
    
    function getManufacturer(){
        $sql="select * from amos_manufacturer order by manufacturer_name asc";		
		$query = $this->db->query($sql);
		return $query;
    }
    
    function getGroup(){
        $sql="select * from amos_group order by group_name asc";		
		$query = $this->db->query($sql);
		return $query;
    }
    
    function getSub_group1($id){
        $sql="select * from amos_sub_group1 where group_id = $id order by sub_group1_name asc";		
		$query = $this->db->query($sql);
		return $query;
    }
    
    function getSub_group2($id){
        $sql="select * from amos_sub_group2 where sub_group1_id = $id order by sub_group2_name asc";		
		$query = $this->db->query($sql);
		return $query;
    }
    
    function getDept($id){
        $sql="select a.inventory_id, group_concat(c.department_name) as department_name, group_concat(c.department_id) as department_id
            from amos_inventory a inner join amos_inventory_department b on a.inventory_id = b.inventory_id
            inner join amos_department c on b.department_id = c.department_id where a.hash_id = '".$id."'";		
		$query = $this->db->query($sql);
		return $query;
    }
    
    function getDepartment(){
        $sql="select * from amos_department order by department_name asc";		
		$query = $this->db->query($sql);
		return $query;
    }
    
    function getCategory(){
        $sql="select * from amos_category order by category_name asc";		
		$query = $this->db->query($sql);
		return $query;
    }
    
    function getWeightUnit(){
        $sql="select * from amos_weight_unit order by weight_unit_name asc";		
		$query = $this->db->query($sql);
		return $query;
    }
    
    function getDimensionUnit(){
        $sql="select * from amos_dimension_unit order by dimension_unit_name asc";		
		$query = $this->db->query($sql);
		return $query;
    }
    
    /*function getGroup(){
        $sql="SELECT a.group_id,a.group_name, b.sub_group1_id, b.sub_group1_name, d.sub_group2_id, d.sub_group2_name 
            FROM amos_group a 
            INNER JOIN amos_sub_group1 b 
            ON a.group_id = b.group_id
            inner join amos_sub_group2 d
            on b.sub_group1_id = d.sub_group1_id
            GROUP BY a.group_id";		
		$query = $this->db->query($sql);
		return $query;
    }*/
    
    function getGroup_by_id($id){
        $sql="SELECT c.inventory_id, a.group_id,a.group_name, b.sub_group1_id, b.sub_group1_name, d.sub_group2_id, d.sub_group2_name
            FROM amos_inventory c INNER JOIN amos_group a 
            ON c.inventory_group_id = a.group_id            
            INNER JOIN amos_sub_group1 b 
            ON a.group_id = b.group_id
            INNER JOIN amos_sub_group2 d 
            ON c.inventory_sub_group_1_id = d.sub_group1_id
            where c.hash_id = '".$id."'";		
		$query = $this->db->query($sql);
		return $query;
    }
    
    function getValue($id){
        $sql = "SELECT a.group_id,a.group_name, b.sub_group1_id, b.sub_group1_name 
            FROM amos_group a 
            INNER JOIN amos_sub_group1 b 
            ON a.group_id = b.group_id
            WHERE a.group_id = $id";
		$query = $this->db->query($sql);
		return $query->result_array();
    }
    
    function getValue_2($id){
        $sql = "SELECT a.sub_group1_id, a.sub_group1_name, b.sub_group2_id, b.sub_group2_name 
            FROM amos_sub_group1 a 
            INNER JOIN amos_sub_group2 b 
            ON a.sub_group1_id = b.sub_group1_id
            WHERE a.sub_group1_id = $id";
		$query = $this->db->query($sql);
		return $query->result_array();
    }
    
    function select_new_inventory($limit=1, $offset=0){
		$this->db->select('inventory_id')->order_by('inventory_id', 'desc');
		return $this->db->get('amos_inventory');
	}
    
    function select_new_inventory_image($limit=1, $offset=0){
		$this->db->select('inventory_image_id')->order_by('inventory_image_id', 'desc');
		return $this->db->get('amos_inventory_image');
	}
    
    function insert_inventory($data){
        return $this->db->insert('amos_inventory', $data);
    }
    
    function insert_inventory_department($data){
        return $this->db->insert('amos_inventory_department', $data);
    }    
    
    function insert_inventory_image($data){
        return $this->db->insert('amos_inventory_image', $data);
    }
  
    function update_inventory($id,$data){
    	$this->db->where('hash_id', $id);
        return $this->db->update('amos_inventory', $data);        
    }
    
    function update_inventory_image($id,$data){
    	$this->db->where('inventory_image_id', $id);
        return $this->db->update('amos_inventory_image', $data);        
    }
    
    function delete_inventory_department($id){
        $this->db->where('inventory_id', $id);
		return $this->db->delete('amos_inventory_department');
    }
    
    function select_inventory_by_id($id){
		$this->db->select('a.*, b.*, d.*, e.*, f.*, g.*, a.hash_id as i_hash_id');
        $this->db->from('amos_inventory as a');
        $this->db->join('amos_warehouse as b', 'a.warehouse_id = b.warehouse_id');
        $this->db->join('amos_manufacturer as d', 'a.manufacture_id = d.manufacturer_id');        
        $this->db->join('amos_category as e', 'a.category_id = e.category_id');
        $this->db->join('amos_dimension_unit as f', 'a.dimension_unit_id = f.dimension_unit_id');
        $this->db->join('amos_weight_unit as g', 'a.weight_unit_id = g.weight_unit_id');
        $this->db->where('a.hash_id',$id);
		return $this->db->get('amos_inventory, amos_warehouse, amos_manufacturer, amos_category');
	}
    
    function delete_inventory($id){
        $this->db->where('inventory_id', $id);
		return $this->db->delete('amos_inventory');
    }
    
    function getInvImg($id){
        $query = "select a.* from amos_inventory_image a inner join amos_inventory b where b.hash_id='".$id."'";
        $sql = $this->db->query($query);
        return $sql;
    }
    
    //============PROJECT==============
    function get_project( $param1a = "", $param1b = "") {
        $this->db->select('a.*, b.*, a.hash_id as p_hash_id');
        $this->db->from('amos_project as a');
        $this->db->join('amos_employee as b', 'a.project_pic = b.employee_id');
        if ($param1a != "" && $param1b != "") {
            $this->db->like('a.'.$param1a, $param1b);
        }
        if($this->input->post('length') != -1){
        
          $this->db->limit($this->input->post('length'), $this->input->post('start'));
        }
        return $query = $this->db->get();
    }
    
    public function count_get_all_project() {
        $this->db->select('a.project_id');
        $this->db->from('amos_project as a');
        return $this->db->count_all_results();
    }
    
    public function count_get_all_project_filtered($param1a = "", $param1b = "") {
        $this->db->select('a.project_id');
        $this->db->from('amos_project as a');
        if ($param1a != "" && $param1b != "") {
            $this->db->like('a.'.$param1a, $param1b);
        }
        return $this->db->count_all_results();
    }
    
    function getEmployee(){
        $sql="select * from amos_employee order by employee_name asc";		
		$query = $this->db->query($sql);
		return $query;
    }
        
    function insert_project($data){
        return $this->db->insert('amos_project', $data);
    }
    
    function update_project($id,$data){
    	$this->db->where('hash_id', $id);
        return $this->db->update('amos_project', $data);        
    }
    
    function select_project_by_id($id){
    	$this->db->select('*');
        $this->db->where('hash_id',$id);
    	return $this->db->get('amos_project');
    }
    
    function delete_project($id){
        $this->db->where('hash_id', $id);
    	return $this->db->delete('amos_project');
    }
    
    //============FMR INVENTORY==============
    function get_fmr_inventory( $param1a = "", $param1b = "") {
        $this->db->select('a.*, b.*, c.*, d.*, a.hash_id as f_hash_id');
        $this->db->from('amos_fmr_inventory as a');
        $this->db->join('users as b', 'a.created_by = b.id');
        $this->db->join('amos_department as c', 'a.department_id = c.department_id');
        $this->db->join('amos_project as d', 'a.project_id = d.project_id');
        if ($param1a != "" && $param1b != "") {
            $this->db->like('a.'.$param1a, $param1b);
        }
        if($this->input->post('length') != -1){
        
          $this->db->limit($this->input->post('length'), $this->input->post('start'));
        }
        
        return $query = $this->db->get();
    }
    
    public function count_get_all_fmr_inventory() {
        $this->db->select('a.fmr_inventory_id');
        $this->db->from('amos_fmr_inventory as a');
        return $this->db->count_all_results();
    }
    
    public function count_get_all_fmr_inventory_filtered($param1a = "", $param1b = "") {
        $this->db->select('a.fmr_inventory_id');
        $this->db->from('amos_fmr_inventory as a');
        if ($param1a != "" && $param1b != "") {
            $this->db->like('a.'.$param1a, $param1b);
        }
        return $this->db->count_all_results();
    }
    
    function select_fmr_inventory($id){
        $this->db->select('a.*, b.*, c.*, d.*, a.hash_id as f_hash_id');
        $this->db->from('amos_fmr_inventory as a');
        $this->db->join('users as b', 'a.created_by = b.id');
        $this->db->join('amos_department as c', 'a.department_id = c.department_id');
        $this->db->join('amos_project as d', 'a.project_id = d.project_id');
        $this->db->where('a.hash_id',$id);
        return $this->db->get('amos_fmr_inventory, users, amos_department, amos_project');
    }
    
    function select_fmr_inventory_detail($id){
        $this->db->select('a.*, b.*, c.*, d.*');
        $this->db->from('amos_fmr_inventory as a');
        $this->db->join('amos_fmr_inventory_detail as b', 'a.fmr_inventory_id = b.fmr_inventory_id');
        $this->db->join('amos_inventory as c', 'b.inventory_id= c.inventory_id');
        $this->db->join('amos_unit as d', 'b.unit_id = d.unit_id');
        $this->db->where('a.hash_id',$id);
        return $this->db->get();
    }
    
    function select_new_fmr_inventory($limit=1, $offset=0){
		$this->db->select('fmr_inventory_id');
        $this->db->order_by('fmr_inventory_id', 'desc');
		return $this->db->get('amos_fmr_inventory');
	}    
    
    function select_new_fmr_inventory_all($limit=1, $offset=0){
		$this->db->select('fmr_inventory_id');
        $this->db->order_by('fmr_inventory_id', 'desc');
		return $this->db->get('amos_fmr_inventory');
	}    
    
    function getProject(){
        $sql="select * from amos_project order by project_name asc";		
		$query = $this->db->query($sql);
		return $query;
    }   
    
    function getUnit(){
        $sql="select * from amos_unit order by unit_name asc";		
		$query = $this->db->query($sql);
		return $query;
    }
    
    function getInventory(){
        $sql="select * from amos_inventory order by inventory_name asc";		
		$query = $this->db->query($sql);
		return $query;
    }   
        
    function insert_fmr_inventory($data){
        return $this->db->insert('amos_fmr_inventory', $data);
    } 
            
    function insert_fmr_inventory_detail($data){
        return $this->db->insert('amos_fmr_inventory_detail', $data);
    }
    
    function update_fmr_inventory($id,$data){
        //var_dump($data);die();
    	$this->db->where('hash_id', $id);
        return $this->db->update('amos_fmr_inventory', $data);        
    }
    
    function select_fmr_inventory_by_id($id){
    	$this->db->select('*');
        $this->db->where('fmr_inventory_id',$id);
    	return $this->db->get('amos_fmr_inventory');
    }
    
    function delete_fmr_inventory($id){
        $this->db->where('fmr_inventory_id', $id);
    	return $this->db->delete('amos_fmr_inventory');
    }
    
    //============FMR ASSET==============
    function get_fmr_asset( $param1a = "", $param1b = "") {
        $this->db->select('a.*, b.*, c.*, d.*, a.hash_id as a_hash_id');
        $this->db->from('amos_fmr_asset as a');
        $this->db->join('users as b', 'a.created_by = b.id');
        $this->db->join('amos_department as c', 'a.department_id = c.department_id');
        $this->db->join('amos_project as d', 'a.project_id = d.project_id');
        if ($param1a != "" && $param1b != "") {
            $this->db->like('a.'.$param1a, $param1b);
        }
        if($this->input->post('length') != -1){
        
          $this->db->limit($this->input->post('length'), $this->input->post('start'));
        }
        
        return $query = $this->db->get();
    }
    
    public function count_get_all_fmr_asset() {
        $this->db->select('a.fmr_asset_id');
        $this->db->from('amos_fmr_asset as a');
        return $this->db->count_all_results();
    }
    
    public function count_get_all_fmr_asset_filtered($param1a = "", $param1b = "") {
        $this->db->select('a.fmr_asset_id');
        $this->db->from('amos_fmr_asset as a');
        if ($param1a != "" && $param1b != "") {
            $this->db->like('a.'.$param1a, $param1b);
        }
        return $this->db->count_all_results();
    }
    
    function select_fmr_asset($id){
        $this->db->select('a.*, b.*, c.*, d.*, a.hash_id as a_hash_id');
        $this->db->from('amos_fmr_asset as a');
        $this->db->join('users as b', 'a.created_by = b.id');
        $this->db->join('amos_department as c', 'a.department_id = c.department_id');
        $this->db->join('amos_project as d', 'a.project_id = d.project_id');
        $this->db->where('a.hash_id',$id);
        return $this->db->get('amos_fmr_asset, users, amos_department, amos_project');
    }
    
    function select_fmr_asset_detail($id){
        $this->db->select('a.*, b.*, c.*, d.*');
        $this->db->from('amos_fmr_asset as a');
        $this->db->join('amos_fmr_asset_detail as b', 'a.fmr_asset_id = b.fmr_asset_id');
        $this->db->join('amos_asset as c', 'b.asset_id= c.asset_id');
        $this->db->join('amos_unit as d', 'b.unit_id = d.unit_id');
        $this->db->where('a.hash_id',$id);
        return $this->db->get();
    }
    
    function select_new_fmr_asset($limit=1, $offset=0){
		$this->db->select('fmr_asset_id');
        $this->db->order_by('fmr_asset_id', 'desc');
		return $this->db->get('amos_fmr_asset');
	}    
    
    function select_new_fmr_asset_all($limit=1, $offset=0){
		$this->db->select('fmr_asset_id');
        $this->db->order_by('fmr_asset_id', 'desc');
		return $this->db->get('amos_fmr_asset');
	}  
    
    function getAsset(){
        $sql="select * from amos_asset order by asset_name asc";		
		$query = $this->db->query($sql);
		return $query;
    }   
        
    function insert_fmr_asset($data){
        return $this->db->insert('amos_fmr_asset', $data);
    } 
            
    function insert_fmr_asset_detail($data){
        return $this->db->insert('amos_fmr_asset_detail', $data);
    }
    
    function update_fmr_asset($id,$data){
        //var_dump($data);die();
    	$this->db->where('hash_id', $id);
        return $this->db->update('amos_fmr_asset', $data);        
    }
    
    function select_fmr_asset_by_id($id){
    	$this->db->select('*');
        $this->db->where('fmr_asset_id',$id);
    	return $this->db->get('amos_fmr_asset');
    }
    
    function delete_fmr_asset($id){
        $this->db->where('fmr_asset_id', $id);
    	return $this->db->delete('amos_fmr_asset');
    }
    
    function get_fmr_asset_release(){
        $this->db->select('a.fmr_asset_id as fa_id, a.fmr_asset_code, COUNT( e.fmr_asset_detail_id ) AS request_total,
                        a.fmr_asset_initiate_date, b.department_name, c.name, d.project_name, a.fmr_asset_justification,
                        a.fmr_asset_approval_status, a.fmr_asset_status, a.fmr_asset_remarks, a.hash_id AS fa_hash_id');
        $this->db->from('amos_fmr_asset a');
        $this->db->join('amos_department b','a.department_id = b.department_id');
        $this->db->join('users c','a.created_by = c.id');
        $this->db->join('amos_project d','a.project_id = d.project_id');
        $this->db->join('amos_fmr_asset_detail e','a.fmr_asset_id = e.fmr_asset_id');
        $this->db->where('a.fmr_asset_approval_status','1');
        $this->db->group_by('a.fmr_asset_id');        
    	return $this->db->get('amos_fmr_asset, amos_department, users, amos_project, amos_fmr_asset_detail');
    }
    
    function get_fmr_inventory_release(){
        $this->db->select('a.fmr_inventory_id as fi_id, a.fmr_inventory_code, COUNT( e.fmr_inventory_detail_id ) AS request_total,
                        a.fmr_inventory_initiate_date, b.department_name, c.name, d.project_name, a.fmr_inventory_justification,
                        a.fmr_inventory_approval_status, a.fmr_inventory_status, a.fmr_inventory_remarks, a.hash_id AS fi_hash_id');
        $this->db->from('amos_fmr_inventory a');
        $this->db->join('amos_department b','a.department_id = b.department_id');
        $this->db->join('users c','a.created_by = c.id');
        $this->db->join('amos_project d','a.project_id = d.project_id');
        $this->db->join('amos_fmr_inventory_detail e','a.fmr_inventory_id = e.fmr_inventory_id');
        $this->db->where('a.fmr_inventory_approval_status','1');
        $this->db->group_by('a.fmr_inventory_id');        
    	return $this->db->get('amos_fmr_inventory, amos_department, users, amos_project, amos_fmr_inventory_detail');
    }
    
    function cek_status_fmr_asset($id){
        $this->db->select('a.fmr_asset_id, GROUP_CONCAT( b.fmr_asset_detail_id ) , group_concat(c.fmr_asset_release_id) as fmr_asset_release');
        $this->db->from('amos_fmr_asset a');
        $this->db->join('amos_fmr_asset_detail b','a.fmr_asset_id = b.fmr_asset_id');
        $this->db->join('amos_fmr_asset_release c','b.fmr_asset_detail_id = c.fmr_asset_detail_id', 'left');
        $this->db->where('a.fmr_asset_id', $id);
    	return $this->db->get('amos_fmr_asset, amos_fmr_asset_detail, amos_fmr_asset_release');
    }
    
    function cek_status_fmr_inventory($id){
        $this->db->select('a.fmr_inventory_id, GROUP_CONCAT( b.fmr_inventory_detail_id ) , group_concat(c.fmr_inventory_release_id) as fmr_inventory_release');
        $this->db->from('amos_fmr_inventory a');
        $this->db->join('amos_fmr_inventory_detail b','a.fmr_inventory_id = b.fmr_inventory_id');
        $this->db->join('amos_fmr_inventory_release c','b.fmr_inventory_detail_id = c.fmr_inventory_detail_id', 'left');
        $this->db->where('a.fmr_inventory_id', $id);
    	return $this->db->get('amos_fmr_inventory, amos_fmr_inventory_detail, amos_fmr_inventory_release');
    }
    
    function insert_fmr_asset_release($data){
        return $this->db->insert('amos_fmr_asset_release', $data);
    }
    
    function insert_fmr_inventory_release($data){
        return $this->db->insert('amos_fmr_inventory_release', $data);
    }
    
    //============KPI==============
    function get_kpi( $param1a = "", $param1b = "") {
        $this->db->select('a.*');
        $this->db->from('amos_kpi as a');
        if ($param1a != "" && $param1b != "") {
            $this->db->like('a.'.$param1a, $param1b);
        }
        if($this->input->post('length') != -1){
        
          $this->db->limit($this->input->post('length'), $this->input->post('start'));
        }
        return $query = $this->db->get();
    }
    
    public function count_get_all_kpi() {
        $this->db->select('a.kpi_id');
        $this->db->from('amos_kpi as a');
        return $this->db->count_all_results();
    }
    
    public function count_get_all_kpi_filtered($param1a = "", $param1b = "") {
        $this->db->select('a.kpi_id');
        $this->db->from('amos_kpi as a');
        if ($param1a != "" && $param1b != "") {
            $this->db->like('a.'.$param1a, $param1b);
        }
        return $this->db->count_all_results();
    }
    
    function select_new_kpi($limit=1, $offset=0){
		$this->db->select('kpi_id');
        $this->db->order_by('kpi_id', 'desc');
		return $this->db->get('amos_kpi');
	}
    
    function insert_kpi($data){
        return $this->db->insert('amos_kpi', $data);
    }
    
    function insert_kpi_details($data){
        return $this->db->insert('amos_kpi_details', $data);
    }
    
    function update_kpi($id,$data){
    	$this->db->where('hash_id', $id);
        return $this->db->update('amos_kpi', $data);        
    }
    
    function select_kpi_by_id($id){
    	$this->db->select('*');
        $this->db->where('hash_id',$id);
    	return $this->db->get('amos_kpi');
    }
    
    function delete_kpi($id){
        $this->db->where('hash_id', $id);
    	return $this->db->delete('amos_kpi');
    }
    
    function getKpiDetails($k_hash_id){
        $sql="select a.kpi_master,b.*,c.unit_name from amos_kpi a inner join amos_kpi_details b on a.kpi_id=b.kpi_id
            inner join amos_unit c on b.unit_id = c.unit_id where a.hash_id = '".$k_hash_id."'";		
		$query = $this->db->query($sql);
		return $query;
    }
    
    function delete_kpi_details($id){
        $this->db->where('kpi_id', $id);
    	return $this->db->delete('amos_kpi_details');
    }
    
    //============ITEM==============
    function get_item( $param1a = "", $param1b = "") {
        $this->db->select('*');
        $this->db->from('amos_item');
        if ($param1a != "" && $param1b != "") {
            $this->db->like('a.'.$param1a, $param1b);
        }
        if($this->input->post('length') != -1){
        
          $this->db->limit($this->input->post('length'), $this->input->post('start'));
        }
        return $query = $this->db->get();
    }
    
    public function count_get_all_item() {
        $this->db->select('a.item_id');
        $this->db->from('amos_item as a');
        return $this->db->count_all_results();
    }
    
    public function count_get_all_item_filtered($param1a = "", $param1b = "") {
        $this->db->select('a.item_id');
        $this->db->from('amos_item as a');
        if ($param1a != "" && $param1b != "") {
            $this->db->like('a.'.$param1a, $param1b);
        }
        return $this->db->count_all_results();
    }
    
    function insert_item($data){
        return $this->db->insert('amos_item', $data);
    }
    
    function update_item($id,$data){
    	$this->db->where('hash_id', $id);
        return $this->db->update('amos_item', $data);        
    }
    
    function select_item_by_id($id){
    	$this->db->select('*');
        $this->db->where('hash_id',$id);
    	return $this->db->get('amos_item');
    }
    
    function delete_item($id){
        $this->db->where('hash_id', $id);
    	return $this->db->delete('amos_item');
    }
    
}
