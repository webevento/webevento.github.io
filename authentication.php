<?php
		session_start();

		$host="localhost"; // Host name 
		$username="root"; // Mysql username 
		$password=""; // Mysql password 
		$db_name="user1"; // Database name 
		$tbl_name="user"; // Table name 

		// Connect to server and select databse.
		mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
		mysql_select_db("$db_name")or die("cannot select DB");

		// username and password sent from form 
		$myusername=$_POST['Username']; 
		$mypassword=$_POST['Password']; 

		// To protect MySQL injection (more detail about MySQL injection)
		$myusername = stripslashes($myusername);
		$mypassword = stripslashes($mypassword);
		$myusername = mysql_real_escape_string($myusername);
		$mypassword = mysql_real_escape_string($mypassword);
		$sql="SELECT * FROM $tbl_name WHERE Username='$myusername' and Password='$mypassword'";
		$result=mysql_query($sql);

		// Mysql_num_row is counting table row
		$count=mysql_num_rows($result);
		
		
		

		// If result matched $myusername and $mypassword, table row must be 1 row
		if($count==1){
		$_SESSION['username']=$myusername;
		echo "<script type='text/javascript'>alert('Successfully logged in. Welcome $myusername '); window.location.href='homepage.php';</script>";
		}
		else {	
		echo "<script type='text/javascript'>alert('Username/Password do not match'); window.location.href='index.html';</script>";
		
		
		}
?>