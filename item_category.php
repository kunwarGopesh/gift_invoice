<?php 
include("database.php");
$c_id=$_GET['c_id'];
$rowCount=$_GET['rowCount'];
$sets=mysql_query("select `id`,`category_name` from `master_category` where `parent_id`='$c_id'");
$count=mysql_num_rows($sets);
if($count>0){
$chk=$_GET['chk'];
$next_chk=$chk+1;

?>

										
<select name="category" chk="<?php echo $next_chk; ?>" id="category_id" class="select2me form-control input-medium srch">
<option value="">----Select--Please----</option>
<?php

$set=mysql_query("select `id`,`category_name` from `master_category` where `parent_id`='$c_id'");
while($row=mysql_fetch_array($set))
{?>		
	<option value="<?php echo $row['id'] ;?>"><?php echo $row['category_name']; ?></option>
	<?php }?>
</select> 
									
			<div id="chk_<?php echo $rowCount; ?>_<?php echo $next_chk; ?>">	</div>				
<?php 
} ?>
																			
																			
																			