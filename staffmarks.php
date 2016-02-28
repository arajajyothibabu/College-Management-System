<?php require_once("includes/session.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php confirm_logged_in(); ?>
<?php include("includes/header.php"); ?>
<?php $message = "";
$querys = NULL; ?>
<?php
if (isset($_POST['upload'])) { 
    	$dept = $_POST['dept'];
        $semester = $_POST['semester'];
        $section = $_POST['section'];
if($_FILES['csv']['size'] > 0){
    if(notnull($semester) && notnull($dept) && notnull($section)){
    //get the csv file 
    $file = $_FILES['csv']['tmp_name']; 
    $handle = fopen($file,"r"); 

//code for faculty with two subjects
if(isset($_POST['suid'])) {
		$suid = $_POST['suid'];
   do
	{ 
        if (isset($data[0])) {
			 $int1 = $data[1] + $data[2] + $data[3];
			 if(isset($data[4]) && isset($data[5])&& isset($data[6]))
			 {
				 $int2 = $data[4] + $data[5] + $data[6];
				 if($data[3]>$data[6])
				 {
					  $high = $data[3];
					  $low = $data[6];
				 }
				 else
				 {
					$high = $data[6];
					$low = $data[3];
					 }
			 $intfinal = ceil((2 * $high + $low)/3) + ceil(($data[1]+$data[4])/2) + ceil(($data[2]+$data[5])/2);
			 mysql_query("update marks  set q1 = '{$data[1]}', q2 = '{$data[4]}', a1 = '{$data[2]}', a2 = '{$data[5]}', m1 = '{$data[3]}', m2 = '{$data[6]}', i1 = '{$int1}', i2 = '{$int2}', inf = '{$intfinal}' where sid ='{$data[0]}' and fid = '{$_SESSION['user_id']}' and dept = '{$dept}' and section = '{$section}' and semester = '{$semester}' and suid = '{$suid}'"); 
			 }
			 else
			 {
				  mysql_query("update marks  set q1 = '{$data[1]}', a1 = '{$data[2]}', m1 = '{$data[3]}', i1 = '{$int1}' where sid ='{$data[0]}' and fid = '{$_SESSION['user_id']}' and dept = '{$dept}' and section = '{$section}' and semester = '{$semester}' and suid = '{$suid}'"); 
				 }
				 $message = "Upload Successful..!";
		}
    }  while ($data = fgetcsv($handle,1000,",","'"));

}
else {

     
    //loop through the csv file and insert into database 
   do
	{ 
        if (isset($data[0])) {
			 $int1 = $data[1] + $data[2] + $data[3];
			 if(isset($data[4]) && isset($data[5])&& isset($data[6]))
			 {
				 $int2 = $data[4] + $data[5] + $data[6];
				 if($data[3]>$data[6])
				 {
					  $high = $data[3];
					  $low = $data[6];
				 }
				 else
				 {
					$high = $data[6];
					$low = $data[3];
					 }
			 $intfinal = ceil((2 * $high + $low)/3) + ceil(($data[1]+$data[4])/2) + ceil(($data[2]+$data[5])/2);
			 mysql_query("update marks  set q1 = '{$data[1]}', q2 = '{$data[4]}', a1 = '{$data[2]}', a2 = '{$data[5]}', m1 = '{$data[3]}', m2 = '{$data[6]}', i1 = '{$int1}', i2 = '{$int2}', inf = '{$intfinal}' where sid ='{$data[0]}' and fid = '{$_SESSION['user_id']}' and dept = '{$dept}' and section = '{$section}' and semester = '{$semester}'"); 
			 }
			 else
			 {
				  mysql_query("update marks  set q1 = '{$data[1]}', a1 = '{$data[2]}', m1 = '{$data[3]}', i1 = '{$int1}' where sid ='{$data[0]}' and fid = '{$_SESSION['user_id']}' and dept = '{$dept}' and section = '{$section}' and semester = '{$semester}'"); 
				 }
				 $message = "Upload Successful..!";
		}
    }  while ($data = fgetcsv($handle,1000,",","'"));
}
    // 
	}
	else 
	{
		$message = "Kindly select all fields..!";
		}
	}
	else $message = "Please choose a file to upload..!";
}
    //redirect 

?> 
<?php 
       if( isset($_POST['select']) || isset($_POST['update'])){

                if(isset($_POST['update'])){
                    $i = 1;
					$sid = $_POST['sid'];
                    $q1 = $_POST['q1'];
                    $a1 = $_POST['a1'];
                    $m1 = $_POST['m1'];
					$q2 = $_POST['q2'];
                    $a2 = $_POST['a2'];
                    $m2 = $_POST['m2'];
					$f = $_POST['f'];
                    foreach($sid as $i => $j){
                        
					
                    $i1[$i] = $q1[$i] + $a1[$i] + $m1[$i];
                    
                    $i2[$i] = $q2[$i] + $a2[$i] + $m2[$i];
                    if($m1[$i] > $m2[$i]){ $m[$i] = $m1[$i]; $n[$i] = $m2[$i];}
                    else {$m[$i] = $m2[$i]; $n[$i] = $m1[$i];}
                    $inf[$i] = ceil(($q1[$i] + $q2[$i]) / 2) + ceil(($a1[$i] + $a2[$i]) / 2) + ceil((2 * $m[$i] + $n[$i]) / 3);
                  if($inf[$i] == 0) $inf[$i] = "N/A";
				  if($i1[$i] == 0) $i1[$i] = "N/A";
				  if($i2[$i] == 0) $i2[$i] = "N/A";
				  //if($q1[$i]==0 && $a1[$i] == 0 && $m1[$i]== 0) $i1[$i]=0;
				  //if($q2[$i]==0 && $a2[$i] == 0 && $m2[$i]== 0) $i2[$i]=0;
                  	if(isset($_POST['suid']))
					{  
                    $q = mysql_query("UPDATE marks set q1 = '$q1[$i]', q2 = '$q2[$i]', a1 = '$a1[$i]', a2 = '$a2[$i]', m1 = '$m1[$i]', m2 = '$m2[$i]', i1 = '$i1[$i]', i2 = '$i2[$i]', inf = '$inf[$i]', f = '$f[$i]' where sid ='{$sid[$i]}' and fid = '{$_SESSION['user_id']}' and suid = '{$_POST['suid']}'");
					}
					else
					{
						$q = mysql_query("UPDATE marks set q1 = '$q1[$i]', q2 = '$q2[$i]', a1 = '$a1[$i]', a2 = '$a2[$i]', m1 = '$m1[$i]', m2 = '$m2[$i]', i1 = '$i1[$i]', i2 = '$i2[$i]', inf = '$inf[$i]', f = '$f[$i]' where sid ='{$sid[$i]}' and fid = '{$_SESSION['user_id']}'");
						}
                    if(!$q){
                        $message .= "Update failed..! at {$fsid}". "<br />";
                        }
                        else {
                            $message = "Update Successfull..! :) ";
                            }
							$i = $i + 1;
                    }
                }
                
						$dept = $_POST['dept'];
                        $semester = $_POST['semester'];
                        $section = $_POST['section'];
						if(isset($_POST['suid']))
						$suid = $_POST['suid'];
						else $suid = "";
                        
       if(notnull($semester) && notnull($dept) && notnull($section)){
                $count = mysql_query("select count(suid) from subject where semester = '{$semester}' and dept = '{$dept}' and section = '{$section}' and fid = '{$_SESSION['user_id']}'");
				$countsubject = mysql_fetch_array($count);
				if($countsubject[0] == 2)
				{
							if(!empty($_POST['suid']))
							{
								$suid = $_POST['suid'];
								$querys = mysql_query("select * from marks where semester = '{$semester}' and dept = '{$dept}' and section = '{$section}' and fid = '{$_SESSION['user_id']}' and suid = '{$_POST['suid']}'")
								or die(mysql_error());
								}
								else
								{
								$message = "Please Select Subject..!";
								$suid = "";
								}
					}
						else
						{
						$querys = mysql_query("select * from marks where semester = '{$semester}' and dept = '{$dept}' and section = '{$section}' and fid = '{$_SESSION['user_id']}'");
						}
				
                }
                else{
                $message = "Kindly select all fields to update..!";
                $querys = NULL;
                }
	   }
	   else $countsubject[0] = 0;
 ?>


        <table id="structure">
        <tr>
        <td id="page">
        <fieldset>
            <legend>Student Academics </legend>
                <table width="100%">
                    <tr>
                        <td>
                  <form action="staffmarks.php" method="post" enctype="multipart/form-data">
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
         </td><td><=></td><td><?php 
		 if($countsubject[0] == 2)
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
			if(isset($_POST['suid']))
			{
				$subqry = mysql_query("select * from subject where fid = '{$_SESSION['user_id']}' and semester = '{$semester}' and dept = '{$dept}' and section = '{$section}' and suid = '{$_POST['suid']}'");
			}
			else
			{
				$subqry = mysql_query("select * from subject where fid = '{$_SESSION['user_id']}' and semester = '{$semester}' and dept = '{$dept}' and section = '{$section}'");
			}
			if($subqry)
				$q = mysql_fetch_array($subqry);
                        echo '<tr><td><table border="1" cellpadding="5" width="100%" id = "t"><caption><h2>'.$q['sname'].'</h2></caption><colgroup><col  class ="nonedit" style="background-color:#00CCFF;"><col class ="nonedit" style="background-color:#00CCFF;"><col style="background-color:#0FFFFF; color:#000000; text-align:center;" align="center"><col style="background-color:#0FFFFF; color:#000000; text-align:center;"><col style="background-color:#0FFFFF; color:#000000; text-align:center"><col style="background-color:#00CCFF; color:#000000; text-align:center"><col style="background-color:#0FFFFF; color:#000000; text-align:center"><col style="background-color:#0FFFFF; color:#000000; text-align:center"><col style="background-color:#0FFFFF; color:#000000; text-align:center"><col style="background-color:#00CCFF; color:#000000; text-align:center"><col style="background-color:#00CCFF; color:#000000; text-align:center"><col style="background-color:#0FFFFF; color:#000000; text-align:center"></colgroup><thead><tr><th>Sr.</th><th>Student-Id</th><th>Q-1</th><th>A-1</th><th>M-1</th><th>I-1</th><th>Q-2</th><th>A-2</th><th>M-2</th><th>I-2</th><th>I-F</th><th>Final</th></tr></thead><tbody>';
                    $i = 1;
					
         while($qr = mysql_fetch_array($querys)){
                        $flag = 5;						
						$sno = $qr['sno'];
                    echo '<tr><td align="center">'. $i . '</td><td align="center"><input type="text" style="width:100;text-align:center" name="sid[]" value="'. $qr["sid"]. '" readonly/></td><td align="center"><input style="width:40;text-align:center" type="text" name="q1[]" value="'. $qr["q1"]. '"/></td><td align="center"><input style="width:40;text-align:center" name="a1[]" type="text" value="'.$qr["a1"].'"/></td><td align="center"><input style="width:40;text-align:center" name="m1[]" type="text" value="'.$qr["m1"].'" /></td><td align="center">'.$qr["i1"].'</td><td align="center"><input style="width:40;text-align:center" name="q2[]" type="text" value="'.$qr["q2"].'"/></td><td align="center"><input style="width:40;text-align:center" type="text" name="a2[]" value="'.$qr["a2"].'"/></td><td align="center"><input style="width:40;text-align:center" name="m2[]" type="text" value="'.$qr["m2"].'"/></td><td align="center">'.$qr["i2"].'</td><td align="center">'.$qr["inf"].'</td><td align="center"><input style="width:40;text-align:center" type="text" name="f[]" value="'.$qr["f"].'"/></td></tr>';
                                                $i = $i + 1;
                                                }
												
												
                            $n = $i;
							
                            if($flag == 5){
                                echo '<tr><td colspan="2" align="center"><input type="submit" name="update" value="Update" /></td></tr>';
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
            </td>
    </tr>
    <tr><td><h2> </h2></td></tr>
<?php
 if($flag == 5)
 {
    echo '<tr><td id="page"><table><tr>
<td style="font-size:16px">Choose a <b>.csv</b> file as shown in the below format:</td> 
  <td><input name="csv" type="file" id="csv" /></td> 
	</tr></table> 
    </td></tr>
    <tr><td align="center"><p id="err">Before uploading file, please select subject at the top if you are dealing with 2 subjects for the same class..!</p></td></tr>
    <tr><td><table width="75%"><tr>
    <td id="page"><img src="images/uploadcsv.JPG" width="491" height="327" alt="Pattern for .csv file"/></td>
    <td id="page"><input style="background-color:#00FF00" type="submit" name="upload" value="Upload"/></td></form>
    </tr></table>';
 }
?>

    </td></tr>
</table>
<?php include("includes/footer.php"); ?>
<?php
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
?>