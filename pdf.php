<?php require_once('config.php') ;?>
<?php 
$idd=$_GET['id'];
$result=$mysqli->query("SELECT * FROM member_transuction where id='".$idd."'");
$row=mysqli_fetch_row($result);

?>


<?php
$html = '
<html>
<head>
  <style>
 
	.table_rows, .table_rows td {
	    border: 1px solid  #000; 
		border-collapse: collapse;
		padding:5px; 

	}
	
	
	
	p.indent{ padding-lef:1.8em}
	
	</style>
</head>
<body>

			<table width="100%" class="table_rows">
				<tr>
					<td valign="top">
						<table width="100%">
							<tr style="background-color:gray;">
								<td style="border:none;">
								<center><b style="color:white;">TAX INVOICE</b></center></td>					
							</tr>
							<tr>
								<td style="border:none;">
									<p>	
								'.$row[3].'<br>
							'.$row[4].'<br>
								
								GSTIN :	</p><br><br><br>
								</td>
							</tr>
						</table>
						
					</td>
					
					<td width="50%" colspan="2"  valign="top">
					
					
	     			<center><div><img src="img/logo.jpg" height="100px" width="100px" /></div></center><br>
					
					
					<div><b>Address:</b>&nbsp;&nbsp;UDAIPUR BRANCH OF CIRC OF ICAI “ICAI BHAWAN”
						Near CA Circle, G-Block, 
						Sec. 14, Hiran Magri,
						Udaipur (Raj), 313001</div>
					</td>
					
				</tr>	
				
				
				<tr>
					<td width="50%" height="50%" align="left"> Transaction No:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row[8].'<br/><br/>
				Transaction Date:&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.date("d-m-Y",strtotime($row[10])).'<br/>
				</td>
				<td style="padding-top:-30px;" colspan="2">Inv. No:&nbsp;'.$row[11].' &nbsp; &nbsp; &nbsp;&nbsp;
				<span>&nbsp;&nbsp;Date: &nbsp;&nbsp;&nbsp;'.date("d-m-Y",strtotime($row[10])).'</span></td>
				</tr>
				
				
				<tr>
					<td style="border-right-color: #2EFEC8; background-color:#2EFEC8;">Particulars &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;HSN NO</td>
			
							
					<td colspan="2" style="background-color:#2EFEC8;"><table cellspacing="0" cellpadding="1"><thead><tr>
					
					<th> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<th> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Rate &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
					<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Amount</th>
					</tr>
							</thead>
							</table>
					</td>	
				
				</tr>
				
				 
				<tr>
				<td colspan="3" height="200px" valign="top" >'.$row[12].' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row[13].'
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				
				'.$row[14].'
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row[9].'<br>
				
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

	</body>
	</html>
	$html=';
//echo $html; exit;
include("mpdf/mpdf.php");
$mpdf=new mPDF("c"); 
//$mpdf->loadHtml($html);
$mpdf->WriteHTML($html);
$mpdf->Output();
exit;

  ?>