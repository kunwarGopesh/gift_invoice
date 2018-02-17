<?php
include("index_layout.php");
include("database.php");
if(isset($_POST['sub_data']))
{
$sess_id=$_SESSION['id'];	
$voucher_source="Purchase Invoice";
$flag=1;
$invoice_id=$_GET['invoice_id'];
$invoice_type=$_POST['radio1'];
$supplier_id=$_POST['supplier_id'];
$company_name=$_POST['company_name'];
$company_gst=$_POST['company_gst'];
$company_phone=$_POST['company_phone'];
$company_address=$_POST['company_address'];
$supplier_name=$_POST['name'];
$city=$_POST['city_id'];
$state=$_POST['state_id'];
$pan_no=$_POST['pan_no'];
$Aadhaar_no=$_POST['Aadhaar_no'];
$address=$_POST['address'];
$mobile=$_POST['contact_no'];
$date=date('Y-m-d',strtotime($_POST['date']));
$item_ids=$_POST['item_id'];
$item_qtys=$_POST['item_qty'];
$actual_rates=$_POST['actual_rate'];
$item_taxs=$_POST['item_tax'];
$final_rates=$_POST['final_rate'];
$row_amounts=$_POST['row_amount'];
$row_tax_amounts=$_POST['row_tax_amount'];
$total_qty=$_POST['total_qty'];
$total_actual_price=$_POST['total_actual_price'];
$total_item_tax=$_POST['total_item_tax'];
$total_final_price=$_POST['tota_final_price'];
$total_actual_amount=$_POST['total_actual_amount'];
$final_tax_amount=$_POST['final_tax_amount'];
$dis_type=$_POST['r1'];
$dis_amount=$_POST['dis_amount'];
$total_after_discount=$_POST['total_after_discount'];
$grand_total=$_POST['grand_total'];
$cash_amount=$_POST['cash_amount'];
$Remaining_amount=$_POST['Remaining_amount'];
/*  echo "<pre>";
print_r($_POST);
echo "</pre>"; EXIT; */
if(empty($supplier_id))
{
				mysql_query("DELETE FROM `supplier` WHERE `id`='$supplier_id'");
				mysql_query("DELETE FROM `companies` WHERE `supplier_id`='$supplier_id'");
				mysql_query("insert into `supplier` SET `supplier_name`='$supplier_name',`address`='$address',
				`city`='$city',`state`='$state',`contact_no`='$mobile',`pan_no`='$pan_no',`Aadhaar_no`='$Aadhaar_no',`created_by`='$sess_id' ");
				$supplier_id=mysql_insert_id();
				mysql_query("insert into `companies` SET `supplier_id`='$supplier_id',`name`='$company_name',`address`='$company_address',
				`phone_no`='$company_phone',`gst_no`='$company_gst',`created_by`='$sess_id'");
		 
}	 					
if(!empty($supplier_id))
{
	mysql_query("update `supplier` SET `supplier_name`='$supplier_name',`address`='$address',
				`city`='$city',`state`='$state',`contact_no`='$mobile',`pan_no`='$pan_no',`Aadhaar_no`='$Aadhaar_no',`created_by`='$sess_id' where `id`='$supplier_id'");
			mysql_query("update `companies` SET `supplier_id`='$supplier_id',`name`='$company_name',`address`='$company_address',
				`phone_no`='$company_phone',`gst_no`='$company_gst',`created_by`='$sess_id' where `supplier_id`='$supplier_id'");
				
			 if($invoice_type==1)
	{	
		mysql_query("update  `purchase_invoice` SET `supplier_id`='$supplier_id',`invoice_date`='$date',`total_qty`='$total_qty',`total_actual_price`='$total_actual_price',`total_item_tax`='$total_item_tax',`total_final_price`='$total_final_price',`total_actual_amount`='$total_actual_amount',`total_tax_amount`='$final_tax_amount',
				`discount_type`='$dis_type',`discount_amount`='$dis_amount',`amount_after_discount`='$total_after_discount',`grand_total`='$grand_total',`cash_amount`='$cash_amount',`due_amount`='$Remaining_amount',`created_by`='$sess_id',`flag`='1' where `id`='$invoice_id'");
	
	}
	else
	{
		echo "update `purchase_invoice` SET `supplier_id`='$supplier_id',`invoice_date`='$date',`total_qty`='$total_qty',`total_actual_price`='$total_actual_price',`total_item_tax`='$total_item_tax',`total_final_price`='$total_final_price',`total_actual_amount`='$total_actual_amount',`total_tax_amount`='$final_tax_amount',
				`discount_type`='$dis_type',`discount_amount`='$dis_amount',`amount_after_discount`='$total_after_discount',`grand_total`='$grand_total',`cash_amount`='$cash_amount',`due_amount`='$Remaining_amount',`created_by`='$sess_id',`flag`='2' where `id`='$invoice_id'";
		
		mysql_query("update `purchase_invoice` SET `supplier_id`='$supplier_id',`invoice_date`='$date',`total_qty`='$total_qty',`total_actual_price`='$total_actual_price',`total_item_tax`='$total_item_tax',`total_final_price`='$total_final_price',`total_actual_amount`='$total_actual_amount',`total_tax_amount`='$final_tax_amount',
				`discount_type`='$dis_type',`discount_amount`='$dis_amount',`amount_after_discount`='$total_after_discount',`grand_total`='$grand_total',`cash_amount`='$cash_amount',`due_amount`='$Remaining_amount',`created_by`='$sess_id',`flag`='2' where `id`='$invoice_id'");
	}		
				mysql_query("DELETE FROM `purchase_invoice_details` WHERE `purchase_invoice_id`='$invoice_id'" );
				mysql_query("DELETE FROM `item_ledgers` WHERE `voucher_id`='$invoice_id' && `status`='in'" );
			$v=0;
			foreach($item_ids as $item_id)
			{		
				$item_qty=$item_qtys[$v];
				$actual_rate=$actual_rates[$v];
				$item_tax=$item_taxs[$v];
				$final_rate=$final_rates[$v];
				$row_tax_amount=$row_tax_amounts[$v];
				$row_amount=$row_amounts[$v];
				/* echo "insert into `invoice_details` SET `invoice_id`='$invoice_id',`item_id`='$item_id',
				`qty`='$item_qty',`item_price`='$item_price',`row_total_amount`='$row_amount'";
				echo "<br>"; */
				mysql_query("insert into `purchase_invoice_details` SET `purchase_invoice_id`='$invoice_id',`item_id`='$item_id',
				`qty`='$item_qty',`actual_price`='$actual_rate',`item_tax`='$item_tax',`final_price`='$final_rate',`row_total_tax`='$row_tax_amount',`row_total_amount`='$row_amount',`created_by`='$sess_id',`edited_by`='$sess_id'");
				mysql_query("insert into `item_ledgers` SET `item_id`='$item_id',`supplier_id`='$supplier_id',
				`qty`='$item_qty',`voucher_source`='$voucher_source',`voucher_id`='$invoice_id',`status`='in',`transaction_date`='$date'");
				$v++;
			}
}
echo'<script>window.location="purchase_invoice_list.php"</script>';
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
									<i class="fa fa-gift"></i>Create Invoice
								</div>
							</div>
					<div class="portlet-body form">
						<form method="POST" >
						 	
							<table class="table">
								<?php
										$invoice_id=$_GET['invoice_id'];
										 $invoices=mysql_query("select * from `purchase_invoice` where `id`='$invoice_id'");
										 $invoice_data=mysql_fetch_array($invoices);
										 $supplier_id=$invoice_data['supplier_id'];
										 $curr_date=$invoice_data['invoice_date'];
										 $edit_date= date('d-m-Y',strtotime($curr_date));
									  $company=mysql_query("select * from `companies` where `supplier_id`='$supplier_id'");
									  $company_data=mysql_fetch_array($company);
									  $supplier=mysql_query("select * from `supplier` where `id`='$supplier_id'");
										$supplier_data=mysql_fetch_array($supplier);
										
								?>
							<tr>
								<td colspan="4">
									<span style="height:30px;width:350px;">
										<h4 class="box-title bold">Place of Supply:</h4>
										<p><?php echo $company_data['name'];?><br>
										<?php echo $company_data['address'];?><br>
										<?php echo"phone No".":".$company_data['phone_no'];?></p>
										<b><?php echo"GST No".":".$company_data['gst_no'];?></b>
										
									</span>
								</td>
							</tr> 
							 <input type="hidden" name='edit_invoice_id' class="form-control" value="<?php echo $invoice_id;?>" />	
						  <input type="hidden" name='supp_id' class="form-control" value="<?php echo $supplier_id;?>" />
							<tr>
								<td>Select Supplier</td><td >:</td>
									<td>
										<select name="supplier_id" id="supplier_id" class="select2me form-control input-large select_customer">
											<option value="">----------------Choose Supplier-------------</option>
												<?php	
														$customer_data=mysql_query("select * from `supplier` ");
																
														while($row=mysql_fetch_array($customer_data))
														{?>		
								<option value="<?php echo $row['id'] ;?>"
								<?php if ($supplier_data['supplier_name']==$row['supplier_name']){ echo "selected" ;}?> >
								<?php echo $row['supplier_name']; ?>
															</option>
												<?php 	}?>
										</select> 
									</td>
									<td >Invoice Type</td><td >:</td>
							<td><br>
								<?php if ($invoice_data['flag']=='1')
								{
								?>
								<div class="form-control input-medium form-group">	
									<div class="radio-list">
										<label class="radio-inline">
											<input type="radio" name="radio1"  value="1" checked>Cash</label>
										<label class="radio-inline">
											<input type="radio" name="radio1"  value="2" >Credit</label>
									</div>
								</div>
								<?php }else { ?>
								<div class="form-control input-medium form-group">	
									<div class="radio-list">
										<label class="radio-inline">
											<input type="radio" name="radio1"  value="1" >Cash</label>
										<label class="radio-inline">
											<input type="radio" name="radio1"  value="2" checked>Credit</label>
									</div>
								</div>
								<?php }?>
							</td>
							</tr>
						</table>
							<div id="newtable">	
								<table class="table">	
									<tr>
										<td>Company Name</td><td>:</td>
										<td>
											<input class="form-control input-large company_name" placeholder="Enter Company Name"  name="company_name" autocomplete="off" type="text" value="<?php echo $company_data['name'];?>">
										</td>
										<td>GST No</td><td>:</td>
										<td>
											<input class="form-control company_gst" placeholder="Enter GST No"  name="company_gst" autocomplete="off" type="text" value="<?php echo $company_data['gst_no'];?>">
										</td>
									</tr>
									<tr>
										<td>Company Phone</td><td>:</td>
										<td>
											<input class="form-control input-large company_mobile" placeholder="Enter Phone No"  name="company_phone" autocomplete="off" type="text" value="<?php echo $company_data['phone_no'];?>">
										</td>
										<td>Address</td><td>:</td>
										<td>
											<input class="form-control company_address" placeholder="Enter Address"  name="company_address" autocomplete="off" type="text" value="<?php echo $company_data['address'];?>">
										</td>
									</tr>		
									<tr>
									<td>Supplier Name</td><td>:</td>
										<td>
											<input class="form-control input-large customer_name" placeholder="Enter Customer Name"  name="name" autocomplete="off" type="text" value="<?php echo $supplier_data['supplier_name'];?>" required>
										</td>
									<td>State</td><td>:</td>
										<td>
											<select name="state_id" id="state_id" class="select2me form-control input-large select_state">
												<option value="<?php echo $supplier_data['state'];?>"><?php echo $supplier_data['state'];?></option>
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
										<select name="city_id" id="city_id" class="select2me form-control input-large select_city">
											<option value="<?php echo $supplier_data['city'];?>"><?php echo $supplier_data['city'];?></option>
										</select>
									</td>
									<td>Mobile No</td><td>:</td>
										<td>
											<input class="form-control input-large customer_mobile" placeholder="Enter Contact No"  name="contact_no" autocomplete="off" type="text" value="<?php echo $supplier_data['contact_no'];?>">
										</td>
							</tr>
							<tr>
								<td>Pan No</td><td>:</td>
								<td>
									<input class="form-control input-large customer_pan" placeholder="Enter Pan No"  name="pan_no" autocomplete="off" type="text" value="<?php echo $supplier_data['pan_no'];?>">
								</td>
								<td>Aadhaar No</td><td>:</td>
								<td>
									<input class="form-control input-large customer_aadhaar" placeholder="Enter Aadhaar No"  name="Aadhaar_no" autocomplete="off" type="text" value="<?php echo $supplier_data['Aadhaar_no'];?>">
								</td>
							</tr>
							<tr>
								<td>Address</td><td>:</td>
								<td>
									<input class="form-control input-large customer_address" placeholder="Enter Address"  name="address" autocomplete="off" type="text" value="<?php echo $supplier_data['address'];?>"> 
								</td>
								<td>Invoice date</td><td>:</td>
								<td>
									<input class="form-control form-control-inline input-large date-picker date" placeholder="dd-mm-yyyy"  data-date-format="dd-mm-yyyy" size="16" autocomplete="off" type="text" name="date"value="<?php echo $edit_date;?>"> 
								</td>
							</tr>
					</table>
			</div>
					<table class="table" id="main_table1">
						<thead>
							 <tr style="background-color:#DCD9D8;">
								 <th style="border:1px;border-style:solid;width:10%;">Sr.No</th>
								 <th style="border:1px;border-style:solid;white-space: nowrap;width:10%;">ITEM NAME</th>
								 <th style="border:1px;border-style:solid;white-space: nowrap;width:10%;">ITEM CODE</th>
								 <th style="border:1px;border-style:solid;width:10%;">QTY</th>
								 <th style="border:1px;border-style:solid;width:10%;">ACTUAL PRICE</th>
								 <th style="border:1px;border-style:solid;white-space: nowrap;width:10%;">TAX PER (%)</th>
								 <th style="border:1px;border-style:solid;white-space: nowrap;width:10%;">FINAL PRICE</th>
								 <th style="border:1px;border-style:solid;white-space: nowrap;width:10%;">TOTAL AMOUNT</th>
								 <th style="border:1px;border-style:solid;white-space: nowrap;width:10%;">TAX AMOUNT</th>
								 <th colspan="2" style="border:1px;border-style:solid;white-space: nowrap;width:10%;"> *</th>
								
							</tr>
						</thead>
					<tbody id="main_tbody1"> 
					<?php
					$i=0;
		$invoice_sales=mysql_query("select * from `purchase_invoice_details` where `purchase_invoice_id`='$invoice_id'");
		 while($sales_data=mysql_fetch_array($invoice_sales))
		 {
			 $i++;
			 $item_id=$sales_data['item_id'];
			 $s=mysql_query("select `item_code` from `master_items` where `id`='$item_id'");
			 $f=mysql_fetch_array($s);
			 $it_code=$f['item_code'];
							?>
		  
							<tr class="main_tr1" style="border:1px;border-style:solid;">
								<td style="border:1px;border-style:solid;"><?php echo $i;?></td>
								<td style="border:1px;border-style:solid;width:20%;">
									<select name="item_id[]" id="item_id" class=" select2me form-control input-medium">
											<?php
												$item_data=mysql_query("select `id`,`item_name`,`item_code`,`sale_rate` from `master_items` ");
												while($row=mysql_fetch_array($item_data))	
												{
													$code=$row['item_code'];
													$price=$row['sale_rate'];
													?>		
														<option value="<?php echo $row['id'] ;?>" price="<?php echo $price; ?>" cd="<?php echo $code; ?>" <?php if ($item_id==$row['id']){ echo "selected";}?>><?php echo $row['item_name'];?></option>
											<?php }?>
									</select> 
							</td>
							
							<td style="border:1px;border-style:solid;">
								<input class="form-control icode" placeholder="Item Code" required name="item_code[]" autocomplete="off" type="text" value="<?php echo $it_code;?>">
							</td>
							<td style="border:1px;border-style:solid;">
								<input class="form-control qty " placeholder="Item Qty" required name="item_qty[]" autocomplete="off" type="text" value="<?php echo $sales_data['qty'];?>">
							</td>
							<td style="border:1px;border-style:solid;width:10%;">
								<input class="form-control actual_rate " placeholder="Actual Price" required name="actual_rate[]" autocomplete="off" type="text" value="<?php echo $sales_data['actual_price'];?>">
							</td>
							<td style="border:1px;border-style:solid;width:10%;">
								<input class="form-control item_tax " placeholder="Item Tax" required name="item_tax[]" autocomplete="off" type="text" value="<?php echo $sales_data['item_tax'];?>">
							</td>
							<td style="border:1px;border-style:solid;width:10%;">
								<input class="form-control final_rate " placeholder="Final Price" required name="final_rate[]" autocomplete="off" type="text" value="<?php echo $sales_data['final_price'];?>">
							</td>
							<td style="border:1px;border-style:solid;width:10%;">
								<input class="form-control row_amount " placeholder="Amount" required name="row_amount[]" autocomplete="off" type="text" value="<?php echo $sales_data['row_total_amount'];?>">
							</td>
							<td colspan="2" style="border:1px;border-style:solid;width:10%;">
								<input class="form-control row_tax_amount " placeholder="Tax Amount" required name="row_tax_amount[]" autocomplete="off" type="text" value="<?php echo $sales_data['row_total_tax'];?>">
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
					 
		 <?php }?>
					</tbody>
					<tfoot>
					<tr style="border:1px;border-style:solid;" id="subtotal_row">
							<td style="border:1px;border-style:solid;text-align:right;" colspan="3">Subtotal</td>
							<td style="border:1px;border-style:solid;"><input class="form-control total_qty" placeholder="Total Qty" required name="total_qty" autocomplete="off" type="text" value="<?php echo $invoice_data['total_qty'];?>"></td>
							<td style="border:1px;border-style:solid;"><input class="form-control total_rate" placeholder="Total rate" required name="total_actual_price" autocomplete="off" type="text" value="<?php echo $invoice_data['total_actual_price'];?>"></td>
							<td colspan="1" style="border:1px;border-style:solid;"><input class="form-control total_item_tax" placeholder="Total Amount" required name="total_item_tax" autocomplete="off" type="text" value="<?php echo $invoice_data['total_item_tax'];?>"></td>
							<td colspan="1" style="border:1px;border-style:solid;"><input class="form-control tota_final_price" placeholder="Total Amount" required name="tota_final_price" autocomplete="off" type="text" value="<?php echo $invoice_data['total_final_price'];?>"></td>
							<td colspan="1" style="border:1px;border-style:solid;"><input class="form-control total_amount" placeholder="Total Amount" required name="total_actual_amount" autocomplete="off" type="text" value="<?php echo $invoice_data['total_actual_amount'];?>"></td>
							<td colspan="2" style="border:1px;border-style:solid;"><input class="form-control final_tax_amount" placeholder="Total Tax Amt" required name="final_tax_amount" autocomplete="off" type="text" value="<?php echo $invoice_data['total_tax_amount'];?>"></td>
							<td style="border:1px;border-style:solid;"></td>
						</tr>
						<tr style="border:1px;border-style:solid;">
							<td style="border:1px;border-style:solid;text-align:right;" colspan="4">Discount</td>
							
							<td style="border:1px;border-style:solid;" colspan="2">
								<?php if ($invoice_data['discount_type']=='1')
								{
									
								?>
								<div class="form-group">
								<div class="radio-list">
								<label class="radio-inline">
								<input type="radio" name="r1" class="dis_per" id="dis_id" value="1" checked> %</label>
								<label class="radio-inline">
								<input type="radio" name="r1" class="dis_rupee"id="dis_id" value="2">&#8377; </label>
								<label class="radio-inline"><?php } else {?>
								<div class="form-group">
								<div class="radio-list">
								<label class="radio-inline">
								<input type="radio" name="r1" class="dis_per" id="dis_id" value="1" > %</label>
								<label class="radio-inline">
								<input type="radio" name="r1" class="dis_rupee"id="dis_id" value="2"checked>&#8377; </label>
								<label class="radio-inline">
								<?php }?>
								</div>
								</div>
							</td>
							<td style="border:1px;border-style:solid;">
								<input class="form-control dis_amount" placeholder="Enter Value" required name="dis_amount" autocomplete="off" type="text" value="<?php echo $invoice_data['discount_amount'];?>">									
							</td>
							<td colspan="1" style="border:1px;border-style:solid;">
								<input class="form-control taxable_value" placeholder="Total Amount" required name="total_after_discount" autocomplete="off" type="text" value="<?php echo $invoice_data['amount_after_discount'];?>">
							</td>
							<td colspan="2" style="border:1px;border-style:solid;">
								<input class="form-control final_tax_amount" placeholder="Total Tax Amt" required name="" autocomplete="off" type="text" value="<?php echo $invoice_data['total_tax_amount'];?>">								
							</td>
						<td style="border:1px;border-style:solid;"></td>
						</tr>
						<tr style="border:1px;border-style:solid;">
							<td style="border:1px;border-style:solid;text-align:right;" colspan="7">
								Grand Total
							</td>
							<td style="border:1px;border-style:solid;text-align:right;" colspan="3">
								<input  class="form-control grand_total" placeholder="Grand Total" required name="grand_total" autocomplete="off" type="text" value="<?php echo $invoice_data['grand_total'];?>">
							</td>
							<td style="border:1px;border-style:solid;"></td>
						</tr>
						<tr style="border:1px;border-style:solid;">
							<td style="border:1px;border-style:solid;text-align:right;" colspan="7">
								 Cash Deposit
							</td>
							<td style="border:1px;border-style:solid;text-align:right;" colspan="2">
								<input  class="form-control cash_amount " placeholder="Cash Amount" required name="cash_amount" autocomplete="off" type="text" value="<?php echo $invoice_data['cash_amount'];?>">
							</td>
							<td colspan="2" style="border:1px;border-style:solid;"></td>
						</tr>
						<tr style="border:1px;border-style:solid;">
							<td style="border:1px;border-style:solid;text-align:right;" colspan="7">
								 Remaining Amount
							</td>
							<td style="border:1px;border-style:solid;text-align:right;" colspan="2">
								<input  class="form-control Remaining_amount" placeholder="Due Amount" required name="Remaining_amount" autocomplete="off" type="text" value="<?php echo $invoice_data['due_amount'];?>">
							</td>
							<td colspan="2" style="border:1px;border-style:solid;"></td>
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
								<td style="border:1px;border-style:solid;width:10%;">1 </td>
								<td style="border:1px;border-style:solid;width:10%;">
									<select name="item_id[]" id="item_id" class=" form-control input-medium">
										<option value="">----------Choose Item ----------</option>
											<?php
												$item_data=mysql_query("select `id`,`item_name`,`item_code`,`purchase_rate` from master_items ");
												while($row=mysql_fetch_array($item_data))	
												{
													$code=$row['item_code'];
													$price=$row['purchase_rate'];
													?>		
														<option value="<?php echo $row['id'] ;?>" price="<?php echo $price; ?>" cd="<?php echo $code; ?>"  ><?php echo $row['item_name']; ?></option>
													<?php }?>
									</select> 
							</td>
							<td style="border:1px;border-style:solid;width:10%;">
								<input class="form-control icode" placeholder="Item Code" required name="item_code[]" autocomplete="off" type="text" value="">
							</td>
							<td style="border:1px;border-style:solid;width:10%;">
								<input class="form-control qty " placeholder="Item Qty" required name="item_qty[]" autocomplete="off" type="text" value="">
							</td>
							<td style="border:1px;border-style:solid;width:10%;">
								<input class="form-control actual_rate " placeholder="Actual Price" required name="actual_rate[]" autocomplete="off" type="text" value="">
							</td>
							<td style="border:1px;border-style:solid;width:10%;">
								<input class="form-control item_tax " placeholder="Item Tax" required name="item_tax[]" autocomplete="off" type="text" value="">
							</td>
							<td style="border:1px;border-style:solid;width:10%;">
								<input class="form-control final_rate " placeholder="Final Price" required name="final_rate[]" autocomplete="off" type="text" value="">
							</td>
							<td style="border:1px;border-style:solid;width:10%;">
								<input class="form-control row_amount " placeholder="Amount" required name="row_amount[]" autocomplete="off" type="text" value="">
							</td>
							<td colspan="2" style="border:1px;border-style:solid;width:10%;">
								<input class="form-control row_tax_amount " placeholder="Tax Amount" required name="row_tax_amount[]" autocomplete="off" type="text" value="">
							</td>
							<td style="border:1px;border-style:solid;width:10%;">
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
		$('.date-picker').datepicker();
		$('.date-picker').datepicker().on('changeDate', function(){
		$(this).blur();
		$(this).datepicker('hide');
		}); 
		$("#state_id").live('change', function ()
		{
			var state=$(this, 'option:selected').val();	
			$.ajax({
				url: "state_city.php?reg_no="+state,
				}).done(function(response) {
					$("#newcity").html(response);
				});
		});
		$("#supplier_id").live('change', function () 
		{
			var customer_id=$(this, 'option:selected').val();
			
			var old=$("#old").html();
				if(customer_id>0)
					{
						$.ajax({
							url: "supplier_data.php?reg_no="+customer_id,
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
						$('.state_blank').select2();
					}  
		});
		//add_row();
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
		
		 $("#item_id").live('change', function () 
		{
			
			$(".icode").attr( 'readonly', 'readonly' );
			$(".rate").attr( 'readonly', 'readonly' );
			$(".row_amount").attr( 'readonly', 'readonly' );
				var itm_id=$(this, 'option:selected').val();
				var prc=($('option:selected', this).attr('price'));		 
					if(!prc){ prc=0; }
					var cd=($('option:selected', this).attr('cd'));
					if(!cd){ cd=0; }
					var code=$(this, 'option:selected').attr("cd");
						$(this).closest("tr").find('td:nth-child(7) input').val(prc);
						$(this).closest("tr").find('td:nth-child(4) input').val(1);
						$(this).closest("tr").find('td:nth-child(3) input').val(cd);
						calculate_total();
		
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
		$(document).on('keyup','.qty,.dis_amount,.item_tax,.cash_amount',function()
		{
			calculate_total();
		});
		 $(document).on('click','#dis_id',function()
		{
			calculate_total();
		}); 

	function calculate_total()
	{ 
		var i=0;
		var total_qty=0;
		var total_rate=0;
		var total_actual_rate=0;
		var total_tax_per=0;
		var total_final_price=0;
		var total_actual_amount=0;
		var row_total_tax_amount=0;
		var total_item_tax=0;
		var tota_final_price=0;
		var final_tax_amount=0;
		var grand_total=0;		
		$("#main_table1 tbody tr.main_tr1").each(function()
		{
			var qty=0;var rate=0; var actual_amount=0;var actual_rate=0;
			var actual_price=0;var tax_per=0;var total_tax_amount=0;var tax_amount=0;
			qty=parseFloat($(this).find("td:nth-child(4) input.qty").val());
			rate=parseFloat($(this).find("td:nth-child(7) input.final_rate").val());
			tax_per=parseFloat($(this).find("td:nth-child(6) input.item_tax").val());
				if(isNaN(rate))
				{
					rate =0;
				}
				if(isNaN(qty))
				{
					qty =0;
				}
				if(isNaN(actual_rate))
				{
					actual_rate =0;
				}
				if(isNaN(actual_amount))
				{
					actual_amount =0;
				}
				if(isNaN(total_tax_amount))
				{
					total_tax_amount =0;
				}
		 	 tax_amount=(tax_per*rate)/100;
			 total_tax_amount=qty*tax_amount;
			 $(this).find("td:nth-child(9) input.row_tax_amount").val(total_tax_amount.toFixed(2)); 
			 actual_rate=rate-tax_amount;
			$(this).find("td:nth-child(5) input.actual_rate").val(actual_rate.toFixed(2));
			actual_price=parseFloat($(this).find("td:nth-child(5) input.actual_rate").val());
			actual_amount=qty*actual_price
			$(this).find("td:nth-child(8) input.row_amount").val(actual_amount.toFixed(2));	
			total_qty=total_qty+qty;
			total_actual_rate=total_actual_rate+actual_rate;
			total_tax_per=total_tax_per+tax_per;
			total_final_price=total_final_price+rate;
			total_actual_amount=total_actual_amount+actual_amount;
			row_total_tax_amount=row_total_tax_amount+total_tax_amount;
			});
		$(".total_qty").attr( 'readonly', 'readonly' );
		$(".total_rate").attr( 'readonly', 'readonly' );
		$(".total_item_tax").attr( 'readonly', 'readonly' );
		$(".tota_final_price").attr( 'readonly', 'readonly' );
		$(".total_amount").attr( 'readonly', 'readonly' );
		$(".final_tax_amount").attr( 'readonly', 'readonly' );
		$(".taxable_value").attr( 'readonly', 'readonly' );
		$("tfoot tr input.total_qty").val(total_qty.toFixed(2));
		$("tfoot tr input.total_rate").val(total_actual_rate.toFixed(2));
		$("tfoot tr input.total_item_tax").val(total_tax_per.toFixed(2));
		$("tfoot tr input.tota_final_price").val(total_final_price.toFixed(2));
		$("tfoot tr input.total_amount").val(total_actual_amount.toFixed(2));
		$("tfoot tr input.final_tax_amount").val(row_total_tax_amount.toFixed(2));
		$("tfoot tr input.taxable_value").val(total_actual_amount.toFixed(2));
			//--- discount ---//
		var dis_id=$("input[name='r1']:checked").val();		
		var dis_amount=parseFloat($("tfoot tr input.dis_amount").val());
		if(isNaN(dis_amount))
				{
					dis_amount =0;
				}
			if(dis_id==1)
			{
				var dis_value=(dis_amount*total_actual_amount)/100;
				var temp=total_actual_amount-dis_value;
				$("tfoot tr input.taxable_value").val(temp.toFixed(2));
				
			}else{
				var temp=total_actual_amount-dis_amount;
				$("tfoot tr input.taxable_value").val(temp.toFixed(2));
			}
 		var mainvalue = parseFloat($('.taxable_value').val());
		var GrandTotal = row_total_tax_amount+mainvalue;
 		$(".grand_total").val(GrandTotal.toFixed(2));	
		$(".grand_total").attr( 'readonly', 'readonly' );
		$(".actual_rate").attr( 'readonly', 'readonly' );
		$(".final_rate").attr( 'readonly', 'readonly' );
		$(".row_tax_amount").attr( 'readonly', 'readonly');
		//----Cash and Due---//
		var lastvalue = parseFloat($('.grand_total').val());
		var cash_amount = parseFloat($('.cash_amount').val());
		var due_amount=lastvalue-cash_amount;
 		$(".Remaining_amount").val(due_amount.toFixed(2));	

	}
	});
    </script>
<?php scripts();?>
<div id="old" style="display:none;">
	<table class="table">	
		<tr>
			<td>Company Name</td><td>:</td>
				<td>
					<input class="form-control input-large  " placeholder="Enter Company Name"  name="company_name" autocomplete="off" type="text" value="" >
				</td>
			<td>GST No</td><td>:</td>
				<td>
					<input class="form-control " placeholder="Enter GST No"  name="company_gst" autocomplete="off" type="text" value="">
				</td>
		</tr>
		<tr>
			<td>Company Phone</td><td>:</td>
				<td>
					<input class="form-control input-large " placeholder="Enter Phone No"  name="company_phone" autocomplete="off" type="text" value="">
				</td>
			<td>Address</td><td>:</td>
				<td>
					<input class="form-control " placeholder="Enter Address"  name="company_address" autocomplete="off" type="text" value="">
				</td>
		</tr>		
		<tr>
		    <td>Supplier Name</td><td>:</td>
				<td>
					<input class="form-control input-large " placeholder="Enter Customer Name" required name="name" autocomplete="off" type="text" value=""> 
				</td>
			<td>State</td><td>:</td>
				<td>
					<select name="state_id" id="state_id" class="form-control input-large state_blank1" placeholder="----------Choose State ----------">
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
						<select name="city_id" id="city_id" class="select2me form-control input-large select_city1" placeholder="----------Choose City ----------">
							<option value=""></option>
						</select>
					</td>
				<td>Mobile No</td><td>:</td>
					<td>
							<input class="form-control input-large " placeholder="Enter Contact No"  name="contact_no" autocomplete="off" type="text" value="">
					</td>
			</tr>
			<tr>
				<td>Pan No</td><td>:</td>
					<td>
						<input class="form-control input-large" placeholder="Enter Pan No"  name="pan_no" autocomplete="off" type="text" value=""> 
					</td>
				<td>Aadhaar No</td><td>:</td>
					<td>
						<input class="form-control input-large " placeholder="Enter Aadhaar No"  name="Aadhaar_no" autocomplete="off" type="text" value="">
					</td>
			</tr>
			<tr>
				<td>Address</td><td>:</td>
					<td>
						<input class="form-control input-large " placeholder="Enter Address"  name="address" autocomplete="off" type="text" value=""> 
					</td>
				<td>Invoice date</td><td>:</td>
					<td>
						<input class="form-control form-control-inline input-large date-picker date" placeholder="dd-mm-yyyy"  data-date-format="dd-mm-yyyy" size="16" autocomplete="off" type="text" name="date"> 
					</td>
			</tr>
	</table>
</div>
	

