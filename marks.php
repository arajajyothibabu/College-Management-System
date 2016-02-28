
<?php 
$sid = array();
$q1 = array();
$q2 = array();
$a1 = array();
$a2 = array();
$m1 = array();
$m2 = array();
$f = array();
 ?>

<?php  ?>
  
<td id="page">
<fieldset>
<legend>Academic Results</legend>

<tr>
<td><?php if (!empty($message)) {echo "<p id='err' class=\"message\">" . $message . "</p>";} ?></td>
</tr>
<?php 
if(isset($_POST['submit']) ||isset($_POST['update'])){
if(isset($_POST['update'])){
	$i = 0;
	while($i < $n){
		
	$fsid = $_POST['$sid[$i]'];
	$fq1 = $_POST['$q1[$i]'];
	$fa1 = $_POST['$a1[$i]'];
	$fm1 = $_POST['$m1[$i]'];
	$fi1 = $fq1+$fa1+$fm1;
	$fq2 = $_POST['$q2[$i]'];
	$fa2 = $_POST['$a2[$i]'];
	$fm2 = $_POST['$m2[$i]'];
	$fi2 = $fq2+$fa2+$fm2;
	if($fm1>$fm2){ $fm = $fm1; $fn = $fm2;}
	else {$fm = $fm2; $fn = $fm1;}
	$finf = ($fq1+$fq2)/2+($fm1+$fm2)/2+(2*$fm+$fn)/3;
	$ff = $_POST['$f'];
	
	$q = mysql_query("UPDATE marks set q1 = '$fq1', q2 = '$fq2', a1 = '$fa1', a2 = '$fa2', m1 = '$fm1', m2 = '$fm2', i1 = '$fi1', i2 = '$fi2', inf = '$finf', f = '$ff' where sid ='{$fsid}'");
	if(!$q){
		$message .= "Update failed..! at {$fsid}". "<br />";
		}
	}
	$suid = $_POST['suid'];

	if($_GET['jb'] != "view"){
		$dept = $_POST['dept'];
		$semister = $_POST['semister'];
		$section = $_POST['section'];
	}
	else{
		$dept = NULL;
		$semister = NULL;
		$section = NULL;
		}
if(notnull($semister) && notnull($dept) && notnull($suid) && notnull($section)){
$querys = mysql_query("select * from marks where semister = '{$semister}' and dept = '{$dept}' and suid = '{$suid}' and section = '{$section}'");
}
else if(notnull($semister) && notnull($dept) && notnull($suid)){
$querys = mysql_query("select * from marks where semister = '{$semister}' and dept = '{$dept}' and suid = '{$suid}'");
}
else if(notnull($semister) && notnull($suid)){
$querys = mysql_query("select * from marks where semister = '{$semister}' and suid = '{$suid}'");
}
else if(notnull($semister)){
$querys = mysql_query("select * from marks where semister = '{$semister}'");
}
else{
$message = "Select something to update..!";
$querys = NULL;
}
confirm_query($querys);
$qr = mysql_fetch_array($querys);

if(isset($qr)){
	echo '<tr><table border="1" cellpadding="5" width="100%" id="t"><caption>Marks Table To Update</caption><colgroup><col style="background-color:#00CCFF; font-size:48px;"><col style="background-color:#FFFFFF; color:#000000; text-align:center"></colgroup><thead><tr><th>Student-Id<th>Q-1</th><th>A-1</th><th>M-1</th><th>I-1</th><th>Q-2</th><th>A-2</th><th>M-2</th><th>I-2</th><th>I-F</th><th>Final</th></tr></thead>';
	
	$i = 0;
	while($qr = mysql_fetch_array($querys)){
	echo '<tbody><form action="marks.php"><td><input style="width:40" type="text" name="'.$sid[$i].'" value="'. $qr["sid"]. '"/></td><td><input style="width:40" type="text" name="'.$q1[$i].'" value="'. $qr["q1"]. '"/></td><td><input style="width:40" name="'.$a1[$i].'" type="text" value="'.$qr["a1"].'"/></td><td><input style="width:40" name="'.$m1[$i].'" type="text" value="'.$qr["m1"].'" /></td><td>'.$qr["i1"].'</td><td><input style="width:40" name="'.$q2[$i].'" type="text" value="'.$qr["q2"].'"/></td><td><input style="width:40" type="text" name="'.$a2[$i].'" value="'.$qr["a2"].'"/></td><td><input style="width:40" name="'.$m2[$i].'" type="text" value="'.$qr["m2"].'"/></td><td>'.$qr["i2"].'</td><td>'.$qr["inf"].'</td><td><input style="width:40" type="text" name="'.$f[$i].'" value="'.$qr["f"].'"/></td></tr></form>';
								$i = $i + 1;
								}
			$n = $i;					
	echo '<tr><td><input type="submit" name="update" value="Update" /></td></tr></tbody></table></tr>';
			}
			else{
			$message = "No Data Found..!";
				}
	}
}
	
else if(isset($_POST['insert']) && $_GET['link']=="student"){
$dept = $_POST['dept'];
$semister = $_POST['semister'];
$suid = $_POST['suid'];
$section = $_POST['section'];
$uid = $_SESSION['user_id'];
$queryset = mysql_query("INSERT into marks VALUES('$semister','$dept','$section','$suid','','$uid','','','','','','','','','','')");
confirm_query($queryset);
}
else if(isset($_POST['submit']) && $_GET['link']=="student"){
$suid = $_POST['suid'];
$uid = $_SESSION['user_id'];
if($suid = "ALL"){
$queryset = mysql_query("select * from marks where sid = '$uid'");
	}
	else{
$queryset = mysql_query("select * from marks where suid = '$suid' and sid = '$uid'");
	}
confirm_query($queryset);
$mark = mysql_fetch_array($queryset);

if(isset($mark)){
	echo '<tr><table border="1" width="600" cellpadding="10"><caption>Marks of Semister-'. $mark["semister"].'</caption><colgroup><col style="background-color:#00CCFF; font-size:48px;"><col style="background-color:#FFFFFF; color:#000000; text-align:center"></colgroup><thead><tr><th>SUBJECT</th><th>Q-1</th><th>A-1</th><th>M-1</th><th>I-1</th><th>Q-2</th><th>A-2</th><th>M-2</th><th>I-2</th><th>I-F</th><th>Final</th></tr></thead><tbody>';
	while($mark = mysql_fetch_array($queryset)){
	echo '<tr><td>'. $mark["suid"] . '</td><td>' . $mark["q1"] .'</td><td>'.$mark["a1"].'</td><td>'.$mark["m1"].'</td><td>'.$mark["i1"].'</td><td>'.$mark["q2"].'</td><td>'.$mark["a2"].'</td><td>'.$mark["m2"].'</td><td>'.$mark["i2"].'</td><td>'.$mark["inf"].'</td><td>'.$mark["f"].'</td></tr>';
	}
		echo '</tbody></table></tr>';
	}
}

?>
</form>
</table>
</fieldset>
</td>

<?php include("includes/footer.php"); ?>








<?php 
if(logged_in()){
			$stus = '<td id="sidebar"><table id="page1"><tr><td><h2 align="center" style="text-decoration:underline">Student Details</h2>';
if (!empty($message)) {$stus .= '<p class=\"message\">' . $message . '</p>';} 
$stus .= '<fieldset><legend>Self Details</legend><table><tr><td width="254"><table width="200"><tr><td width="120"><img src="'. $found_user['pic'].'" alt="Profile Pic" width=120 height=120 style="border-color:aqua" align="absmiddle"></td></tr><tr><td>Regd Number</td><td>:'. $found_user['sid'].'</td></tr><tr><td><h1></h1></td></tr><tr><td>Department</td><td>:'. $found_user['dept'].'</td></tr><tr><td><h1></h1></td></tr><tr><td >section</td><td>:'.$found_user['section'].'</td></tr><tr><td><h1></h1></td></tr><tr><td>Semister</td><td>:'.$found_user['semister'].'</td></tr></table></td></tr></table></fieldset></td></tr><tr><td><h2>Notifications:</h2></td></tr></table></td></tr></table>';
        echo $stus;
        }
		else if(logged_inn()){
			$stas = '<td id="sidebar"><table id="page1"><tr><td><h2 align="center" style="text-decoration:underline">Student Details</h2>';
if (!empty($message)) {$stas .= '<p class=\"message\">"' . $message . '</p>';}
$stas .= '<fieldset><legend>Self Details</legend><table><tr><td width="254"><table width="200"><tr><td width="120"><img src="'. $found_user['pic'].'" alt="Profile Pic" width=120 height=120 style="border-color:aqua" align="absmiddle"></td></tr><tr><td>Regd Number</td><td>:'. $found_user['sid'].'</td></tr><tr><td><h1></h1></td></tr><tr><td>Department</td><td>:'. $found_user['dept'].'</td></tr><tr><td><h1></h1></td></tr><tr><td >section</td><td>:'.$found_user['section'].'</td></tr><tr><td><h1></h1></td></tr><tr><td>Semister</td><td>:'.$found_user['semister'].'</td></tr></table></td></tr></table></fieldset></td></tr><tr><td><h2>Notifications:</h2></td></tr></table></td></tr></table>';
			echo $stas;
			}
?>









if(isset($_POST['update'])){
			$q = mysql_query("UPDATE marks set q1 = '$fq1', q2 = '$fq2', a1 = '$fa1', a2 = '$fa2', m1 = '$fm1', m2 = '$fm2', i1 = '$fi1', i2 = '$fi2', inf = '$finf', f = '$ff' where sid ='{$fsid}'");	
		}
        
        




//Option field
<?php if($_GET['link']=="student" || $_GET['link']=="staff"){
	echo '<table><tr><td><form action="marks.php?link='.$_GET['link'].'&jb='.$_GET['jb'].'" method="post" ><table><tr><td><select name="dept" ><option value="">--Branch--</option><option value="CSE">CSE</option><option value="CHE">Chemical</option><option value="CIV">Civil</option><option value="ECE">ECE</option><option value="EEE">EEE</option><option value="IT">It</option><option value="MECH">Mechanical</option></select></td><td><select name="semister"><option value="">--semister--</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option></select></td><td><select name="suid"><option value="">--subject--</option><option value="ACT1113">CG</option><option value="ACT1114">FLAT</option><option value="ACT1131">AI</option><option value="ACT1115">MPI</option><option value="ACT1116">DAA</option><option value="ACT1117">SE</option><option value="ACT1118">MPI LAB</option><option value="AHE1103">ACS LAB</option></select></td><td><select name="section"><option value="">--section--</option><option value="1">1</option><option value="2">2</option><option value="3">3</option></select></td><td colspan="2"><input type="submit" name="insert" value="Insert" /></td></tr></table></td></tr>';
}
if($_GET['jb'] == "view" && $_GET['link']=="student"){
echo '<tr><td><select name="suid"><option value="">--subject--</option><option value="ACT1113">CG</option><option value="ACT1114">FLAT</option><option value="ACT1131">AI</option><option value="ACT1115">MPI</option><option value="ACT1116">DAA</option><option value="ACT1117">SE</option><option value="ACT1118">MPI LAB</option><option value="AHE1103">ACS LAB</option><option value="ALL">ALL</option></select></td><td width="108"><input type="submit" name="submit" value="View Marks" /></td></tr>';
}
?>



$stu ='<table id="structure"><tr><td id="navigation"><p>Welcome </p><h2>';
 $stu .= $_SESSION['username'];
 $stu .='.</h2><ul><li><a href="edit.php?link=student" style="text-decoration:none">Manage your Content</a></li><li><a href="changepassword.php?link=users" style="text-decoration:none">Change Password</a></li><li><a href="logout.php" style="text-decoration:none">Logout</a></li></ul><h3>Select Activity</h3><table id="navigation"><tr><td><ul><li><a href="marks.php?link=student&jb=" style="text-decoration:none">Subject Selection</a></li><li><a href="marks.php?link=student&jb=view" style="text-decoration:none">Marks</a></li><li><a href="attendance.php?link=student&jb=" style="text-decoration:none">Attendance</a></li><li><a href="letter.php?link=student&jb=" style="text-decoration:none">Letters</a></li></ul></td></tr></table></td>';
        echo $stu;

	$result = mysql_query("select * from student where sid = '{$_SESSION['user_id']}'"); 
                            confirm_query($result);
                            if (mysql_num_rows($result) == 1) {
                                // username/password authenticated
                                // and only 1 match
                                $found_user = mysql_fetch_array($result);
                            }
                            else {
								$message= "Enter your details through 'Manage your Content'"; 
								$found_user = NULL;
							}
                            
                            
                            
                            
                           
                           
                           
                           
$sta = '<table width="100%" id="structure"><tr><td width="20%" id="navigation"><p>Welcome</p><h2>';
$sta .= $_SESSION['fusername']; 	
$sta .= '.</h2><ul><li><a href="edit.php?link=staff">Manage your Content</a></li><li><a href="notify.php">Notifications</a></li><li><a href="changepassword.php?link=fusers">Change Password</a></li><li><a href="logout.php">Logout</a></li></ul><h3>Select Activity</h3><table id="navigation"><tr><td><ul><li><a href="marks.php?link=staff&jb=" style="text-decoration:none">Subject Selection</a></li><li><a href="marks.php?link=staff&jb=" style="text-decoration:none">Marks</a></li><li><a href="attendance.php?link=staff&jb=" style="text-decoration:none">Attendance</a></li><li><a href="letter.php?link=staff&jb=" style="text-decoration:none">Letters</a></li></ul></td></tr></table></td>';
			echo $sta;

			 $result = mysql_query("select * from staff where fid = '{$_SESSION['fuser_id']}'"); 
                            confirm_query($result);
                            if (mysql_num_rows($result) == 1) {
                                // username/password authenticated
                                // and only 1 match
                                $found_user = mysql_fetch_array($result);
                            }
                            else {
								$message= "Enter your details through 'Manage youe Content'"; 
								$found_user = NULL;
							}
							
