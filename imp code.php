<?php
include("index_layout.php");
include("database.php");
?>
<?php 
if(isset($_POST['sub']))
{
	$company_name=$_POST['company_name'];
	$company_gst=$_POST['company_gst'];
	$company_phone=$_POST['company_phone'];
	$company_address=$_POST['company_address'];
	$customer_name=$_POST['customer_name'];
	$city=$_POST['city'];
	$state=$_POST['state'];
	$pan_no=$_POST['pan_no'];
	$Aadhaar_no=$_POST['Aadhaar_no'];
	$address=$_POST['address'];
	$mobile=$_POST['contact_no'];
	mysql_query("insert into `customer` SET `customer_name`='$customer_name',`address`='$address',
		`city`='$city',`state`='$state',`contact_no`='$mobile',`pan_no`='$pan_no',`Aadhaar_no`='$Aadhaar_no'");
	mysql_query("insert into `companies` SET `name`='$company_name',`address`='$company_address',
		`phone_no`='$company_phone',`gst_no`='$company_gst'");
	echo '<script>window.location="view_customer.php"</script>';
}
  ?> 
<html>
<head>
<?php css();?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Master Customer</title>
</head>
<?php contant_start(); menu();  ?>
<body>
	<div class="page-content-wrapper">
		<div class="page-content">
			<div class="row">
				<div class="portlet box blue">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-gift"></i>Master Customer
						</div>
					</div>
						<div class="portlet-body form">
									<!-- BEGIN FORM-->
							<form  class="form-horizontal" id="form_sample_2"  role="form" method="post"> 
										<table class="table">
											<tr>
											<td>Choose Company</td><td >:</td>
											<td colspan="4">
											<select name="company_id" id="company_id" class="select2me form-control input-large select_company">
															<option value="">----------Choose Company ----------</option>
															<?php
															$company_data=mysql_query("select * from companies ");
															
															while($row=mysql_fetch_array($company_data))
															{?>		
												<option value="<?php echo $row['id'] ;?>"><?php echo $row['name']; ?></option>
												<?php }?>
											</select> 
										</td>
											</tr>
										</table>
										<div id="company_table">
										<table class="table">
										<tr>
										<td>Company Name</td><td>:</td>
										<td><input class="form-control input-large company_name" placeholder="Enter Company Name" required name="company_name" autocomplete="off" type="text" value=""> </td>
										<td>GST No</td><td>:</td>
										<td>
										<input class="form-control company_gst" placeholder="Enter GST No" required name="company_gst" autocomplete="off" type="text">
										</td>
										</tr>
										<tr>
										<td>Company Phone</td><td>:</td>
										<td><input class="form-control input-large company_mobile" placeholder="Enter Phone No" required name="company_phone" autocomplete="off" type="text" value=""> </td>
										<td>Address</td><td>:</td>
										<td>
										<input class="form-control company_address" placeholder="Enter Address" required name="company_address" autocomplete="off" type="text">
										</td>
										</tr>
										</table>
										</div>
										<table class="table">
										<tr>
										<td>Select Customer</td><td >:</td>
										<td colspan="4">
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
										</tr></table>
<div id="newtable">
<table class="table">		
<tr>
		    <td> Name</td><td>:</td>
		    <td><input class="form-control input-large customer_name" placeholder="Enter Customer Name" required name="name" autocomplete="off" type="text"  </td>
			</tr>
			<tr>
			<td>City</td><td>:</td>
		    <td><input class="form-control input-large customer_city" placeholder="Enter City" required name="city" autocomplete="off" type="text" > </td>
			<td>State</td><td>:</td>
			<td><input class="form-control input-large customer_state" placeholder="Enter state" required name="state" autocomplete="off" type="text" > </td>
		   </tr>
			<tr>
		    <td>Pan No</td><td>:</td>
		    <td><input class="form-control input-large customer_pan" placeholder="Enter Pan No" required name="pan_no" autocomplete="off" type="text" "> </td>
		    <td>Aadhaar No</td><td>:</td>
		    <td><input class="form-control input-large customer_aadhaar" placeholder="Enter Aadhaar No" required name="Aadhar_no" autocomplete="off" type="text" ></td>
			</tr>
			<tr>
			 <td>Address</td><td>:</td>
		    <td><input class="form-control input-large customer_address" placeholder="Enter Address" required name="address" autocomplete="off" type="text" > </td>
			<td>Mobile No</td><td>:</td>
		    <td><input class="form-control input-large customer_mobile" placeholder="Enter Mobile No" required name="contact_no" autocomplete="off" type="text" ></td>
			</tr>
</table>
</div>
					<table class="table">
							<tr><td colspan="8">
							<center>
							<input class="btn btn-primary"type="submit" name="submit" value="Submit"></td>
							</center>
							</td></tr>
					</table>
								
					</form>
				</div>
			</div>
          </div>
	</div>		  
</div>
</body>
<?php footer(); ?>
<script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script>
        $(document).ready(function() {    
         $("#customer_id").live('change', function () 
		 {
			
			 var customer_id=$(this, 'option:selected').val();
			 var old=$("#old").html();
				if(customer_id>0){
				$.ajax({
				url: "customer_data12.php?reg_no="+customer_id,
				}).done(function(response) {
					$("#newtable").html(response);
				});
				}else if((customer_id==0) || (customer_id==''))
				{
				$("#newtable").html(old);
				}				 
		});
			$("#company_id").live('change', function () 
			{
				var company_id=$(this, 'option:selected').val();
				var old1=$("#old1").html();
				if(company_id>0){
				$.ajax({
				url: "company_data.php?com_no="+company_id,
				}).done(function(response)
							{
					$("#company_table").html(response);
				});
				}else if((company_id==0) || (company_id==''))
				{
				$("#company_table").html(old1);
				}				 
			});
	 });
</script>
<?php scripts();?>

</html>
 <div id="old" style="display:none;">
 <table class="table">		
<tr>
		    <td> Name</td><td>:</td>
		    <td><input class="form-control input-large " placeholder="Enter Customer Name" required name="name" autocomplete="off" type="text"  </td>
			</tr>
			<tr>
			<td>City</td><td>:</td>
		    <td><input class="form-control input-large " placeholder="Enter City" required name="city" autocomplete="off" type="text" > </td>
			<td>State</td><td>:</td>
			<td><input class="form-control input-large " placeholder="Enter state" required name="state" autocomplete="off" type="text" > </td>
		   </tr>
			<tr>
		    <td>Pan No</td><td>:</td>
		    <td><input class="form-control input-large " placeholder="Enter Pan No" required name="pan_no" autocomplete="off" type="text"> </td>
		    <td>Aadhaar No</td><td>:</td>
		    <td><input class="form-control input-large " placeholder="Enter Aadhaar No" required name="Aadhar_no" autocomplete="off" type="text" ></td>
			</tr>
			<tr>
			 <td>Address</td><td>:</td>
		    <td><input class="form-control input-large " placeholder="Enter Address" required name="address" autocomplete="off" type="text" > </td>
			<td>Mobile No</td><td>:</td>
		    <td><input class="form-control input-large " placeholder="Enter Mobile No" required name="contact_no" autocomplete="off" type="text" ></td>
			</tr>
</table>
 </div>
 <div id="old1" style="display:none;">
										<table class="table">
										<tr>
										<td>Company Name</td><td>:</td>
										<td><input class="form-control input-large " placeholder="Enter Company Name" required name="name" autocomplete="off" type="text" value=""> </td>
										<td>GST No</td><td>:</td>
										<td>
										<input class="form-control" placeholder="Enter GST No" required name="gst_no" autocomplete="off" type="text">
										</td>
										</tr>
										<tr>
										<td>Company Phone</td><td>:</td>
										<td><input class="form-control input-large " placeholder="Enter Phone No" required name="com_phone" autocomplete="off" type="text" value=""> </td>
										<td>Address</td><td>:</td>
										<td>
										<input class="form-control" placeholder="Enter Address" required name="address" autocomplete="off" type="text">
										</td>
										</tr>
										</table>
</div>

