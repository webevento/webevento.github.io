<?php
	session_start();

	if (isset($_SESSION['username'])==false) {
		echo "<script type='text/javascript'>alert('You havent logged in'); window.location.href='index.html';</script>";
	}
?>
<!DOCTYPE html>
<head>
<title>EZKhoj</title>
<link rel="stylesheet" href="css/normalize.css">
<link href='http://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/main.css">
<link href="default.css" rel="stylesheet" type="text/css" media="all" />
<link href="fonts.css" rel="stylesheet" type="text/css" media="all" />

</head>
 <script type="text/javascript">
	function logoff()
	{
		var question=confirm("Do you want to Logout?");
		if(question==true)
			window.location.href="index.html";
		
	}
	function askPassword()
		{
			var password=prompt("Enter your password to continue");
			window.location.href="editprofile.php";
							
		}
	
	
</script>
<body background="images/bg.jpg">
<div id="header-wrapper">
	<div id="header" class="container">
		<div id="logo">
			<img src="images/icon.gif" height="150" width="150">
			<h1><a href="#"><font color="white" size="10" face="Monotype Corsiva">EZKhoj</font></a></h1>

		</div>
		<div id="menu">
			<ul>
				<li ><a href="homepage.php" accesskey="1" title="">Homepage</a></li>
				<li class="active"><a href="#" accesskey="2" title="">My Profile</a></li>
				<li ><a href="updateevents.html" accesskey="4" title="">Update Events</a></li>
				<li><a href="aboutus.html" accesskey="3" title="">About Us</a></li>
				<li><a href="contactus.html" accesskey="5" title="">Contact Us</a></li>
			</ul>
		</div>
	</div>
</div>
<div style="position:absolute;top:10px;right:10px; height:100px; width:150px;>
<center>
	<?php
		session_start();
	  echo '<font color="white" size="3" face="Courier New">'."Welcome! ".$_SESSION['username']."</font>";
 
	?>
	
	<br/><button style="background:transparent;border:none;" onClick="logoff()"><img src="images/logoff.png" height="60" width="70"></button>
	</center>

</div>
<br/>

<!-- BOOTSTRAP STYLE SHEET -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT-AWESOME STYLE SHEET FOR BEAUTIFUL ICONS -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
     <!-- CUSTOM STYLE CSS -->
    <style type="text/css">
               .btn-social {
            color: white;
            opacity: 0.8;
        }

            .btn-social:hover {
                color: white;
                opacity: 1;
                text-decoration: none;
            }

        .btn-facebook {
            background-color: #3b5998;
        }

        .btn-twitter {
            background-color: #00aced;
        }

        .btn-linkedin {
            background-color: #0e76a8;
        }

        .btn-google {
            background-color: #c32f10;
        }
    </style>
	
</head>
<body>
		

    <div class="container">
        <section style="padding-bottom: 50px; padding-top: 50px;">
            <div class="row">
                <div class="col-md-4">
                    <img src="assets/img/user.jpg" class="img-rounded img-responsive" />
                    <br />
                    <br />
					<?php
							// Connect to database server
							mysql_connect("localhost", "root", "") or die (mysql_error ());

							// Select database
							mysql_select_db("user1") or die(mysql_error());

							// SQL query
							$usernames=$_SESSION['username'];
							$strSQL = "SELECT * FROM user where Username= '$usernames'";

							// Execute the query (the recordset $rs contains the result)
							$rs = mysql_query($strSQL);
							
							// Loop the recordset $rs
							// Each row will be made into an array ($row) using mysql_fetch_array
							while($row = mysql_fetch_array($rs)) {

							   // Write the value of the column FirstName (which is now in the array $row)
								$username=$row['Username'];
								$fullname=$row['Fullname'];
								$password=$row['Password'];
								$GLOBALS['originalpassword']=$password;
								$email=$row['Email'];
								
							  }
							
							// Close the database connection
							mysql_close();
					?>
                    <label>Registered Username</label><br/>
                    <?php echo $username; ?><br/>
                    <label>Registered Name</label><br/>
                   <?php echo $fullname; ?><br/>
                    <label>Registered Email</label><br/>
                    <?php echo $email; ?><br/>

                    <br>
                    <button class="btn btn-success" onClick="askPassword()">Edit Profile</button>
					
                    <br /><br/>
                </div>
                <div class="col-md-8">
                    <div class="alert alert-info">
                        <h1><?php echo $fullname; ?> </h1>
						<h4><?php echo "(".$username.")"; ?></h4>
      
                        <p>
                           
                        </p>
                    </div>
                    <div >
                        <a href="#" class="btn btn-social btn-facebook">
                            <i class="fa fa-facebook"></i>&nbsp; Facebook</a>
                        <a href="#" class="btn btn-social btn-google">
                            <i class="fa fa-google-plus"></i>&nbsp; Google</a>
                        <a href="#" class="btn btn-social btn-twitter">
                            <i class="fa fa-twitter"></i>&nbsp; Twitter </a>
                        <a href="#" class="btn btn-social btn-linkedin">
                            <i class="fa fa-linkedin"></i>&nbsp; Linkedin </a>
                    </div>
					<br/><br/>
                    <div class="form-group col-md-8" style="height:400px; width:100%;">
						<div class="one" style="background-color:#40D1D6; width:32%; height:100%; position:absolute; left:0px; overflow:scroll;" >
						<center><B>JOINED EVENT</B></center>
						<hr/>
							<?php
							// Connect to database server
							mysql_connect("localhost", "root", "") or die (mysql_error ());

							// Select database
							mysql_select_db("eventdb") or die(mysql_error());

							// SQL query
							$strSQL = "SELECT * FROM joindb";

							// Execute the query (the recordset $rs contains the result)
							$rs = mysql_query($strSQL);
							
							// Loop the recordset $rs
							// Each row will be made into an array ($row) using mysql_fetch_array
							while($row = mysql_fetch_array($rs)) {
								$title=$row['Title'];
								$organizer=$row['Organizer'];
								$date=$row['Date'];
								$venue=$row['Venue'];
							   // Write the value of the column FirstName (which is now in the array $row)
							  echo $title ." organized by " .$organizer." on " .$date." at " .$venue . "<hr /><br/>";
							 
							  }

							// Close the database connection
							mysql_close();
							?>
						</div>
						
						<div class="two" style="background-color:#40D1D6; width:32%; height:100%; position:absolute; top:0px; left:260px; overflow:scroll;">
						<center><B>INTERESTED EVENT</B></center>
						
						<hr/>
						<?php
							// Connect to database server
							mysql_connect("localhost", "root", "") or die (mysql_error ());

							// Select database
							mysql_select_db("eventdb") or die(mysql_error());

							// SQL query
							$strSQL = "SELECT * FROM interesteddb";

							// Execute the query (the recordset $rs contains the result)
							$rs = mysql_query($strSQL);
							
							// Loop the recordset $rs
							// Each row will be made into an array ($row) using mysql_fetch_array
							while($row = mysql_fetch_array($rs)) {
								$title=$row['Title'];
								$organizer=$row['Organizer'];
								$date=$row['Date'];
								$venue=$row['Venue'];
							   // Write the value of the column FirstName (which is now in the array $row)
							  echo $title ." organized by " .$organizer." on " .$date." at " .$venue . "<hr /><br/>";
							 
							  }

							// Close the database connection
							mysql_close();
							?>
						</div>
						
						<div class="three" style="background-color:#40D1D6; width:32%; height:100%; position:absolute; top:0px; left:520px; overflow:scroll;">
						<center><B>MAYBE EVENT</B></center>
						<hr/>
						<?php
							// Connect to database server
							mysql_connect("localhost", "root", "") or die (mysql_error ());

							// Select database
							mysql_select_db("eventdb") or die(mysql_error());

							// SQL query
							$strSQL = "SELECT * FROM maybedb";

							// Execute the query (the recordset $rs contains the result)
							$rs = mysql_query($strSQL);
							
							// Loop the recordset $rs
							// Each row will be made into an array ($row) using mysql_fetch_array
							while($row = mysql_fetch_array($rs)) {
								$title=$row['Title'];
								$organizer=$row['Organizer'];
								$date=$row['Date'];
								$venue=$row['Venue'];
							   // Write the value of the column FirstName (which is now in the array $row)
							  echo $title ." organized by " .$organizer." on " .$date." at " .$venue . "<hr /><br/>";
							 
							  }

							// Close the database connection
							mysql_close();
							?>
						</div>
                        
						
                    </div>
                </div>
            </div>
            <!-- ROW END -->


        </section>
        <!-- SECTION END -->
    </div>
    <!-- CONATINER END -->

    <!-- REQUIRED SCRIPTS FILES -->
    <!-- CORE JQUERY FILE -->
    <script src="assets/js/jquery-1.11.1.js"></script>
    <!-- REQUIRED BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.js"></script>
<br/>
<div id="footer">
	<div class="container">
		<div class="fbox1">
		<span class="icon icon-map-marker"></span>
			<span>Kalanki, Kathmandu
			<br />Nepal</span>
		</div>
		<div class="fbox1">
			<span class="icon icon-phone"></span>
			<span>
				Telephone: 
			</span>
		</div>
		<div class="fbox1">
			<span class="icon icon-envelope"></span>
			<span>technocrats@gmail.com</span>
		</div>
	</div>
</div>
<br/>

</body>
</html>
