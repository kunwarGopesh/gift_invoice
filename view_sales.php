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
			<div class="portlet-body form">
			  <?php 
			  $invoice_id=$_GET['invoice_id'];
			  $invoices=mysql_query("select * from sales_invoice where `id`='$invoice_id' ");
			  $invoice_data=mysql_fetch_array($invoices);
			  $customer_id=$invoice_data['customer_id'];
			  $company=mysql_query("select * from companies where `customer_id`='$customer_id'");
			  $customer=mysql_query("select * from customer where `id`='$customer_id'");
				$row1=mysql_fetch_array($customer);
				$row=mysql_fetch_array($company);
				?>
				
				<table  width="100%">
				<tr>
				<td  style="border:1px;border-style:solid;" width="50%">
					<table class="table" width="100%">
					<tr>
					<th style="background-color:#DCD9D8;text-align:center;font-size:18px;">Sales Invoice</th>
					</tr>
				<tr>	
				<td>
				<span style="height:30px;width:350px;font-size:15px;">To,<br>
				<?php echo $row['name'];?><br>
				<?php echo $row['address'];?><br>
				 <p>Phone No : <?php echo $row['phone_no'];?></p>
				 <p>GST Number :<?php echo $row['gst_no'];?></p>
				 </span>
				 </td>
				 </tr></table>
				 
				 <td style="border:1px;border-style:solid;" width="50%">
				 <table width="100%">
					<tr>
					<td width="30%"><img src="\gift_invoice\img\logo123.jpg" height="100px" width="150px"/></td>
					<td width="70%"><h4 class="box-title">PHP Poets , Udaipur</h4></td>
					</tr>
					<tr>
					<td width="30%"><h4 class="box-title"></h4></td>
					<td width="70%"><h4 class="box-title">
							(An ISO 9001:2008 Certified Company)
							</h4>
					</td>
				 </tr>
				 </table>
				 </td>
				 </tr>
				 </table>
			<table style="border:1px;border-style:solid;width:100%;height:30%;">
			<tr>
		    <td >Customer Name</td><td >:</td>
			 <td ><?php echo $row1['customer_name'];?></td>
			</td>
		    <td >Customer Phone</td><td>:</td>
		    <td ><?php echo $row1['contact_no'];?> </td>
			</tr>
			<tr>
		    <td>City</td><td>:</td>
		    <td><?php echo $row1['city'];?> </td>
		    <td>State</td><td>:</td>
		    <td><?php echo $row1['state'];?> </td>
			</tr>
			<tr>
		    <td>Pan No</td><td>:</td>
		    <td><?php echo $row1['pan_no'];?> </td>
		    <td>Aadhaar No</td><td>:</td>
		    <td><?php echo $row1['Aadhaar_no'];?></td>
			</tr>
			<tr>
		    <td>Address</td><td>:</td>
		    <td><?php echo $row1['address'];?> </td>
		    <td>Invoice date</td><td>:</td>
		     <td><?php echo $invoice_data['invoice_date'];?> </td>
			 </tr>
			 </table>
	
			<table class="table" >
				<thead>
				 <tr style="background-color:#DCD9D8;">
					 <th style="border:1px;border-style:solid;">SL.NO</th>
					 <th colspan="2" style="border:1px;border-style:solid;white-space: nowrap;">ITEM NAME</th>
					 <th style="border:1px;border-style:solid;white-space: nowrap;width:12%;">ITEM CODE</th>
					 <th style="border:1px;border-style:solid;">QTY</th>
					 <th style="border:1px;border-style:solid;">RATE  (&#8377;)</th>
					 <th style="border:1px;border-style:solid;white-space: nowrap;">AMOUNT  (&#8377;)</th>
					 
					 </tr>
				</thead>
				<tbody > 
				<?php 
					$j=0;
					$items=mysql_query("select * from sales_invoice_details where `sales_invoice_id`='$invoice_id'");
					 while($item_data=mysql_fetch_array($items))
							{
								$j++;
								$item_id=$item_data['item_id'];	
								$cat=mysql_query("select * from `master_items` where `id`='$item_id'");
								$cat_data=mysql_fetch_array($cat);
											
							?>
				<tr class="main_tr1" style="border:1px;border-style:solid;">
				<td style="border:1px;border-style:solid;"><?php echo $j;?></td>
				<td colspan="2" style="border:1px;border-style:solid;width:20%;"><?php echo $cat_data['item_name']; ?></td>
				<td style="border:1px;border-style:solid;width:20%;"><?php echo $cat_data['item_code']; ?></td>
				<td style="border:1px;border-style:solid;width:20%;"><?php echo $item_data['qty']; ?> </td>
				<td style="border:1px;border-style:solid;width:20%;"><?php echo number_format($item_data['item_price'],2); ?> </td>
				<td style="border:1px;border-style:solid;width:20%;"><?php echo number_format($item_data['row_total_amount'],2); ?> </td>
				</tr> 
				<?php  }?>
			
				<tr style="border:1px;border-style:solid;" >
					<td style="border:1px;border-style:solid;text-align:right;" colspan="4">Subtotal</td>
					<td style="border:1px;border-style:solid;width:20%;"><?php echo $invoice_data['total_qty']; ?> </td>
					<td style="border:1px;border-style:solid;width:20%;"><?php echo $invoice_data['total_rate']; ?></td>
					<td style="border:1px;border-style:solid;width:20%;"><?php echo number_format($invoice_data['total_amount_dis'],2); ?> </td>
					
				</tr>
				<tr style="border:1px;border-style:solid;" >
					<td style="border:1px;border-style:solid;text-align:right;" colspan="4">Discount</td>
					<td colspan="2" style="border:1px;border-style:solid;width:20%;text-align:center;">
					<?php
						$dis=$invoice_data['discount_type'];
						if($dis==1)
						{
							echo $invoice_data['discount_amount']."%";
						}
						else
						{
							echo number_format($invoice_data['discount_amount'],2)."&#8377;";
						}
					?> 
					</td>
					<td style="border:1px;border-style:solid;width:20%;"><?php echo number_format($invoice_data['amount_after_discount'],2); ?> </td>
					
				</tr>
				<?php
				$Z=$invoice_data['amount_after_discount'];	
				$invoice_tax=mysql_query("select * from `invoice_taxations` where `invoice_id`='$invoice_id' && `flag`='2'");
				while($tax_data=mysql_fetch_array($invoice_tax))
				{
					$t_id=$tax_data['taxation_id'];
				  $per=$tax_data['percentage'];
				  $amt=$tax_data['amount'];

				$taxation_name=mysql_query("select `name` from `taxations` where `id`='$t_id'");
						
				while($row=mysql_fetch_array($taxation_name))
				{						
					$name=$row['name'];	
					?>	
				<tr style="border:1px;border-style:solid;">
					<td style="border:1px;border-style:solid;text-align:right;" colspan="4">
					<?php echo $name;?>			
					</td>
					<td style="border:1px;border-style:solid;text-align:right;">
							<?php echo $per; ?>%
					</td>
					<td style="border:1px;border-style:solid;">
							<?php echo number_format($amt,2); ?>	
					</td>
					<td style="border:1px;border-style:solid;"><?php 
					$Z+=$amt;
					echo number_format($Z,2); ?></td>
				</tr>
				<?php
				}}
						?>	
				<tr style="border:1px;border-style:solid;">
					<td  style="border:1px;border-style:solid;text-align:right;" colspan="4"> Grand Total </td>
					<td colspan="2" style="border:1px;border-style:solid;width:20%;text-align:center;border-right-color:white;"> </td>
					<td style="border:1px;border-style:solid;width:20%;">
					<?php echo number_format(round($invoice_data['grand_total'])); ?> </td>
					
				</tr>
				
				<tr style="border:1px;border-style:solid;" rowspan="2">
					<td colspan="3">
					<b>TERMS & CONDITIONS:</b><br>                                                
					* Interest @ 18% PA will be charged if payment not
					recevied within 15 days from the date of Invoice.<br>
					
					* Subject to Udaipur Jurisdiction Only
					* E & O E.

					</td>
					<td>
					
					</td>
					<td colspan="3" style="border:1px;border-style:solid;border-left-color:white;">
					For PHP Poets  Pvt. Ltd.
					</td>
					
				</tr>
				<tr style="border:1px;border-style:solid;">
					<td colspan="3" style="border:1px;border-style:solid;border-right-color:white;">
					<b>Customer's Signature </b><br>                                                
				
					</td>
					<td style="border:1px;border-style:solid;text-align:right;" colspan="5">
					This is computer print out and do not require a signature
					</td>
				</tr>
				<tr >
					<td colspan="7" style="border:1px;border-style:solid;" >
						<span style="height:50px;width:350px;font-size:15px;">
						Mavli ,Udaipur<br>
						Phone : 91 - 294 - 2484181, 2981222, 6450333,
						 </span>
					</td>
				</tr>
				</tbody>
		</table>
			</div>
		</div></div>
		</div>
		</div>
</body>
<?php footer();?>
<?php scripts();?>
</html>		  