<div class="col-sm-10 col-sm-offset-2">
	<div class="breadcrumb-menu">
		<ol class="breadcrumb">
			<li><a href="#">TRACKING</a></li>
			<li><a href="<?=base_url('dashboard/asset')?>">ASSET</a></li>
			<li class="active">ASSET ADD</li>
		</ol>
	</div>
	<div id="content-wrapper">
		<div id="inner-wrapper">
	<section>
		<form method="post">
			<div class="table-category-header">
				ASSET ADD
			</div>
			<table class="master-table" id="myTable">
                <tr>
                    <td>Parent</td>
                    <td>
                        <select ng-model="parent" class="form-control">
							<option value="asset1">Asset 1</option>
                            <option value="asset2">Asset 2</option>
						</select>
                    </td>
                </tr>
                <tr>
                    <td>Group</td>
                    <td>
                        <select ng-model="group" class="form-control">
							<option value="asset1">Asset 1</option>
                            <option value="asset2">Asset 2</option>
						</select>
                    </td>
                </tr>
                <tr>
                    <td>Sub Group 1</td>
                    <td>
                        <select ng-model="subGroup1" class="form-control">
							<option value="subGroup1A">Sub Group 1A</option>
							<option value="subGroup1B">Sub Group 1B</option>
						</select>
                    </td>
                </tr>
                <tr>
                    <td>Sub Group 2</td>
                    <td>
                        <select ng-model="subGroup2" class="form-control">
							<option value="subGroup2A">Sub Group 2A</option>
							<option value="subGroup2B">Sub Group 2B</option>
						</select>
                    </td>
                </tr>
                <tr>
                    <td>Sub Group 3</td>
                    <td>
                        <select ng-model="subGroup3" class="form-control">
							<option value="subGroup3A">Sub Group 3A</option>
							<option value="subGroup3B">Sub Group 3B</option>
						</select>
                    </td>
                </tr>
                <tr>
                    <td>Sub Group 4</td>
                    <td>
                        <select ng-model="subGroup4" class="form-control">
							<option value="subGroup4A">Sub Group 4A</option>
							<option value="subGroup4B">Sub Group 4B</option>
						</select>
                    </td>
                </tr>
                <tr>
					<td>Asset Code</td>
					<td><input ng-model="asset_code" type="text" name="asset_code" class="form-control" placeholder="Asset Code" disabled></td>
				</tr>
                <tr>
					<td>Asset Name</td>
					<td><input ng-model="asset_name" type="text" name="asset_name" class="form-control" placeholder="Asset Name" required></td>
				</tr>                
                <tr>
					<td>Is Tools?</td>
					<td><input ng-model="is_tools" type="checkbox" name="is_tools" /></td>
				</tr>
                <tr>
                    <td>Category</td>
                    <td>
                        <select ng-model="category" class="form-control">
							<option value="category1">Category 1</option>
							<option value="category2">Category 2</option>
						</select>
                    </td>
                </tr>
                <tr>
					<td>Serial Number</td>
					<td><input ng-model="serial_number" type="text" name="serial_number" class="form-control" placeholder="Serial Number" required></td>
				</tr>
                <tr>
                    <td>Manufacturer</td>
                    <td>
                        <select ng-model="manufacturer" class="form-control">
							<option value="manufacturer1">Manufacturer 1</option>
							<option value="manufacturer2">Manufacturer 2</option>
						</select>
                    </td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td>
						<textarea rows="8" id="description" class="form-control" style="resize:none" placeholder="Description" required></textarea>
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
					<td><input ng-model="merk" type="text" name="merk" class="form-control" placeholder="Merk" required></td>
				</tr>
                <tr>
					<td>Type</td>
					<td><input ng-model="type" type="text" name="type" class="form-control" placeholder="Type" required></td>
				</tr>
                <tr>
					<td>Model</td>
					<td><input ng-model="model" type="text" name="model" class="form-control" placeholder="Model" required></td>
				</tr>
                <tr>
					<td>Years Build</td>
					<td><input ng-model="years_build" type="text" name="years_build" class="form-control" placeholder="Years Build" required></td>
				</tr>
                <tr>
                    <td>Department</td>
                    <td>
                        <div class="col-md-4">
                            <input ng-model="department" type="checkbox" name="department" value="hr"/>HR<br />
                            <input ng-model="department" type="checkbox" name="department" value="finance"/>Finance
                        </div>
                        <div class="col-md-4">
                            <input ng-model="department" type="checkbox" name="department" value="hr"/>HSE<br />
                            <input ng-model="department" type="checkbox" name="department" value="finance"/>Logistic
                        </div>
                        <div class="col-md-4">
                            <input ng-model="department" type="checkbox" name="department" value="hr"/>Purchasing<br />
                            <input ng-model="department" type="checkbox" name="department" value="finance"/>Asset & Inventory
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Warehouse</td>
                    <td>
                        <select ng-model="warehouse" class="form-control">
							<option value="cikande">Cikande</option>
							<option value="cikarang">Cikarang</option>
						</select>
                    </td>
                </tr>
                <tr>
					<td>Rack No</td>
					<td><input ng-model="rack_no" type="text" name="rack_no" class="form-control" placeholder="Rack No" required></td>
				</tr>
                <input id="param" name="param" type="hidden" value="2">
                <tr id="trFile1">
					<td>Upload File</td>
					<td><input type="file" name="file[]" class="form-control" required></td>
                    <td><input ng-model="caption" type="text" name="caption[]" class="form-control" placeholder="Captions" required></td>
                    <td>
                        <a class="btn btn-plus-1" onclick="add_row_file()">
							<i class="fa fa-plus fa-lg"></i>
						</a>
						<a class="btn btn-minus-1 hide" onclick="delete_row_file(1)" >
							<i class="fa fa-minus fa-lg"></i>
						</a>
                    </td>
				</tr>
                <tr>
					<td>Procurement Schedule</td>
					<td>
                        <div class="input-group">
                            <input ng-model="procurement_schedule" type="text" name="procurement_schedule" class="form-control" placeholder="Procurement Schedule" required>
                            <span class="input-group-addon" id="addon"><strong>Days</strong></span>
                        </div>
                    </td>
				</tr>
                <tr>
					<td>Latest Maintenance Schedule</td>
                    <td><input ng-model="latest_maintenance_schedule" type="text" name="latest_maintenance_schedule" class="form-control" placeholder="Latest Maintenance Schedule" required></td>
				</tr>
                <tr>
					<td>Density</td>
					<td><input ng-model="density" type="text" name="density" class="form-control" placeholder="Density" required></td>
				</tr>
                <input id="prm" name="prm" type="hidden" value="2">
                <tr id="trPhoto1">
					<td>Photo</td>
					<td><input type="file" name="photo[]" class="form-control" required></td>
                    <td>
                        <a class="btn btn-plus-photo-1" onclick="add_row_photo()">
							<i class="fa fa-plus fa-lg"></i>
						</a>
						<a class="btn btn-minus-photo-1 hide" onclick="delete_row_photo(1)" >
							<i class="fa fa-minus fa-lg"></i>
						</a>
                    </td>
				</tr>
				<tr>
					<td colspan="2">
						<button type="submit" class="btn btn-primary">Submit</button>
						<a href="<?=base_url('dashboard/asset')?>">
							<button class="btn btn-info" id="asset_back">Back</button>
						</a>
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

<!-- format decimal number -->
<script>
	$(document).ready(function(){
		$('#ddd').datepick();
		$('#ddd2').datepick();
		$('#asset_back').click(function(a){
			var url="<?=base_url('dashboard/asset')?>";
			$(location).attr("href",url);
			a.preventDefault();
		});
		
		$('.back-top').click(function(a){
			$('html, body').animate({scrollTop: 0}, 800);
			a.preventDefault();
		});
		
		$('#add_type').click(function(){
			$("#insert-type").fadeToggle(500);
		});
		
		$('#ie_detail').click(function(){
			$("#ie_panel").fadeToggle(500);
		});
	});
</script>
<script type="text/javascript">
    function add_row_file(){		
		$('.btn-plus-'+(document.getElementById('param').value - 1)).addClass('hide');
		$('.btn-minus-'+(document.getElementById('param').value - 1)).removeClass('hide');

		var apa = "<tr id='trFile" + document.getElementById('param').value + "' >"
            +"<td></td><td><input type='file' name='file[]' class='form-control' required></td>"
			+"<td><input ng-model='caption' type='text' name='caption[]' class='form-control' placeholder='Captions' required></td>"
			+"<td><a class='btn btn-plus-"+document.getElementById('param').value+"' onclick='add_row_file()'><i class='fa fa-plus fa-lg'></i></a>"
            +"<a id='dlt"+document.getElementById('param').value+"' class='btn btn-minus-"+document.getElementById('param').value+"' onclick='delete_row_file("+document.getElementById('param').value+")'><i class='fa fa-minus fa-lg'></i></a></td></tr>";
		var trFile_name = '#trFile'+ (document.getElementById('param').value -1);
        $(apa).insertAfter($(trFile_name))
        
        document.getElementById('param').value = parseInt(document.getElementById('param').value) + 1;
	}
    
    
    function delete_row_file(param){
		$("#trFile" + param).remove();
		
		if(document.getElementById('param').value - 1 == param){	       
	       $('.btn-plus-'+(param - 1)).removeClass('hide');
       }else{
            for(i=param +1;i<document.getElementById('param').value;i++){
                $("#trFile" + i).attr('id', 'trFile'+(i-1));
                $("#dlt" + i).attr('onclick', "delete_row_file("+(i-1)+")");
                $("#dlt" + i).attr('id', 'dlt'+(i-1));
                if(i==document.getElementById('param').value - 1){
                    $('.btn-plus-'+i).attr('class', ' btn btn-plus-'+(i-1));
                    $('.btn-minus-'+i).attr('class', ' btn btn-minus-'+(i-1));
                }else{
                    $('.btn-plus-'+i).attr('class', ' btn hide btn-plus-'+(i-1));
                    $('.btn-minus-'+i).attr('class', ' btn btn-minus-'+(i-1));
                }
            }
       }
	   
	   if(document.getElementById('param').value == 3){
            $('.btn-minus-1').addClass('hide');
        }
		
		document.getElementById('param').value = parseInt(document.getElementById('param').value) - 1;
	}
    
    function add_row_photo(){		
		$('.btn-plus-photo-'+(document.getElementById('prm').value - 1)).addClass('hide');
		$('.btn-minus-photo-'+(document.getElementById('prm').value - 1)).removeClass('hide');

		var apa = "<tr id='trPhoto" + document.getElementById('prm').value + "' >"
            +"<td></td><td><input type='file' name='photo[]' class='form-control' required></td>"
			+"<td><a class='btn btn-plus-photo-"+document.getElementById('prm').value+"' onclick='add_row_photo()'><i class='fa fa-plus fa-lg'></i></a>"
            +"<a id='dlt-photo-"+document.getElementById('prm').value+"' class='btn btn-minus-photo-"+document.getElementById('prm').value+"' onclick='delete_row_photo("+document.getElementById('prm').value+")'><i class='fa fa-minus fa-lg'></i></a></td></tr>";
		var trPhoto_name = '#trPhoto'+ (document.getElementById('prm').value -1);
        $(apa).insertAfter($(trPhoto_name))
        
        document.getElementById('prm').value = parseInt(document.getElementById('prm').value) + 1;
	}
    
    
    function delete_row_photo(prm){
		$("#trPhoto" + prm).remove();
		
		if(document.getElementById('prm').value - 1 == prm){	       
	       $('.btn-plus-photo-'+(prm - 1)).removeClass('hide');
       }else{
            for(i=prm +1;i<document.getElementById('prm').value;i++){
                $("#trPhoto" + i).attr('id', 'trPhoto'+(i-1));
                $("#dlt-photo-" + i).attr('onclick', "delete_row_photo("+(i-1)+")");
                $("#dlt-photo-" + i).attr('id', 'dlt-photo-'+(i-1));
                if(i==document.getElementById('prm').value - 1){
                    $('.btn-plus-photo-'+i).attr('class', ' btn btn-plus-photo-'+(i-1));
                    $('.btn-minus-photo-'+i).attr('class', ' btn btn-minus-photo-'+(i-1));
                }else{
                    $('.btn-plus-photo-'+i).attr('class', ' btn hide btn-plus-photo-'+(i-1));
                    $('.btn-minus-photo-'+i).attr('class', ' btn btn-minus-photo-'+(i-1));
                }
            }
       }
	   
	   if(document.getElementById('prm').value == 3){
            $('.btn-minus-photo-1').addClass('hide');
        }
		
		document.getElementById('prm').value = parseInt(document.getElementById('prm').value) - 1;
	}
    
</script>