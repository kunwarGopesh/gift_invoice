<?php
include("index_layout.php");
include("database.php");
?>
<html>
<head>
<?php css();?>
<style>
 
	.table_rows, .table_rows td {
	    border: 1px solid  #000; 
		border-collapse: collapse;
		padding:5px; 

	}
	
	
	
	p.indent{ padding-lef:1.8em}
	
	</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Master Invoices</title>
</head>
<?php contant_start(); menu();  ?>
<body>
	<div class="page-content-wrapper">
		<div class="page-content">
			<section class="content">
				<div class="row">
					<div class="col-md-12">
						<div class="portlet box blue">
							<div class="portlet-title ">
								<div class="caption">
									<i class="fa fa-gift"></i>Create Invoice
								</div>
							</div>
								<table width="100%" class="table_rows">
									<tr>
										<td valign="top">
											<table class="table" >
												<tr style="background-color:gray;">
													<td><center><b style="color:white;">TAX INVOICE</b></center></td>
												</tr>
												<tr>
													<td ><span>PHP POETS IT SOLUTIONS PVT. LTD.<br>
													'Shrikul', 91, Patho ki Magri, Near Sewashram<br>
													Udaipur - 313002 - RAJASTHAN</span><br><br>
													<label>GSTIN</label><label>:</label>
													1233122
													</td>
													
													</tr>
											</table>
										</td>
										<td width="50%" colspan="2"  valign="top">
											<center>
												<div><img src="img/logo.jpg" height="100px" width="100px" /></div>
												
													</center>
											
										</td>
									</tr>
									<tr>
										<td width="50%" height="50%" align="left">
										Transaction No:'.$row[8].'<br/><br/>
										Transaction Date:'.date("d-m-Y",strtotime($row[10])).'<br/>
										</td>
										<td style="padding-top:-30px;" colspan="2">
											Inv. No:&nbsp;'.$row[11].'<span>'.date("d-m-Y",strtotime($row[10])).'</span>
										</td>
									</tr>
									<tr>
										<td style="border-right-color: #2EFEC8; background-color:#2EFEC8;">
											Particulars HSN NO
										</td>				
											<td colspan="2" style="background-color:#2EFEC8;">
												<table cellspacing="0" cellpadding="1">
													<thead>
															<tr>
																<th>Rate</th>
																<th>Amount</th>
															</tr>
													</thead>
												</table>
											</td>	
									</tr>
								</table>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
</body>
<?php footer(); ?>
<?php scripts();?>
</html>