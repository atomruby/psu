<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <style type="text/css">
      html { height: 100% }
      body { height: 100%; margin: 0; padding: 0 }
      #map-canvas { height: 100% }
    </style>
    <script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDzUkiYZhfglgN2WypyiVDNVyFlJZxjQG0">
    </script>
    <script type="text/javascript">
      function initialize() {
		 
		var myLatlng = new google.maps.LatLng(7.910724, 98.333728);

        var mapOptions = {
          center: myLatlng,
          zoom: 15
        };
    var map = new google.maps.Map(document.getElementById("map-canvas"),
            mapOptions);

	var marker = new google.maps.Marker({
      position: myLatlng,
      map: map,
      title: 'Hello World!'
	});

	marker.setMap(map);

      }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
  </head>
  <body>
	
    <div id="map-canvas"/>
  </body>
</html>