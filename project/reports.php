<?php
	include("adminheader.php");
	include("dbconnection.php");
	$db = $obj->query("select * from advertiser_table");
?>
<style>
	.err{
		font-size:20px;
	
	}
	</style>

<ul>
<span class="err">
	<li><a href="statewiseNGO.php">Statewise NGO</a></li>
	<li><a href="citywiseNGO.php">Citywise NGO</a></li>
	<li><a href="citywiseUser.php">Citywise User</a></li>
	<li><a href="NGOwiseEvent.php">NGOwise Event</a></li>
	<li><a href="citywiseEvent.php">Citywise Event</a></li>
	<li><a href="categorywiseEvent.php">Categorywise Event</a></li>
	<li><a href="datewiseEvent.php">Datewise Event</a></li>
	</span>
</ul>


<?php
	include("adminfooter.php");
?>