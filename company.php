<?php
include("index_layout.php");
include("database.php");
?>
<?php 
if(isset($_POST['sub']))
{
	$name=$_POST['cname'];
	$address=$_POST['address'];
	$phone=$_POST['phone'];
	$gstno=$_POST['gst_no'];
	
	mysql_query("insert into `companies` SET `name`='$name',`address`='$address',
		`phone_no`='$phone',`gst_no`='$gstno'");
	echo '<script>window.location="company.php"</script>';
}
 
if(isset($_POST['sub_del']))
{
	$delet_class=$_POST['delet_class'];
	mysql_query("DELETE FROM companies WHERE id='$delet_class'" );
}

if(isset($_POST['sub_edit']))
{
	$edit=$_REQUEST['edit_id'];  
	$name=mysql_real_escape_string($_REQUEST["cname"]);
	$address=mysql_real_escape_string($_REQUEST["address"]);
	$phone=mysql_real_escape_string($_REQUEST["phone"]);
	$gstno=mysql_real_escape_string($_REQUEST["gst_no"]);
	$r=mysql_query("update `companies` SET `name`='$name',`address`='$address',
		`phone_no`='$phone',`gst_no`='$gstno' where id='$edit'"  );
	$r=mysql_query($r);
	echo '<script text="javascript">alert(Class Added Successfully")</script>';	
}




  ?> 
<html>
<head>
<?php css();?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Master Company</title>
</head>
<?php contant_start(); menu();  ?>
<body>
	<div class="page-content-wrapper">
	<div class="page-content">
    <div class="row">
    <div class="col-md-12">
			<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-gift"></i>Master Companies
				</div>
			</div>
			<div class="portlet-body form">
			<!-- BEGIN FORM-->
				<form  class="form-horizontal" id="form_sample_2"  role="form" method="post"> 
					<div class="form-body">
						<div class="form-group">
						<div class="row">
						<div class="col-md-6">
							<div class="row">
								<div class="col-md-6">
									<label class="control-label col-md-8">Company Name</label>
								</div>
								<div class="col-md-6">
									<div class="input-icon right">
									<i class="fa"></i>
									<input class="form-control" placeholder="Please Enter Company Name" required name="cname" autocomplete="off" type="text">
									</div>
								</div>
							</div>
						</div><span class="help-block"> </span>
						
						<div class="col-md-6">
						<div class="row">
						<div class="col-md-4">
							<label class="control-label col-md-8">GST No</label>
						</div>
							<div class="col-md-6">
								<div class="input-icon right">
								<i class="fa"></i>
								<input class="form-control" placeholder=" Enter GST Number" required name="gst_no" autocomplete="off" type="text">
								</div>
								</div>
							</div>
						</div><span class="help-block"> </span>
					</div>	
					
						<div class="row">
						<div class="col-md-6">
						<div class="row">
						<div class="col-md-6">
							<label class="control-label col-md-6">Phone No</label>
						</div>
							<div class="col-md-6">
								<div class="input-icon right">
								<i class="fa"></i>
								<input class="form-control" placeholder=" Enter Phone Number" required name="phone" autocomplete="off" type="text">
								</div>
								
								</div>
							</div>
						</div><span class="help-block"> </span>
						<div class="col-md-6">
						<div class="row">
						<div class="col-md-4">
							<label class="control-label col-md-8">Address</label>
						</div>
							<div class="col-md-6">
								<div class="input-icon right">
								<i class="fa"></i>
								<textarea class="form-control" placeholder="Enter address" required name="address" autocomplete="off">
								</textarea></div>
								</div>
							</div>
						</div><span class="help-block"> </span>
						
						
					</div>
                        
						<div class="col-md-offset-5 col-md-6" style="">
								<button type="submit" name="sub" class="btn btn-primary">Submit</button>
						</div>
						 
						</br>
						</br>
					</div>
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
									<th> Company Name</th>
									<th>Address</th>
									<th>Phone No</th>
									<th>GST No</th>
									<th>  Action
									</th>
								</tr>
								</thead>
							 <?php
			  $r1=mysql_query("select * from companies");		
					$i=0;
					while($row1=mysql_fetch_array($r1))
					{
					$i++;
					$id=$row1['id'];
					$name=$row1['name'];
					$address=$row1['address'];
					$phone=$row1['phone_no'];
					$gstno=$row1['gst_no'];
					
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
									<?php echo $phone;?>
									</td>
                                    <td class="search">
									<?php echo $gstno;?>
									</td> 
									<td>
                                        <a class="btn blue-madison green btn-sm" rel="tooltip" title="Edit" data-toggle="modal" href="#edit<?php echo $id;?>"><i class="fa fa-edit"></i></a>
                                        &nbsp;
                                        <!--------editon-->
       <div class="modal fade" id="edit<?php echo $id ;?>" tabindex="-1" aria-hidden="true" style="padding-top:35px">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
						<div class="portlet box blue">
								<div class="portlet-title ">
									<div class="caption">
										<i class="fa fa-gift"></i>Edit Company
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>	
									</div>
								</div>
						</div>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							
                           <div class="portlet-body form">
							<form class="form-horizontal" role="form" id="noticeform" method="post" enctype="multipart/form-data">
							
							
                                <input type="hidden" name='edit_id' class="form-control" value="<?php echo $id;?>" >	
							
								<div class="form-body">
						 
						<div class="form-body">
						<div class="form-group">
						<div class="row">
						<div class="col-md-6">
						<div class="row">
						<div class="col-md-6">
							<label class="control-label col-md-8">Company Name</label>
						</div>
							<div class="col-md-6">
								<div class="input-icon right">
								<i class="fa"></i>
								<input class="form-control" placeholder="Please Enter Company Name" required name="cname" autocomplete="off" type="text" value="<?php echo $name;?>">
								</div>
								
								</div>
							</div>
						</div><span class="help-block"> </span>
						<div class="col-md-6">
							<div class="row">
						<div class="col-md-6">
							<label class="control-label col-md-8">GST No</label>
						</div>
							<div class="col-md-6">
								<div class="input-icon right">
								<i class="fa"></i>
								<input class="form-control" placeholder="Enter GST Number" required name="gst_no" autocomplete="off" type="text" value="<?php echo $gstno;?>">
								</div>
								
								</div>
							</div>
						</div>
						
					</div>	<span class="help-block"> </span>
					
						<div class="row">
						<div class="col-md-6">
						<div class="row">
						<div class="col-md-6">
							<label class="control-label col-md-8">Phone No</label>
						</div>
							<div class="col-md-6">
								<div class="input-icon right">
								<i class="fa"></i>
								<input class="form-control" placeholder=" Enter Phone Number" required name="phone" autocomplete="off" type="text" value="<?php echo $phone;?>">
								</div>
								
								</div>
							</div>
						</div><span class="help-block"> </span>
						<div class="col-md-6">
						<div class="row">
						<div class="col-md-6">
							<label class="control-label col-md-8 ">Address</label>
						</div>
							<div class="col-md-6">
								<div class="input-icon right">
								<i class="fa"></i>
								<input type="text" class="form-control" placeholder="Enter address" required 
								name="address" autocomplete="off" value="<?php echo $address;?>"/>
								</div>
								
								</div>
							</div>
						</div>
						
					</div>
					</div><span class="help-block"> </span>
                        
						<div class=" right1" align="right" style="margin-right:10px">
						<center><button type="submit" class="btn green" name="sub_edit">Update</button></center>
						</div>
						</form>
					</div>
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
										<i class="fa fa-trash "></i>Are you sure, you want to delete this  Company?
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>	
									</div>
								</div>
						</div>
                        </div>
                        <div class="modal-footer">
                        <form method="post" name="delete<?php echo $id ;?>">
                            <input type="hidden" name="delet_class" value="<?php echo $id; ?>" />
                            
                            <button type="submit" name="sub_del" value="" class="btn btn-sm red-sunglo ">Yes</button> 
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
	</div>
	</div>
	
</body>
<?php footer(); ?>

<?php scripts();?>

</html>
 

