<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php require_once("includes/session.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require("includes/connection.php"); ?>
<html>
<head>
<title>ADMIN PAGE</title>
<style type="text/css">
#input[type="button"] {
  width : 200px;
  margin: 2;

  -webkit-box-sizing: border-box; /* For legacy WebKit based browsers */
     -moz-box-sizing: border-box; /* For all Gecko based browsers */
          box-sizing: border-box;
}
input[type="button"]
{
  border-right: #a9a9a9 2px solid;
  padding-right: 2px;
  border-top: #a9a9a9 2px solid;
  padding-left: 2px;
  padding-bottom: 2px;
  border-left: #a9a9a9 2px solid;
  padding-top: 2px;
  border-bottom: #a9a9a9 2px solid;
}
input
{
border: 2px Solid White; 
    -webkit-box-shadow: 
      inset 0 0 8px  rgba(0,0,0,0.1),
            0 0 16px rgba(0,0,0,0.1); 
    -moz-box-shadow: 
      inset 0 0 8px  rgba(0,0,0,0.1),
            0 0 16px rgba(0,0,0,0.1); 
    box-shadow: 
      inset 0 0 8px  rgba(0,0,0,0.1),
            0 0 16px rgba(0,0,0,0.1); 
    padding: 5px;
    background: rgba(255,255,255,0.5);
    margin: 0 0 10px 0;
	
}
select
{
border: 2px Solid White; 
    -webkit-box-shadow: 
      inset 0 0 8px  rgba(0,0,0,0.1),
            0 0 16px rgba(0,0,0,0.1); 
    -moz-box-shadow: 
      inset 0 0 8px  rgba(0,0,0,0.1),
            0 0 16px rgba(0,0,0,0.1); 
    box-shadow: 
      inset 0 0 8px  rgba(0,0,0,0.1),
            0 0 16px rgba(0,0,0,0.1); 
    padding: 5px;
    background: rgba(255,255,255,0.5);
    margin: 0 0 10px 0;
}
</style>
</head>
<body bgcolor="#00FFFF">
<h1 align="center" style="color:#306">DATABASE Adminstrator</h1>
<?php /*include("includes/header.php"); */?>
<?php
//*************************************************************************************************************************************************
//code to insert students in student table initially
if (isset($_POST['upload'])) { 
    	$dept = $_POST['dept'];
        $semester = $_POST['semester'];
        $section = $_POST['section'];
if($_FILES['csv']['size'] > 0){
    if(notnull($semester) && notnull($dept) && notnull($section)){
    //get the csv file 
    $file = $_FILES['csv']['tmp_name']; 
    $handle = fopen($file,"r"); 
     
    //loop through the csv file and insert into database 
   
	do
	{ 
        if (isset($data[0])) {
			 $sid = mysql_real_escape_string($data[0]);
			 $password = $data[1];
			 //echo $sid;
           $query = mysql_query("insert into student values('{$sid}','{$password}','','','','','','','','','','','','','','','','{$dept}','{$section}','{$semester}','')"); 
		   //***************************************************************
		   //query for complete student details while reporting college
		   //$query = mysql_query("insert into student values('{$sid}','{$password}','{$data[2]}','','{$data[3]}','{$data[4]}','','{$data[5]}','{$data[6]}','{$data[7]}','{$data[8]}','{$data[9]}','','','{$data[10]}','{$dept}','{$section}','{$semester}','')"); 
		}
    }while ($data = fgetcsv($handle,1000));
    if(!empty($data))
	$message = "Insert Successful..!";
	}
	else 
	{
		$message = "Kindly select all fields..!";
		}
	}
	else $message = "Please choose a file to upload..!";
}

//************************************************************************************************************************************************
//code to update student semeter value{once in a semester starting} (department, semester, section, no file needed)
if (isset($_POST['updatesem'])) { 
    	$dept = $_POST['dept'];
        $semester = $_POST['semester'];
        $section = $_POST['section'];
		
    if(notnull($semester) && notnull($dept) && notnull($section)){ 
      
   
	$student = mysql_query("select * from student where dept = '{$dept}' and semester = '{$semester}' and section = '{$section}'");
		   if($student)
		   	{
				 $sem = $semester + 1;
				 while($suid = mysql_fetch_array($subject))
				 {
							   $query = mysql_query("update student set semester = '{$sem}' where dept = '{$dept}' and section = '{$section}' "); 
								}
						$message = "Insert Successful..!";
			}
			else $message = "Updation Failed..!";
		}
	else 
	{
		$message = "Kindly select all fields..!";
		}
	//}
	//else $message = "Please choose a file to upload..!";
}

//*************************************************************************************************************************************************
//code to insert staff data only once. You can add new staff details at any time (staff id, password, department)


if (isset($_POST['staffupload'])) { 
    	$dept = $_POST['dept'];
if($_FILES['csv']['size'] > 0){
    if(notnull($dept)){
    //get the csv file 
    $file = $_FILES['csv']['tmp_name']; 
    $handle = fopen($file,"r"); 
     
    //loop through the csv file and insert into database 
   
	do
	{ 
        if (isset($data[0])) {
			 $fid = mysql_real_escape_string($data[0]);
			 $password = $data[1];
			 //echo $fid;
           $query = mysql_query("insert into staff values('{$fid}','{$password}','{$data[2]}','{$data[3]}','','','','','','{$dept}','','')"); 
		}
    }while ($data = fgetcsv($handle,1000));
    $message = "Insert Successful..!";
	}
	else 
	{
		$message = "Kindly select all fields..!";
		}
	}
	else $message = "Please choose a file to upload..!";
}


//************************************************************************************************************************************************
//code to update student semeter value{once in a semester starting} (department, semester, section, no file needed)
if (isset($_POST['insertnotify'])) { 
    	$dept = $_POST['dept'];
        $semester = $_POST['semester'];
        $section = $_POST['section'];
		
    if(notnull($semester) && notnull($dept) && notnull($section)){ 
      
   
	$subject = mysql_query("select * from subject where dept = '{$dept}' and semester = '{$semester}' and section = '{$section}'");
		   if($subject)
		   	{
				 while($suid = mysql_fetch_array($subject))
				 {
							   $query = mysql_query("insert into notify values('','{$suid['suid']}','{$suid['short']}','{$suid['fid']}','{$semester}','{$dept}','{$section}','')"); 
								}
						$message = "Insert Successful..!";
			}
			else $message = "Updation Failed..!";
		}
	else 
	{
		$message = "Kindly select all fields..!";
		}
	//}
	//else $message = "Please choose a file to upload..!";
}

//************************************************************************************************************************************************
//code to insert 8 subjects for each student of a particular class. (department, semester, section, data from student table)

if (isset($_POST['insertsub'])) { 
    	$dept = $_POST['dept'];
        $semester = $_POST['semester'];
        $section = $_POST['section'];
//if($_FILES['csv']['size'] > 0){
    if(notnull($semester) && notnull($dept) && notnull($section)){
    //get the csv file 
   // $file = $_FILES['csv']['tmp_name']; 
    //$handle = fopen($file,"r"); 
     
    //loop through the csv file and insert into database 
   $student = mysql_query("select * from student where dept = '{$dept}' and semester = '{$semester}' and section = '{$section}'");
   if($student)
   {
			   while($sid = mysql_fetch_array($student))
				{ 
						$subject = mysql_query("select * from subject where dept = '{$dept}' and semester = '{$semester}' and section = '{$section}'");
						if($subject)
						{
					   while($suid = mysql_fetch_array($subject))
					   $query = mysql_query("insert into marks values('','{$semester}','{$dept}','{$section}','{$suid['suid']}','{$suid['fid']}','{$sid['sid']}','','','','','','','','','','','')"); 
						}
				}
				$message = "Insert Successful..!";
   	}
		}
	else 
	{
		$message = "Kindly select all fields..!";
		}
	//}
	//else $message = "Please choose a file to upload..!";
}

//*************************************************************************************************************************************************
//code to insert attendance for 8 subjects of each student (department, semester, section, data from student table)

if (isset($_POST['insertattendance'])) { 
    	$dept = $_POST['dept'];
        $semester = $_POST['semester'];
        $section = $_POST['section'];
//if($_FILES['csv']['size'] > 0){
    if(notnull($semester) && notnull($dept) && notnull($section)){
    //get the csv file 
   // $file = $_FILES['csv']['tmp_name']; 
    //$handle = fopen($file,"r"); 
     
    //loop through the csv file and insert into database 
   $student = mysql_query("select * from student where dept = '{$dept}' and semester = '{$semester}' and section = '{$section}'");
   if($student)
   {
			   while($sid = mysql_fetch_array($student))
				{ 
						$subject = mysql_query("select * from subject where dept = '{$dept}' and semester = '{$semester}' and section = '{$section}'");
						if($subject)
						{
					   while($suid = mysql_fetch_array($subject))
					   $query = mysql_query("insert into attendance values('','{$dept}','{$semester}','{$section}','{$suid['suid']}','{$suid['fid']}','{$sid['sid']}','','','','')"); 
						}
				}
				$message = "Insert Successful..!";
   	}
		}
	else 
	{
		$message = "Kindly select all fields..!";
		}
	//}
	//else $message = "Please choose a file to upload..!";
}

//*************************************************************************************************************************************************
//code to insert subject allocated to certain faculty. inserted for every semeter starting.


if (isset($_POST['insertsubject'])) { 
    	//$dept = $_POST['dept'];
        //$semester = $_POST['semester'];
        //$section = $_POST['section'];
if($_FILES['csv']['size'] > 0){
    //if(notnull($semester) && notnull($dept) && notnull($section)){
    //get the csv file 
    $file = $_FILES['csv']['tmp_name']; 
    $handle = fopen($file,"r"); 
     
    //loop through the csv file and insert into database 
   
	do
	{ 
        if (isset($data[0])) {
			 $suid = mysql_real_escape_string($data[1]);
			 $sname = mysql_real_escape_string($data[2]);
			 $credits = mysql_real_escape_string($data[3]);
			 $fid = mysql_real_escape_string($data[5]);
			 $semester = mysql_real_escape_string($data[4]);
			 $section = mysql_real_escape_string($data[6]);
			 $dept = mysql_real_escape_string($data[7]);
			  echo $suid;
           $query = mysql_query("insert into subject values('','{$suid}','{$sname}','{$credits}','{$semester}','{$fid}','{$section}','{$dept}')"); 
		}
    }while ($data = fgetcsv($handle,1000));
    if(!empty($data))
	$message = "Insert Successful..!";
	/*}
	else 
	{
		$message = "Kindly select all fields..!";
		}*/
	}
	else $message = "Please choose a file to upload..!";
}


?>
 <table width="100%">
                    <tr>
                        <td><fieldset><legend>Admin Panel</legend>
                  <form action="insertdata.php" method="post" enctype="multipart/form-data">
         <table><tr><td>
         <table><tr><td>
		 <select name="dept" >
		 <option <?php if (isset($dept) && $dept=="") echo "selected";?> value="">--Branch--</option>
		 <option <?php if (isset($dept) && $dept=="CSE") echo "selected";?>>CSE</option>
		 <option <?php if (isset($dept) && $dept=="CHE") echo "selected";?>>Chemical</option>
		 <option <?php if (isset($dept) && $dept=="CIV") echo "selected";?>>Civil</option>
		 <option <?php if (isset($dept) && $dept=="ECE") echo "selected";?>>ECE</option>
		 <option <?php if (isset($dept) && $dept=="EEE") echo "selected";?>>EEE</option>
		 <option <?php if (isset($dept) && $dept=="IT") echo "selected";?>>It</option>
		 <option <?php if (isset($dept) && $dept=="MECH") echo "selected";?>>Mechanical</option>
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
         <td colspan="2"><input type="file" name="csv" id="csv" /></td>
         <!--<td><h1>  </h1></td><td colspan="2"><input type="submit" name="export" value="Export To Excel" /></td>-->
         </tr></table></td></tr>
         <tr><td>To Insert Students Initially only once when joining<b>(dept, semester, section and .CSV File)</b></td><td><input type="submit" name="upload" value="Insert" /></td></tr>
         <tr><td>To Insert Subjects for every semester all students each with 8 tuples<b>(dept, semester, section)</b></td><td><input type="submit" name="insertsub" value="Insert subjects" /></td></tr>
         <tr><td>To Insert Staff Initially only once when joining<b>(dept, and .CSV File)</b></td><td><input type="submit" name="staffupload" value="Insert staff" /></td></tr>
         <tr><td>To Insert Subjects with respective faculty Initially for every semester<b>(dept, semester, section and .CSV File)</b></td><td><input type="submit" name="insertsubject" value="Insert subject" /></td></tr>
         <tr><td>To Insert Attendance tuples for every student needs 8 tuples for each Initially for every semester<b>(dept, semester, section)</b></td><td><input type="submit" name="insertattendance" value="Insert Attendance" /></td></tr>
         <tr><td>To update semester-number of each Student Initially for every semester<b>(dept, completed-semester(not current), section)</b></td><td><input type="submit" name="updatesem" value="Update Semester" /></td></tr>
         <tr><td>To Insert notification tuple for each staff of respective class Initially for every semester<b>(dept, semester, section)</b></td><td><input type="submit" name="insertnotify" value="Insert Notify" /></td></tr>
         </table></fieldset>
         <?php if (!empty($message)) {echo "<tr><td><p id='err' class=\"message\">" . $message . "</p></td></tr>";} ?>
         </td></tr></table>

</body>
</html>