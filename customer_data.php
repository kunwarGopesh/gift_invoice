<?php 
include("database.php");
$c_id=$_GET['reg_no'];
$set=mysql_query("select * from `customer` where `id`='$c_id'");
$fet=mysql_fetch_array($set);
$name=$fet['customer_name'];
$address=$fet['address'];
$city=$fet['city'];
$state=$fet['state'];
$mobile=$fet['contact_no'];
$gst_no=$fet['gst_no'];
$pan_no=$fet['pan_no'];
$Aadhaar_no=$fet['Aadhaar_no'];
?>
<table class="table">		
			<tr>
		    <td> Name</td><td>:</td>
		    <td><input class="form-control input-large customer_name" placeholder="Enter Customer Name" required name="name" autocomplete="off" type="text" value="<?php echo $name; ?>"> </td>
			<td>City</td><td>:</td>
		    <td><input class="form-control input-large customer_city" placeholder="Enter City" required name="city" autocomplete="off" type="text" value="<?php echo $city; ?>"> </td>
			</tr>
			<tr>
		    <td>State</td><td>:</td>
		    <td><input class="form-control input-large customer_state" placeholder="Enter state" required name="state" autocomplete="off" type="text" value="<?php echo $state; ?>"> </td>
		    <td>GST No</td><td>:</td>
		    <td><input class="form-control input-large customer_gst" placeholder="Enter GST No" required name="gst_no" autocomplete="off" type="text" value="<?php echo $gst_no; ?>"> </td>
			</tr>
			<tr>
		    <td>Pan No</td><td>:</td>
		    <td><input class="form-control input-large customer_pan" placeholder="Enter Pan No" required name="pan_no" autocomplete="off" type="text" value="<?php echo $pan_no; ?>"> </td>
		    <td>Aadhaar No</td><td>:</td>
		    <td><input class="form-control input-large customer_aadhaar" placeholder="Enter Aadhaar No" required name="Aadhar_no" autocomplete="off" type="text" value="<?php echo $Aadhaar_no; ?>"></td>
			</tr>
			<tr>
			 <td>Address</td><td>:</td>
		    <td><input class="form-control input-large customer_address" placeholder="Enter Address" required name="address" autocomplete="off" type="text" value="<?php echo $address; ?>"> </td>
			 <td>Invoice date</td><td>:</td>
		    <td ><input class="form-control form-control-inline input-large date-picker" placeholder="yyyy-mm-dd" required data-date-format="yyyy-mm-dd" size="16" autocomplete="off" type="text" name="date"> </td>
			</tr>
</table>
<script>
 			$('.date-picker').datepicker();
			$('.date-picker').datepicker().on('changeDate', function(){
			$(this).blur();
			$(this).datepicker('hide');
			}); 
</script>
