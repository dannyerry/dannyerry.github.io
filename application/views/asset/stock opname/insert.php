<style>
.tabcontent {
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
            <li><a href="<?=base_url('stock_opname')?>">STOCK OPNAME</a></li>
			<li class="active">STOCK OPNAME ADD</li>
		</ol>
	</div>
	<div id="content-wrapper">
		<div id="inner-wrapper">
    
    <form method="post" ng-app="myApp" ng-controller="myCtrl">
		<section >		
			<div class="table-category-header">
				STOCK OPNAME ADD
			</div>
			<table class="master-table" id="myTable">
				<tr>
					<td>Waarehouse</td>
					<td>
						<select class="form-control warehouseplace" ng-model="warehouseplace" name="warehouseplace" ng-change="changewarehouse()" onchange="excecuteSearch()">
							<option value="">Choose Warehouse Location</option>
							<option ng-repeat="da in data" value="{{da.warehouse_name}}~{{da.warehouse_id}}">{{da.warehouse_location}}</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Warehouse</td>
					<td><span>{{warehousename}}</span></td>
				</tr>
				<tr>
					<td>Date</td>
					<td><?=date("d/m/Y")?></td>
				</tr>
			</table>
		</section>
		<section>    
			<input type="radio"  name="tab" value="asset" checked="checked"/>Asset &nbsp;<input type="radio" value="inventory" name="tab"/>Inventory
			<div class="section-content" style="border: 1px solid; height: 400px; overflow-y: scroll;">
				<div class="tabcontent" id="asset">
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
								<th class="no-sort">Asset Code</th>
								<th class="no-sort">Asset Name</th>
								<th class="no-sort">Serial Number</th>
								<th class="no-sort">Certificate</th>
								<th class="no-sort"></th>
							</tr>
						</thead>
						<tbody>
						
						</tbody>
					</table>
				</div>
				<br />
				<div class="tabcontent" id="inventory">
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
								<th></th>
							</tr>
						</thead>
						<tbody>
						
						</tbody>
					</table>
				</div>	
			</div>
		</section><br />
		<section>
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="col-md-6 col-sm-12 col-xs-12">
					<table width="100%" class="secondary-table" id="assetInsert">
						<thead>
							<tr>
								<th>Asset Code</th>
								<th>Asset Name</th>
								<th>Serial Number</th>
								<th>Department</th>
							</tr>
						</thead>
						<tbody>
						
						</tbody>
					</table>
				</div>
				<div class="col-md-6 col-sm-12 col-xs-12">
					<table width="100%" class="secondary-table" id="inventoryInsert">
						<thead>
							<tr>
								<th>Inventory Code</th>
								<th>Inventory Name</th>
								<th>Part Number</th>
								<th>Department</th>
							</tr>
						</thead>
						<tbody>
						
						</tbody>
					</table>
				</div>
			</div>            
		</section>
		&nbsp;
		<section>
			<div class="section-content"><br />
				<button type="submit" class="btn btn-success" onclick="do_insert(0)">Save As Draft</button>
				<button type="button" class="btn btn-primary" onclick="do_insert(1)">Submit</button>
				<button type="submit" class="btn btn-warning" id="opname_cancel">Cancel</button>
			</div>
		</section>
    </form>
	<a href="#" class="back-top">
		<div class="back-to-top">
			<i class="fa fa-chevron-up"></i><br/>TOP
		</div>
	</a>
	
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-resource/1.5.8/angular-resource.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/2.1.4/ui-bootstrap-tpls.js"></script>
<script type="text/javascript">
	var app = angular.module("myApp", ['ui.bootstrap', 'ngResource']);
	app.controller("myCtrl", function($scope,$timeout,$window) {
		$timeout(function(){
			$scope.data = <?php echo json_encode($warehouse) ?>;
			$scope.changewarehouse = function() {
				var warehousename= $scope.warehouseplace;
				warehousename=warehousename.split('~');
				$scope.warehousename=warehousename[0];
			}
		});
		
		
	});
	
	
	

  
  
	
</script>
<!-- create tab -->
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
	var arrayDataInsertAsset=<?= $asset ?>;
	var arrayDataInsertInventory= <?= $inventory ?>;
		
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
				"url" : "<?=base_url('asset/stockopname/get_asset_list')?>",
				"type" : "POST",
				"data" : function (d) {
					d.warehouse = $('.warehouseplace').val();
					d.ass = arrayDataInsertAsset;
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
				"url" : "<?=base_url('asset/stockopname/get_inventory_list')?>",
				"type" : "POST",
				"data" : function (d) {
					d.warehouse = $('.warehouseplace').val();
					d.inv = arrayDataInsertInventory;
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
<script>
	function excecuteSearch(){
		table.ajax.reload();
		table2.ajax.reload();
	}
</script>

<script>
	function createTableAsset(a,b,c,d,e){
		var table = document.getElementById("assetInsert");
		var rowIndex = document.getElementById(a+e);
		if(rowIndex==null){
			arrayDataInsertAsset.push(a);
			var result = "";
			result += "<tr id='"+a+e+"'>";
			result += "<td>"+replace_str(e)+"</td>";
			result += "<td>"+replace_str(b)+"</td>";
			result += "<td>"+replace_str(d)+"</td>";
			result += "<td>"+replace_str(c)+"</td>";		
			result += "</tr>";
			$("#assetInsert tbody").append(result);
		}else{
			i = arrayDataInsertAsset.indexOf(a);
			delete arrayDataInsertAsset[i];
			rowIndex = document.getElementById(a+e).rowIndex;
			table.deleteRow(rowIndex);
		}
	}
</script>
<script>
	function createTableInventory(a,b,c,d,e){
		var table = document.getElementById("inventoryInsert");
		var rowIndex = document.getElementById(a+e);
		console.log(rowIndex);
		if(rowIndex==null){
			arrayDataInsertInventory.push(a);
			var result = "";
			result += "<tr id='"+a+e+"'>";
			result += "<td>"+replace_str(e)+"</td>";
			result += "<td>"+replace_str(b)+"</td>";
			result += "<td>"+replace_str(c)+"</td>";
			result += "<td>"+replace_str(d)+"</td>";		
			result += "</tr>";
			$("#inventoryInsert tbody").append(result);
		}else{
			i = arrayDataInsertInventory.indexOf(a);
			delete arrayDataInsertInventory[i];
			rowIndex = document.getElementById(a+e).rowIndex;
			table.deleteRow(rowIndex);
		}
	}
</script>
<script>
	function replace_str(kata){
		return kata.replace(new RegExp('~', 'g'), ' ');
	}
</script>
<script>
	function do_insert(xy){
		var ware= $('.warehouseplace').val();
		var warehousename=ware.split('~');
		ware=warehousename[1];
		var dataIn = JSON.stringify(arrayDataInsertInventory);
		var dataAs = JSON.stringify(arrayDataInsertAsset);
		 var dataString = 'gudang='+ware+'&dataArrayAsset='+dataAs+'&dataArrayInventory='+dataIn+'jenis='+xy;
		
		$.ajax({
			type:'POST',
			data:dataString,
			url:'do_insert',
			success:function(data) {
				window.location = "<?= base_url('asset/stockopname/index') ?>";
			}
		  });
	}	
</script>
<!-- format decimal number -->
<script>
	$(document).ready(function(){
		$('#ddd').datepick();
		$('#ddd2').datepick();
		
		$('#opname_cancel').click(function(a){
			var url="<?=base_url('dashboard/stock_opname')?>";
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
<script type="text/javascript">
    function add_row(){		
		$('.btn-plus-'+(document.getElementById('param').value - 1)).addClass('hide');
		$('.btn-minus-'+(document.getElementById('param').value - 1)).removeClass('hide');

		var apa = "<tr id='trInput" + document.getElementById('param').value + "' >"
            +"<td id='no"+ document.getElementById('param').value +"'>"+ document.getElementById('param').value +"</td>"
            +"<td><input ng-model='item' type='text' name='item[]' class='form-control' placeholder='Item'></td>"
            +"<td><input ng-model='description' type='text' name='description[]' class='form-control' placeholder='Description'></td>"
            +"<td><input ng-model='actual_stock' type='text' name='actual_stock[]' class='form-control' placeholder='Actual Stock'></td>"
            +"<td><input ng-model='qty_request' type='text' name='qty_request[]' class='form-control' placeholder='Qty Request'></td>"
            +"<td><input ng-model='uom' type='text' name='uom[]' class='form-control' placeholder='UOM'></td>"
            +"<td><input ng-model='remarks' type='text' name='remarks[]' class='form-control' placeholder='Remarks'></td>"
            +"<td><a class='btn btn-plus-"+document.getElementById('param').value+"' onclick='add_row()'><i class='fa fa-plus fa-lg'></i></a>"
            +"<a id='dlt"+document.getElementById('param').value+"' class='btn btn-minus-"+document.getElementById('param').value+"' onclick='delete_row("+document.getElementById('param').value+")'><i class='fa fa-minus fa-lg'></i></a></td></tr>";
		var trInput_name = '#trInput'+ (document.getElementById('param').value -1);
        $(apa).insertAfter($(trInput_name))
        
        document.getElementById('param').value = parseInt(document.getElementById('param').value) + 1;
	}
    
    
    function delete_row(param){
		$("#trInput" + param).remove();
		
		if(document.getElementById('param').value - 1 == param){	       
	       $('.btn-plus-'+(param - 1)).removeClass('hide');
       }else{
            for(i=param +1;i<document.getElementById('param').value;i++){
                $("#trInput" + i).attr('id', 'trInput'+(i-1));
                $("#dlt" + i).attr('onclick', "delete_row("+(i-1)+")");
                $("#dlt" + i).attr('id', 'dlt'+(i-1));
                $("#no" + i).html((i-1));
                $("#no" + i).attr('id', 'no'+(i-1));
                if(i==document.getElementById('param').value - 1){
                    $('.btn-plus-'+i).attr('class', ' btn btn-plus-'+(i-1));
                    $('.btn-minus-'+i).attr('class', ' btn btn-minus-'+(i-1));
                }else{
                    $('.btn-plus-'+i).attr('class', ' btn hide btn-plus-'+(i-1));
                    $('.btn-minus-'+i).attr('class', ' btn btn-minus-'+(i-1));
                }
            }
       }
	   
	   if(document.getElementById('param').value == 3){
            $('.btn-minus-1').addClass('hide');
        }
		
		document.getElementById('param').value = parseInt(document.getElementById('param').value) - 1;
	}
    
</script>