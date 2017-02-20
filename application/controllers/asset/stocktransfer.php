<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Stocktransfer extends MY_Controller {

	public $path = "asset/stock transfer";
	
	function __construct() {
        parent::__construct();
		$this->load->model('stock_transfer_model');
		$this->load->library('session');
    }
	
	function generate_unique_code(){
		//var_dump($this->stock_transfer_model->get_last_row()->result()); die();
		foreach($this->stock_transfer_model->get_last_row()->result() as $r){
			$data = explode('_',$r->stock_transfer_id);
		}
		
		if(empty($data[1])){
			$code = 'TR_1';
		}else{
			$code = 'TR_'.$data[1]+1;
		}
		return $code;
		
	}
	
	function index() {
		$this->_view($this->path.'/index');
	}

	function detail($hash_id) {
		$this->_view($this->path.'/detail');
	}

	function insert() {
		$data['code'] = $this->generate_unique_code();
		$data['warehouse']=$this->stock_transfer_model->get_warehouse_list()->result();
		$data['asset'] = json_encode(array());
		$data['inventory'] = json_encode(array());
		$this->_view($this->path.'/add',$data);
	}

	function do_insert() {
		$code = $this->generate_unique_code();
		$dueDate = $this->input->post('duedate');
		$reference = $this->input->post('reference');
		$referencea = $this->input->post('referencea');
		$priority = $this->input->post('priority');
		$notes = $this->input->post('notes');
		$warehouse_from = $this->input->post('warehouse_from');
		$warehouse_to = $this->input->post('warehouse_to');
		$initiateDate= date('Y-m-d');
		$arrayDataInsertInventory = json_decode($this->input->post('arrayDataInsertInventory'));
		$arrayDataInsertAsset = json_decode($this->input->post('arrayDataInsertAsset'));
		$user =  $this->session->userdata('assets');
		$dataInsert=array( 
			'stock_transfer_code' => $code,
			'created_by' => $user['employee_id'],
			'stock_transfer_initiate_date' => date('Y-m-d'),
			'stock_transfer_due_date' => $dueDate,
			'stock_transfer_priority'=> $priority,
			'from_warehouse_id'=> $warehouse_from,
			'to_warehouse_id'=> $warehouse_to,
			'stock_transfer_approval_status'=> '1',
			'stock_transfer_notes'=> $notes,
			'hash_id'=>$this->create_hash_id('amos_stock_transfer')
		);
		$transfer = $this->stock_transfer_model->insert($dataInsert);
		
		for($i=0;$i<count($arrayDataInsertInventory);$i++){
			$reuqest = $this->input->post('rqinventory'.$arrayDataInsertInventory[$i]);
			$note = $this->input->post('noteinventory'.$arrayDataInsertInventory[$i]);
			$dataInsert =  array(
				'stock_transfer_id' => $transfer,
				'inventory_id' => $arrayDataInsertInventory[$i],
				'stock_transfer_inventory_detail_qty_requested' => $reuqest,
				'stock_transfer_inventory_detail_note' => $note
			);
			
			$this->stock_transfer_model->insert_inventory($dataInsert);
		}
		
		for($j=0;$j<count($arrayDataInsertAsset);$j++){
			$reuqest = $this->input->post('rqasset'.$arrayDataInsertAsset[$j]);
			$note = $this->input->post('noteasset'.$arrayDataInsertAsset[$j]);
			$dataInsert =  array(
				'stock_transfer_id' => $transfer,
				'asset_id' => $arrayDataInsertAsset[$j],
				'stock_transfer_asset_detail_qty_requested' => $reuqest,
				'stock_transfer_asset_detail_note' => $note
			);
			
			$this->stock_transfer_model->insert_asset($dataInsert);
		}
		redirect('asset/stocktransfer/index');
	}

	function update($hash_id) {
		$data['stock_transfer'] = $this->stock_transfer_model->get_stock_transfer($hash_id);
		$data['warehouse'] = $this->stock_transfer_model->get_warehouse_list()->result();
		$assetPicked = $this->stock_transfer_model->get_stock_transfer_asset($hash_id);
		$inventoryPicked = $this->stock_transfer_model->get_stock_transfer_inventory($hash_id);
		$asset = array();
		$inventory = array();
		
		foreach($assetPicked as $a){
			$asset[] = $a->asset_id;
		}
		
		foreach($inventoryPicked as $i){
			$inventory[] = $i->inventory_id;
		}
		$data['assetPicked'] = $assetPicked;
		$data['inventoryPicked'] = $inventoryPicked;
		$data['assetArr'] = $asset;
		$data['inventoryArr'] = $inventory;
		$data['asset'] = json_encode($asset);
		$data['inventory'] = json_encode($inventory);
		$this->_view($this->path.'/update',$data);
	}

	function do_update() {
		$id = $this->input->post('st_id');
		$dueDate = $this->input->post('duedate');
		$reference = $this->input->post('reference');
		$referencea = $this->input->post('referencea');
		$priority = $this->input->post('priority');
		$notes = $this->input->post('notes');
		$warehouse_from = $this->input->post('warehouse_from');
		$warehouse_to = $this->input->post('warehouse_to');
		$arrayDataInsertInventory = $this->input->post('arrayDataInsertInventory');
		$arrayDataInsertAsset = $this->input->post('arrayDataInsertAsset');
		$dataUpdate=array( 
			'stock_transfer_due_date' => $dueDate,
			'stock_transfer_priority'=> $priority,
			'from_warehouse_id'=> $warehouse_from,
			'to_warehouse_id'=> $warehouse_to,
			'stock_transfer_notes'=> $notes,
		);
		$this->stock_transfer_model->update_stock_transfer($dataUpdate,$id);
		$this->stock_transfer_model->delete_stock_transfer_asset($id);
		$this->stock_transfer_model->delete_stock_transfer_inventory($id);
		
		$arrayDataInsertInventoryPecah = explode(',',$arrayDataInsertInventory);
		for($i=0;$i<count($arrayDataInsertInventoryPecah);$i++){
			$reuqest = $this->input->post('rqinventory'.$arrayDataInsertInventoryPecah[$i]);
			$note = $this->input->post('noteinventory'.$arrayDataInsertInventoryPecah[$i]);
			$dataInsert =  array(
				'stock_transfer_id' => $id,
				'inventory_id' => $arrayDataInsertInventoryPecah[$i],
				'stock_transfer_inventory_detail_qty_requested' => $reuqest,
				'stock_transfer_inventory_detail_note' => $note
			);
			
			if($arrayDataInsertInventoryPecah[$i] != ''){
				$this->stock_transfer_model->insert_inventory($dataInsert);
			}
		}
		
		$arrayDataInsertAssetPecah = explode(',',$arrayDataInsertAsset);
		for($j=0;$j<count($arrayDataInsertAssetPecah);$j++){
			$reuqest = $this->input->post('rqasset'.$arrayDataInsertAssetPecah[$j]);
			$note = $this->input->post('noteasset'.$arrayDataInsertAssetPecah[$j]);
			$dataInsert =  array(
				'stock_transfer_id' => $id,
				'asset_id' => $arrayDataInsertAssetPecah[$j],
				'stock_transfer_asset_detail_qty_requested' => $reuqest,
				'stock_transfer_asset_detail_note' => $note
			);
			if($arrayDataInsertAssetPecah[$j] != ''){
					$this->stock_transfer_model->insert_asset($dataInsert);
			}
		}
		
		
		
    
	}

	function approval($hash_id) {
		$data['stock_transfer'] = $this->stock_transfer_model->get_stock_transfer($hash_id);
		$data['warehouse'] = $this->stock_transfer_model->get_warehouse_list()->result();
		$assetPicked = $this->stock_transfer_model->get_stock_transfer_asset($hash_id);
		$inventoryPicked = $this->stock_transfer_model->get_stock_transfer_inventory($hash_id);
		$data['assetPicked'] = $assetPicked;
		$data['inventoryPicked'] = $inventoryPicked;
		$this->_view($this->path.'/approval',$data);
	}
	
	function do_approval(){
		$changedAsset = $this->input->post('changedAsset');
		$changedInventory = $this->input->post('changedInventory');
		$changedAssetPecah = explode(',',$changedAsset);
		$changedInventoryPecah = explode(',',$changedInventory);
		$id = $this->input->post('st_id');
		$dataUpdate = array (
			'stock_transfer_approval_status' => 2
		);
		$this->stock_transfer_model->update_stock_transfer($dataUpdate,$id);
		for($i=0;$i<count($changedAssetPecah);$i++){
			$deductionAsset = $this->input->post('deductionAsset'.$changedAssetPecah[$i]);
			$id = $this->input->post('assetId'.$changedAssetPecah[$i]);
			$data = array(
				'stock_transfer_asset_detail_deduction' => $deductionAsset
			);
			$this->stock_transfer_model->update_stock_transfer_detail_asset($data,$id);
		}
		
		for($j=0;$j<count($changedInventoryPecah);$j++){
			$deductionInventory = $this->input->post('deductionInventory'.$changedInventoryPecah[$j]);
			$id = $this->input->post('inventoryId'.$changedInventoryPecah[$j]);
			$data = array(
				'stock_transfer_inventory_detail_deduction' => $deductionInventory
			);
			$this->stock_transfer_model->update_stock_trnasfer_detail_inv($data,$id);
		}
		
		redirect('asset/stocktransfer/index');
	}
	
	function view($hash_id){
		
	}
	
	function delete($hash_id) {
    
	}
	
	function get_stock_transfer_list(){
		$filter1 = $this->input->post('filter1');
		$value1 = $this->input->post('value1');		
		$users = $this->stock_transfer_model->get_stock_transfer_list($filter1,$value1)->result();
		$data = array();
		$no = $_POST['start'];
		foreach ($users as $row) {
			$no++;
			$rowTable = array();
			$rowTable[] = $no;
			$rowTable[] = $row->stock_transfer_code;
			$rowTable[] = $row->warehouse_from;
			$rowTable[] = $row->warehouse_to;
			$rowTable[] = date('d/m/Y',strtotime($row->stock_transfer_due_date));
			$rowTable[] = date('d/m/Y',strtotime($row->stock_transfer_initiate_date));
			$rowTable[] = $row->employee_name;
			if($row->stock_transfer_approval_status==3){
				$rowTable[] = '<span class="status-undone">Rejected</span>';
				$link = base_url('dashboard/stocktransfer/detail/'.$row->hash_id);
				$rowTable[] = '<a href="'.$link.'"><button class="btn btn-default" title="View"><i class="fa fa-search"></i></button></a>';
			}else if($row->stock_transfer_approval_status==2){
				$rowTable[] = '<span class="status-done">Approved</span>';
				$link = base_url('dashboard/stocktransfer/detail/'.$row->hash_id);
				$rowTable[] = '<a href="'.$link.'"><button class="btn btn-default" title="View"><i class="fa fa-search"></i></button></a>';
			}else if($row->stock_transfer_approval_status==1){
				$link = base_url('asset/stocktransfer/approval/'.$row->hash_id);
				$rowTable[] = '<a href="'.$link.'">
										<button class="btn btn-warning" title="need approval">Need Approval</button>
							</a>';
				$link_edit = base_url('asset/stocktransfer/update/'.$row->hash_id);
				$rowTable[] = '<a href="'.$link_edit.'"><button class="btn btn-primary" title="Edit"><i class="fa fa-pencil"></i></button></a>
				<a href="#"><button class="btn btn-danger" title="Delete"><i class="fa fa-close"></i></button></a>';
				//$link_edit = base_url('dashboard/stock_transfer_edit'.$row->stock_transfer_id);
				
			}
			
			
			$data[] = $rowTable;
		}
		$output = array(
		  "draw" => $_POST['draw'],
		  "recordsTotal" => $this->stock_transfer_model->get_all_stock_transfer_list(),
		  "recordsFiltered" => $this->stock_transfer_model->count_stock_transfer_list($filter1,$value1),
		  "data" => $data,
		);
		echo json_encode($output);
	}
	
	function replace_str($kata){
		return str_replace(" ","~",$kata);
	}
	
	
	function get_asset_list(){
		$warehouse = $this->input->post('warehouse');
		$filter1 = $this->input->post('filter1');
		$value1 = $this->input->post('value1');
		$ass = $this->input->post('ass');
		//var_dump($ass);
		if(!$ass){
			$ass = array();
		}
		$asset_list = $this->stock_transfer_model->get_asset_list($filter1,$value1,$warehouse)->result();
		$data = array();
		$no = $_POST['start'];
		foreach ($asset_list as $row) {
			$no++;
			$rowTable = array();
			$rowTable[] = $row->asset_code;
			$rowTable[] = $row->asset_name;
			$rowTable[] = $row->asset_serial_number;
			//$rowTable[] = $row->manufacture_id;
			$asset_id="'".$row->asset_id."'";
			$asset_name="'".$this->replace_str($row->asset_name)."'";
			$asset_code = "'".$this->replace_str($row->asset_code)."'";
			$asset_serial_number="'".$this->replace_str($row->asset_serial_number)."'";
			$actual_Stock="'".$this->replace_str($row->actual_stock)."'";
			if(in_array($row->asset_id,$ass)){
				$status="<input type='checkbox' name='chk' checked onclick=createTableAsset(".$asset_id.",".$asset_name.",".$asset_serial_number.",".$asset_code.",".$actual_Stock.")>";
			}else{
				$status="<input type='checkbox' name='chk' onclick=createTableAsset(".$asset_id.",".$asset_name.",".$asset_serial_number.",".$asset_code.",".$actual_Stock.")>";
			}
			$rowTable[] = $status;
			$data[] = $rowTable;
		}
		$output = array(
		  "draw" => $_POST['draw'],
		  "recordsTotal" => $this->stock_transfer_model->get_all_asset_list($warehouse),
		  "recordsFiltered" => $this->stock_transfer_model->count_asset_list_filtered($filter1,$value1,$warehouse),
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
		$inv = $this->stock_transfer_model->get_inventory_list($filter1,$value1,$warehouse)->result();
		$data = array();
		$no = $_POST['start'];
		foreach ($inv as $row) {
			$no++;
			$rowTable = array();
			$rowTable[] = $row->inventory_code;
			$rowTable[] = $row->inventory_name;
			//$rowTable[] = $row->inventory_part_number;	
			$inventory_id="'".$this->replace_str($row->inventory_id)."'";
			$inventory_name="'".$this->replace_str($row->inventory_name)."'";
			$inventory_code="'".$this->replace_str($row->inventory_code)."'";
			$inventory_stock_qty="'".$this->replace_str($row->inventory_stock_qty)."'";
			$inventory_part_number="'".$this->replace_str($row->inventory_part_number)."'";
			if(in_array($row->inventory_id,$inv)){
				$status="<input type='checkbox' name='chk' checked onclick=createTableInventory(".$inventory_id.",".$inventory_name.",".$inventory_part_number.",".$inventory_code.",".$inventory_stock_qty.")>";
			}else{
				$status="<input type='checkbox' name='chk' onclick=createTableInventory(".$inventory_id.",".$inventory_name.",".$inventory_part_number.",".$inventory_code.",".$inventory_stock_qty.")>";
			}
			$rowTable[] = $status;
			$data[] = $rowTable;
		}
		$output = array(
		  "draw" => $_POST['draw'],
		  "recordsTotal" =>$this->stock_transfer_model->get_all_inventory_list($warehouse),
		  "recordsFiltered" =>$this->stock_transfer_model->count_inventory_list_filtered($filter1,$value1,$warehouse),
		  "data" => $data,
		);
		echo json_encode($output);
	}

}
