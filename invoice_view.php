<?php
include("index_layout.php");
include("database.php");
?>
<html>
<head>
<?php css();?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Master Category</title>
</head>
<?php contant_start(); menu();  ?>
<body>
	<div class="page-content-wrapper">
	<div class="page-content">
    <div class="row">
    <div class="col-md-6">
			<div class="portlet box blue">
			<div class="portlet-title">
			<div class="caption">
					<i class="fa fa-gift"></i>Master Category
				</div>
			</div>
			<div class="portlet-body form">
			<!-- BEGIN FORM-->
				<form  class="form-horizontal" id="form_sample_2"  role="form" method="post"> 
					<div class="form-body">
						 <div class="form-group">
							<label class="control-label col-md-3">Select Category</label>
							<div class="col-md-6">
								<div class="input-icon right">
								<i class="fa"></i>
								<select name="category_id" class="select2me form-control input-large " >
										<option >-------Select Item Category-------</option>
											<?php
												$sql=mysql_query("select id,category_name from master_category where flag='0'");
												
												while($row=mysql_fetch_array($sql))
												{?>		
														<option  value="<?php echo $row['id'] ;?>"><?php echo $row['category_name']; ?></option>
													<?php }?>
													</select>
								</div>
								
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3">Category Name</label>
							<div class="col-md-6">
								<div class="input-icon right">
								<i class="fa"></i>
								<input class="form-control input-large " placeholder="Please Enter Category Name" required name="class_name" autocomplete="off" type="text">
								</div>
								
							</div>
						</div>