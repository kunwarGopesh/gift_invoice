<?php 
include("database.php");
$com_id=$_GET['com_no'];
$set=mysql_query("select * from `companies` where `id`='$com_id'");
$fet=mysql_fetch_array($set);
$name=$fet['name'];
$address=$fet['address'];
$phone_no=$fet['phone_no'];
$gst_no=$fet['gst_no'];
?>
<table class="table">
										<tr>
										<td>Company Name</td><td>:</td>
										<td><input class="form-control input-large company_name" placeholder="Enter Company Name" required name="name" autocomplete="off" type="text" value="<?php echo $name;?>"> </td>
										<td>GST No</td><td>:</td>
										<td>
										<input class="form-control company_gst" placeholder="Enter GST No" required name="gst_no" autocomplete="off" type="text" value="<?php echo $gst_no;?>">
										</td>
										</tr>
										<tr>
										<td>Company Phone</td><td>:</td>
										<td><input class="form-control input-large company_mobile" placeholder="Enter Phone No" required name="com_phone" autocomplete="off" type="text" value="<?php echo $phone_no;?>"> </td>
										<td>Address</td><td>:</td>
										<td>
										<input class="form-control company_address" placeholder="Enter Address" required name="address" autocomplete="off" type="text" value="<?php echo $address;?>">
										</td>
										</tr>
</table>	
<script>
	$(".company_name").attr( 'readonly', 'readonly' );
	$(".company_gst").attr( 'readonly', 'readonly' );
	$(".company_address").attr( 'readonly', 'readonly' );
	$(".company_mobile").attr( 'readonly', 'readonly' );
	
</script>
		

