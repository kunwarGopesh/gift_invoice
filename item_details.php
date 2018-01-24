<?php 
include("database.php");
$c_id=$_GET['c_id'];
$set=mysql_query("select `id`,`item_name`,`sale_price`,`item_code`	 from `master_items` where `category_id`='$c_id'");
$row=mysql_fetch_array($set);
$code=$row['item_code'];
$price=$row['sale_price'];
//$chk=$_GET['chk'];
//$next_chk=$chk+1;
?>

										
<select name="item" id="itm_id" class="select2me form-control input-medium">
<option value="">----Select--Please----</option>
<?php

$set=mysql_query("select id,item_name from `master_items` where `category_id`='$c_id'");
while($row=mysql_fetch_array($set))
{?>		
	<option value="<?php echo $row['id'] ;?>" price="<?php echo $price; ?>" cd="<?php echo $code; ?>" ><?php echo $row['item_name']; ?></option>
	<?php }?>
</select>
<script>
 			
			$(".icode").attr( 'readonly', 'readonly' );
			$(".rate").attr( 'readonly', 'readonly' );
			
	
</script>

				

																			
																			
																			