<?php 
include("database.php");

?>

										
									<select name="city_id" id="city_id" class="select2me form-control input-large select_state">
									<option value="">----------Choose City----------</option>
									<?php
									$c_id=$_GET['reg_no'];
									$set=mysql_query("select city from `city_states` where `state`='$c_id'");
									while($row=mysql_fetch_array($set))
									{?>		
											<option value="<?php echo $row['city'] ;?>"><?php echo $row['city']; ?></option>
										<?php }?>
										</select> 
										