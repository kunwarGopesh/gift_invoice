<?php
include("index_layout.php");
include("database.php");
?>

<html>
<head>
<?php css();?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Payment Ledgers</title>
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
									<i class="fa fa-gift"></i>Payment Report
								</div>
							</div>
							<div class="portlet-body form">
							
									<table class="table">
										<thead>
											<tr>
												<th>Sr.No</th>
												<th>Customer Name</th>
												<th>Deposit Amount (&#8377;)</th>
												<th>Date Of Transation </th>
											</tr>
										</thead>
<?php
$i=0;
$cust_id=$_GET['cust_id'];
$fet=mysql_query("SELECT * from `payment_transaction_ledgers` where `customer_id`='$cust_id'");
while($row=mysql_fetch_array($fet))
{
	$i++;
$customer_id=$row['customer_id'];
$amount=$row['amount'];
$transaction_date=$row['transaction_date'];
$date=date('d-M-Y',strtotime($transaction_date));
	
?>
								<tbody>
										<tr>
											<td><?php echo $i;?></td>
											<td><?php echo fetchcustomername($customer_id);?></td>
											<td><?php echo $amount;?></td>
											<td><?php echo $date;?></td>
										</tr>
<?php }?>
			
								</tbody>
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