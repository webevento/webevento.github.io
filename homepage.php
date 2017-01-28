<!DOCTYPE html>
<head>
<title>EZKhoj</title>
<link href="default.css" rel="stylesheet" type="text/css" media="all" />
<link href="fonts.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <style>
  .carousel-inner > .item > img,
  .carousel-inner > .item > a > img {
      width: 1500px;
      margin: auto;
	  height:400px;
  }
  </style>
  <style>
  .controls {
        margin-top: 10px;
        border: 1px solid transparent;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        height: 32px;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
      }
  </style>
 <script type="text/javascript">
	function logoff()
	{
		var question=confirm("Do you want to Logout?");
		if(question==true){
			window.location.href="index.html";
			
		}

	}
	
	function joinevent(btn)
	{
		alert("Joined Successfully to: "+btn.name);
		
	}
	
	function interestedevent(btn)
	{
		alert("You are interested in: "+btn.name);
	}
	
	function maybeevent(btn)
	{
		alert("You are likely to join: "+btn.name);
	}
</script>
  <script src="http://maps.googleapis.com/maps/api/js"></script>
  <?php
	
	session_start();

	if (isset($_SESSION['username'])==false) {
		echo "<script type='text/javascript'>alert('You havent logged in'); window.location.href='index.html';</script>";
	}

	// Connect to database server
	mysql_connect("localhost", "root", "") or die (mysql_error ());

	// Select database
	mysql_select_db("eventdb") or die(mysql_error());

	// SQL query
	$strSQL = "SELECT * FROM eventlist";

	// Execute the query (the recordset $rs contains the result)
	$rs = mysql_query($strSQL);
	$latArray = array();
	$longArray = array();
	$count=0;
	
	// Loop the recordset $rs
	// Each row will be made into an array ($row) using mysql_fetch_array
			while($row = mysql_fetch_assoc($rs))
			{
			  $titleArray[]=$row['Title'];
			  $latArray[] = $row['Latitude'];
			  $longArray[]=$row['Longitude'];
			  $organizerArray[]=$row['Organizer'];
			  $dateArray[]=$row['Date'];
			  $venueArray[]=$row['Venue'];
			  $count++;
			}

	// Close the database connection
	mysql_close();
	?>

	
<script>

jQuery(function($) {
    // Asynchronously Load the map API 
    var script = document.createElement('script');
    //AIzaSyDsnkkcSV0zSQFyQf7A1VkxWhQ_KmdK17Q
    script.src = "http://maps.googleapis.com/maps/api/js?key=AIzaSyDsnkkcSV0zSQFyQf7A1VkxWhQ_KmdK17Q&libraries=places&sensor=false&callback=initialize";
    document.body.appendChild(script);
});

function initialize() {
	var counts=<?php echo $count; ?>;
	
	var title = new Array();
    <?php foreach($titleArray as $key => $val){ ?>
        title.push('<?php echo $val; ?>');
    <?php } ?>
	
	
	var latitude = new Array();
    <?php foreach($latArray as $key => $val){ ?>
        latitude.push('<?php echo $val; ?>');
    <?php } ?>
	

	var longitude = new Array();
    <?php foreach($longArray as $key => $val){ ?>
        longitude.push('<?php echo $val; ?>');
    <?php } ?>

	var venue = new Array();
    <?php foreach($venueArray as $key => $val){ ?>
        venue.push('<?php echo $val; ?>');
    <?php } ?>
	
	var date = new Array();
    <?php foreach($dateArray as $key => $val){ ?>
        date.push('<?php echo $val; ?>');
    <?php } ?>
	
	var organizer = new Array();
    <?php foreach($organizerArray as $key => $val){ ?>
        organizer.push('<?php echo $val; ?>');
    <?php } ?>
	
    var map;
    var bounds = new google.maps.LatLngBounds();
    var mapOptions = {
        mapTypeId: 'roadmap'
    };
                    
    // Display a map on the page
    map = new google.maps.Map(document.getElementById("googleMap"), mapOptions);
    map.setTilt(45);
        
    
// Create the search box and link it to the UI element.
  var input = document.getElementById('pac-input');
  var searchBox = new google.maps.places.SearchBox(input);
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
  // Bias the SearchBox results towards current map's viewport.
  map.addListener('bounds_changed', function() {
    searchBox.setBounds(map.getBounds());
  });
  


  // Multiple Markers
   
  var markers = [];
	for(var i=0;i<counts;i++)
	{
		markers[i]=[];
		markers[i][0]=title[i];
		markers[i][1]=latitude[i];
		markers[i][2]=longitude[i];
		markers[i][3]=date[i];
		markers[i][4]=venue[i];
		markers[i][5]=organizer[i];
		
	}
	
           
  
        
    // Display multiple markers on a map
    var infoWindow = new google.maps.InfoWindow(), marker, i;
    
    // Loop through our array of markers & place each one on the map  
    for( i = 0; i < markers.length; i++ ) {
        var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
        bounds.extend(position);
        marker = new google.maps.Marker({
            position: position,
            map: map,
			animation:google.maps.Animation.BOUNCE,
            title: markers[i][0]
        });
        
		
   
        // Allow each marker to have an info window    
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
               infoWindow.setContent("<b>Title:"+markers[i][0]+"<br>"+"Organizer:"+markers[i][5]+"<br>"+"Date:"+markers[i][3]+"<br>"+"Venue:"+markers[i][4]+"</B>");
                infoWindow.open(map, marker);
            }
        })(marker, i));

        // Automatically center the map fitting all markers on the screen
        map.fitBounds(bounds);
    }

    // Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
        this.setZoom(14);
        google.maps.event.removeListener(boundsListener);
    });
    
}
</script>


  

</head>
<body background="images/bg1.jpg">
<div id="header-wrapper">
	<div id="header" class="container">
		<div id="logo">
			<img src="images/icon.gif" height="150" width="150">
			<h1><a href="#"><font color="white" size="10" face="Monotype Corsiva">EZKhoj</font></a></h1>

		</div>
		<div id="menu">
			<ul>
				<li class="active"><a href="#" accesskey="1" title="">Homepage</a></li>
				<li><a href="userprofile.php" accesskey="2" title="">My Profile</a></li>
				<li><a href="updateevents.html" accesskey="4" title="">Update Events</a></li>
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
<div class="container">
  <br>
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
	   <li data-target="#myCarousel" data-slide-to="3"></li>
	    <li data-target="#myCarousel" data-slide-to="4"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">

      <div class="item active">
        <img src="images/1.jpg" alt="Chania" width="1260" height="245">
        <div class="carousel-caption">
          <h3>13th March,2016</h3>
          <p>International Health Day Campaign by XYZ Organization</p>
        </div>
      </div>
	  
	  <div class="item">
        <img src="images/3.png" alt="Chania" width="1260" height="245">
        <div class="carousel-caption">
          <h3>26th October,2016</h3>
          <p>Breast Cancer Awareness Campaign by WearItPink</p>
        </div>
      </div>

      <div class="item">
        <img src="images/2.jpg" alt="Chania" width="1260" height="245">
        <div class="carousel-caption">
          <h3>29th August,2016</h3>
          <p>Run For Peace</p>
        </div>
      </div>
	  
	  <div class="item">
        <img src="images/4.jpeg" alt="Chania" width="1260" height="245">
        <div class="carousel-caption">
          <h3>29th October,2016</h3>
          <p>Oral Polio Vaccine</p>
        </div>
      </div>
	  
	  <div class="item">
        <img src="images/concert.jpg" alt="Chania" width="1260" height="245">
        <div class="carousel-caption">
          <h3>29th November,2016</h3>
          <p>Downside Concert Festival</p>
        </div>
      </div>
	  
	   
    
   
  </div>
</div>
<br/><br/>

<input id="pac-input" class="controls" type="text" placeholder="Search Box" size="100"/>
<div id="googleMap" style="width:70%;height:765px;"></div>
<div class="scrapedevents" style="
		background-color:#BFD1E2;
		position:absolute;	
		top:1480px;
		left:925px;
		width:320px;
		height:250px;
		overflow:scroll;">
		<font color="navy" size="4" face="Courier New"><center>EVENTS FROM OTHER SITES</font></center><hr/>
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
			
			$strSQL = "TRUNCATE crawledevent";
			mysql_query($strSQL,$con);
			
			for($i=0;$i<$arrlength;$i++)
			{
				$sql="INSERT INTO crawledevent VALUES('$output[$i]')";
					if (!mysql_query($sql,$con))
					  {
					  die('Error: ' . mysql_error());
					  }

			} 
			// SQL query
			$strSQL = "SELECT * FROM crawledevent";

			// Execute the query (the recordset $rs contains the result)
			$rs = mysql_query($strSQL);
			
			// Loop the recordset $rs
			// Each row will be made into an array ($row) using mysql_fetch_array
			while($row = mysql_fetch_array($rs)) {
				$title=$row['Title'];
			   // Write the value of the column FirstName (which is now in the array $row)
			  echo $title. "<hr/>";
			}
			

mysql_close($con);
?>
</div>
<div class="newsfeed" style="
		background-color:#BFD1E2;
		position:absolute;	
		top:965px;
		left:925px;
		width:23.8%;
		height:500px;
		overflow:scroll;">
<font color="navy" size="6" face="Courier New"><center>NEWSFEED</font></center>
<hr/>
	<?php
	// Connect to database server
	mysql_connect("localhost", "root", "") or die (mysql_error ());

	// Select database
	mysql_select_db("eventdb") or die(mysql_error());

	// SQL query
	$strSQL = "SELECT * FROM eventlist";

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
	  echo $title ." organized by " .$organizer." on " .$date." at " .$venue . "<br /><br/>";
	  echo ("<form method='POST' style='display:inline;' action='join.php'>"."<center>"."<input type='submit' value ='Join' name='$title' onClick='joinevent(this)'  style='background-color:#1C5CCC; color:white;'> <input type='hidden' value='$title' name='eventname'/></form>"
	  ."<form method='POST' style='display:inline;' action='interested.php'><input type='submit' value='Interested' name='$title' onClick='interestedevent(this)' style='background-color:#1C5CCC; color:white;'><input type='hidden' value='$title' name='eventname'/></form>"
	  ."<form method='POST' style='display:inline;' action='maybe.php'><input type='submit' value='Maybe' name='$title' onClick='maybeevent(this)' style='background-color:#1C5CCC; color:white;'>"."<hr/></center><input type='hidden' value='$title' name='eventname'/></form>");
 
	  }

	// Close the database connection
	mysql_close();
	?>
</div>
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
				Telephone:<br/>014032047/9841449616/9843286220
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
