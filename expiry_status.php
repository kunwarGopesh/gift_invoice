<?php
include("index_layout.php");
include("database.php");
?>
<html>
<head>
<?php css();?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Expiry Status</title>
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
						<i class="fa fa-gift"></i>Item Near Expiry
					</div>
				</div>
				<div class="portlet-body form">
				<!-- BEGIN FORM-->
					<form  class="form-horizontal" id="form_sample_2"  role="form" method="post"> 
						<table class="table">
						<thead>
									
								<tr style="background:#F5F5F5">
									<th>
										 #
									</th>
									<th> Item Name</th>
									<th> Item Code</th>
									<th>Expiry Date</th>
									<th>Expiry Status</th>							
								</tr>
						</thead>
								 <?php
					$r1=mysql_query("select * from master_items");		
			 	
					$i=0;
					while($row1=mysql_fetch_array($r1))
					{
					
					$exp_date=$row1['exp_date'];
					$today=date('Y-m-d');	   
					$date1=date_create($exp_date);
					$date2=date_create($today);
					$diff=date_diff($date2,$date1);
					$show= $diff->format("%r%a");
					if($show>0 && $show<180)
					{
						$i++;
					$id=$row1['id'];
					$name=$row1['item_name'];
					$icode=$row1['item_code'];
						?>
						<tbody>
								<tr>
									<td>
									<?php echo $i;?>
									</td>
									<td class="search">
									<?php echo $name;?>
									</td>
									<td class="search">
									<?php echo $icode;?>
									</td>
									<td class="search">
									<?php echo $exp_date;?>
									</td>
									<td class="search">
									<?php 
										
											echo "<b style='color:green'>".$show."&nbsp;Days Left</b>";
										
										?>
									</td> 
								</tr>
					<?php }}?>
							</tbody>
						</table>
					
					</form>
				</div>
			</div>
		</div>
	</div>
				<div class="row">
				<div class="col-md-12">
				<div class="portlet box red">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-gift"></i>Item  Expired [Dead Stock]
					</div>
				</div>
				<div class="portlet-body form">
				<!-- BEGIN FORM-->
					<form  class="form-horizontal" id="form_sample_2"  role="form" method="post"> 
						<table class="table">
						<thead>
									
								<tr style="background:#F5F5F5">
									<th>
										 #
									</th>
									<th> Item Name</th>
									<th> Item Code</th>
									<th>Expiry Date</th>
									<th>Expiry Status</th>							
								</tr>
						</thead>
								 <?php
					$r1=mysql_query("select * from master_items");		
			 	
					$j=0;
					while($row1=mysql_fetch_array($r1))
					{
					$exp_date=$row1['exp_date'];
					$today=date('Y-m-d');	   
					$date1=date_create($exp_date);
					$date2=date_create($today);
					$diff=date_diff($date2,$date1);
					$show= $diff->format("%r%a");
					if($show<0)
					{
						$j++;
						$id=$row1['id'];
						$name=$row1['item_name'];
						$icode=$row1['item_code'];
				?>
						<tbody>
								<tr>
									<td>
									<?php echo $j;?>
									</td>
									<td class="search">
									<?php echo $name;?>
									</td>
									<td class="search">
									<?php echo $icode;?>
									</td>
									<td class="search">
									<?php echo $exp_date;?>
									</td>
									<td class="search">
									<?php 
										
											echo "<b style='color:red'>"."Expired</b>";
										
										?>
									</td> 
								</tr>
					<?php }}?>
							</tbody>
						</table>
					</form>
						
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</body>
<?php footer();?>
<?php scripts();?>
</html>