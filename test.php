<?php require_once("includes/session.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php 
// 

if (isset($_POST['Submit']) && $_FILES['csv']['size'] > 0) { 

    //get the csv file 
    $file = $_FILES['csv']['tmp_name']; 
    $handle = fopen($file,"r"); 
     
    //loop through the csv file and insert into database 
   do
	{ 
        if (isset($data[0])) { 
            mysql_query("update contacts set name = '{$data[0]}', num = '{$data[1]}' where extra = '{$data[2]}'
            "); 
        } 
    }  while ($data = fgetcsv($handle,1000,",","'"));
    // 

    //redirect 


} 

?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> 
<title>Import a CSV File with PHP & MySQL</title> 
</head> 

<body> 
<?php 

echo encrypt("rohinimam").'//';
echo encrypt("dpsir").'//';
echo encrypt("vanimam").'//';
echo encrypt("tulasimam").'//';
echo encrypt("brahmajisir").'//';
echo "--------------";
echo decrypt("ynd@123iwx");;
?>


<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1"> 
  <p>Choose your file: <br /> 
    <input name="csv" type="file" id="csv" /> 
    <input type="submit" name="Submit" value="Submit" /> 
  </p>
  <div style="visibility:collapse">
  <table width="100%" border="1">
    <tr>
      <td width="90%"><table width="100%" border="1">
        <tr>
          <td width="">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table></td>
      <td width="10%">&nbsp;</td>
    </tr>
  </table>
  </div>
  <hr />
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</form> 

<?php include("includes/footer.php"); ?>