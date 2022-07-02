<?php
	include('includes/config.php');
	
	$company_id = $_REQUEST['company_id'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>View Company Details</title>
     <link rel="stylesheet" href="../Presentation_Layer/styles/default.css" />
</head>

<body>
<?php
	include('includes/header.php');
?>
<div style="width:1000px; margin:auto;">
	    <div class="width-100percent;" style="min-height:500px;">
			<?php
				$query = "select * from countries as c, cities as ct, business_types as bt, companies as cmp where c.country_id="
					. " ct.country_id and ct.city_id = cmp.city_id and bt.business_type_id= cmp.business_type_id"
					. " and cmp.company_id='$company_id'";
				$result = mysql_query($query) or die(mysql_error());
				$row = mysql_fetch_assoc($result);
			?>
             <table style="margin-left:65px; margin-top:50px;" cellspacing="20px" cellpadding="5px" bgcolor="#EEEEEE">
             	<tr>
                	<td>Country</td>
                    <td><?php echo $row['country_name']; ?></td>
                </tr>
                
                <tr>
                	<td>City</td>
                    <td><?php echo $row['city_name']; ?></td>    
                </tr>
                
                <tr>
                	<td>Business Type</td>
                    <td><?php echo $row['business_name']; ?></td>
                </tr>
                
                <tr>
                	<td>Company Name</td>
                    <td><?php echo $row['company_name']; ?></td>
                </tr>

                <tr>
                	<td>Address</td>
                    <td><?php echo $row['address']; ?></td>
                </tr>

                <tr>
                	<td>URL</td>
                    <td><?php echo $row['company_url']; ?></td>
                </tr>

                <tr>
                	<td>Phone Number</td>
                    <td><?php echo $row['phone_number']; ?></td>
                </tr>

                <tr>
                	<td>Fax</td>
                    <td><?php echo $row['fax_number']; ?></td>
                </tr>
                
                <tr>
                	<td>Description</td>
                    <td><?php echo $row['description']; ?></td>
                </tr>

             </table>
            <div class="button-style"  style="vertical-align:middle;width:145px;margin-left:170px;margin-top:50px; height:40px;">
                <input type="button" value="Back" id="back" name="back"  class="button-style" style="height:40px;width:145px;" 
                	onclick="goBack();" />
            </div>
            	<br />
                <br />
         </div>

    </div>
   
<?php
	include("includes/footer.php");
?>

</body>

<script>
	function goBack() {
		location.replace('companies.php');
	}
</script>
</html>