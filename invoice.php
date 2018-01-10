<?php
include("index_layout.php");
include("database.php");
?>
<?php 
if(isset($_POST['sub']))
{
	$name=$_POST['customer'];
	$item=$_POST['item'];
	$date=$_POST['date'];
	//print_r($date);exit;
	mysql_query("insert into `invoices` SET `customer_id`='$name',`item_id`='$item',
		`invoice_date`='$date'");
	echo '<script>window.location="invoice.php"</script>';
}
 
if(isset($_POST['sub_del']))
{
	$delet_class=$_POST['delet_class'];
	mysql_query("DELETE FROM invoices WHERE id='$delet_class'" );
}

if(isset($_POST['sub_edit']))
{
	$edit=$_REQUEST['edit_id'];  
	$name=mysql_real_escape_string($_REQUEST["customer"]);
	$item=mysql_real_escape_string($_REQUEST["item"]);
	$date=mysql_real_escape_string($_REQUEST["date"]);
	$r=mysql_query("update `invoices` SET `customer_id`='$name',`item_id`='$item',
		`invoice_date`='$date' where id='$edit'"  );
	$r=mysql_query($r);
	echo '<script text="javascript">alert(Class Added Successfully")</script>';	
}




  ?> 
<html>
<head>
<?php css();?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Master Invoices</title>
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
					<i class="fa fa-gift"></i>Master Invoice
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
						<div class="col-md-4">
							<label class="control-label col-md-12">Customer Name</label>
						</div>
						<div class="col-md-8">
							<div class="input-icon right">
								<i class="fa"></i>
								<select name="customer" class="select2me form-control input-large ">
								<option  >----------Choose Customer ----------</option>
									<?php
									$sql=mysql_query("select id,customer_name from customer ");
									
									while($row=mysql_fetch_array($sql))
									{?>		
											<option  value="<?php echo $row['id'] ;?>"><?php echo $row['customer_name']; ?></option>
										<?php }?>
										</select>
											</div>
								</div></div></div>
						<span class="help-block"> </span>
						
						<div class="col-md-6">
						<div class="row">
						<div class="col-md-4">
							<label class="control-label col-md-8">Item Name</label>
						</div>
						<div class="col-md-8">
								<div class="input-icon right">
								<i class="fa"></i>
								<select name="item" class="select2me form-control input-large ">
								<option  >----------Choose Item ----------</option>
									<?php
									$sql=mysql_query("select id,item_name from master_items ");
									
									while($row=mysql_fetch_array($sql))
									{?>		
											<option  value="<?php echo $row['id'] ;?>"><?php echo $row['item_name']; ?></option>
										<?php }?>
										</select>
								</div>
							</div>	
						</div><span class="help-block"> </span>
					</div>	
					
						<div class="row">

						<div class="col-md-6">
						<div class="row">
						<div class="col-md-4">
							<label class="control-label col-md-12">Invoice Date</label>
						</div>
								<div class="col-md-8">
								<div class="input-icon right">
								<i class="fa"></i>
								<input class="form-control form-control-inline input-medium date-picker" placeholder="yyyy-mm-dd" required data-date-format="yyyy-mm-dd" size="16" autocomplete="off" type="text" name="date">
								</div>
								
								</div>
							</div>
						</div><span class="help-block"> </span>
						
					</div><br>
                        
						<div class="col-md-offset-5 col-md-6" style="">
								<button type="submit" name="sub" class="btn btn-primary">Submit</button>
						</div>
						 
						</br>
						</br>
						</div>
					</div>
				</form>
			
		</div>
            </div>
            <!-------------------------- View------------>
           <div class="row">
				<div class="col-md-12">
			<div class="portlet box blue">
			<div class="portlet-title ">
				<div class="caption">
					<i class="fa fa-gift"></i>View Invoices
				</div>
			</div>
			<div class="portlet-body form">
			 <div class="table-scrollable">
								<table class="table   table-hover" width="100%" style="font-family:Open Sans;">
								<thead>
									
								<tr style="background:#F5F5F5">
									<th>
										 Sr.No
									</th>
									<th> invoice No</th>
									<th> Customer Name</th>
									<th>Item Name</th>
									<th>Invoice Date</th>
									<th> Actions</th>
									</th>
								</tr>
								</thead>
							 <?php
			  $r1=mysql_query("select * from invoices");				
					$i=0;
					while($row1=mysql_fetch_array($r1))
					{
					$i++;
					$id=$row1['id'];
					$invoice_no=$row1['id'];
					$name=$row1['customer_id'];
					$item=$row1['item_id'];
					$date=$row1['invoice_date'];

 					?>
                    <tbody>
								<tr>
									<td>
							<?php echo $i;?>
									</td>
									<td class="search">
									<?php echo $invoice_no;?>
									</td><td class="search">
									<?php echo fetchcustomername($name);?></td>
									</td>
									<td class="search">
									<?php echo fetchitemname($item);?>	
									</td>
									<td class="search">
									<?php echo $date;?>
									</td> 
									<td>
									<a class="btn blue-madison blue btn-sm" rel="tooltip" title="View" data-toggle="modal" href="#view<?php echo $id;?>"><i class="fa fa-list"></i></a>&nbsp;
									<!--------view invoice details-->
		<div class="modal fade" id="view<?php echo $id ;?>" tabindex="-1" aria-hidden="true" style="padding-top:35px">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h3>View invoice details</h3>
							<?php  $r2=mysql_query("select * from  invoice_details");
							while($row1=mysql_fetch_array($r2))
					{
						
						$dis=$row1['discount_value'];
						$tax=$row1['taxable_value'];
						$roundoff=$row1['roundoff'];
						$total=$row1['grandtotal'];
							
						?>
							</div>
					<div class="modal-body">
                           <div class="portlet-body form">
							<form class="form-horizontal" role="form" id="noticeform" method="post" enctype="multipart/form-data">	
                       <input type="hidden" name='view_id' class="form-control" value="<?php echo $id;?>" >			
						<div class="form-body">
						<div class="row">
						<div class="col-md-6">
						<div class="row">
						<div class="col-md-6">
							<label class="control-label col-md-8">Invoice No</label>
						</div>
						<div class="col-md-6">
								<div class="input-icon right">
								<i class="fa"></i>
								<label class="control-label col-md-12"><?php echo $invoice_no;?></label>
				
								</div>
								</div></div>
						</div><span class="help-block"> </span>
						<div class="col-md-6">
						<div class="row">
						<div class="col-md-6">
							<label class="control-label col-md-8">Customer Name</label>
						</div>
						<div class="col-md-6">
								<div class="input-icon right">
								<i class="fa"></i>
								<label class="control-label col-md-12"><?php echo fetchcustomername($name);?></label>
				
								</div>
								</div></div>
						</div><span class="help-block"> </span>
						</div>						<div class="row">
						<div class="col-md-6">
						<div class="row">
						<div class="col-md-6">
							<label class="control-label col-md-8">Item Name </label>
						</div>
						<div class="col-md-6">
								<div class="input-icon right">
								<i class="fa"></i>
								<label class="control-label col-md-12"><?php echo fetchitemname($item);?></label>
				
								</div>
								</div></div>
						</div><span class="help-block"> </span>
						<div class="col-md-6">
						<div class="row">
						<div class="col-md-6">
							<label class="control-label col-md-8">Item Qty</label>
						</div>
						<div class="col-md-6">
								<div class="input-icon right">
								<i class="fa"></i>
								<label class="control-label col-md-12"><?php echo "10";?></label>
				
								</div>
								</div></div>
						</div><span class="help-block"> </span>
						</div>
												<div class="row">
						<div class="col-md-6">
						<div class="row">
						<div class="col-md-6">
							<label class="control-label col-md-8">Invoice Date</label>
						</div>
						<div class="col-md-6">
								<div class="input-icon right">
								<i class="fa"></i>
								<label class="control-label col-md-12"><?php echo $date;?></label>
				
								</div>
								</div></div>
						</div><span class="help-block"> </span>
						<div class="col-md-6">
						<div class="row">
						<div class="col-md-6">
							<label class="control-label col-md-8">Discount Amount</label>
						</div>
						<div class="col-md-6">
								<div class="input-icon right">
								<i class="fa"></i>
								<label class="control-label col-md-12"><?php echo $dis;?></label>
				
								</div>
								</div></div>
						</div><span class="help-block"> </span>
						</div>
												<div class="row">
						<div class="col-md-6">
						<div class="row">
						<div class="col-md-6">
							<label class="control-label col-md-8">taxable Amount</label>
						</div>
						<div class="col-md-6">
								<div class="input-icon right">
								<i class="fa"></i>
								<label class="control-label col-md-12"><?php echo $tax;?></label>
				
								</div>
								</div></div>
						</div><span class="help-block"> </span>
						<div class="col-md-6">
						<div class="row">
						<div class="col-md-6">
							<label class="control-label col-md-8">Round Off</label>
						</div>
						<div class="col-md-6">
								<div class="input-icon right">
								<i class="fa"></i>
								<label class="control-label col-md-12"><?php echo $roundoff;?></label>
				
								</div>
								</div></div>
						</div><span class="help-block"> </span>
						</div>							
						<div class="row">
						<div class="col-md-6">
						<div class="row">
						<div class="col-md-6">
							<label class="control-label col-md-8">Grand Total </label>
						</div>
						<div class="col-md-6">
								<div class="input-icon right">
								<i class="fa"></i>
								<label class="control-label col-md-12"><?php echo $total;?></label>
				
								</div>
								</div></div>
						</div><span class="help-block"> </span>
						</div>	
						</div></form></div></div></div></div></div>
			
					
									
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
							
							
                                <input type="hidden" name='edit_id' class="form-control" value="<?php echo $id;?>" >	
							
						<div class="form-body">
						<div class="form-group">
						<div class="row">
						<div class="col-md-4">
						<label class="control-label col-md-6">Customer Name</label>
						</div>
						<div class="col-md-8">
								<div class="input-icon right">
							
								<i class="fa"></i>
								<select name="customer" class="select2me form-control input-large ">
								<option ><?php echo fetchcustomername($name);?></option>
									<?php
									$sql=mysql_query("select id,customer_name from customer ");
									
									while($row=mysql_fetch_array($sql))
									{?>		
											<option  value="<?php echo $row['id'] ;?>"><?php echo $row['customer_name']; ?></option>
										<?php }?>
										</select>
											</div>
								</div></div>
						<span class="help-block"> </span>
						<div class="row">
						<div class="col-md-4">
							<label class="control-label col-md-6">Item Name</label>
						</div>
						<div class="col-md-8">
								<div class="input-icon right">
								<i class="fa"></i>
								<select name="item" class="select2me form-control input-large ">
								<option ><?php echo fetchitemname($item);?></option>
									<?php
									$sql=mysql_query("select id,item_name from master_items ");
									
									while($row=mysql_fetch_array($sql))
									{?>		
											<option  value="<?php echo $row['id'] ;?>"><?php echo $row['item_name']; ?></option>
										<?php }?>
										</select>
								</div>
							</div>	
						</div><span class="help-block"> </span>
						<div class="row">
						<div class="col-md-4">
							<label class="control-label col-md-6">Invoice Date</label>
						</div>
								<div class="col-md-8">
								<div class="input-icon right">
								<i class="fa"></i>
								<input class="form-control form-control-inline input-medium date-picker" placeholder="yyyy-mm-dd" required data-date-format="yyyy-mm-dd" size="16" autocomplete="off" type="text" name="date">
								</div>
								
								</div>
							</div>
							</div><br>
						
					</div>
					</div>
                        
						<div class=" right1" align="right" style="margin-right:10px">
						<center><button type="submit" class="btn green" name="sub_edit">Update</button></center>
						</div>
						</form>
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
					<?php }}?>
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
 

