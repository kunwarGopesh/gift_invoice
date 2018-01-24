<?php
include("index_layout.php");
include("database.php");
?>
<html>
<head>
<?php css();?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Item Ledgers</title>
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
									<i class="fa fa-gift"></i>Item Ledgers
								</div>
							</div>
							<div class="portlet-body form">
								<form method="POST" >
									<table class="table">
										<thead>
											<tr>
												<th>Sr.No</th>
												<th>Item Name</th>
												<th>Qty</th>
												<th>Vendor Source</th>
												<th>Vendor Id</th>
												<th>Status</th>
												<th>Transaction Date</th>
												
											</tr>
										</thead>
		<?php 
		$i=0;
		$ledger=mysql_query("select * from `item_ledgers` group by `item_id`,`status`");
		while($row=mysql_fetch_array($ledger))
		{
			$i++;
			$id=$row['id'];	
			$item_id=$row['item_id'];
			$qty=$row['qty'];
			$source=$row['voucher_source'];
			$voucher_id=$row['voucher_id'];
			$status=$row['status'];
			$date=$row['transaction_date'];
			$tot_qty=0;
			$set=mysql_query("select `qty` from `item_ledgers` where `item_id`='$item_id' && `status`='$status'");
			while($fet=mysql_fetch_array($set))
			{
			$fet_qty=$fet['qty'];	
			$tot_qty+=$fet_qty;
			}
		?>
										<tbody>
											<tr>
												<td><?php echo $i;?></td>
												<td><?php echo fetchitemname($item_id);?></td>
												<td><?php echo $tot_qty;?></td>
												<td><?php echo $source;?></td>
												<td><?php echo $voucher_id;?></td>
												<td><?php
												if($status=='in')
													{
														echo "<p style='color:green'>"."In "."</p>";
													}
													else
													{
															echo "<p style='color:red'>"."Out "."</p>";
													}


												?></td>
												<td><?php echo $date;?></td>
												
											</tr>
		<?php }?>
										</tbody>
									</table>
								</form>
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