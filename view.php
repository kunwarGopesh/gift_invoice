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
			<tr>
		    <td>Customer Name</td><td>:</td>
		    <td>
			<select name="customer" class="select2me form-control input-large ">
								<option >----------Choose Customer ----------</option>
									<?php
									$sql=mysql_query("select id,customer_name from customer ");
									
									while($row=mysql_fetch_array($sql))
									{?>		
											<option  value="<?php echo $row['id'] ;?>"><?php echo $row['customer_name']; ?></option>
										<?php }?>
										</select> </td>
		    <td>Customer Phone</td><td>:</td>
		    <td><?php echo $row1['contact_no'];?> </td>
			</tr>
			<tr>
		    <td>City</td><td>:</td>
		    <td><?php echo $row1['city'];?> </td>
		    <td>State</td><td>:</td>
		    <td><?php echo $row1['state'];?> </td>
			</tr>
			<tr>
		    <td>Address</td><td>:</td>
		    <td><?php echo $row1['address'];?> </td>
		    <td>GST No</td><td>:</td>
		    <td><?php echo $row1['gst_no'];?></td>
			</tr>
			<tr>
		    <td>Pan No</td><td>:</td>
		    <td><?php echo $row1['pan_no'];?> </td>
		    <td>Aadhaar No</td><td>:</td>
		    <td><?php echo $row1['Aadhaar_no'];?></td>
			</tr>
			<tr>
		    <td>Invoice date</td><td>:</td>
		    <td><input class="form-control form-control-inline input-medium date-picker" placeholder="yyyy-mm-dd" required data-date-format="yyyy-mm-dd" size="16" autocomplete="off" type="text" name="date"> </td>
		    <td>GST No</td><td>:</td>
		    <td><?php echo $row1['gst_no'];?></td>
			</tr>
			
			</table>
			</div>
		</div></div></section>
</body></html>		  