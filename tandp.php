<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>
<?php 


?>

<table width="100%" id="structure">
	<tr>
       <td id="page"><fieldset style="border-style:ridge"><legend align="center">Training and Placements</legend><h2 align="center">Notifications</h2>
<?php
$notifications = mysql_query("select DISTINCT(note) from tandp where dept = '{$_SESSION['dept']}' or dept = 'ALL' order by sno DESC") or die(mysql_error());
if($notifications)
{
	$color = "#CCCCCC";
	$i = 0;
	$n = 1;
	while($note = mysql_fetch_array($notifications))
	{
		if($color == "#CCCCCC") $color = "#66FFCC";
		else $color = "#CCCCCC";
	echo '<table width="100%" >
			<tr style="background-color:'.$color.'">
			<td style="font-size:16px">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>'.$n.'</b>';
			$i += 1; 
			$n += 1;
			if($i <= 3)
			echo '<span><img src="images/new.gif"</span>';
			echo $note['note'].'			
			</td>
			</tr>
			<tr>
			<td align="right"></td>
			</tr>
			</table>';	
		}
	}


?>
       
       </fieldset></td><td bgcolor="#66FFCC" bgcolor="#CCCCCC"
	</tr>
</table>
<?php include("includes/footer.php"); ?>
