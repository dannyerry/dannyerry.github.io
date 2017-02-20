<div class="col-sm-10 col-sm-offset-2">
	<div class="breadcrumb-menu">
		<ol class="breadcrumb">
			<li><a href="#">USER MANAGEMENT</a></li>
			<li class="active">USER LIST</li>
		</ol>
	</div>
	<div id="content-wrapper">
		<div id="inner-wrapper">
			<section>
				<div class="section-header text-right">
					SEARCH BY :
					<div class="filter-group">
						<input type="text" class="form-control value1" name="value" placeholder="Search Department Name">
						<button type="submit" class="btn btn-default" onclick="excecuteSearch()"><i class="fa fa-search"></i></button>
					</div>
				</div>
			</section>
			<section>
				<div class="section-content">
					<a href="<?=base_url('asset/department/insert')?>"><button class="btn btn-primary btn-atas">ADD NEW DEPARTMENT</button></a></br></br>
					<table width="100%" class="secondary-table" id="dataTableAsset">
						<thead>
							<tr>
								<th>No</th>
								<th class="no-sort">Department Name</th>
								<th class="no-sort">Action</th>
							</tr>
						</thead>
						<tbody>

						</tbody>
					</table>
				</div>
			</section>



			<script type="text/javascript">
				var table;
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
							"url" : "<?=base_url('asset/department/get_department_list')?>",
							"type" : "POST",
							"data" : function (d) {
								if ( $('.value1').val() != '') {
									d.value1 = $('.value1').val();
								} else {
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
