<?php
include("index_layout.php");
include("database.php");
?>
<?php 
if(isset($_POST['sub']))
{
	$name=$_POST['name'];
	$code=$_POST['code'];
	$price=$_POST['price'];
	$catid=$_POST['category'];
	mysql_query("insert into `master_items` SET `item_name`='$name',`item_code`='$code',`item_price`='$price',`category_id`='$catid'");
		
	echo '<script>window.location="item.php"</script>';
}
if(isset($_POST['sub_edit']))
{
	$edit=$_REQUEST['edit_id'];  
	$name=mysql_real_escape_string($_REQUEST["name"]);
	$code=mysql_real_escape_string($_REQUEST["code"]);
	$price=mysql_real_escape_string($_REQUEST["price"]);
	$catid=mysql_real_escape_string($_REQUEST["category"]);
	//print_r($catid);exit;
	$r=mysql_query("update `master_items` SET `item_name`='$name',`item_code`='$code',
		`item_price`='$price',`category_id`='$catid' where `id`='$edit'" );
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
					<table class="table">
										<tr>
										<td>Choose Category</td><td>:</td>
										<td><select name="category" class="select2me form-control input-large " >
										<option >------------Select Item Category------------</option>
											<?php
												$sql=mysql_query("select id,category_name from master_category where flag='0'");
												
												while($row=mysql_fetch_array($sql))
												{?>		
														<option  value="<?php echo $row['id'] ;?>"><?php echo $row['category_name']; ?></option>
													<?php }?>
													</select></td>
										<td>Item Code</td><td>:</td>
										<td><input class="form-control input-large " placeholder="Enter Item Code" required name="code" autocomplete="off" type="text" value=""> </td>
										</tr>
										<tr>
										<td>Item Name</td><td>:</td>
										<td><input class="form-control input-large " placeholder="Enter Item Name" required name="name" autocomplete="off" type="text" value=""> </td>
										<td>Price</td><td>:</td>
										<td colspan="4" ><input class="form-control input-large " placeholder="Enter Item Price" required name="price" autocomplete="off" type="text" value=""> </td>
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
									<th>Category Name</th>
									<th> Item Name</th>
									<th>Item code</th>
									<th>Price   (&#8377;)</th>
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
					$price=$row1['item_price'];
					$catid=$row1['category_id'];
					
					
 					?>
                    <tbody>
								<tr>
									<td>
							<?php echo $i;?>
									</td>
									<td class="search">
									<?php echo fetchcategoryname($catid);?></td>
									<td class="search">
									<?php echo $name;?>
									</td>
									<td class="search">
									<?php echo $icode;?>
									</td>
                                    <td class="search">
									<?php echo $price;?>
									</td> 
									
									<td>  <a class="btn blue-madison green btn-sm" rel="tooltip" title="Edit" data-toggle="modal" href="#edit<?php echo $id;?>"><i class="fa fa-edit"></i></a>
                                        &nbsp;
	                                        <!--------editon-->
       <div class="modal fade" id="edit<?php echo $id ;?>" tabindex="-1" aria-hidden="true" style="padding-top:35px">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
						<div class="portlet box blue">
								<div class="portlet-title ">
									<div class="caption">
										<i class="fa fa-gift"></i>Edit Item
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>	
									</div>
								</div>
						</div>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                           <div class="portlet-body form">
							<form class="form-horizontal" role="form" id="noticeform" method="post" enctype="multipart/form-data">
                                <input type="hidden" name='edit_id' class="form-control" value="<?php echo $id;?>" >	
									<table class="table">
												<tr>
												<td>Choose Category</td><td>:</td>
												<td><select name="category" class="select2me form-control input-large " >
												<option value="<?php echo $catid;?>"><?php echo fetchcategoryname($catid);?></option>
													<?php
														$sql=mysql_query("select id,category_name from master_category where flag='0'");
														
														while($row=mysql_fetch_array($sql))
														{?>		
																<option  value="<?php echo $row['id'] ;?>"><?php echo $row['category_name']; ?></option>
															<?php }?>
															</select></td>
												<td>Item Code</td><td>:</td>
												<td><input class="form-control input-large " placeholder="Enter Item Code" required name="code" autocomplete="off" type="text" value="<?php echo $icode;?>"> </td>
												</tr>
												<tr>
												<td>Item Name</td><td>:</td>
												<td><input class="form-control input-large " placeholder="Enter Item Name" required name="name" autocomplete="off" type="text" value="<?php echo $name;?>"> </td>
												<td>Price</td><td>:</td>
												<td colspan="4" ><input class="form-control input-large " placeholder="Enter Item Price" required name="price" autocomplete="off" type="text" value="<?php echo $price;?>"> </td>
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
										<i class="fa fa-trash "></i>Are you sure, you want to delete this  Item?
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
</div></div>
</div></div></div></div></div></div>

</body>
<?php footer(); ?>

<?php scripts();?>

</html>
 

