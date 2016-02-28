<!DOCTYPE html>
<?php require_once("includes/session.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php confirm_logged_in(); ?>
<html>
	<head>
    	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>GVP Academics</title>
		<link href="stylesheets/public.css" media="all" rel="stylesheet" type="text/css" />
        </head>
        <body>
<?php $message = "";
if($_GET['link']=="student"){
	$uid = $_SESSION['user_id'];
	$uname = $_SESSION['username'];
	$page = "student.php";
	}
	else{
		$uid = $_SESSION['user_id'];
		$uname = $_SESSION['username'];
		$page = "staff.php";
		}
 ?>
<?php
if(isset($_POST['cancel']))
{
	redirect_to($_SESSION['page']."?link=");
	}
	?>
 <?php 
 if(isset($_POST['submit'])){
	 $place = $_POST['place'];
	 $d1 = $_POST['d1'];
	 $m1 = $_POST['m1'];
	 $y1 = $_POST['y1'];
	 $letterto = $_POST['letterto'];
	 $subject = $_POST['subject'];
	 $content = $_POST['content'];
	 $request = $_POST['request'];
	 if(isset($_POST['check']) && $_POST['check']== "1")
	 {
	  $d2 = $_POST['d2'];
	 $m2 = $_POST['m2'];
	 $y2 = $_POST['y2'];
	  $d3 = $_POST['d3'];
	 $m3 = $_POST['m3'];
	 $y3 = $_POST['y3'];
	 //code for leave letter************************************
	 if(notnull($place) && notnull($d1) && notnull($d2) && notnull($m1) && notnull($m2) && notnull($y1) && notnull($y2) && notnull($letterto) && notnull($subject) && notnull($content) && notnull($request) && notnull($d3) && notnull($m3) && notnull($y3)){
		 $date = $y1 . "-" . $m1 . "-" . $d1;
		 $fromdate = $y2 . "-" . $m2 . "-" . $d2;
		 $todate = $y3 . "-" . $m3 . "-" . $d3;
		 $qr = mysql_query("INSERT INTO letter values('', '{$uid}', '{$place}', '{$date}', '{$letterto}', '{$_SESSION['dept']}','{$subject}', '{$content}', '{$fromdate}', '{$todate}', '{$request}','0')") or die(mysql_error());
		 if(!$qr){
			 $message = "Submission failed..!";
			 }
			 else {
				 $message = "Succesfully sent";
				 }
		 }
		 else {
			 $message = "Every field must be filled in leave letter..!";
			 }
	 
	 }
	 else
	 {
			 if(notnull($place) && notnull($d1) && notnull($m1) && notnull($y1) && notnull($letterto) && notnull($subject) && notnull($content) && notnull($request)){
				 $date = $y1 . "-" . $m1 . "-" . $d1;
				 
				 $qr = mysql_query("INSERT INTO letter values('', '{$uid}', '{$place}', '{$date}', '{$letterto}', '{$_SESSION['dept']}','{$subject}', '{$content}', '', '', '{$request}','0')") or die(mysql_error());
				 if(!$qr){
					 $message = "Submission failed..!";
					 }
					 else {
						 $message = "Succesfully sent";
						 }
				 }
				 else {
					 $message = "Every field must be filled..!";
					 }
	 }
	 }
else
{
	$d1 = "";
	$d2 = "";
	$d3 = "";
	$m1 = "";
	$m2 = "";
	$m3 = "";
	$y1 = "";
	$y2 = "";
	$y3 = "";
	$place = "";
	$request = "Kindly grant me permission...";
	$content = "The content of the letter, reason ...";
	$subject = "Requesting leave for...";
	$letterto = "";
	}
 
 ?>
<table id="structure">
<tr>
<td id="page">
        <fieldset>
        <legend align="center"><h2>Edit your Letter</h2></legend>
        <table>
        <form action="letter.php?link=<?php echo $_GET['link']; ?>" method="post" name="form1">
        <?php if (!empty($message)) {echo "<tr><td><p id='err' class=\"message\">" . $message . "</p></td></tr>";} ?>
        <tr>
        <td><b>From (Place)</b></td><td>:<input type="text" name="place" value="<?php echo $place; ?>" ></td>
        </tr>
        <tr><td><h3> </h3></td></tr>
        <tr>
        <td><b>Date </b></td><td><table><tr><td><select name="d1" ><option value="">day-</option><?php day(); ?></select></td><td><select name="m1"><option value="">month</option><?php month(); ?></select></td><td><select name="y1"><option value="">year</option><?php year(); ?></select></td></tr></table></td>
        </tr>
        <tr><td><h3> </h3></td></tr>
        <tr>
        <td><b>Letter to</b></td><td>:<select name="letterto" ><option value="">--staff--</option><option value="">HOD</option><option value="">Principal</option>
        <?php 
		$uid = $_SESSION['user_id'];
		if($_SESSION['page'] == "student.php")
		{
			$dept = $_SESSION['dept'];
			$semester = $_SESSION['semester'];
			$section = $_SESSION['section'];
			
			$subqry = mysql_query("select distinct(fid) from subject where dept = '{$dept}' and semester = '{$semester}' and section = '{$section}'");
				if($subqry)
				{
					while($q = mysql_fetch_array($subqry))
					{
						$qry = mysql_query("select * from staff where fid = '{$q['fid']}'");
						$fname = mysql_fetch_array($qry);
						//$fname = mysql_fetch_array($qry);
						echo '<option value="'.$fname['fid'].'">'. $fname['fusername'] .'</option>';
						}	
					}
					else $message = "No data found..!";
		}
		else
		{		
					$qry = mysql_query("select fusername from staff where dept = '{$_SESSION['dept']}'");
					while($fname = mysql_fetch_array($qry))
					//$fname = mysql_fetch_array($qry);
					echo '<option value="'.$_SESSION['user_id'].'">'. $fname['fusername'] .'</option>';	
		}
		?>
        </select></td></tr>
        <tr><td><h3> </h3></td></tr>
        <tr>
        <td><b>Subject</b></td><td>:<textarea type="text" name="subject" rows="3" cols="40"><?php echo $subject; ?></textarea></td>
        </tr>
        <tr><td><h3> </h3></td></tr>
        <tr>
        <td><b>Content</b></td><td>:<textarea type="text" name="content" rows="3" cols="40"><?php echo $content; ?></textarea></td>
        </tr>
        <tr><td><p><input type="checkbox" name="check" id="active" value="1" onChange="myf()"/>Check, for Leave letter</p></td></tr>
	
	<script type="text/javascript">
        function myf()
        {
            if(document.form1.check.checked)
                document.getElementById("active_sub").style.visibility="visible";
            else
                document.getElementById("active_sub").style.visibility="hidden";
        }
		</script>
	<tr><td><h2>  </h2></td><td>
    <table style="visibility:hidden" id="active_sub">
        <tr><td><b>From Date:</b></td>
        	<td>
            <table>
            <tr>
            	<td><select name='d2'><option value=''>-day-</option>"<?php echo day(); ?>"</select></td>
            	<td><select name='m2'><option value=''>-month-</option>"<?php echo month(); ?>"</select></td>
                <td><select name='y2'><option value=''>-year-</option>"<?php echo year(); ?>"</select></td>
            </tr>
            </table>
            </td>
       	</tr>
        <tr><td><h3> </h3></td></tr>
        <tr><td><b>To Date:</b></td>
            <td>
                <table>
                <tr>
                	<td><select name='d3'><option value=''>-day-</option>"<?php echo day(); ?>"</select></td>
                	<td><select name='m3'><option value=''>-month-</option>"<?php echo month(); ?>"</select></td>
                	<td><select name='y3'><option value=''>-year-</option>"<?php echo year(); ?>"</select></td>
                </tr>
                </table>
            </td>
        </tr>
        </table></td></tr>
       <tr><td><h3> </h3></td></tr>
        <tr>
        <td><b>Request</b></td><td>:<textarea type="text" name="request" rows="3" cols="40"><?php echo $request; ?></textarea></td>
        </tr>
        <tr><td><h3> </h3></td></tr>
        <tr>
        <td colspan="2"> </td><td><input type="submit" name="submit" value="Submit"></td><td><input type="submit" name="cancel" value="Cancel"></td></tr>
        </form>
        </table>
        </fieldset>
</td>
</tr>
</table>
<?php include("includes/footer.php"); ?>