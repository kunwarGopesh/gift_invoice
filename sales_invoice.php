\<?php
include("index_layout.php");
include("database.php");
if(isset($_POST['sub_data']))
{
$sess_id=$_SESSION['id'];		
$voucher_source="sales Invoice";
$flag=2;
$company_id=$_POST['company_id'];
$customer_id=$_POST['customer_id'];
$company_name=$_POST['company_name'];
$company_gst=$_POST['company_gst'];
$company_phone=$_POST['company_phone'];
$company_address=$_POST['company_address'];
$customer_name=$_POST['name'];
$city=$_POST['city_id'];
$state=$_POST['state_id'];
$pan_no=$_POST['pan_no'];
$Aadhaar_no=$_POST['Aadhaar_no'];
$address=$_POST['address'];
$mobile=$_POST['contact_no'];
$date=date('Y-m-d',strtotime($_POST['date']));
$item_ids=$_POST['item_id'];
$item_code=$_POST['item_code'];
$item_qtys=$_POST['item_qty'];
$item_prices=$_POST['item_price'];
$row_amounts=$_POST['row_amount'];
$total_amount=$_POST['total_amount'];
$total_qty=$_POST['total_qty'];
$total_rate=$_POST['total_rate'];
$total_amount_dis=$_POST['total_amount_dis'];
$dis_type=$_POST['r1'];
$dis_amount=$_POST['dis_amount'];
$total_after_discount=$_POST['total_after_discount'];
$tax_ids=$_POST['tax_id'];
$tax_pers=$_POST['per'];
$tax_amounts=$_POST['Tamount'];
$total_tax=$_POST['total_tax'];
$grand_total=$_POST['grand_total'];
/* echo "<pre>";
print_r($_POST);
echo "</pre>"; EXIT; */
if(empty($customer_id))
{			
			mysql_query("insert into `customer` SET `customer_name`='$customer_name',`address`='$address',
				`city`='$city',`state`='$state',`contact_no`='$mobile',`pan_no`='$pan_no',`Aadhaar_no`='$Aadhaar_no',`created_by`='$sess_id'");
				$customer_id=mysql_insert_id();
			mysql_query("insert into `companies` SET `customer_id`='$customer_id',`name`='$company_name',`address`='$company_address',
				`phone_no`='$company_phone',`gst_no`='$company_gst',`created_by`='$sess_id'");
		 
}
if(!empty($customer_id))
{
			
			mysql_query("insert into `sales_invoice` SET `customer_id`='$customer_id',`invoice_date`='$date',`total_qty`='$total_qty',`total_rate`='$total_rate',`total_amount_dis`='$total_amount_dis',
				`discount_type`='$dis_type',`discount_amount`='$dis_amount',`total_tax`='$total_tax',`amount_after_discount`='$total_after_discount',`grand_total`='$grand_total',`created_by`='$sess_id',`company_id`='$company_id'");
				$sales_invoice_id=mysql_insert_id();		
			$v=0;
			foreach($item_ids as $item_id)
			{		
				$item_qty=$item_qtys[$v];
				$item_price=$item_prices[$v];
				$row_amount=$row_amounts[$v];
				
				mysql_query("insert into `sales_invoice_details` SET `sales_invoice_id`='$sales_invoice_id',`item_id`='$item_id',
				`qty`='$item_qty',`item_price`='$item_price',`row_total_amount`='$row_amount',`created_by`='$sess_id',`edited_by`='$sess_id'");
				
				mysql_query("insert into `item_ledgers` SET `item_id`='$item_id',
				`qty`='$item_qty',`voucher_source`='$voucher_source',`voucher_id`='$sales_invoice_id',`status`='out',`transaction_date`='$date'");
				$v++;
			}
				$j=0; 
			foreach($tax_ids as $tax_id)
			{
				$tax_per=$tax_pers[$j];	
				$tax_amount=$tax_amounts[$j];
				/* echo "insert into `invoice_taxations` SET `invoice_id`='$invoice_id',`taxation_id`='$tax_id',
				`percentage`='$tax_per',`amount`='$tax_amount'";
				echo "<br>"; */
				mysql_query("insert into `invoice_taxations` SET `invoice_id`='$sales_invoice_id',`taxation_id`='$tax_id',
				`percentage`='$tax_per',`amount`='$tax_amount',`flag`='$flag'");
				$j++;
			}			
}
echo'<script>window.location="sales_invoice_list.php"</script>';
}
?>
<html>
<head>
<?php css();?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Master Invoices</title>
</head>
<?php contant_start(); menu(); ?>
<body>
	<div class="page-content-wrapper">
		<div class="page-content">
			<section class="content">
				<div class="row">
					<div class="col-md-12">
						<div class="portlet box blue">
							<div class="portlet-title ">
								<div class="caption">
									<i class="fa fa-gift"></i>Sales Invoice
								</div>
							</div>
					<div class="portlet-body form">
						<form method="POST" >
							<table class="table">
								<?php 
									  $company=mysql_query("select * from companies");
									  $company_no=mysql_query("select phone_no from company_contacts where company_id=1");
									 
									 while($fet=mysql_fetch_array($company_no))
									 {
										$phone_nos[]=$fet['phone_no'];
										
									 }
									 $phone_no_show=implode(',', $phone_nos);
									  $customer=mysql_query("select * from customer");
										$row1=mysql_fetch_array($customer);
										$row=mysql_fetch_array($company)
								?>
		<input type="hidden" value="sale" name="voucher_source"/>
							<tr>
								<td colspan="4">
									<span style="height:30px;width:350px;">
										<h4 class="box-title bold">Place of Supply:</h4>
										<p><?php echo $row['address'];?><br>
										<?php echo"phone No".":".$phone_no_show;?></p>
										<b><?php echo"GST No".":".$row['gst_no'];?></b>
										
									</span>
								</td>
							</tr> 
							<tr>
							<td>Select Company</td><td >:</td>
									<td>
										<select name="company_id" id="company_id" class="select2me form-control input-large ">
											<option value="">----------Choose Company ----------</option>
												<?php
														$customer_data=mysql_query("select * from `companies` where `customer_id`='0' && `supplier_id`='0'");
																
														while($row=mysql_fetch_array($customer_data))
														{?>		
															<option value="<?php echo $row['id'] ;?>"><?php echo $row['name']; ?>
															</option>
												<?php 	}?>
										</select> 
									</td>
								<td>Select Customer</td><td >:</td>
									<td>
										<select name="customer_id" id="customer_id" class="select2me form-control input-large select_customer">
											<option value="">----------Choose Customer ----------</option>
												<?php
														$customer_data=mysql_query("select * from customer ");
																
														while($row=mysql_fetch_array($customer_data))
														{?>		
															<option value="<?php echo $row['id'] ;?>"><?php echo $row['customer_name']; ?>
															</option>
												<?php 	}?>
										</select> 
									</td>
									
							</tr>
						</table>
							<div id="newtable">	
								<table class="table">	
									<tr>
										<td>Company Name</td><td>:</td>
										<td>
											<input class="form-control input-large company_name" placeholder="Enter Company Name"  name="company_name" autocomplete="off" type="text" value="">
										</td>
										<td>GST No</td><td>:</td>
										<td>
											<input class="form-control input-large company_gst" placeholder="Enter GST No" required name="company_gst" autocomplete="off" type="text" value="">
										</td>
									</tr>
									<tr>
										<td>Company Phone</td><td>:</td>
										<td>
											<input class="form-control input-large company_mobile" placeholder="Enter Phone No" required name="company_phone" autocomplete="off" type="text" value="">
										</td>
										<td>Address</td><td>:</td>
										<td>
											<input class="form-control input-large company_address" placeholder="Enter Address" required name="company_address" autocomplete="off" type="text" value="">
										</td>
									</tr>		
									<tr>
									<td>Customer Name</td><td>:</td>
										<td>
											<input class="form-control input-large customer_name" placeholder="Enter Customer Name" required name="name" autocomplete="off" type="text" value="">
										</td>
									<td>State</td><td>:</td>
										<td>
											<select name="state_id" id="state_id" class="select2me form-control input-large select_state" placeholder="----------Choose State ----------">
												<option value=""></option>
													<?php
															$customer_data=mysql_query("SELECT DISTINCT state FROM city_states ");
													
															while($row=mysql_fetch_array($customer_data))
													{?>		
															<option value="<?php echo $row['state'] ;?>"><?php echo $row['state']; ?></option>
													<?php }?>
											</select> 
										</td>
									</tr>
							<tr>
								<td>City</td><td>:</td>
									<td id="newcity">
										<select name="city_id" id="city_id" class="select2me form-control input-large select_city" placeholder="----------Choose City ----------">
											<option value=""></option>
										</select>
									</td>
									<td>Mobile No</td><td>:</td>
										<td>
											<input class="form-control input-large customer_mobile" placeholder="Enter Contact No" required name="contact_no" autocomplete="off" type="text" value="">
										</td>
							</tr>
							<tr>
								<td>Pan No</td><td>:</td>
								<td>
									<input class="form-control input-large customer_pan" placeholder="Enter Pan No" required name="pan_no" autocomplete="off" type="text" value="">
								</td>
								<td>Aadhaar No</td><td>:</td>
								<td>
									<input class="form-control input-large customer_aadhaar" placeholder="Enter Aadhaar No" required name="Aadhaar_no" autocomplete="off" type="text" value="">
								</td>
							</tr>
							<tr>
								<td>Address</td><td>:</td>
								<td>
									<input class="form-control input-large customer_address" placeholder="Enter Address" required name="address" autocomplete="off" type="text" value=""> 
								</td>
								<td>Invoice date</td><td>:</td>
								<td>
									<input class="form-control form-control-inline input-large date-picker date" placeholder="dd-mm-yyyy" required data-date-format="dd-mm-yyyy" size="16" autocomplete="off" type="text" name="date"> 
								</td>
							</tr>
					</table>
			</div>
					<table class="table" id="main_table1">
						<thead>
							 <tr style="background-color:#DCD9D8;">
								 <th style="border:1px;border-style:solid;">Sr.No</th>
								 <th style="border:1px;border-style:solid;white-space: nowrap;">ITEM CODE</th>
								 <th style="border:1px;border-style:solid;white-space: nowrap;width:%;">ITEM NAME</th>
								 <th style="border:1px;border-style:solid;">QTY</th>
								 <th style="border:1px;border-style:solid;">RATE</th>
								 <th  style="border:1px;border-style:solid;white-space: nowrap;">TAX</th>
								 <th style="border:1px;border-style:solid;white-space: nowrap;">AMOUNT</th>
								 <th style="border:1px;border-style:solid;width:5%;">*</th>
							</tr>
						</thead>
					<tbody id="main_tbody1"> 
					
					</tbody>
					<tfoot>
						<tr style="border:1px;border-style:solid;" id="subtotal_row">
							<td style="border:1px;border-style:solid;text-align:right;" colspan="3">Subtotal</td>
							<td style="border:1px;border-style:solid;width:20%;"><input class="form-control total_qty" placeholder="Total Qty" required name="total_qty" autocomplete="off" type="text" value=""></td>
							<td style="border:1px;border-style:solid;width:20%;"><input class="form-control total_rate" placeholder="Total rate" required name="total_rate" autocomplete="off" type="text" value=""></td>
							<td style="border:1px;border-style:solid;width:20%;"><input class="form-control total_tax" placeholder="Total Tax" required name="total_amount_dis" autocomplete="off" type="text" value=""></td>
							<td style="border:1px;border-style:solid;">
						<input class="form-control total_amount" placeholder="Total Amount" required name="total_amount_dis" autocomplete="off" type="text" value="">
							</td>
							<td colspan="0" style="border:1px;border-style:solid;"></td>
						</tr>
						<tr style="border:1px;border-style:solid;">
							<td style="border:1px;border-style:solid;text-align:right;" colspan="3">Discount</td>
							
							<td  style="border:1px;border-style:solid;">
								<div class="radio-list">
								<label class="radio-inline">
								<input type="radio" name="r1" class="dis_per" id="dis_id" value="1" > %</label>
								<label class="radio-inline">
								<input type="radio" name="r1" class="dis_rupee"id="dis_id" value="2">&#8377; </label>
								</div>
							
							</td>
							<td style="border:1px;border-style:solid;">
								<input class="form-control dis_amount" placeholder="Enter Value" required name="dis_amount" autocomplete="off" type="text" value="">									
							</td>
							<td style="border:1px;border-style:solid;">
								<input class="form-control tatal_tax" placeholder="Total Amount" required name="total_after_discount" autocomplete="off" type="text" value="">
							</td>
							<td style="border:1px;border-style:solid;">							
								<input class="form-control taxable_value" placeholder="Total Amount" required name="total_after_discount" autocomplete="off" type="text" value="">
							</td>
						<td style="border:1px;border-style:solid;"></td>
						</tr>
					<input type="hidden" id="tax_count" value="<?php echo $x?>"/>
						<tr style="border:1px;border-style:solid;">
							<td style="border:1px;border-style:solid;text-align:right;" colspan="4">
								Grand Total
							</td>
							<td style="border:1px;border-style:solid;text-align:right;" colspan="2">
								<input  class="form-control grand_total" placeholder="Grand Total" required name="grand_total" autocomplete="off" type="text" value="">
							</td>
							<td style="border:1px;border-style:solid;"></td>
						<input type="hidden" name="total_tax" id="TotTaxAmount" value="0">
						</tr>
						<tr>
							<td colspan="8">
								<center>
									<input class="btn btn-primary" type="submit" name="sub_data" value="Submit">
								</center>
							</td>
						</tr>
				</tfoot>
			</table>
			</form>
			<table id="sample_table1" style="display:none;">
						<tbody>
							<tr class="main_tr1" style="border:1px;border-style:solid;">
								<td style="border:1px;border-style:solid;">1 </td>
								<td style="border:1px;border-style:solid;">
								<input class="form-control input-small icode" placeholder="Item Code" required name="item_code[]" autocomplete="off" type="text" value="">
								</td>
								<td style="border:1px;border-style:solid;width:20%;">
									<input class="form-control input-medium iname" placeholder="Item Name" required name="item_name[]" autocomplete="off" type="text" value="">
									<input class="item_id" name="item_id[]" autocomplete="off" type="hidden" value="">
								</td>
							
							<td style="border:1px;border-style:solid;">
								<input class="form-control qty atqty " placeholder="Item Qty" required name="item_qty[]" autocomplete="off" type="text" >
							</td>
							<td style="border:1px;border-style:solid;">
								<input class="form-control rate" placeholder="Item Rate" required name="item_price[]" autocomplete="off" type="text" value="">
							</td>
							<td style="border:1px;border-style:solid;">
								<input class="form-control tax_amtt qwert" placeholder="Item Tax" required name="item_tax[]" autocomplete="off" type="text" value="">
							</td>
							<td colspan="" style="border:1px;border-style:solid;width:50%;">
								<input class="form-control row_amount" placeholder="Amount" required name="row_amount[]" autocomplete="off" type="text" value="">
							</td>
								<td style="border:1px;border-style:solid;width:30%;">
								<button type="button" class="btn btn-xs btn-default addrow"  href="#" role='button'>
									<i class="fa fa-plus"></i>
								</button>
								<button type="button" class="btn btn-xs btn-default deleterow" href="#" role='button'>
									<i class="fa fa-minus"></i>
								</button>
							</td>
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

	$(document).ready(function()
	{  
		$("#state_id").live('change', function ()
		{
			var state=$(this, 'option:selected').val();	
			$.ajax({
				url: "state_city.php?reg_no="+state,
				}).done(function(response) {
					$("#newcity").html(response);
					$(".select_city").select2();
				});
		});
		$(".icode").live('blur', function ()
		{
							
			var code=$(this).val();	
			var a=$(this);
			$.ajax({
				url: "item_details.php?icode="+code,
				}).done(function(response) {
					if(response !="")
						{
							$(".iname").attr( 'readonly', 'readonly' );
							$(".rate").attr( 'readonly', 'readonly' );
							$(".row_amount").attr( 'readonly', 'readonly' );
							var user_array=response.split(",");
							a.closest('tr').find('.item_id').val(user_array[0]);
							a.closest('tr').find('.iname').val(user_array[1]);
							a.closest('tr').find('.rate').val(user_array[2]);
							a.closest('tr').find('.atqty').attr('max',user_array[3]);
							a.closest('tr').find('.tax_amtt').val(user_array[4]);
							a.closest('tr').find('.qty').val(1);
							calculate_total();
						}
						else
						{
							
							a.closest('tr').find('.qty').val(0);
							a.closest('tr').find('.rate').val(0);
							a.closest('tr').find('.item_id').val(0);
							a.closest('tr').find('.tax_amtt').val(0);
							
						}
				});
		});
		
	
		$("#customer_id").live('change', function () 
		{
		 
			var customer_id=$(this, 'option:selected').val();
			var old=$("#old").html();
				if(customer_id>0)
					{
						$.ajax({
							url: "customer_data.php?reg_no="+customer_id,
							}).done(function(response) 
							{
								
								$("#newtable").html(response);
								$('.date-picker').datepicker();
							});
					}
				 else if((customer_id==0) || (customer_id==''))
					{
						
						$("#newtable").html(old);
						$('.date-picker').datepicker();
						$('.date-picker').datepicker().on('changeDate', function(){
						$(this).blur();
						$(this).datepicker('hide');
						})
						$('.state_blank').select2();
					}  
		});
		add_row();
		$('body').on('click','.addrow',function()
		{
			add_row(); rename_rows();
		});
		
		function add_row()
		{ 
			var tr1=$("#sample_table1 tbody tr").clone();
			$("#main_table1 tbody#main_tbody1").append(tr1);
											

			rename_rows();
		}
		$('body').on('click','.deleterow',function()
		{
			var rowCount = $("#main_table1 tbody tr.main_tr1").length;
				if (rowCount>1)
				{
					if (confirm("Are you sure to remove row ?") == true) 
					{
						$(this).closest("tr").remove();
						rename_rows();	
						calculate_total();				
					} 
				}
		});
	
		function rename_rows()
		{
			var i=0;
				$("#main_table1 tbody tr.main_tr1").each(function()
					{ 
						$(this).find("td:nth-child(1)").html(++i);
						$(this).find("td:nth-child(2) #item_id").select2();
						
					});
		}
		$(document).on('keyup','.qty,.rate,.dis_amount',function()
		{
			calculate_total();
		});
		 $(document).on('click','#dis_id',function()
		{
			calculate_total();
		}); 
		$(document).on('change','.tax_per',function()
		{
			calculate_total();
		});

	function calculate_total()
	{ 
		var i=0;
		var total_qty=0;
		var total_rate=0;
		var total_amount=0;
		var total_tax_amount=0;
		$("#main_table1 tbody tr.main_tr1").each(function()
		{
			var qty=0;var rate=0; var amount=0;var Taxx_amount=0;
			var qty=parseFloat($(this).find("td:nth-child(4) input.qty").val());
			var rate=parseFloat($(this).find("td:nth-child(5) input.rate").val());
			var tax=parseFloat($(this).find("td:nth-child(6) input.tax_amtt").val());
			if(isNaN(rate))
				{
					rate =0;
				}
				if(isNaN(tax))
				{
					tax =0;
				}
			if(isNaN(qty))
				{
					qty =0;
				}
			total_qty=total_qty+qty;
			total_rate=total_rate+rate;
			amount=qty*rate;
			total_amount=total_amount+amount;
			Taxx_amount=qty*tax;
			total_tax_amount=total_tax_amount+Taxx_amount;
			total_amount=total_amount+amount;
			$(this).find("td:nth-child(7) input.row_amount").val(amount.toFixed(2));
			$(this).find("td:nth-child(6) input.qwert").val(Taxx_amount.toFixed(2));
		});
		$("tfoot tr input.total_qty").val(total_qty.toFixed(2));
		$("tfoot tr input.total_rate").val(total_rate.toFixed(2));
		$("tfoot tr input.total_tax").val(total_tax_amount.toFixed(2));
		$("tfoot tr input.total_amount").val(total_amount.toFixed(2));
		$("tfoot tr input.taxable_value").val(total_amount.toFixed(2));
		$("tfoot tr input.amount_after_sgst").val(total_amount.toFixed(2));
		$("tfoot tr input.amount_after_cgst").val(total_amount.toFixed(2));
		$("tfoot tr input.grand_total").val(total_amount.toFixed(2));
		//--- discount ---//
		var dis_id=$("input[name='r1']:checked").val();		
		var dis_amount=parseFloat($("tfoot tr input.dis_amount").val());
		if(isNaN(dis_amount))
				{
					dis_amount =0;
				}
			if(dis_id==1)
			{
				var dis_value=(dis_amount*total_amount)/100;
				var temp=total_amount-dis_value;
				$("tfoot tr input.taxable_value").val(temp.toFixed(2));
				
			}else{
				var temp=total_amount-dis_amount;
				$("tfoot tr input.taxable_value").val(temp.toFixed(2));
			}
			
			//--- Taxation----//
		var tax_amount=0;
		
		var mainvalue = parseFloat($('.taxable_value').val());
		
		var tax_count = $('#tax_count').val();
		var TotTaxAmount=0;
		
		var GrandTotal=0;
		for(var b=1; b<=tax_count; b++){
			var percentage=$('#tex_per'+b+' option:selected').val();
			if(isNaN(percentage))
			{ 
 				$('#tax_amount'+b).val(0);
 			}
			else
			{
				var tax_amount=(percentage*mainvalue)/100;
				$('#tax_amount'+b).val(tax_amount.toFixed(2));
			}
				var tax_amt = tax_amount;
				if(tax_amt>0){
					TotTaxAmount = TotTaxAmount+tax_amt;
				}
				else {
					TotTaxAmount = TotTaxAmount+0;
				}
 		}
 		
		var GrandTotal = TotTaxAmount+mainvalue;
 		$("#TotTaxAmount").val(TotTaxAmount.toFixed(2));	
 		$(".grand_total").val(GrandTotal.toFixed(2));	
	}
	$(".atqty").live('keyup',function()
		{
			var quant=eval($(this).val());
			var quant_max=eval($(this).attr('max'));
			 
			 if(quant>quant_max){
				 alert("Quantity exceed",quant_max);
				 $(this).val(0);
				 calculate_total();
			 } 
		}); 
	
	});
    </script>
<?php scripts();?>
</html>	
<div id="old" style="display:none;">
	<table class="table">	
		<tr>
			<td>Company Name</td><td>:</td>
				<td>
					<input class="form-control input-large " placeholder="Enter Company Name" required name="company_name" autocomplete="off" type="text" value="" >
				</td>
			<td>GST No</td><td>:</td>
				<td>
					<input class="form-control input-large " placeholder="Enter GST No" required name="company_gst" autocomplete="off" type="text" value="">
				</td>
		</tr>
		<tr>
			<td>Company Phone</td><td>:</td>
				<td>
					<input class="form-control input-large " placeholder="Enter Phone No" required name="company_phone" autocomplete="off" type="text" value="">
				</td>
			<td>Address</td><td>:</td>
				<td>
					<input class="form-control input-large" placeholder="Enter Address" required name="company_address" autocomplete="off" type="text" value="">
				</td>
		</tr>		
		<tr>
		    <td>Customer Name</td><td>:</td>
				<td>
					<input class="form-control input-large " placeholder="Enter Customer Name" required name="name" autocomplete="off" type="text" value=""> 
				</td>
			<td>State</td><td>:</td>
				<td>
					<select name="state_id" id="state_id" class="form-control input-large state_blank" placeholder="----------Choose State ----------">
						<option value=""></option>
							<?php
									$customer_data=mysql_query("SELECT DISTINCT state FROM city_states ");
									while($row=mysql_fetch_array($customer_data))
										{?>		
										<option value="<?php echo $row['state'] ;?>"><?php echo $row['state'];	?>
										</option>
										<?php }?>
					</select> 
				</td>
		</tr>
			<tr>
				<td>City</td><td>:</td>
					<td id="newcity">
						<select name="city_id" id="city_id" class="select2me form-control input-large city_blank" placeholder="----------Choose City ----------">
							<option value=""></option>
						</select>
					</td>
				<td>Mobile No</td><td>:</td>
					<td>
							<input class="form-control input-large " placeholder="Enter Contact No" required name="contact_no" autocomplete="off" type="text" value="">
					</td>
			</tr>
			<tr>
				<td>Pan No</td><td>:</td>
					<td>
						<input class="form-control input-large" placeholder="Enter Pan No" required name="pan_no" autocomplete="off" type="text" value=""> 
					</td>
				<td>Aadhaar No</td><td>:</td>
					<td>
						<input class="form-control input-large " placeholder="Enter Aadhaar No" required name="Aadhaar_no" autocomplete="off" type="text" value="">
					</td>
			</tr>
			<tr>
				<td>Address</td><td>:</td>
					<td>
						<input class="form-control input-large " placeholder="Enter Address" required name="address" autocomplete="off" type="text" value=""> 
					</td>
				<td>Invoice date</td><td>:</td>
					<td>
						<input class="form-control form-control-inline input-large date-picker date" placeholder="dd-mm-yyyy" required data-date-format="dd-mm-yyyy" size="16" autocomplete="off" type="text" name="date"> 
					</td>
			</tr>
	</table>
</div>
	

