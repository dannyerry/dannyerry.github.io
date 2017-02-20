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
			<li><a href="#">MAINTENANCE</a></li>
			<li class="active">VENDOR</li>
		</ol>
	</div>
	<div id="content-wrapper">
		<div id="inner-wrapper">
			<section>
				<div class="section-header text-right">
					SEARCH BY : 
					<div class="filter-group">
						<select name="forecast_param" class="form-control filter1">
							<option value="aw.warehouse_name">WAREHOUSE</option>
							<option value="ae.employee_name">CREATED BY</option>
							<option value="3">DATE</option>
						</select>
						<input type="text" class="form-control value1" id="ddd" name="forecast_param1_value" placeholder="value">
						<button type="submit" name="submit_param" class="btn btn-default" onclick="excecuteSearch()"><i class="fa fa-search"></i></button>
					</div>
				</div>
			</section>
			<section>
				<div class="section-content">
                <a href="<?=base_url('asset/MaintenanceSchedule/insert')?>"><button class="btn btn-primary">NEW</button></a>
					<table width="100%" class="secondary-table" id="stockTransfer">
						<thead>
							<tr>
								<th>No</th>
								<th>Asset Code</th>
								<th>Contract Category</th>
                                <th>Asset Name</th>
                                <th>Maintenance scheduled</th>
                                <th>Maintenance executed</th>
                                <th>See Detail</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</section>
			
			<script>
				var table;
					
				$(document).ready(function() {
					var length = $('#stockTransfer > thead > tr > th').length;
					var condition = [];
					for (var i=0; i<length; i++) {
						if ($($('#stockTransfer > thead > tr > th')[i]).hasClass('no-sort')) {
							condition.push({"bSortable": false});
						} else {
							condition.push(null);
						}
					}
					//datatables
					table = $('#stockTransfer').DataTable({
						"pagingType": "input",
						"aoColumns": condition,
						"processing": true, //Feature control the processing indicator.
						"serverSide": true, //Feature control DataTables' server-side processing mode.
						"order": [], //Initial no order.

						// Load data for the table's content from an Ajax source
						"ajax": {
							"url" : "<?=base_url('asset/MaintenanceSchedule/get_maintenance_schedule_list')?>",
							"type" : "POST",
							"data" : function (d) {
								d.warehouse = $('.warehouseplace').val();
								if (($('.filter1').val() != '') && ($('.value1').val() != '')) {
									console.log("a");
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
	function excecuteSearch(){
		table.ajax.reload();
	}
	
</script>