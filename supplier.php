<?php
include("index_layout.php");
include("database.php");
?>
<?php 
if(isset($_POST['submit']))
{
	$sess_id=$_SESSION['id'];	
	$company_name=$_POST['company_name'];
	$company_gst=$_POST['company_gst'];
	$company_phone=$_POST['company_phone'];
	$company_address=$_POST['company_address'];
	$supplier_name=$_POST['name'];
	$city=$_POST['city_id'];
	$state=$_POST['state_id'];
	$pan_no=$_POST['pan_no'];
	$Aadhaar_no=$_POST['Aadhaar_no'];
	$address=$_POST['Supplier_address'];
	$mobile=$_POST['contact_no'];
	mysql_query("insert into `supplier` SET `supplier_name`='$supplier_name',`address`='$address',
		`city`='$city',`state`='$state',`contact_no`='$mobile',`pan_no`='$pan_no',`Aadhaar_no`='$Aadhaar_no',`created_by`='$sess_id'");
		$supplier_id=mysql_insert_id();
	mysql_query("insert into `companies` SET `supplier_id`='$supplier_id',`name`='$company_name',`address`='$company_address',
		`phone_no`='$company_phone',`gst_no`='$company_gst',`created_by`='$sess_id'");
	echo '<script>window.location="supplier.php"</script>';
}
 if(isset($_POST['sub_del']))
{
	$delet_class=$_POST['delet_class'];
	mysql_query("DELETE FROM `supplier` WHERE `id`='$delet_class'" );
	mysql_query("DELETE FROM `companies` WHERE `supplier_id`='$delet_class'" );
}

if(isset($_POST['sub_edit']))
{
	$sess_id=$_SESSION['id'];	
	$edit=$_REQUEST['edit_id'];  
	$company_name=mysql_real_escape_string($_REQUEST['company_name']);
	$company_gst=mysql_real_escape_string($_REQUEST['company_gst']);
	$company_phone=mysql_real_escape_string($_REQUEST['company_phone']);
	$company_address=mysql_real_escape_string($_REQUEST['company_address']);
	$supplier_name=mysql_real_escape_string($_REQUEST['name']);
	$city=mysql_real_escape_string($_REQUEST['city_id']);
	$state=mysql_real_escape_string($_REQUEST['state_id']);
	$pan_no=mysql_real_escape_string($_REQUEST['pan_no']);
	$Aadhaar_no=mysql_real_escape_string($_REQUEST['Aadhaar_no']);
	$address=mysql_real_escape_string($_REQUEST['Supplier_address']);
	$mobile=mysql_real_escape_string($_REQUEST['contact_no']); 
	 $r =mysql_query("update `supplier` SET `supplier_name`='$supplier_name',`address`='$address',
		`city`='$city',`state`='$state',`contact_no`='$mobile',`pan_no`='$pan_no',`Aadhaar_no`='$Aadhaar_no',`created_by`='$sess_id' where `id`='$edit'");
	$r=mysql_query($r);
	$p=mysql_query("update `companies` SET `name`='$company_name',`address`='$company_address',
		`phone_no`='$company_phone',`gst_no`='$company_gst',`supplier_id`='$edit',`created_by`='$sess_id' where `supplier_id`='$edit'");
		
		 $p=mysql_query($p);
		echo '<script text="javascript">alert(Class Added Successfully")</script>';	
	
}
  ?> 
<html>
<head>
<?php css();?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Master Supplier</title>
</head>
<?php contant_start(); menu();  ?>
<body>
	<div class="page-content-wrapper">
		<div class="page-content">
			<div class="row">
				<div class="portlet box blue">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-gift"></i>Master Supplier
						</div>
					</div>
						<div class="portlet-body form">
									<!-- BEGIN FORM-->
							<form  class="form-horizontal" id="form_sample_2"  role="form" method="post"> 
										
										<div id="company_table">
										<table class="table">
										<tr>
										<td>Company Name</td><td>:</td>
										<td><input class="form-control input-large company_name" placeholder="Enter Company Name" required name="company_name" autocomplete="off" type="text" value=""> </td>
										<td>GST No</td><td>:</td>
										<td>
										<input class="form-control input-large company_gst" placeholder="Enter GST No" required name="company_gst" autocomplete="off" type="text">
										</td>
										</tr>
										<tr>
										<td>Company Phone</td><td>:</td>
										<td><input class="form-control input-large company_mobile" placeholder="Enter Phone No" required name="company_phone" autocomplete="off" type="text" value=""> </td>
										<td>Address</td><td>:</td>
										<td>
										<textarea class="form-control input-large company_address" placeholder="Enter Address" required name="company_address" autocomplete="off" type="text"></textarea>
										</td>
										</tr>
									<tr>
									<td> Name</td><td>:</td>
									<td><input class="form-control input-large Supplier_name" placeholder="Enter Supplier Name" required name="name" autocomplete="off" type="text"  </td>
									<td>Mobile No</td><td>:</td>
									<td><input class="form-control input-large Supplier_mobile" placeholder="Enter Mobile No" required name="contact_no" autocomplete="off" type="text" ></td>
									</tr>
									<tr>
									<td>State</td><td>:</td>
									<td>
									<select name="state_id" id="state_id" class="select2me form-control input-large select_state" placeholder="-----------------Choose State------------------">
									<option value="" ></option>
									<?php
									$Supplier_data=mysql_query("SELECT DISTINCT state FROM city_states ");
									
									while($row=mysql_fetch_array($Supplier_data))
									{?>		
											<option value="<?php echo $row['state'] ;?>"><?php echo $row['state']; ?></option>
										<?php }?>
										</select> 
									</td>									
									<td>City</td><td>:</td>
									<td id="newcity">
									<select name="city_id" id="city_id" class=" select2me form-control input-large select_city" placeholder="-----------------Choose City------------------">
									<option value=""></option>
									</select>
									</td>	
																	
								   </tr>
									<tr>
									<td>Pan No</td><td>:</td>
									<td><input class="form-control input-large Supplier_pan" placeholder="Enter Pan No" required name="pan_no" autocomplete="off" type="text" > </td>
									<td>Aadhaar No</td><td>:</td>
									<td><input class="form-control input-large Supplier_aadhaar" placeholder="Enter Aadhaar No" required name="Aadhaar_no" autocomplete="off" type="text" ></td>
									</tr>
									<tr>
									 <td>Address</td><td>:</td>
									<td colspan="4"><textarea class="form-control Supplier_address" placeholder="Enter Address" required name="Supplier_address" autocomplete="off" type="text"></textarea> </textarea></td>
									
									</tr>
								<tr>
								<td colspan="8">
								<center>
								<input class="btn btn-primary"type="submit" name="submit" value="Submit">
								</center>
								</td>
								</tr>
						</table>
					</form>
				</div>
			</div>
          </div>
	</div>		
		<div class="row">
				<div class="col-md-12">
			<div class="portlet box blue">
			<div class="portlet-title ">
				<div class="caption">
					<i class="fa fa-gift"></i>View Suppliers
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
									<th>Supplier Name</th>
									<th>Company Name</th>
									<th>Company GST</th>
									<th>Company Address</th>
									<th>Company Mobile</th>
									<th>  Action
									</th>
								</tr>
								</thead>
							 <?php
						  $r1=mysql_query("select * from supplier");		
						  		
								$i=0;
								while($row1=mysql_fetch_array($r1))
								{

								$i++;
								$id=$row1['id'];
								$supplier_id=$row1['id'];
								$name=$row1['supplier_name'];
								$address=$row1['address'];
								$city=$row1['city'];
								$state=$row1['state'];
								$mobile=$row1['contact_no'];
								$pan_no=$row1['pan_no'];
								$Aadhaar_no=$row1['Aadhaar_no'];
								
								$r2=mysql_query("select * from `companies` where `supplier_id`='$supplier_id'");	
								while($row2=mysql_fetch_array($r2))
								{
									$com_id=$row2['id'];
									$supplier_id=$row2['supplier_id'];
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
						<div class="portlet box green">
								<div class="portlet-title ">
									<div class="caption">
										<i class="fa fa-gift"></i>Edit Suppliers
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
										<td><input class="form-control input-large company_name" placeholder="Enter Company Name" required name="company_name" autocomplete="off" type="text" value="<?php echo fetchcompanyname($com_id);?>"> </td>
										<td>GST No</td><td>:</td>
										<td>
										<input class="form-control company_gst" p required name="company_gst" autocomplete="off" type="text" value="<?php echo $gst;?>">
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
									<td><input class="form-control input-large Supplier_name"  Name="name" required name="name" autocomplete="off" type="text" value="<?php echo $name;?>"> </td>
									<td>Mobile No</td><td>:</td>
									<td><input class="form-control input-large Supplier_mobile" placeholder="Enter Mobile No" required name="contact_no" autocomplete="off" type="text" value="<?php echo $mobile;?>"></td>
									</tr>
									<tr>
									<td>State</td><td>:</td>
									<td>
									<select name="state_id"  class="select2me form-control input-large edit_state">
									
									<?php
									$Supplier_data=mysql_query("SELECT DISTINCT state FROM city_states ");
									
									while($row=mysql_fetch_array($Supplier_data))
									{?>		
											<option value="<?php echo $row['state'] ;?>" <?php if ($state==$row['state']) {echo "selected"; }?> ><?php echo $row['state']; ?></option>
										<?php }?>
										</select> 
									</td>
									<td>City</td><td>:</td>
									<td class="newtable">
									<select name="city_id" id="city_id" class="select2me form-control input-large select_city1">
									<?php 
									$st=mysql_query("select `city` from `city_states` where `state`='$state'");
									while($ft=mysql_fetch_array($st)){
										
										$city_name=$ft['city'];
										
										?>
										<option value="<?php echo $city_name;?>" <?php if($city_name==$city){ echo "selected"; }?>><?php echo $city_name;?></option>
										
										<?php
									}
									?>
									
									</select>
									</td>										
								   </tr>
									<tr>
									<td>Pan No</td><td>:</td>
									<td><input class="form-control input-large Supplier_pan" placeholder="Enter Pan No" required name="pan_no" autocomplete="off" type="text" value="<?php echo $pan_no;?>"> </td>
									<td>Aadhaar No</td><td>:</td>
									<td><input class="form-control input-large Supplier_aadhaar" placeholder="Enter Aadhaar No" required name="Aadhaar_no" autocomplete="off" type="text" value="<?php echo $Aadhaar_no;?>"></td>
									</tr>
									<tr>
									 <td>Address</td><td>:</td>
									<td colspan="4"><input class="form-control input-large Supplier_address" placeholder="Enter Address" required name="Supplier_address" autocomplete="off" type="text" value="<?php echo $address;?>"></td>
									
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
	</div>
	</div>
                                
                                        <!---- update----->
       <a class="btn blue-madison red btn-sm"  rel="tooltip" title="Delete"  data-toggle="modal" href="#delete<?php echo $id ;?>"><i class="fa fa-trash"></i></a>
            <div class="modal fade" id="delete<?php echo $id ;?>" tabindex="-1" aria-hidden="true" style="padding-top:35px">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <div class="portlet box red-sunglo">
								<div class="portlet-title ">
									<div class="caption">
										<i class="fa fa-trash "></i>Are you sure, you want to delete this  Supplier?
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
				  <a class="btn blue-madison blue btn-sm" rel="tooltip" title="View" data-toggle="modal" href="#view<?php echo $id;?>"><i class="fa fa-list"></i></a>					   
									   
						<!----------/. Modal -View------->
	<div class="modal fade" id="view<?php echo $id ;?>" tabindex="-1" aria-hidden="true" style="padding-top:35px">
             <div class="modal-dialog modal-lg">
                  <div class="modal-content">    
						<div class="portlet box blue-madison">
								<div class="portlet-title ">
									<div class="caption">
										<i class="fa fa-gift"></i>View Suppliers
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>	
									</div>
								</div>
						</div>
                        <div class="modal-body">
						<form class="form-horizontal" role="form" id="noticeform" method="post" enctype="multipart/form-data">
								<input type="hidden" name='edit_id' class="form-control" value="<?php echo $id;?>" >	
									<table class="table">
									<tr>
									<td>Supplier Address</td><td>:</td>
									<td><?php echo $address;?></td>
									<td>Mobile No</td><td>:</td>
									<td><?php echo $mobile;?></td>
									</tr>
									<tr>
									<td>City</td><td>:</td>
									<td><?php echo $city;?></td>
									<td>State</td><td>:</td>
									<td><?php echo $state;?></td>
									</tr>
									<tr>
									<td>Pan No</td><td>:</td>
									<td><?php echo $pan_no;?></td>
									<td>Aadhaar No</td><td>:</td>
									<td><?php echo $Aadhaar_no;?></td>
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
								<?php }} ?>
				</table>
			</div>
		</div>
	</div>	
</div>

										
</body>
<?php footer(); ?>
	<script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
	<script>
		$(document).ready(function() {    
		 $("#state_id").live('change', function () {
		 var state=$(this, 'option:selected').val();	
			$.ajax({
				url: "state_city.php?reg_no="+state,
				}).done(function(response) {
					$("#newcity").html(response);
					$(".select_city").select2();
				});
	 });
	 $(".edit_state").live('change', function () {
		 var state=$(this, 'option:selected').val();
		 var new1=$(this).closest('tr').find("td.newtable");
			$.ajax({
				url: "state_city.php?reg_no="+state,
				}).done(function(response) {
					new1.html(response);
					$(".select_city1").select2();
				});
	 });
	 });
	</script>
<?php scripts();?>

</html>

