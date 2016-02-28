<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php if(!logged_in()){
	redirect_to("blank.php?link=login");
	} ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>GVP Academics</title>
		<link href="stylesheets/public.css" media="all" rel="stylesheet" type="text/css" />
        <script src="javascripts/functions.js" type="text/javascript"></script>
		<link href="stylesheets/SpryAccordion.css" rel="stylesheet" type="text/css" />
</head>
<body style="background-color:#CCF">
<table>
<tr>
<td id="navigation">
		<p>Welcome </p>
        <h2><?php echo $_SESSION['username']; ?>.</h2>
       <?php  if($_SESSION['user']=="student")
	   {
        echo '<ul><li><a href="edit.php?link=student" target="main" style="text-decoration:none">Manage your Content</a></li><li><a href="changepassword.php?link=users" target="main" style="text-decoration:none">Change Password</a></li><li><a href="logout.php" target="_parent" style="text-decoration:none">Logout</a></li></ul><h3>Select Activity</h3><table><tr><td><ul><li><a href="studentmarks.php?link=view" target="main" style="text-decoration:none">Marks</a></li><li><a href="attendance.php?link=" target="main" style="text-decoration:none">Attendance</a></li><li><a href="tandp.php?link=" target="main" style="text-decoration:none">T&P</a></li><li><a href="letter.php?link=student" target="main" style="text-decoration:none">Send Letter</a></li><ul><li><a href="inbox.php?link=student" target="main" style="text-decoration:none">Inbox</a></li><li><a href="outbox.php?link=student" target="main" style="text-decoration:none">Outbox</a></li></ul><li><a href="calendar.php" target="main" style="text-decoration:none">Calendar</a></li></ul>';
	   }
	
   else
   {
		echo '<ul><li><a href="edit.php?link=staff" target="main">Manage your Content</a></li><li><a href="changepassword.php?link=fusers" target="main">Change Password</a></li><li><a href="logout.php" target="_parent">Logout</a></li></ul><h3>Select Activity</h3><table><tr><td><ul><li><a href="staffmarks.php?link=staff" target="main" style="text-decoration:none">Marks</a></li><li><a href="staffattendance.php?link=select" target="main" style="text-decoration:none">Attendance</a></li><li><a href="notify.php?link=staff" target="main">Notifications</a></li><li><a href="extraactivities.php?link=staff" target="main">Extra-Cirricular Activities</a></li><li><a href="address.php?link=staff" target="main">Addresses</a></li><li><a href="tandp.php?link=" target="main" style="text-decoration:none">T&P</a></li><li><a href="letter.php?link=staff" target="main" style="text-decoration:none">Send Letter</a></li><ul><li><a href="inbox.php?link=staff" target="main" style="text-decoration:none">Inbox</a></li><li><a href="outbox.php?link=staff" target="main" style="text-decoration:none">Outbox</a></li></ul><li><a href="calendar.php" target="main" style="text-decoration:none">Calendar</a></li></ul>';
   }
		?>
        </td>
        </tr>
        </table>
        </td></tr>
        <tr><td>
        
        </td>
        </tr>
        </table>
</body>
</html>