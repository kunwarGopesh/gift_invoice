<?php
include("index_layout.php");
include("database.php");
?>
<?php 
if(isset($_POST['sub']))
{
	$role=$_POST['role'];
	$name=$_POST['name'];
	$username=$_POST['user_name'];
	$password=$_POST['password'];
	$pass_check=md5($password);
	$mobile=$_POST['mobile_no'];
	mysql_query("insert into `admin_login` SET `role_id`='$role',`name`='$name',`user_name`='$username',`password`='$pass_check',`mobile_no`='$mobile'");
		
	echo '<script>window.location="user.php"</script>';
}
if(isset($_POST['sub_edit']))
{
	$edit=$_REQUEST['edit_id'];  
	$name=mysql_real_escape_string($_REQUEST["name"]);
	$username=mysql_real_escape_string($_REQUEST["user_name"]);
	$mobile=mysql_real_escape_string($_REQUEST["mobile_no"]);
	$role=mysql_real_escape_string($_REQUEST["role"]);
	//print_r($catid);exit;
	$r=mysql_query("update `admin_login` SET `role_id`='$role',`name`='$name',`user_name`='$username',`mobile_no`='$mobile' where `id`='$edit'" );
	$r=mysql_query($r);
	echo '<script text="javascript">alert(Class Added Successfully")</script>';	
}
if(isset($_POST['sub_del']))
{
	$delet_class=$_POST['delet_class'];
	mysql_query("DELETE FROM admin_login WHERE id='$delet_class'" );
}
?>
<html>
<head>
<?php css();?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>User Master</title>
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
					<i class="fa fa-gift"></i>User Master
				</div>
			</div>
			<div class="portlet-body form">
			<!-- BEGIN FORM-->
				<form  class="form-horizontal" id="form_sample_2"  role="form" method="post"> 
					<table class="table">
										<tr>
										<td>Choose Role</td><td>:</td>
										<td><select name="role" id="role" class="select2me form-control input-large " >
										<option >------------Select Role------------</option>
											<?php
												$sql=mysql_query("select id,role_name from master_role");
												
												while($row=mysql_fetch_array($sql))
												{?>		
														<option  value="<?php echo $row['id'] ;?>"><?php echo $row['role_name']; ?></option>
													<?php }?>
													</select></td>
										<td> Name</td><td>:</td>
										<td><input class="form-control input-large " placeholder="Enter Full Name" required name="name" autocomplete="off" type="text" value=""> </td>
										</tr>
										<tr>
										<td>User-name</td><td>:</td>
										<td><input class="form-control input-large " placeholder="Enter Username" required name="user_name" autocomplete="off" type="text" value=""> </td>
										<td>Mobile No</td><td>:</td>
										<td><input class="form-control input-large " placeholder="Enter Mobile Number" required name="mobile_no" autocomplete="off" type="text" value=""> </td>
										</tr>
										<tr>
										<td>Password</td><td>:</td>
										<td  ><input class="form-control input-large password " placeholder="Enter Password " required name="password" autocomplete="off" type="password" value=""> </td>
										<td>Confirm Password</td><td>:</td>
										<td  ><input class="form-control input-large cpassword" placeholder="Re-enter Password " required name="cpassword" autocomplete="off" type="password" value=""> </td>
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
			</div>
			 <div class="row">
				<div class="col-md-12">
				<div class="portlet box blue">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-gift"></i>User Details
						</div>
					</div>
						<div class="portlet-body form">
						<!-- BEGIN FORM-->
							<form  class="form-horizontal" id="form_sample_2"  role="form" method="post"> 
								<table class="table">
									<tr>
										<thead>
											<th>#</th>
											<th>Name</th>
											<th>User-name</th>
											<th>Mobile Number</th>
											<th>Role</th>
											<th>Actions</th>
									</tr>
										</thead>
										<?php 
										$select=mysql_query("select * from admin_login where flag='0'");
										$i=0;
										while($row1=mysql_fetch_array($select))
										{
										$i++;
										$id=$row1['id'];
										$role=$row1['role_id'];
										$name=$row1['name'];
										$username=$row1['user_name'];
										$mobile=$row1['mobile_no'];
										
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
													<?php echo $username;?>
													</td>
													<td class="search">
													<?php echo $mobile;?>
													</td> 
													<td class="search">
													<?php echo fetchrolename($role);?>
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
										<i class="fa fa-gift"></i>Edit User
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>	
									</div>
								</div>
						</div>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                           <div class="portlet-body form">
							<form class="form-horizontal" role="form" id="noticeform" method="post" enctype="multipart/form-data">
                                <input type="hidden" name='edit_id' class="form-control" value="<?php echo $id;?>" />	
									<table class="table">
										<tr>
										<td>Choose Role</td><td>:</td>
										<td>
											<select name="role" id="role" class="select2me form-control input-medium " >
												<?php
														$sql=mysql_query("select id,role_name from master_role");
														
												while($row=mysql_fetch_array($sql))
												{?>		
												<option  value="<?php echo $row['id'] ;?>" <?php if($role==$row['id']){ echo "selected"; }?> ><?php echo $row['role_name']; ?></option>
												<?php }?>
											</select>
										</td>
										<td> Name</td><td>:</td>
										<td><input class="form-control input-medium " placeholder="Enter Full Name" required name="name" autocomplete="off" type="text" value="<?php echo $name;?>"> </td>
										</tr>
										<tr>
										<td>User-name</td><td>:</td>
										<td><input class="form-control input-medium " placeholder="Enter Username" required name="user_name" autocomplete="off" type="text" value="<?php echo $username;?>"> </td>
										<td>Mobile No</td><td>:</td>
										<td><input class="form-control input-medium " placeholder="Enter Mobile Number" required name="mobile_no" autocomplete="off" type="text" value="<?php echo $mobile;?>"> </td>
										</tr>
										
										<span class="help-block"> </span>
										<tr>
												<td colspan="8">
												<center><button type="submit" class="btn green" name="sub_edit">Update</button></center>
												</td>
										</tr>
									</table>		
						</form>
					</div>
					</div>
				</div>
			</div>
		</div>
	<a class="btn blue-madison red btn-sm"  rel="tooltip" title="Delete"  data-toggle="modal" href="#delete<?php echo $id ;?>"><i class="fa fa-trash"></i></a>								
			<div class="modal fade" id="delete<?php echo $id ;?>" tabindex="-1" aria-hidden="true" style="padding-top:35px">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <div class="portlet box yellow">
								<div class="portlet-title ">
									<div class="caption">
										<i class="fa fa-trash "></i>Are you sure, you want to delete this  User?
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
										</tr>
										<?php }?>	
					
										</table>
									</form>
						
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
	
	 $('.cpassword').blur(function() {
		  var pd=$('.password').val();
		  var cp=$(this).val();	
		 if(pd!=cp)
		 {
			 alert('Password Does Not Match');
		 } 
		 
	 });
});

</script>
<?php scripts();?>									
</html>