<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php if(!logged_in()){
	redirect_to("login.php?link=login");
	} ?>
<?php
if(isset($_GET['link'])){ 
if($_GET['link'] == 1){
$message = "Username/password combination incorrect.<br />
			Please make sure your caps lock key is off and try again.";
     }
}
?>
<html>
	<head>
    	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="icon" href="favicon.ico" type="image/vnd.microsoft.icon">
		<title>GVP Academics</title>
		<link href="stylesheets/public.css" media="all" rel="stylesheet" type="text/css" />
        <script src="javascripts/functions.js" type="text/javascript"></script>
		<link href="stylesheets/SpryAccordion.css" rel="stylesheet" type="text/css" />
	</head>
    <frameset rows="15%,79%,*" border="0">
    <frame src="header.php" name="header" scrolling="no" noresize>
    <frameset cols="20%,60%,*" border="0">
    <frame src="navigation.php" name="navigation" scrolling="no" noresize>
    <frame src="main.php" name="main" scrolling="auto" noresize>
    <frame src="sidebar.php" name="sidebar" scrolling="no" noresize>
    </frameset>
    <frame src="footer.php" name="footer" scrolling="no" noresize>
    </frameset><noframes></noframes>
</html>