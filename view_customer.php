<?php
include("index_layout.php");
include("database.php");
if(isset($_POST['sub_del']))
{
	$delet_class=$_POST['delet_class'];
	mysql_query("DELETE FROM customer WHERE id='$delet_class'" );
}

if(isset($_POST['sub_edit']))
{
	$edit=$_REQUEST['edit_id'];  
	$name=mysql_real_escape_string($_REQUEST['name']);
	$city=mysql_real_escape_string($_REQUEST['city']);
	$state=mysql_real_escape_string($_REQUEST['state']);
	$gst_no=mysql_real_escape_string($_REQUEST['gst_no']);
	$pan_no=mysql_real_escape_string($_REQUEST['pan_no']);
	$Aadhaar_no=mysql_real_escape_string($_REQUEST['Aadhaar_no']);
	$address=mysql_real_escape_string($_REQUEST['address']);
	$mobile=mysql_real_escape_string($_REQUEST['contact_no']);
	$r=mysql_query("update `customer` SET `customer_name`='$name',`address`='$address',
		`city`='$city',`state`='$state',`contact_no`='$mobile',`gst_no`='$gst_no',`pan_no`='$pan_no',`Aadhaar_no`='$Aadhaar_no'	where id='$edit'" );
	$r=mysql_query($r);
	echo '<script text="javascript">alert(Class Added Successfully")</script>';	
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
		<div class="col-md-12">
			<div class="portlet box blue">
			<div class="portlet-title ">
				<div class="caption">
					<i class="fa fa-gift"></i>View Customers
				</div>
			</div>
			<div class="portlet-body form">
			 <div class="table-scrollable">
								<table class="table   table-hover" width="100%" style="font-family:Open Sans;">
								<thead>
									
								<tr style="background:#F5F5F5">
									<th>
										 #
									</th>
									<th>Customer Name</th>
									<th>Company Name</th>
									<th>Company GST</th>
									<th>Address</th>
									<th>Contact No</th>
									<th>  Action
									</th>
								</tr>
								</thead>
							 <?php
						  $r1=mysql_query("select * from customer");		
						  $r2=mysql_query("select * from companies");			
								$i=0;
								while($row1=mysql_fetch_array($r1))
								{
								$i++;
								$id=$row1['id'];
								$name=$row1['customer_name'];
								$address=$row1['address'];
								$city=$row1['city'];
								$state=$row1['state'];
								$mobile=$row1['contact_no'];
								$pan_no=$row1['pan_no'];
								$Aadhaar_no=$row1['Aadhaar_no'];
								while($row2=mysql_fetch_array($r2))
								{
									$com_id=$row2['id'];
									$customer_id=$row2['customer_id'];
									$gst=$row2['gst_no'];
									$company_mobile=$row2['phone_no'];
									$company_address=$row2['address'];
									
								
								
								
 					?>
                    <tbody>
								<tr>
									<td>
							<?php echo $i;?>
									</td>
									<td class="search">
									<?php echo $name;?>
									</td>
									<td class="search">
									<?php echo fetchcompanyname($com_id);?>
									</td>
									<td class="search">
									<?php echo $gst;?>
									</td>
                                    <td class="search">
									<?php echo $company_address;?>
									</td> 
									<td class="search">
									<?php echo $company_mobile;?>
									</td>
									
									<td>
                                        <a class="btn blue-madison green btn-sm" rel="tooltip" title="Edit" data-toggle="modal" href="#edit<?php echo $id;?>"><i class="fa fa-edit"></i></a>
                                        &nbsp;
                                        <!--------editon-->
 <div class="modal fade" id="edit<?php echo $id ;?>" tabindex="-1" aria-hidden="true" style="padding-top:35px">
             <div class="modal-dialog modal-lg">
                  <div class="modal-content">    
						<div class="portlet box blue">
								<div class="portlet-title ">
									<div class="caption">
										<i class="fa fa-gift"></i>Edit Customers
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>	
									</div>
								</div>
						</div>
                        <div class="modal-body">
						<form class="form-horizontal" role="form" id="noticeform" method="post" enctype="multipart/form-data">
								<input type="hidden" name='edit_id' class="form-control" value="<?php echo $id;?>" >	
									<table class="table">
										<tr>
										<td>Company Name</td><td>:</td>
										<td><input class="form-control input-large company_name"  required name="company_name" autocomplete="off" type="text" value="<?php echo fetchcompanyname($com_id);?>"> </td>
										<td>GST No</td><td>:</td>
										<td>
										<input class="form-control company_gst" required name="company_gst" autocomplete="off" type="text" value="<?php echo $gst;?>">
										</td>
										</tr>
										<tr>
										<td>Company Phone</td><td>:</td>
										<td><input class="form-control input-large company_mobile" placeholder="Enter Phone No" required name="company_phone" autocomplete="off" type="text" value="<?php echo $company_mobile;?>"> </td>
										<td>Company Address</td><td>:</td>
										<td>
										<input class="form-control company_address" placeholder="Enter Address" required name="company_address" autocomplete="off" type="text" value="<?php echo $company_address;?>">
										</td>
										</tr>
									<tr>
									<td> Name</td><td>:</td>
									<td><input class="form-control input-large customer_name"  Name="name" required name="name" autocomplete="off" type="text" value="<?php echo $name;?>"> </td>
									<td>Mobile No</td><td>:</td>
									<td><input class="form-control input-large customer_mobile" placeholder="Enter Mobile No" required name="contact_no" autocomplete="off" type="text" value="<?php echo $mobile;?>"></td>
									</tr>
									<tr>
									<td>State</td><td>:</td>
									<td><input class="form-control input-large customer_state" placeholder="Enter state" required name="state" autocomplete="off" type="text" value="<?php echo $state;?>"> </td>
									<td>City</td><td>:</td>
									<td><input class="form-control input-large customer_city" placeholder="Enter City" required name="city" autocomplete="off" type="text" value="<?php echo $city;?>"> </td>
									
								   </tr>
									<tr>
									<td>Pan No</td><td>:</td>
									<td><input class="form-control input-large customer_pan" placeholder="Enter Pan No" required name="pan_no" autocomplete="off" type="text" value="<?php echo $pan_no;?>"> </td>
									<td>Aadhaar No</td><td>:</td>
									<td><input class="form-control input-large customer_aadhaar" placeholder="Enter Aadhaar No" required name="Aadhar_no" autocomplete="off" type="text" value="<?php echo $Aadhaar_no;?>"></td>
									</tr>
									<tr>
									 <td>Address</td><td>:</td>
									<td colspan="4"><input class="form-control input-large customer_address" placeholder="Enter Address" required name="address" autocomplete="off" type="text" value="<?php echo $address;?>"></td>
									
									</tr>
								<tr>
								<td colspan="8">
								<center><button type="submit" name="sub_edit" class="btn green">Update</button></center>
								</td>
								</tr>
						</table>
			
							</form>
					</div>
				</div>
			</div>
		</div>
	
				   
					</td>
				</tr>
				</tbody>
								<?php ++$i;}}?>
				</table>
			</div>
		</div>
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
</script>
<?php scripts();?>

</html>