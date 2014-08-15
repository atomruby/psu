<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="<?php echo base_url();?>css/main.css">
<link rel="stylesheet" href="<?php echo base_url();?>css/foundation.css">

<script src="<?php echo base_url();?>js/jquery-1.11.1.js" type="text/javascript"></script>
</head>
<body>

<script>
	$(document).ready(function(){

		$( "#getprovince" ).change(function() {
			 var id = $( "#getprovince" ).val();
			 $.ajax({
			        type: "POST",
			        url: "user/getlocation",
			        data: "id="+id, 
			        success: function(res){
				        //alert(res);
				        //var i=0;
			        	//if(res){
			        		var table='<center><table class="large-12 columns">';
			        		table += '<thead><th>Location</th><th>Select</th><th>Start</th><th>End</th></thead>';

			        		for(i=0;i<res.length;i++;){
			        			table+="<tr><td>"+res[i].name+"</td>";
				     		 	table+="<input type='checkbox' name='setlocation'>";
								table+="<input type='radio' name='sex'>";
								table+="<input type='radio' name='sex'>";
				     		 	table+="</tr>"; 
				        	}
			        		/*$.each( res, function( index, item){

			     		 	table+="<tr><td>"+item.name+"</td>";
			     		 	table+="<input type='checkbox' name='setlocation'>";
							table+="<input type='radio' name='sex'>";
							table+="<input type='radio' name='sex'>";
			     		 	table+="</tr>";       

			     		 	i++;
			     		 	
			     	      });*/
			        		table+='</table></center>';
							alert(table);
			        		$("#localDiv").html( table );
				       // }
			        }
			    });
			});
		
	});
	</script>
	<div>
		<h4>Select Province
		<?php
				echo form_dropdown('province', $province, null, 'id="getprovince"');
		?>
		</h4>
	</div>
	
	<div id="localDiv">
	
	</div>
</body>
</html>