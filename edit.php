<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>

<?php
include_once("includes/form_functions.php");
$ctable = $_GET['link'];
if(isset($_POST['cancel']))
{
redirect_to($_SESSION['page'].'?link=');
	}
	
/*Image code*/
if(isset($_POST['upload'])){
	if(isset($_FILES['pic']))
	{
	   // $check = getimagesize($_FILES["pic"]["tmp_name"]);
    	if($_FILES["pic"]["size"] != 0) {
      
	   $imageName = mysql_real_escape_string($_FILES["pic"]["name"]);
	   $imageData = mysql_real_escape_string(file_get_contents($_FILES["pic"]["tmp_name"]));
	   $imageType = mysql_real_escape_string($_FILES["pic"]["type"]);
	   if($_FILES["pic"]["type"] == "image/jpeg" || $_FILES["pic"]["type"] == "image/gif" || $_FILES["pic"]["type"] == "image/png" && $_FILES["pic"]["size"] < 2120000)
	   { 
	   		$pic = $imageData;	
		   if($ctable == "student"){
				$queryresult = mysql_query("UPDATE student set pic = '{$pic}' where sid = '{$_SESSION['user_id']}'");
				}
				else {
					$queryresult = mysql_query("UPDATE staff set pic = '{$pic}' where fid = '{$_SESSION['user_id']}'");
				}
		   }
		else
		{
			$msg = "Only images(.jpg/.jpeg) are allowed or image size must be less than 500KB..!";
			$pic = "";
			}
			if(!($queryresult))
				$msg = "Upload Failed..!";
			else $msg = "Upload Successful..!";
	}
	else $msg = "Choose any Image to upload..!";
	}
}
//managing content..****************************************************************************************************************	
if(isset($_POST['submit'])){
		
		//student content**************************************************************************************************************************
		if($ctable == "student")
			{
				$sid = $_SESSION['user_id'];
				$email = $_POST['email'];
				$extra = $_POST['extra'];
				//$mobile = $_POST['mobile'];
				if(notnull($email)){

						$queryresult = mysql_query("UPDATE student set email = '{$email}', extra = '{$extra}' where sid = '{$sid}'") or die(mysql_error());
								if (!$queryresult) {
									// username/password authenticated
									// and only 1 match	
									//die("error: ".mysql_error());			
									$message = "Update Failed..! Try again..!";
										}
									else	{
									redirect_to("$ctable.php?link=edsuc");
									}		
						}
						else $message = "Please fill the star Marked fields..!";
						$student = mysql_query("select * from student where sid = '{$_SESSION['user_id']}'");
					$details = mysql_fetch_array($student);
					$uname = $details['username'];
					$sex = $details['sex'];
					$mobile = $details['mobile'];
					$email = $details['email'];
					$address = $details['address'];
					$extra = $details['extra'];
					$parent = $details['parent'];
					$parentmobile = $details['parentmobile'];
				}
		else
		{
			
						$uname = $_POST['uname'];
						//$pic = $_POST['pic'];
						$sex = $_POST['sex'];
						$address = $_POST['address'];
						$email = $_POST['email'];
						$mobile = $_POST['mobile'];	
						if(notnull($mobile) && notnull($email) && notnull($uname)){
							if(validateMobile($mobile)) 
							{
									if($ctable == "staff"){
									$designation = $_POST['designation'];
									$specialisation = $_POST['specialisation'];
									$fid = $_SESSION['user_id'];
										$queryresult = mysql_query("UPDATE staff set fusername = '{$uname}', sex = '{$sex}', designation = '{$designation}', specialisation = '{$specialisation}', email = '{$email}', mobile = '{$mobile}', address = '{$address}' where fid = '{$fid}'");
									}
						
								if (!$queryresult) {
									// username/password authenticated
									// and only 1 match	
									die("error: ".mysql_error());			
									$message = "Update Failed..! Try again..!";
										}
									else	{
									redirect_to("$ctable.php?link=edsuc");
									}		
							}
							else $message = "Invalid Mobile Number..!";
						}
						else $message = "Please fill the star Marked fields..!";
						$staffdetails = mysql_query("select * from staff where fid = '{$_SESSION['user_id']}'");
						$details = mysql_fetch_array($staffdetails);
						$uname = $details['fusername'];
						$sex = $details['sex'];
						$mobile = $details['mobile'];
						$email = $details['email'];
						$address = $details['address'];
						$specialisation = $details['specialisation'];
		}
}
else
{
	if($ctable == "student")
	{
		$student = mysql_query("select * from student where sid = '{$_SESSION['user_id']}'");
		$details = mysql_fetch_array($student);
		$uname = $details['username'];
		$sex = $details['sex'];
		$mobile = $details['mobile'];
		$email = $details['email'];
		$address = $details['address'];
		$extra = $details['extra'];
		$parent = $details['parent'];
		$parentmobile = $details['parentmobile'];
		}
	else
	{
		$staffdetails = mysql_query("select * from staff where fid = '{$_SESSION['user_id']}'");
		$details = mysql_fetch_array($staffdetails);
		$uname = $details['fusername'];
		$sex = $details['sex'];
		$mobile = $details['mobile'];
		$email = $details['email'];
		$address = $details['address'];
		$specialisation = $details['specialisation'];
		}
}
	?>
<?php include("includes/header.php"); ?>
<table id="structure">
<tr>
<td id="page"><fieldset><legend>Edit your details..!</legend><div id="add"><h2>Current Details</h2>
<?php if (!empty($message)) {echo "<p id='err' class=\"message\">" . $message . "</p>";} ?>
<form action="edit.php?link=<?php echo $ctable; ?>" method="post" enctype='multipart/form-data'>


<?php 
if($ctable == "student"){

 echo '<table width="100%" align="center">
 <tr><td><b>Full Name</b></td><td>:<input type="text" name="uname" maxlength="50" value="'.$_SESSION['username'].'" readonly/></td></tr>
 <tr><td><h2> </h2></td></tr>';
 ?>
 <tr><td><b>Gender</b></td><td>:<input type="radio" value="male" <?php if($sex == "male") echo 'checked';?> name="sex"> Male&nbsp;&nbsp;<input type="radio" value="female" name="sex" <?php if($sex == "female") echo 'checked'; ?>> Female</td></tr>
 <?php 
 echo '<tr><td><h2> </h2></td></tr>
 <tr><td><b>E-mail</b><span style="color:red">*</span></td><td>:<input type="text" name="email" value="'. $email .'" maxlength="100"></td></tr>
 <tr><td><h2> </h2></td></tr>
 <tr><td><b>Mobile Number</b></td><td>:<input type="text" maxlength="10" name="mobile" value="'. $mobile .'" readonly></td></tr><tr><td><h2> </h2></td></tr>
 <tr><td><b>Guardian Name</b></td><td>:<input type="text" name="parent" maxlength="100" value="'. $parent .'" readonly/></td></tr>
 <tr><td><h2> </h2></td></tr>
 <tr><td><b>Guardian Mobile</b></td><td>:<input type="text" maxlength="10" name="parentmobile" value="'. $parentmobile .'" readonly></td></tr><tr><td><h2> </h2></td></tr>
 <tr><td><b>Address</b></td><td>:<textarea name="address" type="text" rows="4" cols="21" readonly>'. $address .'</textarea></td></tr>
 <tr><td><tr><td><h2> </h2></td></tr>
 <tr><td><b>Extra-curricular<br>Activities</b><span style="color:red">*</span></td><td>:<textarea name="extra" type="text" rows="4" cols="21">'. $extra .'</textarea></td></tr>
 <tr><td><tr><td><h2> </h2></td></tr>
 <tr><td>&nbsp;</td><td><table><tr>
 <td><input type="submit" name="submit" value="submit" /></td>
 <td><input type="submit" name="cancel" value="Cancel" /></td></tr></table></td>
 </tr>
 </table>
 </div>
 </fieldset>
 </td></tr>';

}
else if($ctable == "staff"){
	
	echo '<table width="100%" align="center"><tr><td>Full Name<span style="color:red">*</span></td><td>:<input type="text" name="uname" maxlength="50" value="'.$_SESSION['username'].'" /></td></tr><tr><td><h2> </h2></td></tr>';
	?>
	<tr><td>Gender</td><td>:<input type="radio" value="male" <?php if($sex == "male") echo 'checked';?> name="sex"> Male&nbsp;&nbsp; <input type="radio" value="female" name="sex" <?php if($sex == "female") echo 'checked'; ?>> Female</td></tr>
    <?php 
	echo '<tr><td><h2> </h2></td></tr>
	<tr><td>E-mail<span style="color:red">*</span></td><td>:<input type="text" name="email" value="'. $email .'"></td></tr>
	<tr><td><h2> </h2></td></tr>
	<tr><td>Mobile Number<span style="color:red">*</span></td><td>:<input type="text" maxlength="10" name="mobile" value="'. $mobile .'"></td></tr>
	<tr><td><h2> </h2></td></tr>
	<tr><td>Designation:</td><td><select name="designation"><option value="Assistant Professor">Assistant Professor</option><option value="Associate Professor">Associate Professor</option><option value="Professor">Professor</option><option value="HOD">Head of the Department</option></select></td></tr>
	<tr><td><h2> </h2></td></tr>
	<tr><td>Specialisation</td><td>:<input type="text" name="specialisation" maxlength="200" value="'. $specialisation .'"></td></tr>
	<tr><td><h2> </h2></td></tr>
	<tr><td>Address</td><td>:<textarea name="address" type="text" rows="4" cols="21">'. $address .'</textarea></td></tr>
	<tr><td><tr><td><h2> </h2></td></tr>
	<tr><td><tr><td><h2> </h2></td></tr>
 <tr><td>&nbsp;</td><td><table><tr>
 <td><input type="submit" name="submit" value="submit" /></td>
 <td><input type="submit" name="cancel" value="Cancel" /></td></tr></table></td>
 </tr></table></div></fieldset></td></tr>';
	
	}?>
            <?php if (!empty($msg)) {echo "<tr><td><p id='err' class=\"message\">" . $msg . "</p></td></tr>";} ?>
            <tr><td id="page">
            <table style="background-color:#0099FF">
            <tr><td><h2>Update Profile Picture:</h2></td></tr>
            <tr><td><input type="file" name="pic" id="filetoupload" value=""/></td><td><input type="submit" name="upload" value="Upload" /></td></form></tr><table>           
           </td></tr>
            </table>
<?php include("includes/footer.php"); ?>
