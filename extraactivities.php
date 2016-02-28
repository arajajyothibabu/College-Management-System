<?php require_once("includes/session.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php confirm_logged_in(); ?>
<?php include("includes/header.php"); ?>
<?php $message = "";
$querys = NULL; ?>
<?php

    //redirect 

?> 
<?php 
       if( isset($_POST['select'])){
		   
						$dept = $_POST['dept'];
                        $semester = $_POST['semester'];
                        $section = $_POST['section'];
                        
       if(notnull($semester) && notnull($dept) && notnull($section)){
						$querys = mysql_query("select * from student where semester = '{$semester}' and dept = '{$dept}' and section = '{$section}'");
				
                }
                /*else if(notnull($semester) && notnull($dept) && notnull($suid)){
                $querys = mysql_query("select * from marks where semester = '{$semester}' and dept = '{$dept}' and suid = '{$suid}' and fid = '{$fid}'");
                }
                else if(notnull($semester) && notnull($suid)){
                $querys = mysql_query("select * from marks where semester = '{$semester}' and suid = '{$suid}' and fid = '{$fid}'");
                }
                else if(notnull($semester)){
                $querys = mysql_query("select * from marks where semester = '{$semester}' and fid = '{$fid}'");
                }
                else if(notnull($dept)){
                $querys = mysql_query("select * from marks where dept = '{$dept}' and fid = '{$fid}'");
                }
                else if(notnull($suid)){
                $querys = mysql_query("select * from marks where suid = '{$suid}' and fid = '{$fid}'");
                }
                else if(notnull($section)){
                $querys = mysql_query("select * from marks where section = '{$section}' and fid = '{$fid}'");
                }
                else if(notnull($dept) && notnull($dept)){
                $querys = mysql_query("select * from marks where semester = '{$semester}' and dept = '{$dept}' and fid = '{$fid}'");
                }
                else if(notnull($suid) && notnull($dept)){
                $querys = mysql_query("select * from marks where dept = '{$dept}' and suid = '{$suid}' and fid = '{$fid}'");
                }
                else if(notnull($section) && notnull($suid)){
                $querys = mysql_query("select * from marks where suid = '{$suid}' and section = '{$section}' and fid = '{$fid}'");
                }*/
                else{
                $message = "Kindly select all fields to update..!";
                $querys = NULL;
                }
	   }
	   
 ?>


        <table id="structure">
        <tr>
        <td id="page">
        <fieldset>
            <legend>Student Extra-Curricular Activities </legend>
                <table width="100%">
                    <tr>
                        <td>
                  <form action="extraactivities.php?link=staff" method="post" enctype="multipart/form-data">
         <table><tr><td>
		 <select name="dept" >
		 <option <?php if (isset($dept) && $dept=="") echo "selected";?> value="">--Branch--</option>
		 <option <?php if (isset($dept) && $dept=="CSE") echo "selected";?>>CSE</option>
		 <option <?php if (isset($dept) && $dept=="CHE") echo "selected";?>>CHE</option>
		 <option <?php if (isset($dept) && $dept=="CIV") echo "selected";?>>CIVIL</option>
		 <option <?php if (isset($dept) && $dept=="ECE") echo "selected";?>>ECE</option>
		 <option <?php if (isset($dept) && $dept=="EEE") echo "selected";?>>EEE</option>
		 <option <?php if (isset($dept) && $dept=="IT") echo "selected";?>>IT</option>
		 <option <?php if (isset($dept) && $dept=="MECH") echo "selected";?>>MECH</option>
		 </select>
		 </td><td><==></td><td>
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
         <td><==></td><td>
		 <select name="section">
		 <option <?php if (isset($section) && $section == "") echo "selected";?> value="">--section--</option>
		 <option <?php if (isset($section) && $section == "1") echo "selected";?>>1</option>
		 <option <?php if (isset($section) && $section == "2") echo "selected";?>>2</option>
		 <option <?php if (isset($section) && $section == "3") echo "selected";?>>3</option>
         <option <?php if (isset($section) && $section == "4") echo "selected";?>>4</option>
		 </select>
         </td><td><=></td>
         <td colspan="2"><input type="submit" name="select" value="Submit" /></td>
         <!--<td><h1>  </h1></td><td colspan="2"><input type="submit" name="export" value="Export To Excel" /></td>-->
         </tr>
         </table>
                   </td>
                   </tr>
 <?php if (!empty($message)) {echo "<tr><td><p id='err' class=\"message\">" . $message . "</p></td></tr>";} ?>
<?php
					$flag = 36;
                //confirm_query($querys);
        if($querys != NULL){
                      $flag = 6;
                        echo '<tr><td><table border="1" cellpadding="5" width="100%"><caption><h2>Extra-Curricular Activities</h2></caption><colgroup><col  class ="nonedit" style="background-color:#00CCFF;"><col class ="nonedit" style="background-color:#00CCFF;"><col style="background-color:#0FFFFF; color:#000000; text-align:center;" align="center"><col style="background-color:#0FFFFF; color:#000000; text-align:center;"></colgroup><thead><tr><th>Sr.</th><th>Student-Id</th><th>ExtraCurricular Activities</th></tr></thead><tbody>';
                    $i = 1;
					
         while($qr = mysql_fetch_array($querys)){
                        $flag = 5;						
                    echo '<tr><td align="center" width="5%">'. $i . '</td><td align="center" width="15%">'. $qr["sid"]. '</td><td align="center">'.$qr['extra'].'</td></tr>';
                                                $i += 1;
                                                }
					if($i == 1) $msg = "No results found..!";
								
                            echo '</tbody></table></td></tr>';					
                    }


             if($flag == 6){
                $message = "No results found..!";
                    }
                
                ?>
<?php if (!empty($msg)) {echo "<tr><td><p id='err' class=\"message\">" . $msg . "</p></td></tr>";} ?>                

            </table>
            </fieldset>
    </td></tr>
</table>
<?php include("includes/footer.php"); ?>