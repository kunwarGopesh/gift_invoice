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
$pan_no=$fet['pan_no'];
$Aadhaar_no=$fet['Aadhaar_no'];
$date=$fet['created_on'];
$today=date('d-m-Y');
?>
		
<table class="table">		
			<tr>
		    <td> Name</td><td>:</td>
		    <td><input class="form-control input-large customer_name" placeholder="Enter Customer Name" required name="name" autocomplete="off" type="text" value="<?php echo $name; ?>"> </td>
			</tr>
			<tr>
			<td>City</td><td>:</td>
		    <td><input class="form-control input-large customer_city" placeholder="Enter City" required name="city" autocomplete="off" type="text" value="<?php echo $city; ?>"> </td>
			<td>State</td><td>:</td>
			<td><input class="form-control input-large customer_state" placeholder="Enter state" required name="state" autocomplete="off" type="text" value="<?php echo $state; ?>"> </td>
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
			<td>Mobile No</td><td>:</td>
		    <td><input class="form-control input-large customer_mobile" placeholder="Enter Mobile No" required name="contact_no" autocomplete="off" type="text" value="<?php echo $mobile; ?>"></td>
			</tr>
</table>
<script>
 			$('.date-picker').datepicker();
			$('.date-picker').datepicker().on('changeDate', function(){
			$(this).blur();
			$(this).datepicker('hide');
			}); 
			$(".customer_name").attr( 'readonly', 'readonly' );
			$(".customer_city").attr( 'readonly', 'readonly' );
			$(".customer_state").attr( 'readonly', 'readonly' );
			$(".customer_mobile").attr( 'readonly', 'readonly' );
			$(".customer_aadhaar").attr( 'readonly', 'readonly' );
			$(".customer_address").attr( 'readonly', 'readonly' );
			$(".customer_pan").attr( 'readonly', 'readonly' );
			$(".customer_gst").attr( 'readonly', 'readonly' );
	
</script>
