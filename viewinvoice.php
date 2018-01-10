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
				<td>
				<span style="height:30px;width:350px;">
				<h4 class="box-title">Place of Supply:</h4><br>
				<?php echo $row['address'];?><br>
				 <p><?php echo $row['phone_no'];?></p>
				 <p>GST Number :<?php echo $row['gst_no'];?></p>
				 </span></td>
				</tr> 
			<div id="chng">
			<tr>
		    <td>Select Customer</td><td>:</td>
		    <td colspan="4" >
			<select name="customer_id" id="customer_id" class="select2me form-control input-large select_customer">
								<option >----------Choose Customer ----------</option>
									<?php
									$customer_data=mysql_query("select * from customer ");
									
									while($row=mysql_fetch_array($customer_data))
									{?>		
											<option value="<?php echo $row['id'] ;?>"><?php echo $row['customer_name']; ?></option>
										<?php }?>
										</select> </td></tr>
			<tr>
		    <td>Customer Name</td><td>:</td>
		    <td><input class="form-control input-large customer_name" placeholder="Enter Customer Name" required name="cname" autocomplete="off" type="text" value=""> </td>
			<td>City</td><td>:</td>
		    <td><input class="form-control input-large customer_city" placeholder="Enter City" required name="city" autocomplete="off" type="text" value=""> </td>
			</tr>
			<tr>
		    <td>State</td><td>:</td>
		    <td><input class="form-control input-large customer_state" placeholder="Enter state" required name="state" autocomplete="off" type="text" value=""> </td>
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
		    <td>Invoice date</td><td>:</td>
		    <td ><input class="form-control form-control-inline input-medium date-picker" placeholder="yyyy-mm-dd" required data-date-format="yyyy-mm-dd" size="16" autocomplete="off" type="text" name="date"> </td>
			</tr>
			</div>
			<tr><td></td></tr>
			</table>
		<table class="table" id="main_table1">
		<thead>
		 <tr style="background-color:#DCD9D8;">
			 <th style="border:1px;border-style:solid;">SL.NO</th>
			 <th style="border:1px;border-style:solid;white-space: nowrap;">ITEM CATEGORY</th>
			 <th style="border:1px;border-style:solid;white-space: nowrap;">ITEM NAME</th>
			 <th style="border:1px;border-style:solid;white-space: nowrap;">ITEM CODE</th>
			 <th style="border:1px;border-style:solid;">QTY</th>
			 <th style="border:1px;border-style:solid;">RATE</th>
			 <th style="border:1px;border-style:solid;">AMOUNT</th>
			 <th style="border:1px;border-style:solid;">*</th>
			 </tr>
		</thead>
		<tbody id="main_tbody1"> 
		
		</tbody>
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
			<td style="border:1px;border-style:solid;"><input class="form-control " placeholder="Item Qty" required name="qty" autocomplete="off" type="text" value=""></td>
			<td style="border:1px;border-style:solid;"><input class="form-control " placeholder="Item Rate" required name="price" autocomplete="off" type="text" value=""></td>
			<td style="border:1px;border-style:solid;"><input class="form-control " placeholder="Amount" required name="tatal Amount" autocomplete="off" type="text" value=""></td>
			<td style="border:1px;border-style:solid;"><button type="button" class="btn btn-xs btn-default addrow"  href="#" role='button'><i class="fa fa-plus"></i></button><button type="button" class="btn btn-xs btn-default deleterow" href="#" role='button'><i class="fa fa-minus"></i></button></td>
			</tr>
			</table>
			</div>
		</div>
	</div>
</section>
<div id="old" style="display:none;">
<table class="table">
<tr>
		    <td>Select Customer</td><td>:</td>
		    <td colspan="4" >
			<select name="customer" class="select2me form-control input-large select_customer">
								<option value="0">----------Choose Customer ----------</option>
									<?php
									$customer_data=mysql_query("select * from customer ");
									
									while($row=mysql_fetch_array($customer_data))
									{?>		
											<option value="<?php echo $row['id'] ;?>"><?php echo $row['customer_name']; ?></option>
										<?php }?>
										</select> </td></tr>
			<tr>
		    <td>Customer Name</td><td>:</td>
		    <td><input class="form-control input-large customer_name" placeholder="Enter Customer Name" required name="cname" autocomplete="off" type="text" value=""> </td>
			<td>City</td><td>:</td>
		    <td><input class="form-control input-large customer_city" placeholder="Enter City" required name="city" autocomplete="off" type="text" value=""> </td>
			</tr>
			<tr>
		    <td>State</td><td>:</td>
		    <td><input class="form-control input-large customer_state" placeholder="Enter state" required name="state" autocomplete="off" type="text" value=""> </td>
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
		    <td>Invoice date</td><td>:</td>
		    <td ><input class="form-control form-control-inline input-medium date-picker" placeholder="yyyy-mm-dd" required data-date-format="yyyy-mm-dd" size="16" autocomplete="off" type="text" name="date"> </td>
			</tr>
			</table>
</div>
</body>
<?php footer(); ?>

<?php scripts();?>

</html>		  
<script>

</script>