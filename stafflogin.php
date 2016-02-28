<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
	
	if (logged_in()) {
		redirect_to("staff.php?link=staff");
	}

	include_once("includes/form_functions.php");
	
	if(isset($_POST['submit'])){
	$uname = $_POST['uname'];
	$password = decrypt($_POST['password']);
	$queryresult = mysql_query("select * from staff where fid = '{$uname}' and password = '{$password}';");
	confirm_query($queryresult);
			if (mysql_num_rows($queryresult) == 1) {
				// username/password authenticated
				// and only 1 match
				$found_user = mysql_fetch_array($queryresult);
				$_SESSION['user'] = "staff";
				$_SESSION['user_id'] = $found_user['fid'];
				$_SESSION['dept'] = $found_user['dept'];
				if(notnull($found_user['fusername']))
				$_SESSION['username'] = $found_user['fusername'];
				else  $_SESSION['username'] = "Faculty User";
				$_SESSION['page'] = "staff.php";
				redirect_to("academics.php?link=staff");
			}
			else{
			$message = "Username/password combination incorrect.<br />
			Please make sure your caps lock key is off and try again.";
			redirect_to("login.php?link=1");
		}
	}
	?>
<?php include("includes/header.php"); ?>

<?php include("includes/footer.php"); ?>
