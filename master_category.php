<?php
 include("index_layout.php");
 include("database.php");
 
if(isset($_POST['sub']))
{
	$class_name=$_POST['class_name'];
	$cat_id=$_POST['category_id'];
	
	mysql_query("insert into `master_category` SET `category_name`='$class_name',`parent_id`='$cat_id'");	
	echo '<script >window.location="master_category.php"</script>';	
}
 
if(isset($_POST['sub_del']))
{
	$delet_class=$_POST['delet_class'];

	mysql_query("update `master_category` SET `flag`='1' where id='$delet_class'" );
}

if(isset($_POST['sub_edit']))
{
	$edit=$_REQUEST['edit_id'];  
	$class_name=mysql_real_escape_string($_REQUEST["class_name"]);
	$cat_id=mysql_real_escape_string($_REQUEST["category_id"]);
	$r=mysql_query("update `master_category` SET `category_name`='$class_name',`parent_id`='$cat_id' where id='$edit'" );
	$r=mysql_query($r);
	echo '<script text="javascript">alert(Class Added Successfully")</script>';	
}
  ?> 
<html>
<head>
<?php css();?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Master Category</title>
</head>
<?php contant_start(); menu();  ?>
<body>
	<div class="page-content-wrapper">
	<div class="page-content">
    <div class="row">
    <div class="col-md-6">
			<div class="portlet box blue">
			<div class="portlet-title">
			<div class="caption">
					<i class="fa fa-gift"></i>Master Category
				</div>
			</div>
			<div class="portlet-body form">
			<!-- BEGIN FORM-->
				<form  class="form-horizontal" id="form_sample_2"  role="form" method="post"> 
					<div class="form-body">
						 <div class="form-group">
							<label class="control-label col-md-3">Select Category</label>
							<div class="col-md-6">
								<div class="input-icon right">
								<i class="fa"></i>
								<select name="category_id" class="select2me form-control input-large " >
										<option >-------Select Item Category-------</option>
											<?php
												$sql=mysql_query("select id,category_name from master_category where flag='0'");
												
												while($row=mysql_fetch_array($sql))
												{?>		
														<option  value="<?php echo $row['id'] ;?>"><?php echo $row['category_name']; ?></option>
													<?php }?>
													</select>
								</div>
								
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3">Category Name</label>
							<div class="col-md-6">
								<div class="input-icon right">
								<i class="fa"></i>
								<input class="form-control input-large " placeholder="Please Enter Category Name" required name="class_name" autocomplete="off" type="text">
								</div>
								
							</div>
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
            <div class="col-md-6">
			<div class="portlet box blue">
			<div class="portlet-title ">
				<div class="caption">
					<i class="fa fa-gift"></i>View Category
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
									<th>
                                    Category Name
									</th>
									 <th>
                                    Parent Category
									</th>
                                    <th>
                                        Action
									</th>
								</tr>
								</thead>
							 <?php
			  $r1=mysql_query("select * from master_category where flag='0'");		
					$i=0;
					while($row1=mysql_fetch_array($r1))
					{
					$i++;
					$id=$row1['id'];
					$class_name=$row1['category_name'];
					$cat_id=$row1['parent_id'];
 					?>
                    <tbody>
								<tr>
									<td>
							<?php echo $i;?>
									</td>
									<td class="search">
									<?php echo $class_name;?>
									</td>
									<td class="search">
									<?php if($cat_id==0)
									{
										echo $class_name;
									}
									else
									{
											echo fetchcategoryname($cat_id);
									}
									?>
									</td>
                                     
									<td>
                                        <a class="btn blue-madison green btn-sm" rel="tooltip" title="Edit" data-toggle="modal" href="#edit<?php echo $id;?>"><i class="fa fa-edit"></i></a>
                                        &nbsp;
                                        <!--------editon-->
        <div class="modal fade" id="edit<?php echo $id ;?>" tabindex="-1" aria-hidden="true" style="padding-top:35px">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                           <div class="portlet-body form">
							<form class="form-horizontal" role="form" id="noticeform" method="post" enctype="multipart/form-data">
							<div class="portlet box blue">
								<div class="portlet-title ">
									<div class="caption">
										<i class="fa fa-gift"></i>Edit Category
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>	
									</div>
								</div>
						</div>
							
                                <input type="hidden" name='edit_id' class="form-control" value="<?php echo $id;?>" >	
							
								<div class="form-body">
								<div class="form-group">
									<label class="control-label col-md-3">Choose Category</label>
									<div class="col-md-6">
										<div class="input-icon right">
										<i class="fa"></i>
										<select name="category_id" class="select2me form-control input-large " >
										
												<option value="<?php echo $cat_id;?>"><?php echo fetchcategoryname($cat_id);?></option>
													<?php
														$sql=mysql_query("select id,category_name from master_category where flag='0'");
														
														while($row=mysql_fetch_array($sql))
														{?>		
																<option  value="<?php echo $row['id'] ;?>" ><?php echo $row['category_name']; ?></option>
															<?php }?>
										</select>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3">Category Name</label>
									<div class="col-md-6">
										<div class="input-icon right">
											<i class="fa"></i>
											<input class="form-control" placeholder="Please Enter Class Name" required name="class_name" autocomplete="off" type="text" value="<?php echo $class_name;?>">
										</div>
									</div>
								</div>
                        
						<div class=" right1" align="right" style="margin-right:10px">
							<button type="submit" class="btn green" name="sub_edit">Update</button>
						</div>
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
										<i class="fa fa-trash "></i>Are you sure, you want to delete this  category?
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
</body>
<?php footer(); ?>

<?php scripts();?>

</html>
 

