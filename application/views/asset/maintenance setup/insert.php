<div class="col-sm-10 col-sm-offset-2">
	<div class="breadcrumb-menu">
		<ol class="breadcrumb">
            <li><a href="#">MAINTENANCE</a></li>
            <li><a href="<?=base_url('maintenance/maintenance_setup_index')?>">MAINTENANCE SETUP</a></li>
            <li class="active">ADD</li>
		</ol>
	</div>
	<div id="content-wrapper">
		<div id="inner-wrapper">
    <form method="post" action="<?=base_url("maintenance/maintenance_setup_insert")?>">
	<section>
		<div class="table-category-header">
			ADD MAINTENANCE SETUP
		</div>
        <input name="asset_id" type="hidden" value="<?=$asset[0]->asset_id?>">
        <input name="asset_code" type="hidden" value="<?=$asset[0]->asset_code?>">
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
        <table class="master-table" width="100%">
            <tr>
                <th>Maintenance Periode</th>                
                <td>
                    <select class="form-control" name="periode">
                        <option value="days">Daily</option>
                        <option value="months">Monthly</option>
                        <option value="years">Yearly</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Running Hours</th>
                <td><input type="number" class="form-control" name="maintenance_running_hours"></td>
            </tr>            
            <tr>
                <th>Maintenance Schedule</th>
                <td><input type="number" class="form-control" name="maintenance_schedule"></td>
            </tr>                       
            <tr>
                <th>Assignment Type</th>
                <td>
                    <label><input type="radio" name="maintenance_assignment_type" value="0">Internal</label>
                    <label><input type="radio" name="maintenance_assignment_type" value="1">External</label>
                </td>
            </tr>
        </table>
    </section>
    <section>
        <div class="section-content"><br />
            <button type="submit" class="btn btn-primary">SUBMIT</button>
        </div>
    </section>
    </form>
