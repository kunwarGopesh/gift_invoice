<?php
include("database.php");
@session_start();
$id=$_SESSION['id']; 
if(empty($id))
{
	header("location:login.php");
}

 function css() { ?>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
 
<!--<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>-->
<link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>

<link rel="stylesheet" type="text/css" href="assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>


<link rel="stylesheet" type="text/css" href="assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>

<!-- END GLOBAL MANDATORY STYLES -->
<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/datepicker3.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css"/>

<!-- BEGIN THEME STYLES -->
<link href="assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link id="style_color" href="assets/admin/layout/css/themes/darkblue.css" rel="stylesheet" type="text/css"/>
<link href="assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
<style>
.self-table > tbody > tr > td, .self-table > tr > td
{
	border-top:none !important;
}
.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
 
    vertical-align:middle !important;
}
option 
{
    border-top:1px solid #CACACA;
    padding:4px;
	cursor:pointer;
}

select 
{
	cursor:pointer;
}
.myshortlogo
{
	font: 15px "Open Sans",sans-serif;
	text-transform: uppercase !important;
	box-sizing:border-box;
}
.required{
	color: #ff2a2a !important;
}
</style>
<style media="print">
	.	
	{
		padding-left:2px;
		padding-right:2px;
		text-align:center;
		margin-top:-8%
	}
	.hide_print
	{
		display:none;
	}
</style>
<?php } ?>
<body class="page-header-fixed page-quick-sidebar-over-content page-style-square"> 
<?php 
function contant_start()
{
 ?>
<div class="page-header navbar navbar-fixed-top">
	<div class="page-header-inner">
		<div class="page-logo" >
			<a href="index.php" style="text-decoration:none;" >
				 
			</a>
			<div class="menu-toggler sidebar-toggler hide">
			</div>
		</div>
		<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
		</a>
		<div class="top-menu">
			<ul class="nav navbar-nav pull-right">
				<li class="dropdown dropdown-user">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<span class="username username-hide-on-mobile">
					<?php 
					@session_start();
					echo $name=$_SESSION['name'];
						$fac_id=$_SESSION['id'];
					?>
					 </span>
					<i class="fa fa-angle-down"></i>
					</a>
					<ul class="dropdown-menu dropdown-menu-default">
						<li>
							<a href="staff_search.php?user=<?php echo $fac_id; ?>">
							<i class="icon-user"></i> My Profile </a>
						</li>
						 
						<li>
							<a href="logout.php">
							<i class="icon-key"></i> Log Out </a>
						</li>
					</ul>
				</li>
				<!-- END USER LOGIN DROPDOWN -->
			</ul>
		</div>
		<!-- END TOP NAVIGATION MENU -->
	</div>
</div>
<div class="page-container">

<?php } ?>
	<?php 
function menu() {
?>
	<div class="page-sidebar-wrapper">
		<div class="page-sidebar navbar-collapse collapse">
			
			<ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
 				<li class="sidebar-toggler-wrapper">
 				</li>
				<?php  
				$page_name_from_url=basename($_SERVER['PHP_SELF']);
				$fac_id=$_SESSION['id'];
				$role_id=$_SESSION['role']; 
				$selecto7=mysql_query("select * from `user_management` where `role_id`='$role_id'");
				while($reco7=mysql_fetch_array($selecto7))
				{
					$mng_mdul_id[]=$reco7['module_id'];
				}
				//print_r($mng_mdul_id); exit;   
				$sel_module2=mysql_query("select `main_menu` from `	` where `page_name_url`='".$page_name_from_url."'");
				$arr_module2=mysql_fetch_array($sel_module2);
				$main_menu_active=$arr_module2['main_menu'];	
 			
				$selecto3=mysql_query("select * FROM `modules`");
				 
				while($data=mysql_fetch_array($selecto3))
				{
					 
					$main_menu_arr[]='';
					if(in_array($data['id'],$mng_mdul_id))
					{
						if(empty($data['main_menu']) && empty($data['sub_menu']))
						{
							
                            ?>
                            <li class="<?php if($page_name_from_url==$data['page_name_url']){ echo 'active'; } ?>">
  <a href="<?php echo $data['page_name_url']; ?>"><i class="<?php echo $data['icon_class_name']; ?>"></i><?php echo $data['name']; if($page_name_from_url==$data['page_name_url']){ echo '<span class="selected"></span>'; } ?></a>
                            </li>
							
                            <?php
                        }
                      
                        if(!empty($data['main_menu']) && empty($data['sub_menu']))
                        {
                            if(in_array($data['main_menu'], $main_menu_arr))
                            {
                               
                            }
                            else
                            {
                               $main_menu_arr[]=$data['main_menu'];
                                  ?>
                                <li class="<?php if($main_menu_active==$data['main_menu']){ echo 'active'; } ?>">
                                    <a href="javascript:;">
                                    <i class="<?php echo $data['main_menu_icon']; ?>"></i>
                                    <?php echo $data['main_menu']; ?> <span class="arrow"></span>					
					                <span class="selected"></span>
                                    </a>
                                    <ul  class="sub-menu">
                                    <?php
		$selecto4=mysql_query("select * FROM `modules` where `main_menu`='".$data['main_menu']."'");
									while($data_value=mysql_fetch_array($selecto4))
									{
										if(in_array($data_value['id'],$mng_mdul_id))
										{			
                                    
                                         ?>
                                                <li class="<?php if($page_name_from_url==$data_value['page_name_url']){ echo 'active'; } ?>">
                                                    <a href="<?php echo $data_value['page_name_url']; ?>"><?php echo $data_value['name']; ?></a>
                                                </li>
                                                <?php
										}
                                    }
                                    ?>
									
                                    </ul>
                                </li>
                                <?php
                            }
                        }
					 }
					  }
					  
					  ?>					  
			</ul>
			<!-- END SIDEBAR MENU -->
		</div>
	</div>
	
	<?php } ?>

<?php 
function footer()
{?>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
 
</div>
<?php } ?>
</body><?php 

function scripts()
{?>
<script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/bootstrap-daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script src="assets/global/plugins/jquery-notific8/jquery.notific8.min.js"></script>
<script src="assets/admin/pages/scripts/ui-notific8.js"></script>


<script type="text/javascript" src="assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>

<script src="assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="assets/admin/pages/scripts/form-icheck.js"></script>

<script src="assets/global/plugins/jquery.pulsate.min.js" type="text/javascript"></script> 
<script src="assets/admin/pages/scripts/table-managed.js"></script>
<script src="assets/admin/pages/scripts/components-pickers.js"></script>
<script type="text/javascript" src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/jquery-validation/js/additional-methods.min.js"></script>
<script src="assets/admin/pages/scripts/form-validation.js"></script>
<script src="assets/admin/pages/scripts/ui-general.js" type="text/javascript"></script>

<script>
jQuery(document).ready(function() {    
	Metronic.init(); // init metronic core components
	Layout.init(); // init current layout
	QuickSidebar.init(); // init quick sidebar
	Demo.init(); // init demo features
	UINotific8.init();
	FormValidation.init();
	TableManaged.init();
	ComponentsPickers.init();
	UIGeneral.init();
	FormiCheck.init(); // init page demo
	ComponentsDropdowns.init();
	
});
</script>

<script type="text/javascript">
setInterval(function(){ abc(); }, 3000);
function abc()
{	$('#msg_div').fadeOut(500);
	var delay = 500;
	setTimeout(function() {
	$('#msg_div').remove();
	}, delay);
}

</script>
<?php } ?>
<?php
function fetchrolename($id)
{
$result=mysql_query("select `role_name` from `master_role` where `id`='".$id."'");
$row=mysql_fetch_array($result);
$name = $row['role_name'];
return($name);
}
function fetchcategoryname($id)
{
$result=mysql_query("select `category_name` from `master_category` where `id`='".$id."'");
$row=mysql_fetch_array($result);
$name = $row['category_name'];
return($name);
}
function fetchcustomername($id)
{
$result=mysql_query("select `customer_name` from `customer` where `id`='".$id."'");
$row=mysql_fetch_array($result);
$name = $row['customer_name'];
return($name);
}
function fetchsuppliername($id)
{
$result=mysql_query("select `supplier_name` from `supplier` where `id`='".$id."'");
$row=mysql_fetch_array($result);
$name = $row['supplier_name'];
return($name);
}
function fetchitemname($id)
{
$result=mysql_query("select `item_name` from `master_items` where `id`='".$id."'");
$row=mysql_fetch_array($result);
$name = $row['item_name'];
return($name);
}
function fetchcompanyname($id)
{
$result=mysql_query("select `name` from `companies` where `id`='".$id."'");
$row=mysql_fetch_array($result);
$name = $row['name'];
return($name);
}
?>