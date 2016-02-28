<?php require_once("includes/session.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php include("includes/header.php"); ?>
<?php $message = ""; ?>
<?php 
//if student have the right to insert attendance data into table

/*if(isset($_POST['insert'])){
$dept = $_POST['dept'];
$semister = $_POST['semister'];
$suid = $_POST['suid'];
$section = $_POST['section'];
$uid = $_SESSION['user_id'];
$quer = mysql_query("select fid from subject where dept = '{$dept}' and semister = '{$semister}' and suid = '{$suid}' and section = '{$section}'");
confirm_query($quer);
$fid = mysql_fetch_array($quer);
if(isset($fid) && notnull($dept) && notnull($semister) && notnull($suid) && notnull($section)){
$queryset = mysql_query("INSERT into attendance VALUES('','$dept','$semister','$section','$suid','$fid[0]','$uid','','','','')");
if(!$queryset){
	$message = "Insertion Failed. Try again..!";
	}
	else {
		$message = "Insertion succesfull..!";
		}
}
else $message = "Selection of Subject failed. Try again..!". "<br/>"."Kindly select all fields provided..!";
}*/
?>

<table id="structure">
    <tr>
        <td id="page">
		<fieldset>
		<legend>Student Academics(Attendance) </legend>
        <table align="center">
        <tr>
        <td>
<?php 
echo '<form action="attendance.php?link='.$_GET['link'].'" method="post" ><table><tr><td colspan="2"><select name="suid"><option value="">--subject--</option>';
$uid = $_SESSION['user_id'];
$dept = $_SESSION['dept'];
$semester = $_SESSION['semester'];
$section = $_SESSION['section'];
		$subqry = mysql_query("select * from subject where dept = '{$dept}' and semester = '{$semester}' and section = '{$section}'");
			if($subqry)
			{
				while($q = mysql_fetch_array($subqry))
				{
					echo '<option value="'.$q['suid'].'">'.$q['sname'].'</option>';
					}
				echo '<option value="ALL">ALL</option></select></td><td><==></td><td width="108"><input type="submit" name="submit" value="Submit" /></td></tr></table></form></td></tr>';	
				}
				else $message = "No data found..!";

?>
<?php if (!empty($message)) {echo "<tr><td><p id='err' class=\"message\">" . $message . "</p></td></tr>";} ?>
<?php 
if(isset($_POST['submit'])){
$suid = $_POST['suid'];
$uid = $_SESSION['user_id'];
if($suid == "ALL"){
$queryset = mysql_query("select * from attendance where sid = '$uid'");
	}
else if($suid == ""){
	$queryset = NULL;
	}
else {
$queryset = mysql_query("select * from attendance where suid = '$suid' and sid = '$uid'");
}
//confirm_query($queryset);
if(!empty($queryset)){

		echo '<tr><td><table id="t" border="1" width="100%" cellpadding="10"><caption><b>Attendance of Current Semister</b></caption><colgroup><col style="background-color:#00CCFF; font-size:48px;"><col style="background-color:#0FFFFF; color:#000000; text-align:center"><col style="background-color:#0FFFFF; color:#000000; text-align:center"><col style="background-color:#0FFFFF; color:#000000; text-align:center"><col style="background-color:#0FFFFF; color:#000000; text-align:center"></colgroup><thead><tr><th>SUBJECT</th><th>Classes Held</th><th>Classes Present</th><th>Attendance %</th><th>Condition</th></tr></thead><tbody>';

	
	while($mark = mysql_fetch_array($queryset)){
						$status = $mark['stat'];
						if($status == "Safe")
							$color = 'lightgreen';
						 elseif($status == "Detain") $color = 'red';
						 elseif($status == "Condonation") $color = "orange";
						 else $color = "";
	
	echo '<tr><td style="text-align:center">'. $mark["suid"] . '</td><td align="center">' . $mark["noc"] .'</td><td align="center">'.$mark["nocp"].'</td><td align="center">'.$mark["noca"].'</td><td align="center" style="background-color:'.$color.'">'.$mark["stat"].'</td></tr>';
	
		}
		echo '</tbody></table></td></tr>';
		}
	else {
	$err = "Select Something..!";
	}
	
 }
?>
 <?php if (!empty($err)) {echo "<tr><td><p id='err' class=\"message\">" . $err . "</p></td></tr>";} ?>
        </table>
		</fieldset>
        </td>
    </tr>
</table>

<?php include("includes/footer.php"); ?>