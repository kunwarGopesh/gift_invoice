<?php
include("index_layout.php");
include("database.php");
?>
<?php
if(isset($_POST['submit']))
		{	
			$item_id=$_POST['item_id'];
			$start_date=$_POST['start_date'];
			$end_date=$_POST['end_date'];
		}
?>

			 <?php
			  
					 
					//print_r($diff_show);
				 
 					?>
<html>
<head>
<?php css();?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Item Stock</title>
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
									<i class="fa fa-gift"></i>Search Stock
								</div>
							</div>
							<div class="portlet-body form">
							<form method="post" action="stock_details.php?mode=view" class="form-horizontal">
									<table class="table">
										<tr>
										<td>Select Item</td><td>:</td>
										<td>
										<select name="item_id" class=" form-control input-large select2me" >
										<option value="">----------Choose Item ----------</option>
											<?php
												$item_data=mysql_query("select `id`,`item_name` from master_items ");
												while($row=mysql_fetch_array($item_data))	
												{
													?>		
											<option value="<?php echo $row['id']?>">
											<?php echo $row['item_name']; ?></option>
											<?php }?>
										</select>
										</td>									
										</tr>
										<tr>
										<td>From</td><td>:</td>
										<td>
											<input class="form-control form-control-inline input-large date-picker date" placeholder="dd-mm-yyyy"  data-date-format="dd-mm-yyyy" size="16" autocomplete="off" type="text" name="start_date" > 
										</td>
										<td>To</td><td>:</td>
										<td>
											<input class="form-control form-control-inline input-large date-picker date" placeholder="dd-mm-yyyy"  data-date-format="dd-mm-yyyy" size="16" autocomplete="off" type="text" name="end_date" > 
										</td>
										</tr>
										<tr>
											<td colspan="8">
												<center>
													<input class="btn btn-primary" type="submit" name="submit" value="Submit">
												</center>
											</td>
										</tr>
									</table>
								</form>
							</div>
							
			 <?php if($_GET['mode']=='view') { ?>
							
							<div class="portlet-title ">
								<div class="caption">
									<i class="fa fa-gift"></i>Stock Details
								</div>
							</div>
							<div class="portlet-body form">
								
									<table class="table">
										<thead>
											<tr>
												<th>Sr.No</th>
												<th>Item Name</th>
												<th>Purchase Qty</th>
												<th>Sale Qty</th>
												<th>Remaining Qty</th>
												<th>Purchase Rate</th>
												<th>Stock Amount (&#8377;)</th>
												<th>Status</th>

												
											</tr>
										</thead>
		<?php
					
						$q1="";	$q2="";	 $q3=""; $q4=""; $qry="";
						if(!empty($_POST['item_id']))
						{
						$item_id=$_POST['item_id'];
						$q1=" item_id='".$item_id."'";
						}
						if(!empty($_POST['start_date']))
						{
						$date_from=date('Y-m-d', strtotime($_POST['start_date']));
						 
						if($q1=="")
						$q2=" `transaction_date`>='".$date_from."'";
						else 
						$q2=" AND `transaction_date`>='".$date_from."'";
						}
						
						if(!empty($_POST['end_date']))
						{
						$date_to=date('Y-m-d', strtotime($_POST['end_date']));
						if($q1=="" && $q2=="")
						$q3=" `transaction_date`<='".$date_to."'";
						else 
						$q3=" AND `transaction_date`<='".$date_to."'";
						}
						if($q1=="" && $q2=="" && $q3=="")
						{
						$qry="SELECT * from `item_ledgers` ";
						}
						else
						{
							$qry="SELECT * from `item_ledgers` WHERE ";
						}
						$q4=" group by `item_id`";
						 $sql=$qry.$q1.$q2.$q3.$q4;
						
						$ledger=mysql_query($sql);
		$i=0;
		$total_P_qty=0;
			$total_S_qty=0;
			$total_R_qty=0;
			$total_Stock_amount=0;
		while($row=mysql_fetch_array($ledger))
		{
			$i++;
			$id=$row['id'];	
			$item_id=$row['item_id'];	
			
					$r1=mysql_query("select * from master_items where `id`='$item_id'");		
					while($row1=mysql_fetch_array($r1))
					{		
					$purchase_rate=$row1['purchase_rate'];
					$purchase_qty=0;
					$sale_qty=0;
					$stock_qty=0;
					$stock_amount=0;
						$set=mysql_query("select `qty`,`status` from `item_ledgers` where `item_id`='$item_id'");
						while($fet=mysql_fetch_array($set))
						{
							$qty=$fet['qty'];
							$status=$fet['status'];
							if($status=='in')
							{
								$purchase_qty+=$qty;
							}
							else
							{
								$sale_qty+=$qty;
							}
						}
						$total_P_qty+=$purchase_qty;
						$total_S_qty+=$sale_qty;
						$stock_qty=$purchase_qty-$sale_qty;
						$total_R_qty+=$stock_qty;
						$stock_amount=$stock_qty*$purchase_rate;
						$total_Stock_amount+=$stock_amount;
		?>
										<tbody>
											<tr>
												<td><?php echo $i;?></td>
												<td><?php echo fetchitemname($item_id);?></td>
												<td><?php echo $purchase_qty;?></td>
												<td><?php echo $sale_qty;?></td>
												<td><?php echo $stock_qty;?></td>
												<td ><?php echo $purchase_rate;?></td>
												<td>
												<?php echo $stock_amount;?></td>
												<td>
													<?php 
													if($purchase_qty>$sale_qty)
													{
														echo "<b style='color:green'>"."In Stock"."</b>";
													}
													elseif($purchase_qty>=$sale_qty)
													{
															echo "<b style='color:red'>"."Out Of Stock"."</b>";
													}
													
													?>
												</td>
												
												
											</tr>
					<?php }}}?>
										</tbody>
										<tfoot>
											<tr style="background-color:#DCD9D8;">
												<th colspan="2" style="text-align:center">Grand Total</th>
												<th><?php echo $total_P_qty;?></th>
												<th><?php echo $total_S_qty;?></th>
												<th ><?php echo $total_R_qty;?></th>
												<th ></th>
												<th colspan="2"><?php echo $total_Stock_amount;?></th>
												
											</tr>
										</tfoot>
									</table>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
</body>
<?php footer(); ?>
<?php scripts(); ?>
</html>