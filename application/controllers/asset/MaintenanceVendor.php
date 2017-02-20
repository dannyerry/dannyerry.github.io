<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MaintenanceVendor extends MY_Controller {

	public $path = "asset/vendor";
	
	function __construct() {
        parent::__construct();
		$this->load->model('stock_transfer_model');
		$this->load->model('maintenance_vendor_model');
		$this->load->library('session');
    }
	
	function create_unique_contract_number(){
		$data = $this->maintenance_vendor_model->get_unique_contract_number();
		if(empty($data)){
			return 'amv_1';
		}else{
			$jadi = explode('_',$data->contract_number);
			$data = $jadi[1]+1;
			return 'amv_'.$data;
		}
	}
	
	
	function index() {
		$this->_view($this->path.'/index');
	}

	function detail($hash_id) {
		$this->_view($this->path.'/detail');
	}

	function insert() {
		$data['vendor_name'] = $this->maintenance_vendor_model->getVendor()->result();
		$data['contract_cat'] = $this->maintenance_vendor_model->get_contract_cat()->result();
		$data['unique_code'] = $this->create_unique_contract_number();
		$this->_view($this->path.'/add',$data);
	}

	function do_insert() {
		$code = $this->create_unique_contract_number();
		$contract_category = $this->input->post('contract_category');
		$vendor_name = $this->input->post('vendor_name');
		$contratc_desc = $this->input->post('contratc_desc');
		$contract_signed = $this->input->post('contract_signed');
		$contract_expired = $this->input->post('contract_expired');
		$contract_value = $this->input->post('contract_value');
		$dataInsert=array( 
			'contract_number' => $code,
			'contract_category_id' => $contract_category,
			'contract_desc' => $contratc_desc,
			'contract_signed' => $contract_signed,
			'contract_expired'=> $contract_expired,
			'contract_value'=> $contract_value,
			'vendor_id' => $vendor_name,
			'hash_id'=>$this->create_hash_id('amos_maintenance_vendor')
		);
		$transfer = $this->maintenance_vendor_model->insert($dataInsert);
		
		redirect('asset/MaintenanceVendor/index');
	}
	
	function inputVendor () {
		$input_vendor_name =  $this->input->post('input_vendor_name');
		$input_vendor_address =  $this->input->post('input_vendor_address');
		$data = array (
			'vendor_name' => $input_vendor_name,
			'vendor_address' => $input_vendor_address
		);
		$this->maintenance_vendor_model->insertVendor($data);
	}
	
	function getVendor(){
		$data = $this->maintenance_vendor_model->getVendor()->result();
		echo json_encode($data);
	}

	function update($hash_id) {
		$data['vendor_name'] = $this->maintenance_vendor_model->getVendor()->result();
		$data['contract_cat'] = $this->maintenance_vendor_model->get_contract_cat()->result();
		$data['maintenance_vendor'] = $this->maintenance_vendor_model->get_maintenance_vendor($hash_id);
		//var_dump($data['maintenance_vendor']); die();
		$this->_view($this->path.'/update',$data);
	}

	function do_update() {
		$id = $this->input->post('id');
		$contract_category = $this->input->post('contract_category');
		$vendor_name = $this->input->post('vendor_name');
		$contratc_desc = $this->input->post('contratc_desc');
		$contract_signed = $this->input->post('contract_signed');
		$contract_expired = $this->input->post('contract_expired');
		$contract_value = $this->input->post('contract_value');
		$dataUpdate=array( 
			'contract_category_id' => $contract_category,
			'contract_desc' => $contratc_desc,
			'contract_signed' => $contract_signed,
			'contract_expired'=> $contract_expired,
			'contract_value'=> $contract_value,
			'vendor_id' => $vendor_name
		);
		$transfer = $this->maintenance_vendor_model->update_maintenance_vendor($dataUpdate,$id);
		
		redirect('asset/MaintenanceVendor/index');
    
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
	
	function get_maintenance_vendor_list(){
		$filter1 = $this->input->post('filter1');
		$value1 = $this->input->post('value1');		
		$users = $this->maintenance_vendor_model->get_maintenance_vendor_list($filter1,$value1)->result();
		$data = array();
		$no = $_POST['start'];
		foreach ($users as $row) {
			$no++;
			$rowTable = array();
			$rowTable[] = $no;
			$rowTable[] = $row->contract_number;
			$rowTable[] = $row->contract_category_name;
			$rowTable[] = date('d/m/Y',strtotime($row->contract_signed));
			$rowTable[] = date('d/m/Y',strtotime($row->contract_expired));
			$rowTable[] = $row->contract_value;
			$link_edit = base_url('asset/MaintenanceVendor/update/'.$row->hash_id);
			$rowTable[] = '<a href="'.$link_edit.'"><button class="btn btn-primary" title="Edit"><i class="fa fa-pencil"></i></button></a>';
			
			
			
			$data[] = $rowTable;
		}
		$output = array(
		  "draw" => $_POST['draw'],
		  "recordsTotal" => $this->maintenance_vendor_model->get_all_maintenance_vendor_list(),
		  "recordsFiltered" => $this->maintenance_vendor_model->count_maintenance_vendor_list($filter1,$value1),
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
