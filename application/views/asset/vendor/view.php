<div class="col-sm-10 col-sm-offset-2">
	<div class="breadcrumb-menu">
		<ol class="breadcrumb">
			<li><a href="#">TRANSACTION</a></li>
            <li><a href="<?=base_url('dashboard/stock_transfer')?>">STOCK TRANSFER</a></li>
			<li class="active">STOCK TRANSFER VIEW</li>
		</ol>
	</div>
	<div id="content-wrapper">
		<div id="inner-wrapper">
    
    <form method="post">
	<section>		
		<div class="table-category-header">
			STOCK TRANSFER VIEW
		</div>
		<table class="master-table" id="myTable">
            <tr>
                <td>Transfer Number</td>
                <td>TR_01</td>
            </tr>
            <tr>
                <td>Due Date</td>
                <td>01/12/2016</td>
            </tr>
            <tr>
                <td>Reference</td>
                <td>Project</td>
                <td>&nbsp;A</td>
            </tr>
            <tr>
                <td>Priority</td>
                <td>Medium</td>
            </tr>
            <tr>
                <td>From Warehouse</td>
                <td>Cikareng</td>
            </tr>
            <tr>
                <td>To Warehouse</td>
                <td>Cikande</td>
            </tr>
            <tr>
                <td>Initiate Date</td>
                <td><?=date("d/m/Y")?></td>
            </tr>
		</table>
	</section><br />
    <section>
        <div class="section-content">
        <strong>ASSET</strong>
            <table width="100%" class="secondary-table">
				<thead>
					<tr>
						<th>Asset List</th>
						<th>Stock</th>
						<th>Request Qty</th>
                        <th>Note</th>
					</tr>
				</thead>
                <tbody>
                    <?php for($i=1;$i<=3;$i++){?>
                    <tr>
                        <td>Asset Name <?=$i?></td>
                        <td>1</td>
                        <td>1</td>
                        <td></td>
                    </tr>
                <?php }?>
                </tbody>
            </table>
        </div>
    </section><br />
    <section>
        <div class="section-content">
        <strong>INVENTORY</strong>
            <table width="100%" class="secondary-table">
				<thead>
					<tr>
						<th>Asset List</th>
						<th>Stock</th>
						<th>Request Qty</th>
                        <th>Note</th>
					</tr>
				</thead>
                <tbody>
                    <?php for($i=1;$i<=3;$i++){?>
                    <tr>
                        <td>Inventory Name <?=$i?></td>
                        <td><?=$i*4?></td>
                        <td><?=($i*4)-3?></td>
                        <td></td>
                    </tr>
                <?php }?>
                </tbody>
            </table>
            <br /><strong>Notes :</strong>Bla bla bla ...
        </div>
    </section>
    <section>
        <div class="section-content"><br />
            <button type="submit" class="btn btn-warning">Back</button>
        </div>
    </section>
    </form>
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
    function add_row(){		
		$('.btn-plus-'+(document.getElementById('param').value - 1)).addClass('hide');
		$('.btn-minus-'+(document.getElementById('param').value - 1)).removeClass('hide');

		var apa = "<tr id='trInput" + document.getElementById('param').value + "' >"
            +"<td id='no"+ document.getElementById('param').value +"'>"+ document.getElementById('param').value +"</td>"
            +"<td><input ng-model='item' type='text' name='item[]' class='form-control' placeholder='Item'></td>"
            +"<td><input ng-model='description' type='text' name='description[]' class='form-control' placeholder='Description'></td>"
            +"<td><input ng-model='actual_stock' type='text' name='actual_stock[]' class='form-control' placeholder='Actual Stock'></td>"
            +"<td><input ng-model='qty_request' type='text' name='qty_request[]' class='form-control' placeholder='Qty Request'></td>"
            +"<td><input ng-model='uom' type='text' name='uom[]' class='form-control' placeholder='UOM'></td>"
            +"<td><input ng-model='remarks' type='text' name='remarks[]' class='form-control' placeholder='Remarks'></td>"
            +"<td><a class='btn btn-plus-"+document.getElementById('param').value+"' onclick='add_row()'><i class='fa fa-plus fa-lg'></i></a>"
            +"<a id='dlt"+document.getElementById('param').value+"' class='btn btn-minus-"+document.getElementById('param').value+"' onclick='delete_row("+document.getElementById('param').value+")'><i class='fa fa-minus fa-lg'></i></a></td></tr>";
		var trInput_name = '#trInput'+ (document.getElementById('param').value -1);
        $(apa).insertAfter($(trInput_name))
        
        document.getElementById('param').value = parseInt(document.getElementById('param').value) + 1;
	}
    
    
    function delete_row(param){
		$("#trInput" + param).remove();
		
		if(document.getElementById('param').value - 1 == param){	       
	       $('.btn-plus-'+(param - 1)).removeClass('hide');
       }else{
            for(i=param +1;i<document.getElementById('param').value;i++){
                $("#trInput" + i).attr('id', 'trInput'+(i-1));
                $("#dlt" + i).attr('onclick', "delete_row("+(i-1)+")");
                $("#dlt" + i).attr('id', 'dlt'+(i-1));
                $("#no" + i).html((i-1));
                $("#no" + i).attr('id', 'no'+(i-1));
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
    
</script>