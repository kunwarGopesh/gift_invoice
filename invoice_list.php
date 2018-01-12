<?php
include("index_layout.php");
include("database.php");
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
					<i class="fa fa-gift"></i>View Invoices
				</div>
			</div>
			<div class="portlet-body form">
			 <div class="table-scrollable">
								<table class="table   table-hover" width="100%" style="font-family:Open Sans;">
								<thead>	
								<tr style="background:#F5F5F5">
									<th>
										 #
									</th>
									<th> Invoice No</th>
									<th>Company Name</th>
									<th>Customer Name</th>
									<th>Item Name</th>
									<th>Invoice Date</th>
									<th>  Action
									</th>
								</tr>
								</thead>
							 <?php
									$r1=mysql_query("select * from invoices");		
										$i=0;
										while($row1=mysql_fetch_array($r1))
										{
										$i++;
										$invoice_no=$row1['id'];
										$company=$row1['company_id'];
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
									</td>
									<td class="search">
									<?php echo fetchcompanyname($company);?>
									</td>
									<td class="search">
									<?php echo fetchcustomername($name);?>
									</td>
									<td class="search">
									<?php echo fetchitemname($item);?>
									</td>
                                    <td class="search">
									<?php echo $date;?>
									</td> 
									<td>
										<a class="btn blue-madison blue-stripe btn-sm" rel="tooltip" title="View" data-toggle="modal" href="view_invoice.php"><i class="fa fa-list"></i></a>
										<a class="btn blue-madison red btn-sm" rel="tooltip" title="delete" data-toggle="modal" href="#delete<?php echo $id;?>"><i class="fa fa-remove"></i></a>
									</td>
									</tr>
										<?php }?>
										</table>
		</div>
	</div>
</body>
</html>