<?php require_once("includes/session.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php confirm_logged_in(); ?>
<?php include("includes/header.php"); ?>
<?php $message = "";
$selection = "out";
 ?>

<?php 
if(isset($_POST['select'])){
$dept = $_POST['dept'];
$semister = $_POST['semister'];
$section = $_POST['section'];
$uid = $_SESSION['user_id'];
if(notnull($dept) && notnull($semister) && notnull($section)){
$queryset = mysql_query("SELECT * from notify where fid = '{$uid}' and section = '{$section}' and semester = '{$semister}' and dept = '{$dept}'");

}
else
{
	 $message = "Kindly select all fields provided..!  ";
	 $queryset = NULL;
	 $selection = "in";
	}
}
else
{

	$dept = "";
	$semister = "";
	$suid = "";
	$section = "";
	}

?>

<?php 
if(isset($_POST['submit'])){
$dept = $_POST['dept'];
$semister = $_POST['semister'];
$section = $_POST['section'];
$uid = $_SESSION['user_id'];
	$note = $_POST['note'];
if(notnull($dept) && notnull($semister) && notnull($section)){
	$queryset = mysql_query("Update notify set note = '{$note}' where semester = '{$semister}' and dept = '{$dept}' and fid = '{$uid}' and section = '{$section}'");
if(!$queryset){
	$message = "Update Failed..! Try again.";
	}
	else {
		$message = "Update Succesfull..!";
		}
}
else $message = "Try again..!". "<br/>"."Kindly select all fields provided..!";
}
?>

<table id="structure">
    <tr>
        <td id="page">
        <fieldset>
        <legend>Notifications</legend>
        <table width="100%">
        <tr>
        <td>
		<form action="notify.php?link=" method="post" ><table><tr><td>
		 <select name="dept" >
		 <option <?php if (isset($dept) && $dept=="") echo "selected";?> value="">--Branch--</option>
		 <option <?php if (isset($dept) && $dept=="CSE") echo "selected";?>>CSE</option>
		 <option <?php if (isset($dept) && $dept=="CHE") echo "selected";?>>Chemical</option>
		 <option <?php if (isset($dept) && $dept=="CIV") echo "selected";?>>Civil</option>
		 <option <?php if (isset($dept) && $dept=="ECE") echo "selected";?>>ECE</option>
		 <option <?php if (isset($dept) && $dept=="EEE") echo "selected";?>>EEE</option>
		 <option <?php if (isset($dept) && $dept=="IT") echo "selected";?>>It</option>
		 <option <?php if (isset($dept) && $dept=="MECH") echo "selected";?>>Mechanical</option>
		 </select>
		 </td><td><==></td><td>
		 <select name="semister">
		 <option <?php if (isset($semister) && $semister=="") echo "selected";?> value="">--semester--</option>
		 <option <?php if (isset($semister) && $semister=="1") echo "selected";?>>1</option>
		 <option <?php if (isset($semister) && $semister=="2") echo "selected";?>>2</option>
		 <option <?php if (isset($semister) && $semister=="3") echo "selected";?>>3</option>
		 <option <?php if (isset($semister) && $semister=="4") echo "selected";?>>4</option>
		 <option <?php if (isset($semister) && $semister=="5") echo "selected";?>>5</option>
		 <option <?php if (isset($semister) && $semister=="6") echo "selected";?>>6</option>
		 <option <?php if (isset($semister) && $semister=="7") echo "selected";?>>7</option>
		 <option <?php if (isset($semister) && $semister=="8") echo "selected";?>>8</option>
		 </select>
         <?php /*?><?php
         </td><td><==></td><td><select name="suid"><option <?php if (isset($suid) && $suid == "") echo "selected";?>>--subject--</option>
		 
		
        $uid = $_SESSION['user_id'];
		$subqry = mysql_query("select * from subject where fid = '{$uid}'");
			if($subqry)
			{
				while($q = mysql_fetch_array($subqry))
				{
					echo '<option value="theppi">Hai</option>';
					echo '<option';
					if (isset($suid) && $suid == $q['suid'])
					echo 'selected'; 
					echo '>'.$q["sname"].'</option>';
					}	
				}
				else $message = "No data found..!";
				?><?php */?>
		 
		 <td><==></td><td>
		 <select name="section">
		 <option <?php if (isset($section) && $section == "") echo "selected";?> value="">--section--</option>
		 <option <?php if (isset($section) && $section == "1") echo "selected";?>>1</option>
		 <option <?php if (isset($section) && $section == "2") echo "selected";?>>2</option>
		 <option <?php if (isset($section) && $section == "3") echo "selected";?>>3</option>
         <option <?php if (isset($section) && $section == "4") echo "selected";?>>4</option>
		 </select></td><td><=></td><td colspan="2"><input type="submit" name="select" value="Submit" /></td></tr></table>
         </td></tr>
			<?php
			if(isset($_POST['select']))
			{
            if(!$queryset){
				if($selection == "out")
				$message = "No results found..! Try again.";
				}
		else {
			if($qr = mysql_fetch_array($queryset)){
				$flag = 5;
			echo '<tr><td><strong>Notification:</strong></td></tr><tr><td><textarea cols="63" type="text" name="note">'.$qr["note"].'</textarea></td></tr>';
			}
			if(isset($flag)){
				echo '<tr><td><input type="submit" name="submit" value="Update" /></td></tr></table></form></td></tr>';
			}
			else {
				$message = "No results found. Try again..!";
				}
			}
			}
		?>
<?php if (!empty($message)) {echo "<tr><td><p id='err' class=\"message\">" . $message . "</p></td></tr>";} ?>
        </table>
        </fieldset>
       	</td>
    </tr>
</table>

<?php include("includes/footer.php"); ?>