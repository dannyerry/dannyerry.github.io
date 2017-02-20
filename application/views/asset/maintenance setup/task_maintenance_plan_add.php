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
    <form method="post" action="<?=base_url("maintenance/task_maintenance_plan_insert/".$maintenance_id)?>">
        <input type="hidden" name="a_hash_id" value="<?=$a_hash_id?>"/>
        <div class="section-content">
            <table width="100%" class="detail-table">
                <tr>
                    <td>Duration</td>
                    <td><input type="text" class="form-control" name="duration"/></td>
                </tr>
            </table>
        </div>
		<div class="section-content">
        <input type="hidden" id="param_item" value="2"/>
        <input type="hidden" id="param_sub_item1" value="2"/>
        <input type="hidden" id="param_equipment_needed1-1" value="2"/>
        <input type="hidden" id="prm1" value="a"/>
            <div id="div_item1">
                <div style="border-style:solid; border-color:#D6D6D6; overflow: auto; margin: 0 10% 0% 0%;">
                    <table width="100%" class="detail-table">
        				<tr>
                            <td id="no_item1">1</td>
                            <td>Item</td>
                            <td><input type="text" class="form-control" name="item[]"/></td>
                        </tr>
                    </table>
                    <div id="div_sub_item1-1">
                        <div style="border-style:solid; margin: 0 25% 2% 5%; float: left;">
                            <table class="detail-table">
                                <tr>
                                    <td id="no_sub_item1-1">a</td>
                                    <td>Sub Item<br /><input type="text" class="form-control" id="sub_item1" name="sub_item1[]"/></td>
                                    <td>Category<br /><input type="radio" id="category1" name="category1[]" value="Internal"/> Internal <input type="radio" id="category1" name="category1[]" value="Eksternal"/> Eksternal</td>
                                    <td>KPI<br />
                                        <select class="form-control" id="kpi1" name="kpi1[]">
                                            <option></option>
                							<?php foreach ($kpi as $row) {
                								echo "<option value=".$row->kpi_id.">".$row->kpi_master."</option>";
                							}?>
                						</select>
                                    </td>
                                    <td>Justification<br /><input type="text" class="form-control" id="justification1" name="justification1[]"/></td>
                                </tr>
                            </table>
                            <div class="equipment_needed" style="border-style:dashed; border-color:#D6D6D6; margin: 0 40% 2% 5%;" >
                                <table class="detail-table">
                                    <tr>
                                        <td>Equipment Needed</td>
                                    </tr>
                                    <tr id="tr_equipment_needed1-1-1">
                                        <td>Items<br />
                                            <select class="form-control" id="items1-1" name="items1-1[]">
                                                <option></option>
                                                <?php foreach($item as $row){
                                                    echo "<option value=".$row->item_id.">".$row->item_name."</option>";
                                                }?>
                                            </select>
                                        </td>
                                        <td>Qty<br /><input type="number" class="form-control" id="qty1-1" name="qty1-1[]"/></td>
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
                <div style=" float: right; margin-top: -3%;margin-right:3%;">
                    <a id='add_item1' class="btn btn-tambah-1" onclick="add_row_item()">
    					<i class="fa fa-plus fa-lg"></i>
    				</a>
                    <a id='dlt_item1' class="btn btn-kurang-1 hide" onclick="delete_row_item(1,1)">
    					<i class="fa fa-minus fa-lg"></i>
    				</a>
                </div>
    		</div>	
		</div>
        <br />
        <div class="section-content" style="border-style:solid; border-color:#D6D6D6; width: 35%;">        
        <input type="hidden" id="param_tools" value="2"/>
            <table width="100%" class="detail-table">
                <tr>
                    <td>Select Tools</td>
                </tr>
                <tr>
                    <td>Tools</td>
                    <td>Unit</td>
                </tr>
                <tr id="trTools1">
                    <td>
                        <select class="form-control" name="tools[]">
                            <option></option>
                            <?php foreach($inventory as $row){
                                echo "<option value=".$row->inventory_id.">".$row->inventory_name."</option>";
                            }?>
                        </select>
                    </td>
                    <td>
                        <select class="form-control" name="unit[]">
                            <option></option>
                            <?php foreach($unit as $row){
                                echo "<option value=".$row->unit_id.">".$row->unit_name."</option>";
                            }?>
                        </select>
                    </td>
                    <td>
                        <a class="btn btn-add-tools-1" onclick="add_row_tools()">
        					<i class="fa fa-plus fa-lg"></i>
        				</a>
                        <a id='dlt-tools1' class="btn btn-dlt-tools-1 hide" onclick="delete_row_tools(1)">
        					<i class="fa fa-minus fa-lg"></i>
        				</a>
                    </td>
                </tr>
            </table>
        </div>
        <section>
        <div class="section-content"><br />
            <button type="submit" class="btn btn-primary">SUBMIT</button>
        </div>
    </section>
    </form>
	</section>

<script type="text/javascript">
    function add_row_equipment_needed(param_item, param_sub_item){		
		$('.btn-plus-'+param_item+'-'+param_sub_item+'-'+(document.getElementById('param_equipment_needed'+param_item+'-'+param_sub_item).value - 1)).addClass('hide');
		$('.btn-minus-'+param_item+'-'+param_sub_item+'-'+(document.getElementById('param_equipment_needed'+param_item+'-'+param_sub_item).value - 1)).removeClass('hide');

		var apa = "<tr id='tr_equipment_needed" +param_item+'-'+param_sub_item+'-'+ document.getElementById('param_equipment_needed'+param_item+'-'+param_sub_item).value + "' >"
            +"<td><select class='form-control' id='items"+param_item+'-'+param_sub_item+"' name='items"+param_item+'-'+param_sub_item+"[]'><option></option>"
            +"<?php foreach($item as $row){echo '<option value='.$row->item_id.'>'.$row->item_name.'</option>';}?></select></td>"
            +"<td><input type='number' class='form-control' id='qty"+param_item+'-'+param_sub_item+"' name='qty"+param_item+'-'+param_sub_item+"[]'/></td>"
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
        
        var c = document.getElementById('prm'+param_item).value;        
        var ascii = String.fromCharCode(c.charCodeAt(0) + 1);
        
		var apa = "<input type='hidden' id='param_equipment_needed"+param_item+'-'+document.getElementById('param_sub_item'+param_item).value+"' value='2'/>"
        +"<div id='div_sub_item"+param_item+'-'+document.getElementById('param_sub_item'+param_item).value+"'>"
        +"<div style='border-style:solid; margin: 0 25% 2% 5%; float: left;'><table class='detail-table'><tr><td id='no_sub_item"+param_item+'-'+document.getElementById('param_sub_item'+param_item).value+"'>"+ascii+"</td>"
        +"<td>Sub Item<br /><input type='text' id='sub_item"+param_item+"' class='form-control' name='sub_item"+param_item+"[]'/></td>"
        +"<td>Category<br /><input type='radio' id='category"+param_item+"' name='category"+param_item+"[]' value='Internal'/> Internal <input type='radio' id='category"+param_item+"' name='category"+param_item+"[]' value='Eksternal'/> Eksternal</td>"
        +"<td>KPI<br /><select class='form-control' id='kpi"+param_item+"' name='kpi"+param_item+"[]'><option></option><?php foreach ($kpi as $row) {echo '<option value='.$row->kpi_id.'>'.$row->kpi_master.'</option>';}?></select></td>"
        +"<td>Justification<br /><input type='text' id='justification"+param_item+"' class='form-control' name='justification"+param_item+"[]'/></td></tr></table>"
        +"<div class='equipment_needed' style='border-style:dashed; border-color:#D6D6D6; margin: 0 40% 2% 5%;' >"
        +"<table class='detail-table'><tr><td>Equipment Needed</td></tr><tr id='tr_equipment_needed"+param_item+'-'+document.getElementById('param_sub_item'+param_item).value+'-'+"1'>"
        +"<td>Items<br /><select class='form-control' id='items"+param_item+'-'+document.getElementById('param_sub_item'+param_item).value+"' name='items"+param_item+'-'+document.getElementById('param_sub_item'+param_item).value+"[]'>"
        +"<option></option><?php foreach($item as $row){echo '<option value='.$row->item_id.'>'.$row->item_name.'</option>';}?></select></td>"
        +"<td>Qty<br /><input type='number' class='form-control' id='qty"+param_item+'-'+document.getElementById('param_sub_item'+param_item).value+"' name='qty"+param_item+'-'+document.getElementById('param_sub_item'+param_item).value+"[]'/></td>"
        +"<td><a id='add"+param_item+'-'+document.getElementById('param_sub_item'+param_item).value+"' class='btn btn-plus-"+param_item+'-'+document.getElementById('param_sub_item'+param_item).value+'-'+"1' onclick='add_row_equipment_needed("+param_item+','+document.getElementById('param_sub_item'+param_item).value+")' style='margin-top:45%;'><i class='fa fa-plus fa-lg'></i></a>"
        +"<a id='dlt"+param_item+'-'+document.getElementById('param_sub_item'+param_item).value+"-1' class='btn btn-minus-"+param_item+'-'+document.getElementById('param_sub_item'+param_item).value+'-'+"1 hide' onclick='delete_row_equipment_needed("+param_item+','+document.getElementById('param_sub_item'+param_item).value+','+"1)' style='margin-top:45%;' ><i class='fa fa-minus fa-lg'></i></a>"
        +"</td></tr></table></div></div><div style='float: left; margin-left: -25%; margin-top: 25%;'>"
        +"<a id='add_sub_item"+param_item+'-'+document.getElementById('param_sub_item'+param_item).value+"' class='btn btn-add-"+param_item+'-'+document.getElementById('param_sub_item'+param_item).value+"' onclick='add_row_sub_item("+param_item+")'><i class='fa fa-plus fa-lg'></i></a>"
        +"<a id='dlt_sub_item"+param_item+'-'+document.getElementById('param_sub_item'+param_item).value+"' class='btn btn-delete-"+param_item+'-'+document.getElementById('param_sub_item'+param_item).value+"' onclick='delete_row_sub_item("+param_item+','+document.getElementById('param_sub_item'+param_item).value+','+"1)'><i class='fa fa-minus fa-lg'></i></a>"
        +"</div></div>";
		var div_sub_item_name = '#div_sub_item'+ param_item +'-'+ (document.getElementById('param_sub_item'+param_item).value -1);
        $(apa).insertAfter($(div_sub_item_name))
        
        $("#dlt_item" +param_item).attr('onclick', "delete_row_item("+param_item+','+document.getElementById('param_sub_item'+param_item).value+")");
        document.getElementById('prm'+param_item).value = ascii; 
        document.getElementById('param_sub_item'+param_item).value = parseInt(document.getElementById('param_sub_item'+param_item).value) + 1;
	}
    
    
    function delete_row_sub_item(param_item,param_sub_item, param_equipment_needed){        
		$("#div_sub_item"+param_item+ '-' + param_sub_item).remove();
        var c = document.getElementById('prm'+param_item).value; 
        var next_ascii = '';
		
		if(document.getElementById('param_sub_item'+param_item).value - 1 == param_sub_item){	       
	       $('.btn-add-'+param_item+'-'+(param_sub_item - 1)).removeClass('hide');
       }else{
            for(i=param_sub_item +1;i<document.getElementById('param_sub_item'+param_item).value;i++){
                next_ascii = String.fromCharCode(c.charCodeAt(0) - ((document.getElementById('param_sub_item'+param_item).value)-i));
                $("#div_sub_item"+param_item+ '-' + i).attr('id', 'div_sub_item'+param_item+'-'+(i-1));
                $("#dlt_sub_item"+param_item+'-'+ i).attr('onclick', "delete_row_sub_item("+param_item+','+(i-1)+','+(parseInt(document.getElementById('param_equipment_needed'+param_item+'-'+i).value)-1)+")");
                $("#dlt_sub_item"+param_item+'-'+ i).attr('id', 'dlt_sub_item'+param_item+'-'+(i-1));
                $("#add_sub_item"+param_item+'-'+ i).attr('id', 'add_sub_item'+param_item+'-'+(i-1));
                $("#no_sub_item"+param_item+'-'+i).html(next_ascii);
                $("#no_sub_item"+param_item+'-'+i).attr('id', 'no_sub_item'+param_item+'-'+(i-1));
                if(i==document.getElementById('param_sub_item'+param_item).value - 1){
                    $('.btn-add-'+param_item+'-'+i).attr('class', ' btn btn-add-'+param_item+'-'+(i-1));
                    $('.btn-delete-'+param_item+'-'+i).attr('class', ' btn btn-delete-'+param_item+'-'+(i-1));
                }else{
                    $('.btn-add-'+param_item+'-'+i).attr('class', ' btn hide btn-add-'+param_item+'-'+(i-1));
                    $('.btn-delete-'+param_item+'-'+i).attr('class', ' btn btn-delete-'+param_item+'-'+(i-1));
                }
                
                
                for(j=1;j<document.getElementById('param_equipment_needed'+param_item+'-'+i).value;j++){
                    $("#tr_equipment_needed"+param_item+'-'+i+'-' + j).attr('id', 'tr_equipment_needed'+param_item+'-'+(i-1)+'-'+j);
                    $("#add"+param_item+'-'+i).attr('onclick', "add_row_equipment_needed("+param_item+','+(i-1)+")");
                    $("#add"+param_item+'-'+i).attr('id', 'add'+param_item+'-'+(i-1)+'-'+j);
                    $("#dlt"+param_item+'-'+i+'-' + j).attr('onclick', "delete_row_equipment_needed("+param_item+','+(i-1)+','+j+")");
                    $("#dlt"+param_item+'-'+i+'-' + j).attr('id', 'dlt'+param_item+'-'+(i-1)+'-'+j);
                    $("#items"+param_item+'-'+i).attr('name','items'+param_item+'-'+(i-1)+'[]');
                    $("#items"+param_item+'-'+i).attr('id','items'+param_item+'-'+(i-1)+'[]');
                    $("#qty"+param_item+'-'+i).attr('name','qty'+param_item+'-'+(i-1)+'[]');
                    $("#qty"+param_item+'-'+i).attr('id','qty'+param_item+'-'+(i-1)+'[]');
                    
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
            }
       }
       
       
	   
	   if(document.getElementById('param_sub_item'+param_item).value == 3){
            $('.btn-delete-'+param_item+'-1').addClass('hide');
        }
               
        var ascii = String.fromCharCode(c.charCodeAt(0) - 1);
		document.getElementById('prm'+param_item).value = ascii; 
        
		document.getElementById('param_sub_item'+param_item).value = parseInt(document.getElementById('param_sub_item'+param_item).value) - 1;
        $("#dlt_item" +param_item).attr('onclick', "delete_row_item("+param_item+','+(parseInt(document.getElementById('param_sub_item'+param_item).value)-1)+")");
	}
    
</script>

<script type="text/javascript">
    function add_row_item(){		
		$('.btn-tambah-'+(document.getElementById('param_item').value - 1)).addClass('hide');
		$('.btn-kurang-'+(document.getElementById('param_item').value - 1)).removeClass('hide');

		var apa = "<input type='hidden' id='prm"+document.getElementById('param_item').value+"' value='a'>"
        +"<input type='hidden' id='param_sub_item"+document.getElementById('param_item').value+"' value='2'/><input type='hidden' id='param_equipment_needed"+document.getElementById('param_item').value+"-1' value='2'/>"
        +"<div id='div_item"+document.getElementById('param_item').value+"'><div style='border-style:solid; border-color:#D6D6D6; overflow: auto; margin: 0 10% 0% 0%;'>"
        +"<table width='100%' class='detail-table'><tr><td id='no_item"+document.getElementById('param_item').value+"'>"+document.getElementById('param_item').value+"</td>"
        +"<td>Item</td><td><input type='text' class='form-control' name='item[]'/></td></tr></table>"
        +"<div id='div_sub_item"+document.getElementById('param_item').value+"-1'><div style='border-style:solid; margin: 0 25% 2% 5%; float: left;'>"
        +"<table class='detail-table'><tr><td id='no_sub_item"+document.getElementById('param_item').value+"'>a</td>"
        +"<td>Sub Item<br /><input type='text' class='form-control' id='sub_item"+document.getElementById('param_item').value+"' name='sub_item"+document.getElementById('param_item').value+"[]'/></td>"
        +"<td>Category<br /><input type='radio' id='category"+document.getElementById('param_item').value+"' name='category"+document.getElementById('param_item').value+"[]' value='Internal'/> Internal "
        +"<input type='radio' id='category"+document.getElementById('param_item').value+"' name='category"+document.getElementById('param_item').value+"[]' value='Eksternal'/> Eksternal</td>"
        +"<td>KPI<br /><select class='form-control' id='kpi"+document.getElementById('param_item').value+"' name='kpi"+document.getElementById('param_item').value+"[]'><option></option><?php foreach ($kpi as $row) {echo '<option value='.$row->kpi_id.'>'.$row->kpi_master.'</option>';}?></select></td>"
        +"<td>Justification<br /><input type='text' class='form-control' id='justification"+document.getElementById('param_item').value+"' name='justification"+document.getElementById('param_item').value+"[]'/></td></tr></table>"
        +"<div class='equipment_needed' style='border-style:dashed; border-color:#D6D6D6; margin: 0 40% 2% 5%;' ><table class='detail-table'>"
        +"<tr><td>Equipment Needed</td></tr><tr id='tr_equipment_needed"+document.getElementById('param_item').value+"-1-1'>"
        +"<td>Items<br /><select class='form-control' id='items"+document.getElementById('param_item').value+"-1' name='items"+document.getElementById('param_item').value+"-1[]'>"
        +"<option></option><?php foreach($item as $row){echo '<option value='.$row->item_id.'>'.$row->item_name.'</option>';}?></select></td>"
        +"<td>Qty<br /><input type='number' class='form-control' id='qty"+document.getElementById('param_item').value+"-1' name='qty"+document.getElementById('param_item').value+"-1[]'/></td>"
        +"<td><a id='add"+document.getElementById('param_item').value+"-1-1' class='btn btn-plus-"+document.getElementById('param_item').value+"-1-1' "
        +"onclick='add_row_equipment_needed("+document.getElementById('param_item').value+",1)' style='margin-top:45%;'><i class='fa fa-plus fa-lg'></i></a>"
        +"<a id='dlt"+document.getElementById('param_item').value+"-1-1' class='btn btn-minus-"+document.getElementById('param_item').value+"-1-1 hide' "
        +"onclick='delete_row_equipment_needed("+document.getElementById('param_item').value+",1,1)' style='margin-top:45%;' ><i class='fa fa-minus fa-lg'></i></a>"
        +"</td></tr></table></div></div><div style='float: left; margin-left: -25%; margin-top: 25%;'>"
        +"<a id='add_sub_item"+document.getElementById('param_item').value+"-1' class='btn btn-add-"+document.getElementById('param_item').value+"-1' onclick='add_row_sub_item("+document.getElementById('param_item').value+")'><i class='fa fa-plus fa-lg'></i></a>"
        +"<a id='dlt_sub_item"+document.getElementById('param_item').value+"-1' class='btn btn-delete-"+document.getElementById('param_item').value+"-1 hide' "
        +"onclick='delete_row_sub_item("+document.getElementById('param_item').value+",1,1)'><i class='fa fa-minus fa-lg'></i></a></div></div></div>"
        +"<div style=' float: right; margin-top: -3%;margin-right: 3%;'>"
        +"<a id='add_item"+document.getElementById('param_item').value+"' class='btn btn-tambah-"+document.getElementById('param_item').value+"' onclick='add_row_item()'><i class='fa fa-plus fa-lg'></i></a>"
        +"<a id='dlt_item"+document.getElementById('param_item').value+"' class='btn btn-kurang-"+document.getElementById('param_item').value+"' onclick='delete_row_item("+document.getElementById('param_item').value+",1)'>"
        +"<i class='fa fa-minus fa-lg'></i></a></div></div>";
		var div_item_name = '#div_item'+ (document.getElementById('param_item').value -1);
        $(apa).insertAfter($(div_item_name))
        
        document.getElementById('param_item').value = parseInt(document.getElementById('param_item').value) + 1;
	}
    
    
    function delete_row_item(param_item, param_sub_item){
		$("#div_item"+param_item).remove();
		
		if(document.getElementById('param_item').value - 1 == param_item){	       
	       $('.btn-tambah-'+(param_item - 1)).removeClass('hide');
       }else{
            for(i=param_item +1;i<document.getElementById('param_item').value;i++){
                $("#div_item"+ i).attr('id', 'div_item'+(i-1));
                $("#no_item" + i).html((i-1));
                $("#no_item" + i).attr('id', 'no_item'+(i-1));
                $("#dlt_item" + i).attr('onclick', "delete_row_item("+(i-1)+','+(parseInt(document.getElementById('param_sub_item'+(i-1)).value)-1)+")");
                $("#dlt_item" + i).attr('id', 'dlt_item'+(i-1));
                $("#add_item" + i).attr('id', 'add_item'+(i-1));
                $("#prm"+i).attr('id', 'prm'+(i-1));
                if(i==document.getElementById('param_item').value - 1){
                    $('.btn-tambah-'+i).attr('class', ' btn btn-tambah-'+(i-1));
                    $('.btn-kurang-'+i).attr('class', ' btn btn-kurang-'+(i-1));
                }else{
                    $('.btn-tambah-'+i).attr('class', ' btn hide btn-tambah-'+(i-1));
                    $('.btn-kurang-'+i).attr('class', ' btn btn-kurang-'+(i-1));
                }
                
                for(j=1;j<document.getElementById('param_sub_item'+i).value;j++){                
                    $("#div_sub_item"+i+ '-' + j).attr('id', 'div_sub_item'+(i-1)+'-'+j);
                    $("#add_sub_item"+i+'-'+ j).attr('onclick',"add_row_sub_item("+(i-1)+")");
                    $("#add_sub_item"+i+'-'+ j).attr('id', 'add_sub_item'+(i-1)+'-'+j);
                    $("#dlt_sub_item"+i+'-'+ j).attr('onclick', "delete_row_sub_item("+(i-1)+','+j+','+(parseInt(document.getElementById('param_equipment_needed'+(i-1)+'-'+j).value)-1)+")");
                    $("#dlt_sub_item"+i+'-'+ j).attr('id', 'dlt_sub_item'+(i-1)+'-'+j);
                    $("#no_sub_item"+i+'-'+j).attr('id', 'no_sub_item'+(i-1)+'-'+j);
                    $("#sub_item"+i+'-'+j).attr('name'+(i-1)+'-'+j+'[]');
                    $("#sub_item"+i+'-'+j).attr('id'+(i-1)+'-'+j+'[]');
                    $("#category"+i+'-'+j).attr('name'+(i-1)+'-'+j+'[]');
                    $("#category"+i+'-'+j).attr('id'+(i-1)+'-'+j+'[]');
                    $("#kpi"+i+'-'+j).attr('name'+(i-1)+'-'+j+'[]');
                    $("#kpi"+i+'-'+j).attr('id'+(i-1)+'-'+j+'[]');
                    $("#justification"+i+'-'+j).attr('name'+(i-1)+'-'+j+'[]');
                    $("#justification"+i+'-'+j).attr('id'+(i-1)+'-'+j+'[]');
                    if(j==document.getElementById('param_sub_item'+i).value - 1){
                        if(document.getElementById('param_sub_item'+i).value != 2){
                            $('.btn-add-'+i+'-'+j).attr('class', ' btn btn-add-'+(i-1)+'-'+j);
                            $('.btn-delete-'+i+'-'+j).attr('class', ' btn btn-delete-'+(i-1)+'-'+j);
                        }else{
                            $('.btn-add-'+i+'-'+j).attr('class', ' btn btn-add-'+(i-1)+'-'+j);
                            $('.btn-delete-'+i+'-'+j).attr('class', ' btn hide btn-delete-'+(i-1)+'-'+j);
                        }
                    }else{
                        $('.btn-add-'+i+'-'+j).attr('class', ' btn hide btn-add-'+(i-1)+'-'+j);
                        $('.btn-delete-'+i+'-'+j).attr('class', ' btn btn-delete-'+(i-1)+'-'+j);
                    }
                    
                    
                    for(k=1;k<document.getElementById('param_equipment_needed'+i+'-'+j).value;k++){
                        $("#tr_equipment_needed"+i+'-'+j+'-' + k).attr('id', 'tr_equipment_needed'+(i-1)+'-'+j+'-'+k);
                        $("#add"+i+'-'+j+'-' + k).attr('onclick', "add_row_equipment_needed("+(i-1)+','+j+")");
                        $("#add"+i+'-'+j+'-' + k).attr('id', 'add'+(i-1)+'-'+j+'-'+k);
                        $("#dlt"+i+'-'+j+'-' + k).attr('onclick', "delete_row_equipment_needed("+(i-1)+','+j+','+k+")");
                        $("#dlt"+i+'-'+j+'-' + k).attr('id', 'dlt'+(i-1)+'-'+j+'-'+k);
                        $("#items"+i+'-'+j).attr('name','items'+(i-1)+'-'+j+'[]');
                        $("#items"+i+'-'+j).attr('id','items'+(i-1)+'-'+j+'[]');
                        $("#qty"+i+'-'+j).attr('name','qty'+(i-1)+'-'+j+'[]');
                        $("#qty"+i+'-'+j).attr('id','qty'+(i-1)+'-'+j+'[]');
                        
                        if(k==document.getElementById('param_equipment_needed'+i+'-'+j).value - 1){
                            if(document.getElementById('param_equipment_needed'+i+'-'+j).value != 2){
                                $('.btn-plus-'+i+'-'+j+'-'+k).attr('class', ' btn btn-plus-'+(i-1)+'-'+j+'-'+k);
                                $('.btn-minus-'+i+'-'+j+'-'+k).attr('class', ' btn btn-minus-'+(i-1)+'-'+j+'-'+k);
                            }else{
                                $('.btn-plus-'+i+'-'+j+'-'+k).attr('class', ' btn btn-plus-'+(i-1)+'-'+j+'-'+k);
                                $('.btn-minus-'+i+'-'+j+'-'+k).attr('class', ' btn hide btn-minus-'+(i-1)+'-'+j+'-'+k);
                            }                        
                        }else {
                            $('.btn-plus-'+i+'-'+j+'-'+k).attr('class', ' btn hide btn-plus-'+(i-1)+'-'+j+'-'+k);
                            $('.btn-minus-'+i+'-'+j+'-'+k).attr('class', ' btn btn-minus-'+(i-1)+'-'+j+'-'+k);
                        }
                    }
                }
            }
       }
	   
	   if(document.getElementById('param_item').value == 3){
            $('.btn-kurang-1').addClass('hide');
        }
		
		document.getElementById('param_item').value = parseInt(document.getElementById('param_item').value) - 1;
		$("#prm"+document.getElementById('param_item').value).remove();
	}
    
</script>

<script type="text/javascript">
    function add_row_tools(){		
		$('.btn-add-tools-'+(document.getElementById('param_tools').value - 1)).addClass('hide');
		$('.btn-dlt-tools-'+(document.getElementById('param_tools').value - 1)).removeClass('hide');

		var apa = "<tr id='trTools"+document.getElementById('param_tools').value+"'><td><select class='form-control' name='tools[]'>"
        +"<option></option><?php foreach($inventory as $row){echo '<option value='.$row->inventory_id.'>'.$row->inventory_name.'</option>';}?></select>"
        +"</td><td><select class='form-control' name='unit[]'><option></option>"
        +"<?php foreach($unit as $row){echo '<option value='.$row->unit_id.'>'.$row->unit_name.'</option>';}?></select></td>"
        +"<td><a class='btn btn-add-tools-"+document.getElementById('param_tools').value+"' onclick='add_row_tools()'><i class='fa fa-plus fa-lg'></i></a>"
        +"<a id='dlt-tools"+document.getElementById('param_tools').value+"' class='btn btn-dlt-tools-"+document.getElementById('param_tools').value+"' "
        +"onclick='delete_row_tools("+document.getElementById('param_tools').value+")'><i class='fa fa-minus fa-lg'></i></a></td></tr>";
		var tr_tools = '#trTools'+(document.getElementById('param_tools').value -1);
        $(apa).insertAfter($(tr_tools))
        
        document.getElementById('param_tools').value = parseInt(document.getElementById('param_tools').value) + 1;
	}
    
    
    function delete_row_tools(param_tools){
		$("#trTools"+param_tools).remove();
		
		if(document.getElementById('param_tools').value - 1 == param_tools){	       
	       $('.btn-add-tools-'+(param_tools - 1)).removeClass('hide');
       }else{
            for(i=param_tools +1;i<document.getElementById('param_tools').value;i++){
                $("#trTools"+ i).attr('id', 'trTools'+(i-1));
                $("#dlt-tools"+ i).attr('onclick', "delete_row_tools("+(i-1)+")");
                $("#dlt-tools"+ i).attr('id', 'dlt-tools'+(i-1));
                $("#add-tools"+ i).attr('id', 'add-tools'+(i-1));
                if(i==document.getElementById('param_tools').value - 1){
                    $('.btn-add-tools-'+i).attr('class', ' btn btn-add-tools-'+(i-1));
                    $('.btn-dlt-tools-'+i).attr('class', ' btn btn-dlt-tools-'+(i-1));
                }else{
                    $('.btn-add-tools-'+i).attr('class', ' btn hide btn-add-tools-'+(i-1));
                    $('.btn-dlt-tools-'+i).attr('class', ' btn btn-dlt-tools-'+(i-1));
                }
            }
       }
	   
	   if(document.getElementById('param_tools').value == 3){
            $('.btn-dlt-tools-1').addClass('hide');
        }
		
        document.getElementById('param_tools').value = parseInt(document.getElementById('param_tools').value) - 1;
	}
    
</script>

    