<?php
	$sid=$_GET["x"];
	include("dbconnection.php");
	$rs=$obj->query("select * from city where stateid='$sid' ");
?>
<style>
.tbox{
		border:2px solid #b3b3b3;
		background:#dddddd;
		width:200px;
		border-radius:15px;
		font-size:18px;
		-moz-border-radius:25px; 
		-moz-box-shadow:1px 1px 1px #ccc;
		-webkit-box-shadow: 1px 1px 1px 1px #ccc;
		box-shadow: 1px 2px 2px 2px #ccc;
}
	</style>
				<select name="c1" onchange="area()" class="tbox" style="width:300px;height:38px">
					<option value="0">---Select City---</option>
					<?php
						while($db=$rs->fetch())
						{
					?>
					<option value='<?php echo $db["cityid"]; ?>'><?php echo $db["cityname"]; ?></option>
					<?php
						}
					?>
				</select>
			
