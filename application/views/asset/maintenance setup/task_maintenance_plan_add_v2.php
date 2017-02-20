<div class="col-sm-10 col-sm-offset-2">
	<div class="breadcrumb-menu">
		<ol class="breadcrumb">
			<li><a href="#">MAINTENANCE</a></li>
            <li><a href="<?=base_url('maintenance/maintenance_setup_index')?>">MAINTENANCE SETUP</a></li>
            <li class="active">TASK MAINTENANCE SETUP</li>
		</ol>
	</div>
	<div id="content-wrapper">
		<div id="inner-wrapper">
	<section>
		<div class="section-content">
        <input type="hidden" id="param_item" value="2"/>
        <input type="hidden" id="param_sub_item1" value="2"/>
        <input type="hidden" id="param_equipment_needed1-1" value="2"/>
        <input type="hidden" id="param_si1" value="2"/>        
        <input type="hidden" id="param_en1" value="2"/>
            <div id="div_item1">
                <div style="border-style:solid; border-color:#D6D6D6; overflow: auto; margin: 0 10% 0% 0%;">
                    <table width="100%" class="detail-table">
        				<tr>
                            <td id="no_item1">1</td>
                            <td>Item</td>
                            <td><input type="text" class="form-control" name="item"/></td>
                        </tr>
                    </table>
                    <div id="div_sub_item1-1">
                        <div style="border-style:solid; margin: 0 25% 2% 5%; float: left;">
                            <table class="detail-table">
                                <tr>
                                    <td >a</td>
                                    <td>Sub Item<br /><input type="text" class="form-control" name="sub_item"/></td>
                                    <td>Category<br /><input type="radio" name="category"/> Internal <input type="radio" name="category"/> Eksternal</td>
                                    <td>KPI<br /><select class="form-control"><option>a</option><option>b</option></select></td>
                                    <td>Justification<br /><input type="text" class="form-control" name="justification"/></td>
                                </tr>
                            </table>
                            <div class="equipment_needed" style="border-style:dashed; border-color:#D6D6D6; margin: 0 40% 2% 5%;" >
                                <table class="detail-table">
                                    <tr>
                                        <td>Equipment Needed</td>
                                    </tr>
                                    <tr id="tr_equipment_needed1-1-1">
                                        <td>Items<br /><select class="form-control" name="items[]"><option>a</option><option>b</option></select></td>
                                        <td>Qty<br /><input type="text" class="form-control" name="qty[]"/></td>
                                        <td>
                                            <a id='add1-1-1' class="btn btn-plus-1-1-1" onclick="add_row_equipment_needed(1,1)" style="margin-top:45%;">
                    							<i class="fa fa-plus fa-lg"></i>
                    						</a>
                    						<a id="dlt1-1-1" class="btn btn-minus-1-1-1 hide" onclick="delete_row_equipment_needed(1,1,1)" style="margin-top:45%;" >
                    							<i class="fa fa-minus fa-lg"></i>
                    						</a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div style="float: left; margin-left: -25%; margin-top: 25%;">
                             <a id="add_sub_item1-1" class="btn btn-add-1-1" onclick="add_row_sub_item(1)">
            					<i class="fa fa-plus fa-lg"></i>
            				</a>
            				<a id="dlt_sub_item1-1" class="btn btn-delete-1-1 hide" onclick="delete_row_sub_item(1,1,1)">
            					<i class="fa fa-minus fa-lg"></i>
            				</a>
                        </div>
                    </div>
                </div>
                <div style=" float: right; margin-top: -3%;margin-right: 7%;">
                    <a id='add_item1' class="btn btn-tambah-1" onclick="add_row_item()">
    					<i class="fa fa-plus fa-lg"></i>
    				</a>
                    <a id='dlt_item1' class="btn btn-kurang-1 hide" onclick="delete_row_item(1,1)">
    					<i class="fa fa-minus fa-lg"></i>
    				</a>
                </div>
    		</div>	
		</div>
	</section>

<script type="text/javascript">
    function add_row_equipment_needed(param_item, param_sub_item){		
		$('.btn-plus-'+param_item+'-'+param_sub_item+'-'+(document.getElementById('param_equipment_needed'+param_item+'-'+param_sub_item).value - 1)).addClass('hide');
		$('.btn-minus-'+param_item+'-'+param_sub_item+'-'+(document.getElementById('param_equipment_needed'+param_item+'-'+param_sub_item).value - 1)).removeClass('hide');

		var apa = "<tr id='tr_equipment_needed" +param_item+'-'+param_sub_item+'-'+ document.getElementById('param_equipment_needed'+param_item+'-'+param_sub_item).value + "' >"
            +"<td><select class='form-control' name='items[]'><option>a</option><option>b</option></select></td>"
            +"<td><input type='text' class='form-control' name='qty[]'/></td>"
            +"<td><a id='add"+param_item+'-'+param_sub_item+'-'+document.getElementById('param_equipment_needed'+param_item+'-'+param_sub_item).value+"' class='btn btn-plus-"+param_item+'-'+param_sub_item+'-'+document.getElementById('param_equipment_needed'+param_item+'-'+param_sub_item).value+"' "
            +"onclick='add_row_equipment_needed("+param_item+','+param_sub_item+")'><i class='fa fa-plus fa-lg'></i></a>"
            +"<a id='dlt"+param_item+'-'+param_sub_item+'-'+document.getElementById('param_equipment_needed'+param_item+'-'+param_sub_item).value+"' class='btn btn-minus-"+param_item+'-'+param_sub_item+'-'+document.getElementById('param_equipment_needed'+param_item+'-'+param_sub_item).value+"' "
            +"onclick='delete_row_equipment_needed("+(document.getElementById('param_item').value - 1)+','+param_sub_item+','+document.getElementById('param_equipment_needed'+param_item+'-'+param_sub_item).value+")'><i class='fa fa-minus fa-lg'></i></a></td></tr>";
		var tr_equipment_needed_name = '#tr_equipment_needed'+param_item+'-'+param_sub_item+'-'+ (document.getElementById('param_equipment_needed'+param_item+'-'+param_sub_item).value -1);
        $(apa).insertAfter($(tr_equipment_needed_name))
        
        $("#dlt_sub_item" +param_item+'-'+ param_sub_item).attr('onclick', "delete_row_sub_item("+param_item+','+param_sub_item+','+document.getElementById('param_equipment_needed'+param_item+'-'+param_sub_item).value+")");
        document.getElementById('param_equipment_needed'+param_item+'-'+param_sub_item).value = parseInt(document.getElementById('param_equipment_needed'+param_item+'-'+param_sub_item).value) + 1;
        //$("#dlt_sub_item" + param_item+ '-' + param_sub_item).attr('id', 'dlt'+(i-1)); 
	}
    
    
    function delete_row_equipment_needed(param_item, param_sub_item, param_equipment_needed){
		$("#tr_equipment_needed"+param_item+'-'+param_sub_item+'-'+param_equipment_needed).remove();
		
		if(document.getElementById('param_equipment_needed'+param_item+'-'+param_sub_item).value - 1 == param_equipment_needed){	       
	       $('.btn-plus-'+param_item+'-'+param_sub_item+'-'+(param_equipment_needed - 1)).removeClass('hide');
       }else{
            for(i=param_equipment_needed +1;i<document.getElementById('param_equipment_needed'+param_item+'-'+param_sub_item).value;i++){
                $("#tr_equipment_needed"+param_item+'-'+param_sub_item+'-' + i).attr('id', 'tr_equipment_needed'+param_item+'-'+param_sub_item+'-'+(i-1));
                $("#dlt"+param_item+'-'+param_sub_item+'-' + i).attr('onclick', "delete_row_equipment_needed("+param_item+','+param_sub_item+','+(i-1)+")");
                $("#dlt"+param_item+'-'+param_sub_item+'-' + i).attr('id', 'dlt'+param_item+'-'+param_sub_item+'-'+(i-1));
                $("#add"+param_item+'-'+param_sub_item+'-' + i).attr('id', 'add'+param_item+'-'+param_sub_item+'-'+(i-1));
                if(i==document.getElementById('param_equipment_needed'+param_item+'-'+param_sub_item).value - 1){
                    $('.btn-plus-'+param_item+'-'+param_sub_item+'-'+i).attr('class', ' btn btn-plus-'+param_item+'-'+param_sub_item+'-'+(i-1));
                    $('.btn-minus-'+param_item+'-'+param_sub_item+'-'+i).attr('class', ' btn btn-minus-'+param_item+'-'+param_sub_item+'-'+(i-1));
                }else{
                    $('.btn-plus-'+param_item+'-'+param_sub_item+'-'+i).attr('class', ' btn hide btn-plus-'+param_item+'-'+param_sub_item+'-'+(i-1));
                    $('.btn-minus-'+param_item+'-'+param_sub_item+'-'+i).attr('class', ' btn btn-minus-'+param_item+'-'+param_sub_item+'-'+(i-1));
                }
            }
       }
	   
	   if(document.getElementById('param_equipment_needed'+param_item+'-'+param_sub_item).value == 3){
            $('.btn-minus-'+param_item+'-'+param_sub_item+'-'+'1').addClass('hide');
        }
		
        document.getElementById('param_equipment_needed'+param_item+'-'+param_sub_item).value = parseInt(document.getElementById('param_equipment_needed'+param_item+'-'+param_sub_item).value) - 1;
        $("#dlt_sub_item" +param_item+'-'+ param_sub_item).attr('onclick', "delete_row_sub_item("+param_item+','+param_sub_item+','+(parseInt(document.getElementById('param_equipment_needed'+param_item+'-'+param_sub_item).value)-1 )+")");
	}
    
</script>
<script type="text/javascript">
    function add_row_sub_item(param_item){		
		$('.btn-add-'+param_item+'-'+(document.getElementById('param_sub_item'+param_item).value - 1)).addClass('hide');
		$('.btn-delete-'+param_item+'-'+(document.getElementById('param_sub_item'+param_item).value - 1)).removeClass('hide');

		var apa = "<input type='hidden' id='param_equipment_needed"+param_item+'-'+document.getElementById('param_sub_item'+param_item).value+"' value='2'/>"
        +"<div id='div_sub_item"+param_item+'-'+document.getElementById('param_sub_item'+param_item).value+"'>"
        +"<div style='border-style:solid; margin: 0 25% 2% 5%; float: left;'><table class='detail-table'><tr><td >a</td>"
        +"<td>Sub Item<br /><input type='text' class='form-control' name='sub_item'/></td>"
        +"<td>Category<br /><input type='radio' name='category'/> Internal <input type='radio' name='category'/> Eksternal</td>"
        +"<td>KPI<br /><select class='form-control'><option>a</option><option>b</option></select></td>"
        +"<td>Justification<br /><input type='text' class='form-control' name='justification'/></td></tr></table>"
        +"<div class='equipment_needed' style='border-style:dashed; border-color:#D6D6D6; margin: 0 40% 2% 5%;' >"
        +"<table class='detail-table'><tr><td>Equipment Needed</td></tr><tr id='tr_equipment_needed"+param_item+'-'+document.getElementById('param_sub_item'+param_item).value+'-'+"1'>"
        +"<td>Items<br /><select class='form-control' name='items[]'><option>a</option><option>b</option></select></td>"
        +"<td>Qty<br /><input type='text' class='form-control' name='qty[]'/></td>"
        +"<td><a id='add"+param_item+'-'+document.getElementById('param_sub_item'+param_item).value+"' class='btn btn-plus-"+param_item+'-'+document.getElementById('param_sub_item'+param_item).value+'-'+"1' onclick='add_row_equipment_needed("+param_item+','+document.getElementById('param_sub_item'+param_item).value+")' style='margin-top:45%;'><i class='fa fa-plus fa-lg'></i></a>"
        +"<a id='dlt"+param_item+'-'+document.getElementById('param_sub_item'+param_item).value+"-1' class='btn btn-minus-"+param_item+'-'+document.getElementById('param_sub_item'+param_item).value+'-'+"1 hide' onclick='delete_row_equipment_needed("+param_item+','+document.getElementById('param_sub_item'+param_item).value+','+"1)' style='margin-top:45%;' ><i class='fa fa-minus fa-lg'></i></a>"
        +"</td></tr></table></div></div><div style='float: left; margin-left: -25%; margin-top: 25%;'>"
        +"<a id='add_sub_item"+param_item+'-'+document.getElementById('param_sub_item'+param_item).value+"' class='btn btn-add-"+param_item+'-'+document.getElementById('param_sub_item'+param_item).value+"' onclick='add_row_sub_item("+param_item+")'><i class='fa fa-plus fa-lg'></i></a>"
        +"<a id='dlt_sub_item"+param_item+'-'+document.getElementById('param_sub_item'+param_item).value+"' class='btn btn-delete-"+param_item+'-'+document.getElementById('param_sub_item'+param_item).value+"' onclick='delete_row_sub_item("+param_item+','+document.getElementById('param_sub_item'+param_item).value+','+"1)'><i class='fa fa-minus fa-lg'></i></a>"
        +"</div></div>";
		var div_sub_item_name = '#div_sub_item'+ param_item +'-'+ (document.getElementById('param_sub_item'+param_item).value -1);
        $(apa).insertAfter($(div_sub_item_name))
        
        $("#dlt_item" +param_item).attr('onclick', "delete_row_item("+param_item+','+document.getElementById('param_sub_item'+param_item).value+")");
        document.getElementById('param_sub_item'+param_item).value = parseInt(document.getElementById('param_sub_item'+param_item).value) + 1;
	}
    
    
    function delete_row_sub_item(param_item,param_sub_item, param_equipment_needed){
		$("#div_sub_item"+param_item+ '-' + param_sub_item).remove();
		
		if(document.getElementById('param_sub_item'+param_item).value - 1 == param_sub_item){	       
	       $('.btn-add-'+param_item+'-'+(param_sub_item - 1)).removeClass('hide');
       }else{
            for(i=param_sub_item +1;i<document.getElementById('param_sub_item'+param_item).value;i++){
                
                for(j=1;j<document.getElementById('param_equipment_needed'+param_item+'-'+i).value;j++){
                    $("#tr_equipment_needed"+param_item+'-'+i+'-' + j).attr('id', 'tr_equipment_needed'+param_item+'-'+(i-1)+'-'+j);
                    $("#add"+param_item+'-'+i).attr('onclick', "add_row_equipment_needed("+param_item+','+(i-1)+")");
                    $("#add"+param_item+'-'+i).attr('id', 'add'+param_item+'-'+(i-1)+'-'+j);
                    $("#dlt"+param_item+'-'+i+'-' + j).attr('onclick', "delete_row_equipment_needed("+param_item+','+(i-1)+','+j+")");
                    $("#dlt"+param_item+'-'+i+'-' + j).attr('id', 'dlt'+param_item+'-'+(i-1)+'-'+j);
                    
                    if(j==document.getElementById('param_equipment_needed'+param_item+'-'+i).value - 1){
                        if(document.getElementById('param_equipment_needed'+param_item+'-'+i).value != 2){
                            $('.btn-plus-'+param_item+'-'+i+'-'+j).attr('class', ' btn btn-plus-'+param_item+'-'+(i-1)+'-'+j);
                            $('.btn-minus-'+param_item+'-'+i+'-'+j).attr('class', ' btn btn-minus-'+param_item+'-'+(i-1)+'-'+j);
                        }else{
                            $('.btn-plus-'+param_item+'-'+i+'-'+j).attr('class', ' btn btn-plus-'+param_item+'-'+(i-1)+'-'+j);
                            $('.btn-minus-'+param_item+'-'+i+'-'+j).attr('class', ' btn hide btn-minus-'+param_item+'-'+(i-1)+'-'+j);
                        }                        
                    }else {
                        $('.btn-plus-'+param_item+'-'+i+'-'+j).attr('class', ' btn hide btn-plus-'+param_item+'-'+(i-1)+'-'+j);
                        $('.btn-minus-'+param_item+'-'+i+'-'+j).attr('class', ' btn btn-minus-'+param_item+'-'+(i-1)+'-'+j);
                    }
                }
                
                
                $("#div_sub_item"+param_item+ '-' + i).attr('id', 'div_sub_item'+param_item+'-'+(i-1));
                $("#dlt_sub_item"+param_item+'-'+ i).attr('onclick', "delete_row_sub_item("+param_item+','+(i-1)+','+(parseInt(document.getElementById('param_equipment_needed'+param_item+'-'+i).value)-1)+")");
                $("#dlt_sub_item"+param_item+'-'+ i).attr('id', 'dlt_sub_item'+param_item+'-'+(i-1));
                $("#add_sub_item"+param_item+'-'+ i).attr('id', 'add_sub_item'+param_item+'-'+(i-1));
                if(i==document.getElementById('param_sub_item'+param_item).value - 1){
                    $('.btn-add-'+param_item+'-'+i).attr('class', ' btn btn-add-'+param_item+'-'+(i-1));
                    $('.btn-delete-'+param_item+'-'+i).attr('class', ' btn btn-delete-'+param_item+'-'+(i-1));
                }else{
                    $('.btn-add-'+param_item+'-'+i).attr('class', ' btn hide btn-add-'+param_item+'-'+(i-1));
                    $('.btn-delete-'+param_item+'-'+i).attr('class', ' btn btn-delete-'+param_item+'-'+(i-1));
                }
            }
       }
       
       
	   
	   if(document.getElementById('param_sub_item'+param_item).value == 3){
            $('.btn-delete-'+param_item+'-1').addClass('hide');
        }
		
		$("#dlt_item" +param_item).attr('onclick', "delete_row_item("+param_item+','+document.getElementById('param_sub_item'+param_item).value+")");
        document.getElementById('param_sub_item'+param_item).value = parseInt(document.getElementById('param_sub_item'+param_item).value) - 1;
	}
    
</script>

<script type="text/javascript">
    function add_row_item(){		
		$('.btn-tambah-'+(document.getElementById('param_item').value - 1)).addClass('hide');
		$('.btn-kurang-'+(document.getElementById('param_item').value - 1)).removeClass('hide');

		var apa = "<input type='hidden' id='param_sub_item"+document.getElementById('param_item').value+"' value='2'/><input type='hidden' id='param_equipment_needed"+document.getElementById('param_item').value+"-1' value='2'/>"
        +"<div id='div_item"+document.getElementById('param_item').value+"'><div style='border-style:solid; border-color:#D6D6D6; overflow: auto; margin: 0 10% 0% 0%;'>"
        +"<table width='100%' class='detail-table'><tr><td id='no_item"+document.getElementById('param_item').value+"'>"+document.getElementById('param_item').value+"</td>"
        +"<td>Item</td><td><input type='text' class='form-control' name='item'/></td></tr></table>"
        +"<div id='div_sub_item"+document.getElementById('param_item').value+"-1'><div style='border-style:solid; margin: 0 25% 2% 5%; float: left;'>"
        +"<table class='detail-table'><tr><td >a</td><td>Sub Item<br /><input type='text' class='form-control' name='sub_item'/></td>"
        +"<td>Category<br /><input type='radio' name='category'/> Internal <input type='radio' name='category'/> Eksternal</td>"
        +"<td>KPI<br /><select class='form-control'><option>a</option><option>b</option></select></td>"
        +"<td>Justification<br /><input type='text' class='form-control' name='justification'/></td></tr></table>"
        +"<div class='equipment_needed' style='border-style:dashed; border-color:#D6D6D6; margin: 0 40% 2% 5%;' ><table class='detail-table'>"
        +"<tr><td>Equipment Needed</td></tr><tr id='tr_equipment_needed"+document.getElementById('param_item').value+"-1-1'>"
        +"<td>Items<br /><select class='form-control' name='items[]'><option>a</option><option>b</option></select></td>"
        +"<td>Qty<br /><input type='text' class='form-control' name='qty[]'/></td>"
        +"<td><a id='add"+document.getElementById('param_item').value+"-1-1' class='btn btn-plus-"+document.getElementById('param_item').value+"-1-1' "
        +"onclick='add_row_equipment_needed("+document.getElementById('param_item').value+",1)' style='margin-top:45%;'><i class='fa fa-plus fa-lg'></i></a>"
        +"<a id='dlt"+document.getElementById('param_item').value+"-1-1' class='btn btn-minus-"+document.getElementById('param_item').value+"-1-1 hide' "
        +"onclick='delete_row_equipment_needed("+document.getElementById('param_item').value+",1,1)' style='margin-top:45%;' ><i class='fa fa-minus fa-lg'></i></a>"
        +"</td></tr></table></div></div><div style='float: left; margin-left: -25%; margin-top: 25%;'>"
        +"<a id='add_sub_item"+document.getElementById('param_item').value+"-1' class='btn btn-add-"+document.getElementById('param_item').value+"-1' onclick='add_row_sub_item("+document.getElementById('param_item').value+")'><i class='fa fa-plus fa-lg'></i></a>"
        +"<a id='dlt_sub_item"+document.getElementById('param_item').value+"-1' class='btn btn-delete-"+document.getElementById('param_item').value+"-1 hide' "
        +"onclick='delete_row_sub_item("+document.getElementById('param_item').value+",1,1)'><i class='fa fa-minus fa-lg'></i></a></div></div></div>"
        +"<div style=' float: right; margin-top: -3%;margin-right: 7%;'>"
        +"<a id='add_item"+document.getElementById('param_item').value+"' class='btn btn-tambah-"+document.getElementById('param_item').value+"' onclick='add_row_item()'><i class='fa fa-plus fa-lg'></i></a>"
        +"<a id='dlt_item"+document.getElementById('param_item').value+"' class='btn btn-kurang-"+document.getElementById('param_item').value+"' onclick='delete_row_item("+document.getElementById('param_item').value+",1)'>"
        +"<i class='fa fa-minus fa-lg'></i></a></div></div>";
		var div_item_name = '#div_item'+ (document.getElementById('param_item').value -1);
        $(apa).insertAfter($(div_item_name))
        
        document.getElementById('param_item').value = parseInt(document.getElementById('param_item').value) + 1;
	}
    
    
    function delete_row_item(param_item){
		$("#div_item"+param_item).remove();
		
		if(document.getElementById('param_item').value - 1 == param_item){	       
	       $('.btn-tambah-'+(param_item - 1)).removeClass('hide');
       }else{
            for(i=param_item +1;i<document.getElementById('param_item').value;i++){
                $("#div_item"+ i).attr('id', 'div_item'+(i-1));
                $("#delete" + i).attr('onclick', "delete_row_item("+(i-1)+")");
                $("#delete" + i).attr('id', 'delete'+(i-1));
                if(i==document.getElementById('param_item').value - 1){
                    $('.btn-tambah-'+i).attr('class', ' btn btn-tambah-'+(i-1));
                    $('.btn-kurang-'+i).attr('class', ' btn btn-kurang-'+(i-1));
                }else{
                    $('.btn-tambah-'+i).attr('class', ' btn hide btn-tambah-'+(i-1));
                    $('.btn-kurang-'+i).attr('class', ' btn btn-kurang-'+(i-1));
                }
            }
       }
	   
	   if(document.getElementById('param_item').value == 3){
            $('.btn-kurang-1').addClass('hide');
        }
		
		document.getElementById('param_item').value = parseInt(document.getElementById('param_item').value) - 1;
	}
    
</script>

    