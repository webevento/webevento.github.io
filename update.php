<html>
<body>
 
<?PHP
	$con = mysql_connect("localhost","root","");
	if (!$con)
	  {
	  die('Could not connect: ' . mysql_error());
	  }
	mysql_select_db("eventdb", $con) or die('Could not select database');
	if ($_POST)
	{ 
	$name=$_POST['name'];
	$date=$_POST['date'];
	$venue= $_POST['venue'];
  /**
   * Here we build the url we'll be using to access the google maps api
   */
  $maps_url = 'https://'.
  'maps.googleapis.com/'.
  'maps/api/geocode/json'.
  '?address=' . urlencode($venue);
  $maps_json = file_get_contents($maps_url);
  $maps_array = json_decode($maps_json, true);
  $latitude = $maps_array['results'][0]['geometry']['location']['lat'];
  $longitude = $maps_array['results'][0]['geometry']['location']['lng'];

	$Organizer=$_POST['Organizer'];
	$Category=$_POST['Category'];
	$eventtype=$_POST['eventtype'];
	$sql="INSERT INTO eventlist VALUES('$name','$date','$venue','$Organizer','$latitude','$longitude','$Category','$eventtype')";
	if (!mysql_query($sql,$con))
	  {
	  die('Error: ' . mysql_error());
	  }
	 mysql_close($con); 
	  
	}
?>
	<script type='text/javascript'>
		alert('You have successfully updated the event. Thank you!  '); 
		window.location.href='homepage.php';
	</script>";


</body>
</html>