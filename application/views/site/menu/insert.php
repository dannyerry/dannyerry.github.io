<div class="col-sm-10 col-sm-offset-2">
	<div class="breadcrumb-menu">
		<ol class="breadcrumb">
			<li><a href="#">USER MANAGEMENT</a></li>
			<li><a href="<?=base_url('site/menu')?>">MENU</a></li>
			<li class="active">ADD NEW</li>
		</ol>
	</div>
	<div id="content-wrapper">
		<div id="inner-wrapper">
			<section>
				<form method="post" action="<?=base_url('site/menu_do_insert')?>">
					<div class="table-category-header">
						ADD NEW MENU
					</div>
					<table class="master-table" id="myTable">
						<tr>
							<td>Parent Name</td>
							<td>
								<select name="parent_name" class="form-control">
									<option value="0">Select Parent Name</option>
									<option disabled>──────────────────</option>
									<?php foreach ($menuInsert as $row) { ?>
										<option value="<?=$row['menuId']?>"><?=$row['menuName']?></option>
										<?php if (!empty($row['childs'])) { ?>
											<?php foreach ($row['childs'] as $row1) { ?>
												<option value="<?=$row1['menuId']?>"> - <?=$row1['menuName']?></option>
											<?php } ?>
										<?php } ?>
									<?php } ?>
								</select>
							</td>
						</tr>
            <tr>
              <td>Menu Name</td>
              <td>
								<input type="text" name="menu_name" class="form-control">
              </td>
            </tr>
						<tr>
							<td>Description</td>
							<td>
								<textarea name="description" class="form-control"></textarea>
							</td>
						</tr>
						<tr>
							<td>Access</td>
							<td>
								<input type="checkbox" name="view"> View
								<input type="checkbox" name="insert"> Insert
								<input type="checkbox" name="update"> Update
								<input type="checkbox" name="delete"> Delete
							</td>
						</tr>
						<tr>
							<td>Target - Controller</td>
							<td>
								<select name="target" class="form-control">
									<option value="0">Select Target</option>
									<option disabled>──────────────────</option>
									<?php foreach ($app_routes as $row) { ?>
										<option value="<?=$row->id?>"><?=$row->controller?></option>
									<?php } ?>
								</select>
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
