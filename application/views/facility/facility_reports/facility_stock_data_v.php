 <div class="container" style="width: 96%; margin: auto;">
     <?php echo form_open('stock/edit_facility_stock_data'); ?>  
 <table width="100%" border="0" class="row-fluid table table-hover table-bordered table-update"  id="example">
	<thead>
		<tr>
			<th>Commodity Name</th>
			<th>Commodity Code</th>
			<th>Unit Size</th>
			<th>Supplier</th>
			<th>Batch No</th>
			<th>Expiry Date</th>
			<th>Manufacturer</th>
			<th>Balance(units)</th>
			<th>Balance(packs)</th>
<?php  if($this -> session -> userdata('user_indicator')=='facility_admin') echo " <th>Delete</th>"; ?>	
		</tr>
	</thead>
	<tbody>
<?php 
foreach ($facility_stock_data as $facility_stock_data) :						
			$commodity_name=$facility_stock_data['commodity_name'];
			$expiry_date=date('D d, M Y', strtotime($facility_stock_data['expiry_date']));
			$unit_size=$facility_stock_data['unit_size'];
			$commodity_balance_units=$facility_stock_data['commodity_balance'];	
			$commodity_balance_packs=$facility_stock_data['pack_balance'];	
			$source_name=$facility_stock_data['source_name'];	
			$batch_no=$facility_stock_data['batch_no'];	
			$commodity_code=$facility_stock_data['commodity_code'];
			$commodity_id=$facility_stock_data['commodity_id'];
			$manufacturer=$facility_stock_data['manufacture'];	
           // check if the user can edit the stock level
if($this -> session -> userdata('user_indicator')=='facility_admin'){$check_box="</td><td><input type='checkbox' name='delete[$count]' value='1' /></td>";}
		else{$check_box="<input type='hidden' name='delete[$count]' value='0' /></td>";}	
		echo "<tr>
		<td>$commodity_name</td>
		<td><input type='hidden' name='id[]' class='id' value='$facility_stock_data[facility_stock_id]'/>
		<input type='hidden' name='commodity_id[]'  value='$commodity_id'/>
		<input type='hidden' name='commodity_balance_units[]'  value='$commodity_balance_units'/>
		$commodity_code</td>
		<td>$unit_size</td>
		<td>$source_name</td>
		<td><input type='text' name='batch_no[]' class='form-control input-small' value='$batch_no'/></td>
		<td><input type='text' name='expiry_date[]' class='form-control input-small clone_datepicker' value='$expiry_date'/></td>
		<td><input type='text' name='manufacturer[]' class='form-control input-small' value='$manufacturer'/></td>
		<td>$commodity_balance_units</td>
		<td>$commodity_balance_packs
		$check_box
		</tr>";		
endforeach;?> 
</tbody>
</table>  
<hr />
<div class="container-fluid">
<div style="float: right">
<button class="btn btn-success" ><span class="glyphicon glyphicon-open"></span>Update</button></div>
</div>
</div>
  <?php echo form_close(); ?>  
<script>
$(document).ready(function() {
	//datatables settings 
	$('#example').dataTable( {
		 "sDom": "T lfrtip",
	     "sScrollY": "377px",
	     "sScrollX": "100%",
                    "sPaginationType": "bootstrap",
                    "oLanguage": {
                        "sLengthMenu": "_MENU_ Records per page",
                        "sInfo": "Showing _START_ to _END_ of _TOTAL_ records",
                    },
			      "oTableTools": {
                 "aButtons": [
				"copy",
				"print",
				{
					"sExtends":    "collection",
					"sButtonText": 'Save ',
					"aButtons":    [ "csv", "xls", "pdf" ]
				}
			],
		"sSwfPath": "<?php echo base_url(); ?>assets/datatable/media/swf/copy_csv_xls_pdf.swf"
		}
	} );
	$('#example_filter label input').addClass('form-control');
	$('#example_length label select').addClass('form-control');
});
</script>