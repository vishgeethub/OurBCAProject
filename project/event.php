<?php session_start();
	include("ngoheader.php");
	$nid=$_SESSION["nid"];
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
		font-size:18px;
		background:#dddddd;
		width:200px;
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
		
		function checknumber(s,dname)
	{
		var l=s.length;
		var i,flag=true;
		for(i=0;i<l;i++)
		{
			var ch=s.charAt(i);
			if((ch>='0' && ch<='9'))
			{
			}
			else
			{
                flag=false;
			}    
		}
		if(flag==false)
        {
			document.getElementById(dname).innerHTML="Only digit's valid";
        }
        else
        {
            document.getElementById(dname).innerHTML="";
    
        }     
	}
		
		function check()
		{
			var ename=document.f1.t1.value;
			var desc=document.f1.description.value;
			var date=document.f1.date.value;
			var time=document.f1.time.value;
			var venue=document.f1.venue.value;
			var sid=document.f1.t3.value;
			var cid=document.f1.c1.value;
			var aid=document.f1.c2.value;
			var epic=document.f1.t6.value;
			var cntct=document.f1.t7.value;
			var catid=document.f1.t8.value;
			flag=true;
			if(ename=="")
		{
			flag=false;
			document.getElementById("dname").innerHTML="Enter Event name";
		}
		else
		{
			document.getElementById("dname").innerHTML="";
		}
		if(desc=="")
		{
			flag=false;
			document.getElementById("desc").innerHTML="Enter Description for event!!";
		}
		else
		{
			document.getElementById("desc").innerHTML="";
		}
		if(date=="")
		{
			flag=false;
			document.getElementById("dt").innerHTML="Enter date of the event";
		}
		else
		{
			document.getElementById("dt").innerHTML="";
		}
		if(time=="hh:mm am|pm")
		{
			flag=false;
			document.getElementById("d4").innerHTML="Enter time of the event";
		}
		else
		{
			document.getElementById("d4").innerHTML="";
		}
		if(venue=="")
		{
			flag=false;
			document.getElementById("d5").innerHTML="Enter vanue of the event";
		}
		else
		{
			document.getElementById("d5").innerHTML="";
		}
		if(sid=="0")
		{
			flag=false;
			document.getElementById("d6").innerHTML="Select State for event";
		}
		else
		{
			document.getElementById("d6").innerHTML="";
		}
		if(cid=="0")
		{
			flag=false;
			document.getElementById("d7").innerHTML="Select City for event";
		}
		else
		{
			document.getElementById("d7").innerHTML="";
		}
		if(aid=="0")
		{
			flag=false;
			document.getElementById("d8").innerHTML="Select Area for event";
		}
		else
		{
			document.getElementById("d8").innerHTML="";
		}
		if(epic=="")
		{
			flag=false;
			document.getElementById("d9").innerHTML="Enter pictue for the event";
		}
		else
		{
			document.getElementById("d9").innerHTML="";
		}
		if(cntct=="")
		{
			flag=false;
			document.getElementById("d10").innerHTML="Enter contact number";
		}
		else
		{
			document.getElementById("d10").innerHTML="";
		}
		if(catid=="0")
		{
			flag=false;
			document.getElementById("d11").innerHTML="Select category of the event";
		}
		else
		{
			document.getElementById("d11").innerHTML="";
		}
			return flag;
		}
</script>

<?php
	include("dbconnection.php");
	$rs=$obj->query("select * from state");
	$cat=$obj->query("select * from category_table");
?>
<center>
<form action="addevent.php" onsubmit="return check();" method="post" name="f1" enctype="multipart/form-data">
<span class="header">ADD NEW EVENT</span><br><br>
<table>
	<tr>
		<td style="font-size:18px"><b>Event Name:</b><span style="color:red">*</span></td>
		<td style="padding:5px"><input type="text" class="tbox" name="t1" size="30"style="width:300px;height:38px"><span id="dname" class="error"></span></td>
 	</tr>
	<tr>
		<td style="font-size:18px"><b>Description:</b><span style="color:red">*</span></td>
		<td style="padding:5px"><textarea rows="3" class="tbox" cols="25" name="description" style="width:300px;height:75px"></textarea><span id="desc" class="error"></span></td>
	</tr>
	<tr>
		<td style="font-size:18px"><b>Event Date:</b><span style="color:red">*</span></td>
		<td style="padding:5px"><input type="date" class="tbox" name="date" style="width:300px;height:38px">
		<span id="dt" class="error"></span></td>
 	</tr>
	<tr>
		<td style="font-size:18px"><b>Event Time:</b><span style="color:red">*</span></td>
		<td style="padding:5px"><input type="text" class="tbox" name="time" value="hh:mm am|pm" style="width:300px;height:38px">
		<span id="d4" class="error"></span></td>
	</tr>
	<tr>
		<td style="font-size:18px"><b>Venue:</b><span style="color:red">*</span></td>
		<td style="padding:5px"><textarea rows="3" cols="25" class="tbox" name="venue"style="width:300px;height:75px"></textarea><span id="d5" class="error"></span></td>
	</tr>
   	<tr>
    		<td style="font-size:18px"><b>State:</b><span style="color:red">*</span></td>
    		<td style="padding:5px">
			<select name="t3" onchange="city()" class="tbox" style="width:300px;height:38px">
    		      		<option value="0">---Select State---</option>
				<?php
					while($db=$rs->fetch())
					{
				?>
					<option value='<?php echo $db["stateid"]; ?>'><?php echo $db["statename"]; ?></option>
				<?php
					}
				?>  
        		</select>
				<span id="d6" class="error"></span>
      		</td>
   	</tr>
	<tr>
			<td style="font-size:18px"><b>City:</b><span style="color:red">*</span></td>
			<td style="padding:5px">
                       <div id="d1">
				<select name="c1" onchange="area()" class="tbox" style="width:300px;height:38px">
					<option value="0">---Select City---</option>
				</select>
                         </div>
						 <span id="d7" class="error"></span>
			</td>
		
	</tr>
	<tr>
		<td style="font-size:18px"><b>Area:</b><span style="color:red">*</span></td>
		<td style="padding:5px">
            <div id="d2">
				<select name="c2" class="tbox" style="width:300px;height:38px">
					<option value="0">---Select Area---</option>
				</select>
            </div>	
				<span id="d8" class="error"></span>
		</td>	
	</tr>
	<tr>
		<td style="font-size:18px"><b>Event Picture:</b><span style="color:red">*</span></td>
		<td style="padding:5px"><input type="file" class="tbox" name="t6" style="width:300px;height:38px">
		<span id="d9" class="error"></span></td>
	</tr>
	<tr>
		<td style="font-size:18px"><b>Contact No:</b><span style="color:red">*</span></td>
		<td style="padding:5px"><input type="text" class="tbox" name="t7" onKeyUp="checknumber(this.value,'d10');" style="width:300px;height:38px">
		<span id="d10" class="error"></span></td>
	</tr>
	<tr>
		<td style="font-size:18px"><b>Category:</b><span style="color:red">*</span></td>
		<td style="padding:5px" >
			<select name="t8" class="tbox" style="width:300px;height:38px">
    		      		<option value="0">---Select Category---</option>
				<?php
					while($cc=$cat->fetch())
					{
				?>
					<option value='<?php echo $cc["cat_id"]; ?>'><?php echo $cc["cat_name"]; ?></option>
				<?php
					}
				?>  
        		</select>
				<span id="d11" class="error"></span>
				</td>
			
	</tr>
	<tr>
    	<td>&nbsp;</td>
    	<td style="padding:5px"><input type="submit" class="tbox" value="Submit" style="width:150px">
		<input type="reset" value="Cancel" class="tbox" style="width:150px"></td>
   	</tr>
</table>
</form>

<br>
<br>
<span class="table">Events Details</span>
<br>
<br>
<?php
		$rsb=$obj->query("select * from event_table n,area a,city c,state s,category_table ct where a.areaid=n.areaid and c.cityid=a.cityid and c.stateid=s.stateid and ct.cat_id=n.cat_id and n.ngoid='$nid' order by n.eventdate ");
		?>
<table class="tbl" border=2>
	<tr>
		<td style="padding:10px;font-size:16px"><b><u>Event Name</b></u></td>
		<td style="padding:10px;font-size:16px"><b><u>Description</b></u></td>
		<td style="padding:10px;font-size:16px"><b><u>Event Date</b></u></td>
		<td style="padding:10px;font-size:16px"><b><u>Event Time</b></u></td>
		<td style="padding:10px;font-size:16px"><b><u>Venue</b></u></td>
		<td style="padding:10px;font-size:16px"><b><u>State</b></u></td>
		<td style="padding:10px;font-size:16px"><b><u>City</b></u></td>
		<td style="padding:10px;font-size:16px"><b><u>Area</b></u></td>
		<td style="padding:10px;font-size:16px"><b><u>Event Picture</b></u></td>
		<td style="padding:10px;font-size:16px"><b><u>Contact No.</b></u></td>
		<td style="padding:10px;font-size:16px"><b><u>Category</b></u></td>
		<td style="padding:10px;font-size:16px"><b><u>Edit</b></u></td>
		<td style="padding:10px;font-size:16px"><b><u>Delete</b></u></td>
	</tr>
	<?php	
			while($rsf=$rsb->fetch())
			{
		?>
			<tr>
			<td style="padding:10px;font-size:16px" width="9%"><?php echo $rsf["eventname"]; ?></td>
			<td style="padding:10px;font-size:16px"><?php echo $rsf["description"]; ?></td>
			<td style="padding:10px;font-size:16px" width="9%"><?php $org=$rsf["eventdate"]; echo date("d-m-Y", strtotime($org)) ?></td>
			<td style="padding:10px;font-size:16px" width="9%"><?php echo $rsf["eventtime"]; ?></td>
			<td style="padding:10px;font-size:16px"><?php echo $rsf["venue"]; ?></td>
			<td style="padding:10px;font-size:16px"><?php echo $rsf["statename"]; ?></td>
			<td style="padding:10px;font-size:16px"><?php echo $rsf["cityname"]; ?></td>
			<td style="padding:10px;font-size:16px"><?php echo $rsf["areaname"]; ?></td>
			<td style="padding:10px;font-size:16px"><img src='<?php echo $rsf["eventphoto"]; ?>' width='50px' height='50px'></td>
			<td style="padding:10px;font-size:16px"><?php echo $rsf["contactno"]; ?></td>
			<td style="padding:10px;font-size:16px"><?php echo $rsf["cat_name"]; ?></td>
			<td style="padding:10px;font-size:16px" width="6%"><a href='editevent.php?x=<?php echo $rsf["eventid"]; ?>' onclick="return confirm('You sure you want to edit <?php echo $db["eventname"]; ?> ?'); "><img src="image\edit.png"  height=30 width=30></a></td>
			<td style="padding:10px;font-size:16px" width="6%"><a href='deleteevent.php?x=<?php echo $rsf["eventid"]; ?>' onclick="return confirm('You sure you want to delete <?php echo $db["eventname"]; ?> ?'); "><img src="image\delete.png"  height=30 width=30></a></td>
			</tr>
             <?php
			}
			 ?>
			</table>
<?php
	include("ngofooter.php");
?></center>