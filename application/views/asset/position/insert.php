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
		<form method="post" action="<?= base_url('asset/position/do_insert') ?>">
			<div class="table-category-header">
				Position ADD
			</div>
			<div class="form-group form-inline">
				<label for="email">Position Name:</label>
				<input type="text" name="position_name" class="form-control" placeholder="Department Name" required style="width:25%">
			</div>
			<button type="submit" class="btn btn-primary">Submit</button>	
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