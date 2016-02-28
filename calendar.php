<?php require_once("includes/session.php"); ?>
<?php require_once("includes/functions.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="icon" href="favicon.ico" type="image/vnd.microsoft.icon">
		<title>GVP Academics</title>
		<link href="stylesheets/public.css" media="all" rel="stylesheet" type="text/css" />
        <script src="javascripts/functions.js" type="text/javascript"></script>
		<link href="stylesheets/SpryAccordion.css" rel="stylesheet" type="text/css" />
	</head>
<?php
$monthNames = Array("January", "February", "March", "April", "May", "June", "July",
"August", "September", "October", "November", "December");
?>
<?php
if (!isset($_REQUEST["month"])) $_REQUEST["month"] = date("n");
if (!isset($_REQUEST["year"])) $_REQUEST["year"] = date("Y");
?>
<?php
$cMonth = $_REQUEST["month"];
$cYear = $_REQUEST["year"];
 
$prev_year = $cYear;
$next_year = $cYear;
$prev_month = $cMonth-1;
$next_month = $cMonth+1;
 
if ($prev_month == 0 ) {
    $prev_month = 12;
    $prev_year = $cYear - 1;
}
if ($next_month == 13 ) {
    $next_month = 1;
    $next_year = $cYear + 1;
}
?>
<body>
<table id="structure">
<tr><td>&nbsp;</td>
<td width="" id="">
<fieldset><legend align="center"><h3>Calendar</h3></legend>
<table width="100%" height="100%">
<tr align="center">
<td bgcolor="#FF0099" style="color:#FFFFFF">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="50%" align="left">  <a href="<?php echo $_SERVER["PHP_SELF"] . "?month=". $prev_month . "&year=" . $prev_year; ?>" style="color:#FFFFFF">Previous</a></td>
<td width="50%" align="right"><a href="<?php echo $_SERVER["PHP_SELF"] . "?month=". $next_month . "&year=" . $next_year; ?>" style="color:#FFFFFF">Next</a>  </td>
</tr>
</table>
</td>
</tr>
<tr>
<td align="center">
<table width="100%" border="0" cellpadding="2" cellspacing="2">
<tr align="center">
<td colspan="7" bgcolor="#FF9999" style="color:#FFFFFF; font-size:18px"><strong><?php echo $monthNames[$cMonth-1].' '.$cYear; ?></strong></td>
</tr>

<tr>
<td align="center" bgcolor="#191919" style="color:#FFFFFF"><strong>S</strong></td>
<td align="center" bgcolor="#191919" style="color:#FFFFFF"><strong>M</strong></td>
<td align="center" bgcolor="#191919" style="color:#FFFFFF"><strong>T</strong></td>
<td align="center" bgcolor="#191919" style="color:#FFFFFF"><strong>W</strong></td>
<td align="center" bgcolor="#191919" style="color:#FFFFFF"><strong>T</strong></td>
<td align="center" bgcolor="#191919" style="color:#FFFFFF"><strong>F</strong></td>
<td align="center" bgcolor="#191919" style="color:#FFFFFF"><strong>S</strong></td>
</tr>

<?php
$timestamp = mktime(0,0,0,$cMonth,1,$cYear);
$maxday = date("t",$timestamp);
$thismonth = getdate ($timestamp);
$startday = $thismonth['wday'];
for ($i=0; $i<($maxday+$startday); $i++) {
    if(($i % 7) == 0 ) echo "<tr>";
    if($i < $startday) echo "<td></td>";
    else echo "<td align='center' valign='middle' height='20px'>". ($i - $startday + 1) . "</td>";
    if(($i % 7) == 6 ) echo "</tr>";
}
?>
</table>
</td>
</tr>
</table>
</fieldset>
</td>
<td>&nbsp;</td>
</tr>
</table>
</body>
</html>