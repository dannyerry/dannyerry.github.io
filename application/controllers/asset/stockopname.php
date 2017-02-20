<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Stockopname extends MY_Controller {
	public $path = "asset/stock opname";
	
	function __construct() {
        parent::__construct();
		$this->load->model('stock_opname_model');
    }
	
	function index() {
		$this->_view($this->path.'/index');
	}
	
	function insert() {
		$data['warehouse']=$this->stock_opname_model->get_warehouse_list()->result();
		$data['asset'] = json_encode(array());
		$data['inventory'] = json_encode(array());
		$this->_view($this->path.'/insert',$data);
	}
	
	
	
	function do_insert() {
		$ware=$this->input->post('gudang');
		$jenis=$this->input->post('jenis');
		$dataArrayAsset= json_decode($this->input->post('dataArrayAsset'));
		$dataArrayInventory= json_decode($this->input->post('dataArrayInventory'));
		$user =  $this->session->userdata('assets');
		$dataInsert=array( 
			'warehouse_id'=> $ware,
			'created_by'=> $user['employee_id'],
			'stock_opname_initiate_date'=> date('Y-m-d'),
			'stock_opname_due_date' => date("Y-m-d", strtotime("+1 month", strtotime(date('Y-m-d')))),
			'stock_opname_approval_status'=>$jenis,
			'hash_id'=>$this->create_hash_id('amos_stock_opname')
		);
		$opname=$this->stock_opname_model->insert($dataInsert);
		
		for($i=0;$i<count($dataArrayAsset);$i++){
			$data=array(
				'asset_id'=>$dataArrayAsset[$i],
				'stock_opname_id'=>$opname
			);
			if($dataArrayAsset[$i] != ''){
				$this->stock_opname_model->insert_detail_asset($data);
			}
		}
		
		for($i=0;$i<count($dataArrayInventory);$i++){
			$data=array(
				'inventory_id'=>$dataArrayInventory[$i],
				'stock_opname_id'=>$opname);
			if($dataArrayInventory[$i] != ''){
				$this->stock_opname_model->insert_detail_inventory($data);
			}
		}
	}
	
	function edit($id) {
		$data['asset']=$this->stock_opname_model->get_stock_opname_asset($id);
		$data['inventory']=$this->stock_opname_model->get_stock_opname_inventory($id);
		$data['stock_opname']=$this->stock_opname_model->get_stock_opname($id);
		$data['jumlah_asset']=count($data['asset']);
		$data['jumlah_inventory']=count($data['inventory']);
		$this->_view($this->path.'/edit',$data);
	}
	
	function update() {
		$changedAsset= explode(",",$this->input->post('changedAsset'));
		$changedInventory= explode(",",$this->input->post('changedInventory'));
		if($this->input->post('changedAsset') != ""){
			for($i=0;$i<count($changedAsset);$i++){
				$id=$this->input->post("detailAsset_id".$changedAsset[$i]);
				$actual_stockAsset=$this->input->post("actual_stockAsset".$changedAsset[$i]);
				$remarksAsset=$this->input->post("remarksAsset".$changedAsset[$i]);

				$data=array(
					"stock_opname_asset_detail_actual_stock" => $actual_stockAsset,
					"stock_opname_asset_detail_remarks"=>$remarksAsset
				);
				$this->stock_opname_model->updateAsset($data,$id);
			}
		}
		
		
		if($this->input->post('changedInventory') != ""){
			for($i=0;$i<count($changedInventory);$i++){
				$id=$this->input->post("detailInventory_id".$changedInventory[$i]);
				$actual_stockInventory=$this->input->post("actual_stockInventory".$changedInventory[$i]);
				$remarksInvetory=$this->input->post("remarksInvetory".$changedInventory[$i]);
				$data=array(
					"stock_opname_inventory_detail_actual_stock" => $actual_stockInventory,
					"stock_opname_inventory_detail_remarks"=>$remarksInvetory
				);
				$this->stock_opname_model->updateInventory($data,$id);
			}
		}
		
		redirect('asset/stockopname/index');

	}
	
	function edit_draft($id){
		$data['stock_opname']=$this->stock_opname_model->get_stock_opname($id);
		$data['warehouse']=$this->stock_opname_model->get_warehouse_list()->result();
		$assetPicked = $this->stock_opname_model->get_stock_opname_asset($id);
		$inventoryPicked = $this->stock_opname_model->get_stock_opname_inventory($id);
		//var_dump($assetPicked); die();
		$asset = array();
		$inventory = array();
		
		foreach($assetPicked as $a){
			$asset[] = $a->asset_id;
		}
		
		foreach($inventoryPicked as $i){
			$inventory[] = $i->inventory_id;
		}
		$data['dataAsset'] = $assetPicked;
		$data['dataInv'] = $inventoryPicked;
		$data['asset'] = json_encode($asset);
		$data['inventory'] = json_encode($inventory);
		$this->_view($this->path.'/edit_draft',$data);
	}
	
	function do_edit_draft(){
		$id=$this->input->post('id');
		$ware=$this->input->post('gudang');
		$jenis=$this->input->post('jenis');
		$dataArrayAsset= explode(',',$this->input->post('dataArrayAsset'));
		$dataArrayInventory= explode(',',$this->input->post('dataArrayInventory'));
		$user =  $this->session->userdata('assets');
		$dataInsert=array( 
			'warehouse_id'=> $ware,
			'stock_opname_approval_status'=>$jenis
		);
		$this->stock_opname_model->update_stock_opname($dataInsert,$id);
		$this->stock_opname_model->delete_stock_opname_asset($id);
		$this->stock_opname_model->delete_stock_opname_inventory($id);
		for($i=0;$i<count($dataArrayAsset);$i++){
			$data=array(
				'asset_id'=>$dataArrayAsset[$i],
				'stock_opname_id'=>$id
			);
			if($dataArrayAsset[$i] != ''){
				$this->stock_opname_model->insert_detail_asset($data);
			}
		}
		
		for($i=0;$i<count($dataArrayInventory);$i++){
			$data=array(
				'inventory_id'=>$dataArrayInventory[$i],
				'stock_opname_id'=>$id);
			if($dataArrayInventory[$i] != ''){
				$this->stock_opname_model->insert_detail_inventory($data);
			}
		}
	}
	
	function get_stock_opname_list(){
		$field = $this->input->post('filter1');
		$value1 = $this->input->post('value1');
		$users = $this->stock_opname_model->get_stock_opname_list($field,$value1)->result();
		$data = array();
		$no = $_POST['start'];
		foreach ($users as $row) {
			$no++;
			$rowTable = array();
			$rowTable[] = $no;
			$rowTable[] = $row->stock_opname_id;
			$rowTable[] = $row->warehouse_name;
			$rowTable[] = $row->employee_name;
			$rowTable[] = date('d/m/Y',strtotime($row->stock_opname_initiate_date));
			$url_update="";
			//$rowTable[] = $row->stock_opname_approval_status;
			if($row->stock_opname_approval_status==0){
				$url_fc = base_url('asset/stockopname/edit_draft/'.$row->hash_id);
				$rowTable[] = '<a href="'.$url_fc.'"><button class="btn btn-info">Draft</button></a>';
				$rowTable[] = '';
			}
			if($row->stock_opname_approval_status==1){
				$url_fc = base_url('asset/stockopname/stock_opname_realisasi/'.$row->hash_id);
				$rowTable[] = '<a href="'.$url_fc.'"><button class="btn btn-info">Form Created</button></a>';
				$url_update = base_url('asset/stockopname/edit/'.$row->hash_id);
				$rowTable[] = '<a href="'.$url_update.'"><button class="btn btn-primary" title="edit data"><i class="fa fa-pencil"></i></button></a>';
			}
			
			if($row->stock_opname_approval_status==2){
				$url_fcp = base_url('asset/stockopname/stock_opname_realisasi_on_progress/'.$row->hash_id);
				$rowTable[] = '<a href="'.$url_fcp.'"><button class="btn btn-primary">On Progress</button></a>';
				$url_update = base_url('asset/stockopname/edit/'.$row->hash_id);
				$rowTable[] = '<a href="'.$url_update.'"><button class="btn btn-primary" title="edit data"><i class="fa fa-pencil"></i></button></a>';
			}
			
			if($row->stock_opname_approval_status==3){
				$url_just = base_url('asset/stockopname/stock_opname_justification/'.$row->hash_id);
				$rowTable[] = '<a href="'.$url_just.'"><button class="btn btn-warning">Need Justification</button></a>';
				$url_update = base_url('asset/stockopname/edit/'.$row->hash_id);
				$rowTable[] = '<a href="'.$url_update.'"><button class="btn btn-primary" title="edit data"><i class="fa fa-pencil"></i></button></a>';
			}
			
			if($row->stock_opname_approval_status==4){
			  $url_app = base_url('asset/stockopname/stock_opname_approval/'.$row->hash_id);
			  $rowTable[] = '<a href="'.$url_app.'"><button class="btn btn-warning">Need Approval</button></a>';
			  $url_justification = base_url('asset/stockopname/stock_opname_justification/'.$row->hash_id);
			  $rowTable[] = '<a href="'.$url_justification.'"><button class="btn btn-default" title="View Detail"><i class="fa fa-search"></i></button></a>';
			}
			
			if($row->stock_opname_approval_status==5){
			  $rowTable[] = '<span class="status-done">Done</span>';
			  $url_justification = base_url('asset/stockopname/stock_opname_justification/'.$row->hash_id);
			  $rowTable[] = '<a href="'.$url_justification.'"><button class="btn btn-default" title="View Detail"><i class="fa fa-search"></i></button></a>';
			}
			
			$data[] = $rowTable;
		}
		$output = array(
		  "draw" => $_POST['draw'],
		  "recordsTotal" => $this->stock_opname_model->count_get_all_stockopname(),
		  "recordsFiltered" => $this->stock_opname_model->count_get_all_stockopname_filtered($field,$value1),
		  "data" => $data,
		);
		echo json_encode($output);
	}
	
	function stock_opname_justification($id) {
		$data['stock_opname']=$this->stock_opname_model->get_stock_opname($id);
		$data['asset'] = $this->stock_opname_model->get_stock_opname_asset($id);
		$data['inventory'] = $this->stock_opname_model->get_stock_opname_inventory($id);
		$this->_view($this->path.'/stock_opname_justification',$data);
	}
	
	function stock_opname_approval($id) {
		$data['stock_opname']=$this->stock_opname_model->get_stock_opname($id);
		$data['asset'] = $this->stock_opname_model->get_stock_opname_asset($id);
		$data['inventory'] = $this->stock_opname_model->get_stock_opname_inventory($id);
		$this->_view($this->path.'/stock_opname_approval',$data);
	}
	
	function stock_opname_variance_list(){
		
		$this->_view($this->path.'/stock_opname_variance_list');
	}
	
	function stock_opname_realisasi($id){
		$data['asset']=$this->stock_opname_model->get_stock_opname_asset($id);
		$data['inventory']=$this->stock_opname_model->get_stock_opname_inventory($id);
		$data['stock_opname']=$this->stock_opname_model->get_stock_opname($id);
		$data['jumlah_asset']=count($data['asset']);
		$data['jumlah_inventory']=count($data['inventory']);
		$this->_view($this->path.'/stock_opname_realisasi',$data);
	}
	
	function update_realisasi(){
		$changedAsset= explode(",",$this->input->post('changedAsset'));
		$changedInventory= explode(",",$this->input->post('changedInventory'));
		if($this->input->post('changedAsset') != ""){
			for($i=0;$i<count($changedAsset);$i++){
				$id=$this->input->post("detailAsset_id".$changedAsset[$i]);
				$actual_stockAsset=$this->input->post("actual_stockAsset".$changedAsset[$i]);
				$remarksAsset=$this->input->post("remarksAsset".$changedAsset[$i]);

				$data=array(
					"stock_opname_asset_detail_actual_stock" => $actual_stockAsset,
					"stock_opname_asset_detail_remarks"=>$remarksAsset
				);
				$this->stock_opname_model->updateAsset($data,$id);
			}
		}
		
		
		if($this->input->post('changedInventory') != ""){
			for($i=0;$i<count($changedInventory);$i++){
				$id=$this->input->post("detailInventory_id".$changedInventory[$i]);
				$actual_stockInventory=$this->input->post("actual_stockInventory".$changedInventory[$i]);
				$remarksInvetory=$this->input->post("remarksInvetory".$changedInventory[$i]);
				$data=array(
					"stock_opname_inventory_detail_actual_stock" => $actual_stockInventory,
					"stock_opname_inventory_detail_remarks"=>$remarksInvetory
				);
				$this->stock_opname_model->updateInventory($data,$id);
			}
		}
		
		$this->stock_opname_model->stock_opname($this->input->post('stock_opname_id'),$this->input->post('status_stock_opname_id'));
		redirect('asset/stockopname/index');
		
	}
	
	function stock_opname_realisasi_on_progress($id){
		$data['asset']=$this->stock_opname_model->get_stock_opname_asset($id);
		$data['inventory']=$this->stock_opname_model->get_stock_opname_inventory($id);
		$data['stock_opname']=$this->stock_opname_model->get_stock_opname($id);
		$data['jumlah_asset']=count($data['asset']);
		$data['jumlah_inventory']=count($data['inventory']);
		$this->_view($this->path.'/stock_opname_realisasi_on_progress',$data);
	}
	
	function update_realisasi_progress(){
		$changedAsset= explode(",",$this->input->post('changedAsset'));
		$changedInventory= explode(",",$this->input->post('changedInventory'));
		if($this->input->post('changedAsset') != ""){
			for($i=0;$i<count($changedAsset);$i++){
				$id=$this->input->post("detailAsset_id".$changedAsset[$i]);
				$actual_stockAsset=$this->input->post("actual_stockAsset".$changedAsset[$i]);
				$remarksAsset=$this->input->post("remarksAsset".$changedAsset[$i]);

				$data=array(
					"stock_opname_asset_detail_actual_stock" => $actual_stockAsset,
					"stock_opname_asset_detail_remarks"=>$remarksAsset
				);
				$this->stock_opname_model->updateAsset($data,$id);
			}
		}
		
		
		if($this->input->post('changedInventory') != ""){
			for($i=0;$i<count($changedInventory);$i++){
				$id=$this->input->post("detailInventory_id".$changedInventory[$i]);
				$actual_stockInventory=$this->input->post("actual_stockInventory".$changedInventory[$i]);
				$remarksInvetory=$this->input->post("remarksInvetory".$changedInventory[$i]);
				$data=array(
					"stock_opname_inventory_detail_actual_stock" => $actual_stockInventory,
					"stock_opname_inventory_detail_remarks"=>$remarksInvetory
				);
				$this->stock_opname_model->updateInventory($data,$id);
			}
		}
		
		$this->stock_opname_model->stock_opname($this->input->post('stock_opname_id'),$this->input->post('status_stock_opname_id'));
		redirect('asset/stockopname/index');
		
	}
	
	function replace_str($kata){
		return str_replace(" ","~",$kata);
	}
	
	function get_asset_list(){
		$warehouse = $this->input->post('warehouse');
		$filter1 = $this->input->post('filter1');
		$value1 = $this->input->post('value1');
		$ass = $this->input->post('ass');
		if(!$ass){
			$ass = array();
		}
		if($warehouse!=''){
			$warehouseExp=explode('~',$warehouse);
			if(count($warehouseExp)>0){
				$warehouse=$warehouseExp[1];
			}else{
				$warehouse="";
			}
		}
		$aset = $this->stock_opname_model->get_asset_list($filter1,$value1,$warehouse)->result();
		$data = array();
		$no = $_POST['start'];
		foreach ($aset as $row) {
			$no++;
			$rowTable = array();
			$rowTable[] = $row->asset_code;
			$rowTable[] = $row->asset_name;
			$rowTable[] = $row->asset_serial_number;
			$rowTable[] = $row->manufacture_id;
			$asset_id="'".$row->asset_id."'";
			$asset_name="'".$this->replace_str($row->asset_name)."'";
			$department_name="'".$this->replace_str($row->department_name)."'";
			$asset_code = "'".$this->replace_str($row->asset_code)."'";
			$asset_serial_number="'".$this->replace_str($row->asset_serial_number)."'";
			if(in_array($row->asset_id,$ass)){
				$status="<input type='checkbox' name='chk' onclick=createTableAsset(".$asset_id.",".$asset_name.",".$department_name.",".$asset_serial_number.",".$asset_code.") checked>";
			}else{
				$status="<input type='checkbox' name='chk' onclick=createTableAsset(".$asset_id.",".$asset_name.",".$department_name.",".$asset_serial_number.",".$asset_code.")>";
			}
			$rowTable[] = $status;
			$data[] = $rowTable;
		}
		$output = array(
		  "draw" => $_POST['draw'],
		  "recordsTotal" => $this->stock_opname_model->get_all_asset_list($warehouse),
		  "recordsFiltered" => $this->stock_opname_model->count_asset_list_filtered($filter1,$value1,$warehouse),
		  "data" => $data,
		);
		echo json_encode($output);
	}
	
	function get_inventory_list(){
		$warehouse = $this->input->post('warehouse');
		$filter1 = $this->input->post('filter1');
		$value1 = $this->input->post('value1');
		$inv = $this->input->post('inv');
		if(!$inv){
			$inv = array();
		}
		if($warehouse!=''){
			$warehouseExp=explode('~',$warehouse);
			if(count($warehouseExp)>0){
				$warehouse=$warehouseExp[1];
			}else{
				$warehouse="";
			}
		}
		$users = $this->stock_opname_model->get_inventory_list($filter1,$value1,$warehouse)->result();
		$data = array();
		$no = $_POST['start'];
		foreach ($users as $row) {
			$no++;
			$rowTable = array();
			$rowTable[] = $row->inventory_code;
			$rowTable[] = $row->inventory_name;
			$rowTable[] = $row->inventory_part_number;	
			$inventory_id="'".$this->replace_str($row->inventory_id)."'";
			$inventory_name="'".$this->replace_str($row->inventory_name)."'";
			$department_name="'".$this->replace_str($row->department_name)."'";
			$inventory_code="'".$this->replace_str($row->inventory_code)."'";
			$inventory_part_number="'".$this->replace_str($row->inventory_part_number)."'";
			if(in_array($row->inventory_id,$inv)){
				$status="<input type='checkbox' name='chk' onclick=createTableInventory(".$inventory_id.",".$inventory_name.",".$inventory_part_number.",".$department_name.",".$inventory_code.") checked>";
			}else{
				$status="<input type='checkbox' name='chk' onclick=createTableInventory(".$inventory_id.",".$inventory_name.",".$inventory_part_number.",".$department_name.",".$inventory_code.")>";
			}
			$rowTable[] = $status;
			$data[] = $rowTable;
		}
		$output = array(
		  "draw" => $_POST['draw'],
		  "recordsTotal" =>$this->stock_opname_model->get_all_inventory_list($warehouse),
		  "recordsFiltered" =>$this->stock_opname_model->count_inventory_list_filtered($filter1,$value1,$warehouse),
		  "data" => $data,
		);
		echo json_encode($output);
	}

}
