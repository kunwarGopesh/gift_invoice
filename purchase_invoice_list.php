<?php
include("index_layout.php");
include("database.php");
?>

<?php 
if(isset($_POST['sub_del']))
{
	$delet_class=$_POST['delet_class'];
	mysql_query("DELETE FROM `purchase_invoice` WHERE `id`='$delet_class'" );
	mysql_query("DELETE FROM `purchase_invoice_details` WHERE `purchase_invoice_id`='$delet_class'" );
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
			<div class="portlet-title ">
				<div class="caption">
					<i class="fa fa-gift"></i>View Purchase Invoices
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
									<th> Invoice No</th>
									<th>Company Name</th>
									<th>Supplier Name</th>
									<th>Total Amount</th>
									<th>Invoice Date</th>
									<th>  Action
									</th>
								</tr>
								</thead>
							 <?php
									$r1=mysql_query("select * from `purchase_invoice`");		
										$i=0;
										while($row1=mysql_fetch_array($r1))
										{
										$i++;
										$invoice_id=$row1['id'];
										$supplier_id=$row1['supplier_id'];
										$grand_total=$row1['grand_total'];
										$r2=mysql_query("select * from companies where `supplier_id`='$supplier_id'");
										$company_data=mysql_fetch_array($r2);	
										$company=$company_data['name'];
										$date=$row1['invoice_date'];
							?>
                    <tbody>
								<tr>
									<td>
										<?php echo $i;?>
									</td>
									<td class="search">
									<?php echo $invoice_id;?>
									</td>
									<td class="search">
									<?php echo $company;?>
									</td>
									<td class="search">
									<?php echo fetchsuppliername($supplier_id);?>
									<td class="search">
									<?php echo $grand_total;?>
									</td>
                                    <td class="search">
									<?php echo $date;?>
									</td> 
									<td>
										<a class="btn blue-madison blue-stripe btn-sm" rel="tooltip" title="View" data-toggle="modal" href="view_purchase.php?invoice_id=<?php echo $invoice_id;?>"><i class="fa fa-list"></i></a>
										<a class="btn blue-madison green btn-sm" rel="tooltip" title="View" data-toggle="modal" href="edit_invoice.php?invoice_id=<?php echo $invoice_id;?>"><i class="fa fa-edit"></i></a>
										<a class="btn blue-madison red btn-sm" rel="tooltip" title="delete" data-toggle="modal" href="#delete<?php echo $invoice_id;?>"><i class="fa fa-trash"></i></a>							
			  <div class="modal fade" id="delete<?php echo $invoice_id;?>" tabindex="-1" aria-hidden="true" style="padding-top:35px">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss	="modal" aria-hidden="true"></button>
                            <div class="portlet box red-sunglo">
								<div class="portlet-title ">
									<div class="caption">
										<i class="fa fa-trash "></i>Are you sure, you want to delete this  Invoice?
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>	
									</div>
								</div>
							</div>
                        </div>
                        <div class="modal-footer">
                        <form method="post" name="delete<?php echo $invoice_id ;?>">
                            <input type="hidden" name="delet_class" value="<?php echo $invoice_id; ?>" />
                            
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
										<?php }?>
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