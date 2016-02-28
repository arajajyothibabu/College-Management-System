<?php require_once("includes/session.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php include("includes/header.php"); ?>
<?php $message = "";
if($_GET['link']=="student"){
	$uid = $_SESSION['user_id'];
	$uname = $_SESSION['username'];
	$heading = "to ". $uname;
	$id = "uid";
	$page = $_GET['link'];
	}
	else{
		$uid = $_SESSION['user_id'];
		$uname = $_SESSION['username'];
		$heading = "to ". $uname;
		$id = "letterto";
		$page = $_GET['link'];
		}
 ?>
<table id="structure">
<tr>
<td id="page">
<fieldset>
<legend>Letters <?php echo $heading; ?></legend>
<table width="100%">
<?php 
$query = mysql_query("select * from letter where letterto = '{$uid}' ORDER BY sno DESC");
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
		echo '<tr><td><a href="viewletter.php?link=inbox&&id='. $q['sno'] .'" target="main"><fieldset id="'.$color.'"><table width="100%"><tr><td width="5%">'. $i .'</td><td>&nbsp</td><td><strong>'.$q["uid"].'</strong></td><td>&nbsp</td><td><marquee behavior="scroll" dir="ltr">'.$q['subject'].'</marquee></td><td>&nbsp</td><td width="8%"> '.$q["dept"].'</td><td>&nbsp</td><td width="15%">'.$q["date"].'</td></tr></table></fieldset></a></td></tr>';

		$i = $i + 1;
		}
		if($i == 1)
		$message = "No Letters found..!";
	}
?>
<?php if (!empty($message)) {echo "<tr><td><p id='err' class=\"message\">" . $message . "</p></td></tr>";} ?>
</table>
</fieldset>
<td style="box-shadow:#FFF
</td>
</tr>
</table>
<?php include("includes/footer.php"); ?>