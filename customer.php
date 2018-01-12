<?php
include("index_layout.php");
include("database.php");
?>
<?php 
if(isset($_POST['sub']))
{
	$name=$_POST['name'];
	$city=$_POST['city'];
	$state=$_POST['state'];
	$gst_no=$_POST['gst_no'];
	$pan_no=$_POST['pan_no'];
	$Aadhaar_no=$_POST['Aadhaar_no'];
	$address=$_POST['address'];
	$mobile=$_POST['contact_no'];
	
	mysql_query("insert into `customer` SET `customer_name`='$name',`address`='$address',
		`city`='$city',`state`='$state',`contact_no`='$mobile',`gst_no`='$gst_no',`pan_no`='$pan_no',`Aadhaar_no`='$Aadhaar_no'");
	echo '<script>window.location="customer.php"</script>';
}
 
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
										<td>Customer Name</td><td>:</td>
										<td><input class="form-control input-large customer_name" placeholder="Enter Customer Name" required name="name" autocomplete="off" type="text" value=""> </td>
										<td>State</td><td>:</td>
										<td><select name="state" class="select2me form-control input-large">
										 <option value="">--------Select State-------</option>
										 <option value="raj">Rajasthan</option>
										 <option value="mp">Madhya Pradesh</option>
										</select>
										</td>
										</tr>
										<tr>
										<td>City</td><td>:</td>
										<td><select name="city" class="select2me form-control input-large">
										 <option value="">--------Select City--------</option>
										 <option value="ch">Chittorgarh</option>
										 <option value="up">Udaipur</option>
										</select> </td>				
										<td>GST No</td><td>:</td>
										<td><input class="form-control input-large customer_gst" placeholder="Enter GST No" required name="gst_no" autocomplete="off" type="text" value=""> </td>
										</tr>
										<tr>
										<td>Pan No</td><td>:</td>
										<td><input class="form-control input-large customer_pan" placeholder="Enter Pan No" required name="pan_no" autocomplete="off" type="text" value=""> </td>
										<td>Aadhaar No</td><td>:</td>
										<td><input class="form-control input-large customer_aadhaar" placeholder="Enter Aadhaar No" required name="Aadhaar_no" autocomplete="off" type="text" value=""></td>
										</tr>
										<tr>
										 <td>Address</td><td>:</td>
										<td><textarea class="form-control input-large customer_address" placeholder="Enter Address" required name="address" autocomplete="off" type="text" value=""></textarea> </td>
										<td>Mobile No</td><td>:</td>
										<td><input class="form-control input-large customer_mobile" placeholder="Enter Contact No" required name="contact_no" autocomplete="off" type="text" value=""></td>
										</tr>
										<span class="help-block"> </span>
										<tr>
										<td colspan="6">
										<center><button type="submit" name="sub" class="btn btn-primary">Submit</button></center>
										</td>
										</tr>
								</table>
					</form>
				</div>
			</div>
          </div>
            <!-------------------------- View------------>
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
									<th>Address</th>
									<th>City</th>
									<th>State</th>
									<th>GST No</th>
									<th>PAN No</th>
									<th>Aadhaar No</th>
									<th>Contact No</th>
									<th>  Action
									</th>
								</tr>
								</thead>
							 <?php
						  $r1=mysql_query("select * from customer");		
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
								$gst_no=$row1['gst_no'];
								$pan_no=$row1['pan_no'];
								$Aadhaar_no=$row1['Aadhaar_no'];
								
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
									<?php echo $address;?>
									</td>
									<td class="search">
									<?php echo $city;?>
									</td>
                                    <td class="search">
									<?php echo $state;?>
									</td> 
									<td class="search">
									<?php echo $gst_no;?>
									</td>
									<td class="search">
									<?php echo $pan_no;?>
									</td>
									<td class="search">
									<?php echo $Aadhaar_no;?>
									</td>
									<td class="search">
									<?php echo $mobile;?>
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
										<td>Customer Name</td><td>:</td>
										<td><input class="form-control input-large customer_name" placeholder="Enter Customer Name" required name="name" autocomplete="off" type="text" value="<?php echo $name;?>"> </td>
										<td>City</td><td>:</td>
										<td><input class="form-control input-large customer_city" placeholder="Enter City" required name="city" autocomplete="off" type="text" value="<?php echo $city;?>"> </td>
										</tr>
										<tr>
										<td>State</td><td>:</td>
										<td><input class="form-control input-large customer_state" placeholder="Enter state" required name="state" autocomplete="off" type="text" value="<?php echo $state;?>"> </td>
										<td>GST No</td><td>:</td>
										<td><input class="form-control input-large customer_gst" placeholder="Enter GST No" required name="gst_no" autocomplete="off" type="text" value="<?php echo $gst_no;?>"> </td>
										</tr>
										<tr>
										<td>Pan No</td><td>:</td>
										<td><input class="form-control input-large customer_pan" placeholder="Enter Pan No" required name="pan_no" autocomplete="off" type="text" value="<?php echo $pan_no;?>"> </td>
										<td>Aadhaar No</td><td>:</td>
										<td><input class="form-control input-large customer_aadhaar" placeholder="Enter Aadhaar No" required name="Aadhaar_no" autocomplete="off" type="text" value="<?php echo $Aadhaar_no;?>"></td>
										</tr>
										<tr>
										 <td>Address</td><td>:</td>
										<td><input class="form-control input-large customer_address" placeholder="Enter Address" required name="address" autocomplete="off" type="text" value="<?php echo $address;?>"></td>
										<td>Mobile No</td><td>:</td>
										<td><input class="form-control input-large customer_mobile" placeholder="Enter Contact No" required name="contact_no" autocomplete="off" type="text" value="<?php echo $mobile;?>"></td>
										</tr>
										<span class="help-block"> </span>
										<tr>
										<td colspan="6">
										<center><button type="submit" name="sub_edit" class="btn green">Update</button></center>
										</td>
										</tr>
								</table>
							
							</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
                                        
                                        
                                        
                                        
                                        <!---- update----->
       <a class="btn blue-madison red btn-sm"  rel="tooltip" title="Delete"  data-toggle="modal" href="#delete<?php echo $id ;?>"><i class="fa fa-trash"></i></a>
            <div class="modal fade" id="delete<?php echo $id ;?>" tabindex="-1" aria-hidden="true" style="padding-top:35px">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <div class="portlet box yellow">
								<div class="portlet-title ">
									<div class="caption">
										<i class="fa fa-trash "></i>Are you sure, you want to delete this  Customer?
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>	
									</div>
								</div>
						</div>
                        </div>
                        <div class="modal-footer">
                        <form method="post" name="delete<?php echo $id ;?>">
                            <input type="hidden" name="delet_class" value="<?php echo $id; ?>" />
                            
                            <button type="submit" name="sub_del" value="" class="btn btn-lg red-sunglo ">Yes</button> 
                        </form>
                        </div>
                    </div>
                <!-- /.modal-content -->
                </div>
        <!-- /.modal-dialog -->
            </div>
									   
									   
									   
					</td>
				</tr>
				</tbody>
	<?php } ?>
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

<?php scripts();?>

</html>
 

