<?php 
include("database.php");
$code=$_GET['icode'];
$purchase_qty=0;
$sale_qty=0;
$stock_qty=0;
$set=mysql_query("select `id`,`item_name`,`sale_rate` from `master_items` where `item_code`='$code'");
$row=mysql_fetch_array($set);
$item_id=$row['id'];
$item_name=$row['item_name'];
$price=$row['sale_rate'];
$set=mysql_query("select `qty`,`status` from `item_ledgers` where `item_id`='$item_id'");
								while($fet=mysql_fetch_array($set))
								{
									$qty=$fet['qty'];
									$status=$fet['status'];
									if($status=='in')
									{
										$purchase_qty+=$qty;
									}
									else
									{
										$sale_qty+=$qty;
									}
								}
								$stock_qty=$purchase_qty-$sale_qty;
	echo $item_id.",".$item_name.",".$price.",".$stock_qty;
?>

				

																			
																			
																			