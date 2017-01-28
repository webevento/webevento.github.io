<script
src="http://maps.googleapis.com/maps/api/js">
</script>

<script>
var myCenter=new google.maps.LatLng(51.508742,-0.120850);
var marker2=new google.maps.LatLng(53.508742,-0.130850);

function initialize()
{
var mapProp = {
  center:myCenter,
  zoom:5,
  mapTypeId:google.maps.MapTypeId.ROADMAP
  };

var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

var marker=new google.maps.Marker({
  position:myCenter,
  });

marker.setMap(map);

var mapProp1 = {
  center:marker2,
  zoom:5,
  mapTypeId:google.maps.MapTypeId.ROADMAP
  };


var marker1=new google.maps.Marker({
  position:marker2,
  });

marker1.setMap(map);
}

google.maps.event.addDomListener(window, 'load', initialize);
</script>

