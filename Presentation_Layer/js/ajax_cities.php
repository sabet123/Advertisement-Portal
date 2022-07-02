<?php
	include("../includes/config.php");

	$country_id = $_GET['country_id'];

	$query = "select * from countries as c, cities as ci where c.country_id=ci.country_id and c.country_id=".$country_id;
	$result = mysql_query($query);
	$str="";
	
	//$str = "<select name='cities' id='cities' class='size-150'>";
	$str="<option value='0'>-Select City-</option>";
	while($row = mysql_fetch_assoc($result)) {
		$str.="<option value=".$row['city_id'].">".$row['city_name']."</option>";
	}
	$str.= "<option value='-1'>-Other-</option>";
	
	echo $str;
?>