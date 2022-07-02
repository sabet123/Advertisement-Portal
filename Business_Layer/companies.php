<?php
	include("includes/config.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Companies</title>
    <link rel="stylesheet" href="../Presentation_Layer/styles/default.css" />
    <script language="javascript" type="text/javascript" src="../Presentation_Layer/js/populate_combo_boxes.js"></script>
    <script src="../Presentation_Layer/js/functions.js" ></script>
</head>

<body>
<?php
	include("includes/header.php");
?>

<form id="companies_form" name="companies_form" method="post" enctype="multipart/form-data">
<div style="width:1000px; margin:auto;">
	    <div class="width-100percent;" style="min-height:500px;">	
			<div style="margin-left:790px;margin-top:50px;margin-bottom:10px;">
                <input type="button" value="Add Company" id="add_company_button" name="add_company_button"  
                	class="button-style" style="height:40px;width:145px;" onclick="addCompany();" />
                <!--<a href="add_company.php">Add Company</a>-->
            </div>
             
             <table border="0" cellspacing="0" cellpadding="0" style="border-bottom:1px solid #e3e3e3;">
            <tr>
				<td style="background:url(../Presentation_Layer/images/rightTop.jpg) repeat-x top left;">
                	<table border="0" cellspacing="0" cellpadding="10">
					  <tr style="color:#fff;">
                        <td width="198" valign="middle"><strong>Company Name</strong></td>
                        <td width="205" valign="middle"><strong>Company URL</strong></td>
                        <td width="162" valign="middle"><strong>Phone Number</strong></td>
                        <td width="134" valign="middle"><strong>Fax</strong></td>
                        <td width="87" valign="middle"><strong>View</strong></td>
                        <td width="94" valign="middle"><strong>Edit</strong></td>
 	                 </tr>
                  <!--$row_clr='#f3f3f3';-->
                  <?php
				  		$user_id = $_SESSION['user_id'];
				  		$query = "select * from companies where user_id='$user_id' order by company_id";
						$result = mysql_query($query) or die(mysql_error());
				  ?>
                  	<?php
						$i = 1;
						while($row = mysql_fetch_assoc($result)) {
							$id = $row['company_id'];
							if($i%2 == 0) {
								$row_clr='#f3f3f3';
							} else {
								$row_clr='#ffffff';
							}
							$i = $i + 1;
					?>
					<tr>
                   
                     	<td align="left" valign="middle" bgcolor="<?php echo $row_clr; ?>"><?php echo $row['company_name']; ?></td>
						<td align="left" valign="middle" bgcolor="<?php echo $row_clr; ?>"><?php echo $row['company_url']; ?></td>
						<td align="left" valign="middle" bgcolor="<?php echo $row_clr; ?>"><?php echo $row['phone_number']; ?></td>
    	                <td align="left" valign="middle" bgcolor="<?php echo $row_clr; ?>"><?php echo $row['fax_number']; ?></td>
						<td align="left" valign="middle" bgcolor="<?php echo $row_clr; ?>">
                        	<a href="view_company.php?company_id=<?php echo $id; ?>">
                            	<img src="../Presentation_Layer/images/view.png" height="30px" width="50px"  />
                            </a>
                        </td>
                        <td align="left" valign="middle" bgcolor="<?php echo $row_clr; ?>">
                        	<a href="edit_company.php?company_id=<?php echo $id; ?>">
                            	<img src="../Presentation_Layer/images/edit.gif" height="30px" width="40px"  />
                            </a>
                        </td>
                  </tr>
                  <?php
						}
						?>
                  
                </table></td>
            </tr>
          </table>
          <br />
          <br />
          <table width="100%" border="0" cellspacing="8" cellpadding="8" style="border-radius:5px;float:right; background:url(../Presentation_Layer/images/rightTop.jpg) repeat-x top left;">
          <td>&nbsp;</td>
            </table>
                  </div>
           </div>
    
        </form>
  	<?php
		include("includes/footer.php");
	?>
</body>

<script>
	function addCompany() {
		location.replace('add_company.php');
	}
</script>
</html>