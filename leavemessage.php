
<html>
<body>
 
<?PHP
session_start();
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("user1", $con) or die('Could not select database');
if ($_POST)
{ 
$Name=$_POST['name'];
$Email=$_POST['email'];
$Phone= $_POST['phone'];
$Message=$_POST['message'];
$sql="INSERT INTO contactus VALUES('$Name','$Email','$Phone','$Message')";
if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
 mysql_close($con); 
  
}

echo "<script type='text/javascript'>alert('Message sent. Thank you for your feedback.'); window.location.href='homepage.php';</script>";

?>


</body>
</html>