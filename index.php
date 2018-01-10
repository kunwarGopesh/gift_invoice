<?php 
include("index_layout.php"); 
include("database.php");
error_reporting(0);
@ini_set('display_errors',0);
ini_set('max_execution_time', 200000);
$user=$_SESSION['category'];
$session_id=$_SESSION['id'];
 ?>
<html>
<head>
<?php css();?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Dashboard</title>
<style>
.col-md-3 {
margin-top:10px
}
</style>
</head>
<?php contant_start(); menu();  ?>
<body>
	<div class="page-content-wrapper">
		<div class="page-content">

		</div>
	</div>
</body>
<?php footer();?>
<?php scripts();?>
</html>




