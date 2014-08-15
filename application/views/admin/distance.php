<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="<?php echo base_url();?>css/main.css">
<link rel="stylesheet" href="<?php echo base_url();?>css/foundation.css">
<script src="<?php echo base_url();?>js/jquery-1.11.1.js" type="text/javascript"></script>

<script>

</script>
 <script type="text/javascript"
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDzUkiYZhfglgN2WypyiVDNVyFlJZxjQG0">
    </script>

<script>

	var directionsDisplay;
	//var directionsService = new google.maps.DirectionsService();
	var map;

	function initialize() {
		
	  directionsDisplay = new google.maps.DirectionsRenderer();
	  var chicago = new google.maps.LatLng(41.850033, -87.6500523);
	  var mapOptions = {
	    zoom: 6,
	    center: chicago
	  }
	  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
	  directionsDisplay.setMap(map);
	}    
	var set = new Array();
	var set_ele = new Array();
	var no =0;
	var dataset;
	/*-----------GET POSITION----------*/
	$(document).ready(function(){
	var distance = new Array();
	elevator = new google.maps.ElevationService();
		$("#btn").click( function(){
	        $.post("getDistance2", 
	                    function( data ){ //data[n].id , data[n].position
	            			for(var i=0;i<data.length;i++){ // start position
	                				setid(data);
									distance[i] = new google.maps.LatLng(data[i].position1,data[i].position2);
	                		}    
							
				        	var service = new google.maps.DistanceMatrixService();
				        	 service.getDistanceMatrix(
				        	    {
				        	      origins: distance,
				        	      destinations: distance,
				        	      travelMode: google.maps.TravelMode.DRIVING,
				        	      unitSystem: google.maps.UnitSystem.METRIC,
				        	      avoidHighways: false,
				        	      avoidTolls: false
				        	    }, callback);  
							
	                    },"json");
	 	});   
	//=========== END btn
		$("#save").click( function(){
			var jsonString = JSON.stringify(set);
			var ele = JSON.stringify(elevations_set);
			$.ajax({
		        type: "POST",
		        url: "savedistance",
		        data: {data : jsonString, ele : ele}, 
		        cache: false,
		        success: function(res){
		        	if(res == 0)
		        	{ 
			        	alert("Conplete to saving data to database");
		        	}else{
		        		alert("Can't save data to database -- please contact wabsite administrator");
			        }
		        }
		    });
		});
	//============== END save

	});
	/*-------------END document-------------*/
	function setid(data){
		dataset = data;
		//document.write(dataset);
	}
	function getdata(){
		return dataset;
	}
	var elevations_set = new Array();
	function getElevetionSet(a,b) {
		  var path = [ a, b];

		  var pathRequest = {
		    'path': path,
		    'samples': 5
		  }

		  // Initiate the path request.
		elevator.getElevationAlongPath(pathRequest, function(results, status) {
				var elev
		        if (status == google.maps.ElevationStatus.OK) {
		          var elevations = results;
		          
		          
		          for(var i=0;i<results.length;i++){
		        	  elevations_set[i] = elevations[i].elevation;
		        	  					
			      }
		        }

		        //console.log(elevations_set);//console.log(elevations_set);
		        return elevations_set;
		      });
		}
	
	function callback(response, status) {
			  if (status != google.maps.DistanceMatrixStatus.OK) {
			    alert('Error was: ' + status);
			  } else {
			    var origins = response.originAddresses;
			    var destinations = response.destinationAddresses;
			    var outputDiv = document.getElementById('outputDiv');
			    var html = "<table align='center'><thead><th>Start</th><th>End</th><th>Distance</th><th>Elevation Set</th></thead><tbody>";
			    outputDiv.innerHTML = '';
			    //alert("OK");
			  	var findid = getdata();
			   // alert(outputDiv.innerHTML);
			   
			   

			    for (var i = 0; i < origins.length; i++) {
			      var results = response.rows[i].elements;
			      //addMarker(origins[i], false);
			      for (var j = 0; j < results.length; j++) {
			       // addMarker(destinations[j], true);
			       var begin_id = findid[i]["id"];
			       var end_id = findid[j]["id"];

			       start = new google.maps.LatLng(parseFloat(findid[i]["position1"]),parseFloat(findid[i]["position2"]));
			       end = new google.maps.LatLng(parseFloat(findid[j]["position1"]),parseFloat(findid[j]["position2"]));
			       getElevetionSet(start,end);

				   var begin_pos = findid[i]["position1"]+","+findid[i]["position2"];
				   var end_pos = findid[j]["position1"]+","+findid[j]["position2"];
				   
			       if(i!==j){
			        html += '<tr>';
			        html += '<td>'+origins[i]+ '</td>';
			        html += '<td>'+destinations[j] + '</td>';
			        html += '<td>'+results[j].distance.text + '</td>';	
			      //  html += '<td>'+elevation+ '</td>';	
			        html += '</tr>';  
				   set[no] = {begin_id:begin_id,end_id:end_id,distance:results[j].distance.text,begin_pos:begin_pos,end_pos:end_pos};
				   // alert(set[no]);
				   //set[no]['begin_id'] = findid[i]["id"];
				  // set[no]['end_id'] = findid[j]["id"];
				   //set[no]['distance'] = results[j].distance.text;
				    no++;
			       }
			      }
			    }
			    
			    html +='</tbody><table>';
			    outputDiv.innerHTML += html;
			//    alert(html);
			  }

			//  return set;
			}

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