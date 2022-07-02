<?php
	include("includes/config.php");
	//echo $_SESSION['user_id'];

	if($_REQUEST['check_submit']) {
		$first_name = $_REQUEST['first_name'];
		$last_name =  $_REQUEST['last_name'];
		$email = $_REQUEST['email'];
		$registration_date = date("Y-m-d");

		$user_password = $_REQUEST['user_password'];
		$confirm_password = $_REQUEST['confirm_password'];
		$encrypted_password = md5($user_password);

		if ($first_name != "" && $last_name != "" && $email != "" && $user_password != "" &&  
			$confirm_password != "" && $user_password == $confirm_password) {

			$query_existing = "select count(*) as existing_users from users where 
			email_address='$email'";
			$result_existing = mysql_query($query_existing) or die (mysql_error());
			$row_existing = mysql_fetch_assoc($result_existing);

			$number_of_records = $row_existing['existing_users'];
			if($number_of_records == 0) {
				$query_id = "select count(*) as new_id from users";
				$result_id = mysql_query($query_id) or die (mysql_error());
				$row_id = mysql_fetch_assoc($result_id);

				$id = $row_id['new_id'];
				$id = $id + 1;
				$query = "insert into users(user_id,first_name,last_name,email_address, password,
					registration_date) values('$id', '$first_name', '$last_name', '$email', 
					'$encrypted_password', '$registration_date')";
					$rows_affected = mysql_query($query) or die (mysql_error());
					if($rows_affected == 1) {
						?>
						<script language="javascript">
							location.replace("user_created.php")
						</script>
                <?php
					}
			} else {
				?>
				<script language="javascript">
				alert("User account already exists.");
				</script>
            <?php	
			}
		} else {		
		}
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Join Us</title>
    <link rel="stylesheet" href="styles/default.css" />
    <script language="javascript" type="text/javascript" src="../Presentation_Layer/js/populate_combo_boxes.js"></script>
    <script src="../Presentation_Layer/js/jquery1.11.0"></script>
    <script src="../Presentation_Layer/js/functions.js"></script>
</head>

<body>
	<form method="post" id="add_user" name="add_user" enctype="multipart/form-data">
	<?php
        include("includes/header.php");
    ?>
    <div class="width-100percent">
        <div style="min-height:520px;width:1000px;margin:0 auto;">
        	<div style="margin-left:195px;">
            	<br /><br /><br />
                <?php
					$query_country = "select * from countries order by country_id";
					$result_country = mysql_query($query_country) or die(mysql_error());
					
					$query_business = "select * from business_types order by business_type_id";
					$result_business = mysql_query($query_business) or die(mysql_error());
				?>
            	<table cellspacing="10px;">
            	<tr>
                	<td>First Name</td>
                    <td><input id="first_name" name="first_name" type="text" class="size-210" value="" /></td>
                </tr>
                
                <tr>
                	<td>Last Name</td>
                    <td><input id="last_name" name="last_name" type="text" class="size-210" /></td>
                </tr>
                
                <tr>
                	<td>Email</td>
                    <td><input id="email" name="email" type="text" class="size-210" /></td>
				</tr>
                
                <tr>
                	<td>Password</td>
                    <td><input id="user_password" name="user_password" type="password" class="size-210" /></td>
                </tr>
                
                <tr>
                	<td>Confirm Password</td>
                    <td><input id="confirm_password" name="confirm_password" type="password" class="size-210" /></td>
                </tr>
                <tr>
                	<td>&nbsp;</td>
                    <td><input type="checkbox" id="terms_conditions" name="terms_conditions" style="margin-left:10px;" />
            <span>
            	<a href="terms_and_conditions.php" target="_blank" style="color:blue;text-decoration:none;font-size:14px;">
                	I accept the terms and conditions?
                </a>
            </span></td>
                </tr>
            </table>

            <br />
            
            <input type="hidden" name="check_submit" id="check_submit" value="submit" /> 
		  	<input id="submit_form" name="submit_form" type="button" class="button-style" value="Register" style="height:40px;width:145px; margin-left:160px; font-size:18px;" 
            onclick="javascript: if(validate()) {post_form('add_user');}" />
            
            <br />
            </div>
        </div>
    </div>
    <?php
        include("includes/footer.php");
    ?>
    </form>
</body>

<script>
	$(document).ready(function () {
		
		/*	
			to display some hints data in text boxes.
			.addClass("gray-color") is used to lighten the color
			of text in the text boxes.
		*/
		$("#first_name").attr("value", "First Name").addClass("gray-color");
		$("#last_name").attr("value", "Last Name").addClass("gray-color");
		$("#email").attr("value", "Email").addClass("gray-color");
		$("#user_password").attr("value", "Password").addClass("gray-color");
		$("#confirm_password").attr("value", "Re-Type Password").addClass("gray-color");
		
		$("#user_password").removeAttr("type","password").attr("type","text");
		$("#confirm_password").removeAttr("type","password").attr("type","text");
		//this code adds the effects on focus and on blur.
		//for first name
		$("#first_name").focus(function() {
			if($(this).val() == "First Name") {
				$(this).val("");
				$(this).removeClass("gray-color");
			}
		}).blur(function() {
			if($(this).val() == "") {
				$(this).val("First Name");
				$(this).addClass("gray-color");
			}
		});
		
		//for last name
		$("#last_name").focus(function() {
			if($(this).val() == "Last Name") {
				$(this).val("");
				$(this).removeClass("gray-color");
			}
		}).blur(function() {
			if($(this).val() == "") {
				$(this).val("Last Name");
				$(this).addClass("gray-color");
			}
		});
		
		//for email
		$("#email").focus(function() {
			if($(this).val() == "Email") {
				$(this).val("");
				$(this).removeClass("gray-color");
			}
		}).blur(function() {
			if($(this).val() == "") {
				$(this).val("Email");
				$(this).addClass("gray-color");
			}
		});
		
		//for password
		$("#user_password").focus(function() {
			$(this).attr("type","password");
			if($(this).val() == "Password") {
				$(this).val("");
				$(this).removeClass("gray-color");
			}
		}).blur(function() {
			if($(this).val() == "") {
				$(this).removeAttr("type","password").attr("type","text");
				$(this).val("Password");
				$(this).addClass("gray-color");
			}
		});
		
		//for re-type password
		$("#confirm_password").focus(function() {
			$(this).attr("type","password");
			if($(this).val() == "Re-Type Password") {
				$(this).val("");
				$(this).removeClass("gray-color");
			}
		}).blur(function() {
			if($(this).val() == "") {
				$(this).removeAttr("type","password").attr("type","text");
				$(this).val("Re-Type Password");
				$(this).addClass("gray-color");
			}
		});
		
	});


	function validate() {
		var status = false;
    	
		var pattern=/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
    	var email_address = document.getElementById('email').value;
		
		if(document.getElementById('first_name').value != '' && 
		document.getElementById('last_name').value != '' && 
		document.getElementById('email').value != '' && 																										
		document.getElementById('user_password').value != '' && 
		document.getElementById('confirm_password').value != '' &&
		document.getElementById('user_password').value == 
		document.getElementById('confirm_password').value) {
			if(document.getElementById('terms_conditions').checked == true) {
				status = true;
				//alert(pattern.match(email_address));
				
				if(pattern.test(email_address)){
					status = true;
					//alert("valid.");
    			} else {
					status = false;
					alert("Please enter a proper email address.");	
				}
			} else {
				alert('Please accept the terms and conditions of this website.');	
			}
		} else {
			alert('Please Fill All Fields Properly...');
		}
		return status;
	}
</script>

</html>