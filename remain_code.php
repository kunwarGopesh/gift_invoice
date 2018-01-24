<!--<tr style="border:1px;border-style:solid;">
							<td style="border:1px;border-style:solid;text-align:right;" colspan="3">
								<?php $taxation_name=mysql_query("select id,name from taxations where id='1'");				$row=mysql_fetch_array($taxation_name);
											echo $row['name'];
								?>
								
							</td>
							<td style="border:1px;border-style:solid;text-align:right;">	
								<select class="select form-control input-small cgst_option" name="cgst_per">
									<option>%</option>
										<?php $sgst_data=mysql_query("select percentage from taxation_rates where taxation_id='1'");				
											while($row=mysql_fetch_array($sgst_data))
											{?>		
												<option value="<?php echo $row['percentage'] ;?>"><?php echo $row['percentage']; ?></option><?php
											 }?>
									
								</select>
							</td>
							<td style="border:1px;border-style:solid;">
								<input class="form-control cgst_amount " placeholder="CGST Amount" required name="cgst_amount" autocomplete="off" type="text">
							</td>
							<td colspan="1" style="border:1px;border-style:solid;">
								<input class="form-control amount_after_cgst" placeholder="Total Amount" required name="amount_after_cgst" autocomplete="off" type="text" value="">
							</td>
							<td style="border:1px;border-style:solid;"></td>
						</tr>---->