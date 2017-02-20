<?php 
//var_dump($asset,$inventory); die();
?>
<style>
.tab-assetInv {
    display: none;
}
.dataTables_filter{
	display:none;
}
</style>
<div class="col-sm-10 col-sm-offset-2">
	<div class="breadcrumb-menu">
		<ol class="breadcrumb">
			<li><a href="#">TRANSACTION</a></li>
            <li><a href="<?=base_url('dashboard/stock_transfer')?>">STOCK TRANSFER</a></li>
			<li class="active">STOCK TRANSFER ADD</li>
		</ol>
	</div>
	<div id="content-wrapper">
		<div id="inner-wrapper">
    
    <form method="post" id="myForm" action="<?= base_url('asset/stocktransfer/do_update')?>">
		<section>		
			<div class="table-category-header">
				STOCK TRANSFER ADD
			</div>
			<table class="master-table" id="myTable">
				<tr>
					<td>Transfer Number</td>
					<td><?= $stock_transfer->stock_transfer_code; ?></td>
				</tr>
				<tr>
					<td>Due Date</td>
					<td><input type="text" name="duedate" id="ddd" class="form-control" value="<?= $stock_transfer->stock_transfer_due_date; ?>" required></td>
				</tr>
				<tr>
					<td>Reference</td>
					<td>
						<select class="form-control" name="reference" id="reference">
							<option value="project">Project</option>
							<option value="maintenance">Maintenance</option>
							<option value="other">Other</option>
						</select>
					</td>
					<td>
						<select class="form-control right-control" name="referencea" id="referencea">
							<option value="A">A</option>
							<option value="B">B</option>
							<option value="C">C</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Priority</td>
					<td>
						<select class="form-control" name="priority" id="priority">
							<option value="normal">Normal</option>
							<option value="medium">Medium</option>
							<option value="urgent">Urgent</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>From Warehouse</td>
					<td>
						<select id="from" class="form-control warehouseplace" name="warehouse_from" onchange="excecuteSearch()">
							<option value="">Select Warehouse</option>
							<?php foreach ($warehouse as $w){ ?>
								<?php if($stock_transfer->from_warehouse_id == $w->warehouse_id) { ?>
									<option value="<?= $w->warehouse_id ?>" selected><?= $w->warehouse_name ?></option>
								<?php }else{ ?>
									<option value="<?= $w->warehouse_id ?>"><?= $w->warehouse_name ?></option>
								<?php } ?>
							<?php } ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>To Warehouse</td>
					<td>
						<select class="form-control" name="warehouse_to" id="warehouse_to">
							<option value="">Select Warehouse</option>
							<?php foreach ($warehouse as $w){ ?>
								<?php if($stock_transfer->to_warehouse_id == $w->warehouse_id) { ?>
									<option value="<?= $w->warehouse_id ?>" selected><?= $w->warehouse_name ?></option>
								<?php }else{ ?>
									<option value="<?= $w->warehouse_id ?>"><?= $w->warehouse_name ?></option>
								<?php } ?>
							<?php } ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Initiate Date</td>
					<td><?= $stock_transfer->stock_transfer_initiate_date; ?></td>
				</tr>
				<tr>
					<td><input type="radio"  name="tab" value="asset" checked="checked"/>Asset &nbsp;<input type="radio" value="inventory" name="tab"/>Inventory</td>
				</tr>
			</table>
		</section>
		<section>    
			<div class="section-content" style="border: 1px solid; height: 400px; overflow-y: scroll;">
				<div class="tab-assetInv"  id="asset">
					<div class="section-header text-right">
						SEARCH BY : 
						<div class="filter-group">
							<select name="forecast_param" class="form-control filter1">
								<option value="asset_code">ASSET CODE</option>
								<option value="asset_name">ASSET NAME</option>
								<option value="asset_serial_number">ASSET SERIAL NUMBER</option>
								<option value="asset_serial_number">ASSET SERIAL NUMBER</option>
							</select>
							<input type="text" class="form-control value1" name="value" placeholder="value">
							<button type="button" class="btn btn-default" onclick="excecuteSearch()"><i class="fa fa-search"></i></button>
						</div>
					</div>
					<table width="100%" class="secondary-table" id="dataTableAsset">
						<thead>
							<tr>
								<th>Asset Code</th>
								<th>Asset Name</th>
								<th>Serial Number</th>
								<th>Certificate</th>
							</tr>
						</thead>
						<tbody>
						
						</tbody>
					</table>
				</div>
				<br />
				<div class="tab-assetInv" id="inventory">
					<div class="section-header text-right">
						SEARCH BY : 
						<div class="filter-group">
							<select name="forecast_param" class="form-control filter2">
								<option value="inventory_code">INVENTORY CODE</option>
								<option value="inventory_name">INVENTORY NAME</option>
								<option value="inventory_part_number">INVENTORY SERIAL NUMBER</option>
							</select>
							<input type="text" class="form-control value2" name="value" placeholder="value">
							<button type="button" class="btn btn-default" onclick="excecuteSearch()"><i class="fa fa-search"></i></button>
						</div>
					</div>
					<table width="100%" class="secondary-table" id="dataTableInventory">
						<thead>
							<tr>
								<th>Inventory Code</th>
								<th>Inventory Name</th>
								<th>Part Number</th>
							</tr>
						</thead>
						<tbody>
						
						</tbody>
					</table>
				</div>	
			</div>
		</section><br />
		<section>
			<div class="section-content">
			<strong>ASSET</strong>
				<table width="100%" class="third-table" id="assetInsert">
					<thead>
						<tr>
							<th>Asset List</th>
							<th>Stock</th>
							<th>Request Qty</th>
							<th>Note</th>
						</tr>
					</thead>
					<tbody>
						<?php
							foreach($assetPicked as $a){ ?>
								<tr id='<?= $a->asset_id ?><?=  $a->asset_code ?>'>
									<td><?= $a->asset_name ?></td>
									<td><?= $a->actual_stock ?></td>
									<td> <input type='text' name='rqasset<?= $a->asset_id ?>' class='form-control' value="<?= $a->stock_transfer_asset_detail_qty_requested ?>" </td>
									<td> <input type='text' name='noteasset<?= $a->asset_id ?>' class='form-control' value="<?= $a->stock_transfer_asset_detail_note ?>"</td>		
								</tr>
						<?php
							}
						?>
					</tbody>
				</table>
			</div>
		</section><br />
		<section>
			<div class="section-content">
			<strong>INVENTORY</strong>
				<table width="100%" class="third-table" id="inventoryInsert">
					<thead>
						<tr>
							<th>Inventory List</th>
							<th>Stock</th>
							<th>Request Qty</th>
							<th>Note</th>
						</tr>
					</thead>
					<tbody>
						<?php
							foreach($inventoryPicked as $i){ ?>
								<tr id='<?= $i->inventory_id ?><?=  $i->inventory_code ?>'>
									<td><?= $i->inventory_name ?></td>
									<td><?= $i->inventory_stock_qty ?></td>
									<td> <input type='text' name='rqinventory<?= $i->inventory_id ?>' class='form-control' value="<?= $i->stock_transfer_inventory_detail_qty_requested ?>" </td>
									<td> <input type='text' name='noteinventory<?= $i->inventory_id ?>' class='form-control' value="<?= $i->stock_transfer_inventory_detail_note ?>"</td>		
								</tr>
						<?php
							}
						?>
					</tbody>
				</table>
				<br /><strong>Notes :</strong><textarea id="notes" class="form-control" name="notes" style="resize:none" required><?= $stock_transfer->stock_transfer_notes ?></textarea>
			</div>
		</section>
		<section>
			<input type='hidden' name='arrayDataInsertInventory' id='arrayDataInsertInventory'>
			<input type='hidden' name='arrayDataInsertAsset' id='arrayDataInsertAsset'>
			<input type="hidden" name="st_id" value="<?= $stock_transfer->stock_transfer_id ?>" >
			<div class="section-content"><br />
				<button type="button" class="btn btn-primary" onclick="do_insert()">Submit</button>
				<button type="submit" id="stock_transfer_cancel" class="btn btn-warning">Cancel</button>
			</div>
		</section>
    </form>
	<a href="#" class="back-top">
		<div class="back-to-top">
			<i class="fa fa-chevron-up"></i><br/>TOP
		</div>
	</a>
<script>
$(document).ready(function(){
	document.getElementById('asset').style.display = "block";
});

$('input[type=radio][name=tab]').on('change', function(){	
	
	if($(this).val()=='inventory'){
		document.getElementById('inventory').style.display = "block";
		document.getElementById('asset').style.display = "none";
	}else{
		document.getElementById('asset').style.display = "block";
		document.getElementById('inventory').style.display = "none";
	}
             
});
</script>
<script>
	var table;
	var arrayDataInsertAsset = <?= json_encode($assetArr) ?>;
	var arrayDataInsertInventory = <?= json_encode($inventoryArr) ?>;
	
		
	$(document).ready(function() {
		var length = $('#dataTableAsset > thead > tr > th').length;
		var condition = [];
		for (var i=0; i<length; i++) {
			if ($($('#dataTableAsset > thead > tr > th')[i]).hasClass('no-sort')) {
				condition.push({"bSortable": false});
			} else {
				condition.push(null);
			}
		}
		//datatables
		table = $('#dataTableAsset').DataTable({
			"pagingType": "input",
			"aoColumns": condition,
			"processing": true, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			"order": [], //Initial no order.

			// Load data for the table's content from an Ajax source
			"ajax": {
				"url" : "<?=base_url('asset/stocktransfer/get_asset_list')?>",
				"type" : "POST",
				"data" : function (d) {
					d.warehouse = $('.warehouseplace').val();
					d.ass = <?= $asset ?>;
					if (($('.filter1').val() != '') && ($('.value1').val() != '')) {
						d.filter1 = $('.filter1').val();
						d.value1 = $('.value1').val();
					} else {
						d.filter1 = "";
						d.value1 = "";
					}
				}
			},
			//Set column definition initialisation properties.
			"columnDefs": [
			{
				"targets": [ 0 ], //first column / numbering column
				"orderable": false, //set not orderable
			},{
				"targets": [0],
				"searchable": false,
			}
			],
			"lengthMenu": [[20, 50, 100, -1], [20, 50, 100, "All"]],
		});
	});
</script>
<script>
	var table2;
	$(document).ready(function() {
		var length = $('#dataTableInventory > thead > tr > th').length;
		var condition = [];
		for (var i=0; i<length; i++) {
			if ($($('#dataTableInventory > thead > tr > th')[i]).hasClass('no-sort')) {
				condition.push({"bSortable": false});
			} else {
				condition.push(null);
			}
		}
		//datatables
		table2 = $('#dataTableInventory').DataTable({
			"pagingType": "input",
			"aoColumns": condition,
			"processing": true, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			"order": [], //Initial no order.

			// Load data for the table's content from an Ajax source
			"ajax": {
				"url" : "<?=base_url('asset/stocktransfer/get_inventory_list')?>",
				"type" : "POST",
				"data" : function (d) {
					d.warehouse = $('.warehouseplace').val();
					d.inv = <?= $inventory ?>;
					if (($('.filter2').val() != '') && ($('.value2').val() != '')) {
						d.filter1 = $('.filter2').val();
						d.value1 = $('.value2').val();
					} else {
						d.filter1 = "";
						d.value1 = "";
					}
				}
			},
			//Set column definition initialisation properties.
			"columnDefs": [
			{
				"targets": [ 0 ], //first column / numbering column
				"orderable": false, //set not orderable
			},{
				"targets": [0],
				"searchable": false,
			}
			],
			"lengthMenu": [[20, 50, 100, -1], [20, 50, 100, "All"]],
		});
	});
</script>
<!-- format decimal number -->
<script>
	$(document).ready(function(){
		$('#ddd').datepick();
		$('#ddd2').datepick();
		
		$('#stock_transfer_cancel').click(function(a){
			var url="<?=base_url('dashboard/stock_transfer')?>";
			$(location).attr("href",url);
			a.preventDefault();
		});
		
		$('.back-top').click(function(a){
			$('html, body').animate({scrollTop: 0}, 800);
			a.preventDefault();
		});
		
		$('#add_type').click(function(){
			$("#insert-type").fadeToggle(500);
		});
		
		$('#ie_detail').click(function(){
			$("#ie_panel").fadeToggle(500);
		});
	});
</script>
<script>
	function excecuteSearch(){
		table.ajax.reload();
		table2.ajax.reload();
	}
</script>
<script>
	function replace_str(kata){
		return kata.replace(new RegExp('~', 'g'), ' ');
	}
</script>

<script>
	function createTableInventory(a,b,c,d,e){
		var table = document.getElementById("inventoryInsert");
		var rowIndex = document.getElementById(a+d);
		if(rowIndex==null){
			arrayDataInsertInventory.push(a);
			var result = "";
			result += "<tr id='"+a+d+"'>";
			result += "<td>"+replace_str(b)+"</td>";
			result += "<td>"+replace_str(e)+"</td>";
			result += "<td> <input type='text' name='rqinventory"+a+"' class='form-control' placeholder='0'</td>";
			result += "<td> <input type='text' name='noteinventory"+a+"' class='form-control' placeholder='Note'</td>";		
			result += "</tr>";
			$("#inventoryInsert tbody").append(result);
		}else{
			i = arrayDataInsertInventory.indexOf(a);
			delete arrayDataInsertInventory[i];
			rowIndex = document.getElementById(a+d).rowIndex;
			table.deleteRow(rowIndex);
		}
	}
</script>

<script>
	function createTableAsset(a,b,c,d,e){
		var table = document.getElementById("assetInsert");
		var rowIndex = document.getElementById(a+d);
		if(rowIndex==null){
			arrayDataInsertAsset.push(a);
			var result = "";
			result += "<tr id='"+a+d+"'>";
			result += "<td>"+replace_str(b)+"</td>";
			result += "<td>"+replace_str(e)+"</td>";
			result += "<td> <input type='text' name='rqasset"+a+"' class='form-control' placeholder='0'</td>";
			result += "<td> <input type='text' name='noteasset"+a+"' class='form-control' placeholder='Note'</td>";		
			result += "</tr>";
			$("#assetInsert tbody").append(result);
		}else{
			i = arrayDataInsertAsset.indexOf(a);
			delete arrayDataInsertAsset[i];
			rowIndex = document.getElementById(a+d).rowIndex;
			table.deleteRow(rowIndex);
		}
	}
</script>

<script>
	function do_insert(){
		var dataIn = JSON.stringify(arrayDataInsertInventory);
		var dataAs = JSON.stringify(arrayDataInsertAsset);
		$('#arrayDataInsertAsset').val(arrayDataInsertAsset);
		$('#arrayDataInsertInventory').val(arrayDataInsertInventory);
		document.getElementById("myForm").submit();
	}	
</script>