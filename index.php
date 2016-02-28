<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php if(logged_in()){
	redirect_to("academics.php?link=");
	} ?>
<?php
if(isset($_GET['link'])){ 
if($_GET['link'] == 1){
$message = "Username/password combination incorrect.<br />
			Please make sure your caps lock key is off and try again.";
     }
}
?>
<?php include("includes/header.php"); ?>
<table id="structure">
	<tr>
		<td id="navigation">
			<a href="index.php"><img src="images/thank.png" alt="Home" /></a>
		</td>
		
		<td id="page"> <?php if (!empty($message)) {echo "<p id='err' class=\"message\">" . $message . "</p>";} ?>
<div id="Accordion1" class="Accordion" tabindex="0">
  <div class="AccordionPanel">
    <div class="AccordionPanelTab">Student Login</div>
    <div class="AccordionPanelContent">
			<form action="studentlogin.php?link=users" method="post">
			<table>
				<tr>
					<td>Username:</td>
					<td><input type="text" name="uname" maxlength="10" value="" /></td>
				</tr>
				<tr>
					<td>Password:</td>
					<td><input type="password" name="password" maxlength="20" value="" /></td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" name="submit" value="Login" /></td>
				</tr>
			</table>
			</form></div>
  </div>
  <div class="AccordionPanel">
    <div class="AccordionPanelTab">Staff Login</div>
    <div class="AccordionPanelContent">
    		<form action="stafflogin.php?link=fusers" method="post">
			<table>
				<tr>
					<td>Username:</td>
					<td><input type="text" name="uname" maxlength="10" value="" /></td>
				</tr>
				<tr>
					<td>Password:</td>
					<td><input type="password" name="password" maxlength="20" value="" /></td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" name="submit" value="Login" /></td>
				</tr>
			</table>
			</form></div></div>
  </div>
</div>
<script type="text/javascript">
var Accordion1 = new Spry.Widget.Accordion("Accordion1");
</script>
        </td>
        <td id="sidebar">
        <fieldset><legend><h2>Notifications</h2></legend>
        <marquee behavior="scroll" scrolldelay="20" onmouseover="this.stop()" onmouseout="this.start()" align="middle" direction="up">Welcome Gvpians</marquee>
        </fieldset>
		</td>
 	</tr>
</table>
<?php include("includes/footer.php"); ?>
