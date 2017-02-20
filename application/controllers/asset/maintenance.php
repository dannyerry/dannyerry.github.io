<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Maintenance extends MY_Controller {
//===================KARLINA======================
    
    function __construct(){
        parent::__construct();
        $this->load->file('asset/imageupload.php');
    }
    
    public $path = "maintenance setup";
    function maintenance_setup_index(){
        $this->_view('asset/'.$this->path.'/index');
    }
    
    function get_data_asset() {
		$filter1 = $this->input->post('filter1');
        $value1 = $this->input->post('value1');
        $this->load->model('maintenance_model');
        $asset = $this->maintenance_model->get_asset($filter1, $value1)->result();
        $data = array();
        $no = $_POST['start'];
        //$no = 0;
        foreach ($asset as $row) {
          $no++;
          $rowTable = array();
          $rowTable[] = $row->asset_code;
          $rowTable[] = $row->asset_name;
          $get_maintenance_code = $this->maintenance_model->select_new_maintenance($row->asset_code);
            if($get_maintenance_code->num_rows()>0){
                $url_setup = base_url('asset/maintenance/task_maintenance_plan/'.$row->a_hash_id);
                $rowTable[] = '<a href="'.$url_setup.'"><button class="btn btn-primary" title="Plan"><i class="fa fa-tasks"></i></button></a>';
            }else{
                $url_setup = base_url('asset/maintenance/maintenance_setup_add/'.$row->a_hash_id);
                $rowTable[] = '<a href="'.$url_setup.'"><button class="btn btn-primary" title="Setup"><i class="fa fa-gear"></i></button></a>';
            }       
          
          $data[] = $rowTable;
        }
        
        $output = array(
          "draw" => $_POST['draw'],
          "recordsTotal" => $this->maintenance_model->count_get_all_asset(),
          "recordsFiltered" => $this->maintenance_model->count_get_all_asset_filtered($filter1, $value1),
          "data" => $data,
        );
        echo json_encode($output);
    }
    
    function maintenance_setup_add($id){
        $this->load->model('maintenance_model');
        $data['asset'] = $this->maintenance_model->select_asset_by_id($id)->result();
		
        $data['dept'] = $this->maintenance_model->getDept($id)->result();   
        $data['group'] = $this->maintenance_model->getGroup_by_id($id)->result();  
        $this->_view('asset/'.$this->path.'/insert', $data);
    }
    
    function maintenance_setup_insert(){
        $this->load->model('maintenance_model');        
        $interval = $this->input->post('maintenance_schedule').' '.$this->input->post('periode');
        $date=date_create(date("Y-m-d"));
        for($i=1;$i<=3;$i++){            
            
            $apa = date_add($date,date_interval_create_from_date_string($interval));
            $hasil = date_format($date, "Y-m-d");
            $running_hours = $this->input->post('running_hours');
            $hash_id = $this->create_hash_id('amos_maintenance');
            $data = array(
                'maintenance_code'=>'MT_'.$this->input->post('asset_code').'_'.$i,
                'asset_id'=>$this->input->post('asset_id'),
                'maintenance_running_hours'=>$this->input->post('maintenance_running_hours')*$i,
                'maintenance_schedule'=>$hasil,
                'maintenance_assignment_type'=>$this->input->post('maintenance_assignment_type'),
                'hash_id'=>$hash_id,
                //'maintenance_status'=>0,
                //'maintenance_duration'=>'',
            );
            $this->maintenance_model->insert_maintenance_setup($data);
            $date = date_create($hasil);            
        }
        
        redirect('asset/maintenance/maintenance_setup_index');
    }
    
    function task_maintenance_plan($id){
        $this->load->model('maintenance_model');
        $data['asset'] = $this->maintenance_model->select_asset_by_id($id)->result();
        $data['dept'] = $this->maintenance_model->getDept($id)->result();   
        $data['group'] = $this->maintenance_model->getGroup_by_id($id)->result();  
        $data['maintenance_plan'] = $this->maintenance_model->getTask_maintenance_plan($id)->result();
        $this->_view('asset/'.$this->path.'/task_maintenance_plan', $data);
    }
        
    function task_maintenance_plan_add($hash_id, $a_hash_id){
        $this->load->model('maintenance_model');
        $this->load->model('master_model');
        $getMaintenance = $this->maintenance_model->getMaintenance($hash_id)->row_array();
        $data['maintenance_id'] = $getMaintenance['maintenance_id'];
        $data['kpi'] = $this->maintenance_model->getKpi()->result();
        $data['item'] = $this->maintenance_model->getItem()->result();
        $data['inventory'] = $this->master_model->getInventory()->result();
        $data['unit'] = $this->master_model->getUnit()->result();
        $data['a_hash_id'] = $a_hash_id;
        $this->_view('asset/'.$this->path.'/task_maintenance_plan_add', $data);
    }
    
    function task_maintenance_plan_insert($maintenance_id){
        $this->load->model('maintenance_model');
        //UPDATE MAINTENANCE
        $data_maintenance = array(
            'maintenance_duration'=>$this->input->post('duration'),
        );
        $this->maintenance_model->update_maintenance($maintenance_id, $data_maintenance);
        
        //INSERT TOOLS NEEDED        
        $tools = $this->input->post('tools');
        $unit = $this->input->post('unit');
        $x=0;
        foreach($tools as $t){
            $data_tools = array(
                'maintenance_id' => $maintenance_id,
                'inventory_id' => $t,
                'unit_id' => $unit[$x],
            );   
            
            $this->maintenance_model->insert_tools_needed($data_tools);
            $x++;
        }
        
        $item = $this->input->post('item');
        $i=0;
        foreach($item as $a){
            //INSERT ITEM OF WORK
            $maintenance_item_id = $this->maintenance_model->select_new_maintenance_item('');
            if($maintenance_item_id->num_rows()>0){
                $data_maintenance_item_id = $maintenance_item_id->result();
                $maintenance_item_id = $data_maintenance_item_id[0]->maintenance_item_of_work_id;
                $maintenance_item_id = $maintenance_item_id + 1;
            }else{
                $maintenance_item_id = 1;
            }
            $maintenance_item = $this->maintenance_model->select_new_maintenance_item($maintenance_id);
            if($maintenance_item->num_rows()>0){
                $data_maintenance_item = $maintenance_item->result();
                $expl = explode('_',$data_maintenance_item[0]->maintenance_item_of_work_code);
                $maintenance_item = $expl[2] + 1;
            }else{
                $maintenance_item = 1;
            }
            
            $data_item = array(
                'maintenance_item_of_work_id' => $maintenance_item_id,
                'maintenance_id' => $maintenance_id,
                'maintenance_item_of_work_code' => 'MTI_'.$maintenance_id.'_'.$maintenance_item,
                'maintenance_item_of_work_name' => $a,
            );
            
            $this->maintenance_model->insert_maintenance_item_of_work($data_item);
            
            //INSERT SUB ITEM OF WORK
            $sub_item = $this->input->post('sub_item'.($i+1));
            $kpi = $this->input->post('kpi'.($i+1));
            $justification = $this->input->post('justification'.($i+1));
            $j=0;
            foreach($sub_item as $b){
                $data_sub_item = array(
                    'maintenance_item_of_work_id' => $maintenance_item_id,
                    'maintenance_sub_item_of_work_name' => $b,
                    //'maintenance_sub_item_of_work_value' => $b,
                    'kpi_id' =>$kpi[$j],
                    'maintenance_sub_item_of_work_justification' => $justification[$j],
                );                
                $this->maintenance_model->insert_maintenance_sub_item_of_work($data_sub_item);
                
                //INSERT EQUIPMENT NEEDED
                $items = $this->input->post('items'.($i+1).'-'.($j+1));
                $qty = $this->input->post('qty'.($i+1).'-'.($j+1));
                $k=0;
                foreach($items as $c){
                    $data_equipment = array(
                        'maintenance_item_or_work_id' => $maintenance_item_id,
                        'item_id' => $c,
                        'maintenance_item_of_work_equipment_needed_qty' => $qty[$k],
                    );
                    $this->maintenance_model->insert_maintenance_equipment_needed($data_equipment);                    
                    $k++;
                }
                $j++;
            }
            $i++;
        }
        redirect('asset/maintenance/task_maintenance_plan/'.$this->input->post('a_hash_id'));
    }
    
    function task_maintenance_plan_detail($hash_id){
        $this->load->model('maintenance_model');
        $data['item_sub_item'] = $this->maintenance_model->getItemSubItemOfWork($hash_id)->result();
        $data['maintenance'] = $this->maintenance_model->getMaintenance($hash_id)->result();        
        $data['equipment'] = $this->maintenance_model->getEquipment($hash_id)->result();       
        $data['tools'] = $this->maintenance_model->getTools($hash_id)->result();
        
        $this->_view2('asset/'.$this->path.'/task_maintenance_plan_detail', $data);
    }
}
