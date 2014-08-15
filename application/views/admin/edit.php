
<html>
<head>
<meta charset="utf-8">
	<title> Admin </title>
	
<link rel="stylesheet" href="<?php echo base_url();?>css/main.css">
<link rel="stylesheet" href="<?php echo base_url();?>css/foundation.css">
<script src="js/foundation.min.js"></script>
<script src="<?php echo base_url();?>js/vendor/custom.modernizr.js"></script>

<style type="text/css">  


 #map-canvas { height: 100% }
</style>  

 <script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDzUkiYZhfglgN2WypyiVDNVyFlJZxjQG0">
    </script>
    <script type="text/javascript">

	var map;
var markers = [];

function initialize() {
	var lat = <?=$rs['lat'] ?>; 
	var lng = <?=$rs['lng'] ?>; 
	var myLatlng = new google.maps.LatLng(lat,lng);
  var mapOptions = {
    zoom: 18,
    center: myLatlng,
   // mapTypeId: google.maps.MapTypeId.TERRAIN
  };
  map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);

  // This event listener will call addMarker() when the map is clicked.
  google.maps.event.addListener(map, 'click', function(event) {
	deleteMarkers(); 
    addMarker(event.latLng);
	document.getElementById('lat').value = event.latLng.lat();
	document.getElementById('lng').value = event.latLng.lng();
  });

  // Adds a marker at the center of the map.
	
  addMarker(myLatlng);
}

// Add a marker to the map and push to the array.
function addMarker(location) {
  var marker = new google.maps.Marker({
    position: location,
    map: map
  });
  markers.push(marker);
}

// Sets the map on all markers in the array.
function setAllMap(map) {
  for (var i = 0; i < markers.length; i++) {
    markers[i].setMap(map);
  }
}

// Deletes all markers in the array by removing references to them.
function deleteMarkers() {
  setAllMap(null);
  markers = [];
}

google.maps.event.addDomListener(window, 'load', initialize);
    </script>

</head>

<body>
	
	<!-- Menu Bar Large Resolution -->
	<script>
	
	function showMenu() {
		document.getElementById('menu-small').style.display = "block";
	}
	function hideMenu() {
		document.getElementById('menu-small').style.display = "none";
	}

  </script>
	<nav class="top-bar">
		<ul class="Menu-top hide-for-small">
			<?php echo anchor(base_url("index.php/admin"),"MANAGE LOCATION");?>
			<?php echo anchor(base_url("index.php/admin/getdistance"),"DISTANCE");?>
		</ul>
		
	</nav>
	<!-- End Menu Bar Large Resolution -->
	<!-- Menu Small Resolution -->
	<div class="row show-for-small small-menu">
		<div class="large-6 columns">
			<section>
				<div style="float: left;" onclick="showMenu()">
					<h6>
						<a><img src="<?php echo base_url();?>images/menu-wht.png" width="25" height="auto"
							border="0" alt="">Menu</a>
					</h6>	
				</div>
				<div id="menu-small" style="display: none;">
					<hr />
					<li><?php echo anchor(base_url("index.php/admin"),"MANAGE LOCATION");?></li>
					<hr />
					<li><?php echo anchor(base_url("index.php/admin/getdistance"),"DISTANCE");?></li>
					<hr />
					<center>
						<div style="cursor: pointer;" onclick="hideMenu()">
							<img src="<?php echo base_url();?>images/arrow-up-01-16.png" width="24" height="24"
								border="0" alt="">
						</div>
					</center>
				</div>
			</section>
		</div>
	</div>
	<!-- End Menu Small Resolution -->

	<div class="large-12 columns" style="height: 590px;">
		<div class="large-9 columns">
			    <div id="map-canvas"/></div>
		</div>
		<div class="large-3 columns">

		<center>
		<div >
			<h1>Add Location</h1>
			<?php  echo form_open('admin/edit/'.$rs['id']); ?>
				
			<table>
				<tr>
					<td> Name : </td>
					<td> <input type="text" name="name" id="name" value="<?php echo $rs['name'];?>" style="width: 225px;"> </td>
				</tr>
				<tr>
					<td> Lat : </td>
					<td> <input type="text" name="lat" id="lat" value="<?php echo $rs['lat'];?> " style="width: 225px;"> </td>
				</tr>
				<tr>
					<td> Lng : </td>
					<td> <input type="text" name="lng" id="lng" value="<?php echo $rs['lng'];?>" style="width: 225px;"> </td>
				</tr>
				<tr>
					<td> Address : </td>
					<td><textarea name="address" rows="3" cols="25" ><?php echo $rs['address'];?></textarea></td>
				</tr>
				<tr>
					<td> City : </td>
					<td> <input type="text" name="city" value ="<?php echo $rs['city'];?>" style="width: 225px;"> </td>
				</tr>
				<tr>
					<td> Province : </td>
					<td><?php
							echo form_dropdown('province', $province,$rs['province']);
						?></td>
				</tr>

				<tr>
					<td>&nbsp; </td>
					<td> <input type="submit" class="submitbtn" name="btnsave" value ="Save">&nbsp; <?php echo anchor("admin","Cancel",array('class' => 'cancelbtn'));?></td>
				</tr>
			</table>
			<?php echo form_close();?>
		</div>
		</center>
		
		</div>
	</div>
</body>
</html>