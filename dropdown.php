<?php
include("index_layout.php");
include("database.php");
?>
<div class="frmDronpDown">
	<div class="row">
		<label>Country:</label><br/>
		<select name="country" id="country-list" class="demoInputBox" onChange="getState(this.value);">
		<option value="">Select Country</option>
		<?php
		$sql=mysql_query("select id,category_name from master_category where flag='0'");
		$row=mysql_fetch_array($sql);
		foreach($row as $row) {
		?>
		<option value="<?php echo $row["id"]; ?>"><?php echo $row["category_name"]; ?></option>
		<?php
		}
		?>
		</select>
	</div>
	<div class="row">
		<label>State:</label><br/>
		<select name="state" id="state-list" class="demoInputBox">
		<option value="">Select State</option>
		</select>
	</div>
</div>