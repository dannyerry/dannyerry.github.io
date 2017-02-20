<div class="col-sm-10 col-sm-offset-2">
	<div class="breadcrumb-menu">
		<ol class="breadcrumb">
			<li><a href="#">USER MANAGEMENT</a></li>
			<li><a href="<?=base_url('user_management/user_groups')?>">USER GROUPS</a></li>
			<li class="active">UPDATE</li>
		</ol>
	</div>
	<div id="content-wrapper">
		<div id="inner-wrapper">
			<section>
				<form method="post" action="<?=base_url('user_management/user_groups_do_update')?>">
					<input type="hidden" name="id" class="form-control" value="<?=$user_group->hash_id?>">
					<div class="table-category-header">
						USER GROUP UPDATE
					</div>
					<table class="master-table" id="myTable">
            <tr>
              <td>Group Name</td>
              <td>
								<input type="text" name="group_name" class="form-control" value="<?=$user_group->name?>">
              </td>
            </tr>
						<tr>
							<td>Description</td>
							<td>
								<textarea name="description" class="form-control"><?=$user_group->description?></textarea>
							</td>
						</tr>
						<tr>
							<td>Status</td>
							<td>
								<select name="status" class="form-control">
									<option value="0" <?=(($user_group->is_deleted == 0) ? "selected" : "")?>>Active</option>
									<option value="1" <?=(($user_group->is_deleted == 1) ? "selected" : "")?>>Inactive</option>
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
												<input type="checkbox" name="view[<?=$row['menuId']?>]" id="view[<?=$row['menuId']?>]" onclick="checkView(<?=$row['menuId']?>)" <?=(($row['actView'] == 1) ? "checked" : "")?>>
											<?php } ?>
										</td>
										<td>
											<?php if ($row['actInsert'] != 0) { ?>
												<input type="checkbox" name="insert[<?=$row['menuId']?>]" id="insert[<?=$row['menuId']?>]" onclick="checkOther(<?=$row['menuId']?>)" <?=(($row['actInsert'] == 1) ? "checked" : "")?>>
											<?php } ?>
										</td>
										<td>
											<?php if ($row['actUpdate'] != 0) { ?>
												<input type="checkbox" name="update[<?=$row['menuId']?>]" id="update[<?=$row['menuId']?>]" onclick="checkOther(<?=$row['menuId']?>)" <?=(($row['actUpdate'] == 1) ? "checked" : "")?>>
											<?php } ?>
										</td>
										<td>
											<?php if ($row['actDelete'] != 0) { ?>
												<input type="checkbox" name="delete[<?=$row['menuId']?>]" id="delete[<?=$row['menuId']?>]" onclick="checkOther(<?=$row['menuId']?>)" <?=(($row['actDelete'] == 1) ? "checked" : "")?>>
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
													<?php if ($row1['actViewMenu'] != 0) { ?>
														<input type="checkbox" name="view[<?=$row1['accessId']?>]" id="view[<?=$row1['accessId']?>]" onclick="checkView(<?=$row1['accessId']?>)" <?=(($row1['actView'] == 1) ? "checked" : "")?>>
													<?php } ?>
												</td>
												<td>
													<?php if ($row1['actInsertMenu'] != 0) { ?>
														<input type="checkbox" name="insert[<?=$row1['accessId']?>]" id="insert[<?=$row1['accessId']?>]" onclick="checkOther(<?=$row1['accessId']?>)" <?=(($row1['actInsert'] == 1) ? "checked" : "")?>>
													<?php } ?>
												</td>
												<td>
													<?php if ($row1['actUpdateMenu'] != 0) { ?>
														<input type="checkbox" name="update[<?=$row1['accessId']?>]" id="update[<?=$row1['accessId']?>]" onclick="checkOther(<?=$row1['accessId']?>)" <?=(($row1['actUpdate'] == 1) ? "checked" : "")?>>
													<?php } ?>
												</td>
												<td>
													<?php if ($row1['actDeleteMenu'] != 0) { ?>
														<input type="checkbox" name="delete[<?=$row1['accessId']?>]" id="delete[<?=$row1['accessId']?>]" onclick="checkOther(<?=$row1['accessId']?>)" <?=(($row1['actDelete'] == 1) ? "checked" : "")?>>
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
														<?php if ($row2['actViewMenu'] != 0) { ?>
															<input type="checkbox" name="view[<?=$row2['accessId']?>]" id="view[<?=$row2['accessId']?>]" onclick="checkView(<?=$row2['accessId']?>)" <?=(($row2['actView'] == 1) ? "checked" : "")?>>
														<?php } ?>
													</td>
													<td>
														<?php if ($row2['actInsertMenu'] != 0) { ?>
															<input type="checkbox" name="insert[<?=$row2['accessId']?>]" id="insert[<?=$row2['accessId']?>]" onclick="checkOther(<?=$row2['accessId']?>)" <?=(($row2['actInsert'] == 1) ? "checked" : "")?>>
														<?php } ?>
													</td>
													<td>
														<?php if ($row2['actUpdateMenu'] != 0) { ?>
															<input type="checkbox" name="update[<?=$row2['accessId']?>]" id="update[<?=$row2['accessId']?>]" onclick="checkOther(<?=$row2['accessId']?>)" <?=(($row2['actUpdate'] == 1) ? "checked" : "")?>>
														<?php } ?>
													</td>
													<td>
														<?php if ($row2['actDeleteMenu'] != 0) { ?>
															<input type="checkbox" name="delete[<?=$row2['accessId']?>]" id="delete[<?=$row2['accessId']?>]" onclick="checkOther(<?=$row2['accessId']?>)" <?=(($row2['actDelete'] == 1) ? "checked" : "")?>>
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
