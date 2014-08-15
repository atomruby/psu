<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="<?php echo base_url();?>css/main.css">
<link rel="stylesheet" href="<?php echo base_url();?>css/foundation.css">
<script src="<?php echo base_url();?>js/jquery-1.11.1.js" type="text/javascript"></script>
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
	
<?php // print_r($matrix);?>

<table align="center">
<thead>
	<tr>
		<th>No.</th>
		<th>Begin</th>
		<th>End</th>
		<th>Begin Lat&Lng</th>
		<th>End Lat&Lng</th>
		<th>Distance</th>
		<th>Fuel Consumtion</th>
	</tr>
</thead>
<tbody>
	<?php 
		$no = 1;
		foreach ($matrix as $mat){
			echo "<tr>";
			echo "<td>".$no."</td>";
			echo "<td>".$mat["begin_id"]."</td>";
			echo "<td>".$mat["end_id"]."</td>";
			echo "<td>".$mat["begin_latlng"]."</td>";
			echo "<td>".$mat["end_latlng"]."</td>";
			echo "<td>".$mat["distance"]."</td>";
			echo "<td>".$mat["fuel_com"]."</td>";
			echo "</tr>";
			$no++;
		}
	?>
</tbody>
</table>
	
	</body>
	</html>