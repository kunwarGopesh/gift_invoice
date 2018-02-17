<?php
include("index_layout.php");
include("database.php");
?>
<?php
if(isset($_POST['submit']))
		{	
			$supplier_id=$_POST['supplier_id'];
		}
		if(isset($_POST['new_submit']))
		{	
			$supp_id=$_POST['supp_id'];
			$new_amount=$_POST['new_amount'];
			$final_amount=$new_amount;
			$set=mysql_query("select * from `purchase_invoice` where `due_amount`>'0' && `supplier_id`='$supp_id'");
			while($fet=mysql_fetch_array($set))
			{
				$bill_id=$fet['id'];
				$paid=$fet['cash_amount'];
				$due=$fet['due_amount'];
				if($final_amount>0){
					if($due<=$final_amount){
						$cash_amount=$paid+$due;
						$due_amount=0;
						$final_amount=$final_amount-$due;
						
						mysql_query("update `purchase_invoice` SET `cash_amount`='$cash_amount',`due_amount`='$due_amount' where `id`='$bill_id'");
					}else if($due>$final_amount){
						$due_amount=$due-$final_amount;
						$cash_amount=$paid+$final_amount;
						$final_amount=0;
						mysql_query("update `purchase_invoice` SET `cash_amount`='$cash_amount',`due_amount`='$due_amount' where `id`='$bill_id'");
					}
				}
			}
		}
?>
<html>
<head>
<?php css();?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Supplier Basis Report</title>
</head>
<?php contant_start(); menu(); ?>
<body>
	<div class="page-content-wrapper">
		<div class="page-content">
			<section class="content">
				<div class="row">
					<div class="col-md-12">
						<div class="portlet box blue">
						<div class="portlet-title ">
								<div class="caption">
									<i class="fa fa-gift"></i>Search Supplier
								</div>
							</div>
							<div class="portlet-body form">
							<form method="post" action="supplier_report.php?mode=view" class="form-horizontal">
									<table class="table">
										<tr>
										<td>Select Supplier</td><td>:</td>
										<td>
										<select name="supplier_id" class="form-control input-large select_supplier" >
										<option value="">----------Choose supplier ----------</option>
											<?php
												$item_data=mysql_query("select `supplier_id` from `purchase_invoice` group by `supplier_id`");
												while($row=mysql_fetch_array($item_data))	
												{
													$c_id=$row['supplier_id'];
													?>		
											<option value="<?php echo $row['supplier_id']?>">
											<?php echo fetchsuppliername($c_id); ?></option>
											<?php }?>
										</select>
										</td>									
										</tr>
										
										<tr>
											<td colspan="8">
												<center>
													<input class="btn btn-primary" type="submit" name="submit" value="Search">
												</center>
											</td>
										</tr>
									</table>
								</form>
							</div>
							
			 <?php if($_GET['mode']=='view') { ?>
							
							<div class="portlet-title ">
								<div class="caption">
									<i class="fa fa-gift"></i>Supplier Sale Records
								</div>
							</div>
							<div class="portlet-body form">														
		<?php
					
						$q1="";	$q2="";	 $qry="";
						if(!empty($_POST['supplier_id']))
						{
						$supplier_id=$_POST['supplier_id'];
						$q1=" supplier_id='".$supplier_id."'";
						}
						if($q1=="" )
						{
						$qry="SELECT * from `purchase_invoice` ";
						}
						else
						{
							$qry="SELECT * from `purchase_invoice` WHERE ";
						}
						$q2=" group by `id`";
						 $sql=$qry.$q1.$q2;
						$ledger=mysql_query($sql);
						$count=mysql_num_rows($ledger);
						if($count>0)
						{ 
					?>
					<table class="table">
										<thead>
											<tr>
												<th>Sr.No</th>
												<th>Supplier Name</th>
												<th>Invoice No</th>
												<th>Date of Sale</th>
												<th>Grand Total</th>
												<th>Cash Amount</th>
												<th>Due Amount (&#8377;)</th>
											</tr>
										</thead>
				<?php 
					$i=0;	
					$final_grand_total=0;
					$total_cash=0;
					$total_due=0;
				while($row=mysql_fetch_array($ledger))
				{
					$i++;
					$id=$row['id'];	
					$supplier_ids=$row['supplier_id'];	
					$invoice_id=$row['id'];	
					$invoice_date=$row['invoice_date'];	
					$date_of_sale=date('d-M-Y', strtotime($invoice_date));
					$grand_total=$row['grand_total'];	
					$cash_amount=$row['cash_amount'];	
					$due_amount=$row['due_amount'];
					$final_grand_total+=$grand_total;					
					$total_cash+=$cash_amount;					
					$total_due+=$due_amount;					
					?>
										<tbody>
													<tr>
														<td><?php echo $i;?></td>
														<td><?php echo fetchsuppliername($supplier_ids);?></td>
														<td><?php echo $invoice_id;?></td>
														<td><?php echo $date_of_sale;?></td>
														<td><?php echo number_format($grand_total,2);?></td>
														<td ><?php echo number_format($cash_amount,2)?></td>
														<td>
														<?php echo number_format($due_amount,2);?></td>
													</tr>
				<?php  }?>
												</tbody>
											<tfoot>
						
											<form method="post"  class="form-horizontal">
												<tr style="background-color:#BB968E;">
													<th colspan="4" style="text-align:center">Grand Total</th>
													<th><?php echo number_format($final_grand_total,2);?></th>
													<th><?php echo number_format($total_cash,2);?></th>
													<th ><?php echo number_format($total_due,2);?></th>
						
												</tr>
												<?php if((!empty($supplier_id)) && ($total_due>0)) { ?>
												<tr style="background-color:#E6B0AA;">
												<td colspan="4"></td>
												<td >Enter New Amount</td><td>:</td>
												<td>
												<input class="form-control input-small new_amt"type="text" name="new_amount" org_price=<?php echo $total_due;?>>
												</td>
												</tr>
												<tr style="background-color:#E6B0AA	;">
												<td colspan="4"></td>
												<td>Remaining Amount</td><td>:</td>
												<td>
												<input class="form-control input-small new_due_amt"type="text" name="new_due_amt" value=""/>
												<input type="hidden" name="supp_id" value="<?php echo $supplier_id; ?>">
												</td>
												</tr>
												<tr>
											<td colspan="6"></td>
											<td >				
													<input class="btn btn-primary" type="submit" name="new_submit" value="Submit">
											</td>
										</tr>
											</form>
						<?php } ?>
											</tfoot>
											</table>
				<?php  }
						else
						{
				  ?><br>
				  <table>
					 <tr>
						<td colspan="100">
						<P style="text-align:center;padding-left:400px;">
						No Record Found
						</p></td>
					 </tr>
				 </table>
				  
						<?php }} ?>	
										</div>
							</div>
					</div>
				</div>
					<div class="row">
						<div class="col-md-12">
							<div class="col-md-6">
							
							</div>
							<div class="col-md-6">
							
							</div>
						</div>
					</div>
			</section>
		</div>
	</div>
</body>
<?php footer(); ?>
<?php scripts(); ?>
<script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script>
			$(document).ready(function()
			{   
					
					$(document).on('keyup','.new_amt',function()
						{
							calculate_total();
						});
					function calculate_total()
						{
							var new_due_amt=0;
								var new_amt=eval($(".new_amt").val());
								var att_value=eval($(".new_amt").attr('org_price'));
								if(new_amt>att_value)
								{
									$(".new_amt").val(0);							
									$(".new_due_amt").val(att_value);
								}
								else
								{
									new_due_amt=att_value-new_amt;
									$(".new_due_amt").val(new_due_amt.toFixed(2));							
									$(".new_due_amt").attr( 'readonly', 'readonly' );
								}							
						}					
			
			 });

</script>
</html>