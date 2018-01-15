<?php 
include("database.php");

?>

										
									<select name="category" id="category_id" class="select2me form-control input-large select_state">
									<option value="">----------Choose category----------</option>
									<?php
									$c_id=$_GET['catid'];
									$set=mysql_query("select category_name from `master_category` where `parent_id`='$c_id'");
									while($row=mysql_fetch_array($set))
									{?>		
											<option value="<?php echo $row['id'] ;?>"><?php echo $row['category_name']; ?></option>
										<?php }?>
									</select> 
										