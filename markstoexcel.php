<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
  if(isset($_POST['export'])){
		$dept = $_POST['dept'];
        $semester = $_POST['semester'];
        $section = $_POST['section'];  
	  
  include("Classes/PHPExcel.php");
  $objPHPExcel = new PHPExcel();
  $query1 = "select * from marks where semester = '{$semester}' and dept = '{$dept}' and section = '{$section}' and fid = '{$_SESSION['user_id']}'";
  $exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
  $serialnumber=0;
  //Set header with temp array
  $tmparray =array("Sno:","Regd.Number","Q1","A1","Mid-1","INT-1","Q2","A2","Mid-2","INT-2","INTERNALS");
  //take new main array and set header array in it.
  $sheet =array($tmparray);

  while ($res1 = mysql_fetch_array($exec1))
  {
	$tmparray =array();
    $serialnumber = $serialnumber + 1;
    array_push($tmparray,$serialnumber);
    //$employeelogin = $res1['employeelogin'];
    array_push($tmparray,$res1['sid']);
    //$employeename = $res1['employeename'];
    array_push($tmparray,$res1['q1']);
	array_push($tmparray,$res1['a1']);
	array_push($tmparray,$res1['m1']);
	array_push($tmparray,$res1['i1']);
	array_push($tmparray,$res1['q2']);
	array_push($tmparray,$res1['a2']);
	array_push($tmparray,$res1['m2']);
	array_push($tmparray,$res1['i2']);
	array_push($tmparray,$res1['inf']);   
    array_push($sheet,$tmparray);
  }

  $worksheet = $objPHPExcel->getActiveSheet();
  foreach($sheet as $row => $columns) {
    foreach($columns as $column => $data) {
        $worksheet->setCellValueByColumnAndRow($column, $row + 1, $data);
    }
  }

  //make first row bold
  $objPHPExcel->getActiveSheet()->getStyle("A1:K1")->getFont()->setBold(true);
  $objPHPExcel->setActiveSheetIndex(0);
  //header('Content-type: application/vnd.ms-excel');
  //header('Content-Disposition: attachment; filename="name.xlsx"');
 // header('Cache-Control: max-age=0');
  	//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
 	//$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
// Write the Excel file to filename some_excel_file.xlsx in the current directory
	//$objWriter->save('c:/some_excel_file.xlsx');
	
	
	// Redirect output to a client’s web browser (Excel5) 
header('Content-Type: application/vnd.ms-excel'); 
header('Content-Disposition: attachment; filename="results.xls"'); 
header('Cache-Control: max-age=0'); 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); 
$objWriter->save('php://output');
  	//$objWriter->save('c://');
  redireto("staffmarks.php");
  }
?>
