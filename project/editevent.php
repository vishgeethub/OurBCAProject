<?php session_start();
	include("ngoheader.php");
?>

<script>
	function city()
	{
          var sid = document.f1.t3.value;
	    var xcity = new XMLHttpRequest();
		xcity.onreadystatechange = function()
                {
         
		 if(this.readyState == 4 && this.status == 200){		
                  document.getElementById("d1").innerHTML = this.responseText;
        	}
	   }
            	
	  xcity.open("GET","city_ajax.php?x="+sid,true);
	  xcity.send();
	  
        }


function area()
	{
          var cid = document.f1.c1.value;
	    var xcity = new XMLHttpRequest();
		xcity.onreadystatechange = function()
                {
         
		 if(this.readyState == 4 && this.status == 200){		
                  document.getElementById("d2").innerHTML = this.responseText;
        	}
	   }
            	
	  xcity.open("GET","area_ajax.php?x="+cid,true);
	  xcity.send();
	  
        }
</script>

<?php
	include("dbconnection.php");
	$rs=$obj->query("select * from state");
	$rsc=$obj->query("select * from city");
	$rsa=$obj->query("select * from area");
	$cat=$obj->query("select * from category_table");
	$eid=$_GET["x"];
	$dbs=$obj->query("select * from event_table n,category_table ct,city c,area a where n.areaid=a.areaid and a.cityid=c.cityid and n.cat_id=ct.cat_id and n.eventid='$eid'");
	$rsf=$dbs->fetch();
?>
<style>
	.error{
		color:red;
		font-family:bookman old style;
	}
	.header{
		color:dark grey;
		font-family:bookman old style;
		font-size:50px;
		text-decoration:underline;
	}
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
		font-size:18px;
		border-radius:15px;
		-moz-border-radius:25px; 
		-moz-box-shadow:1px 1px 1px #ccc;
		-webkit-box-shadow: 1px 1px 1px 1px #ccc;
		box-shadow: 1px 2px 2px 2px #ccc;
	}
	.tbl{
	border-collapse: separate;
    border-spacing: 2px 2px;
	border-color:dark grey;
	}
	</style>
<center>
<form action="updateevent.php" method="post" name="f1" enctype="multipart/form-data">
<span class="header">Edit Event</span>

<br>
<br>
<input type="hidden" name="id" value='<?php echo $rsf["eventid"]; ?>' >
<table>
	<tr>
		<td style="font-size:18px"><b>Event Name:</b></td>
		<td style="padding:5px"><input type="text" class="tbox" style="width:300px;height:38px" name="t1" value='<?php echo $rsf["eventname"]; ?>'></td>
 	</tr>
	<tr>
		<td style="font-size:18px"><b>Description:</b></td>
		<td style="padding:5px"><textarea rows="3" class="tbox" cols="25" name="description" style="width:300px;height:38px" ><?php echo $rsf["description"]; ?></textarea></td>
	</tr>
	<tr>
		<td style="font-size:18px"><b>Event Date:</b></td>
		<td style="padding:5px"><input type="date" class="tbox" name="date" style="width:300px;height:38px" value='<?php echo $rsf["eventdate"]; ?>'></td>
 	</tr>
	<tr>
		<td style="font-size:18px"><b>Event Time:</b></td>
		<td style="padding:5px"><input type="text" name="time" class="tbox" style="width:300px;height:38px" value='<?php echo $rsf["eventtime"]; ?>'>
	</tr>
	<tr>
		<td style="font-size:18px"><b>Venue:</b></td>
		<td style="padding:5px"><textarea rows="3" cols="25" class="tbox" style="width:300px;height:38px" name="venue"><?php echo $rsf["venue"]; ?></textarea>
	</tr>
   	<tr>
    		<td style="font-size:18px"><b>State:</b></td>
    		<td style="padding:5px">
			<select name="t3" class="tbox" style="width:300px;height:38px"  onchange="city()">
    		      		<!--<option value="0">---Select State---</option>-->
				<?php
					while($db=$rs->fetch())
					{
						if($db["stateid"]==$rsf["stateid"])
						{
				?>
					<option selected value='<?php echo $db["stateid"]; ?>'><?php echo $db["statename"]; ?></option>
				<?php
					}
					else
					{
				?>  
				<option value='<?php echo $db["stateid"]; ?>'><?php echo $db["statename"]; ?></option>
				<?php
					}
					}
					?>
        		</select>
      		</td>
   	</tr>
	<tr>
			<td style="font-size:18px"><b>City:</b></td>
			<td style="padding:5px">
                       <div id="d1">
				<select name="c1" class="tbox" style="width:300px;height:38px" onchange="area()">
					<!--<option value="0">---Select City---</option>-->
					<?php
					while($db=$rsc->fetch())
					{
						if($db["cityid"]==$rsf["cityid"])
						{
				?>
					<option selected value='<?php echo $db["cityid"]; ?>'><?php echo $db["cityname"]; ?></option>
				<?php
					}
					else
					{
				?>  
				<option value='<?php echo $db["cityid"]; ?>'><?php echo $db["cityname"]; ?></option>
				<?php
					}
					}
					?>
				</select>
                         </div>
			</td>
		
	</tr>
	<tr>
		<td style="font-size:18px"><b>Area:</b></td>
		<td style="padding:5px">
            <div id="d2">
				<select name="c2" class="tbox" style="width:300px;height:38px">
					<!--<option value="0">---Select Area---</option>-->
					<?php
					while($db=$rsa->fetch())
					{
						if($db["areaid"]==$rsf["areaid"])
						{
				?>
					<option selected value='<?php echo $db["areaid"]; ?>'><?php echo $db["areaname"]; ?></option>
				<?php
					}
					else
					{
				?>  
				<option value='<?php echo $db["areaid"]; ?>'><?php echo $db["areaname"]; ?></option>
				<?php
					}
					}
					?>
				</select>
            </div>		
		</td>	
	</tr>
	<tr>
		<td style="font-size:18px"><b>Event Picture:</b></td>
		<td style="padding:5px"><input type="file" class="tbox" name="t6"  style="width:300px;height:38px"></td>
		<td><img src='<?php echo $rsf["eventphoto"]; ?>' width=50px height=50px></td>
	</tr>
	<tr>
		<td style="font-size:18px"><b>Contact No:</b></td>
		<td style="padding:5px"><input type="text" name="t7" class="tbox" style="width:300px;height:38px" value='<?php echo $rsf["contactno"]; ?>'></td>
	</tr>
	<tr>
		<td style="font-size:18px"><b>Category:</b></td>
		<td style="padding:5px">
			<select name="t8" class="tbox" style="width:300px;height:38px">
    		      		<!--<option value="0">---Select Category---</option>-->
				<?php
					while($cc=$cat->fetch())
					{
						if($cc["cat_id"]==$rsf["cat_id"])
						{
				?>
					<option selected value='<?php echo $cc["cat_id"]; ?>'><?php echo $cc["cat_name"]; ?></option>
				<?php
					}
					else
					{
				?>  
				<option value='<?php echo $cc["cat_id"]; ?>'><?php echo $cc["cat_name"]; ?></option>
				<?php
					}
					}
					?>
        		</select>
			
	</tr>
	<tr>
    	<td>&nbsp;</td>
    	<td style="padding:5px"><input type="submit" class="tbox" value="Update" style="width:150px">
		<input type="reset" class="tbox" value="Cancel"></td>
   	</tr>
</table>
</form>
<?php
	include("ngofooter.php");
?></center>