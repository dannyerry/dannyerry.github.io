<div class="col-sm-10 col-sm-offset-2">
	<div class="breadcrumb-menu">
		<ol class="breadcrumb">
			<li><a href="#">USER MANAGEMENT</a></li>
			<li><a href="<?=base_url('user_management/user_groups')?>">USER GROUPS</a></li>
			<li class="active">ADD NEW</li>
		</ol>
	</div>
	<div id="content-wrapper">
		<div id="inner-wrapper">
			<section>
				<form method="post" action="<?=base_url('user_management/user_groups_do_insert')?>">
					<div class="table-category-header">
						ADD NEW USER GROUP
					</div>
					<table class="master-table" id="myTable">
            <tr>
              <td>Group Name</td>
              <td>
								<input type="text" name="group_name" class="form-control">
              </td>
            </tr>
						<tr>
							<td>Description</td>
							<td>
								<textarea name="description" class="form-control"></textarea>
							</td>
						</tr>
						<tr>
							<td>Status</td>
							<td>
								<select name="status" class="form-control">
									<option value="0">Active</option>
									<option value="1">Inactive</option>
								</select>
							</td>
						</tr>
					</table>
					<table width="100%" class="secondary-table" id="dataTableAsset">
						<thead>
							<tr>
								<th>No</th>
								<th class="no-sort">Menu</th>
								<th class="no-sort" width="10%">View</th>
								<th class="no-sort" width="10%">Insert</th>
								<th class="no-sort" width="10%">Update</th>
								<th class="no-sort" width="10%">Delete</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1; ?>
							<?php foreach ($menuInsert as $row) { ?>
								<tr>
									<td><?=(empty($row['childs']) ? $no : "")?></td>
									<td style="text-align:left; padding-left:10px"><?=$row['menuName']?></td>
									<?php if (!empty($row['childs'])) { ?>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
									<?php } else { ?>
										<td>
											<?php if ($row['actView'] != 0) { ?>
												<input type="checkbox" name="view[<?=$row['menuId']?>]" id="view[<?=$row['menuId']?>]" onclick="checkView(<?=$row['menuId']?>)">
											<?php } ?>
										</td>
										<td>
											<?php if ($row['actInsert'] != 0) { ?>
												<input type="checkbox" name="insert[<?=$row['menuId']?>]" id="insert[<?=$row['menuId']?>]" onclick="checkOther(<?=$row['menuId']?>)">
											<?php } ?>
										</td>
										<td>
											<?php if ($row['actUpdate'] != 0) { ?>
												<input type="checkbox" name="update[<?=$row['menuId']?>]" id="update[<?=$row['menuId']?>]" onclick="checkOther(<?=$row['menuId']?>)">
											<?php } ?>
										</td>
										<td>
											<?php if ($row['actDelete'] != 0) { ?>
												<input type="checkbox" name="delete[<?=$row['menuId']?>]" id="delete[<?=$row['menuId']?>]" onclick="checkOther(<?=$row['menuId']?>)">
											<?php } ?>
										</td>
									<?php } ?>
								</tr>
								<?php if (!empty($row['childs'])) { ?>
									<?php foreach ($row['childs'] as $row1) { ?>
										<?php if (empty($row1['childs'])) { ?>
											<tr>
												<td><?=$no?></td>
												<td style="text-align:left; padding-left:20px">~<?=$row1['menuName']?></td>
												<td>
													<?php if ($row1['actView'] != 0) { ?>
														<input type="checkbox" name="view[<?=$row1['menuId']?>]" id="view[<?=$row1['menuId']?>]" onclick="checkView(<?=$row1['menuId']?>)">
													<?php } ?>
												</td>
												<td>
													<?php if ($row1['actInsert'] != 0) { ?>
														<input type="checkbox" name="insert[<?=$row1['menuId']?>]" id="insert[<?=$row1['menuId']?>]" onclick="checkOther(<?=$row1['menuId']?>)">
													<?php } ?>
												</td>
												<td>
													<?php if ($row1['actUpdate'] != 0) { ?>
														<input type="checkbox" name="update[<?=$row1['menuId']?>]" id="update[<?=$row1['menuId']?>]" onclick="checkOther(<?=$row1['menuId']?>)">
													<?php } ?>
												</td>
												<td>
													<?php if ($row1['actDelete'] != 0) { ?>
														<input type="checkbox" name="delete[<?=$row1['menuId']?>]" id="delete[<?=$row1['menuId']?>]" onclick="checkOther(<?=$row1['menuId']?>)">
													<?php } ?>
												</td>
											</tr>
											<?php $no++; ?>
										<?php } else { ?>
											<tr>
												<td></td>
												<td style="text-align:left; padding-left:20px">~<?=$row1['menuName']?></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
											</tr>
										 	<?php foreach ($row1['childs'] as $row2) { ?>
												<tr>
													<td><?=$no?></td>
													<td style="text-align:left; padding-left:30px">-<?=$row2['menuName']?></td>
													<td>
														<?php if ($row2['actView'] != 0) { ?>
															<input type="checkbox" name="view[<?=$row2['menuId']?>]" id="view[<?=$row2['menuId']?>]" onclick="checkView(<?=$row2['menuId']?>)">
														<?php } ?>
													</td>
													<td>
														<?php if ($row2['actInsert'] != 0) { ?>
															<input type="checkbox" name="insert[<?=$row2['menuId']?>]" id="insert[<?=$row2['menuId']?>]" onclick="checkOther(<?=$row2['menuId']?>)">
														<?php } ?>
													</td>
													<td>
														<?php if ($row2['actUpdate'] != 0) { ?>
															<input type="checkbox" name="update[<?=$row2['menuId']?>]" id="update[<?=$row2['menuId']?>]" onclick="checkOther(<?=$row2['menuId']?>)">
														<?php } ?>
													</td>
													<td>
														<?php if ($row2['actDelete'] != 0) { ?>
															<input type="checkbox" name="delete[<?=$row2['menuId']?>]" id="delete[<?=$row2['menuId']?>]" onclick="checkOther(<?=$row2['menuId']?>)">
														<?php } ?>
													</td>
												</tr>
												<?php $no++; ?>
											<?php } ?>
										<?php } ?>
									<?php } ?>
								<?php } ?>
							<?php } ?>
						</tbody>
					</table>
					<table class="master-table" id="myTable">
						<tr>
							<td colspan="2">
								<button type="submit" class="btn btn-primary">Submit</button>
								<button class="btn btn-info" onclick="javascript:history.go(-1)">Back</button>
							</td>
						</tr>
					</table>
				</form>
			</section>
			<a href="#" class="back-top">
				<div class="back-to-top">
					<i class="fa fa-chevron-up"></i><br/>TOP
				</div>
			</a>

			<script>
				function checkView(id) {
					if (document.getElementById('view[' + id + ']').checked != true) {
						if (document.getElementById('insert[' + id + ']'))
							document.getElementById('insert[' + id + ']').checked = false;
						if (document.getElementById('update[' + id + ']'))
							document.getElementById('update[' + id + ']').checked = false;
						if (document.getElementById('delete[' + id + ']'))
							document.getElementById('delete[' + id + ']').checked = false;
					}
				}

				function checkOther(id) {
					if (this.checked != false)
						document.getElementById('view[' + id + ']').checked = true;
				}
			</script>
