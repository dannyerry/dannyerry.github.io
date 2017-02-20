
<div class="col-md-10 col-md-offset-2 col-sm-offset-0 col-sm-12">
	<div id="content-wrapper">
		<div id="inner-wrapper">
			<section>
				<form method="post" action="<?= base_url('asset/employee/do_insert')?>">
					<div class="table-holder">
					<table class="master-table">
						<tr>
							<td>Employee Name</td>
							<td>
								<input type="text" class="form-control" name="emp_name" required placeholder="enter employee name">
							</td>
						</tr>
						<tr>
							<td>Employee Address</td>
							<td>
								<input type="text" class="form-control" name="emp_addr" required placeholder="enter employee address">
							</td>
						</tr>
						<tr>
							<td>Employee Phone</td>
							<td>
								<input type="text" class="form-control" name="emp_phone" required placeholder="enter employee phone number">
							</td>
						</tr>
						<tr>
							<td>Employee Email</td>
							<td>
								<input type="email" class="form-control" name="emp_email" required placeholder="enter employee email address">
							</td>
						</tr>
						<tr>
							<td>Department</td>
							<td>
								<select class="form-control" name="department">
									<option value="">SELECT DEPARTMENT</option>
									<?php 
										if(!empty($department)){
											foreach($department as $d){ ?>
												<option value="<?= $d->department_id ?>"><?= $d->department_name ?></option>
											<?php
											}
										}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td>Position</td>
							<td>
								<select class="form-control" name="position">
									<option value="">SELECT POSITION</option>
									<?php 
										if(!empty($position)){
											foreach($position as $p){ ?>
												<option value="<?= $p->position_id ?>"><?= $p->position_name ?></option>
											<?php
											}
										}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<button type="submit" class="btn btn-success" value="submit">Submit</button>
								<button class="btn btn-info">Back</button>
								<button class="btn btn-warning">Save as Draft</button>
							</td>
						</tr>
					</table>
					</div>
				</form>
			</section>