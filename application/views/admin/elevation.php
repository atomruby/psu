<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="<?php echo base_url();?>css/main.css">
	<link rel="stylesheet" href="<?php echo base_url();?>css/foundation.css">
		<script src="<?php echo base_url();?>js/jquery-1.11.1.js" type="text/javascript"></script>

		<script type="text/javascript"
		    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDzUkiYZhfglgN2WypyiVDNVyFlJZxjQG0">
		</script>

		<script>
	var dataset;

	$(document).ready(function(){

		var distance = new Array();
		var elevator,
	    map,
	    polyline,
	    crowders = new google.maps.LatLng(35.2083, -81.3108),
	    spencer = new google.maps.LatLng(35.2582, -81.1137),
	    charlotte = new google.maps.LatLng(35.2302, -80.8528);


	    $("#btn").click( function(){

	    	elevator = new google.maps.ElevationService();

	        $.post("getDistance2", 
	                    function( data ){ //data[n].id , data[n].position
	            			for(var i=0;i<data.length;i++){ // start position
	                				setid(data);
									distance[i] = new google.maps.LatLng(data[i].position1,data[i].position2);
	                		}    
							
							elevator = new google.maps.ElevationService();
							
				        	getElevation();
							
	                    },"json");
	 	});

	 	function setid(data){
		dataset = data;
		//document.write(dataset);
		}
		function getdata(){
			return dataset;
		}


	 	function getElevation() {

		  //var locations = [];
			var pathRequest  = {
							    'path': distance,
							    'samples': 256
							 }
		  // Retrieve the clicked location and push it on the array
		  //var clickedLocation = event.latLng;
		  //locations.push(clickedLocation);

		  // Create a LocationElevationRequest object using the array's one value
		  

		  // Initiate the location request
		 elevator.getElevationAlongPath(pathRequest, function(results, status) {
		    if (status == google.maps.ElevationStatus.OK) {

		      // Retrieve the first result
		      if (results[0]) {

		        // Open an info window indicating the elevation at the clicked position
		        infowindow.setContent("The elevation at this point is " + results[0].elevation + " meters.");
		        infowindow.setPosition(clickedLocation);
		        infowindow.open(map);
		      } else {
		        alert("No results found");
		      }
		    } else {
		      alert("Elevation service failed due to: " + status);
		    }
		  });
		}  

	});   
   

		</script>
</head>
<body>
	<!-- Menu Bar Large Resolution -->
	<script type="text/javascript">
	
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
<h1> Get Distance </h1>
<div>
<input type="button" id="btn" value="Calculate Distance" class="button">
<input type="button" id="save" value="Save Data" class="button">
<?php echo anchor(base_url("index.php/admin/getminmatrix"),"Min Matrix", array('class' => 'button','style'=>'float: rigth;'));?>
<!--  <input type="button" id="matrix" value="Min Matrix" class="button" style=" float: right;">-->

</div>
<div id="outputDiv" ></div>
<div id="matrixDiv" ></div>

</body>

</html>


