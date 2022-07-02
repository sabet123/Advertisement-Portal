// JavaScript Document

function getListOfCities(country_id) {
	var id = parseInt(country_id);
	if (country_id == 0 || country_id == -1) {
		return;
	  }

	//alert(country_id);
	
	if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  } else {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	  
	xmlhttp.onreadystatechange=function() {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		document.getElementById('cities').innerHTML=xmlhttp.responseText;
		}
	  }
	  
	xmlhttp.open("GET","js/ajax_cities.php?country_id=" + id,true);
	xmlhttp.send();
}