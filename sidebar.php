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
		<link href="stylesheets/public.css" media="all" rel="stylesheet" type="text/css" />
        <script src="javascripts/functions.js" type="text/javascript"></script>
		<link href="stylesheets/SpryAccordion.css" rel="stylesheet" type="text/css" />
	</head>
    <body style="background-color:#CCF">
<table id="sidebar">
<tr>
<td>
         
						<?php
						if($_SESSION['user']=="student")
						{
							 $result = mysql_query("select * from student where sid = '{$_SESSION['user_id']}'"); 
                            confirm_query($result);
                            if ($result) {
                                // username/password authenticated
                                // and only 1 match
                                $found_user = mysql_fetch_array($result);
								$dept = $found_user['dept'];
								$sec = $found_user['section'];
								$sem = $found_user['semester'];
								$query = mysql_query("select * from notify where section = '{$sec}' and semester = '{$sem}' and dept = '{$dept}'");
                            confirm_query($query);
							}
							echo '<fieldset><legend><h2>Student Profile</h2></legend><table width="100%"><tr><td width="50%"><img src="showimage.php?id='. $_SESSION['user_id'].'" alt="Profile Pic" width=120 height=120 style="border-color:aqua" align="absmiddle"></td></tr><tr><td>Regd Number</td><td>:'. $found_user["sid"].'</td></tr><tr><td>Department</td><td>:'.$found_user["dept"].'</td></tr><tr><td >section</td><td>:'. $found_user["section"].' </td></tr><tr><td>Semister</td><td>:'. $found_user["semester"].' </td></tr></table></fieldset></td></tr><tr><td><hr /></td></tr><tr><td><fieldset><legend><h2>Notifications</h2></legend><marquee scrolldelay="200" behavior="scroll" onmouseover="this.stop()" onmouseout="this.start()" direction="up">';

					  if(!isset($query)){
						  echo 'No notifications';
						  }
						else {
						 	$i = 1;
							if($query){
					  while($qr = mysql_fetch_array($query)){
						  echo '<b>'.$qr['short'].'</b>:- '.$qr["note"].'<br/><br/>';
						  $i++;
						  }
							}
							else {
								echo 'No notifications';
								}
						}
						 echo '</marquee>';
						 }
					else
					{
						 $result = mysql_query("select * from staff where fid = '{$_SESSION['user_id']}'"); 
                            confirm_query($result);
                            if (mysql_num_rows($result) == 1) {
                                // username/password authenticated
                                // and only 1 match
                                $found_user = mysql_fetch_array($result);
								$dept = $found_user['dept'];
                            $query = mysql_query("select * from notify where dept = '{$dept}'");
							}
							 echo  '<fieldset><legend><h2>Faculty Profile</h2></legend><table width="100%"><tr><td width="50%"><img src="showimage.php?id='. $_SESSION['user_id'].'" alt="Profile Pic" width=120 height=120 style="border-color:aqua" align="absmiddle"></td></tr><tr><td>Regd Number</td><td>:'. $found_user["fid"].'</td></tr><tr><td>Department</td><td>:'. $found_user["dept"].'</td></tr><tr><td>Designation</td><td>:'.$found_user["designation"].'</td></tr><tr><td >Specialisation</td><td>:'.$found_user["specialisation"].'</td></tr></table></fieldset></td></tr><tr><td><fieldset><legend><h2>Notifications</h2></legend><marquee scrolldelay="100" behavior="scroll" onmouseover="this.stop()" onmouseout="this.start()" direction="up">';
							   
					  if(isset($query)){
						  echo 'No notifications';
						  }
						else {
						 	$i = 1;
					  if($query){
					  while($qr = mysql_fetch_array($query)){
						  echo $i.'. '.$qr["note"].'<br/><br/>';
						  $i++;
						  }
							}
							else {
								echo 'No notifications';
								}
						}
						  echo '</marquee>';
					}
					  ?>
                      </fieldset>
</td>
</tr>
</table>
</body>
</html>