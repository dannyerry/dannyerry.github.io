<div class="col-sm-10 col-sm-offset-2">
	<div class="breadcrumb-menu">
		<ol class="breadcrumb">
			<li><a href="#">USER MANAGEMENT</a></li>
			<li><a href="<?=base_url('user_management/user_list')?>">USER LIST</a></li>
			<li class="active">UPDATE</li>
		</ol>
	</div>
	<div id="content-wrapper">
		<div id="inner-wrapper">
			<section>
				<form method="post" action="<?=base_url('user_management/user_list_do_update')?>">
					<input type="hidden" name="id" class="form-control" value="<?=$user->hash_id?>">
					<div class="table-category-header">
						USER UPDATE
					</div>
					<table class="master-table" id="myTable">
            <tr>
              <td>Fullname</td>
              <td>
								<input type="text" name="fullname" class="form-control" value="<?=$user->name?>">
              </td>
            </tr>
						<tr>
							<td>Username</td>
							<td>
								<input type="text" name="username" class="form-control" value="<?=$user->username?>">
							</td>
						</tr>
						<tr>
							<td>Password</td>
							<td>
								<input type="password" name="password" class="form-control" placeholder="Leave blank if unchanged">
							</td>
						</tr>
						<tr>
							<td>Confirm Password</td>
							<td>
								<input type="password" name="confirm_password" class="form-control">
							</td>
						</tr>
						<tr>
							<td>User Group</td>
							<td>
								<select name="user_group" class="form-control">
									<option value="">Select User Group</option>
									<option disabled>─────────────</option>
									<?php foreach ($user_groups as $row) { ?>
										<option value="<?=$row->id?>" <?=(($user->user_group_id == $row->id) ? "selected" : "")?>><?=$row->name?></option>
									<?php } ?>
								</select>
							</td>
						</tr>
						<tr>
							<td>Status</td>
							<td>
								<select name="status" class="form-control">
									<option value="0" <?=(($user->is_deleted == 0) ? "selected" : "")?>>Active</option>
									<option value="1" <?=(($user->is_deleted == 1) ? "selected" : "")?>>Inactive</option>
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
