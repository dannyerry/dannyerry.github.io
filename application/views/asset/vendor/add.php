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
			<li><a href="#">MAINTENANCE</a></li>
            <li><a href="<?=base_url('asset/MaintenanceVendor/index')?>">STOCK TRANSFER</a></li>
			<li class="active">VENDOR</li>
		</ol>
	</div>
	<div id="content-wrapper">
		<div id="inner-wrapper">
    
    <form method="post" id="myForm" action="<?= base_url('asset/MaintenanceVendor/do_insert')?>">
		<section>		
			<div class="table-category-header">
				MAINTENANCE VENDOR ADD
			</div>
			<table class="master-table" id="myTable">
				<tr>
					<td>Contract Number</td>
					<td><?= $unique_code; ?></td>
				</tr>
				<tr>
					<td>Contract Category</td>
					<td>
						<select class="form-control" name="contract_category" id="contract_category" class="js-example-basic-single">
								<option value="">Choose Contract Category</option>
							<?php
								foreach($contract_cat as $c){
							?>
								<option value="<?= $c->contract_id ?>"><?= $c->contract_category_name ?></option>
							<?php
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Vendor Name</td>
					<td>
						<select class="form-control" name="vendor_name" id="vendor_name" class="js-example-basic-single">
								<option value="">Choose Vendor</option>
							<?php
								foreach($vendor_name as $vn){
							?>
								<option value="<?= $vn->vendor_id ?>"><?= $vn->vendor_name ?></option>
							<?php
								}
							?>
						</select>
						<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Add Vendor</button>
					</td>
				</tr>
				<tr>
					<td>Contract Description</td>
					<td><textarea class="form-control" name="contratc_desc" placeholder="Contract Description .. " required></textarea></td>
				</tr>
				<tr>
					<td>Contract Signed</td>
					<td><input type="text" name="contract_signed" class="form-control" placeholder="Contract Signed" required></td>
				</tr>
				<tr>
					<td>Contract Expired</td>
					<td><input type="text" name="contract_expired" class="form-control" placeholder="Contract Expired" required></td>
				</tr>
				<tr>
					<td>Contract Value</td>
					<td><input type="text" name="contract_value" class="form-control" placeholder="Contract Value" required></td>
				</tr>
			</table>
			<div class="modal fade" id="myModal" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Modal Header</h4>
						</div>
						<div class="modal-body">
							Vendor Name
							<input type="text" name="input_vendor_name" id="input_vendor_name" class="form-control" placeholder="Vendor Name" required>
							Vendor Adress
							<input type="text" name="input_vendor_address" id="input_vendor_address" class="form-control" placeholder="Vendor Adress" required>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" onclick='do_insert_vendor()'>Submit</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					
					</div>
				</div>
			</div>	
		</section>
		
		<section>
			<div class="section-content"><br />
				<input type="hidden" name="status" id="status">
				<button type="button" class="btn btn-success" onclick="do_insert(0)">Save As Draft</button>
				<button type="button" class="btn btn-primary" onclick="do_insert(1)">Submit</button>
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
	$(document).ready(function() {
	  $("#vendor_name").select2({
		placeholder: "Choose Vendor"
	  });
	  
	  $("#contract_category").select2({
		placeholder: "Choose Contract Category"
	  });
	});
	function do_insert(d){
		$('#status').val(d);
		$("#myForm").submit();
	}	
</script>

<script>
	function do_insert_vendor(){
		//alert('a');
		var dataString = 'input_vendor_name='+$("#input_vendor_name").val()+'&input_vendor_address='+$("#input_vendor_address").val();	
		$.ajax({
			type:'POST',
			data:dataString,
			url:'<?= base_url("asset/MaintenanceVendor/inputVendor") ?>',
			success:function(data) {
				
			}
		}); 
		
		$.ajax({
			type:'POST',
			data:'',
			url:'<?= base_url("asset/MaintenanceVendor/getVendor") ?>',
			dataType: 'json',
			success:function(response) {         
				document.getElementById("vendor_name").innerHTML = "";
				console.log(response.length);
				for (var i = 0; i < response.length; i++) {
					document.getElementById("vendor_name").innerHTML += "<option value='" + response[i].vendor_id + "'>" + response[i].vendor_name + "</option>";
				}
			}
		});
		
		$('#input_vendor_name').val = '';
		$('#input_vendor_address').val = '';
		$('#myModal').modal('hide');
		
	}	
</script>