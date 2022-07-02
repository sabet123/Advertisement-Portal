<?php
	include("includes/config.php");
?>

<?php
	if($_REQUEST['check_submit_search']) {
		$city_id = $_REQUEST['cities'];
		$business_type_id = $_REQUEST['business_type'];
		$search_by = $_REQUEST['search_by'];
		$search_by_value = $_REQUEST['search_by_value'];
		
		if($search_by == 1) { // 1 stands for searching by company name.
			$query = "select * from countries as c, cities as ct, companies as com,business_types as bt where"
				. " c.country_id=ct.country_id and ct.city_id=com.city_id and com.business_type_id=bt.business_type_id"
				. " and com.company_name like('$search_by_value')";
				
		} else if($search_by == 2) { // 2 stands for searching by address.
			$query = "select * from countries as c, cities as ct, companies as com,business_types as bt where"
				. " c.country_id=ct.country_id and ct.city_id=com.city_id and com.business_type_id=bt.business_type_id"
				. " and com.address like('$search_by_value')";
				
		} else if($search_by == 3) { // 3 stands for searching by phone number.
			$query = "select * from countries as c, cities as ct, companies as com,business_types as bt where"
				. " c.country_id=ct.country_id and ct.city_id=com.city_id and com.business_type_id=bt.business_type_id"
				. " and com.phone_number like('$search_by_value')";
				
		} else if($search_by == 4) { // 4 stands for searching by business type.
			$query = "select * from countries as c, cities as ct, companies as com,business_types as bt where"
				. " c.country_id=ct.country_id and ct.city_id=com.city_id and com.business_type_id=bt.business_type_id"
				. " and com.business_type_id = '$business_type_id' and bt.business_type_id='$business_type_id'";
				
		} else if($search_by == 5) { // 5 stands for searching by country and city.
			$query = "select * from countries as c, cities as ct, companies as com,business_types as bt where"
				. " c.country_id=ct.country_id and ct.city_id=com.city_id and com.business_type_id=bt.business_type_id"
				. " and ct.city_id='$city_id'";
		}
		
		$result = mysql_query($query) or die(mysql_error());
		
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Directory Pages</title>
    <link rel="stylesheet" href="../Presentation_Layer/styles/default.css" />
    <script language="javascript" type="text/javascript" src="../Presentation_Layer/js/populate_combo_boxes.js"></script>
    <script src="../Presentation_Layer/js/functions.js" ></script>
</head>

<style>
	td {
		width:130px;
		min-height:50px;
	}

	.company-area {
		background-color:#EEEEEE;
		border-radius:8px;
		border:2px solid #57043B;
		min-height:300px;
		width:550px;
	}
</style>

<body>
    
    <?php
		include("includes/header.php");
	?>

    <div style="width:100%; margin:auto; min-height:500px;">
    <form id="search_form" name="search_form" method="post" enctype="multipart/form-data">
        <!--<div class="width-100percent">-->
    	<div style="min-height:400px;width:1000px;margin:0 auto;">
        	<div style="margin-left:65px;margin-right:65px; min-height:70px;">
				<?php
                    echo '<p style="float:right;">' . $_SESSION['user_full_name'] . '!' . '</p>';	
                ?>
            </div>
        <?php
			$query_country = "select * from countries order by country_id";
			$result_country = mysql_query($query_country) or die(mysql_error());
			
			$query_business_types = "select * from business_types order by business_type_id";
			$result_business_types = mysql_query($query_business_types) or die(mysql_error());
			
		?>
        <div style="min-height:500px; width:100%">
        	<div style="float:right; min-height:100px; width:300px; margin-right:200px;">
            	<?php
					if(mysql_num_rows($result) <= 0) { 
				?>
            	<img src="../Presentation_Layer/images/world_map2.gif" height="335px;" width="495px;" />
                <?php
					} else {
						
					}
				?>
            </div> 
            <div style="float:left; height:330px; width:400px;" class="box_shadow">
                <h3 style="text-align:center;">Search a Company</h3>
                <table style="margin-left:28px;">
                    <tr>
                        <td>Country</td>
                        <td>
                            <select id="country" name="country" style="width:200px; height:28px;" onchange="getListOfCities(this.value);">
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
                            <select id="cities" name="cities" style="width:200px; height:28px;">
                                <option value="">-Select City-</option>
                            </select>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>Business Type</td>
                        <td>
                            <select id="business_type" name="business_type" style="width:200px; height:28px;">
                                <option value="">-Select Business-</option>
                                <?php
									while($row_business = mysql_fetch_assoc($result_business_types)) {
										echo "<option value='".$row_business['business_type_id']."'>".$row_business['business_name']."</option>";
									}
								?>
                            </select>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>Search By</td>
                        <td>
                            <select id="search_by" name="search_by" style="width:200px; height:28px;">
                                <option value="">-Select-</option>
                                <option value="1">Company Name</option>
                                <option value="2">Address</option>
                                <option value="3">Phone Number</option>
                                <option value="4">Business Type</option>
                                <option value="5">Country &amp; City</option>
                            </select>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>Value</td>
                        <td>
                            <input type="text" id="search_by_value" name="search_by_value" style="width:194px; height:25px;" />
                        </td>
                    </tr>
                    
                    <tr>
                        <td>&nbsp;</td><td>&nbsp;</td>
                    </tr>
                    
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                        	<input type="hidden" id="check_submit_search" name="check_submit_search" value="check_submit_search" />
                            <input type="button" value="Search" id="search" name="search" class="button-style" style="height:45px;
                            	width:125px;" onclick="javascript: if(validate_search()) {post_form('search_form');}" />
                        </td>
                    </tr>
                </table>
            </div>
            
            <div style="float:right;margin-right:65px;">
            	<br />
            	<?php
					if(mysql_num_rows($result) > 0) {
						while($row = mysql_fetch_assoc($result)) {
						?>
                   		<div class="company-area" style="margin-left:65px;">
                			<table cellspacing="20">
                                <tr>
                                    <td>Country</td>
                                    <td><?php echo $row['country_name'];?></td>
                                </tr>
                                <tr>   
                                    <td>City</td>
                                    <td><?php echo $row['city_name'];?></td>
                                </tr>
                                <tr>    
                                    <td>Business Type</td>
                                    <td><?php echo $row['business_name'];?></td>
                                </tr>
                                <tr>    
                                    <td>Company Name</td>
                                    <td><?php echo $row['company_name'];?></td>
                                </tr>
                                <tr>    
                                    <td>Address</td>
                                    <td><?php echo $row['address']; ?></td>
                                </tr>
                                <tr>
                                    <td>Website</td>
                                    <td><?php echo $row['company_url'];?></td>
                                </tr>
                                <tr>
                                    <td>Phone Number</td>
                                    <td><?php echo $row['phone_number'];?></td>
                                </tr>
                                <tr>
                                    <td>FAX</td>
                                    <td><?php echo $row['fax_number'];?></td>
                                </tr>
                                <tr>
                                    <td>Description</td>
                                    <td><?php echo $row['description'];?></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>
                                        <a style="cursor:pointer" href="show_map.php?company_id=<?php echo $row['company_id'];?>" target="_blank">
				 							<img src="../Presentation_Layer/images/map.jpg" alt="Edit" width="70" height="60" border="0" />
                        				</a>
                                    </td>
                                </tr>
                        </table>
                        
              </div>
              <br />
                        <?php
						}
					}
				?>
                <br />
                <?php
            include("includes/footer.php");
        ?>	

            </div>
        </div>
       </form>
     </div>

</body>

<script>
	
	function validate_search() {
		return true;
	}

</script>

</html>