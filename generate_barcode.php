<?php
include("index_layout.php");
include("database.php");
?>
<?php
if(isset($_POST['submit']))
		{	
			$item_id=$_POST['item_id'];
			$start_range=$_POST['start_range'];
			$end_range=$_POST['end_range'];
			/* echo "<pre>";
			print_r($_POST);
			echo "</pre>"; */
		}
?>
<html>
<head>
<?php css();?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Generate Barcode</title>
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
									<i class="fa fa-barcode" ></i>Generate Barcode
								</div>
							</div>
							<div class="portlet-body form">
							<form method="post" class="form-horizontal">
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
											<input class="form-control input-large " placeholder="Enter Start Range" autocomplete="off" type="text" name="start_range" > 
										</td>
										<td>To</td><td>:</td>
										<td>
											<input class="form-control input-large " placeholder="Enter End Range" autocomplete="off" type="text" name="end_range" > 
										</td>
										</tr>
										<tr>
											<td colspan="8">
												<center>
													<input class="btn btn-primary" formaction="barcode/barcode/barcode_generate.php" type="submit" name="submit" formtarget="_blank" value="Submit">
												</center>
											</td>
										</tr>
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