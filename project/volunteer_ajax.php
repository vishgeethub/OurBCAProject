<?php
	$sid=$_GET["x"];
	include("dbconnection.php");
	$rs=$obj->query("select * from volunteer_table v,user_table u,event_table e where u.uid=v.uid and e.eventid=v.eventid and v.eventid='$sid' ");
?>
		<center><table border=4>
		<tr>
			<td style="padding:10px;font-size:16px">Event Name</td>
			<td style="padding:10px;font-size:16px">User Name</td>
			<td style="padding:10px;font-size:16px">Registration Date</td>
			<td style="padding:10px;font-size:16px">Status</td>
		</tr>	
		<?php
			while($rd=$rs->fetch())
			{
		?>
			<td style="padding:10px;font-size:16px"><?php echo $rd["eventname"]; ?></td>
			<td style="padding:10px;font-size:16px"><?php echo $rd["uname"]; ?></td>
			<td style="padding:10px;font-size:16px"><?php echo $rd["rdate"]; ?></td>
			<td style="padding:10px;font-size:16px"><?php echo $rd["status"]; ?></td>	
		<?php
			}
		?>
</table></center>
			
