<?php
include("index_layout.php");
include("database.php");
?>
<?php 
if(isset($_POST['sub']))
{
	$name=$_POST['itemname'];
	$code=$_POST['icode'];
	$qty=$_POST['qty'];
	$des=$_POST['des'];
	$price=$_POST['price'];
	$catid=$_POST['category'];
	mysql_query("insert into `master_items` SET `item_name`='$name',`item_code`='$code',
		`description`='$des',`item_price`='$price',`qty`='$qty',`category_id`='$catid'");
		
	echo '<script>window.location="item.php"</script>';
}
if(isset($_POST['sub_edit']))
{
	$edit=$_REQUEST['edit_id'];  
	$name=mysql_real_escape_string($_REQUEST["itemname"]);
	$code=mysql_real_escape_string($_REQUEST["icode"]);
	$qty=mysql_real_escape_string($_REQUEST["qty"]);
	$des=mysql_real_escape_string($_REQUEST["des"]);
	$price=mysql_real_escape_string($_REQUEST["price"]);
	$catid=mysql_real_escape_string($_REQUEST["category"]);
	$r=mysql_query("update `master_items` SET `item_name`='$name',`item_code`='$code',
		`description`='$des',`item_price`='$price',`qty`='$qty',`category_id`='$catid' where `id`='$edit'" );
	$r=mysql_query($r);
	echo '<script text="javascript">alert(Class Added Successfully")</script>';	
}
if(isset($_POST['sub_del']))
{
	$delet_class=$_POST['delet_class'];
	mysql_query("DELETE FROM master_items WHERE id='$delet_class'" );
}

?> 

<html>
<head>
<?php css();?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Item Master</title>
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
					<i class="fa fa-gift"></i>Item Master
				</div>
			</div>
			<div class="portlet-body form">
			<!-- BEGIN FORM-->
				<form  class="form-horizontal" id="form_sample_2"  role="form" method="post"> 
					<div class="form-body">
					<div class="row">
						<div class="col-md-6">
							<div class="row">
						<div class="col-md-6">
							<label class="control-label col-md-6">Category </label>
						</div>
							<div class="col-md-6">
								<div class="input-icon right">
								<i class="fa"></i>
								<select name="category" class="select2me form-control input-medium ">
								<option  >--select Item Category--</option>
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
							</div>
						<div class="col-md-6">
						<div class="row">
						<div class="col-md-6">
							<label class="control-label col-md-6">Item Qty</label>
						</div>
							<div class="col-md-6">
								<div class="input-icon right">
								<i class="fa"></i>
								<input class="form-control" placeholder="Enter  Item Quantity" required name="qty" autocomplete="off" type="text">
								</div>								
								</div>
							</div>
						</div><span class="help-block"></span>
							
						</div>
						<span class="help-block">
						 </span>
						<div class="row">
						<div class="col-md-6">
						<div class="row">
						<div class="col-md-6">
							<label class="control-label col-md-6">Item Name</label>
						</div>
							<div class="col-md-6">
								<div class="input-icon right">
								<i class="fa"></i>
								<input class="form-control input-medium" placeholder="Enter  Item Name" required name="itemname" autocomplete="off" type="text">
								</div>								
								</div>
							</div>
						</div><span class="help-block"></span>
						<div class="col-md-6">
						<div class="row">
						<div class="col-md-6">
							<label class="control-label col-md-7">Item Code</label>
						</div>
							<div class="col-md-6">
								<div class="input-icon right">
								<i class="fa"></i>
								<input class="form-control" placeholder=" Enter Item code" required name="icode" autocomplete="off" type="text">
								</div>
								
								</div>
							</div>
						</div>
						
					</div>	<span class="help-block">
						 </span>
					
						<div class="row">
						<div class="col-md-6">
						<div class="row">
						<div class="col-md-6">
							<label class="control-label col-md-6">Rate</label>
						</div>
							<div class="col-md-6">
								<div class="input-icon right">
								<i class="fa"></i>
								<input class="form-control" placeholder=" Enter Rate" required name="rate" autocomplete="off" type="text">
								</div>
								
								</div>
							</div>
						</div><span class="help-block">
						 </span>
						<div class="col-md-6">
							<div class="row">
						<div class="col-md-6">
							<label class="control-label col-md-6">Price</label>
						</div>
							<div class="col-md-6">
								<div class="input-icon right">
								<i class="fa"></i>
								<input class="form-control" placeholder="Enter Price" required name="price" autocomplete="off" type="text">
								</div>
								
								</div>
							</div>
						</div>
					</div><span class="help-block"> </span>	
						<div class="col-md-offset-5 col-md-6" style="">
								<button type="submit" name="sub" class="btn btn-primary">Submit</button>
						</div>	 
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
					<i class="fa fa-gift"></i>View items
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
									<th> Item Name</th>
									<th>Item code</th>
									<th>Description</th>
									<th>Price</th>
									<th>Item Qty</th>
									<th>Category Name</th>
									<th>  Action
									</th>
								</tr>
								</thead>
							 <?php
			  $r1=mysql_query("select * from master_items");		
			 	
					$i=0;
					while($row1=mysql_fetch_array($r1))
					{
					$i++;
					$id=$row1['id'];
					$name=$row1['item_name'];
					$icode=$row1['item_code'];
					$des=$row1['description'];
					$price=$row1['item_price'];
					$qty=$row1['qty'];
					$catid=$row1['category_id'];
					/* $st=mysql_query("select `category_name` from `master_category` where `id`='$catid'");
					$ft=mysql_fetch_array($st);
					$category_name=$ft['category_name']; */
					
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
									<?php echo $icode;?>
									</td>
                                    <td class="search">
									<?php echo $des;?>
									</td> 
									<td class="search">
									<?php echo $price;?>
									</td>
									<td class="search">
									<?php echo $qty;?>
									</td>
									<td class="search">
									<?php echo fetchcategoryname($catid);?></td>
									<td>  <a class="btn blue-madison green btn-sm" rel="tooltip" title="Edit" data-toggle="modal" href="#edit<?php echo $id;?>"><i class="fa fa-edit"></i></a>
                                        &nbsp;
	                                        <!--------editon-->
       <div class="modal fade" id="edit<?php echo $id ;?>" tabindex="-1" aria-hidden="true" style="padding-top:35px">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                           <div class="portlet-body form">
							<form class="form-horizontal" role="form" id="noticeform" method="post" enctype="multipart/form-data">
							
							
                                <input type="hidden" name='edit_id' class="form-control" value="<?php echo $id;?>" >	
							
								<div class="form-body">
						 
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<div class="row">
									<div class="col-md-6">
										<label class="control-label col-md-6">Category </label>
									</div>
									<div class="col-md-6">
										<div class="input-icon right">
										<select name="category" class="select2me form-control input-medium " >
										<option ><?php echo $name;?></option>
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
								</div>
						<div class="col-md-6">
						<div class="row">
						<div class="col-md-6">
							<label class="control-label col-md-6">Item Qty</label>
						</div>
							<div class="col-md-6">
								<div class="input-icon right">
								<i class="fa"></i>
								<input class="form-control" placeholder="Enter  Item Quantity" required name="qty" autocomplete="off" type="text" value="<?php echo $qty;?>">
								</div>								
								</div>
							</div>
						</div><span class="help-block"></span>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
						<div class="col-md-6">
						<div class="row">
						<div class="col-md-6">
							<label class="control-label col-md-6">Item Name</label>
						</div>
							<div class="col-md-6">
								<div class="input-icon right">
								<input class="form-control" placeholder="Enter  Item Name" required name="itemname" autocomplete="off" type="text" value="<?php echo $name;?>">
								</div>								
								</div>
							</div>
						</div><span class="help-block"></span>
						<div class="col-md-6">
						<div class="row">
						<div class="col-md-6">
							<label class="control-label col-md-6">Item Code</label>
						</div>
							<div class="col-md-6">
								<div class="input-icon right">
								<input class="form-control" placeholder=" Enter Item code" required name="icode" autocomplete="off" type="text" value="<?php echo $icode;?>">
								</div>
								
								</div>
							</div>
						</div>
						
					</div>	<span class="help-block">
						 </span>
						</div>
							<div class="form-group">
													<div class="row">
						<div class="col-md-6">
						<div class="row">
						<div class="col-md-6">
							<label class="control-label col-md-6">Description</label>
						</div>
							<div class="col-md-6">
								<div class="input-icon right">
								<input class="form-control" placeholder=" Enter Description" required name="des" autocomplete="off" type="text" value="<?php echo $des;?>">
								</div>
								
								</div>
							</div>
						</div><span class="help-block">
						 </span>
						<div class="col-md-6">
							<div class="row">
						<div class="col-md-6">
							<label class="control-label col-md-6">Price</label>
						</div>
							<div class="col-md-6">
								<div class="input-icon right">
								<input class="form-control" placeholder="Enter Price" required name="price" autocomplete="off" type="text" value="<?php echo $price;?>">
								</div>
								
								</div>
							</div>
						</div>
					</div><span class="help-block"> </span>	
							</div>
                        
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
	<a class="btn blue-madison red btn-sm"  rel="tooltip" title="Delete"  data-toggle="modal" href="#delete<?php echo $id ;?>"><i class="fa fa-trash"></i></a>								
			            <div class="modal fade" id="delete<?php echo $id ;?>" tabindex="-1" aria-hidden="true" style="padding-top:35px">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <span class="modal-title" style="font-size:14px; text-align:left">Are you sure, you want to delete this  category?</span>
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
</div></div>
</div></div></div></div></div></div>

</body>
<?php footer(); ?>

<?php scripts();?>

</html>
 

