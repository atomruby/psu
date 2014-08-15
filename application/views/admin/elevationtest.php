<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Showing elevation along a path</title>
    <style>
      html, body, #map-canvas {
        height: 100%;
        margin: 0px;
        padding: 0px
      }
    </style>
    <script src="https://www.google.com/jsapi"></script>
    <script src="<?php echo base_url();?>js/jquery-1.11.1.js" type="text/javascript"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
    <script>
var elevator;
var map;
var chart;
var polyline;
var arrEle = new Array();
var set_ele = new Array();

elevator = new google.maps.ElevationService();
$(document).ready(function(){

    $.post("getPositionForElevation", 
                  function( data ){ //data[n].id , data[n].position
                    //console.log(data.length);
                    for (var i = 0; i < data.length; i++) {
                          start = new google.maps.LatLng(parseFloat(data[i].start_lat),parseFloat(data[i].start_lng));
                          end   = new google.maps.LatLng(parseFloat(data[i].end_lat),parseFloat(data[i].end_lat));
                          getElevetionSet(data[i].start_id,data[i].end_id,start,end);

                      }
                      
                      // alert(arrEle);
                  /*for(var i=0;i<data.length;i++){ // start position
                    //setid(data);
                    //distance[i] = new google.maps.LatLng(data[i].position1,data[i].position2);
                  } */   
              
                 
              
                 // getElevation();
              
                      },"json");

});

// The following path marks a general path from Mt.
// Whitney, the highest point in the continental United
// States to Badwater, Death Valley, the lowest point.
var whitney = new google.maps.LatLng(36.578581, -118.291994);
var lonepine = new google.maps.LatLng(36.606111, -118.062778);
/*
  var owenslake = new google.maps.LatLng(36.433269, -117.950916);
  var beattyjunction = new google.maps.LatLng(36.588056, -116.943056);
  var panamintsprings = new google.maps.LatLng(36.339722, -117.467778);
  var badwater = new google.maps.LatLng(36.23998, -116.83171);
*/
// Load the Visualization API and the columnchart package.
//google.load('visualization', '1', {packages: ['columnchart']});

/*    function initialize() {
      var mapOptions = {
        zoom: 8,
        center: lonepine,
        mapTypeId: 'terrain'
      }
      map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

      // Create an ElevationService.
      

      // Draw the path, using the Visualization API and the Elevation service.
      drawPath();
    }
*/
//elevator = new google.maps.ElevationService();
function getElevetionSet(start_id,end_id,a,b) {
  var path = [ a, b];

  var pathRequest = {
    'path': path,
    'samples': 5
  }

  // Initiate the path request.
  elevator.getElevationAlongPath(pathRequest, function(results, status) {
        if (status == google.maps.ElevationStatus.OK) {
          var elevations = results;
          var index = 0;
          var set = new Array();  

          for (var i =0; i < results.length;i++) {
              set[i] = elevations[i].elevation;
          }
              //console.log(set);
          		arrEle[index] = set;// = {lat:start_id,lng:end_id,elevations:set_ele[index]};
          		
            index++;
        }
        console.log(arrEle);
      });
}

// Takes an array of ElevationResult objects, draws the path on the map
// and plots the elevation profile on a Visualization API ColumnChart.
/*      function plotElevation(results, status) {
        if (status != google.maps.ElevationStatus.OK) {
          return;
        }
        var elevations = results;

        // Extract the elevation samples from the returned results
        // and store them in an array of LatLngs.
        var elevationPath = [];
        for (var i = 0; i < results.length; i++) {
          elevationPath.push(elevations[i].location);
        }

        // Display a polyline of the elevation path.
        var pathOptions = {
          path: elevationPath,
          strokeColor: '#0000CC',
          opacity: 0.4,
          map: map
        }
        polyline = new google.maps.Polyline(pathOptions);

        // Extract the data from which to populate the chart.
        // Because the samples are equidistant, the 'Sample'
        // column here does double duty as distance along the
        // X axis.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Sample');
        data.addColumn('number', 'Elevation');
        for (var i = 0; i < results.length; i++) {
          data.addRow(['', elevations[i].elevation]);
        }

        // Draw the chart using the data within its DIV.
        document.getElementById('elevation_chart').style.display = 'block';
        chart.draw(data, {
          height: 150,
          legend: 'none',
          titleY: 'Elevation (m)'
        });
      }
*/
//google.maps.event.addDomListener(window, 'load', initialize);

    </script>
  </head>
  <body>
    <div>
      <input type="button" id="btn" value="Calculate Distance" class="button">
      <div id="map-canvas" style="height:250px;"></div>
      <div id="elevation_chart"></div>
    </div>
  </body>
</html>