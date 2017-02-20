<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class maintenance_model extends CI_Model {
    //ASSET
    function get_asset( $param1a = "", $param1b = "") {
        $this->db->select('a.*, b.*, a.hash_id as a_hash_id');
        $this->db->from('amos_asset as a');
        $this->db->join('amos_warehouse as b', 'a.warehouse_id = b.warehouse_id');
        if ($param1a != "" && $param1b != "") {
          $this->db->like('a.'.$param1a, $param1b);
        }
        if($this->input->post('length') != -1){
    
          $this->db->limit($this->input->post('length'), $this->input->post('start'));
        }
        //$this->db->where('a.asset_status',1);
        return $query = $this->db->get();
    }
  
    public function count_get_all_asset() {
        $this->db->select('a.asset_id');
        $this->db->from('amos_asset as a');
        return $this->db->count_all_results();
    }
    
    public function count_get_all_asset_filtered($param1a = "", $param1b = "") {
        $this->db->select('a.asset_id');
        $this->db->from('amos_asset as a');
        if ($param1a != "" && $param1b != "") {
          $this->db->like('a.'.$param1a, $param1b);
        }
        return $this->db->count_all_results();
    }
    
    function select_asset_by_id($id){
		$this->db->select('a.*, b.*, d.*, e.*, f.*, g.*, a.hash_id as a_hash_id');
        $this->db->from('amos_asset as a');
        $this->db->join('amos_warehouse as b', 'a.warehouse_id = b.warehouse_id');
        $this->db->join('amos_manufacturer as d', 'a.manufacture_id = d.manufacturer_id');        
        $this->db->join('amos_category as e', 'a.category_id = e.category_id');
        $this->db->join('amos_dimension_unit as f', 'a.dimension_unit_id = f.dimension_unit_id');
        $this->db->join('amos_weight_unit as g', 'a.weight_unit_id = g.weight_unit_id');
        $this->db->where('a.hash_id',$id);
		return $this->db->get();
	}
    
    function getGroup_by_id($id){
        $sql="SELECT c.asset_id, a.group_id,a.group_name, b.sub_group1_id, b.sub_group1_name, d.sub_group2_id, d.sub_group2_name,
            e.sub_group3_id, e.sub_group3_name, f.sub_group4_id, f.sub_group4_name
            FROM amos_asset c INNER JOIN amos_group a 
            ON c.asset_group_id = a.group_id            
            INNER JOIN amos_sub_group1 b 
            ON a.group_id = b.group_id
            INNER JOIN amos_sub_group2 d 
            ON c.asset_sub_group_2_id = d.sub_group2_id
            INNER JOIN amos_sub_group3 e 
            ON c.asset_sub_group_3_id = e.sub_group3_id            
            INNER JOIN amos_sub_group4 f 
            ON c.asset_sub_group_4_id = f.sub_group4_id
            where c.hash_id = '".$id."'";		
		$query = $this->db->query($sql);
		return $query;
    }
    
    function getDept($id){
        $sql="select a.asset_id, group_concat(c.department_name) as department_name, group_concat(c.department_id) as department_id
            from amos_asset a inner join amos_asset_department b on a.asset_id = b.asset_id
            inner join amos_department c on b.department_id = c.department_id where a.hash_id = '".$id."'";		
		$query = $this->db->query($sql);
		return $query;
    }
    
    function getKpi(){
        $sql="select * from amos_kpi order by kpi_master asc";		
		$query = $this->db->query($sql);
		return $query;
    }
    
    function getItem(){
        $sql="select * from amos_item order by item_name asc";		
		$query = $this->db->query($sql);
		return $query;
    }
    
    function select_new_maintenance($asset_code){
		$sql="select maintenance_code from amos_maintenance where maintenance_code like '%".$asset_code."%' order by maintenance_code desc limit 1";		
		$query = $this->db->query($sql);
		return $query;
	}
    
    function insert_maintenance_setup($data){
        return $this->db->insert('amos_maintenance', $data);
    }
    
    function getTask_maintenance_plan($id){
        $sql="select a.* from amos_maintenance a inner join amos_asset b on a.asset_id = b.asset_id where b.hash_id = '".$id."' order by a.maintenance_code asc";
        $query = $this->db->query($sql);
		return $query;
    }
    
    function getMaintenance($hash_id){
        $query = "select * from amos_maintenance where hash_id='$hash_id'";
        $sql = $this->db->query($query);
        return $sql;
    }
    
    function select_new_maintenance_item($maintenance_id){
        if($maintenance_id!=''){
            $sql="select maintenance_item_of_work_code from amos_maintenance_item_of_work where maintenance_item_of_work_code like '_%".$maintenance_id."%_' order by maintenance_item_of_work_code desc limit 1";    
        }else{
            $sql="select maintenance_item_of_work_id from amos_maintenance_item_of_work order by maintenance_item_of_work_id desc limit 1";
        }
				
		$query = $this->db->query($sql);
		return $query;
	}
    
    function update_maintenance($maintenance_id, $data_maintenance){
        $this->db->where('maintenance_id', $maintenance_id);
        return $this->db->update('amos_maintenance', $data_maintenance);
    }
    
    function insert_tools_needed($data_tools){
        return $this->db->insert('amos_maintenance_tools_needed', $data_tools);
    }
    
    function insert_maintenance_item_of_work($data_item){
        return $this->db->insert('amos_maintenance_item_of_work', $data_item);
    }
    
    function insert_maintenance_sub_item_of_work($data_sub_item){
        return $this->db->insert('amos_maintenance_sub_item_of_work', $data_sub_item);
    }
    
    function insert_maintenance_equipment_needed($data_equipment){
        return $this->db->insert('amos_maintenance_item_of_work_equipment_needed', $data_equipment);
    }
    
    function getItemSubItemOfWork($hash_id){
        $query = 'SELECT b.*, group_concat(c.maintenance_sub_item_of_work_name) as sub_item, group_concat(d.kpi_master) as kpi, group_concat(c.maintenance_sub_item_of_work_justification) as justi
                FROM `amos_maintenance` a inner join amos_maintenance_item_of_work b
                on a.maintenance_id = b.maintenance_id right join amos_maintenance_sub_item_of_work c
                on b.maintenance_item_of_work_id = c.maintenance_item_of_work_id right join amos_kpi d
                on c.kpi_id = d.kpi_id where a.hash_id = "'.$hash_id.'"
                group by b.maintenance_item_of_work_id order by b.maintenance_item_of_work_id';
        
        $sql = $this->db->query($query);
        return $sql;
    }
    
    function getEquipment($hash_id){
        $query = 'SELECT group_concat(c.maintenance_item_of_work_equipment_needed_qty) as qty, group_concat(d.item_name) as item
                FROM amos_maintenance_item_of_work_equipment_needed c left join amos_maintenance_item_of_work b
                on c.maintenance_item_or_work_id = b.maintenance_item_of_work_id left join amos_item d
                on c.item_id = d.item_id inner join amos_maintenance a on a.maintenance_id = b.maintenance_id
                where a.hash_id = "'.$hash_id.'"
                group by b.maintenance_item_of_work_id order by b.maintenance_item_of_work_id';
        $sql = $this->db->query($query);
        return $sql;
    }
    
    function getTools($hash_id){
        $query = 'SELECT c.inventory_name, d.unit_name FROM amos_maintenance_tools_needed b inner join amos_maintenance a
                on a.maintenance_id = b.maintenance_id inner join amos_inventory c
                on b.inventory_id = c.inventory_id inner join amos_unit d
                on b.unit_id = d.unit_id
                where a.hash_id = "'.$hash_id.'"';
        $sql = $this->db->query($query);
        return $sql;
    }
    
}
