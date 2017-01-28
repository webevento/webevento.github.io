
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
$fullname=$_POST['Fullname'];
$username=$_POST['Username'];
$email= $_POST['Email'];
$pass=$_POST['Password'];
$sql="UPDATE user SET Fullname='$fullname',Username='$username',Email='$email',Password='$pass' where Username='$username'";
if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
 mysql_close($con); 
  
}

		echo "<script type='text/javascript'>alert('Successfully saved changes.'); window.location.href='userprofile.php';</script>";

?>


</body>
</html>