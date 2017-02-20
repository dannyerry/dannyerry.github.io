<div class="col-sm-10 col-sm-offset-2">
	<div class="breadcrumb-menu">
		<ol class="breadcrumb">
			<li><a href="#">MAINTENANCE</a></li>
            <li><a href="<?=base_url('maintenance/maintenance_setup_index')?>">MAINTENANCE SETUP</a></li>
            <li class="active">TASK MAINTENANCE SETUP</li>
		</ol>
	</div>
	<div id="content-wrapper">
		<div id="inner-wrapper">
	<section>
		<table class="detail-table" width="100%">
            <tr>
                <th>Code</th>
                <td>: <?=$asset[0]->asset_code?></td>
                <th>Asset Name</th>
                <td>: <?=$asset[0]->asset_name?></td>
                <th>Rack No</th>
                <td>: <?=$asset[0]->asset_rack_no?></td>
            </tr>
            <tr>
                <th>Category</th>
                <td>: <?=$asset[0]->category_name?></td>
                <th>Sub Group 1</th>
                <td>: <?=$group[0]->sub_group1_name?></td>
                <th>Warehouse</th>
                <td>: <?=$asset[0]->warehouse_name?></td>
            </tr>
            <tr>
                <th>Group</th>
                <td>: <?=$group[0]->group_name?></td>
                <th>Sub Group 2</th>
                <td>: <?=$group[0]->sub_group2_name?></td>
                <th>Department</th>
                <td>: <?=$dept[0]->department_name?></td>
            </tr>
            <tr>
                <th>Type</th>
                <td>: <?=$asset[0]->asset_type?></td>
                <th>Serial Number</th>
                <td>: <?=$asset[0]->asset_serial_number?></td>
            </tr>
		</table>
	</section>
	<section>
		<div class="section-content">
			<table width="100%" class="secondary-table" id="dataTableAsset">
				<tr>
                    <td><strong>Maintenance Code</strong></td>
                    <?php foreach ($maintenance_plan as $row){
                        echo '<td colspan=3>'.$row->maintenance_code.'</td>';
                    }?>
                </tr>
                <tr>
                    <td><strong>Running Hour</strong></td>
                    <?php foreach ($maintenance_plan as $row){
                        echo '<td colspan=3>'.$row->maintenance_running_hours.'</td>';
                    }?>
                </tr>
                <tr>
                    <td><strong>Scheduled</strong></td>
                    <?php foreach ($maintenance_plan as $row){
                        echo '<td colspan=3>'.$row->maintenance_schedule.'</td>';
                    }?>
                </tr>
                <tr>
                    <td><strong>Assignment Type</strong></td>
                    <?php foreach ($maintenance_plan as $row){
                        if($row->maintenance_assignment_type == 0){
                            echo '<td colspan=3>Internal</td>';   
                        }else if($row->maintenance_assignment_type == 1){
                            echo '<td colspan=3>Eksternal</td>';
                        }
                    }?>
                </tr>
                <tr>
                    <td><strong>Scheduled</strong></td>
                    <?php foreach ($maintenance_plan as $row){
                        echo '<td colspan=3>'.$row->maintenance_schedule.'</td>';
                    }?>
                </tr>
                <tr>
                    <td><strong>Action</strong></td>
                    <?php foreach ($maintenance_plan as $row){
                        if($row->maintenance_duration == 0){
                            echo '<td colspan=3>
                                <a href="'.base_url('maintenance/task_maintenance_plan_add/'.$row->hash_id.'/'.$asset[0]->a_hash_id).'"><button class="btn btn-primary" title="Edit"><i class="fa fa-gear"></i></button></a>
                                <a href="#"><button class="btn btn-primary" title="Delete"><i class="fa fa-remove"></i></button></a>
                            </td>';
                        }else{
                            echo '<td colspan=3>
                                <a onclick="task_maintenance_plan_detail(\''.$row->hash_id.'\')"><button class="btn btn-primary" title="Detail"><i class="fa fa-search"></i></button></a>
                                <a href="'.base_url('maintenance/task_maintenance_plan_edit/'.$row->hash_id.'/'.$asset[0]->a_hash_id).'"><button class="btn btn-primary" title="Edit"><i class="fa fa-pencil"></i></button></a>
                                <a href="#"><button class="btn btn-primary" title="Delete"><i class="fa fa-remove"></i></button></a>
                            </td>';
                        }                        
                    }?>
                </tr>
			</table>
		</div>
	</section>
    
<script type="text/javascript">
  var popupWindow=null;
  function task_maintenance_plan_detail(id)
  {	    
    popupWindow =window.open('../task_maintenance_plan_detail/'+id, "_blank", "directories=no, status=no, menubar=no, scrollbars=yes, resizable=no,width=700, height=650, top=0, left=50");
	popupWindow.focus();
	document.onmousedown = focusPopup;
	document.onkeyup = focusPopup;
	document.onmousemove = focusPopup;
  }

  function focusPopup() {
	if(popupWindow && !popupWindow.closed)
	  popupWindow.focus();
  }
</script>
    