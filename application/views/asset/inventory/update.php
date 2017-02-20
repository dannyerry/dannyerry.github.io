<div class="col-sm-10 col-sm-offset-2">
	<div class="breadcrumb-menu">
		<ol class="breadcrumb">
			<li><a href="#">TRACKING</a></li>
			<li><a href="<?=base_url('dashboard/inventory')?>">INVENTORY</a></li>
			<li class="active">EDIT INVENTORY</li>
		</ol>
	</div>
	<div id="content-wrapper">
		<div id="inner-wrapper">
	<section>
		<form method="post">
			<table class="master-table">
				<tr>
					<td>Parent</td>
					<td>
						<select class="form-control" name="parent_code">
							<option value="val1">Parent Code 1</option>
							<option value="val2">Parent Code 2</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Group</td>
					<td>
						<select class="form-control" name="group_code">
							<option value="val1">Group Code 1</option>
							<option value="val2">Group Code 2</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Sub Group 1</td>
					<td>
						<select class="form-control" name="sub_group_1">
							<option value="val1">Sub Group Code 1</option>
							<option value="val2">Sub Group Code 2</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Sub Group 2</td>
					<td>
						<select class="form-control" name="sub_group_2">
							<option value="val1">Sub Group Code 1</option>
							<option value="val2">Sub Group Code 2</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Inventory Code</td>
					<td>
						<input type="text" class="form-control" disabled placeholder="( Auto Generate )">
					</td>
				</tr>
				<tr>
					<td>Inventory Name</td>
					<td>
						<input type="text" class="form-control" required name="inventory_name" placeholder="inventory name">
					</td>
				</tr>
				<tr>
					<td>Category</td>
					<td>
						<select class="form-control" name="category_code">
							<option value="val1">Category Code 1</option>
							<option value="val2">Category Code 2</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Part Number</td>
					<td>
						<input type="number" class="form-control" name="part_number" min="0" required placeholder="0">
					</td>
				</tr>
				<tr>
					<td>Manufacture</td>
					<td>
						<select class="form-control" name="manufacturer_code">
							<option value="val1">List of Manufacturer 1</option>
							<option value="val2">List of Manufacturer 2</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Description</td>
					<td>
						<textarea name="inventory_desc" class="form-control" style="resize:none" rows="8" placeholder="Inventory Description" required></textarea>
					</td>
				</tr>
				<tr>
					<td>Dimension</td>
					<td>
						<input type="number" name="inventory_width" placeholder="width" min="0" required class="form-control right-control2">
						<span class="meter">Meter</span>
						<input type="number" name="inventory_height" placeholder="height" min="0" required class="form-control right-control2">
						<span class="meter">Meter</span>
					</td>
				</tr>
				<tr>
					<td>Weight</td>
					<td>
						<input type="number" name="inventory_weight" placeholder="0" min="0" required class="form-control right-control2">
						<select name="weight_satuan" class="form-control">
							<option value="val1">Kg</option>
							<option value="val2">Ton</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Merk</td>
					<td>
						<input type="text" class="form-control" name="inventory_merk" required placeholder="merk">
					</td>
				</tr>
				<tr>
					<td>Type</td>
					<td>
						<input type="text" class="form-control" name="inventory_type" required placeholder="type">
					</td>
				</tr>
				<tr>
					<td>Model</td>
					<td>
						<input type="text" class="form-control" name="inventory_model" required placeholder="model">
					</td>
				</tr>
				<tr>
					<td>Department</td>
					<td>
						<label class="checkbox-inline"><input type="checkbox" value="dep1">Department 1</label>
						<label class="checkbox-inline"><input type="checkbox" value="dep2">Department 2</label>
						<label class="checkbox-inline"><input type="checkbox" value="dep3">Department 3</label>
						<label class="checkbox-inline"><input type="checkbox" value="dep4">Department 4</label>
						<label class="checkbox-inline"><input type="checkbox" value="dep4">Department 5</label>
					</td>
				</tr>
				<tr>
					<td>Warehouse</td>
					<td>
						<select name="inventory_warehouse" class="form-control">
							<option value="val1">Warehouse Data 1</option>
							<option value="val2">Warehouse Data 2</option>
							<option value="val2">Warehouse Data 3</option>
							<option value="val2">Warehouse Data 4</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Rack No</td>
					<td>
						<input type="number" min="0" class="form-control" name="inventory_rack_no" required placeholder="0">
					</td>
				</tr>
				<tr>
					<td>Initiate Stock</td>
					<td>
						<input type="number" min="0" class="form-control" name="inventory_initiate_stock" required placeholder="0">
					</td>
				</tr>
				<tr>
					<td>Upload File</td>
					<td>
						<input type="file" class="form-control" name="inventory_file" required>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>
						<textarea name="inventory_caption" class="form-control" style="resize:none" rows="8" placeholder="Caption"></textarea>
					</td>
				</tr>
				<tr>
					<td>Procurement Schedule</td>
					<td>
						<input type="number" min="0" class="form-control right-control2" name="inventory_procurement_schedule" required placeholder="0">
						<span class="meter">Days</span>
					</td>
				</tr>
				<tr>
					<td>Density</td>
					<td>
						<input type="number" class="form-control" name="inventory_density" placeholder="0" required>
					</td>
				</tr>
				<tr>
					<td>Photo</td>
					<td>
						<input type="file" class="form-control" name="inventory_photo" required>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<button type="submit" name="inventory_add_submit" class="btn btn-primary">Submit</button>
						<button class="btn btn-warning" id="inv_back">Back</button>
					</td>
				</tr>
			</table>
		</form>
	</section>
	<script>
		$(document).ready(function(){
			$('#inv_back').click(function(ev){
				var url="<?=base_url('dashboard/inventory')?>";
				$(location).attr("href",url);
				ev.preventDefault();
			});
		});
	</script>