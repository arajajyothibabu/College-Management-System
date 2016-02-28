<?php require_once("includes/session.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php confirm_logged_in(); ?>
<?php include("includes/header.php"); ?>
<?php $message = "";?>
<?php $fid = $_SESSION['user_id']; ?>
<?php 
if(isset($_POST['select']) || isset($_POST['update'])){
												
												if(isset($_POST['update'])){
													$i = 1;
													//settype($n,"Integer");
													$sid = $_POST['sid'];
													$noc = $_POST['noc'];   
													$nocp = $_POST['nocp'];
								
													foreach($sid as $i => $j){
														
													if(notnull($noc))
													$noca[$i] = ceil(($nocp[$i] / $noc) * 100);
													else $noca[$i] = "N/A";
													if($noca[$i] >= 75) $stat[$i] = "Safe";
													else if($noca[$i] >= 65 && $noca[$i] < 75) $stat[$i] = "Condonation";
													else if($noca[$i] < 65)
													$stat[$i] = "Detain";
													else $stat[$i] = "";
													
												if(isset($_POST['suid'])) //query staff having more than one class
												{
													$q = mysql_query("UPDATE attendance set noc = '$noc', nocp = '$nocp[$i]', noca = '$noca[$i]', stat = '$stat[$i]' where sid ='{$sid[$i]}' and fid = '{$fid}' suid = '{$_POST['suid']}'");
													}
												else     //normal query for updating attendance
												{
													$q = mysql_query("UPDATE attendance set noc = '$noc', nocp = '$nocp[$i]', noca = '$noca[$i]', stat = '$stat[$i]' where sid ='{$sid[$i]}' and fid = '{$fid}'");
												}
													if(!$q){
														$message .= "Update failed..! at {$fsid}". "<br />";
														}
														else {
															$message = "Update Successfull..!";
															}
													}
												}
                
						$dept = $_POST['dept'];
                        $semester = $_POST['semester'];
                        $section = $_POST['section'];
						$selection = $_POST['selection'];
						
						
			if(notnull($semester) && notnull($dept) && notnull($section)){
                $count = mysql_query("select count(suid) from subject where semester = '{$semester}' and dept = '{$dept}' and section = '{$section}' and fid = '{$_SESSION['user_id']}'") or die(mysql_error());
				$countsubject = mysql_fetch_array($count);
				if($countsubject[0] >= 2)   //for faculty having more than one subject
				{
							if(!empty($_POST['suid']))
							{
								$suid = $_POST['suid'];
								if($selection == "Detained")  //code for detained students
									{
										$querys = mysql_query("select * from attendance where semester = '{$semester}' and dept = '{$dept}' and section = '{$section}' and fid = '{$fid}' and stat = 'Detain' and suid = '{$suid}'");
										}
									else if($selection == "Condonation")   //code for students under condonation
									{
										$querys = mysql_query("select * from attendance where semester = '{$semester}' and dept = '{$dept}' and section = '{$section}' and fid = '{$fid}' and stat = 'Condonation' and suid = '{$suid}'");
										}
									else {   //code for all students
								$querys = mysql_query("select * from attendance where semester = '{$semester}' and dept = '{$dept}' and section = '{$section}' and fid = '{$fid}' and suid = '{$suid}'");
									}
								}
								else
								{
								$message = "Please Select Subject..!";
								$suid = "";
								}
					}
					else
					{
							if($selection == "Detained")
							{
								$querys = mysql_query("select * from attendance where semester = '{$semester}' and dept = '{$dept}' and section = '{$section}' and fid = '{$fid}' and stat = 'Detain'");
								}
							else if($selection == "Condonation")
							{
								$querys = mysql_query("select * from attendance where semester = '{$semester}' and dept = '{$dept}' and section = '{$section}' and fid = '{$fid}' and stat = 'Condonation'");
								}
							else {
						$querys = mysql_query("select * from attendance where semester = '{$semester}' and dept = '{$dept}' and section = '{$section}' and fid = '{$fid}'");
							}
						}
				
                }
                else{
                $message = "Kindly select all fields to update..!";
                $querys = NULL;
                }
}
	   else $countsubject[0] = 0;
						
					
						
                        
                /*if(notnull($semester) && notnull($dept) && notnull($section)){
					if($selection == "Detain")
					{
						$querys = mysql_query("select * from attendance where semester = '{$semester}' and dept = '{$dept}' and section = '{$section}' and fid = '{$fid}' and stat = 'Detain'");
						}
					else if($selection == "Condonation")
					{
						$querys = mysql_query("select * from attendance where semester = '{$semester}' and dept = '{$dept}' and section = '{$section}' and fid = '{$fid}' and stat = 'Condonation'");
						}
					else {
                $querys = mysql_query("select * from attendance where semester = '{$semester}' and dept = '{$dept}' and section = '{$section}' and fid = '{$fid}'");
					}
                }
                else {
                $message = "Select all fields to update..!";
                $querys = NULL;
                }*/

?>
<table id="structure">
    <tr>
        <td id="page">
        <fieldset>
        <legend>Attendance Details</legend>
        <table width="100%">
        <tr>
        <td>
         <?php 
                     echo '<form action="staffattendance.php?link='.$_GET['link'].'" method="post" >';
					 ?>
					 <table><tr><td>
		 <select name="dept" >
		 <option <?php if (isset($dept) && $dept=="") echo "selected";?> value="">--Branch--</option>
		 <option <?php if (isset($dept) && $dept=="CSE") echo "selected";?>>CSE</option>
		 <option <?php if (isset($dept) && $dept=="CHE") echo "selected";?>>CHE</option>
		 <option <?php if (isset($dept) && $dept=="CIVIL") echo "selected";?>>CIVIL</option>
		 <option <?php if (isset($dept) && $dept=="ECE") echo "selected";?>>ECE</option>
		 <option <?php if (isset($dept) && $dept=="EEE") echo "selected";?>>EEE</option>
		 <option <?php if (isset($dept) && $dept=="IT") echo "selected";?>>IT</option>
		 <option <?php if (isset($dept) && $dept=="MECH") echo "selected";?>>MECH</option>
		 </select>
		 </td><td>&nbsp;</td><td>
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
		 </select></td>	
         <td>&nbsp;</td><td>
		 <select name="section">
		 <option <?php if (isset($section) && $section == "") echo "selected";?> value="">--section--</option>
		 <option <?php if (isset($section) && $section == "1") echo "selected";?>>1</option>
		 <option <?php if (isset($section) && $section == "2") echo "selected";?>>2</option>
		 <option <?php if (isset($section) && $section == "3") echo "selected";?>>3</option>
         <option <?php if (isset($section) && $section == "4") echo "selected";?>>4</option>
		 </select>
         </td><td>&nbsp;</td>
         <td><?php 
		 if($countsubject[0] >= 2)
				{
				$subqry = mysql_query("select * from subject where fid = '{$_SESSION['user_id']}' and semester = '{$semester}' and dept = '{$dept}' and section = '{$section}'");
			if($subqry)
			{
				echo '<select name="suid"><option value="">--subject--</option>';
				while($q = mysql_fetch_array($subqry)){
				echo '<option value="'.$q['suid'].'">'.$q['suid'].'</option>';					}
				}
				echo '</select>';
			}
		  ?>
         </td><td>&nbsp;</td><td>
		 <select name="selection">
		 <option <?php if (isset($selection) && $selection == "") echo "selected";?> value="">--all--</option>
		 <option style="background-color:#" <?php if (isset($selection) && $selection == "Detained") echo "selected";?>>Detained</option>
		 <option style="background-color:#" <?php if (isset($selection) && $selection == "Condonation") echo "selected";?>>Condonation</option>         </select>
         </td><td bgcolor="">&nbsp;</td>
         <td colspan="2"><input type="submit" name="select" value="Submit" style="background-color:#0F0" /></td>
         </tr>
         </table>
                        
      

<?php
					$flag = 36;
                //confirm_query($querys);
        if(!empty($querys)){
                      $flag = 6;
					  echo "<tr><td><p style='color:#F00'>No need to enter <b>Classes Held</b> for all, Just enter only for <b>last student<span>*</span></b>..!</p></td></tr>"; 
					  if(isset($suid))
					  {
						$subqry = mysql_query("select * from subject where fid = '{$_SESSION['user_id']}' and semester = '{$semester}' and dept = '{$dept}' and section = '{$section}' and suid = '{$suid}'");
						  }
						  else
						  {
					  $subqry = mysql_query("select * from subject where fid = '{$_SESSION['user_id']}' and semester = '{$semester}' and dept = '{$dept}' and section = '{$section}'");
						  }
			if($subqry)
				$q = mysql_fetch_array($subqry);
                        echo '<tr><td><table id="t" border="" width="100%" cellpadding="8"><caption><h2>'.$q['sname'].'</h2></caption><colgroup><col style="background-color:#00CCFF; font-size:48px;"><col style="background-color:#00CCFF;"><col style="background-color:#0FFFFF; color:#000000; text-align:center"><col style="background-color:#0FFFFF; color:#000000; text-align:center"><col style="background-color:#0FFFFF"; color:#000000; text-align:center"><col style="background-color:#0FFFFF; color:#000000; text-align:center"></colgroup><thead><tr><th>Sr.</th><th>Student-Id</th><th>Classes Held</th><th>Classes Present</th><th>Attendance %</th><th>Condition</th></tr></thead><tbody>';
                    $i = 1;
					
					
         while($qr = mysql_fetch_array($querys)){
                        $flag = 5;						
						$sno = $qr['sno'];
						$status = $qr['stat'];
						if($status == "Safe")
							$color = '#00B000';
						 elseif($status == "Detain") $color = '#FF6666';
						 elseif($status == "Condonation") $color = "orange";
						 else $color = "";
                    echo '<tr style="background-color:'.$color.'"><td align="center"><form action="staffattendance.php?link='.$_GET['link'].'" method="post">'. $i . '</td><td align="center"><input type="text" style="width:100; text-align:center" name="sid[]" value="'. $qr["sid"]. '" readonly/></td><td align="center"><input style="width:80; text-align:center" type="text" name="noc" value="'. $qr["noc"]. '"/></td><td align="center"><input style="width:80; text-align:center" name="nocp[]" type="text" value="'.$qr["nocp"].'"/></td><td align="center" ><b>'.$qr["noca"].'</b></td><td align="center">'.$qr["stat"].'</td></tr>';
                                                $i = $i + 1;
                                                }
												
												
                            $n = $i;
							
                            if($flag == 5){
                                echo '<tr><td colspan="2" align="center"><input type="submit" name="update" value="Update" /></td></tr>';
                                }
								
                            echo '</form></tbody></table></td></tr>';					
                    }


             if($flag == 6){
                $message = "No results found..!";
                    }
			//else $message = "NO results found..!"
                
                ?>
         <?php if (!empty($message)) {echo "<tr><td><p id='err' class=\"message\">" . $message . "</p></td></tr>";} ?>       
        </table><td bgcolor=""
        </fieldset>
       	</td>
    </tr>
</table>

<?php include("includes/footer.php"); ?>