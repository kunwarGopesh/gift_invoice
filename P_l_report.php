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
<title>Profit & Loss Report</title>
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
									<i class="fa fa-gift"></i>Profit & Loss Report
								</div>
							</div>
							<div class="portlet-body form">
							<form method="post" action="P_l_report.php?mode=view" class="form-horizontal">
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
									<i class="fa fa-gift"></i>Profit & Loss	 Report
								</div>
							</div>
							<div class="portlet-body ">
								<div class="row">
									<div class="col-md-12"><br>
										<div class="col-md-6 ">
											<table class="table" style="border:1px;border-style:solid;">
												<thead>
													<tr style="border:1px;border-style:solid;background-color:#DCD9D8;">
														<th colspan="6" style="text-align:center;font-size:16px;">Purchase Details</th>
													</tr>
												</thead>
<?php
		$date_from=date('Y-m-d', strtotime($_POST['start_date']));
		$date_to=date('Y-m-d', strtotime($_POST['end_date']));
		$a=0;$b=0;$c=0;$d=0; $tot_dummy_dis_amount=0;
		$purchase=mysql_query("select * from `purchase_invoice` where `flag`='0' && `invoice_date` between '$date_from' and '$date_to'");
		/* $count=mysql_num_rows($purchase);
		if($count>0)
		{
		} */
		while($row=mysql_fetch_array($purchase))
		{
			$dis=$row['discount_amount'];	
			$net_amt=$row['amount_after_discount'];	
			$tot_tax=$row['total_tax'];	
			$amt_bef_dis=$row['total_amount_dis'];	
			$tot_amt=$row['grand_total'];	
			$dummy=$amt_bef_dis-$net_amt; 
			$tot_dummy_dis_amount+=$dummy;
			$a+=$dis;
			$b+=$net_amt;
			$c+=$tot_tax;
			$d+=$tot_amt;
			$e+=$amt_bef_dis;
		}
	
		?>
												<tbody>
													<tr>
														<td colspan="3"> Purchase Amount</td><td>:</td>
														<td colspan="2"><?php echo number_format($e,2);?> (&#8377;)</td>
													</tr>
													<tr>
														<td colspan="3">Discount</td><td>:</td>
														<td colspan="2"><?php echo number_format($tot_dummy_dis_amount,2); ?> (&#8377;)</td>
													</tr>
													<tr>
														<td colspan="3">Net Amount</td><td>:</td>
														<td colspan="2"><?php echo number_format($b,2);?> (&#8377;)</td>
													</tr>
					
													<tr>
														<td colspan="3">Tax</td><td>:</td>
														<td colspan="2"><?php echo number_format($c,2);?> (&#8377;)</td>
													</tr>
													<tr>
														<td colspan="3">Total Amount</td><td>:</td>
														<td colspan="2"><?php echo number_format($d,2);?> (&#8377;)</td>
													</tr>
												
												</tbody>
												<tfoot>
													<tr style="background-color:#DCD9D8;">
														<th colspan="3" style="text-align:center">Total Purchase</th>
														<th>:</th><th colspan="2"><?php echo number_format($d,2);?> (&#8377;)</th>
													</tr>
												</tfoot>
											</table>
									</div> 
									<div class="col-md-6">
											<table class="table" style="border:1px;border-style:solid;">
												<thead>
													<tr style="border:1px;border-style:solid;background-color:#DCD9D8;">
														<th colspan="6" style="text-align:center;font-size:16px;">Sale Details</th>
													</tr>
												</thead>
	<?php
		$date_from=date('Y-m-d', strtotime($_POST['start_date']));
		$date_to=date('Y-m-d', strtotime($_POST['end_date']));
		$a1=0;$b1=0;$c1=0;$d1=0;$total_dis=0;
		$purchase=mysql_query("select * from `sales_invoice` where `flag`='0' &&  `invoice_date` between '$date_from' and '$date_to'");
		while($row=mysql_fetch_array($purchase))
		{
			$dis=$row['discount_amount'];	
			$net_amt=$row['amount_after_discount'];	
			$tot_tax=$row['total_tax'];	
			$amt_bef_dis=$row['total_amount_dis'];	
			$tot_amt=$row['grand_total'];	
			$disc=$amt_bef_dis-$net_amt;
			$total_dis+=$disc;
			$b1+=$net_amt;
			$c1+=$tot_tax;
			$d1+=$tot_amt;
			$e1+=$amt_bef_dis;
		}
		?>
												<tbody>
													<tr>
														<td colspan="3"> Sale Amount</td><td>:</td>
														<td colspan="2"><?php echo number_format($e1,2);?> (&#8377;)</td>
													</tr>
													<tr>
														<td colspan="3">Discount</td><td>:</td>
														<td colspan="2"><?php echo number_format($total_dis,2);?> (&#8377;)</td>
													</tr>
													<tr>
														<td colspan="3">Net Amount</td><td>:</td>
														<td colspan="2"><?php echo number_format($b1,2);?> (&#8377;)</td>
													</tr>
					
													<tr>
														<td colspan="3">Tax</td><td>:</td>
														<td colspan="2"><?php echo number_format($c1,2);?> (&#8377;)</td>
													</tr>
													<tr>
														<td colspan="3">Total Amount</td><td>:</td>
														<td colspan="2"><?php echo number_format($d1,2);?> (&#8377;)</td>
													</tr>
												
												</tbody>
												
												<tfoot>
													<tr style="background-color:#DCD9D8;">
														<th colspan="3" style="text-align:center">Total Sale</th>
														<th>:</th><th colspan="2"><?php echo number_format($d1,2);?> (&#8377; )</th>
													</tr>
												</tfoot>

											</table>
								
									</div> 
								
								</div>
							</div>
					<div class="row">
						<div class="col-md-12">
						<table class="table">
							<thead>
								<tr style="text-align:center;border:1px;border-style:solid;background-color:#DCD9D8;">
								<th style="text-align:center;border:1px;border-style:solid;border-right-color:#DCD9D8;">Profil & Loss</th>
								<th style="border:1px;border-style:solid;border-right-color:#DCD9D8;">:</th>
								<th style="text-align:center;border:1px;border-style:solid;"> <?php echo (number_format($d1-$d,2));?>  (&#8377; )</th>
								</tr>
							</thead>
							</table>
						</div>
						</div>
						</div>
				</div>
			</section>
		</div>
			 <?php }?>
					
	</div>
</body>
<?php footer(); ?>
<?php scripts(); ?>
</html>
