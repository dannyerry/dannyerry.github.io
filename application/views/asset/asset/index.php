<div class="col-sm-10 col-sm-offset-2">
	<div class="breadcrumb-menu">
		<ol class="breadcrumb">
			<li><a href="#">TRACKING</a></li>
			<li><a href="#">ASSET</a></li>
			<li class="active">LIST & TRACKING</li>
		</ol>
	</div>
	<div id="content-wrapper">
		<div id="inner-wrapper">
	<section>
		<div class="section-header">
			<div class="filter-group-left">
				<label>SEARCH BY :</label>
				<select name="asset_param" class="form-control">
					<option value="1">ASSET CODE</option>
					<option value="2">ASSET NAME</option>
					<option value="3">SERIAL NUMBER</option>
					<option value="4">DEPARTMENT</option>
					<option value="5">WAREHOUSE</option>
					<option value="6">PROJECT</option>
					<option value="7">LOCATION</option>
					<option value="8">RACK NO</option>
					<option value="9">QUANTITY</option>
				</select>
				<input type="text" class="form-control" name="asset_value_param" placeholder="value">
				<button type="submit" name="submit_param" class="btn btn-default"><i class="fa fa-search"></i></button>
			</div>
		</div>
	</section>
	<section>
		<div class="section-content">
			<div class='section-content-header'>
				<a href="<?=base_url('dashboard/add_asset')?>"><button class="btn btn-primary btn-atas">ADD NEW ASSET</button></a>
					<div class='filter-group'>
						<label>FILTER BY :</label>
						<input type='radio' name='all'><label>ALL</label>
						<input type='radio' name='all'><label>LOCATION</label>
						<input type='radio' name='all'><label>PERSONEL</label>
						<input type='radio' name='all'><label>APPLICATION</label>
						<button style='margin-top: 5px' type="submit" name="submit_filter" class="btn btn-default">Go</button>
					</div>
			</div>
			<table width="100%" class="secondary-table">
				<thead>
					<tr>
						<th>Asset Code</th>
						<th>Asset Name</th>
						<th>Serial Number</th>
						<th>Department</th>
						<th>Warehouse</th>
						<th>Project</th>
						<th>Location</th>
						<th>Certificate</th>
						<th>Certificate Expired</th>
						<th>Latest Maintenance</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Code Dummy</td>
						<td>Data Dummy</td>
						<td>000000000</td>
						<td>Data Dummy</td>
						<td>Data Dummy</td>
						<td>Data Dummy</td>
						<td>Data Dummy</td>
						<td>ISO 1995</td>
						<td>1 April 2016</td>
						<td>1 April 2016</td>
						<td>
							<a href="<?=base_url('controller/view_asset')?>"><button class="btn btn-default" title="view data"><i class="fa fa-search"></i></button></a>
							<a href="<?=base_url('dashboard/edit_asset')?>"><button class="btn btn-primary" title="edit data"><i class="fa fa-pencil"></i></button></a>
							<button class="btn btn-danger" title="delete data"><i class="fa fa-close"></i></button>
						</td>
					</tr>
					<tr>
						<td>Code Dummy</td>
						<td>Data Dummy</td>
						<td>000000000</td>
						<td>Data Dummy</td>
						<td>Data Dummy</td>
						<td>Data Dummy</td>
						<td>Data Dummy</td>
						<td>ISO 1995</td>
						<td>1 April 2016</td>
						<td>1 April 2016</td>
						<td>
							<a href="<?=base_url('dashboard/view_asset')?>"><button class="btn btn-default" title="view data"><i class="fa fa-search"></i></button></a>
							<a href="<?=base_url('dashboard/edit_asset')?>"><button class="btn btn-primary" title="edit data"><i class="fa fa-pencil"></i></button></a>
							<button class="btn btn-danger" title="delete data"><i class="fa fa-close"></i></button>
						</td>
					</tr>
					<tr>
						<td>Code Dummy</td>
						<td>Data Dummy</td>
						<td>000000000</td>
						<td>Data Dummy</td>
						<td>Data Dummy</td>
						<td>Data Dummy</td>
						<td>Data Dummy</td>
						<td>ISO 1995</td>
						<td>1 April 2016</td>
						<td>1 April 2016</td>
						<td>
							<a href="<?=base_url('dashboard/view_asset')?>"><button class="btn btn-default" title="view data"><i class="fa fa-search"></i></button></a>
							<a href="<?=base_url('dashboard/edit_asset')?>"><button class="btn btn-primary" title="edit data"><i class="fa fa-pencil"></i></button></a>
							<button class="btn btn-danger" title="delete data"><i class="fa fa-close"></i></button>
						</td>
					</tr>
					<tr>
						<td>Code Dummy</td>
						<td>Data Dummy</td>
						<td>000000000</td>
						<td>Data Dummy</td>
						<td>Data Dummy</td>
						<td>Data Dummy</td>
						<td>Data Dummy</td>
						<td>ISO 1995</td>
						<td>1 April 2016</td>
						<td>1 April 2016</td>
						<td>
							<a href="<?=base_url('dashboard/view_asset')?>"><button class="btn btn-default" title="view data"><i class="fa fa-search"></i></button></a>
							<a href="<?=base_url('dashboard/edit_asset')?>"><button class="btn btn-primary" title="edit data"><i class="fa fa-pencil"></i></button></a>
							<button class="btn btn-danger" title="delete data"><i class="fa fa-close"></i></button>
						</td>
					</tr>
					<tr>
						<td>Code Dummy</td>
						<td>Data Dummy</td>
						<td>000000000</td>
						<td>Data Dummy</td>
						<td>Data Dummy</td>
						<td>Data Dummy</td>
						<td>Data Dummy</td>
						<td>ISO 1995</td>
						<td>1 April 2016</td>
						<td>1 April 2016</td>
						<td>
							<a href="<?=base_url('dashboard/view_asset')?>"><button class="btn btn-default" title="view data"><i class="fa fa-search"></i></button></a>
							<a href="<?=base_url('dashboard/edit_asset')?>"><button class="btn btn-primary" title="edit data"><i class="fa fa-pencil"></i></button></a>
							<button class="btn btn-danger" title="delete data"><i class="fa fa-close"></i></button>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</section>
