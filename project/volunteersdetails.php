
<?php
	include("dbconnection.php");
?>
<style>
.header{
		color:dark grey;
		font-family:bookman old style;
		font-size:50px;
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
</style>

<script>
	function volunteer()
	{
          var sid = document.f1.t3.value;
	    var xcity = new XMLHttpRequest();
		xcity.onreadystatechange = function()
                {
         
		 if(this.readyState == 4 && this.status == 200){		
                  document.getElementById("d1").innerHTML = this.responseText;
        	}
	   }
            	
	  xcity.open("GET","volunteer_ajax.php?x="+sid,true);
	  xcity.send();
	  
        }
</script>
<br>
<br>
<center><span class="header">Volunteer Details</span></center>

<?php session_start();
	include("ngoheader.php");
	$nid=$_SESSION["nid"];
	include("dbconnection.php");
	$rs=$obj->query("select * from event_table where NGOid='$nid' ");
?>
<form name="f1">
<tr>
    		<center><td><b>Select Event:</b><span style="color:red">*</span></td>
    		<td style="padding:5px">
			<select name="t3" class="tbox" onchange="volunteer()">
    		      		<option value="0">---Select Event---</option>
				<?php
					while($db=$rs->fetch())
					{
				?>
					<option value='<?php echo $db["eventid"]; ?>'><?php echo $db["eventname"]; ?></option>
				<?php
					}
				?>  
        		</select>
				<span id="d1" style="color:red"></span></div>
				
      		</td>
			<br>
			<br>
</center>
   	</tr>
	
</form>

		<div id="d1">	
		</div>
<br>
<br>
<br>
<br>

<?php
	include("ngofooter.php");
?>