<?php 
	include('includes/config.php');
	$company_id = $_REQUEST['company_id'];
	
	$query = "select * from companies where company_id='$company_id'";
	$result = mysql_query($query) or die(mysql_error());
	$row = mysql_fetch_assoc($result);
	
	$address = $row['address'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Map</title>

<style>
	#mymap {
		width: 1200px; 
		height: 600px; 
		border: 1px solid #000; 
	}

	body { 
		font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; 
		font-size: 16; 
		background: #fff; 
	}

</style>

<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&sensor=false"></script>



</head>

<body>
    <div id="mymap"></div>
    <input type="hidden" id="address" name="address" value="<?php echo $address; ?>" />
</body>

<script>

	var map;
	
	//function goToTheGivenPlace() {
		var mapId = document.getElementById("mymap");
		
		//var starting_address = document.getElementById("first_place").value;
		
		var starting_address = document.getElementById('address').value;
		//alert(starting_address);
		geocoder = new google.maps.Geocoder();
		
		var geocoderRequest = {
			address: starting_address 
		};

		geocoder.geocode(geocoderRequest, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				//mapId = document.getElementById("mymap");
				var position = new google.maps.LatLng(results[0].geometry.location.lat(),
						results[0].geometry.location.lng());
				
		// i have set the zoom to 18 because at this value it gives a clear and detail 
		//view of all locations near by...
			var options = { 
				center: position, 
				zoom: 18,
				mapTypeId: google.maps.MapTypeId.DEFAULT,
				mapTypeIds: [
											google.maps.MapTypeId.HYBRID,
											google.maps.MapTypeId.TERRAIN,
											google.maps.MapTypeId.ROADMAP, 
											google.maps.MapTypeId.SATELLITE
										],
				mapTypeControl:false,
				mapTypeControlOptions:{
										style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
										position: google.maps.ControlPosition.TOP
										
									}
				};

			map = new google.maps.Map(mapId, options);
	
			var marker = new google.maps.Marker({ 
				position: new google.maps.LatLng(results[0].geometry.location.lat(),
						results[0].geometry.location.lng()),
				//icon: 'http://gmaps-samples.googlecode.com/svn/trunk/markers/red/blank.png',
				map: map
			});
		}
		});
		
</script>
</html>