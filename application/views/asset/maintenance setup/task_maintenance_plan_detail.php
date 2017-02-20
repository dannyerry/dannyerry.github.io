<!DOCTYPE html>
	<head>
		<title>ADMIN</title>
		<meta charset="UTF-8"/>
		<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'/>
	</head>
	<link rel="stylesheet" href="<?=base_url('asset/dist/css/main.css')?>" type="text/css">
	<link rel="stylesheet" href="<?=base_url('asset/dist/css/bootstrap.min.css')?>" type="text/css">
	<link rel="stylesheet" href="<?=base_url('asset/dist/css/font-awesome.min.css')?>" type="text/css">
	<link rel="stylesheet" href="<?=base_url('asset/dist/css/jquery.datepick.css')?>" type="text/css">
	<script src="<?=base_url('asset/dist/js/root.js')?>"></script>
	<script src="<?=base_url('asset/dist/js/jquery.plugin.js')?>"></script>
	<script src="<?=base_url('asset/dist/js/angular.js')?>"></script>
	<script src="<?=base_url('asset/dist/js/jquery.datepick.min.js')?>"></script>
	<script src="<?=base_url('asset/dist/js/formatter.js')?>"></script>

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="//cdn.datatables.net/plug-ins/1.10.12/pagination/input.js"></script>
  <style>
		#dataTableAsset_filter{
			display:none;
		}
  </style>
    <div id="content-wrapper">
		<div id="inner-wrapper">
	<section>
        <div class="section-content">
    		<table class="master-table" width="100%">
                <tr>
                    <td>Duration</td>
                    <td>: <?=$maintenance[0]->maintenance_duration?></td>
                </tr>
            </table>  
        </div>      
        <?php $p =0; foreach($item_sub_item as $row){?>
        <div class="section-content">
        <table class="secondary-table" width="100%">
            <thead> 
				<tr>
					<th colspan="3">Item Of Work : <?=$row->maintenance_item_of_work_name?></th>
				</tr>
                <tr>
                    <th>Sub Item</th>
                    <th>KPI</th>
                    <th>Justification</th>
                </tr>
			</thead>
            <tbody>
            <?php
                $sub_item = explode(',',$row->sub_item);
                $kpi = explode(',',$row->kpi);
                $justi = explode(',',$row->justi);
                $i=0;
                foreach($sub_item as $row1){?>
                
                <tr>
                    <td><?=$row1?></td>                    
                    <td><?=$kpi[$i]?></td>                   
                    <td><?=$justi[$i]?></td>
                </tr>
                
        <?php   $i++;}?>
            </tbody>
            <thead>
                <tr>
                    <th colspan="3">Equipment Needed</th>                
                </tr>
                <tr>
                    <th>No</th>
                    <th>Item</th>
                    <th>Qty</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $item = explode(',',$equipment[$p]->item);
                $qty = explode(',',$equipment[$p]->item);
                $i=0;
                foreach($item as $row2){?>                
                <tr>
                    <td><?=$i+1?></td>                    
                    <td><?=$row2?></td>                   
                    <td><?=$qty[$i]?></td>
                </tr>
                
        <?php   $i++;}?>
            </tbody>
        </table>
        </div>
        <?php $p++; }?>
        <div class="section-content">
        <table class="secondary-table" width="100%">
            <thead> 
				<tr>
					<th colspan="3">Tools Needed</th>
				</tr>
                <tr>
                    <th>No</th>
                    <th>Inventory</th>
                    <th>Unit</th>
                </tr>
			</thead>
            <tbody>
                <?php $i=0; foreach($tools as $row3){?>
                    <tr>
                        <td><?=$i+1?></td>
                        <td><?=$row3->inventory_name?></td>
                        <td><?=$row3->unit_name?></td>
                    </tr>
                <?php $i++; }?>
            </tbody>
        </table>
        </div>
	</section>
        