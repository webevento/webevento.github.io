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
	
	
</script>
 <style type="text/css">
		*, *:before, *:after {
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
}

body {
  font-family: 'Nunito', sans-serif;
  color: #384047;
}

form {
  max-width: 400px;
  margin: 40px auto;
  padding: 10px 20px;
  background: #f4f7f8;
  border-radius: 8px;
}

h1 {
  margin: 0 0 30px 0;
  text-align: center;
}

input[type="text"],
input[type="password"],
input[type="date"],
input[type="datetime"],
input[type="email"],
input[type="number"],
input[type="search"],
input[type="tel"],
input[type="time"],
input[type="url"],
textarea,
select {
  background: rgba(255,255,255,0.1);
  border: none;
  font-size: 16px;
  height: auto;
  margin: 50;
  outline: 0;
  padding: 15px;
  width: 100%;
  background-color: #e8eeef;
  color: #8a97a0;
  box-shadow: 0 1px 0 rgba(0,0,0,0.03) inset;
  margin-bottom: 30px;
}

input[type="radio"],
input[type="checkbox"] {
  margin: 0 4px 8px 0;
}

select {
  padding: 6px;
  height: 32px;
  border-radius: 2px;
}

button {
  padding: 19px 39px 18px 39px;
  color: #FFF;
  background-color: #3ac7dc;
  font-size: 18px;
  text-align: center;
  font-style: normal;
  border-radius: 5px;
  width: 100%;
  border: 1px solid #84bcec;
  border-width: 1px 1px 3px;
  box-shadow: 0 -1px 0 rgba(255,255,255,0.1) inset;
  margin-bottom: 10px;
}

fieldset {
  margin-bottom: 30px;
  border: none;
}

legend {
  font-size: 1.4em;
  margin-bottom: 10px;
}

label {
  display: block;
  margin-bottom: 8px;
}

label.light {
  font-weight: 300;
  display: inline;
}

.number {
  background-color: #35e2c0;
  color: #fff;
  height: 30px;
  width: 30px;
  display: inline-block;
  font-size: 0.8em;
  margin-right: 4px;
  line-height: 30px;
  text-align: center;
  text-shadow: 0 1px 0 rgba(255,255,255,0.2);
  border-radius: 100%;
}

@media screen and (min-width: 480px) {

  form {
	  
    max-width: 480px;
  }

}
	</style>
	
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

                    <br /><br/>
                </div>
                
                 
                    
			<img style="position:absolute; top:520px; right:400px;" src="images/userid.png" height="140" width="150">			
              
<form action="updateuser.php" method="post">
      
        <h1>Edit Profile</h1>
        
        <fieldset>
          <legend><span class="number">1</span>Your basic info</legend>
          <label for="name">Fullname:</label>
          <input type="text" required id="Fullname" name="Fullname">
          
          <label for="date">Username:</label>
          <input type="text" required id="Username" name="Username">
          
          <label for="venue">Email:</label>
          <input type="text" required id="Email" name="Email">
          
          <label>Password:</label>
          <input type="password" required id="Password" name="Password">
        </fieldset>
        
    
		
		
        </fieldset>
        <button type="submit">Save Changes</button>
      </form>
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
