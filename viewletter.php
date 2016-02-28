<?php require_once("includes/session.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php include("includes/header.php"); ?>
<?php $message = "";
if($_GET['link']=="inbox"){
	$uid = $_SESSION['user_id'];
	$uname = $_SESSION['username'];
	$heading = "to ". $uname;
	$id = "uid";
	$page = $_GET['link'];
	}
	else{
		$uid = $_SESSION['user_id'];
		$uname = $_SESSION['username'];
		$heading = "from ". $uname;
		$id = "letterto";
		$page = $_GET['link'];
		}
 ?>
 
 <?php 
 if(isset($_POST['accept'])||isset($_POST['reject']))
 {
	 if(isset($_POST['accept']))
	 	$stat = 1;
	 else 
	 	$stat = "0";
	$colorq = mysql_query("update letter set status = '{$stat}' where letterto = '{$uid}' and sno = '{$_GET['id']}'");
	 }
 ?>
<table id="structure">
<tr>
<td id="page" align="center">
<fieldset>
<legend>Letters <?php echo $heading; ?></legend>
<table>
<?php 
$query = mysql_query("select * from letter where sno = '{$_GET['id']}'");
if(!$query){
	$message = "No Letters found..!";
	}
else {
	$i = 1;
	while($q = mysql_fetch_array($query)){
		$status = $q['status'];
		if($status == "1")
			$color = 'green';
		 else $color = 'red';
		echo '<tr><td align="center"><fieldset id="'.$color.'"><legend style="background-color:#FF0"><strong>Letter '.$heading.' </strong></legend><table width="100%" height="100%" border="0"><caption><strong>Letter</strong></caption><tr><td width="150">&nbsp;</td><td width="370">&nbsp;</td><td width="150">'.$q["place"].'</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>'.$q["date"].'</td></tr><tr><td>&nbsp;</td></tr><tr><td>To</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td><strong>'.$q["letterto"].'</strong></td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>'.$q["dept"].'</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>&nbsp;</td><td><strong>Sub:</strong>'.$q["subject"].'</td><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>Respected Sir(Mam),</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.$q["content"].'</td></tr><tr><td>&nbsp;</td>';
		?>
		<td> <?php if($q["fromdate"] != "0000-00-00" && $q["todate"] != "0000-00-00") echo 'Leave from: <strong>'.$q["fromdate"].'</strong> to: <strong>'.$q["todate"].'</strong>'; ?> </td>
		
		<?php 
        echo '<td>&nbsp;</td></tr><tr><td>&nbsp;</td><td>'.$q["request"].'</td><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td><td>Thanking you,</td><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>Yours faithfully,</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td><strong>'.$q["uid"].'</strong></td></tr></table></fieldset></td></tr><tr><td>';
		if($_SESSION['page'] == "staff.php" && $_GET['link']=="inbox"){
		echo '<form action="viewletter.php?id='.$_GET['id'].'&&link=staff" method="post" name="ststusform">
		<table width="100%"><tr><td width="40%">&nbsp</td><td width="40%">&nbsp</td><td><input type="submit" value="Accept" name="accept[]"></td><td><input type="submit" value="Reject" name="reject[]"></td></tr></table></form></td></tr>';
		}
		}
	}
?>
<?php if (!empty($message)) {echo "<tr><td><p id='err' class=\"message\">" . $message . "</p></td></tr>";} ?>
<tr>
<td>

</td>
</tr>
</table>
</fieldset>
</td>
</tr>
</table>
<?php include("includes/footer.php"); ?>