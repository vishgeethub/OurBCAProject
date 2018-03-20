<?php
	include("adminheader.php");
	include("dbconnection.php");
	$db=$obj->query("select *From advertiser_table");
?>
<style>
	.error
	{
		color:red;
		font-family:bookman old style;
		}
	
	.header{
		color:dark grey;
		font-family:bookman old style ;
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
	input[type="text"]
	{
	font-size:18px;
	}
	input[type="file"]
	{
	font-size:18px;
	}
	input[type="date"]
	{
	font-size:18px;
	}

	</style>
<script>
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
			document.getElementById(dname).innerHTML="Invalid Digit";
        }
        else
        {
            document.getElementById(dname).innerHTML="";
    
        }     
	}
	
	function check()
	{
		var image=document.f1.i1.value;
		var navurl=document.f1.t1.value;
		var pd=document.f1.t2.value;
		var ed=document.f1.t3.value;
		var advertiser=document.f1.t4.value;
		var amount=document.f1.t5.value;
		flag=true;
		if(image=="")
		{
			flag=false;
			document.getElementById("d1").innerHTML="Enter advertisement image";
		}
		else
		{
			document.getElementById("d1").innerHTML="";
		}
		if(navurl=="")
		{
			flag=false;
			document.getElementById("d2").innerHTML="URL required";
		}
		else
		{
			document.getElementById("d2").innerHTML="";
		}
		if(pd=="")
		{
			flag=false;
			document.getElementById("d3").innerHTML="Select Post Date of Advertisement";
		}
		else
		{
			document.getElementById("d3").innerHTML="";
		}
		if(ed=="")
		{
			flag=false;
			document.getElementById("d4").innerHTML="Enter End Date of Advertisemnt";
		}
		else
		{
			document.getElementById("d4").innerHTML="";
		}
		if(advertiser=="0")
		{
			flag=false;
			document.getElementById("d5").innerHTML="Select Advertiser";
		}
		else
		{
			document.getElementById("d5").innerHTML="";
		}
		if(amount=="")
		{
			flag=false;
			document.getElementById("d6").innerHTML="Enter amount";
		}
		else
		{
			document.getElementById("d6").innerHTML="";
		}
		return flag;
	}
</script>
<form action="addadvertisement.php" onsubmit="return check();" name="f1" method="post" enctype="multipart/form-data">
<center>
<span class="header">Advertisement</span>
<br>
<br>
<table>
<tr>
	<td style="font-size:18px;"><b>Image:</b><span style="color:red">*</span></td>
	<td style="padding:5px"><input type="file" name="i1" style="width:300px;" class="tbox"><span id="d1" class="error"></span></td></p>
	
</tr>
<tr>
	<td style="font-size:18px;"><b>Navigate URL:</b><span style="color:red">*</span></td>
	<td style="padding:5px"><textarea rows="3" cols="19" name="t1" style="width:300px;font-size:18px;" class="tbox"></textarea><span id="d2" class="error"></span></td>
</tr>
<tr>
	<td style="font-size:18px;"><b>Posted Date:</b><span style="color:red">*</span></td>
	<td style="padding:5px"><input type="date" name="t2" class="tbox" style="width:300px;"><span id="d3" class="error"></span></td>
</tr>
<tr>
	<td style="font-size:18px;"><b>Ending Date:</b><span style="color:red">*</span></td>
	<td style="padding:5px"><input type="date" name="t3" class="tbox" style="width:300px;"><span id="d4" class="error"></span></td>
</tr>
<tr>
	<td style="font-size:18px;"><b>Select Advertiser:</b><span style="color:red">*</span></td>
	<td style="padding:5px"><select style="width:300px;height:38px;font-size:18px;" class="tbox" name="t4">
		<option value=0>---Select Advertiser---</option>
		<?php
			while($dbs=$db->fetch())
			{
		?>
			<option value='<?php echo $dbs["advertiserid"]; ?>'><?php echo $dbs["companyname"]; ?></option>
		<?php
			}
		?>
	    </select><span id="d5" class="error"></span>
	</td>
</tr>
<tr>
	<td style="font-size:18px;"><b>Amount:</b><span style="color:red">*</span></td>
	<td style="padding:5px"><input type="text" class="tbox" name="t5" onKeyUp="checknumber(this.value,'d6');" style="width:300px;height:38px;"><span id="d6" class="error"></span></td>
</tr>	
<tr>
	<td>&nbsp;</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td><input type="submit" value="Submit" class="tbox" name="b1" style="width:150px;font-size:18px">	
	<input type="reset" value="Cancel" name="b2" class="tbox" style="width:150px;font-size:18px"></td>
</tr>
</table>
</center>
<button onClick="myfunc()"></button>
</form>

<br>
<br>
<br>
<?php
	$rs=$obj->query("select *From advertisement_table a,advertiser_table t where a.advertiserid=t.advertiserid order by a.posteddate");
?>
<center>
<span class="table">Advertisement Details</span>
<br>
<br>
<table class="tbl" border=2>
<tr>
	
	<td style="padding:10px;font-size:16px;"><b><u>Photo</td>
	<td style="padding:10px;font-size:16px;"><b><u>Navigation URL</u></b></td>
	<td style="padding:10px;font-size:16px"><b><u>Posted Date</u></b></td>
	<td style="padding:10px;font-size:16px"><b><u>Ending Date</u></b></td>
	<td style="padding:10px;font-size:16px"><b><u>Advertisement Company</u></td>
	<td style="padding:10px;font-size:16px;"><b><u>Amount</u></b></td>
	<td style="padding:10px;font-size:16px"><b><u>Delete</u></b></td>
	<td style="padding:10px;font-size:16px"><b><u>Edit</u></b></td>
	
</tr>
	<?php
		while($db=$rs->fetch())
		{
	?>
	<tr>
				<td style="padding:10px"><img src='<?php echo $db["photo"]; ?>' height=100 width=100></td>
				<td style="padding:10px;font-size:16px"><a href='<?php echo $db["navigateURL"]; ?>'>NavigateURL</a></td>
				<td style="padding:10px;font-size:16px"><?php $org=$db["posteddate"]; echo date("d-m-Y", strtotime($org)); ?></td>
				<td style="padding:10px;font-size:16px"><?php $org1=$db["enddate"]; echo date("d-m-Y",strtotime($org1)); ?></td>
				<td style="padding:10px;font-size:16px"><?php echo $db["companyname"]; ?></td>
				<td style="padding:10px;font-size:16px;"><?php echo $db["amount"]; ?></td>
				<td style="padding:10px;font-size:16px" width="7%"><a href='deleteadvertisement.php?x=<?php echo $db["advertisementid"]; ?>' onclick="return confirm('You sure you want to delete?'); " ><img src="image\delete.png" height=30 width=30></a></td>
				<td style="padding:10px;font-size:16px" width="7%"><a href='editadvertisement.php?x=<?php echo $db["advertisementid"]; ?>' onclick="return confirm('You sure you want to edit?'); " ><img src="image\edit.png" height=30 width=30></a></td>
			
			</tr>
	<?php
	   }
	?>
</table>

</center>
<?php
	include("adminfooter.php");
?>
