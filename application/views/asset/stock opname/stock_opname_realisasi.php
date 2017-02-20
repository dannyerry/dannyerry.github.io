<div class="col-sm-10 col-sm-offset-2">
	<div class="breadcrumb-menu">
		<ol class="breadcrumb">
			<li><a href="#">TRANSACTION</a></li>
			<li><a href="<?=base_url("asset/stockopname")?>">STOCK OPNAME</a></li>
			<li class="active">STOCK OPNAME REALISASI</li>
		</ol>
	</div>
	<div id="content-wrapper">
		<div id="inner-wrapper">
            <form action="<?= base_url('asset/stockopname/update_realisasi') ?>" method="post" id='myForm'>
				<input type="hidden" name="stock_opname_id" value="<?= $stock_opname->stock_opname_id; ?>" />
				<input type="hidden" name="status_stock_opname_id" id="status_stock_opname_id" value="" />
				<section>
					<table width="100%" class="master-table">
						<tr>
							<th>By</th>
							<td><?= $stock_opname->employee_name; ?></td>
						</tr>
						<tr>
							<th>Date</th>
							<td><?= date('d/m/Y',strtotime($stock_opname->stock_opname_initiate_date)); ?></td>
						</tr>
						<tr>
							<th>Warehouse</th>
							<td><?= $stock_opname->warehouse_name; ?></td>
						</tr>
					</table>
				</section><br />
				<section>
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="col-md-6 col-sm-12 col-xs-12">
							<table width="100%" class="secondary-table">
								<thead>
									<tr>
										<th>Asset Code</th>
										<th>Asset Name</th>
										<th>Actual Stock</th>
										<th>Remarks</th>
									</tr>
								</thead>
								<tbody>
								<?php if(!empty($asset)){ 
									foreach ($asset as $i=>$a){
								?>
								
									<tr>
										<td><?=$a->asset_id?></td>
										<td><?=$a->asset_name?></td>
										<td>
											<input type="text" class="form-control" name="actual_stockAsset<?=$i?>" onchange="changedAsseta(this);" value="<?= $a->stock_opname_asset_detail_actual_stock ?>"/>
											<input type="hidden" class="form-control" name="detailAsset_id<?=$i?>" value="<?=$a->stock_opname_asset_detail_id?>" />
										</td>
										<td><input type="text" class="form-control" name="remarksAsset<?=$i?>" placeholder="Remarks" value="<?=$a->stock_opname_asset_detail_remarks ?>" onchange="changedAsseta(this);"/></td>
									</tr>
									<?php }
									}?>
								</tbody>
							</table>
						</div>
						<div class="col-md-6 col-sm-12 col-xs-12">
							<table width="100%" class="secondary-table">
								<thead>
									<tr>
										<th>Inventory Code</th>
										<th>Inventory Name</th>
										<th>Actual Stock</th>
										<th>Remarks</th>
									</tr>
								</thead>
								<tbody>
							   <?php if(!empty($inventory)){ 
									foreach ($inventory as $x=>$inv){
								?>
								
									<tr>
										<td><?=$inv->inventory_id?></td>
										<td><?=$inv->inventory_name?></td>
										<td>
											<input type="text" class="form-control" name="actual_stockInventory<?=$x?>" placeholder="0" onchange="changedInventorya(this);" value="<?= $inv->stock_opname_inventory_detail_actual_stock ?>"/>
											<input type="hidden" class="form-control" name="detailInventory_id<?=$x?>" value="<?=$inv->stock_opname_inventory_detail_id?>"/>
										</td>
										<td><input type="text" class="form-control" name="remarksInvetory<?=$x?>" placeholder="Remarks" value="<?=$inv->stock_opname_inventory_detail_remarks ?>" onchange="changedInventorya(this);"/></td>
									</tr>
									<?php }
									}?>
								</tbody>
							</table>
						</div>
					</div>
					<input type="hidden" name="changedAsset" id="changedAsset">
					<input type="hidden" name="changedInventory" id="changedInventory">				
				</section>
				&nbsp;
				<section>
					<div class="section-content">
						<button type="button" class="btn btn-success" onclick='do_update(1)'>Save As Draft</button>
						<button type="button" class="btn btn-primary"  onclick='do_update(2)'>Submit</button>
						<a href="<?=base_url("asset/stockopname")?>"><button class="btn btn-warning">Cancel</button></a>
					</div>
				</section>
			</form>
			<script>
				$(document).ready(function(){
					
				});
				var changedAs=[];
				var changedInv=[];
						
				function changedAsseta(oTextBox) {
					var a = $(oTextBox).closest('tr').index();
					if(changedAs.indexOf(a)==-1){
						changedAs.push(a);
						document.getElementById("changedAsset").value = changedAs;
					}				
				}
				
				function changedInventorya(oTextBox){
					var a = $(oTextBox).closest('tr').index();
					if(changedInv.indexOf(a)==-1){
						changedInv.push(a);
						document.getElementById("changedInventory").value = changedInv;
					}
				}
			</script>
			<script>
				function do_update(xy){
					$('#status_stock_opname_id').val(xy);
					document.getElementById("myForm").submit();
				}
			</script>