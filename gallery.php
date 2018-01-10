<?php
include("index_layout.php");
include("database.php");
require_once('ImageManipulator.php');  
$message="";
$insert_id=0;
if(isset($_POST['submitdasa']))
{
	$category_id=$_POST['category_id'];
	header("location:upload_gallery.php?category_id=".$category_id."");
}
if(isset($_POST['submit']))
{
	$category_id=mysql_real_escape_string($_REQUEST["category_id"]);
	$ftc_data=mysql_query("select * from `master_category` where  id='$category_id'" );
	$row=mysql_fetch_array($ftc_data);
	$category_name=$row['category_name'];
 	$directoryPath = "images/".$category_name."/";
	
	mkdir($directoryPath, 0777);
	$gallery_pic=array_filter($_FILES["gallery_pic"]["tmp_name"]);
	$o=sizeof($gallery_pic);
	$gp=0;
	for($j=0; $j<$o; $j++)
	{
		$newNamePrefix = rand(100, 10000);
		$gp=$gallery_pic[$j];
		$manipulator = new ImageManipulator($gp);
		$newImage = $manipulator->resample(640, 360);
		$manipulator->save($directoryPath . $newNamePrefix .".jpg");
		$insert_path=$directoryPath.$newNamePrefix.".jpg";
		$sql1="insert into gallery_photos(category_id,file_name)values('$category_id','$insert_path')"; 
		$rl=mysql_query($sql1);
	}
	 
 }   
?> 
<html>
<head>
<?php css();?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gallery</title>

<style>
.form-horizontal .radio > span{
	margin-top:-3px !important;
}
</style>

</head>
<?php contant_start(); menu();  ?>
<body>
<div class="page-content-wrapper">
 <div class="page-content">
	<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-gift"></i> Gallery
		</div>
		<div class="tools">
 		</div>
	</div>
	<div class="portlet-body form">
		<?php if($message!="") { ?>
		<div id="success" class="alert alert-success" style="margin-top:10px; width:50%">
		<?php echo $message; ?>
		</div>
		<?php } ?>
                        
							<form class="form-horizontal" role="form" id="form_sample_2" method="post" enctype="multipart/form-data">
								<div class="form-body">
								<div class="form-group">
										<label class="col-md-3 control-label">Select Category <span class="required" aria-required="true"> * </span></label>
										<div class="col-md-5">
                                        <select name="category_id" class="form-control select select2 select2me " placeholder="Select..." id="category_id" required>
                                         <option value=""></option>
                                            <?php
                                            $r1=mysql_query("select * from master_category where `flag`='0'");		
                                             
                                            while($row1=mysql_fetch_array($r1))
                                            {
                                            $id=$row1['id'];
                                            $category_name=$row1['category_name'];
                                            ?>
										<option value="<?php echo $id;?>"><?php echo $category_name;?></option>                              
									<?php }?> 
								  <select/>
								</div>
							</div>
						 
							
							<div class="form-group">
							<label class="col-md-3 control-label">Add Images <span class="required" aria-required="true"> * </span></label>
							<div class="col-md-6">
								<table style="width:100%;" class="table" id="parant_table">
									<tbody>
										<tr>
											
											<td>
												<input type="file" class="default form-control" name="gallery_pic[]" id="file1" required>
											</td>
											<td>
												&nbsp;<button type="button" onclick="add_row()" class="btn blue btn-sm"> <i class="fa fa-plus"></i></button>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class=" right1" align="center" style="margin-right:10px">
						<button type="submit" class="btn green" name="submit"><i class="fa fa-upload"></i> Upload</button>
					</div>
				</form>
			</div>
		</div>
	</div>
			
	<label class="col-md-3 control-label"> </label>
	<div class="col-md-7">
		<table id="sample" style="display:none;">
			<tbody>    
				<tr>
					<td>
						<input type="file" class="default form-control" name="gallery_pic[]" id="file1">
					</td>

					<td>
						<button type="button" onClick="add_row()" class="btn blue btn-sm"><i class="fa fa-plus"></i></button>
						<button type="button"  class="btn red btn-sm remove_row"><i class="fa fa-trash"></i></button>
					</td>
				</tr>
			</tbody> 
		</table>
	</div>
                                             
			
			</div>
</body>
<script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script>
 
	$(document).ready(function(){    
        $(".remove_row").die().live("click",function(){
            $(this).closest("#parant_table tr").remove();
        });
	});	
</script>
		
		
		
		
	});	
</script>
 
<script>
    function add_row(){  
        var new_line=$("#sample tbody").html();
            $("#parant_table tbody").append(new_line);
    }
</script>
<script>
var myVar=setInterval(function(){myTimerr()},4000);
		function myTimerr() 
		{
		$("#success").hide();
		} 
</script>






<?php footer();?>
<?php scripts();?>

</html>



Success!
