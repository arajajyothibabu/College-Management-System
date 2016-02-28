<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php 
if(isset($_GET['id']))
{
	if($_SESSION['user']=="student" || isset($_GET['view'])){
$query = mysql_query("select * from student where sid = '{$_GET['id']}'");
//die(mysql_error());
	}
	else 
	{
$query = mysql_query("select * from staff where fid = '{$_GET['id']}'");	
		}
				while($qr = mysql_fetch_array($query))
				{
					//die(mysql_error());
					$imageData = $qr['pic'];
					}
	if(empty($imageData))
	{
	$query = mysql_query("select * from admin where sno = '1'");	
				while($qr = mysql_fetch_array($query))
				{
					//die(mysql_error());
					$imageData = $qr['userpic'];
					}
	}
	header("content-type: image/jpeg");
	echo $imageData;
}
else echo "No Image";
?>