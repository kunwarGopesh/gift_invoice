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
			/* echo "<pre>";
			print_r($_POST);
			echo "</pre>";EXIT;  */

		}
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
							
			 <?php if($_GET['mode']=='view'){ ?>
							
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
						$q5=" group by `item_id`";
						 $sql=$qry.$q1.$q2.$q3.$q5;
						
						$ledger=mysql_query($sql);
		$i=0;
		
		while($row=mysql_fetch_array($ledger))
		{
			$i++;
			$id=$row['id'];	
			$item_id=$row['item_id'];
			
		$purchase_qty=0;
		$sale_qty=0;
		$stock_qty=0;
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
			$stock_qty=$purchase_qty-$sale_qty;
		?>
										<tbody>
											<tr>
												<td><?php echo $i;?></td>
												<td><?php echo fetchitemname($item_id);?></td>
												<td><?php echo $purchase_qty;?></td>
												<td><?php echo $sale_qty;?></td>
												<td><?php echo $stock_qty;?></td>
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
			 <?php }}?>
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