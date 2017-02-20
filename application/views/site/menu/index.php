<div class="col-sm-10 col-sm-offset-2">
	<div class="breadcrumb-menu">
		<ol class="breadcrumb">
			<li><a href="#">SITE</a></li>
			<li class="active">MENU</li>
		</ol>
	</div>
	<div id="content-wrapper">
		<div id="inner-wrapper">
			<section>
				<div class="section-content">
					<a href="<?=base_url('site/menu/insert')?>"><button class="btn btn-primary btn-atas">ADD NEW MENU</button></a></br></br>
					<table width="100%" class="secondary-table" id="dataTableAsset">
						<thead>
							<tr>
								<th>No</th>
								<th class="no-sort">Menu Name</th>
								<th class="no-sort">Target</th>
		            <th class="no-sort">Sorting</th>
								<th class="no-sort">Status</th>
								<th class="no-sort">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1; ?>
							<?php foreach ($menuInsert as $row) { ?>
								<tr>
									<td><?=$no?></td>
									<td style="text-align:left; padding-left:10px"><?=$row['menuName']?></td>
									<td style="text-align:left"><?=$row['controller']?></td>
									<td></td>
									<td><?=(($row['status'] == 0) ? "Active" : "Inactive")?></td>
									<td><a href="<?=base_url('site/menu/update/'.$row['hashId'])?>"><button class="btn btn-primary" title="edit data"><i class="fa fa-pencil"></i></button></a></td>
								</tr>
								<?php if (!empty($row['childs'])) { ?>
									<?php foreach ($row['childs'] as $row1) { ?>
										<?php $no++; ?>
										<tr>
											<td><?=$no?></td>
											<td style="text-align:left; padding-left:20px">~ <?=$row1['menuName']?></td>
											<td style="text-align:left"><?=$row1['controller']?></td>
											<td></td>
											<td><?=(($row['status'] == 0) ? "Active" : "Inactive")?></td>
											<td><a href="<?=base_url('site/menu/update/'.$row1['hashId'])?>"><button class="btn btn-primary" title="edit data"><i class="fa fa-pencil"></i></button></a></td>
										</tr>
										<?php if (!empty($row1['childs'])) { ?>
											<?php foreach ($row1['childs'] as $row2) { ?>
												<?php $no++; ?>
												<tr>
													<td><?=$no?></td>
													<td style="text-align:left; padding-left:30px">- <?=$row2['menuName']?></td>
													<td style="text-align:left"><?=$row2['controller']?></td>
													<td></td>
													<td><?=(($row['status'] == 0) ? "Active" : "Inactive")?></td>
													<td><a href="<?=base_url('site/menu/update/'.$row2['hashId'])?>"><button class="btn btn-primary" title="edit data"><i class="fa fa-pencil"></i></button></a></td>
												</tr>
											<?php } ?>
										<?php } ?>
									<?php } ?>
								<?php } ?>
								<?php $no++; ?>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</section>
