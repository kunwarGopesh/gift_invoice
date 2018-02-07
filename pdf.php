<?php
include("index_layout.php");
?>

<html>
<head>
  <style>
	.table_rows, .table_rows td {
	    border: 1px solid  #000; 
		border-collapse: collapse;
		padding:px; 
	}
	p.indent{ padding-lef:1.8em}
	
	</style>
<?php css();?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Item Master</title>
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
					<i class="fa fa-gift"></i>Invoice View
				</div>
			</div><br>
			<div class="portlet-body form">
			<table width="100%" class="table_rows">
				<tr width="100%" >
					<td width="50%" style="">
						<table width="100%" style="">
								<tr>
								<td width="100%" style="background-color:gray;">
								<center><p style="">Tax Invoice</p></center>
								</td>
								</tr>
							
							
							
							<tr>
								<td style="border:none;">
									<p style="padding:5px;">	To,<br>
								PHP POETS IT SOLUTIONS PVT. LTD.<br>
								'Shrikul', 91, Patho ki Magri, Near Sewashram<br>
								Udaipur - 313002 - RAJASTHAN<br><br>
								GST No :	123123</p>
								</td>
							</tr></table>
						
						
					</td>
					
					<td width="50%" colspan="2"  valign="top" >
					<table width="100%" style="border-color:white;border-style:solid;">
					<tr >
					<td width="20%" style="border-color:white;border-style:solid;"><img src="img/logo.jpg" height="100px" width="100px" /></td >
					<td width="80%" style="border-color:white;border-style:solid;"><h2 style="padding-left:50px;text-aligh:center;">PHP Poets
					Udaipur</h2><br>
					
						<i style="padding-left:40px;text-aligh:center;">(An ISO 9001:2008 Certified Company)</i>
						<p style="padding-left:30px;text-aligh:center;">Winner of the "BEST WEB DESIGN & SOFTWARE
						DEVELOPMENT COMPANY IN RAJASTHAN" Award</p>
					
					</td>
					</tr>
					</table>
					</td>
					
				</tr>	
				
				
				<tr>
					<td width="50%" height="30%" align="left">
					<table width="100%" style="border-color:white;border-style:solid;">
					<tr >
					<td width="30%" style="border-color:white;border-style:solid;">
					Customer Name <td style="border-color:white;border-style:solid;">:</td>
					</td>
					<td width="70%" style="border-color:white;border-style:solid;">
					Prakash Menariya
					</td>
					</tr>
					<tr >
					<td width="30%" style="border-color:white;border-style:solid;">
					Mobile No <td style="border-color:white;border-style:solid;">:</td>
					</td>
					<td width="70%" style="border-color:white;border-style:solid;">
					7821965299
					</td>
					</tr>
					</table>
					</td>
					<td width="50%" height="30%" align="right">
					<table width="100%" style="border-color:white;border-style:solid;">
					<tr >
					<td width="25%" style="border-color:white;border-style:solid;">
					Invoice No <td style="border-color:white;border-style:solid;">:</td>
					</td>
					<td width="25%" style="border-color:white;border-style:solid;">
					12345
					</td>
					<td width="25%" style="border-color:white;border-style:solid;">
					 Invoice Date <td style="border-color:white;border-style:solid;">:</td>
					</td>
					<td width="25%" style="border-color:white;border-style:solid;">
					16/01/2018
					</td>
					</tr>
					</table>
					</td>
				
				</tr>
				<tr>
					<td width="100%" height="50%" colspan="4">
					<table width="100%" style="border-color:white;border-style:solid;">
					
					<thead >
					<tr style="background-color:#DCD9D8;" height="30%">
					<th width="10%"  style="border:1px;border-style:solid;"> Sr.No </th>
					<th width="10%"  style="border:1px;border-style:solid;"> Item Category </th>
					<th width="10%"  style="border:1px;border-style:solid;"> Name </th>
					<th width="10%"  style="border:1px;border-style:solid;"> Code </th>
					<th width="10%"  style="border:1px;border-style:solid;">Qty </th>
					<th width="10%"	 style="border:1px;border-style:solid;">Price </th>
					<th width="10%"  style="border:1px;border-style:solid;">Amount </th>
					</tr>
					</thead>
					
					<tbody>
					<tr>
					<td width="20%">1</td>
					<td width="20%">asdasd</td>
					<td width="20%">asdasd</td>
					<td width="20%">asdasd</td>
					<td width="20%">asdasd</td>
					<td width="20%">asdasd</td>
					<td width="20%">asdasd</td>
					</tr>
					</tbody>
					</table>
					</td>

				
				</tr>

				<tr>
				<td><b style="font-family: Verdana, Geneva, sans-serif;font-size:13px;">GSTIN No: '.$row[15].'</b><br/><br/>Rupees in words : SIX HUNDRED TWO ONLY</td>
				<td colspan="2"><b>Total Amount </b> 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;
				510.00<br><br>
				</td>
				</tr>
				
				
				
				<tr><td width="50%"  valign="bottom" align="left" style=" border-bottom-color: white;"></td><td colspan="2" >

				CGST @ 9.00 %
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;
				46.00<br/>
				 SGST @ 9.00 %&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;46.00</td></tr>
				<tr><td></td><td colspan="2">Net amount &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				602.00</td></tr>
				
				
				<tr rowspan="4">
				<td colspan="3"><b style="font-family:Verdana, Geneva, sans-serif;font-size:12px;">
				TERMS & CONDITIONS:</b>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				
				<b style="font-family:Verdana, Geneva, sans-serif;font-size:13px;">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;For Udaipur Branch of CIRC of ICAI</b>
				<br/>* Interest @ 18% PA will be charged if payment not<br> 
				recevied within 15 days from the date of Invoice.<br/>* Subject to Udaipur Jurisdiction Only<br/>* E & O E<br/><br>Remarks:<br><br><br>
				<b>Signature of Customer</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<b style="FONT-FAMILY: Verdana, Geneva, sans-serif; font-size:12px;">This is computer print out and do not require a signature</b></td>
				</tr>
				
				<tr>
				<td colspan="3"><center><p>
				UDAIPUR BRANCH OF CIRC OF ICAI “ICAI BHAWAN” <br>Near CA Circle, G-Block, 
						Sec. 14, Hiran Magri,
						Udaipur (Raj), 313001<br>
				
				Phone : +91 294 – 2641616, +91 294 – 2641515, Email :udaipur@icai.org</p></center></td>
				</tr>	
		</table>
</div></div></div></div></div></div>
	</body>
	</html>
	