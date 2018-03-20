<style>
 .error {color: #FF0000;}  
</style>
<?php
// define variables and set to empty values
$URLErr = $amtErr =$startdateErr = $enddateErr = $selectadvErr="";

$URL = $amt = $startdate = $enddate = $selectadv= "";

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
  if (empty($_POST["URL"])) {
    $URLErr = "URL is required";
  } else {
    $URL = test_input($_POST["URL"]);
 
    }
	if (empty($_POST["amt"])) {
    $amtErr = "Amount is required";
  } else {
    $amt = test_input($_POST["amt"]);
 
    }
	if (empty($_POST["$startdate"])) {
    $startdateErr = "Enter post date";
  } else {
    $startdate = test_input($_POST["$startdate"]);
 
    }
	if (empty($_POST["$enddate"])) {
    $enddateErr = "Enter end date";
  } else {
    $enddate = test_input($_POST["$enddate"]);
    }
	if (empty($_POST["$selectadv"])) {
    $selectadvErr = "Select advertiser";
  } else {
    $selectadv = test_input($_POST["$selectadv"]);
    }
  }
  ?>
<?php
	include("adminheader.php");
	include("dbconnection.php");
	$db=$obj->query("select *From advertiser_table");
?>


<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
<h1>ADVERTISEMENT</h1>
<p><span class="error">* required field.</span></p>
<table>
<tr>
	<td><b>Image:</b><span class="error">*</td>
	<td style="padding:5px"><input type="file" name="i1"></td>
</tr>
<tr>
	<td><b>Navigate URL:</b><span class="error">*</td>
	<td style="padding:5px"><textarea rows="5" cols="25" name="URL"></textarea> <span class="error"><?php echo $URLErr;?></span></td>
</tr>
<tr>
	<td><b>Posted Date:</b><span class="error">*</td>
	<td style="padding:5px"><input type="date" name="t2"> <span class="error"><?php echo $startdateErr;?></td>
</tr>
<tr>
	<td><b>Ending Date:</b><span class="error">*</td>
	<td style="padding:5px"><input type="date" name="t3"> <span class="error"><?php echo $enddateErr;?></td>
</tr>
<tr>
	<td><b>Select Advertiser:</b><span class="error">*</td>
	<td style="padding:5px"><select name="t4">
		<option value=0>---Select Advertiser---</option>
		<?php
			while($dbs=$db->fetch())
			{
		?>
			<option value='<?php echo $dbs["advertiserid"]; ?>'><?php echo $dbs["companyname"]; ?></option>
		<?php
			}
		?>
	    </select>
		 <span class="error"><?php echo $selectadvErr;?>
	</td>
</tr>
<tr>
	<td><b>Amount:</b><span class="error">*</td>
	<td style="padding:5px"><input type="text" name="amt"><span class="error"> <?php echo $amtErr;?></span></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td><input type="submit" value="Submit" >	
	<input type="reset" value="Cancel" name="b2"></td>
</tr>
</table>
</form>
<br>
<?php
	$rs=$obj->query("select *From advertisement_table a,advertiser_table t where a.advertiserid=t.advertiserid");
?>

<table border=1>
<tr>
	<td style="padding:10px">Advertisement ID</td>
	<td style="padding:10px">Photo</td>
	<td style="padding:10px">Navigation URL</td>
	<td style="padding:10px">Posted Date</td>
	<td style="padding:10px">Ending Date</td>
	<td style="padding:10px">Advertisement Company</td>
	<td style="padding:10px">Amount</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	
</tr>
	<?php
		while($db=$rs->fetch())
		{
	?>
	<tr>
				<td style="padding:10px"><?php echo $db["advertisementid"]; ?></td>
				<td style="padding:10px"><img src='<?php echo $db["photo"]; ?>' height=100 width=100></td>
				<td style="padding:10px"><a href='<?php echo $db["navigateURL"]; ?>'>Navigation URL</a></td>
				<td style="padding:10px"><?php echo $db["posteddate"]; ?></td>
				<td style="padding:10px"><?php echo $db["enddate"]; ?></td>
				<td style="padding:10px"><?php echo $db["companyname"]; ?></td>
				<td style="padding:10px"><?php echo $db["amount"]; ?></td>
				<td style="padding:10px"><a href='deleteadvertisement.php?x=<?php echo $db["advertisementid"]; ?>'><img src="image\delete.png" height=30 width=30></a></td>
				<td style="padding:10px"><a href='editadvertisement.php?x=<?php echo $db["advertisementid"]; ?>'><img src="image\edit.png" height=30 width=30></a></td>
			
			</tr>
	<?php
	   }
	?>
</table>
<?php
	include("adminfooter.php");
?>
