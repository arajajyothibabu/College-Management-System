<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php if(logged_in()){
	redirect_to("academics.php?link=student");
	} ?>
<?php
if(isset($_GET['link'])){ 
if($_GET['link'] == 1){
$message = "Username/password combination incorrect.<br />
			Please make sure your caps lock key is off and try again.";
     }
	 else if($_GET['link'] == "login")
	 $message = "Session timeout..! Please login to continue.";
}
?>
<?php include("header.php"); ?>
<table id="structure">
	<tr>
		<td id="" width="20%" style="background-color:#CCCCFF">
			<!--<a href="login.php"><img src="images/thank.png" alt="Home" /></a>-->
		</td>
		
		<td id="page">
        <?php if (!empty($message)) {echo "<p id='err' class=\"message\">" . $message . "</p>";} ?>
<div id="TabbedPanels1" class="TabbedPanels">
		  <ul class="TabbedPanelsTabGroup">
		    <li class="TabbedPanelsTab" tabindex="0">Student Login</li>
		    <li class="TabbedPanelsTab" tabindex="1">Staff Login</li>
	      </ul>
		  <div class="TabbedPanelsContentGroup">
		    <div class="TabbedPanelsContent">
            <form action="studentlogin.php?link=users" method="post">
			<table>
				<tr>
					<td>Username:</td>
					<td><input type="text" name="uname" maxlength="10" value="" /></td>
				</tr>
				<tr>
					<td>Password:</td>
					<td><input type="password" name="password" maxlength="50" value="" /></td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" name="submit" value="Login" /></td>
				</tr>
			</table>
			</form>
            </div>
		    <div class="TabbedPanelsContent">
            <form action="stafflogin.php?link=fusers" method="post">
			<table align="right">
				<tr>
					<td>Username:</td>
					<td><input type="text" name="uname" maxlength="10" value="" /></td>
				</tr>
				<tr>
					<td>Password:</td>
					<td><input type="password" name="password" maxlength="50" value="" /></td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" name="submit" value="Login" /></td>
				</tr>
			</table>
			</form>
            </div>
	      </div>
   	 </div>
        </td>
        <td id="" width="20%" style="background-color:#CCCCFF">
        <fieldset><legend><h2>Notifications</h2></legend>
        <marquee behavior="scroll" scrolldelay="200" onMouseOver="this.stop()" onMouseOut="this.start()" align="middle" direction="up"><a href="http://www.juntuworld.com" target="_blank">Jntu World</a><br /><br /><a href="http://www.csame.org" target="_blank">CSAME</a><br /><br /><a href="http://www.tcs.nextstep.com" target="_blank">Campus Commune</a><br /><br /><a href="http://www.indiabix.com" target="_blank">IndiaBix</a><br /><br /><a href="http://www.brilliant.org" target="_blank">Brilliant.org</a></marquee>
        </fieldset>
		</td>
 	</tr>
</table>
		<script type="text/javascript">
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
        </script>
<?php include("includes/footer.php"); ?>
