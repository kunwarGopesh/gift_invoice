		<?php
						$x=0;
						
							$taxation_name=mysql_query("select * from taxations");				
							while($row=mysql_fetch_array($taxation_name)){						
								$Tid=$row['id'];
								$name=$row['name'];
								$x++;
						?>	
						<tr style="border:1px;border-style:solid;">
							<td style="border:1px;border-style:solid;text-align:right;" colspan="4">
									<?php echo $name;?>
									<input type="hidden" name="tax_id[]" value="<?php echo $Tid?>"/>
									
									
							</td>
							<?php 
										$invoice_tax=mysql_query("select * from `invoice_taxations` where `invoice_id`='$invoice_id' && `flag`='2'");
										 $invoice_per=mysql_fetch_array($invoice_tax);
										 ?>
							<td style="border:1px;border-style:solid;text-align:right;">
								<select class="select form-control input-small tax_per" id="tex_per<?php echo $x;?>"  name="per[]">
									<option value="<?php echo $invoice_per['percentage'];?>"><?php echo $invoice_per['percentage'];?></option>
										<?php
												$cgst_data=mysql_query("select percentage from taxation_rates where taxation_id='$Tid'");				
												while($row=mysql_fetch_array($cgst_data))
												{?>		
												<option value="<?php echo $row['percentage'] ;?>">
												<?php echo $row['percentage']; ?>
											</option>
										<?php }?>
								</select>
							</td>
							<td style="border:1px;border-style:solid;">
									<input class="form-control tax_amount " placeholder="Amount" id="tax_amount<?php echo $x;?>" required name="Tamount[]" autocomplete="off" type="text" value="<?php echo $invoice_per['amount'];?>">
							</td>
							
							<td style="border:1px;border-style:solid;">
								
							</td>
						</tr>
						<?php
						}
						?>
					<input type="hidden" id="tax_count" value="<?php echo $x?>"/>