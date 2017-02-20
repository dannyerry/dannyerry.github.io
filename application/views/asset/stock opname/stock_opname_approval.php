<div class="col-sm-10 col-sm-offset-2">
	<div class="breadcrumb-menu">
		<ol class="breadcrumb">
			<li><a href="#">TRANSACTION</a></li>
			<li><a href="<?=base_url("dashboard/stock_opname")?>">STOCK OPNAME</a></li>
			<li class="active">STOCK OPNAME JUSTIFICATION</li>
		</ol>
	</div>
	<div id="content-wrapper">
		<div id="inner-wrapper">
            <section>
				<table width="100%" class="master-table">
					<tr>
						<th>By</th>
						<td><?= $stock_opname->employee_name  ?></td>
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
                                    <th>System Stock</th>
                                    <th>Remarks</th>
            					</tr>
            				</thead>
                            <tbody>
                            <?php foreach($asset as $a){?>
                                <tr>
                                    <td><?=$a->asset_id?></td>
                                    <td><?=$a->asset_name?></td>
                                    <td><?= $a->stock_opname_asset_detail_actual_stock ?></td>
                                    <td>?</td>
                                    <td><?= $a->stock_opname_asset_detail_remarks ?></td>
                                </tr>
                            <?php }?>
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
                                    <th>System Stock</th>
                                    <th>Remarks</th>
            					</tr>
            				</thead>
                            <tbody>
                            <?php foreach($inventory as $i){ ?>
                                <tr>
                                    <td><?=$i->inventory_id?></td>
                                    <td><?=$i->inventory_name?></td>
                                    <td><?=$i->stock_opname_inventory_detail_actual_stock?></td>
                                    <td>?</td>
                                    <td><?= $i->stock_opname_inventory_detail_remarks ?></td>
                                </tr>
                            <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>            
            </section>
            &nbsp;
            <section>
                <div class="section-content">
                    <button type="submit" class="btn btn-success">Approve</button>
                    <button class="btn btn-danger">Reject</button>
                    <a href="<?=base_url('dashboard/stock_opname')?>"><button class="btn btn-info">Back</button></a>
                </div>
            </section>