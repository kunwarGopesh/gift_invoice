<?php
include("index_layout.php");
include("database.php");
?>
<?php 
if(isset($_POST['sub']))
{
	$sess_id=$_SESSION['id'];
	$name=$_POST['name'];
	$code=$_POST['code'];
	$purchase_rate=$_POST['purchase_rate'];
	$sale_rate=$_POST['sale_rate'];
	$catid=$_POST['category'];
	$exp_date=$_POST['exp_date'];
/*  	echo "<pre>";
	print_r($_POST);
	echo "</pre>"; EXIT;  */
	mysql_query("insert into `master_items` SET `item_name`='$name',`item_code`='$code',`purchase_rate`='$purchase_rate',`sale_rate`='$sale_rate',`category_id`='$catid',`exp_date`='$exp_date',`created_by`='$sess_id'");	
	echo '<script>window.location="item.php"</script>';
}
if(isset($_POST['sub_edit']))
{
	$edit=$_REQUEST['edit_id'];  
	$name=mysql_real_escape_string($_REQUEST["name"]);
	$code=mysql_real_escape_string($_REQUEST["code"]);
	$purchase_rate=mysql_real_escape_string($_REQUEST["purchase_rate"]);
	$sale_rate=mysql_real_escape_string($_REQUEST["sale_rate"]);
	$catid=mysql_real_escape_string($_REQUEST["category"]);
	$exp_date=mysql_real_escape_string($_REQUEST["exp_date"]);

	$r=mysql_query("update `master_items` SET `item_name`='$name',`item_code`='$code',
		`purchase_rate`='$purchase_rate',`sale_rate`='$sale_rate',`category_id`='$catid',`exp_date`='$exp_date',`created_by`='$sess_id' where `id`='$edit'" );
	$r=mysql_query($r);
	echo '<script text="javascript">alert(Class Added Successfully")</script>';	
}
if(isset($_POST['sub_del']))
{
	$delet_class=$_POST['delet_class'];
	mysql_query("DELETE FROM `master_items` WHERE `id`='$delet_class'" );
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
										<td><select name="category" id="category_id" chk="1" class="select2me form-control input-large srch" >
										<option >------------Select Item Category------------</option>
											<?php
												$sql=mysql_query("select id,category_name from master_category where parent_id='0' && flag='0' ");
												
												while($row=mysql_fetch_array($sql))
												{?>		
														<option  value="<?php echo $row['id'] ;?>"><?php echo $row['category_name']; ?></option>
													<?php }?>
													
													</select>
													<span class="help-block">
													<div id="chk_1" >
													</div>
										</td>
										<td>Item Code</td><td>:</td>
										<td><input class="form-control input-large " placeholder="Enter Item Code" Enter Item Code" required name="code" autocomplete="off" type="text" value=""> </td>
										</tr>
										<tr>
										<td>Item Name</td><td>:</td>
										<td><input class="form-control input-large " placeholder="Enter Item Name" required name="name" autocomplete="off" type="text" value=""> </td>
										<td>Description</td><td>:</td>
										<td><textarea class="form-control input-large " placeholder="Enter Description Here"  name="desc" autocomplete="off" type="text" value="" rows="2"></textarea> </td>
										</tr>
										<tr>
										<td>Purchase Rate</td><td>:</td>
										<td>
										<input  class="form-control input-large " placeholder="Enter Purchase Price" required name="purchase_rate" autocomplete="off" type="text" value="" > 
										</td>									
										<span class="help-block"> </span>
										<td>Sale Rate</td><td>:</td>
										<td>
										<input  class="form-control input-large " placeholder="Enter Sale Price" required name="sale_rate" autocomplete="off" type="text" value="" > 
										</td>
										</tr>
										<tr>
										<td>Tax Percentage</td><td>:</td>
										<td>
										<input  class="form-control input-large " placeholder="Enter Tax Percentage" required name="tax_per" autocomplete="off" type="text" value="" > 
										</td>									
										<span class="help-block"> </span>
										<td>Tax Amount</td><td>:</td>
										<td>
										<input  class="form-control input-large " placeholder="Enter Tax Amount" required name="tax_amount" autocomplete="off" type="text" value="" > 
										</td>
										</tr>
										<tr>
										<td>Actual Purchase</td><td>:</td>
										<td>
										<input  class="form-control input-large " placeholder="Enter Actual Purchase" required name="actual_purchase" autocomplete="off" type="text" value="" > 
										</td>
										<td>Expiry date</td><td>:</td>
										<td>
										<input class="form-control form-control-inline input-large date-picker date" placeholder="dd-mm-yyyy" required data-date-format="dd-mm-yyyy" size="16" autocomplete="off" type="text" name="exp_date"> 
										</td>
										</td>
						
										</tr>
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
									<th>Purchase Rate ( &#8377; )</th>
									<th>Sale Rate( &#8377; )</th>
									<th>Expiry Date</th>
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
					$purchase_rate=$row1['purchase_rate'];
					$sale_rate=$row1['sale_rate'];
					$catid=$row1['category_id'];					
					$exp_date=$row1['exp_date'];
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
									<?php echo $purchase_rate;?>
									</td> 
									<td class="search">
									<?php echo $sale_rate;?>
									</td>
									<td class="search">
									<?php echo $exp_date;?>
									</td> 
									
									<td>  <a class="btn blue-madison green btn-sm" rel="tooltip" title="Edit" data-toggle="modal" href="#edit<?php echo $id;?>"><i class="fa fa-edit"></i></a>
                                        &nbsp;
	                                        <!--------editon-->
       <div class="modal fade" id="edit<?php echo $id ;?>" tabindex="-1" aria-hidden="true" style="padding-top:35px">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
						<div class="portlet box green">
								<div class="portlet-title ">
									<div class="caption">
										<i class="fa fa-gift"></i>Edit Item
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>	
									</div>
								</div>
						</div>
                           <div class="portlet-body form">
							<form class="form-horizontal" role="form" id="noticeform" method="post" enctype="multipart/form-data">
                                <input type="hidden" name='edit_id' class="form-control" value="<?php echo $id;?>" >	
									<table class="table">
												<tr>
												<td>Choose Category</td><td>:</td>
												<td><select name="category" class="select2me form-control input-large srch" >
												
													<?php
														$sql=mysql_query("select id,category_name from master_category where flag='0'");
														
														while($row=mysql_fetch_array($sql))
														{?>		
															<option  value="<?php echo $row['id'] ;?>"
															<?php if($catid==$row['id']){ echo "selected"; }?>>
															<?php echo $row['category_name']; ?></option>
												<?php   }?>
															</select></td>
												<td>Item Code</td><td>:</td>
												<td><input class="form-control input-large " placeholder="Enter Item Code" required name="code" autocomplete="off" type="text" value="<?php echo $icode;?>"> </td>
												</tr>
												<tr>
												<td>Item Name</td><td>:</td>
												<td><input class="form-control input-large " placeholder="Enter Item Name" required name="name" autocomplete="off" type="text" value="<?php echo $name;?>"> </td>
												<td>Purchase Rate</td><td>:</td>
												<td colspan="4" ><input class="form-control input-large " required name="purchase_rate" autocomplete="off" type="text" value="<?php echo $purchase_rate;?>"> </td>
												</tr>
												<span class="help-block"> </span>	
												<tr>
												<td>Sale Rate</td><td>:</td>
												<td ><input class="form-control input-large " required name="sale_rate" autocomplete="off" type="text" value="<?php echo $sale_rate;?>"> </td>
												<td>Expiry date</td><td>:</td>
												<td>
												<input class="form-control form-control-inline input-large date-picker date" placeholder="yyyy-mm-dd" required data-date-format="yyyy-mm-dd" size="16" autocomplete="off" type="text" name="exp_date" value="<?php echo $exp_date;?>"> 
												</td>
												</tr>
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
                            <div class="portlet box red-sunglo">
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
<script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
	<script>
			$(document).ready(function() {     
			 $(".srch").live('change', function () {
			 var cat_id=$(this, 'option:selected').val();
			 
			var chk=$(this, 'option:selected').attr('chk');
			
			if(cat_id>0){
				$.ajax({
					url: "category.php?c_id="+cat_id+"&chk="+chk,
					}).done(function(response) {
						$("#chk_"+chk).html(response);
					});
			}	
		 });
		
		 });
	</script>
<?php scripts();?>
</html>
 

