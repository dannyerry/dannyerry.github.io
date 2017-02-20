<div class="col-sm-10 col-sm-offset-2">
	<div class="breadcrumb-menu">
		<ol class="breadcrumb">
			<li><a href="#">TRANSACTION</a></li>
			<li><a href="<?=base_url("dashboard/stock_opname")?>">STOCK OPNAME</a></li>
			<li class="active">STOCK OPNAME VARIANCE</li>
		</ol>
	</div>
	<div id="content-wrapper">
		<div id="inner-wrapper">
			<section>
				<div class="section-content">
					<table width="100%" class="third-table">
						<thead>
							<tr>
								<th>Asset Code</th>
								<th>Asset Name</th>
								<th>Actual Stock</th>
                                <th>System Stock</th>
                                <th>Remark</th>
                                <th>Variance List</th>
                                <th>Justiification</th>
							</tr>
						</thead>
						<tbody>
                            <tr>
                                <td colspan="7" style="text-align:center">No data available in table</td>
                            </tr>
						</tbody>
					</table>
				</div>
			</section><br />
            <section>
				<div class="section-content">
					<table width="100%" class="third-table">
						<thead>
							<tr>
								<th>Inventory Code</th>
								<th>Inventory Name</th>
								<th>Actual Stock</th>
                                <th>System Stock</th>
                                <th>Remark</th>
                                <th>Variance List</th>
                                <th>Justiification</th>
							</tr>
						</thead>
						<tbody>
                        <?php for($i=1;$i<=10;$i++){?>
                            <tr>
                                <td><?=$i*2018?></td>
                                <td>Inventory Name <?=$i?></td>
                                <td><?=$as=$i*3?></td>
                                <td><?=$ss=$as+5+$i?></td>
                                <td>Lorem Ipsum</td>
                                <td>-<?=$ss-$as?></td>
                                <td><input type="text" class="form-control" name="justification" placeholder="Justification"/></td>
                            </tr>
                        <?php }?>
						</tbody>
					</table>
				</div>
			</section>
            &nbsp;
            <section>
                <div class="section-content">
                    <button type="submit" class="btn btn-success">Save As Draft</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="<?=base_url('dashboard/stock_opname')?>"><button class="btn btn-warning">Cancel</button></a>
                </div>
            </section>