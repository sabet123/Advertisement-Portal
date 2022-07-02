<?php
	include('includes/config.php');
?>

<?php
	$company_id = $_REQUEST['company_id'];
	$user_id = $_SESSION['user_id'];
	
	$query = "select * from countries as c, cities as ct, business_types as bt, companies as cmp where"
		. " c.country_id=ct.country_id and ct.city_id = cmp.city_id and bt.business_type_id"
		. " = cmp.business_type_id and cmp.user_id='$user_id' and cmp.company_id='$company_id'";
	$result = mysql_query($query) or die(mysql_error());
	
	$row = mysql_fetch_assoc($result);
	
	$country_id = $row['country_id'];
	$city_id = $row['city_id'];
	$business_type_id = $row['business_type_id'];
	
	$company_name = $row['company_name'];
	$address = $row['address'];
	$company_url = $row['company_url'];
	$phone_number = $row['phone_number'];
	$fax_number = $row['fax_number'];
	$description = $row['description'];
	
	if($_REQUEST['check_submit']) {
		$company_edited = 0;
		
		$company_id = $_REQUEST['company_id'];
		$user_id = $_SESSION['user_id'];
	
		$city_id_to_update = $_REQUEST['cities'];
		$business_type_id = $_REQUEST['business_type'];
		$company_name = $_REQUEST['company_name'];
		$address = $_REQUEST['company_address'];

		$url = $_REQUEST['company_url'];
		$phone_number = $_REQUEST['phone_number'];
		$fax = $_REQUEST['fax'];
		$description = $_REQUEST['description'];
		
		$query_update = "update companies set city_id='$city_id_to_update', business_type_id='$business_type_id',"
		. " company_name='$company_name',address='$address',company_url='$url',phone_number='$phone_number',"
		. " fax_number='$fax',description='$description' where company_id='$company_id' and user_id='$user_id'";
		//echo $query_update;
		$company_edited = mysql_query($query_update) or die(mysql_error());
		if($company_edited == 1) {
		?>
        <script>
			alert('Company has been updated.');
			location.replace('companies.php');
		</script>
        <?php
		}
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Edit Company</title>
    <link rel="stylesheet" href="../Presentation_Layer/styles/default.css" />
	<script language="javascript" type="text/javascript" src="../Presentation_Layer/js/populate_combo_boxes.js"></script>
    <script src="../Presentation_Layer/js/functions.js" ></script>
</head>

<body>
<?php
		include("includes/header.php");
	?>

    <div style="width:1000px; margin:auto;">
		 <?php
                $query_country = "select * from countries order by country_id";
                $result_country = mysql_query($query_country) or die(mysql_error());
				
				$query_business_types = "select * from business_types order by business_type_id";
				$result_business_types = mysql_query($query_business_types) or die(mysql_error());
            ?>
    <form id="edit_company_form" name="edit_company_form" method="post" enctype="multipart/form-data">
    	
        <div style="margin-left:65px;">
        <h1>Edit company Form</h1>
        <br /><br />
        	<table width="418" cellspacing="5px;">
            	<tr>
                        <td width="186">Country</td>
                        <td width="220">
                            <select id="country" name="country" style="height:32px;width:256px;" 
                            	onChange="getListOfCities(this.value);">
                                <option value="">-Select Country-</option>
                                <?php
									while($row_country = mysql_fetch_assoc($result_country)) {
								?>
                                <option value="<?php echo $row_country['country_id'];
											?>" <?php if($row_country['country_id'] == $country_id) echo 'selected='."selected"; ?>>
								<?php echo $row_country['country_name']; ?></option>
                                <?php
									}
								?>
                            </select>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>City</td>
                        <td>
                            <select id="cities" name="cities" style="height:32px;width:256px;">
                                <option value="">-Select City-</option>
                                <?php
									$query_cities = "select * from cities where country_id='$country_id'";
									$result_cities = mysql_query($query_cities) or die(mysql_error());
									
									while($row_cities = mysql_fetch_assoc($result_cities)) {
								?>
                                <option value="<?php echo $row_cities['city_id']; ?>" <?php if($row_cities['city_id'] == $city_id) echo 'selected='."selected"; ?>>
									<?php echo $row_cities['city_name']; ?>
                                </option>
                                <?php
									}
								?>
                            </select>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>Business Type</td>
                        <td>
                            <select id="business_type" name="business_type" style="height:32px;width:256px;">
                                <option value="">-Select-</option>
                                <?php
									while($row_business = mysql_fetch_assoc($result_business_types)) {
								?>
                                <option value="<?php echo $row_business['business_type_id']; ?>" 
									<?php if($row_business['business_type_id'] == $business_type_id) echo 'selected='."selected";?>>
									<?php echo $row_business['business_name'];?></option>
                                <?php	
									}
								?>
                            </select>
                        </td>
                    </tr>
                    <tr id="new_business">
                    
                    </tr>
                    
                    <tr>
                        <td>Company Name</td>
                        <td>
                            <input type="text" id="company_name" name="company_name" class="size-210" 
                            	value="<?php echo $company_name; ?>" />
                        </td>
                    </tr>
                    
                    <tr>
                        <td>Address</td>
                        <td>
                          <input type="text" id="company_address" name="company_address" class="size-210"
                          	value="<?php echo $address; ?>" />
                        </td>
                    </tr>
                    
                    <tr>
                        <td>URL</td>
                        <td><input id="company_url" name="company_url" type="text" class="size-210"
                        	value="<?php echo $company_url; ?>" /></td>
                    </tr>
                    
                    <tr>
                        <td>Phone Number</td>
                        <td><input type="text" id="phone_number" name="phone_number" class="size-210"
                        	value="<?php echo $phone_number; ?>" /></td>
                    </tr>
                    
                    <tr>
                        <td>FAX</td>
                        <td><input type="text" id="fax" name="fax" class="size-210"
                        	value="<?php echo $fax_number; ?>" /></td>
                    </tr>
                    
                    <tr>
                        <td>Company Description</td>
                        <td><input type="text" id="description" name="description" class="size-210"
                        	value="<?php echo $description; ?>" /></td>
                    </tr>
                    
                    <tr>
                        <td>&nbsp;</td><td>&nbsp;</td>
                    </tr>
                    
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                        	<input type="hidden" id="check_submit" name="check_submit" value="check_submit" />
                            <input type="button" value="Update" id="update" name="update" class="button-style" style="height:30px			
                            ;width:90px;" onClick="javascript: if(validate()) {post_form('edit_company_form');}" />
                            	&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="button" id="back" name="back" value="Back" class="button-style" style="height:30px			
                            ;width:90px;" onClick="goBack();" />
                        </td>
                    </tr>
            </table>
        </div>
        <br /><br />
        </form>   
        </div>

    </div>

 
<?php
	include("includes/footer.php");
?>
</body>

<script>
	
	function validate() {
		var status = false;

		
		var country_id = document.getElementById('country').value;
		var city_id = document.getElementById('cities').value;
		var business_type_id = document.getElementById('business_type').value;
		var company_name = document.getElementById('company_name').value;
		
		var address = document.getElementById('company_address').value;
		var company_url = document.getElementById('company_url').value;
		var phone_number = document.getElementById('phone_number').value;
		var fax = document.getElementById('fax').value;
		var description = document.getElementById('description').value;
		
		if(city_id != '' && company_name != '' && address != '' && company_url != '' && phone_number != '' && fax != '' &&
		   description != '' && business_type_id != '') {
			if(business_type_id == -1) {
				var new_business_type = document.getElementById('new_business_type').value;
				if(new_business_type != '') {
					status = true;
				}
			} else {
				status = true;
			}
		}
		
		if(status == false) {
			alert('Please fill all fields properly.');
		}
		return status;
	}
	
	function goBack() {
		location.replace('companies.php');
	}
</script>
</html>