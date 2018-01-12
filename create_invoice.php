<?php
include("index_layout.php");
include("database.php");
?>
<html>
<head>
<?php css();?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Master Invoices</title>
</head>
<?php contant_start(); menu();  ?>
<body>
	<div class="page-content-wrapper">
		<div class="page-content">
		<section class="content">
		<div class="row">
			<div class="col-md-12">
			<div class="portlet box blue">
			<div class="portlet-title ">
				<div class="caption">
					<i class="fa fa-gift"></i>Create Invoice
				</div>
			</div>
			<div class="portlet-body form">
			 <table class="table">
			  <?php 
			  $company=mysql_query("select * from companies");
			  $customer=mysql_query("select * from customer");
				$row1=mysql_fetch_array($customer);
				$row=mysql_fetch_array($company);
				?>
				<tr>
				<td colspan="4">
				<span style="height:30px;width:350px;">
				<h4 class="box-title">Place of Supply:</h4><br>
				<?php echo $row['address'];?><br>
				 <p><?php echo $row['phone_no'];?></p>
				 <p>GST Number :<?php echo $row['gst_no'];?></p>
				 </span></td>
				</tr> 

			<tr>
		    <td>Select Customer</td><td >:</td>
		    <td>
			<select name="customer_id" id="customer_id" class="select2me form-control input-large select_customer">
								<option value="">----------Choose Customer ----------</option>
									<?php
									$customer_data=mysql_query("select * from customer ");
									
									while($row=mysql_fetch_array($customer_data))
									{?>		
											<option value="<?php echo $row['id'] ;?>"><?php echo $row['customer_name']; ?></option>
										<?php }?>
										</select> 
			</td>
			<td>Invoice date</td><td>:</td>
		    <td><input class="form-control form-control-inline input-large date-picker date" placeholder="yyyy-mm-dd" required data-date-format="yyyy-mm-dd" size="16" autocomplete="off" type="text" name="date"> </td>
			</tr>
</table>
<div id="newtable">	
<table class="table">	
		<tr>
		    <td>Customer Name</td><td>:</td>
		    <td><input class="form-control input-large customer_name" placeholder="Enter Customer Name" required name="name" autocomplete="off" type="text" value=""> </td>
			<td>State</td><td>:</td>
		    <td><input class="form-control input-large customer_state" placeholder="Enter state" required name="state" autocomplete="off" type="text" value=""> </td>
			</tr>
			<tr>
		    
			<td>City</td><td>:</td>
		    <td><input class="form-control input-large customer_city" placeholder="Enter City" required name="city" autocomplete="off" type="text" value=""> </td>
		    <td>GST No</td><td>:</td>
		    <td><input class="form-control input-large customer_gst" placeholder="Enter GST No" required name="gst_no" autocomplete="off" type="text" value=""> </td>
			</tr>
			<tr>
		    <td>Pan No</td><td>:</td>
		    <td><input class="form-control input-large customer_pan" placeholder="Enter Pan No" required name="pan_no" autocomplete="off" type="text" value=""> </td>
		    <td>Aadhaar No</td><td>:</td>
		    <td><input class="form-control input-large customer_aadhaar" placeholder="Enter Aadhaar No" required name="Aadhar_no" autocomplete="off" type="text" value=""></td>
			</tr>
			<tr>
			 <td>Address</td><td>:</td>
		    <td><input class="form-control input-large customer_address" placeholder="Enter Address" required name="address" autocomplete="off" type="text" value=""> </td>
			<td>Mobile No</td><td>:</td>
		    <td><input class="form-control input-large customer_mobile" placeholder="Enter Contact No" required name="contact_no" autocomplete="off" type="text" value=""></td>

			</tr>
</table>
</div>


		<table class="table" id="main_table1">
		<thead>
		 <tr style="background-color:#DCD9D8;">
			 <th style="border:1px;border-style:solid;">SL.NO</th>
			 <th style="border:1px;border-style:solid;white-space: nowrap;">ITEM CATEGORY</th>
			 <th style="border:1px;border-style:solid;white-space: nowrap;">ITEM NAME</th>
			 <th style="border:1px;border-style:solid;white-space: nowrap;width:12%;">ITEM CODE</th>
			 <th style="border:1px;border-style:solid;">QTY</th>
			 <th style="border:1px;border-style:solid;">RATE</th>
			 <th style="border:1px;border-style:solid;white-space: nowrap;">AMOUNT</th>
			 <th style="border:1px;border-style:solid;width:5%;">*</th>
			 </tr>
		</thead>
		<tbody id="main_tbody1"> 
		
		</tbody>
		<tfoot>
		<tr style="border:1px;border-style:solid;" id="subtotal_row">
		<td style="border:1px;border-style:solid;text-align:right;" colspan="4">Subtotal</td>
		<td style="border:1px;border-style:solid;width:20%;"><input class="form-control total_qty" placeholder="Total Qty" required name="total_qty" autocomplete="off" type="text" value=""></td>
		<td style="border:1px;border-style:solid;width:20%;"><input class="form-control total_rate" placeholder="Total rate" required name="total_price" autocomplete="off" type="text" value=""></td>
		<td colspan="2" style="border:1px;border-style:solid;width:20%;"><input class="form-control total_amount" placeholder="Total Amount" required name="total_amount" autocomplete="off" type="text" value=""></td>
		</tr>
		<tr style="border:1px;border-style:solid;">
		<td style="border:1px;border-style:solid;text-align:right;" colspan="4">Discount</td>
		<td colspan="" style="border:1px;border-style:solid;">
		<input class="form-control dis_rupee " placeholder="Enter Amount" required name="dis_rupee" autocomplete="off" type="text" value="">
		</td>
		<td><input class="form-control dis_per " placeholder="Enter %" required name="dis_per" autocomplete="off" type="text" value=""></td>
		<td colspan="2" style="border:1px;border-style:solid;"><input class="form-control taxable_value" placeholder="Total Amount" required name="total_amount" autocomplete="off" type="text" value=""></td>
		</tr>
		
		<tr style="border:1px;border-style:solid;">
		<td style="border:1px;border-style:solid;text-align:right;" colspan="4">SGST</td>
		<td style="border:1px;border-style:solid;text-align:right;">
		<select class="select form-control input-small sgst_option" name="cgst">
			<option>%</option>
			<?php $customer_data=mysql_query("select percentage from taxation_rates where taxation_name='SGST'");				
									while($row=mysql_fetch_array($customer_data))
									{?>		
											<option class="sgst_option"value="<?php echo $row['id'] ;?>"><?php echo $row['percentage']; ?></option>
										<?php }?>
		</select>
		</td>
		<td style="border:1px;border-style:solid;">
		<input class="form-control sgst_amount " placeholder="SGST Amount" required name="sgst_amount" autocomplete="off" type="text"></td>
		<td colspan="2" style="border:1px;border-style:solid;">
		<input class="form-control amount_after_sgst " placeholder="Total Amount" required name="total_amount" autocomplete="off" type="text"></td>
		</tr>
		<tr style="border:1px;border-style:solid;">
		<td style="border:1px;border-style:solid;text-align:right;" colspan="4">CGST</td>
		<td style="border:1px;border-style:solid;text-align:right;">	
		<select class="select form-control input-small cgst_option" name="cgst">
			<option>%</option>
			<?php $customer_data=mysql_query("select percentage from taxation_rates where taxation_name='CGST'");				
									while($row=mysql_fetch_array($customer_data))
									{?>		
											<option value="<?php echo $row['id'] ;?>"><?php echo $row['percentage']; ?></option>
										<?php }?>
			
		</select>
		</td>
		<td style="border:1px;border-style:solid;">
		<input class="form-control cgst_amount " placeholder="CGST Amount" required name="cgst_amount" autocomplete="off" type="text"></td>
		<td colspan="2" style="border:1px;border-style:solid;"><input class="form-control amount_after_cgst" placeholder="Total Amount" required name="total_amount" autocomplete="off" type="text" value=""></td>
		</tr>
		<tr style="border:1px;border-style:solid;">
		<td style="border:1px;border-style:solid;text-align:right;" colspan="4">Grand Total</td>
		<td style="border:1px;border-style:solid;text-align:right;" colspan="4">
		<input class="form-control grand_total" placeholder="Grand Total" required name="total_qty" autocomplete="off" type="text" value=""></td>
		</tr>
		<tr>
		<td colspan="8">
		<center>
		<input class="btn btn-primary"type="submit" name="submit" value="Submit"></td>
		</center>
		</tr>
		</tfoot>
		</table>
		<table id="sample_table1" style="display:none;">
		<tbody>
		<tr class="main_tr1" style="border:1px;border-style:solid;">
		<td style="border:1px;border-style:solid;">1 </td>
		<td style="border:1px;border-style:solid;"><select name="category" class="select2me form-control input-medium ">
								<option  >--select Item Category--</option>
									<?php
									$sql=mysql_query("select id,category_name from master_category where flag='0'");
									
									while($row=mysql_fetch_array($sql))
									{?>		
											<option  value="<?php echo $row['id'] ;?>"><?php echo $row['category_name']; ?></option>
										<?php }?>
			</td>
			<td style="border:1px;border-style:solid;width:20%;"><input class="form-control " placeholder="Item Name" required name="item_name" autocomplete="off" type="text" value=""></td>
			<td style="border:1px;border-style:solid;"><input class="form-control " placeholder="Item Code" required name="item_code" autocomplete="off" type="text" value=""></td>
			<td style="border:1px;border-style:solid;"><input class="form-control qty " placeholder="Item Qty" required name="qty" autocomplete="off" type="text" value=""></td>
			<td style="border:1px;border-style:solid;"><input class="form-control rate" placeholder="Item Rate" required name="price" autocomplete="off" type="text" value=""></td>
			<td colspan="" style="border:1px;border-style:solid;width:50%;"><input class="form-control row_amount" placeholder="Amount" required name="tatal Amount" autocomplete="off" type="text" value=""></td>
			<td style="border:1px;border-style:solid;width:30%;"><button type="button" class="btn btn-xs btn-default addrow"  href="#" role='button'><i class="fa fa-plus"></i></button><button type="button" class="btn btn-xs btn-default deleterow" href="#" role='button'><i class="fa fa-minus"></i></button></td>
			</tr>
			</table>
			
			</div>
		</div>
	</div>
</section>

</body>
<?php footer(); ?>
<script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script>
        $(document).ready(function() {    

			/* $('.date-picker').datepicker();
			$('.date-picker').datepicker().on('changeDate', function(){
			$(this).blur();
			$(this).datepicker('hide');
			}); 		 */
        
         $("#customer_id").live('change', function () {
		 var customer_id=$(this, 'option:selected').val();
		 var old=$("#old").html();
			if(customer_id>0){
			$.ajax({
				url: "customer_data.php?reg_no="+customer_id,
				}).done(function(response) {
					$("#newtable").html(response);
				});
			}else if((customer_id==0) || (customer_id=='')){
				$("#newtable").html(old);
			}
			
		 
	 });
	 
	  $(".dis_rupee").on('focus', function () {
		  $(".dis_rupee").removeAttr( "readonly" )
		 $(".dis_per").attr( 'readonly', 'readonly' );
	 });
	 
	 $(".dis_per").on('focus', function () {
		 $(".dis_per").removeAttr( "readonly" )
		 $(".dis_rupee").attr( 'readonly', 'readonly' );
	 });
	 
	add_row();
	$('body').on('click','.addrow',function(){
		add_row(); rename_rows();
    });
	
	function add_row(){ 
		var tr1=$("#sample_table1 tbody tr").clone();
		$("#main_table1 tbody#main_tbody1").append(tr1);
		rename_rows();
	}
	$('body').on('click','.deleterow',function(){
		var rowCount = $("#main_table1 tbody tr.main_tr1").length;
		if (rowCount>1){
			if (confirm("Are you sure to remove row ?") == true) {
				$(this).closest("tr").remove();
				rename_rows();	
			calculate_total();				
			} 
		}
	});
	function rename_rows(){
		var i=0;
		
		$("#main_table1 tbody tr.main_tr1").each(function()
		{ 
			$(this).find("td:nth-child(1)").html(++i);
			
			 $(this).find('td:nth-child(2) input').attr({name:"master_items["+i+"][category_id]"});
			 $(this).find('td:nth-child(3) input').attr({name:"master_items["+i+"][item_name]"});
			 $(this).find('td:nth-child(4) input').attr({name:"master_items["+i+"][item_code]"});
			 $(this).find('td:nth-child(5) input').attr({name:"master_items["+i+"][qty]"});
			 $(this).find('td:nth-child(6) input').attr({name:"master_items["+i+"][price]"});
			 $(this).find('td:nth-child(7) input').attr({name:"master_items["+i+"][total_amount]"});
		});
	};

	function calculate_total()
	{ 
	var i=0;
	var total_qty=0;
	var total_rate=0;
	var total_amount=0;
			$("#main_table1 tbody tr.main_tr1").each(function()
			{
				var qty=0;var rate=0; var amount=0;
				var qty=parseFloat($(this).find("td:nth-child(5) input.qty").val());
				var rate=parseFloat($(this).find("td:nth-child(6) input.rate").val());
		
				if(isNaN(rate))
				{
					rate =0;
				}
				if(isNaN(qty))
				{
					qty =0;
				}
				total_qty=total_qty+qty;
				total_rate=total_rate+rate;
				amount=qty*rate;
				total_amount=total_amount+amount;
				$(this).find("td:nth-child(7) input.row_amount").val(amount.toFixed(2));
							
			});
			$("tfoot tr input.total_qty").val(total_qty.toFixed(2));
			$("tfoot tr input.total_rate").val(total_rate.toFixed(2));
			$("tfoot tr input.total_amount").val(total_amount.toFixed(2));
			$("tfoot tr input.taxable_value").val(total_amount.toFixed(2));
			$("tfoot tr input.amount_after_sgst").val(total_amount.toFixed(2));
			$("tfoot tr input.amount_after_cgst").val(total_amount.toFixed(2));
			$("tfoot tr input.total_amount").val(total_amount.toFixed(2));
			var dis_rupee=parseFloat($("tfoot tr input.dis_rupee").val());
			if(dis_rupee){
				var dis_value=(dis_rupee/total_amount)*100;
				total_amount=total_amount-dis_rupee;
				$("tfoot tr input.taxable_value").val(total_amount.toFixed(2));
				$("tfoot tr input.dis_per").val(dis_value.toFixed(2));
			}
			else if(dis_rupee==0){
				$("tfoot tr input.taxable_value").val(total_amount.toFixed(2));
				$("tfoot tr input.dis_per").val(0);
			}
			var taxable_value=parseFloat($("tfoot tr input.taxable_value").val());
			var sgst=0;
			 sgst=$( ".sgst_option option:selected" ).text();
			if(isNaN(sgst)){ 
				$("tfoot tr input.sgst_amount").val(0);
				$("tfoot tr input.amount_after_sgst").val(taxable_value.toFixed(2));
			}else{
				var sgst_value=(sgst*taxable_value)/100;
				var amount_after_sgst=sgst_value+taxable_value;
				$("tfoot tr input.sgst_amount").val(sgst_value.toFixed(2));
				$("tfoot tr input.amount_after_sgst").val(amount_after_sgst.toFixed(2));
				
			} 
			var taxable_value_after_sgst=parseFloat($("tfoot tr input.amount_after_sgst").val());
			var cgst=0;
			 cgst=$( ".cgst_option option:selected" ).text();
			if(isNaN(cgst)){ 
				$("tfoot tr input.cgst_amount").val(0);
				$("tfoot tr input.amount_after_cgst").val(taxable_value_after_sgst.toFixed(2));
			}else{
				var cgst_value=(cgst*taxable_value)/100;
				var amount_after_cgst=cgst_value+taxable_value_after_sgst;
				$("tfoot tr input.cgst_amount").val(cgst_value.toFixed(2));
				$("tfoot tr input.amount_after_cgst").val(amount_after_cgst.toFixed(2));
				
			}
			$("tfoot tr input.grand_total").val(amount_after_cgst.toFixed(2));		
        };
		$(document).on('keyup','.qty,.rate,.dis_rupee',function(){
		calculate_total();

		});
		$(document).on('blur','.dis_per',function(){
		//var table=$(this).closest('table');
		calculate_total1();

		});
		function calculate_total1()
		{ 
			var total_amount=parseFloat($("tfoot tr input.total_amount").val());
			var dis_per=parseFloat($("tfoot tr input.dis_per").val());
			if(dis_per){
				var dis_value=(dis_per*total_amount)/100;
				$("tfoot tr input.dis_rupee").val(dis_value.toFixed(2));
				calculate_total();
			}
			if(dis_per==0){
				$("tfoot tr input.dis_rupee").val(0);
				calculate_total();
			}
			
		}
		$(document).on('change','.sgst_option,.cgst_option',function(){
		//var table=$(this).closest('table');
		calculate_total();

		});
		});
    </script>
<?php scripts();?>

</html>	
<div id="old" style="display:none;">
<table class="table">
			<tr>
		    <td>Customer Name</td><td>:</td>
		    <td><input class="form-control input-large " placeholder="Enter Customer Name" required name="name" autocomplete="off" type="text" value=""> </td>
			<td>City</td><td>:</td>
		    <td><input class="form-control input-large " placeholder="Enter City" required name="city" autocomplete="off" type="text" value=""> </td>
			</tr>
			<tr>
		    <td>State</td><td>:</td>
		    <td><input class="form-control input-large " placeholder="Enter state" required name="state" autocomplete="off" type="text" value=""> </td>
		    <td>GST No</td><td>:</td>
		    <td><input class="form-control input-large " placeholder="Enter GST No" required name="gst_no" autocomplete="off" type="text" value=""> </td>
			</tr>
			<tr>
		    <td>Pan No</td><td>:</td>
		    <td><input class="form-control input-large " placeholder="Enter Pan No" required name="pan_no" autocomplete="off" type="text" value=""> </td>
		    <td>Aadhaar No</td><td>:</td>
		    <td><input class="form-control input-large " placeholder="Enter Aadhaar No" required name="Aadhar_no" autocomplete="off" type="text" value=""></td>
			</tr>
			<tr>
			 <td>Address</td><td>:</td>
		    <td><input class="form-control input-large " placeholder="Enter Address" required name="address" autocomplete="off" type="text" value=""> </td>
			<td>Mobile No</td><td>:</td>
		    <td><input class="form-control input-large " placeholder="Enter Contact No" required name="contact_no" autocomplete="off" type="text" value=""></td>
		   </tr>
		   </table>
</div>	  
<?php 
include("database.php");
if(isset($_POST['submit']))
{
	$customer_id=$_POST['customer_id'];
	$name=$_POST['name'];
	$city=$_POST['city'];
	$state=$_POST['state'];
	$gst_no=$_POST['gst_no'];
	$pan_no=$_POST['pan_no'];
	$mobile=$_POST['contact_no'];
	$Aadhaar_no=$_POST['Aadhaar_no'];
	$address=$_POST['address'];
	mysql_query("insert into `master_items` SET `item_name`='$name',`item_code`='$code',
		`description`='$des',`item_price`='$price',`qty`='$qty',`category_id`='$catid'");
		
	echo '<script>window.location="item.php"</script>';
}

?>