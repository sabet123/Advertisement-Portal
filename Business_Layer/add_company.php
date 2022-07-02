<?php
	include("includes/config.php");
?>

<?php

	if($_REQUEST['check_submit']) {
		
		$company_added = 0;
		$user_id = $_SESSION['user_id'];

		$city_id = $_REQUEST['cities'];
		$business_type_id = $_REQUEST['business_type'];
		$company_name = $_REQUEST['company_name'];
		$address = $_REQUEST['company_address'];

		$url = $_REQUEST['company_url'];
		$phone_number = $_REQUEST['phone_number'];
		$fax = $_REQUEST['fax'];
		$description = $_REQUEST['description'];

		$query_company_id = "select count(*) as row_count from companies;";
		$result_company_id = mysql_query($query_company_id) or die(mysql_error());
		$row_company_id = mysql_fetch_assoc($result_company_id);
		$company_id = $row_company_id['row_count'];

		$company_id = $company_id + 1;
		
		//this code will insert the data in the database if business type is selected from the combo box.
		if($business_type_id != '' && $business_type_id > -1) {
			$query = "insert into companies(company_id,user_id,city_id,business_type_id,company_name,address,company_url,phone_number,"
				."fax_number,description) values('$company_id','$user_id','$city_id','$business_type_id','$company_name','$address',"
				."'$url','$phone_number','$fax','$description')";
			$company_added = mysql_query($query) or die(mysql_error());
		} else if($business_type_id == -1) {
			$business_name = $_REQUEST['new_business_type'];
			$query_new_business_id = "select count(*) as business_count from business_types";
			$result_new_business_id = mysql_query($query_new_business_id) or die(mysql_error());
			$row_new_business_id = mysql_fetch_assoc($result_new_business_id);
			$new_business_type_id = $row_new_business_id['business_count'];
			
			$new_business_type_id = $new_business_type_id + 1;
			$query_add_business_type = "insert into business_types(business_type_id,business_name) values".	
				"('$new_business_type_id','$business_name')";

			mysql_query($query_add_business_type) or die(mysql_error());
			
			$query = "insert into companies(company_id,user_id,city_id,business_type_id,company_name,address,company_url,phone_number,"
				."fax_number,description) values('$company_id','$user_id','$city_id','$new_business_type_id',"
				."'$company_name','$address','$url','$phone_number','$fax','$description')";

			$company_added = mysql_query($query) or die(mysql_error());
		}
		
		if($company_added == 1) {
			?>
            <script>
				alert('Company Added Successfully.');
			</script>
            <?php
		}
	}
	
	
	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Add Company</title>
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
    <form id="add_company_form" name="add_company_form" method="post" enctype="multipart/form-data">
    	
        <div style="margin-left:65px;">
        <h1>Add company Form</h1>
        <br /><br />
        	<table width="418" cellspacing="5px;">
            	<tr>
                        <td width="186">Country</td>
                        <td width="220">
                            <select id="country" name="country" style="height:32px;width:256px;" onChange="getListOfCities(this.value);">
                                <option value="">-Select Country-</option>
                                <?php
									while($row_country = mysql_fetch_assoc($result_country)) {
								?>
                                <option value="<?php echo $row_country['country_id']; ?>">
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
                            </select>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>Business Type</td>
                        <td>
                            <select id="business_type" name="business_type" style="height:32px;width:256px;" onChange="checkBusinessId(this.value)">
                                <option value="">-Select-</option>
                                <?php
									while($row_business = mysql_fetch_assoc($result_business_types)) {
								?>
                                <option value="<?php echo $row_business['business_type_id']; ?>">
									<?php echo $row_business['business_name'];?></option>
                                <?php	
									}
								?>
                                <option value="-1">-Other-</option>
                            </select>
                        </td>
                    </tr>
                    <tr id="new_business">
                    
                    </tr>
                    
                    <tr>
                        <td>Company Name</td>
                        <td>
                            <input type="text" id="company_name" name="company_name" class="size-210" />
                        </td>
                    </tr>
                    
                    <tr>
                        <td>Address</td>
                        <td>
                          <input type="text" id="company_address" name="company_address" class="size-210" />
                        </td>
                    </tr>
                    
                    <tr>
                        <td>URL</td>
                        <td><input id="company_url" name="company_url" type="text" class="size-210" /></td>
                    </tr>
                    
                    <tr>
                        <td>Phone Number</td>
                        <td><input type="text" id="phone_number" name="phone_number" class="size-210" /></td>
                    </tr>
                    
                    <tr>
                        <td>FAX</td>
                        <td><input type="text" id="fax" name="fax" class="size-210" /></td>
                    </tr>
                    
                    <tr>
                        <td>Company Description</td>
                        <td><input type="text" id="description" name="description" class="size-210" /></td>
                    </tr>
                    
                    <tr>
                        <td>&nbsp;</td><td>&nbsp;</td>
                    </tr>
                    
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                        	<input type="hidden" id="check_submit" name="check_submit" value="check_submit" />
                            <input type="button" value="Register" id="Register" name="Register" class="button-style" style="height:30px			
                            ;width:90px;" onClick="javascript: if(validate()) {post_form('add_company_form');}" />
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

	function checkBusinessId(id) {
		//alert(id);
		value = '<td>New Business Type</td>';
		value = value + '<td><input type="text" id="new_business_type" name="new_business_type" value="" class="size-210" ></td>';
		if(id == -1) {
			document.getElementById('new_business').innerHTML = value;
		} else {
			document.getElementById('new_business').innerHTML = "";
		}
		
	}
	
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