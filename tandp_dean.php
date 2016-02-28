<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php include("includes/header.php"); ?>

<?php
    if(isset($_POST['search'])){
	$sid = $_POST['sid'];
	$semester = $_POST['semester'];
	$student = mysql_query("select * from student where sid = '{$sid}'");
	$details = mysql_fetch_array($student);
}
	else
	{
	$sid = "";
	$semester = "";
		}

?>
<table width="100%" id="structure">
	<tr>
       <td id="page"><fieldset style="border-style:ridge"><legend align="center">Student Search</legend>
       <!--<h2 style="text-decoration:underline" align="center">Faculty Academics</h2>-->
       <table width="100%"><form action="tandp_dean.php?link=" method="post" name="f"><tr><td>
       <table align="center" style="animation:cubic-bezier()">
       <tr>
       <td><input type="text" name="sid" value="<?php echo $sid; ?>" /></td><td><h3>&lt;=&gt;</h3></td>
       <td>
       <select name="semester">
		 <option <?php if (isset($semester) && $semester=="") echo "selected";?> value="">--semester--</option>
		 <option <?php if (isset($semester) && $semester=="1") echo "selected";?>>1</option>
		 <option <?php if (isset($semester) && $semester=="2") echo "selected";?>>2</option>
		 <option <?php if (isset($semester) && $semester=="3") echo "selected";?>>3</option>
		 <option <?php if (isset($semester) && $semester=="4") echo "selected";?>>4</option>
		 <option <?php if (isset($semester) && $semester=="5") echo "selected";?>>5</option>
		 <option <?php if (isset($semester) && $semester=="6") echo "selected";?>>6</option>
		 <option <?php if (isset($semester) && $semester=="7") echo "selected";?>>7</option>
		 <option <?php if (isset($semester) && $semester=="8") echo "selected";?>>8</option>
		 </select>	
       </td><td><h3>&lt;=&gt;</h3></td>
       <td><input type="submit" name="search" style="background-color:#0F0" value="Search" /></td>
       </tr></table></td></tr></form>
<?php 
       
if(isset($_POST['search']))
{
 if(!empty($details))
	{
    echo '<tr><td><table width="100%" height="100%" border="1">
			<tr>
			  <td width="90%" align="center"><table width="100%" border="0">
				<tr>
				  <td>&nbsp;</td><td width="" align="center"><h3><strong>'.$details['username'].'</strong></h3></td><td>&nbsp;</td>
				</tr>
				
				<tr>
				  <td>&nbsp;</td><td ><strong>'.$details['dept'].', Section-'.$details['section'].'</strong></td><td>&nbsp;</td>
				</tr>
				<tr><td>Contacts: </td><td ><strong>'.$details['mobile'].'</strong></td><td align="center"><strong>'.$details['email'].'</strong></td></tr>
				<tr>
				 <td>Extra-Curricular Activities:</td><td><p >'.$details['extra'].'</p></td><td>&nbsp;</td>
				</tr>
				<tr><td><h2></h2></td></tr>
				<tr>
				  <td>Address:</td><td ><strong>'.$details['address'].'</strong></td><td>&nbsp;</td>
				</tr>
			  </table></td>
			  <td width="10%" align="center"><img src="showimage.php?id='.$sid.'&view=jb" alt="Profile Photo" width="140" height="140"/></td>
			</tr>
		  </table></td></tr><tr><td><hr/>
		  <h2 align="center">Academics of <b>'.$details['username'].'</b></h2>
		  <hr/></td></tr>';
	if(notnull($semester))
	{
						$queryresult = mysql_query("select * from marks where sid = '{$sid}' and semester = '{$semester}'");
						confirm_query($queryresult);
								if (!$queryresult) {
									// username/password authenticated
									// and only 1 match				
									$message = "No results found..!";
								}
								else{
								
								echo '<tr><td><fieldset style="border-style:dotted"><table id="page" border="1" width="100%" cellpadding="10"><caption><strong>Marks of Semester - '.$semester.'</strong></caption><colgroup><col style="background-color:#00CCFF; font-size:48px;"><col style="background-color:#FFFFFF; color:#000000; text-align:center"><col style="background-color:#FFFFFF; color:#000000; text-align:center"><col style="background-color:#FFFFFF; color:#000000; text-align:center"><col style="background-color:#FFFFFF; color:#000000; text-align:center"><col style="background-color:#FFFFFF; color:#000000; text-align:center"><col style="background-color:#FFFFFF; color:#000000; text-align:center"><col style="background-color:#FFFFFF; color:#000000; text-align:center"><col style="background-color:#FFFFFF; color:#000000; text-align:center"><col style="background-color:#FFFFFF; color:#000000; text-align:center"><col style="background-color:#FFFFFF; color:#000000; text-align:center"></colgroup><thead><tr><th>SUBJECT</th><th>Q-1</th><th>A-1</th><th>M-1</th><th>I-1</th><th>Q-2</th><th>A-2</th><th>M-2</th><th>I-2</th><th>I-F</th><th>Final</th></tr></thead><tbody>';
					
						
						$final = 0;
						$internal = 0;
						while($mark = mysql_fetch_array($queryresult)){
							$subname = mysql_query("select sname from subject where suid = '{$mark["suid"]}'");
							$subject = mysql_fetch_array($subname);
						echo '<tr><td align="center">'. $subject["sname"] . '</td><td align="center">' . $mark["q1"] .'</td><td align="center">'.$mark["a1"].'</td><td align="center">'.$mark["m1"].'</td><td align="center"><b>'.$mark["i1"].'</b></td><td align="center">'.$mark["q2"].'</td><td align="center">'.$mark["a2"].'</td><td align="center">'.$mark["m2"].'</td><td align="center"><b>'.$mark["i2"].'</b></td><td align="center"><b>'.$mark["inf"].'</b></td><td align="center"><b>'.$mark["f"].'</b></td></tr>';
						$final += $mark['f'];
						$internal += $mark['inf'];
							}
							$total = $internal + $final;
							echo '<tr><td align="center" colspan="9">Total: <b>'.$total.'</b></td><td align="center"><b>'.$internal.'</b></td><td align="center"><b>'.$final.'</b></td></tr>';
							echo '</tbody></table></fieldset></td></tr>';
							}
	}
else
{			//code for all semesters.
	
	$countsem = mysql_query("select max(semester) from marks where sid = '{$sid}'");
	$count = mysql_fetch_array($countsem);
	for($i = 1;$i<=$count[0];$i++){
	//semester 1
						$queryresult = mysql_query("select * from marks where sid = '{$sid}' and semester = '{$i}'");
						confirm_query($queryresult);
								if (!$queryresult) {
									// username/password authenticated
									// and only 1 match				
									$message = "No results found..!";
								}
								else{
								
								echo '<tr><td><fieldset style="border-style:dotted"><table id="page" border="1" width="100%" cellpadding="10"><caption><strong>Marks of Semester - '.$i.'</strong></caption><colgroup><col style="background-color:#00CCFF; font-size:48px;"><col style="background-color:#FFFFFF; color:#000000; text-align:center"><col style="background-color:#FFFFFF; color:#000000; text-align:center"><col style="background-color:#FFFFFF; color:#000000; text-align:center"><col style="background-color:#FFFFFF; color:#000000; text-align:center"><col style="background-color:#FFFFFF; color:#000000; text-align:center"><col style="background-color:#FFFFFF; color:#000000; text-align:center"><col style="background-color:#FFFFFF; color:#000000; text-align:center"><col style="background-color:#FFFFFF; color:#000000; text-align:center"><col style="background-color:#FFFFFF; color:#000000; text-align:center"><col style="background-color:#FFFFFF; color:#000000; text-align:center"></colgroup><thead><tr><th>SUBJECT</th><th>Q-1</th><th>A-1</th><th>M-1</th><th>I-1</th><th>Q-2</th><th>A-2</th><th>M-2</th><th>I-2</th><th>I-F</th><th>Final</th></tr></thead><tbody>';
					
						
						$final = 0;
						$internal = 0;
						while($mark = mysql_fetch_array($queryresult)){
							$subname = mysql_query("select sname from subject where suid = '{$mark["suid"]}'");
							$subject = mysql_fetch_array($subname);
						echo '<tr><td align="center">'. $subject["sname"] . '</td><td align="center">' . $mark["q1"] .'</td><td align="center">'.$mark["a1"].'</td><td align="center">'.$mark["m1"].'</td><td align="center"><b>'.$mark["i1"].'</b></td><td align="center">'.$mark["q2"].'</td><td align="center">'.$mark["a2"].'</td><td align="center">'.$mark["m2"].'</td><td align="center"><b>'.$mark["i2"].'</b></td><td align="center"><b>'.$mark["inf"].'</b></td><td align="center"><b>'.$mark["f"].'</b></td></tr>';
						$final += $mark['f'];
						$internal += $mark['inf'];
							}
							$total = $internal + $final;
							echo '<tr><td align="center" colspan="9">Total: <b>'.$total.'</b></td><td align="center"><b>'.$internal.'</b></td><td align="center"><b>'.$final.'</b></td></tr>';
							echo '</tbody></table></fieldset></td></tr>';
							}
			}
		}
	}
	else $message = "No results found. Make sure that Id is correct..!";
}
?>
<?php if (!empty($message)) {echo "<tr><td><p id='err' class=\"message\">" . $message . "</p></td></tr>";} ?>       
       </table></fieldset></td>
	</tr>
</table>
<?php include("includes/footer.php"); ?>
