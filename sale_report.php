<?php
include("index_layout.php");
include("database.php");
?>
<?php
if(isset($_POST['submit']))
		{	
			$start_date=$_POST['start_date'];
			$end_date=$_POST['end_date'];
		}
?>
<html>
<head>
<?php css();?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sales Report</title>
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
									<i class="fa fa-gift"></i>Sales Report
								</div>
							</div>
							<div class="portlet-body form">
							<form method="post" action="sale_report.php?mode=view" class="form-horizontal">
									<table class="table">
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
									<i class="fa fa-gift"></i>Sales Report
								</div>
							</div>
							<div class="portlet-body form">
								
									<table class="table">
										<thead>
											<tr>
												<th>Sr.No</th>
												<th>Item Name</th>
												<th>Sale Qty</th>
												<th>Sale Price (&#8377;) </th>
												<th>Total Amount (&#8377;)</th>
												<th>Date Of Sale</th>
												
											</tr>
										</thead>
		<?php
					
						$q2="";	 $q3=""; $q4=""; $qry="";

						if(!empty($_POST['start_date']))
						{
						$date_from=date('Y-m-d', strtotime($_POST['start_date']));
						$q2=" `transaction_date`>='".$date_from."'";
						}
						else
						{
						$q2=" AND `transaction_date`>='".$date_from."'";
						}
						if(!empty($_POST['end_date']))
						{
						$date_to=date('Y-m-d', strtotime($_POST['end_date']));
						if($q2=="")
						{
						$q3=" `transaction_date`<='".$date_to."'";
						}
						else 
						{
						$q3=" AND `transaction_date`<='".$date_to."'";
						}
						if($q2=="" && $q3=="")
						{
						$qry="SELECT * from `item_ledgers` ";
						}
						else
						{
							$qry="SELECT * from `item_ledgers` WHERE ";
						}
						
						$q4=" group by `item_id`";
						 $sql=$qry.$q2.$q3.$q4;
						
						$ledger=mysql_query($sql);
		$i=0;
		$total_quantity=0;
		$gtotal_sale_price=0;
		$gtotal_sale_amount=0;
		while($row=mysql_fetch_array($ledger))
		{
			$i++;
			$id=$row['id'];	
			$item_id=$row['item_id'];	
			$tran_date=$row['transaction_date'];
			$org_date=date('d-M-Y', strtotime($tran_date));
			$set=mysql_query("select `sale_rate` from `master_items` where `id`='$item_id'");
			$price=mysql_fetch_array($set);
			$sale_quantity=0;
			$total_amount=0;
			
							$set=mysql_query("select `qty` from `item_ledgers` where `item_id`='$item_id' && `status`='out'");
						
							while($fet=mysql_fetch_array($set))
							{
							$qty=$fet['qty'];
							$sale_quantity+=$qty;
							}
							$total_quantity+=$sale_quantity;
							$total_amount=$sale_quantity*$price['sale_rate'];
							$gtotal_sale_price+=$price['sale_rate'];
							$gtotal_sale_amount+=$total_amount;
							
		?>
										<tbody>
											<tr>
												<td><?php echo $i;?></td>
												<td><?php echo fetchitemname($item_id);?></td>
												<td><?php echo $sale_quantity;?></td>
												<td><?php echo $price['sale_rate'];?></td>
												<td><?php echo $total_amount;?></td>
												<td><?php echo $org_date;?></td>
												
												
											</tr>
			 <?php }}}?>
										</tbody>
										<tfoot>
											<tr style="background-color:#DCD9D8;">
												<th colspan="2" style="text-align:center">Grand Total</th>
												<th><?php echo $total_quantity;?></th>
												<th><?php echo $gtotal_sale_price;?></th>
												<th colspan="2"><?php echo $gtotal_sale_amount;?></th>
												
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