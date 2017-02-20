<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Master extends MY_Controller {
//===================KARLINA======================
    
    function __construct(){
        parent::__construct();
        $this->load->file('asset/imageupload.php');
    }
    
    function warehouse_index(){
        $this->_view('asset/warehouse/index');
    }
    
    function get_data_warehouse() {
		$filter1 = $this->input->post('filter1');
        $value1 = $this->input->post('value1');
        $this->load->model('master_model');
        $warehouse = $this->master_model->get_warehouse($filter1, $value1)->result();
        $data = array();
        $no = $_POST['start'];
        //$no = 0;
        foreach ($warehouse as $row) {
          $no++;
          $rowTable = array();
          $rowTable[] = $no;
          $rowTable[] = $row->warehouse_name;
          $rowTable[] = $row->warehouse_address;
          $rowTable[] = $row->warehouse_location;
          $rowTable[] = $row->warehouse_phone_number;
          $rowTable[] = $row->warehouse_pic;
          $rowTable[] = $row->warehouse_description;
          $rowTable[] = $row->warehouse_status;
          $url_update = base_url('master/warehouse_edit/'.$row->hash_id);
          $url_delete = base_url('master/warehouse_delete/'.$row->hash_id);
          $rowTable[] = '<a href="'.$url_update.'"><button class="btn btn-primary" title="edit data"><i class="fa fa-pencil"></i></button></a> <a href="'.$url_delete.'"><button class="btn btn-primary" title="delete data"><i class="fa fa-remove"></i></button></a>';
          $data[] = $rowTable;
        }
        
        $output = array(
          "draw" => $_POST['draw'],
          "recordsTotal" => $this->master_model->count_get_all_warehouse(),
          "recordsFiltered" => $this->master_model->count_get_all_warehouse_filtered($filter1, $value1),
          "data" => $data,
        );
        echo json_encode($output);
    }
    
    function warehouse_add(){
        $this->_view('asset/warehouse/insert');
    }
    
    function warehouse_insert(){
        $this->load->model('master_model');
        $warehouse = $this->master_model->select_new_warehouse();
        if($warehouse->num_rows()>0){
            $data_warehouse = $warehouse->result();
            $warehouse_id = $data_warehouse[0]->warehouse_id;
            $warehouse_id = $warehouse_id + 1;
        }else{
            $warehouse_id = 1;
        }
        
        $hash_id = $this->create_hash_id('amos_warehouse');
        $data=array(
            'warehouse_id' => $warehouse_id,
            'warehouse_name' => $this->input->post('warehouse_name'),
            'warehouse_address' => $this->input->post('warehouse_address'),
            'warehouse_location' => $this->input->post('warehouse_location'),
            'warehouse_phone_number' => $this->input->post('warehouse_phone_number'),
            'warehouse_pic' => $this->input->post('warehouse_pic'),
            'warehouse_description' => $this->input->post('warehouse_description'),
            'warehouse_status' => $this->input->post('warehouse_status'),
            'hash_id' => $hash_id
        );
        
        if($this->master_model->insert_warehouse($data)){
            redirect('master/warehouse_index');
        }else{
            $this->session->set_flashdata('unsuccess', 'Sorry, Error Message');
            redirect('master/warehouse_index');
        }        
    }
    
    function warehouse_edit($hash_id){
        $this->load->model('master_model');
        $data['warehouse'] = $this->master_model->select_warehouse_by_id($hash_id)->result();
        $this->_view('asset/warehouse/update', $data);
    }
    
    function warehouse_update($hash_id){
        $data=array(
            'warehouse_name' => $this->input->post('warehouse_name'),
            'warehouse_address' => $this->input->post('warehouse_address'),
            'warehouse_location' => $this->input->post('warehouse_location'),
            'warehouse_phone_number' => $this->input->post('warehouse_phone_number'),
            'warehouse_pic' => $this->input->post('warehouse_pic'),
            'warehouse_description' => $this->input->post('warehouse_description'),
            'warehouse_status' => $this->input->post('warehouse_status'),
        );
        
        $this->load->model('master_model');
        if($this->master_model->update_warehouse($hash_id, $data)){
            redirect('master/warehouse_index');
        }else{
            $this->session->set_flashdata('unsuccess', 'Sorry, Error Message');
            redirect('master/warehouse_index');
        }
    }
    
    function warehouse_delete($hash_id){
        $this->load->model('master_model');
        $this->master_model->delete_warehouse($hash_id);
        redirect('master/warehouse_index');
    }
    
    //MANUFACTURER
    function manufacturer_index(){
        $this->_view('asset/manufacturer/index');
    }
    
    function get_data_manufacturer() {
		$filter1 = $this->input->post('filter1');
        $value1 = $this->input->post('value1');
        $this->load->model('master_model');
        $manufacturer = $this->master_model->get_manufacturer($filter1, $value1)->result();
        $data = array();
        $no = $_POST['start'];
        //$no = 0;
        foreach ($manufacturer as $row) {
          $no++;
          $rowTable = array();
          $rowTable[] = $no;
          $rowTable[] = $row->manufacturer_name;
          $rowTable[] = $row->manufacturer_address;
          $rowTable[] = $row->manufacturer_phone;
          $rowTable[] = $row->manufacturer_email;
          $url_update = base_url('master/manufacturer_edit/'.$row->hash_id);
          $url_delete = base_url('master/manufacturer_delete/'.$row->hash_id);
          $rowTable[] = '<a href="'.$url_update.'"><button class="btn btn-primary" title="Edit"><i class="fa fa-pencil"></i></button></a> <a href="'.$url_delete.'"><button class="btn btn-primary" title="Delete"><i class="fa fa-remove"></i></button></a>';
          $data[] = $rowTable;
        }
        
        $output = array(
          "draw" => $_POST['draw'],
          "recordsTotal" => $this->master_model->count_get_all_manufacturer(),
          "recordsFiltered" => $this->master_model->count_get_all_manufacturer_filtered($filter1, $value1),
          "data" => $data,
        );
        echo json_encode($output);
    }
    
    function manufacturer_add(){
        $this->_view('asset/manufacturer/insert');
    }
    
    function manufacturer_insert(){
        $hash_id = $this->create_hash_id('amos_manufacturer');
        $data=array(
            'manufacturer_name' => $this->input->post('manufacturer_name'),
            'manufacturer_address' => $this->input->post('manufacturer_address'),
            'manufacturer_phone' => $this->input->post('manufacturer_phone'),
            'manufacturer_email' => $this->input->post('manufacturer_email'),
            'hash_id' => $hash_id
        );
        $this->load->model('master_model');
        if($this->master_model->insert_manufacturer($data)){
            redirect('master/manufacturer_index');
        }else{
            $this->session->set_flashdata('unsuccess', 'Sorry, Error Message');
            redirect('master/manufacturer_index');
        }
    }
    
    function manufacturer_edit($id){
        $this->load->model('master_model');
        $data['manufacturer'] = $this->master_model->select_manufacturer_by_id($id)->result();
        $this->_view('asset/manufacturer/update', $data);
    }
    
    function manufacturer_update($id){
        $data=array(
            'manufacturer_name' => $this->input->post('manufacturer_name'),
            'manufacturer_address' => $this->input->post('manufacturer_address'),
            'manufacturer_phone' => $this->input->post('manufacturer_phone'),
            'manufacturer_email' => $this->input->post('manufacturer_email'),
        );
        
        $this->load->model('master_model');
        $this->master_model->update_manufacturer($id, $data);
        redirect('master/manufacturer_index');
    }
    
    function manufacturer_delete($id){
        $this->load->model('master_model');
        $this->master_model->delete_manufacturer($id);
        redirect('master/manufacturer_index');
    }
    
    //CATEGORY
    function category_index(){
        $this->_view('asset/category/index');
    }
    
    function get_data_category() {
		$filter1 = $this->input->post('filter1');
        $value1 = $this->input->post('value1');
        $this->load->model('master_model');
        $category = $this->master_model->get_category($filter1, $value1)->result();
        $data = array();
        $no = $_POST['start'];
        //$no = 0;
        foreach ($category as $row) {
          $no++;
          $rowTable = array();
          $rowTable[] = $no;
          $rowTable[] = $row->category_code;
          $rowTable[] = $row->category_name;
          $url_update = base_url('master/category_edit/'.$row->hash_id);
          $url_delete = base_url('master/category_delete/'.$row->hash_id);
          $rowTable[] = '<a href="'.$url_update.'"><button class="btn btn-primary" title="Edit"><i class="fa fa-pencil"></i></button></a> <a href="'.$url_delete.'"><button class="btn btn-primary" title="Delete"><i class="fa fa-remove"></i></button></a>';
          $data[] = $rowTable;
        }
        
        $output = array(
          "draw" => $_POST['draw'],
          "recordsTotal" => $this->master_model->count_get_all_category(),
          "recordsFiltered" => $this->master_model->count_get_all_category_filtered($filter1, $value1),
          "data" => $data,
        );
        echo json_encode($output);
    }
    
    function category_add(){
        $this->_view('asset/category/insert');
    }
    
    function category_insert(){
        $hash_id = $this->create_hash_id('amos_category');
        $data=array(
            'category_name' => $this->input->post('category_name'),
            'category_code' => $this->input->post('category_code'),
            'hash_id' => $hash_id
        );
        $this->load->model('master_model');
        $this->master_model->insert_category($data);
        redirect('master/category_index');
    }
    
    function category_edit($id){
        $this->load->model('master_model');
        $data['category'] = $this->master_model->select_category_by_id($id)->result();
        $this->_view('asset/category/update', $data);
    }
    
    function category_update($id){
        $data=array(
            'category_name' => $this->input->post('category_name'),
            'category_code' => $this->input->post('category_code'),
        );
        
        $this->load->model('master_model');
        $this->master_model->update_category($id, $data);
        redirect('master/category_index');
    }
    
    function category_delete($id){
        $this->load->model('master_model');
        $this->master_model->delete_category($id);
        redirect('master/category_index');
    }
    
    //DIMENSION UNIT
    public $path2 = "dimension unit";
    function dimension_unit_index(){
        $this->_view('asset/'.$this->path2.'/index');
    }
    
    function get_data_dimension_unit() {
		$filter1 = $this->input->post('filter1');
        $value1 = $this->input->post('value1');
        $this->load->model('master_model');
        $dimension_unit = $this->master_model->get_dimension_unit($filter1, $value1)->result();
        $data = array();
        $no = $_POST['start'];
        //$no = 0;
        foreach ($dimension_unit as $row) {
          $no++;
          $rowTable = array();
          $rowTable[] = $no;
          $rowTable[] = $row->dimension_unit_name;
          $url_update = base_url('master/dimension_unit_edit/'.$row->hash_id);
          $url_delete = base_url('master/dimension_unit_delete/'.$row->hash_id);
          $rowTable[] = '<a href="'.$url_update.'"><button class="btn btn-primary" title="Edit"><i class="fa fa-pencil"></i></button></a> <a href="'.$url_delete.'"><button class="btn btn-primary" title="Delete"><i class="fa fa-remove"></i></button></a>';
          $data[] = $rowTable;
        }
        
        $output = array(
          "draw" => $_POST['draw'],
          "recordsTotal" => $this->master_model->count_get_all_dimension_unit(),
          "recordsFiltered" => $this->master_model->count_get_all_dimension_unit_filtered($filter1, $value1),
          "data" => $data,
        );
        echo json_encode($output);
    }
    
    function dimension_unit_add(){
        $this->_view('asset/'.$this->path2.'/insert');
    }
    
    function dimension_unit_insert(){
        $hash_id = $this->create_hash_id('amos_dimension_unit');
        $data=array(
            'dimension_unit_name' => $this->input->post('dimension_unit_name'),
            'hash_id' => $hash_id
        );
        $this->load->model('master_model');
        $this->master_model->insert_dimension_unit($data);
        redirect('master/dimension_unit_index');
    }
    
    function dimension_unit_edit($id){
        $this->load->model('master_model');
        $data['dimension_unit'] = $this->master_model->select_dimension_unit_by_id($id)->result();
        $this->_view('asset/'.$this->path2.'/update', $data);
    }
    
    function dimension_unit_update($id){
        $data=array(
            'dimension_unit_name' => $this->input->post('dimension_unit_name'),
        );
        
        $this->load->model('master_model');
        $this->master_model->update_dimension_unit($id, $data);
        redirect('master/dimension_unit_index');
    }
    
    function dimension_unit_delete($id){
        $this->load->model('master_model');
        $this->master_model->delete_dimension_unit($id);
        redirect('master/dimension_unit_index');
    }
    
    //WEIGHT UNIT
    public $path3 = "weight unit";
    function weight_unit_index(){
        $this->_view('asset/'.$this->path3.'/index');
    }
    
    function get_data_weight_unit() {
		$filter1 = $this->input->post('filter1');
        $value1 = $this->input->post('value1');
        $this->load->model('master_model');
        $weight_unit = $this->master_model->get_weight_unit($filter1, $value1)->result();
        $data = array();
        $no = $_POST['start'];
        //$no = 0;
        foreach ($weight_unit as $row) {
          $no++;
          $rowTable = array();
          $rowTable[] = $no;
          $rowTable[] = $row->weight_unit_name;
          $url_update = base_url('master/weight_unit_edit/'.$row->hash_id);
          $url_delete = base_url('master/weight_unit_delete/'.$row->hash_id);
          $rowTable[] = '<a href="'.$url_update.'"><button class="btn btn-primary" title="Edit"><i class="fa fa-pencil"></i></button></a> <a href="'.$url_delete.'"><button class="btn btn-primary" title="Delete"><i class="fa fa-remove"></i></button></a>';
          $data[] = $rowTable;
        }
        
        $output = array(
          "draw" => $_POST['draw'],
          "recordsTotal" => $this->master_model->count_get_all_weight_unit(),
          "recordsFiltered" => $this->master_model->count_get_all_weight_unit_filtered($filter1, $value1),
          "data" => $data,
        );
        echo json_encode($output);
    }
    
    function weight_unit_add(){
        $this->_view('asset/'.$this->path3.'/insert');
    }
    
    function weight_unit_insert(){
        $hash_id = $this->create_hash_id('amos_weight_unit');
        $data=array(
            'weight_unit_name' => $this->input->post('weight_unit_name'),
            'hash_id' => $hash_id
        );
        $this->load->model('master_model');
        $this->master_model->insert_weight_unit($data);
        redirect('master/weight_unit_index');
    }
    
    function weight_unit_edit($id){
        $this->load->model('master_model');
        $data['weight_unit'] = $this->master_model->select_weight_unit_by_id($id)->result();
        $this->_view('asset/'.$this->path3.'/update', $data);
    }
    
    function weight_unit_update($id){
        $data=array(
            'weight_unit_name' => $this->input->post('weight_unit_name'),
        );
        
        $this->load->model('master_model');
        $this->master_model->update_weight_unit($id, $data);
        redirect('master/weight_unit_index');
    }
    
    function weight_unit_delete($id){
        $this->load->model('master_model');
        $this->master_model->delete_weight_unit($id);
        redirect('master/weight_unit_index');
    }
    
    //GROUP    
    function group_index(){
        $this->_view('asset/group/index');
    }
    
    function get_data_group() {
		$filter1 = $this->input->post('filter1');
        $value1 = $this->input->post('value1');
        $this->load->model('master_model');
        $group = $this->master_model->get_group($filter1, $value1)->result();
        $data = array();
        $no = $_POST['start'];
        //$no = 0;
        foreach ($group as $row) {
          $no++;
          $rowTable = array();
          $rowTable[] = $no;
          $rowTable[] = $row->group_code;
          $url_sub_group1 = base_url('master/sub_group1_index/'.$row->hash_id);
          $rowTable[] = '<a href="'.$url_sub_group1.'">'.$row->group_name.'</a>';
          $url_update = base_url('master/group_edit/'.$row->hash_id);
          $url_delete = base_url('master/group_delete/'.$row->hash_id);
          $rowTable[] = '<a href="'.$url_update.'"><button class="btn btn-primary" title="Edit"><i class="fa fa-pencil"></i></button></a> <a href="'.$url_delete.'"><button class="btn btn-primary" title="Delete"><i class="fa fa-remove"></i></button></a>';
          $data[] = $rowTable;
        }
        
        $output = array(
          "draw" => $_POST['draw'],
          "recordsTotal" => $this->master_model->count_get_all_group(),
          "recordsFiltered" => $this->master_model->count_get_all_group_filtered($filter1, $value1),
          "data" => $data,
        );
        echo json_encode($output);
    }
    
    function group_add(){
        $this->_view('asset/group/insert');
    }
    
    function group_insert(){
        $hash_id = $this->create_hash_id('amos_group');
        $data=array(
            'group_code' => $this->input->post('group_code'),
            'group_name' => $this->input->post('group_name'),
            'hash_id' => $hash_id
        );
        $this->load->model('master_model');
        $this->master_model->insert_group($data);
        redirect('master/group_index');
    }
    
    function group_edit($id){
        $this->load->model('master_model');
        $data['group'] = $this->master_model->select_group_by_id($id)->result();
        $this->_view('asset/group/update', $data);
    }
    
    function group_update($id){
        $data=array(
            'group_code' => $this->input->post('group_code'),
            'group_name' => $this->input->post('group_name'),
        );
        
        $this->load->model('master_model');
        $this->master_model->update_group($id, $data);
        redirect('master/group_index');
    }
    
    function group_delete($id){
        $this->load->model('master_model');
        $yuk = $this->master_model->get_all_by_group($id)->result_array();
        $get_sg4 = $yuk[0]['sg4'];
        $get_sg4 = explode(',',$get_sg4);
        foreach($get_sg4 as $sg4){
            $this->master_model->delete_sub_group4($sg4);
        }    
        
        $get_sg3 = $yuk[0]['sg3'];
        $get_sg3 = explode(',',$get_sg3);
        foreach($get_sg3 as $sg3){
            $this->master_model->delete_sub_group3($sg3);
        }    
        
        
        $get_sg2 = $yuk[0]['sg2'];
        $get_sg2 = explode(',',$get_sg2);
        foreach($get_sg2 as $sg2){
            $this->master_model->delete_sub_group2($sg2);
        }    
        
        
        $get_sg1 = $yuk[0]['sg1'];
        $get_sg1 = explode(',',$get_sg1);
        foreach($get_sg1 as $sg1){
            $this->master_model->delete_sub_group1($sg1);
        }    
        
        $this->master_model->delete_group($id);
        
        redirect('master/group_index');
    }
    
    //SUB GROUP 1    
    function sub_group1_index($hash_id){
        $this->load->model('master_model');
        $data['group'] = $this->master_model->select_group_by_id($hash_id)->result();
        $this->_view('asset/sub_group1/index',$data);
    }
    
    function get_data_sub_group1($g_hash_id) {
		$filter1 = $this->input->post('filter1');
        $value1 = $this->input->post('value1');
        $this->load->model('master_model');
        $sub_group1 = $this->master_model->get_sub_group1($filter1, $value1, $g_hash_id)->result();
        $data = array();
        $no = $_POST['start'];
        //$no = 0;
        foreach ($sub_group1 as $row) {
          $no++;
          $rowTable = array();
          $rowTable[] = $no;
          $rowTable[] = $row->sub_group1_code;
          $url_sub_group2 = base_url('master/sub_group2_index/'.$row->hash_id);
          $rowTable[] = '<a href="'.$url_sub_group2.'">'.$row->sub_group1_name.'</a>';
          $url_update = base_url('master/sub_group1_edit/'.$row->hash_id.'/'.$g_hash_id);
          $url_delete = base_url('master/sub_group1_delete/'.$row->hash_id.'/'.$g_hash_id);
          $rowTable[] = '<a href="'.$url_update.'"><button class="btn btn-primary" title="Edit"><i class="fa fa-pencil"></i></button></a> <a href="'.$url_delete.'"><button class="btn btn-primary" title="Delete"><i class="fa fa-remove"></i></button></a>';
          $data[] = $rowTable;
        }
        
        $output = array(
          "draw" => $_POST['draw'],
          "recordsTotal" => $this->master_model->count_get_all_sub_group1(),
          "recordsFiltered" => $this->master_model->count_get_all_sub_group1_filtered($filter1, $value1),
          "data" => $data,
        );
        echo json_encode($output);
    }
    
    function sub_group1_add($hash_id){        
        $this->load->model('master_model');
        $data['group'] = $this->master_model->select_group_by_id($hash_id)->result();
        $this->_view('asset/sub_group1/insert',$data);
    }
    
    function sub_group1_insert($g_hash_id){
        $hash_id = $this->create_hash_id('amos_sub_group1');
        $data=array(
            'group_id' => $this->input->post('group_id'),
            'sub_group1_code' => $this->input->post('sub_group1_code'),
            'sub_group1_name' => $this->input->post('sub_group1_name'),
            'hash_id' => $hash_id
        );
        $this->load->model('master_model');
        $this->master_model->insert_sub_group1($data);
        redirect('master/sub_group1_index/'.$g_hash_id);
    }
    
    function sub_group1_edit($id, $g_hash_id){
        $this->load->model('master_model');
        $data['sub_group1'] = $this->master_model->select_sub_group1_by_id($id)->result();
        $data['group'] = $this->master_model->select_group_by_id($g_hash_id)->result();
        $this->_view('asset/sub_group1/update', $data);
    }
    
    function sub_group1_update($id){
        $data=array(
            'sub_group1_code' => $this->input->post('sub_group1_code'),
            'sub_group1_name' => $this->input->post('sub_group1_name'),
        );
        
        $this->load->model('master_model');
        $this->master_model->update_sub_group1($id, $data);
        redirect('master/sub_group1_index/'.$this->input->post('g_hash_id'));
    }
    
    function sub_group1_delete($id, $g_hash_id){
        $this->load->model('master_model');
        $yuk = $this->master_model->get_all_by_sub_group1($id)->result_array();
        $get_sg4 = $yuk[0]['sg4'];
        $get_sg4 = explode(',',$get_sg4);
        foreach($get_sg4 as $sg4){
            $this->master_model->delete_sub_group4($sg4);
        }    
        
        $get_sg3 = $yuk[0]['sg3'];
        $get_sg3 = explode(',',$get_sg3);
        foreach($get_sg3 as $sg3){
            $this->master_model->delete_sub_group3($sg3);
        }    
                
        $get_sg2 = $yuk[0]['sg2'];
        $get_sg2 = explode(',',$get_sg2);
        foreach($get_sg2 as $sg2){
            $this->master_model->delete_sub_group2($sg2);
        } 
        
        $this->master_model->delete_sub_group1($id);
        redirect('master/sub_group1_index/'.$g_hash_id);
    }
    
    //SUB GROUP 2    
    function sub_group2_index($sg1_hash_id){
        $this->load->model('master_model');
        $data['sub_group1'] = $this->master_model->select_sub_group1_by_id($sg1_hash_id)->result();
        $this->_view('asset/sub_group2/index',$data);
    }
    
    function get_data_sub_group2($sg1_hash_id) {
		$filter1 = $this->input->post('filter1');
        $value1 = $this->input->post('value1');
        $this->load->model('master_model');
        $sub_group2 = $this->master_model->get_sub_group2($filter1, $value1, $sg1_hash_id)->result();
        $data = array();
        $no = $_POST['start'];
        //$no = 0;
        foreach ($sub_group2 as $row) {
          $no++;
          $rowTable = array();
          $rowTable[] = $no;
          $rowTable[] = $row->sub_group2_code;
          $url_sub_group2 = base_url('master/sub_group3_index/'.$row->hash_id);
          $rowTable[] = '<a href="'.$url_sub_group2.'">'.$row->sub_group2_name.'</a>';
          $url_update = base_url('master/sub_group2_edit/'.$row->hash_id.'/'.$sg1_hash_id);
          $url_delete = base_url('master/sub_group2_delete/'.$row->hash_id.'/'.$sg1_hash_id);
          $rowTable[] = '<a href="'.$url_update.'"><button class="btn btn-primary" title="Edit"><i class="fa fa-pencil"></i></button></a> <a href="'.$url_delete.'"><button class="btn btn-primary" title="Delete"><i class="fa fa-remove"></i></button></a>';
          $data[] = $rowTable;
        }
        
        $output = array(
          "draw" => $_POST['draw'],
          "recordsTotal" => $this->master_model->count_get_all_sub_group2(),
          "recordsFiltered" => $this->master_model->count_get_all_sub_group2_filtered($filter1, $value1),
          "data" => $data,
        );
        echo json_encode($output);
    }
    
    function sub_group2_add($sg1_hash_id){        
        $this->load->model('master_model');
        $data['sub_group1'] = $this->master_model->select_sub_group1_by_id($sg1_hash_id)->result();
        $this->_view('asset/sub_group2/insert',$data);
    }
    
    function sub_group2_insert($sg1_hash_id){
        $hash_id = $this->create_hash_id('amos_sub_group2');
        $data=array(
            'sub_group1_id' => $this->input->post('sub_group1_id'),
            'sub_group2_code' => $this->input->post('sub_group2_code'),
            'sub_group2_name' => $this->input->post('sub_group2_name'),
            'hash_id' => $hash_id
        );
        $this->load->model('master_model');
        $this->master_model->insert_sub_group2($data);
        redirect('master/sub_group2_index/'.$sg1_hash_id);
    }
    
    function sub_group2_edit($id, $sg1_hash_id){
        $this->load->model('master_model');
        $data['sub_group2'] = $this->master_model->select_sub_group2_by_id($id)->result();
        $data['sub_group1'] = $this->master_model->select_sub_group1_by_id($sg1_hash_id)->result();
        $this->_view('asset/sub_group2/update', $data);
    }
    
    function sub_group2_update($id){
        $data=array(
            'sub_group2_code' => $this->input->post('sub_group2_code'),
            'sub_group2_name' => $this->input->post('sub_group2_name'),
        );
        
        $this->load->model('master_model');
        $this->master_model->update_sub_group2($id, $data);
        redirect('master/sub_group2_index/'.$this->input->post('sg1_hash_id'));
    }
    
    function sub_group2_delete($id, $sg1_hash_id){
        $this->load->model('master_model');        
        $yuk = $this->master_model->get_all_by_sub_group2($id)->result_array();
        $get_sg4 = $yuk[0]['sg4'];
        $get_sg4 = explode(',',$get_sg4);
        foreach($get_sg4 as $sg4){
            $this->master_model->delete_sub_group4($sg4);
        }    
        
        $get_sg3 = $yuk[0]['sg3'];
        $get_sg3 = explode(',',$get_sg3);
        foreach($get_sg3 as $sg3){
            $this->master_model->delete_sub_group3($sg3);
        }
        
        $this->master_model->delete_sub_group2($id);
        redirect('master/sub_group2_index/'.$sg1_hash_id);
    }
    
    //SUB GROUP 3    
    function sub_group3_index($sg2_hash_id){
        $this->load->model('master_model');
        $data['sub_group2'] = $this->master_model->select_sub_group2_by_id($sg2_hash_id)->result();
        $this->_view('asset/sub_group3/index',$data);
    }
    
    function get_data_sub_group3($sg2_hash_id) {
		$filter1 = $this->input->post('filter1');
        $value1 = $this->input->post('value1');
        $this->load->model('master_model');
        $sub_group3 = $this->master_model->get_sub_group3($filter1, $value1, $sg2_hash_id)->result();
        $data = array();
        $no = $_POST['start'];
        //$no = 0;
        foreach ($sub_group3 as $row) {
          $no++;
          $rowTable = array();
          $rowTable[] = $no;
          $rowTable[] = $row->sub_group3_code;
          $url_sub_group3 = base_url('master/sub_group4_index/'.$row->hash_id);
          $rowTable[] = '<a href="'.$url_sub_group3.'">'.$row->sub_group3_name.'</a>';
          $url_update = base_url('master/sub_group3_edit/'.$row->hash_id.'/'.$sg2_hash_id);
          $url_delete = base_url('master/sub_group3_delete/'.$row->hash_id.'/'.$sg2_hash_id);
          $rowTable[] = '<a href="'.$url_update.'"><button class="btn btn-primary" title="Edit"><i class="fa fa-pencil"></i></button></a> <a href="'.$url_delete.'"><button class="btn btn-primary" title="Delete"><i class="fa fa-remove"></i></button></a>';
          $data[] = $rowTable;
        }
        
        $output = array(
          "draw" => $_POST['draw'],
          "recordsTotal" => $this->master_model->count_get_all_sub_group3(),
          "recordsFiltered" => $this->master_model->count_get_all_sub_group3_filtered($filter1, $value1),
          "data" => $data,
        );
        echo json_encode($output);
    }
    
    function sub_group3_add($sg2_hash_id){        
        $this->load->model('master_model');
        $data['sub_group2'] = $this->master_model->select_sub_group2_by_id($sg2_hash_id)->result();
        $this->_view('asset/sub_group3/insert',$data);
    }
    
    function sub_group3_insert($sg2_hash_id){
        $hash_id = $this->create_hash_id('amos_sub_group3');
        $data=array(
            'sub_group2_id' => $this->input->post('sub_group2_id'),
            'sub_group3_code' => $this->input->post('sub_group3_code'),
            'sub_group3_name' => $this->input->post('sub_group3_name'),
            'hash_id' => $hash_id
        );
        $this->load->model('master_model');
        $this->master_model->insert_sub_group3($data);
        redirect('master/sub_group3_index/'.$sg2_hash_id);
    }
    
    function sub_group3_edit($id, $sg2_hash_id){
        $this->load->model('master_model');
        $data['sub_group3'] = $this->master_model->select_sub_group3_by_id($id)->result();
        $data['sub_group2'] = $this->master_model->select_sub_group2_by_id($sg2_hash_id)->result();
        $this->_view('asset/sub_group3/update', $data);
    }
    
    function sub_group3_update($id){
        $data=array(
            'sub_group3_code' => $this->input->post('sub_group3_code'),
            'sub_group3_name' => $this->input->post('sub_group3_name'),
        );
        
        $this->load->model('master_model');
        $this->master_model->update_sub_group3($id, $data);
        redirect('master/sub_group3_index/'.$this->input->post('sg2_hash_id'));
    }
    
    function sub_group3_delete($id, $sg2_hash_id){
        $this->load->model('master_model');
        $yuk = $this->master_model->get_all_by_sub_group3($id)->result_array();
        $get_sg4 = $yuk[0]['sg4'];
        $get_sg4 = explode(',',$get_sg4);
        foreach($get_sg4 as $sg4){
            $this->master_model->delete_sub_group4($sg4);
        }    
        
        $this->master_model->delete_sub_group3($id);
        redirect('master/sub_group3_index/'.$sg2_hash_id);
    }
    
    //SUB GROUP 4    
    function sub_group4_index($sg3_hash_id){
        $this->load->model('master_model');
        $data['sub_group3'] = $this->master_model->select_sub_group3_by_id($sg3_hash_id)->result();
        $this->_view('asset/sub_group4/index',$data);
    }
    
    function get_data_sub_group4($sg3_hash_id) {
		$filter1 = $this->input->post('filter1');
        $value1 = $this->input->post('value1');
        $this->load->model('master_model');
        $sub_group4 = $this->master_model->get_sub_group4($filter1, $value1, $sg3_hash_id)->result();
        $data = array();
        $no = $_POST['start'];
        //$no = 0;
        foreach ($sub_group4 as $row) {
          $no++;
          $rowTable = array();
          $rowTable[] = $no;
          $rowTable[] = $row->sub_group4_code;
          $rowTable[] = $row->sub_group4_name;
          $url_update = base_url('master/sub_group4_edit/'.$row->hash_id.'/'.$sg3_hash_id);
          $url_delete = base_url('master/sub_group4_delete/'.$row->hash_id.'/'.$sg3_hash_id);
          $rowTable[] = '<a href="'.$url_update.'"><button class="btn btn-primary" title="Edit"><i class="fa fa-pencil"></i></button></a> <a href="'.$url_delete.'"><button class="btn btn-primary" title="Delete"><i class="fa fa-remove"></i></button></a>';
          $data[] = $rowTable;
        }
        
        $output = array(
          "draw" => $_POST['draw'],
          "recordsTotal" => $this->master_model->count_get_all_sub_group4(),
          "recordsFiltered" => $this->master_model->count_get_all_sub_group4_filtered($filter1, $value1),
          "data" => $data,
        );
        echo json_encode($output);
    }
    
    function sub_group4_add($sg3_hash_id){        
        $this->load->model('master_model');
        $data['sub_group3'] = $this->master_model->select_sub_group3_by_id($sg3_hash_id)->result();
        $this->_view('asset/sub_group4/insert',$data);
    }
    
    function sub_group4_insert($sg3_hash_id){
        $hash_id = $this->create_hash_id('amos_sub_group4');
        $data=array(
            'sub_group3_id' => $this->input->post('sub_group3_id'),
            'sub_group4_code' => $this->input->post('sub_group4_code'),
            'sub_group4_name' => $this->input->post('sub_group4_name'),
            'hash_id' => $hash_id
        );
        $this->load->model('master_model');
        $this->master_model->insert_sub_group4($data);
        redirect('master/sub_group4_index/'.$sg3_hash_id);
    }
    
    function sub_group4_edit($id, $sg3_hash_id){
        $this->load->model('master_model');
        $data['sub_group4'] = $this->master_model->select_sub_group4_by_id($id)->result();
        $data['sub_group3'] = $this->master_model->select_sub_group3_by_id($sg3_hash_id)->result();
        $this->_view('asset/sub_group4/update', $data);
    }
    
    function sub_group4_update($id){
        $data=array(
            'sub_group4_code' => $this->input->post('sub_group4_code'),
            'sub_group4_name' => $this->input->post('sub_group4_name'),
        );
        
        $this->load->model('master_model');
        $this->master_model->update_sub_group4($id, $data);
        redirect('master/sub_group4_index/'.$this->input->post('sg3_hash_id'));
    }
    
    function sub_group4_delete($id, $sg3_hash_id){
        $this->load->model('master_model');
        $this->master_model->delete_sub_group4($id);
        redirect('master/sub_group4_index/'.$sg3_hash_id);
    }
    
    //INVENTORY
    function inventory_index(){
        $this->_view('asset/inventory/index');
    }
    
    function get_data_inventory() {
		$filter1 = $this->input->post('filter1');
        $value1 = $this->input->post('value1');
        $this->load->model('master_model');
        $inventory = $this->master_model->get_inventory($filter1, $value1)->result();
        $data = array();
        $no = $_POST['start'];
        //$no = 0;
        foreach ($inventory as $row) {
          $dept = $this->master_model->getDept($row->i_hash_id)->result();   
          $no++;
          $rowTable = array();
          $rowTable[] = $row->inventory_code;
          $rowTable[] = $row->inventory_name;
          $rowTable[] = $row->inventory_part_number;
          $rowTable[] = $dept[0]->department_name;
          $rowTable[] = $row->warehouse_name;
          $rowTable[] = $row->inventory_rack_no;
          $rowTable[] = $row->inventory_stock_qty;
          $rowTable[] = 'Pcs';
          $url_detail = base_url('master/inventory_detail/'.$row->i_hash_id);
          $url_update = base_url('master/inventory_edit/'.$row->i_hash_id);
          $url_delete = base_url('master/inventory_delete/'.$row->i_hash_id);
          $rowTable[] = '<a href="'.$url_detail.'"><button class="btn btn-primary" title="Detail"><i class="fa fa-search"></i></button></a> <a href="'.$url_update.'"><button class="btn btn-primary" title="Edit"><i class="fa fa-pencil"></i></button></a> <a href="'.$url_delete.'"><button class="btn btn-primary" title="Delete"><i class="fa fa-remove"></i></button></a>';
          $data[] = $rowTable;
        }
        
        $output = array(
          "draw" => $_POST['draw'],
          "recordsTotal" => $this->master_model->count_get_all_inventory(),
          "recordsFiltered" => $this->master_model->count_get_all_inventory_filtered($filter1, $value1),
          "data" => $data,
        );
        echo json_encode($output);
    }
    
    function inventory_add(){
        $this->load->model('master_model');
        $inventory = $this->master_model->select_new_inventory();
        if($inventory->num_rows()>0){
            $data_inventory = $inventory->result();
            $inventory_id = $data_inventory[0]->inventory_id;
            $inventory_id = $inventory_id + 1;
        }else{
            $inventory_id = 1;
        }
        $data['warehouse'] = $this->master_model->getWarehouse()->result();
        $data['manufacturer'] = $this->master_model->getManufacturer()->result();
        $data['department'] = $this->master_model->getDepartment()->result();
        $data['category'] = $this->master_model->getCategory()->result();
        $data['weight_unit'] = $this->master_model->getWeightUnit()->result();
        $data['dimension_unit'] = $this->master_model->getDimensionUnit()->result();
        $data['group'] = $this->master_model->getGroup()->result();
        $data['inv_code'] = 'INV_'.$inventory_id;
        $this->_view('asset/inventory/insert', $data);
    }
    
    function getValue(){
		$this->load->model('master_model');
		$id = $this->input->post('id');
		$data = $this->master_model->getValue($id);
		echo json_encode($data);
	}
    
    function getValue_2(){
		$this->load->model('master_model');
		$id = $this->input->post('id');
		$data = $this->master_model->getValue_2($id);
		echo json_encode($data);
	}
    
    function inventory_insert(){
        $this->load->model('master_model');
        $hash_id = $this->create_hash_id('amos_inventory');
        $inventory = $this->master_model->select_new_inventory();
        if($inventory->num_rows()>0){
            $data_inventory = $inventory->result();
            $inventory_id = $data_inventory[0]->inventory_id;
            $inventory_id = $inventory_id + 1;
        }else{
            $inventory_id = 1;
        }
        //INVENTORY
        $data=array(
            'inventory_id' => $inventory_id,
            'inventory_parent' => $this->input->post('parent_code'),
            'inventory_group_id' => $this->input->post('group_code'),
            'inventory_sub_group_1_id' => $this->input->post('sub_group1'),
            'inventory_sub_group_2_id' => $this->input->post('sub_group2'),
            'inventory_code' => 'INV_'.$inventory_id,
            'inventory_name' => $this->input->post('inventory_name'),
            'category_id' => $this->input->post('category_code'),
            'inventory_part_number' => $this->input->post('part_number'),
            'manufacture_id' => $this->input->post('manufacturer_code'),
            'inventory_description' => $this->input->post('inventory_desc'),
            'inventory_dimension' => $this->input->post('inventory_width').'x'.$this->input->post('inventory_height'),
            'dimension_unit_id' => $this->input->post('dimension_unit'),
            'inventory_weight' => $this->input->post('inventory_weight'),
            'weight_unit_id' => $this->input->post('weight_unit'),
            'inventory_merk' => $this->input->post('inventory_merk'),
            'inventory_type' => $this->input->post('inventory_type'),
            'inventory_model' => $this->input->post('inventory_model'),
            'warehouse_id' => $this->input->post('warehouse_code'),
            'inventory_rack_no' => $this->input->post('inventory_rack_no'),
            'inventory_stock_minimum_qty' => $this->input->post('inventory_initiate_stock'),
            'inventory_stock_qty' => 100,
            //'inventory_file' => 'inventory_file',
            //'inventory_file_caption' => $this->input->post('inventory_caption'),
            'inventory_procurement_schedule' => date('y/m/d'),
            'inventory_density' => $this->input->post('inventory_density'),
            //'inventory_photo' => 'asset/dist/img/da.JPEG',
            'inventory_status' => 1,
            'hash_id' => $hash_id,      
        );
        
        $this->master_model->insert_inventory($data);
        
        //INVENTORY DEPARTMENT
        $department = $this->master_model->getDepartment()->result_array();
        foreach($department as $d){
            if($this->input->post('department_'.$d['department_id'])){
                $data=array(
                    'inventory_id' => $inventory_id,
                    'department_id' => $this->input->post('department_'.$d['department_id']),
                );
                $this->master_model->insert_inventory_department($data);
            }
        }
        
        //INVENTORY IMAGE
        $inventory_img = $this->master_model->select_new_inventory_image();
        if($inventory_img->num_rows()>0){
            $data_inventory_img = $inventory_img->result();
            $inventory_img_id = $data_inventory[0]->inventory_image_id;
            $inventory_img_id = $inventory_img_id + 1;
        }else{
            $inventory_img_id = 1;
        }
        
        $files['name'] = $_FILES['inventory_image']['name'];
        $files['type'] = $_FILES['inventory_image']['type'];
        $files['tmp_name'] = $_FILES['inventory_image']['tmp_name'];
        $nama = (str_replace(" ", "_", $this->input->post('inventory_name'))).'_'.$inventory_img_id;
        imageupload::uploadImageCreateClone($nama, $files, 1400, 'asset/dist/img/inventory/');
        
        $ext = pathinfo('asset/dist/img/inventory/'.$files['name'], PATHINFO_EXTENSION);
		$inventory_image="asset/dist/img/inventory/".$nama.".".$ext;
        
        $data_img = array(
            'inventory_id' => $inventory_id,
            'inventory_image' => $inventory_image,
        );
        $this->master_model->insert_inventory_image($data_img);
        
        redirect('master/inventory_index');
    }
    
    function inventory_detail($id){
        $this->load->model('master_model');        
        $data['inventory'] = $this->master_model->select_inventory_by_id($id)->result();
        $data['inventory_image'] = $this->master_model->getInvImg($id)->result();
        $data['department_name'] = $this->master_model->getDept($id)->result();   
        $data['group'] = $this->master_model->getGroup_by_id($id)->result();   
        $this->_view('asset/inventory/detail', $data);
    }
    
    function inventory_edit($id){
        $this->load->model('master_model');
        $data['inventory'] = $this->master_model->select_inventory_by_id($id)->result();
        $data['warehouse'] = $this->master_model->getWarehouse()->result();
        $data['manufacturer'] = $this->master_model->getManufacturer()->result();
        $data['department'] = $this->master_model->getDepartment()->result();
        $data['dept'] = $this->master_model->getDept($id)->result();
        $data['category'] = $this->master_model->getCategory()->result();
        $data['weight_unit'] = $this->master_model->getWeightUnit()->result();
        $data['dimension_unit'] = $this->master_model->getDimensionUnit()->result();
        $data['group'] = $this->master_model->getGroup()->result();
        $data['sub_group1'] = $this->master_model->getSub_group1($data['inventory'][0]->inventory_group_id)->result();
        $data['sub_group2'] = $this->master_model->getSub_group2($data['inventory'][0]->inventory_sub_group_1_id)->result();
        $data['inventory_image'] = $this->master_model->getInvImg($id)->result();
        
        $this->_view('asset/inventory/update', $data);
    }
    
    function inventory_update($id){
        $this->load->model('master_model');  
        //INVENTORY
        $data_inv = array(
            //'inventory_id' => $inventory_id,
            'inventory_parent' => $this->input->post('parent_code'),
            'inventory_group_id' => $this->input->post('group_code'),
            'inventory_sub_group_1_id' => $this->input->post('sub_group1'),
            'inventory_sub_group_2_id' => $this->input->post('sub_group2'),
            //'inventory_code' => 'INV_'.$inventory_id,
            'inventory_name' => $this->input->post('inventory_name'),
            'category_id' => $this->input->post('category_code'),
            'inventory_part_number' => $this->input->post('part_number'),
            'manufacture_id' => $this->input->post('manufacturer_code'),
            'inventory_description' => $this->input->post('inventory_desc'),
            'inventory_dimension' => $this->input->post('inventory_width').'x'.$this->input->post('inventory_height'),
            'dimension_unit_id' => $this->input->post('dimension_unit'),
            'inventory_weight' => $this->input->post('inventory_weight'),
            'weight_unit_id' => $this->input->post('weight_unit'),
            'inventory_merk' => $this->input->post('inventory_merk'),
            'inventory_type' => $this->input->post('inventory_type'),
            'inventory_model' => $this->input->post('inventory_model'),
            'warehouse_id' => $this->input->post('warehouse_code'),
            'inventory_rack_no' => $this->input->post('inventory_rack_no'),
            'inventory_stock_minimum_qty' => $this->input->post('inventory_initiate_stock'),
            //'inventory_stock_qty' => 100,
            //'inventory_file' => 'inventory_file',
            //'inventory_file_caption' => $this->input->post('inventory_caption'),
            //'inventory_procurement_schedule' => date('y/m/d'),
            'inventory_density' => $this->input->post('inventory_density'),
            //'inventory_photo' => 'asset/dist/img/da.JPEG',
            //'hash_id' => $hash_id,          
        );
         
        if($this->master_model->update_inventory($id, $data_inv))
        
        //INVENTORY DEPARTMENT
        $this->master_model->delete_inventory_department($this->input->post('inventory_id'));
        $department = $this->master_model->getDepartment()->result_array();
        foreach($department as $d){
            if($this->input->post('department_'.$d['department_id'])){
                $data=array(
                    'inventory_id' => $this->input->post('inventory_id'),
                    'department_id' => $this->input->post('department_'.$d['department_id']),
                );
                $this->master_model->insert_inventory_department($data);
            }
        }
        
        //INVENTORY IMAGE   
        $files['name'] = $_FILES['inventory_image']['name'];
        $files['type'] = $_FILES['inventory_image']['type'];
        $files['tmp_name'] = $_FILES['inventory_image']['tmp_name'];
        $nama = (str_replace(" ", "_", $this->input->post('inventory_name'))).'_'.$this->input->post('inventory_img_id');
             
        if (!empty($_FILES["inventory_image"]['name'])) {
            if (file_exists('./'.$this->input->post('inventory_img'))) {
                unlink('./'.$this->input->post('inventory_img'));
            }
            $ext = end((explode(".", $_FILES['inventory_image']['name'])));
            $img1 = "asset/dist/img/inventory/".$nama.".".$ext;
            imageupload::uploadImageCreateClone($nama, $files, 400, 'asset/dist/img/inventory/');
        } else {
            if (file_exists($this->input->post('inventory_img'))) {
                $oldImg1 = $this->input->post('inventory_img');
                $break = explode('.',$oldImg1);
                $img1 = "asset/dist/img/inventory/".$nama.".".$break[1];
                if(file_exists($oldImg1)){
                    rename("./".$oldImg1, "./".$img1);   
                }
            }else{
                $img1=$this->input->post('inventory_img');
            }
        }
        
        $data=array(
            'inventory_image' => $img1,
        );
        
        $this->master_model->update_inventory_image($this->input->post('inventory_img_id'), $data);
        
        redirect('master/inventory_index');
    }
    
    function inventory_delete($id){
        $this->load->model('master_model');
        $data = array(
            'inventory_status' => 0,
        );
        $this->master_model->update_inventory($id, $data);
        
        //$this->master_model->delete_inventory($id);
        redirect('master/inventory_index');
    }
    
    //PROJECT
    function project_index(){
        $this->_view('asset/project/index');
    }
    
    function get_data_project() {
		$filter1 = $this->input->post('filter1');
        $value1 = $this->input->post('value1');
        $this->load->model('master_model');
        $project = $this->master_model->get_project($filter1, $value1)->result();
        $data = array();
        $no = $_POST['start'];
        //$no = 0;
        foreach ($project as $row) {
          $no++;
          $rowTable = array();
          $rowTable[] = $no;
          $rowTable[] = $row->project_name;
          $rowTable[] = $row->project_location;
          $rowTable[] = $row->project_desc;
          $rowTable[] = $row->employee_name;
          $rowTable[] = $row->project_start_date;
          $rowTable[] = $row->project_end_date;
          $url_update = base_url('master/project_edit/'.$row->p_hash_id);
          $url_delete = base_url('master/project_delete/'.$row->p_hash_id);
          $rowTable[] = '<a href="'.$url_update.'"><button class="btn btn-primary" title="Edit"><i class="fa fa-pencil"></i></button></a> <a href="'.$url_delete.'"><button class="btn btn-primary" title="Delete"><i class="fa fa-remove"></i></button></a>';
          $data[] = $rowTable;
        }
        
        $output = array(
          "draw" => $_POST['draw'],
          "recordsTotal" => $this->master_model->count_get_all_project(),
          "recordsFiltered" => $this->master_model->count_get_all_project_filtered($filter1, $value1),
          "data" => $data,
        );
        echo json_encode($output);
    }
    
    function project_add(){
        $this->load->model('master_model');
        $data['employee'] = $this->master_model->getEmployee()->result();
        $this->_view('asset/project/insert', $data);
    }
    
    function project_insert(){
        $hash_id = $this->create_hash_id('amos_project');
        $data=array(
            'project_name' => $this->input->post('project_name'),
            'project_location' => $this->input->post('project_location'),
            'project_desc' => $this->input->post('project_desc'),
            'project_pic' => $this->input->post('project_pic'),
            'project_start_date' => $this->input->post('project_start_date'),
            'project_end_date' => $this->input->post('project_end_date'),
            'created_date' => date('y/m/d'),
            'hash_id' => $hash_id
        );
        $this->load->model('master_model');
        $this->master_model->insert_project($data);
        redirect('master/project_index');
    }
    
    function project_edit($id){
        $this->load->model('master_model');
        $data['employee'] = $this->master_model->getEmployee()->result();
        $data['project'] = $this->master_model->select_project_by_id($id)->result();
        //var_dump($data['project']);die();
        $this->_view('asset/project/update', $data);
    }
    
    function project_update($id){
        $data=array(
            'project_name' => $this->input->post('project_name'),
            'project_location' => $this->input->post('project_location'),
            'project_desc' => $this->input->post('project_desc'),
            'project_pic' => $this->input->post('project_pic'),
            'project_start_date' => $this->input->post('project_start_date'),
            'project_end_date' => $this->input->post('project_end_date'),
            'created_date' => date('y/m/d'),
        );
        
        $this->load->model('master_model');
        $this->master_model->update_project($id, $data);
        redirect('master/project_index');
    }
    
    function project_delete($id){
        $this->load->model('master_model');
        $this->master_model->delete_project($id);
        redirect('master/project_index');
    }
    
    //FMR INVENTORY
    public $path = "fmr inventory";
    function fmr_inventory_index(){
        $this->_view('asset/'.$this->path.'/index');
    }
    
    function get_data_fmr_inventory() {
		$filter1 = $this->input->post('filter1');
        $value1 = $this->input->post('value1');
        $this->load->model('master_model');
        $fmr_inventory = $this->master_model->get_fmr_inventory($filter1, $value1)->result();
        $data = array();
        $no = $_POST['start'];
        //$no = 0;
        foreach ($fmr_inventory as $row) {
            
            if($row->fmr_inventory_status==''){
                $status = '<span class="status-undone">Open</span>';
                $url_approval = base_url('master/fmr_inventory_approval/'.$row->f_hash_id);
                $action = '<a href="'.$url_approval.'"><button class="btn btn-warning" title="need approval">Need Approval</button></a>';
            }else{
                $status = '<span class="status-done">Close</span>';
                $url_view = base_url('master/fmr_inventory_detail/'.$row->f_hash_id);
                $action = '<a href="'.$url_view.'"><button class="btn btn-default" title="view detail"><i class="fa fa-search"></i></button></a>';
            }
          $no++;
          $rowTable = array();
          $rowTable[] = $no;
          $rowTable[] = $row->fmr_inventory_code;
          $rowTable[] = $row->department_name;
          $rowTable[] = $row->name;
          $rowTable[] = $row->fmr_inventory_initiate_date;
          $rowTable[] = date($row->fmr_inventory_initiate_date, strtotime("+30 days"));
          $rowTable[] = $status;
          $rowTable[] = $action;
          $data[] = $rowTable;
        }
        
        $output = array(
          "draw" => $_POST['draw'],
          "recordsTotal" => $this->master_model->count_get_all_fmr_inventory(),
          "recordsFiltered" => $this->master_model->count_get_all_fmr_inventory_filtered($filter1, $value1),
          "data" => $data,
        );
        echo json_encode($output);
    }
    
    function fmr_inventory_detail($id){
        $this->load->model('master_model');
        $data['fmr_inventory'] = $this->master_model->select_fmr_inventory($id)->result();
        $fmr_inventory_detail = $this->master_model->select_fmr_inventory_detail($id);
        if ($fmr_inventory_detail->num_rows() >= 0) {
            $data['fmr_inventory_detail'] = $fmr_inventory_detail->result();
        }
        $this->_view('asset/'.$this->path.'/detail', $data);
    }
    
    function fmr_inventory_add(){
        $this->load->model('master_model');
        $fmr_inventory = $this->master_model->select_new_fmr_inventory();
        if($fmr_inventory->num_rows()>0){
            $data_fmr_inventory = $fmr_inventory->result();
            $fmr_inventory_id = $data_fmr_inventory[0]->fmr_inventory_id;
            $fmr_inventory_id = $fmr_inventory_id + 1;
        }else{
            $fmr_inventory_id = 1;
        }
        
        $data['fmr_inventory_code'] = 'FMR_INV_'.$fmr_inventory_id;
        
        $data['project'] = $this->master_model->getProject()->result();
        $data['unit'] = $this->master_model->getUnit()->result();
        $data['inventory'] = $this->master_model->getInventory()->result();
        $this->_view('asset/'.$this->path.'/insert', $data);
    }
    
    function fmr_inventory_insert(){
        $this->load->model('master_model');
        $hash_id = $this->create_hash_id('amos_fmr_inventory');
        $fmr_inventory = $this->master_model->select_new_fmr_inventory_all();
        if($fmr_inventory->num_rows()>0){
            $data_fmr_inventory = $fmr_inventory->result();
            $fmr_inventory_id = $data_fmr_inventory[0]->fmr_inventory_id;
            $fmr_inventory_id = $fmr_inventory_id + 1;
        }else{
            $fmr_inventory_id = 1;
        }
        
        $data=array(
            'fmr_inventory_id' => $fmr_inventory_id,
            'fmr_inventory_code' => $this->input->post('fmr_inventory_code'),
            'fmr_inventory_initiate_date' => date('y/m/d'),
            'department_id' => 2,
            'created_by' => 5,
            //'due_date' => date('y/m/d', strtotime("+30 days")),
            'project_id' => $this->input->post('project_code'),
            'fmr_inventory_justification' => $this->input->post('justification'),
            'fmr_inventory_approval_status' =>0,
            'fmr_inventory_status' =>false,
            //'fmr_invetory_remarks' => '', 
            'hash_id' => $hash_id        
        );
        
        $this->master_model->insert_fmr_inventory($data);
        
        $item = $this->input->post('item');
        $part_number = $this->input->post('part_number');
        $description = $this->input->post('description');
        $actual_stock = $this->input->post('actual_stock');
        $qty_request = $this->input->post('qty_request');
        $uom = $this->input->post('uom');
        $remarks = $this->input->post('remarks');
           
        $jmlmax = count($this->input->post('remarks'));
        for($i=0;$i<$jmlmax;$i++){
            $data_detail = array(
                'fmr_inventory_id' => $fmr_inventory_id,
                'inventory_id' => $item[$i],
                'fmr_inventory_detail_description' => $description[$i],
                'fmr_inventory_detail_qty_request' => $qty_request[$i],
                'unit_id' => $uom[$i],
                'fmr_inventory_detail_remarks' => $remarks[$i],
                //'fmr_detail_part_number' => $part_number[$i],
                //'fmr_detail_actual_stock' => $actual_stock[$i],
            );
            $this->master_model->insert_fmr_inventory_detail($data_detail);            
        }
        
        redirect('master/fmr_inventory_index');
    }
    
    function fmr_inventory_approval($id){
        $this->load->model('master_model');
        $data['fmr_inventory'] = $this->master_model->select_fmr_inventory($id)->result();
        $fmr_inventory_detail = $this->master_model->select_fmr_inventory_detail($id);
        if ($fmr_inventory_detail->num_rows() >= 0) {
            $data['fmr_inventory_detail'] = $fmr_inventory_detail->result();
        }
        $this->_view('asset/'.$this->path.'/approval', $data);
    }
    
    function fmr_inventory_approve($id){
        //var_dump($this->input->post('approval_remarks'));die();
        $data = array(
            'fmr_inventory_approval_status'=>1,
            'fmr_inventory_status'=>TRUE,
            'fmr_inventory_remarks'=>$this->input->post('approval_remarks'),
        );
        $this->load->model('master_model');
        $this->master_model->update_fmr_inventory($id, $data);  
         
        redirect('master/fmr_inventory_index');
    }
    
    function fmr_inventory_reject($id){
        //var_dump($this->input->post('approval_remarks'));die();
        $data = array(
            'fmr_inventory_approval_status'=>0,
            'fmr_inventory_status'=>true,
            'fmr_inventory_remarks'=>$this->input->post('approval_remarks'),
        );
        $this->load->model('master_model');
        $this->master_model->update_fmr_inventory($id, $data);  
         
        redirect('master/fmr_inventory_index');
    }
    
    function fmr_inventory_edit($id){
        $this->load->model('master_model');
        $data['employee'] = $this->master_model->getEmployee()->result();
        $data['fmr_inventory'] = $this->master_model->select_fmr_inventory_by_id($id)->result();
        //var_dump($data['fmr_inventory']);die();
        $this->_view('asset/'.$this->path.'/update', $data);
    }
    
    function fmr_inventory_update($id){        
        $data=array(
            'fmr_remarks' => $this->input->post('approval_remarks'),
            'last_update' => date('y/m/d'),
        );
        
        $this->load->model('master_model');
        $this->master_model->update_fmr($id, $data);
        redirect('master/fmr_inventory_index');
    }
    
    function fmr_inventory_delete($id){
        $this->load->model('master_model');
        $this->master_model->delete_fmr_inventory($id);
        redirect('master/fmr_inventory_index');
    }
    
    //FMR ASSET
    public $path1 = "fmr asset";
    function fmr_asset_index(){
        $this->_view('asset/'.$this->path1.'/index');
    }
    
    function get_data_fmr_asset() {
		$filter1 = $this->input->post('filter1');
        $value1 = $this->input->post('value1');
        $this->load->model('master_model');
        $fmr_asset = $this->master_model->get_fmr_asset($filter1, $value1)->result();
        $data = array();
        $no = $_POST['start'];
        //$no = 0;
        foreach ($fmr_asset as $row) {
            
            if($row->fmr_asset_status==''){
                $status = '<span class="status-undone">Open</span>';
                $url_approval = base_url('master/fmr_asset_approval/'.$row->a_hash_id);
                $action = '<a href="'.$url_approval.'"><button class="btn btn-warning" title="need approval">Need Approval</button></a>';
            }else{
                $status = '<span class="status-done">Close</span>';
                $url_view = base_url('master/fmr_asset_detail/'.$row->a_hash_id);
                $action = '<a href="'.$url_view.'"><button class="btn btn-default" title="view detail"><i class="fa fa-search"></i></button></a>';
            }
          $no++;
          $rowTable = array();
          $rowTable[] = $no;
          $rowTable[] = $row->fmr_asset_code;
          $rowTable[] = $row->department_name;
          $rowTable[] = $row->name;
          $rowTable[] = $row->fmr_asset_initiate_date;
          $rowTable[] = date($row->fmr_asset_initiate_date, strtotime("+30 days"));
          $rowTable[] = $status;
          $rowTable[] = $action;
          $data[] = $rowTable;
        }
        
        $output = array(
          "draw" => $_POST['draw'],
          "recordsTotal" => $this->master_model->count_get_all_fmr_asset(),
          "recordsFiltered" => $this->master_model->count_get_all_fmr_asset_filtered($filter1, $value1),
          "data" => $data,
        );
        echo json_encode($output);
    }
    
    function fmr_asset_detail($id){
        $this->load->model('master_model');
        $data['fmr_asset'] = $this->master_model->select_fmr_asset($id)->result();
        $fmr_asset_detail = $this->master_model->select_fmr_asset_detail($id);
        if ($fmr_asset_detail->num_rows() >= 0) {
            $data['fmr_asset_detail'] = $fmr_asset_detail->result();
        }
        $this->_view('asset/'.$this->path1.'/detail', $data);
    }
    
    function fmr_asset_add(){
        $this->load->model('master_model');
        $fmr_asset = $this->master_model->select_new_fmr_asset();
        if($fmr_asset->num_rows()>0){
            $data_fmr_asset = $fmr_asset->result();
            $fmr_asset_id = $data_fmr_asset[0]->fmr_asset_id;
            $fmr_asset_id = $fmr_asset_id + 1;
        }else{
            $fmr_asset_id = 1;
        }
        
        $data['fmr_asset_code'] = 'FMR_ASSET_'.$fmr_asset_id;
        
        $data['project'] = $this->master_model->getProject()->result();
        $data['asset'] = $this->master_model->getAsset()->result();
        $data['unit'] = $this->master_model->getUnit()->result();
        $this->_view('asset/'.$this->path1.'/insert', $data);
    }
    
    function fmr_asset_insert(){
        $this->load->model('master_model');
        $hash_id = $this->create_hash_id('amos_fmr_asset');
        $fmr_asset = $this->master_model->select_new_fmr_asset_all();
        if($fmr_asset->num_rows()>0){
            $data_fmr_asset = $fmr_asset->result();
            $fmr_asset_id = $data_fmr_asset[0]->fmr_asset_id;
            $fmr_asset_id = $fmr_asset_id + 1;
        }else{
            $fmr_asset_id = 1;
        }
        
        $data=array(
            'fmr_asset_id' => $fmr_asset_id,
            'fmr_asset_code' => $this->input->post('fmr_asset_code'),
            'fmr_asset_initiate_date' => date('y/m/d'),
            'department_id' => 2,
            'created_by' => 5,
            //'due_date' => date('y/m/d', strtotime("+30 days")),
            'project_id' => $this->input->post('project_code'),
            'fmr_asset_justification' => $this->input->post('justification'),
            'fmr_asset_approval_status' =>0,
            'fmr_asset_status' => false,
            'hash_id' => $hash_id              
        );
                
        $this->master_model->insert_fmr_asset($data);
        
        $item = $this->input->post('item');
        $part_number = $this->input->post('part_number');
        $description = $this->input->post('description');
        $actual_stock = $this->input->post('actual_stock');
        $qty_request = $this->input->post('qty_request');
        $uom = $this->input->post('uom');
        $remarks = $this->input->post('remarks');
           
        $jmlmax = count($this->input->post('remarks'));
        for($i=0;$i<$jmlmax;$i++){
            $data_detail = array(
                'fmr_asset_id' => $fmr_asset_id,
                'asset_id' => $item[$i],
                //'fmr_asset_detail_part_number' => $part_number[$i],
                'fmr_asset_detail_description' => $description[$i],
                'fmr_asset_detail_qty_request' => $qty_request[$i],
                'unit_id' => $uom[$i],
                'fmr_asset_detail_remarks' => $remarks[$i],
            );
            $this->master_model->insert_fmr_asset_detail($data_detail);            
        }
        
        redirect('master/fmr_asset_index');
    }
    
    function fmr_asset_approval($id){
        $this->load->model('master_model');
        $data['fmr_asset'] = $this->master_model->select_fmr_asset($id)->result();
        $fmr_asset_detail = $this->master_model->select_fmr_asset_detail($id);
        if ($fmr_asset_detail->num_rows() >= 0) {
            $data['fmr_asset_detail'] = $fmr_asset_detail->result();
        }
        $this->_view('asset/'.$this->path1.'/approval', $data);
    }
    
    function fmr_asset_approve($id){
        //var_dump($this->input->post('approval_remarks'));die();
        $data = array(
            'fmr_asset_approval_status'=>1,
            'fmr_asset_status'=>TRUE,
            'fmr_asset_remarks'=>$this->input->post('approval_remarks'),
        );
        $this->load->model('master_model');
        $this->master_model->update_fmr_asset($id, $data);  
         
        redirect('master/fmr_asset_index');
    }
    
    function fmr_asset_reject($id){
        //var_dump($this->input->post('approval_remarks'));die();
        $data = array(
            'fmr_asset_approval_status'=>0,
            'fmr_asset_status'=>true,
            'fmr_asset_remarks'=>$this->input->post('approval_remarks'),
        );
        $this->load->model('master_model');
        $this->master_model->update_fmr_asset($id, $data);  
         
        redirect('master/fmr_asset_index');
    }
    
    function fmr_asset_edit($id){
        $this->load->model('master_model');
        $data['employee'] = $this->master_model->getEmployee()->result();
        $data['fmr_asset'] = $this->master_model->select_fmr_asset_by_id($id)->result();
        //var_dump($data['fmr_asset']);die();
        $this->_view('asset/'.$this->path1.'/update', $data);
    }
    
    function fmr_asset_update($id){        
        $data=array(
            'fmr_asset_remarks' => $this->input->post('approval_remarks'),
            'last_update' => date('y/m/d'),
        );
        
        $this->load->model('master_model');
        $this->master_model->update_fmr_asset($id, $data);
        redirect('master/fmr_asset_index');
    }
    
    function fmr_asset_delete($id){
        $this->load->model('master_model');
        $this->master_model->delete_fmr_asset($id);
        redirect('master/fmr_asset_index');
    }
    
    //FMR RELEASE
    public $path4 = "fmr release list";
    function get_data_fmr_release(){
        $filter1 = $this->input->post('filter1');
        $value1 = $this->input->post('value1');
        $this->load->model('master_model');
        $fmr_asset = $this->master_model->get_fmr_asset_release()->result();
        $fmr_inventory = $this->master_model->get_fmr_inventory_release()->result();
        $data = array();
        $no = $_POST['start'];
        //$no = 0;
        foreach ($fmr_asset as $row) {
            $cek_status = $this->master_model->cek_status_fmr_asset($row->fa_id)->result();
            if($cek_status[0]->fmr_asset_release == null){
                $status = 'Open';
                $url_view = base_url('master/fmr_asset_release/'.$row->fa_hash_id);
                $fmr_asset_code = '<a href="'.$url_view.'"><button class="btn btn-default" title="view">'.$row->fmr_asset_code.'</button></a>';
            }else{
                $status = 'Close';
                $fmr_asset_code = $row->fmr_asset_code;
            }
          $no++;
          $rowTable = array();
          $rowTable[] = $no;          
          $rowTable[] = $fmr_asset_code;
          $rowTable[] = $row->name;
          $rowTable[] = $row->fmr_asset_initiate_date;
          $rowTable[] = $row->request_total;
          $rowTable[] = $status;
          $data[] = $rowTable;
        }
        
        foreach ($fmr_inventory as $row) {
            $cek_status = $this->master_model->cek_status_fmr_inventory($row->fi_id)->result();
            if($cek_status[0]->fmr_inventory_release == null){
                $status = 'Open';
                $url_view = base_url('master/fmr_inventory_release/'.$row->fi_hash_id);
                $fmr_inventory_code = '<a href="'.$url_view.'"><button class="btn btn-default" title="view">'.$row->fmr_inventory_code.'</button></a>';
            }else{
                $status = 'Close';
                $fmr_inventory_code = $row->fmr_inventory_code;
            }
          $no++;
          $rowTable = array();
          $rowTable[] = $no;
          $rowTable[] = $fmr_inventory_code;
          $rowTable[] = $row->name;
          $rowTable[] = $row->fmr_inventory_initiate_date;
          $rowTable[] = $row->request_total;
          $rowTable[] = $status;
          $data[] = $rowTable;
        }
        
        $output = array(
          "draw" => $_POST['draw'],
          //"recordsTotal" => $this->master_model->count_get_all_fmr_asset(),
          //"recordsFiltered" => $this->master_model->count_get_all_fmr_asset_filtered($filter1, $value1),
          "data" => $data,
        );
        echo json_encode($output);
    }
    
    function fmr_release_index(){
        $this->_view('asset/'.$this->path4.'/index');
    }
    
    function fmr_asset_release($fa_hash_id){
        $this->load->model('master_model');
        $data['fmr_asset'] = $this->master_model->select_fmr_asset($fa_hash_id)->result();        
        $data['fmr_asset_detail'] = $this->master_model->select_fmr_asset_detail($fa_hash_id)->result();
        $this->_view('asset/'.$this->path4.'/fmr_asset_release', $data);
    }
    
    function fmr_asset_release_insert($fa_hash_id){
        $this->load->model('master_model');   
        $fmr_asset_detail = $this->master_model->select_fmr_asset_detail($fa_hash_id)->result();
        foreach($fmr_asset_detail as $row){
            $data = array(
                'fmr_asset_detail_id'=>$row->fmr_asset_detail_id,
                'asset_id'=>$row->asset_id
            );
            $this->master_model->insert_fmr_asset_release($data);
        }
        
        redirect('master/fmr_release_index');
    }
    
    function fmr_inventory_release($fi_hash_id){
        $this->load->model('master_model');
        $data['fmr_inventory'] = $this->master_model->select_fmr_inventory($fi_hash_id)->result();        
        $data['fmr_inventory_detail'] = $this->master_model->select_fmr_inventory_detail($fi_hash_id)->result();
        $this->_view('asset/'.$this->path4.'/fmr_inventory_release', $data);
    }
    
    function fmr_inventory_release_insert($fi_hash_id){
        $this->load->model('master_model');   
        $fmr_inventory_detail = $this->master_model->select_fmr_inventory_detail($fi_hash_id)->result();
        foreach($fmr_inventory_detail as $row){
            $data = array(
                'fmr_inventory_detail_id'=>$row->fmr_inventory_detail_id,
                'inventory_id'=>$row->inventory_id
            );
            $this->master_model->insert_fmr_inventory_release($data);
        }
        
        redirect('master/fmr_release_index');
    }
    
    function kpi_index(){
        $this->_view('asset/kpi/index');
    }
    
    function get_data_kpi() {
		$filter1 = $this->input->post('filter1');
        $value1 = $this->input->post('value1');
        $this->load->model('master_model');
        $kpi = $this->master_model->get_kpi($filter1, $value1)->result();
        $data = array();
        $no = $_POST['start'];
        //$no = 0;
        foreach ($kpi as $row) {
          $no++;
          $rowTable = array();
          $rowTable[] = $no;
          $rowTable[] = $row->kpi_master;
          $url_detail = base_url('master/kpi_detail/'.$row->hash_id);
          $url_update = base_url('master/kpi_edit/'.$row->hash_id);
          $url_delete = base_url('master/kpi_delete/'.$row->hash_id);
          $rowTable[] = '<a href="'.$url_detail.'"><button class="btn btn-primary" title="Detail"><i class="fa fa-search"></i></button></a> <a href="'.$url_update.'"><button class="btn btn-primary" title="Edit"><i class="fa fa-pencil"></i></button></a> <a href="'.$url_delete.'"><button class="btn btn-primary" title="Delete"><i class="fa fa-remove"></i></button></a>';
          $data[] = $rowTable;
        }
        
        $output = array(
          "draw" => $_POST['draw'],
          "recordsTotal" => $this->master_model->count_get_all_kpi(),
          "recordsFiltered" => $this->master_model->count_get_all_kpi_filtered($filter1, $value1),
          "data" => $data,
        );
        echo json_encode($output);
    }
    
    function kpi_add(){
        $this->load->model('master_model');
        $data['unit'] = $this->master_model->getUnit()->result();
        $this->_view('asset/kpi/insert', $data);
    }
    
    function kpi_insert(){
        $this->load->model('master_model');
        $kpi = $this->master_model->select_new_kpi();
        if($kpi->num_rows()>0){
            $data_kpi = $kpi->result();
            $kpi_id = $data_kpi[0]->kpi_id;
            $kpi_id = $kpi_id + 1;
        }else{
            $kpi_id = 1;
        }
        
        $hash_id = $this->create_hash_id('amos_kpi');
        $data = array(
            'kpi_id' => $kpi_id,
            'kpi_master' => $this->input->post('kpi_master'),
            'hash_id' => $hash_id,
        );
        
        $this->master_model->insert_kpi($data);
        
        $item = $this->input->post('kpi_details_item');
        $max = $this->input->post('kpi_details_max');
        $min = $this->input->post('kpi_details_min');
        $unit = $this->input->post('unit');
        $i = 0;
        
        foreach($item as $it){
            $data_details = array(
                'kpi_id' => $kpi_id,
                'kpi_details_item' => $it,
                'kpi_details_max' => $max[$i],
                'kpi_details_min' => $min[$i],
                'unit_id' => $unit[$i],
            );
            $this->master_model->insert_kpi_details($data_details);
            $i++;            
        }
        
        redirect('master/kpi_index');
    }
    
    function kpi_detail($k_hash_id){
        $this->load->model('master_model');
        $data['kpi'] = $this->master_model->select_kpi_by_id($k_hash_id)->result();
        $data['kpi_details'] = $this->master_model->getKpiDetails($k_hash_id)->result();
        $this->_view('asset/kpi/detail', $data);
    }
    
    function kpi_edit($k_hash_id){        
        $this->load->model('master_model');
        $data['unit'] = $this->master_model->getUnit()->result();
        $data['kpi'] = $this->master_model->select_kpi_by_id($k_hash_id)->result();
        $data['kpi_details'] = $this->master_model->getKpiDetails($k_hash_id)->result();
        $this->_view('asset/kpi/update', $data);
    }
    
    function kpi_update($k_hash_id){       
        $this->load->model('master_model');
        $data = array(
            'kpi_master'=>$this->input->post('kpi_master'),
        );
        $this->master_model->update_kpi($k_hash_id, $data);
        $this->master_model->delete_kpi_details($this->input->post('kpi_id'));
        
        $item = $this->input->post('kpi_details_item');
        $max = $this->input->post('kpi_details_max');
        $min = $this->input->post('kpi_details_min');
        $unit = $this->input->post('unit');
        $i = 0;
        
        foreach($item as $it){
            $data_details = array(
                'kpi_id' => $this->input->post('kpi_id'),
                'kpi_details_item' => $it,
                'kpi_details_max' => $max[$i],
                'kpi_details_min' => $min[$i],
                'unit_id' => $unit[$i],
            );
            $this->master_model->insert_kpi_details($data_details);
            $i++;            
        }
        
        redirect('master/kpi_index');        
    }
    
    function kpi_delete($k_hash_id){
        $this->load->model('master_model');
        $getKpi = $this->master_model->select_kpi_by_id($k_hash_id)->row_array();
        $kpi_id = $getKpi['kpi_id'];
        $this->master_model->delete_kpi_details($kpi_id);
        $this->master_model->delete_kpi($k_hash_id);
        
        redirect('master/kpi_index');
    }
    
    //ITEM
    function item_index(){
        $this->_view('asset/item/index');
    }
    
    function get_data_item() {
		$filter1 = $this->input->post('filter1');
        $value1 = $this->input->post('value1');
        $this->load->model('master_model');
        $item = $this->master_model->get_item($filter1, $value1)->result();
        $data = array();
        $no = $_POST['start'];
        //$no = 0;
        foreach ($item as $row) {
          $no++;
          $rowTable = array();
          $rowTable[] = $no;
          $rowTable[] = $row->item_name;
          $rowTable[] = $row->item_desc;
          $url_update = base_url('master/item_edit/'.$row->hash_id);
          $url_delete = base_url('master/item_delete/'.$row->hash_id);
          $rowTable[] = '<a href="'.$url_update.'"><button class="btn btn-primary" title="Edit"><i class="fa fa-pencil"></i></button></a> <a href="'.$url_delete.'"><button class="btn btn-primary" title="Delete"><i class="fa fa-remove"></i></button></a>';
          $data[] = $rowTable;
        }
        
        $output = array(
          "draw" => $_POST['draw'],
          "recordsTotal" => $this->master_model->count_get_all_item(),
          "recordsFiltered" => $this->master_model->count_get_all_item_filtered($filter1, $value1),
          "data" => $data,
        );
        echo json_encode($output);
    }
    
    function item_add(){
        $this->_view('asset/item/insert');
    }
    
    function item_insert(){
        $hash_id = $this->create_hash_id('amos_item');
        $data=array(
            'item_name' => $this->input->post('item_name'),
            'item_desc' => $this->input->post('item_desc'),
            'hash_id' => $hash_id
        );
        $this->load->model('master_model');
        $this->master_model->insert_item($data);
        redirect('master/item_index');
    }
    
    function item_edit($id){
        $this->load->model('master_model');
        $data['item'] = $this->master_model->select_item_by_id($id)->result();
        $this->_view('asset/item/update', $data);
    }
    
    function item_update($id){
        $data=array(
            'item_name' => $this->input->post('item_name'),
            'item_desc' => $this->input->post('item_desc'),
        );
        
        $this->load->model('master_model');
        $this->master_model->update_item($id, $data);
        redirect('master/item_index');
    }
    
    function item_delete($id){
        $this->load->model('master_model');
        $this->master_model->delete_item($id);
        redirect('master/item_index');
    }
    
}
