<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php if(logged_in()){
	redirect_to($_SESSION['page']."?link=");
	} ?>
<?php
if(isset($_GET['link'])){ 
if($_GET['link'] == 1){
$message = "Username/password combination incorrect.<br />
			Please make sure your caps lock key is off and try again.";
     }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>GVP Academics</title>
		<link href="stylesheets/public.css" media="all" rel="stylesheet" type="text/css" />
        <script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
		<link href="stylesheets/SpryAccordion.css" rel="stylesheet" type="text/css" />
</head>

<body>

</body>

</html>