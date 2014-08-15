
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="<?php echo base_url();?>css/main.css">
<link rel="stylesheet" href="<?php echo base_url();?>css/foundation.css">
<script src="js/foundation.min.js"></script>
<script src="<?php echo base_url();?>js/vendor/custom.modernizr.js"></script>
	<title> Admin </title>
	<link rel="stylesheet" href="<?php echo base_url();?>css/main.css">
	<script>
	$(document).ready(function(){
	
		$("#btn").click(function(){
			document.getElementById('name').value = "";
			document.getElementById('lat').value = "";
			document.getElementById('lng').value = "";
			document.getElementById('address').value = "";
			document.getElementById('city').value = "";
			document.getElementByName("province").value = "00";
	
		});

	});
	</script>
<style type="text/css">  
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

	/*var marker = new google.maps.Marker({
      position: myLatlng,
      map: map,
      title: 'Hello World!'
	});

	marker.setMap(map);*/

      
    
	  google.maps.event.addListener(map, "click", function (e) { 

    //lat and lng is available in e object
	//alert('Lat: ' + e.latLng.lat() + ' Lng: ' + e.latLng.lng());
    // var latLng = e.latLng.lat();
	//$("#lat").val(e.latLng.lat());
	//$("#lng").val(e.latLng.lng());
	document.getElementById('lat').value = e.latLng.lat();
	document.getElementById('lng').value = e.latLng.lng();

	}); 
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
			<?php echo anchor(base_url("admin"),"MANAGE LOCATION");?>
			<?php echo anchor(base_url("admin/getdistance"),"DISTANCE");?>
			<?php echo anchor(base_url("admin/getelevation"),"ELEVATION");?>
			
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
					<li><?php echo anchor(base_url("index.php/admin"),"ELEVATION");?></li>
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
			<?php  echo form_open('admin/addlocation'); ?>
				
			<table>
				<tr>
					<td> Name : </td>
					<td> <input type="text" name="name" id="name" style="width: 200px;"> </td>
				</tr>
				<tr>
					<td> Lat : </td>
					<td> <input type="text" name="lat" id="lat"  style="width: 200px;"> </td>
				</tr>
				<tr>
					<td> Lng : </td>
					<td> <input type="text" name="lng" id="lng" style="width: 200px;"> </td>
				</tr>
				<tr>
					<td> Address : </td>
					<td><textarea name="address" rows="3" cols="25" id="address"></textarea></td>
				</tr>
				<tr>
					<td> City : </td>
					<td> <input type="text" name="city" id="city" style="width: 200px;"> </td>
				</tr>
				<tr>
					<td> Province : </td>
					<td><?php
							echo form_dropdown('province', $province, null);
						?></td>
				</tr>

				<tr>
					<td>&nbsp; </td>
					<td> <input type="submit" class="submitbtn" name="btnadd" value ="Add">&nbsp; <input type="button" class="cancelbtn" name="btnclear" id="btn" value ="Clear"></td>
				</tr>
			</table>
			<?php echo form_close();?>
		</div>
		</center>
		
		</div>
	</div>
	<div class="large-12 columns">
	<table border=0 width="100%" class="large-12 columns">
		<thead>
			<tr style="background-color: #D7F2F3;">
			 <th>No.</th>
			 <th>Name</th>
			 <th>Lat</th>
			 <th>Lng</th>
			 <th>Address</th>
			 <th>City</th>
			 <th>Province</th>
			 <th colspan ="2">Manage</th>
			</tr>
		</thead>
		<tbody>
		<?php

			$js = 'onClick="some_function()"';
			if(count($rs)==0)
			{
				echo "<tr><td colspan='7' align='center'>==== No Data ===== </td></tr>";
			}
			else
			{
				$no=1;
				foreach($rs as $l)
				{
					echo "<tr>";
					echo "<td>$no".form_hidden('id',$l['id'])."</td>";
					echo "<td>".$l['name']."</td>";
					echo "<td>".$l['lat']."</td>";
					echo "<td>".$l['lng']."</td>";
					echo "<td>".$l['address']."</td>";
					echo "<td>".$l['city']."</td>";
					echo "<td>".$province[$l['province']]."</td>";
					echo "<td>".anchor("admin/edit/".$l['id'],"Edit")."</td>";
					echo "<td><a href = 'admin/del/".$l['id']."' onclick = 'return checkDelete()'>Delete</a></td>";
					echo "</tr>";
				$no++;
				}
			}
		?>
		</tbody>
	</table>
	</div>
	<script language="JavaScript" type="text/javascript">
	function checkDelete(){
    return confirm('Are you sure to delete this location?');
	}

</script>
</body>

</html>