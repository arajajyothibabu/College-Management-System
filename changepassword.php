<?php require_once("includes/session.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require("includes/connection.php"); ?>

<?php include("includes/header.php"); ?>
<?php 
if($_GET['link'] == "fusers"){
	
	$flag = "fusers";
	$table = "staff";
	$page = "staff";
	$uname = $_SESSION['username'];
	$id = "fid";
	$uid = $_SESSION['user_id'];
}
else if($_GET['link'] == "users"){
	$flag = "users";
 	$table = "student";
	$page = "student";
	$uname = $_SESSION['username'];
	$id = "sid";
    $uid = $_SESSION['user_id'];
	}
if(isset($_POST['cancel']))
{
	redirect_to("student.php?link=student");
	}
if(isset($_POST['submit'])){
$oldpass = decrypt($_POST['oldpass']);
$newpass = $_POST['newpass'];
$newpass1 = $_POST['newpass1'];
if(notnull($oldpass) && notnull($newpass) && notnull($newpass1)){
if($newpass == $newpass1){
		if(strlen($newpass) >= 6)
		{
	$queryresult = mysql_query("select * from $table where password = '{$oldpass}' and $id = '{$uid}'");
		confirm_query($queryresult);
				if (mysql_num_rows($queryresult) == 1) {
					// username/password authenticated
					// and only 1 match
					$pass = mysql_real_escape_string(decrypt($newpass));
					mysql_query("UPDATE $table set password = '{$pass}' where password = '{$oldpass}' and $id = '{$uid}'");
					
					redirect_to("$page.php?link=edsuc");
				}
				else{
				$message = "Password incorrect.<br />
				Please make sure your caps lock key is off and try again.";
				
		}
	}
	else $message = "Password must have greater than 6 characters..!";
}
else  {
	 $message = "Password confirmation conflict. Try again..!";
	}
}
else {
			$message = "Every field must be filled..!";
		}
	}
?>
<table align="center" id="structure">
	<tr>
		<td align="center" id="page">
			<?php if (!empty($message)) {echo "<p  id='err' class=\"message\">" . $message . "</p>";} ?>
			<form name="myform" action="changepassword.php?link=<?php echo $flag ?>" method="post" onsubmit="passvalidate()">
			<table>
				<tr>
					<td width="116">Current Password</td>
					<td width="144">:<input type="password" name="oldpass" maxlength="20" value="" /></td>
				</tr>
				<tr>
					<td>New Password</td>
					<td>:<input type="password" name="newpass" maxlength="20" value="" /></td>
				</tr>
                <tr>
					<td>Confirm Password</td>
					<td>:<input type="password" name="newpass1" maxlength="20" value="" /></td>
				</tr>
                <tr><td><h2> <h2></td></tr>
				<tr>
					<td>&nbsp;</td><td>
                    <table><tr>
                    <td><input type="submit" name="submit" value="Submit" /></td><td>&nbsp;</td>
                    <td><input type="submit" name="cancel" value="Cancel" /></td>
                    </tr></table>
                    </td>
				</tr>
			</table>
			</form>
        </td>
        </tr>
        </table>
<?php include("includes/footer.php"); ?>