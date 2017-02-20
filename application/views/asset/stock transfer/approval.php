<div class="col-sm-10 col-sm-offset-2">
	<div class="breadcrumb-menu">
		<ol class="breadcrumb">
			<li><a href="#">TRANSACTION</a></li>
            <li><a href="<?=base_url('dashboard/stock_transfer')?>">STOCK TRANSFER</a></li>
			<li class="active">STOCK TRANSFER APPROVAL</li>
		</ol>
	</div>
	<div id="content-wrapper">
		<div id="inner-wrapper">
    
    <form method="post" action="<?= base_url('asset/stocktransfer/do_approval') ?>">
		<input type="hidden" name="st_id" value="<?= $stock_transfer->stock_transfer_id ?>" >
		<section>		
			<div class="table-category-header">
				STOCK TRANSFER APPROVAL
			</div>
			<table class="master-table" id="myTable">
				<tr>
					<td>Transfer Number</td>
					<td><?= $stock_transfer->stock_transfer_code; ?></td>
				</tr>
				<tr>
					<td>Due Date</td>
					<td><?= date('d/m/Y',strtotime($stock_transfer->stock_transfer_due_date)); ?></td>
				</tr>
				<tr>
					<td>Reference</td>
					<td>Project</td>
					<td>&nbsp;A</td>
				</tr>
				<tr>
					<td>Priority</td>
					<td>Medium</td>
				</tr>
				<tr>
					<td>From Warehouse</td>
					<td><?= $stock_transfer->ware_from ?></td>
				</tr>
				<tr>
					<td>To Warehouse</td>
					<td><?= $stock_transfer->ware_to ?></td>
				</tr>
				<tr>
					<td>Initiate Date</td>
					<td><?= date('d/m/Y',strtotime($stock_transfer->stock_transfer_initiate_date)); ?></td>
				</tr>
			</table>
		</section><br />
		<section>
			<div class="section-content">
			<strong>ASSET</strong>
				<table width="100%" class="third-table">
					<thead>
						<tr>
							<th>No</th>
							<th>Items</th>
							<th>Stock</th>
							<th>Request Qty</th>
							<th>Note</th>
							<th>Deduction</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($assetPicked as $x=>$a){ ?>
						<tr>
							<td><?=$x+1?></td>
							<td><?= $a->asset_name ?></td>
							<td><?= $a->actual_stock ?></td>
							<td><?= $a->stock_transfer_asset_detail_qty_requested ?></td>
							<td><?= $a->stock_transfer_asset_detail_note ?></td>
							<td>
								<input ng-model="deduction" type="text" name="deductionAsset<?=$x?>" onchange="changedAsseta(this);" class="form-control" value="<?= $a->stock_transfer_asset_detail_deduction ?>" required>
								<input type="hidden" name="assetId<?=$x?>" value="<?=$a->stock_transfer_asset_detail_id?>">
							</td>
						</tr>
					<?php }?>
					</tbody>
				</table>
			</div>
		</section><br />
		<section>
			<div class="section-content">
			<strong>INVENTORY</strong>
				<table width="100%" class="third-table">
					<thead>
						<tr>
							<th>No</th>
							<th>Items</th>
							<th>Stock</th>
							<th>Request Qty</th>
							<th>Note</th>
							<th>Deduction</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($inventoryPicked as $y=>$i){ ?>
						<tr>
							<td><?=$y+1?></td>
							<td><?= $i->inventory_name ?></td>
							<td><?= $i->inventory_stock_qty ?></td>
							<td><?= $i->stock_transfer_inventory_detail_qty_requested ?></td>
							<td><?= $i->stock_transfer_inventory_detail_note?></td>
							<td>
								<input ng-model="deduction" type="text" name="deductionInventory<?=$y?>" onchange="changedInventorya(this);" class="form-control" value="<?= $i->stock_transfer_inventory_detail_deduction ?>" required>
								<input type="hidden" name="inventoryId<?=$y?>" value="<?=$i->stock_transfer_inventory_detail_id?>">
							</td>
						</tr>
					<?php }?>
					</tbody>
				</table>
				<br /><strong>Notes :</strong><?= $stock_transfer->stock_transfer_notes ?>
				<input type="hidden" name="changedAsset" id="changedAsset">
				<input type="hidden" name="changedInventory" id="changedInventory">
			</div>
		</section>
		<section>
			<div class="section-content"><br />
				<button type="submit" class="btn btn-success">Approve</button>
				<button class="btn btn-danger">Reject</button>
				<button class="btn btn-info" id="st_back">Back</button>
			</div>
		</section>
    </form>
	<a href="#" class="back-top">
		<div class="back-to-top">
			<i class="fa fa-chevron-up"></i><br/>TOP
		</div>
	</a>
	
<script>
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

<!-- format decimal number -->
<script>
	$(document).ready(function(){
		$('#ddd').datepick();
		$('#ddd2').datepick();
		
		$('#st_back').click(function(a){
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