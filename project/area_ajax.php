<?php
	$cid=$_GET["x"];
	include("dbconnection.php");
	$rs=$obj->query("select * from area where cityid='$cid' ");
?>
<style>
.tbox{
		border:2px solid #b3b3b3;
		background:#dddddd;
		width:200px;
		font-size:18px;
		border-radius:15px;
		-moz-border-radius:25px; 
		-moz-box-shadow:1px 1px 1px #ccc;
		-webkit-box-shadow: 1px 1px 1px 1px #ccc;
		box-shadow: 1px 2px 2px 2px #ccc;
	}
</style>
				<select name="c2" class="tbox" style="width:300px;height:38px">
					<option value="0">---Select---</option>
					<?php
						while($db=$rs->fetch())
						{
					?>
					<option value='<?php echo $db["areaid"]; ?>'><?php echo $db["areaname"]; ?></option>
					<?php
						}
					?>
				</select>
			
