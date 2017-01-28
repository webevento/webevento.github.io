
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
$sql="INSERT INTO user(Fullname,Username,Email,Password)VALUES('$fullname','$username','$email','$pass')";
if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
 mysql_close($con); 
  
}
$_SESSION['username']=$username;
		echo "<script type='text/javascript'>alert('You have been successfully registered to EZKhoj. Welcome $username '); window.location.href='homepage.php';</script>";

?>


</body>
</html>