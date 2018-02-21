<?php 
include("database.php");
$code=$_GET['i_code'];
$set=mysql_query("select `item_code` from `master_items` where `item_code`='$code'");
$row=mysql_fetch_array($set);
$count=mysql_num_rows($row);
if($count>0)
{
$item_code=$row['item_code'];	
?>
<td>
<input class="form-control input-large icode" placeholder="Enter Item Code" required name="code" autocomplete="off" type="text" value=""> 
This Item is already Exists,Please Try With New Item-Code.
</td>
<?php }else {
	?>
	<td>
	<input class="form-control input-large icode" placeholder="Enter Item Code" required name="code" autocomplete="off" type="text" value="<?php echo $item_code;?>"> </td>

<?php } ?>

