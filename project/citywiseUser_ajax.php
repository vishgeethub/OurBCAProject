<?php
	$cid=$_GET["x"];
	include("dbconnection.php");
	$rsb=$obj->query("select * from user_table u, area a, city c,state s where a.areaid=u.areaid and a.cityid=c.cityid and s.stateid=c.stateid and a.cityid='$cid'");
?>
	
<style>
.table{
		color:dark grey;
		font-family:bookman old style;
		font-size:35px;
		text-decoration:underline;	
	}
	.tbox{
		border:2px solid #b3b3b3;
		background:#dddddd;
		width:200px;
		border-radius:15px;
		-moz-border-radius:25px; 
		-moz-box-shadow:1px 1px 1px #ccc;
		-webkit-box-shadow: 1px 1px 1px 1px #ccc;
		box-shadow: 1px 2px 2px 2px #ccc;
	}
	</style>
<center>

<span class="table">Registered User</span><br><br>
<br>
<table class="tbl" border=2>
	<tr>
		<td style="padding:10px;font-size:16px"><u><b>User Name</u></b></td>
		<td style="padding:10px;font-size:16px"><u><b>State</u></b></td>
		<td style="padding:10px;font-size:16px"><u><b>City</u></b></td>
		<td style="padding:10px;font-size:16px"><u><b>Phone No.</u></b></td>
		<td style="padding:10px;font-size:16px"><u><b>Gender</u></b></td>
		<td style="padding:10px;font-size:16px"><u><b>Date of Birth</u></b></td>
		<td style="padding:10px;font-size:16px"><u><b>Email ID</u></b></td>
		<td style="padding:10px;font-size:16px"><u><b>Status</u></b></td>
	</tr>
	<?php	
			while($rsf=$rsb->fetch())
			{
		?>
			<tr>
			<td style="padding:10px;font-size:16px"><?php echo $rsf["uname"]; ?></td>
			<td style="padding:10px;font-size:16px"><?php echo $rsf["statename"]; ?></td>
			<td style="padding:10px;font-size:16px"><?php echo $rsf["cityname"]; ?></td>
			<td style="padding:10px;font-size:16px"><?php echo $rsf["phone"]; ?></td>
			<td style="padding:10px;font-size:16px"><?php if( $rsf["gender"]='M') {echo "Male";} else {echo "Female";} ?></td>
			<td style="padding:10px;font-size:16px"><?php $org=$rsf["dob"]; echo date("d-m-Y", strtotime($org))?></td>
			<td style="padding:10px;font-size:16px"><?php echo $rsf["emailid"]; ?></td>			
			<td style="padding:10px;font-size:16px"><?php if( $rsf["status"]=0) {echo "Inactive";} else {echo "Active";}?></td>
			</tr>
             <?php
			}
			 ?>
			</table>
			<br>
			<form action="tcpdf/examples/citywiseUser.php" method="post">
    <input type="hidden" value='<?php echo $cid ?>' name="cid">
    <input type="submit" class="tbox" value="Export To PDF">
		
   </form>
		  
</center>