<?php require_once("includes/session.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php include("includes/header.php"); ?>
<!-- Subject selection and insertion-->
<table id="structure">
<tr>
<td id="page">
<fieldset>
<legend>Student Academics </legend>
	<table width="100%">
	<tr>
	<td>
<?php 
echo '<form action="studentmarks.php?link='.$_GET['link'].'" method="post" ><table><tr><td colspan="2"><select name="suid"><option value="">--subject--</option>';
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
				echo '<option value="ALL">ALL</option></select></td><td><==></td><td width="108"><input type="submit" name="submit" value="View Marks" /></td></tr></table></form></td></tr>';	
				}
				else $message = "No data found..!";

?>
<?php if (!empty($message)) {echo "<tr><td><p id='err' class=\"message\">" . $message . "</p></td></tr>";} ?>
<!-- Subject selection to display results.-->
<?php 
if(isset($_POST['submit'])){
	$suid = $_POST['suid'];
if($suid == "ALL"){
$queryset = mysql_query("select * from marks where sid = '$uid'");
	}
else if($suid == ""){
	$queryset = NULL;
	}
else {
$queryset = mysql_query("select * from marks where suid = '$suid' and sid = '$uid'");
}
//confirm_query($queryset);
if(!empty($queryset)){

		echo '<tr><td><table border="1" width="100%" cellpadding="5" id="t"><caption><b>Marks of Current Semester</b></caption><colgroup><col style="background-color:#00CCFF; font-size:24px;"><col style="background-color:#0FFFFF; color:#000000; text-align:center"><col style="background-color:#0FFFFF; color:#000000; text-align:center"><col style="background-color:#0FFFFF; color:#000000; text-align:center"><col style="background-color:#0FFFFF; color:#000000; text-align:center"><col style="background-color:#0FFFFF; color:#000000; text-align:center"><col style="background-color:#0FFFFF; color:#000000; text-align:center"><col style="background-color:#0FFFFF; color:#000000; text-align:center"><col style="background-color:#0FFFFF; color:#000000; text-align:center"><col style="background-color:#0FFFFF; color:#000000; text-align:center"><col style="background-color:#0FFFFF; color:#000000; text-align:center"></colgroup><thead><tr><th>SUBJECT</th><th>Q-1</th><th>A-1</th><th>M-1</th><th>I-1</th><th>Q-2</th><th>A-2</th><th>M-2</th><th>I-2</th><th>I-F</th><th>Final</th></tr></thead><tbody>';

	
	while($mark = mysql_fetch_array($queryset)){
		$subname = mysql_query("select sname from subject where suid = '{$mark["suid"]}'");
		$subject = mysql_fetch_array($subname);
	echo '<tr><td align="center">'. $subject["sname"] . '</td><td align="center">' . $mark["q1"] .'</td><td align="center">'.$mark["a1"].'</td><td align="center">'.$mark["m1"].'</td><td align="center">'.$mark["i1"].'</td><td align="center">'.$mark["q2"].'</td><td align="center">'.$mark["a2"].'</td><td align="center">'.$mark["m2"].'</td><td align="center">'.$mark["i2"].'</td><td align="center"><b>'.$mark["inf"].'</b></td><td align="center"><b>'.$mark["f"].'</b></td></tr>';
	
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
