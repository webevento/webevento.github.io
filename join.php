<?PHP
			session_start();
			
			$titles=$_POST['eventname'];

			$con = mysql_connect("localhost","root","");
			if (!$con)
			  {
			  die('Could not connect: ' . mysql_error());
			  }
			  mysql_select_db("eventdb") or die(mysql_error());

			// SQL query
			$strSQL = "SELECT * FROM eventlist where Title='$titles'";

			// Execute the query (the recordset $rs contains the result)
			$rs = mysql_query($strSQL);
			
			// Loop the recordset $rs
			// Each row will be made into an array ($row) using mysql_fetch_array
			while($row = mysql_fetch_array($rs)) {
				$title=$row['Title'];
				$organizer=$row['Organizer'];
				$date=$row['Date'];
				$venue=$row['Venue'];
				mysql_select_db("eventdb", $con) or die('Could not select database');
				$sql="INSERT INTO joindb VALUES('$title','$organizer','$date','$venue')";
				if (!mysql_query($sql,$con))
				  {
				  die('Error: ' . mysql_error());
				  }
			}
			header("location:homepage.php");
			 mysql_close($con); 
			  
		?>