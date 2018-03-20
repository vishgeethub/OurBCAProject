<?php session_start();
	include("ngoheader.php");
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
		font-size:18px;
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
</script>

<?php
	include("dbconnection.php");
	$rs=$obj->query("select * from state");
	$rsc=$obj->query("select * from city");
	$rsa=$obj->query("select * from area");

	$ngoid=$_SESSION["nid"];
	$no=$obj->query("select * from ngo_table n,area a,city c where a.areaid=n.areaid and c.cityid=a.cityid and n.ngoid='$ngoid'");
	$dbs=$no->fetch();
?>
<center>
<form action="updatengoregistration_details.php" method="post" name="f1" enctype="multipart/form-data">
<span class="header">Edit NGO Profile</span>
<input type="hidden" value='<?php echo $dbs["NGOid"]; ?>' name="id">
<table>
	<tr>
		<td style="font-size:18px"><b>NGO Name:</b></td>
		<td style="padding:5px"><input type="text" name="t1" class="tbox" style="width:300px;height:38px" value='<?php echo $dbs["NGOname"]; ?>'></td>
 	</tr>
   	<tr>
    		<td style="font-size:18px"><b>Address:</b></td>
    		<td style="padding:5px"><textarea rows="3" cols="25" class="tbox" name="t2" style="width:300px;height:38px"><?php echo $dbs["address"]; ?></textarea></td>
   	</tr>
      	<tr>
    		<td style="font-size:18px"><b>State:</b></td>
    		<td style="padding:5px">
			<select name="t3" style="width:300px;height:38px" class="tbox" onchange="city()">
    		      		
				<?php
					while($db=$rs->fetch())
					{
                                           if($db["stateid"]==$dbs["stateid"])
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
				<select name="c1" style="width:300px;height:38px" class="tbox" onchange="area()">
			<?php
					while($db=$rsc->fetch())
					{
                                        if($db["cityid"]==$dbs["cityid"])
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
					<?php
					while($db=$rsa->fetch())
					{
                                          if($db["areaid"]==$dbs["areaid"])
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
		<td style="font-size:18px"><b>Email ID:</b></td>
		<td style="padding:5px"><input type="text" class="tbox" name="t4" style="width:300px;height:38px" value='<?php echo $dbs["emailid"]; ?>'></td>
	</tr>
	<tr>
		<td style="font-size:18px"><b>Website:</b></td>
		<td style="padding:5px"><input type="text" class="tbox" name="t5" style="width:300px;height:38px" value='<?php echo $dbs["website"]; ?>'></td>
	</tr>
	<tr>
		<td style="font-size:18px"><b>Phone No:</b></td>
		<td style="padding:5px"><input type="text" class="tbox" name="t6"  style="width:300px;height:38px" value='<?php echo $dbs["phone"]; ?>'></td>
	</tr>
	<tr>
		<td style="font-size:18px"><b>Logo:</b></td>
		<td style="padding:5px"><input type="file" class="tbox" name="t7" style="width:300px;height:38px"></td>
		<td><img src='<?php echo $dbs["logo"]; ?>' height=100 width=100></td>
	</tr>
	<tr>
		<td style="font-size:18px"><b>About NGO:</b></td>
		<td style="padding:5px"><textarea rows="4" class="tbox" cols="30" name="t8" style="width:300px;height:38px"><?php echo $dbs["description"]; ?></textarea></td>
	</tr>
    	<tr>
    		<td>&nbsp;</td>
    		<td style="padding:5px"><input type="submit" class="tbox" value="update" style="width:150px"></td>
   	</tr>
</table>
</form>
<?php
	include("ngofooter.php");
?></center>