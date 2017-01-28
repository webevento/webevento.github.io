<?php 

$pyscript = "C:\\xampp\\htdocs\\project\\events.py";
$python = "C:\\Python35\\python.exe";

$cmd = "$python $pyscript";
exec("$cmd", $output);	
$arrlength = count($output);
$arrayrr[] = $output;
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("eventdb", $con) or die('Could not select database');
for($i=0;$i<$arrlength;$i++)
{
	$sql="INSERT INTO crawledevent VALUES('$output[$i]')";
		if (!mysql_query($sql,$con))
		  {
		  die('Error: ' . mysql_error());
		  }

}


mysql_close($con);
?>