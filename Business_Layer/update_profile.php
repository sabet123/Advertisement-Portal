<?php
	include("includes/config.php");

	$user_id = $_SESSION['user_id'];

	$query_find_user_detail = "select * from users where user_id='$user_id'";
	$result_find_user_detail = mysql_query($query_find_user_detail) or die(mysql_error());
	$row_find_user_detail = mysql_fetch_assoc($result_find_user_detail);

	//print_r($row_find_user_detail);
	$first_name = $row_find_user_detail['first_name'];
	$last_name = $row_find_user_detail['last_name'];
	$email = $row_find_user_detail['email_address'];
?>

<?php
	if($_REQUEST['check_submit']) {
		$user_updated = 0;
		
		$new_first_name = $_REQUEST['first_name'];
		$new_last_name = $_REQUEST['last_name'];
		$new_email_address = $_REQUEST['email'];
		$new_password = $_REQUEST['user_password'];
		$new_confirm_password = $_REQUEST['confirm_password'];
		
		$new_encrypted_password = md5($new_password);

		if($new_first_name != '' && $new_last_name != '' && $new_email_address != '' && $new_password != ''
		   && $new_confirm_password != '' && $new_password == $new_confirm_password) {
			$query_update = "update users set first_name='$new_first_name', last_name='$new_last_name',email_address="
			. "'$new_email_address', password='$new_encrypted_password' where user_id = '$user_id'";
			//echo $query_update;
			$user_update = mysql_query($query_update) or die(mysql_error());
			if($user_update == 1) {
				session_destroy();
			?>
            <script>
				alert('User Updated. Now you will be redirected to the Sign In page.');
				location.replace('index.php');
			</script>
            <?php
			}
			
		}
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Update Profile</title>
    <link rel="stylesheet" href="../Presentation_Layer/styles/default.css" />
    <script language="javascript" type="text/javascript" src="../Presentation_Layer/js/populate_combo_boxes.js"></script>
    <script src="../Presentation_Layer/js/jquery1.11.0"></script>
    <script src="../Presentation_Layer/js/functions.js"></script>
</head>

<body>
	<form method="post" id="update_user_form" name="update_user_form" enctype="multipart/form-data">
	<?php
        include("includes/header.php");
    ?>
    <div class="width-100percent">
        <div style="min-height:520px;width:1000px;margin:0 auto;">
        	<div style="margin-left:195px;">
            	<br /><br /><br />

                <h1>Update Profile Form</h1>
                <br /><br />
            	<table cellspacing="10px;">
            	<tr>
                	<td>First Name</td>
                    <td><input id="first_name" name="first_name" type="text" class="size-210" 
                    	value="<?php echo $first_name; ?>" /></td>
                </tr>
                
                <tr>
                	<td>Last Name</td>
                    <td><input id="last_name" name="last_name" type="text" class="size-210"
                    	value="<?php echo $last_name; ?>" /></td>
                </tr>
                
                <tr>
                	<td>Email</td>
                    <td><input id="email" name="email" type="text" class="size-210"
                    	value="<?php echo $email; ?>" /></td>
				</tr>
                
                <tr>
                	<td>Password</td>
                    <td><input id="user_password" name="user_password" type="password" class="size-210" /></td>
                </tr>
                
                <tr>
                	<td>Confirm Password</td>
                    <td><input id="confirm_password" name="confirm_password" type="password" class="size-210" /></td>
                </tr>
                
            </table>

            <br />
            
            <input type="hidden" name="check_submit" id="check_submit" value="submit" /> 
		  	<input id="submit_form" name="submit_form" type="button" class="button-style" value="Update User" 
            	style="height:40px;width:145px; margin-left:160px; font-size:18px;" 
            onclick="javascript: if(validate()) {post_form('update_user_form');}" />
            
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
			if(pattern.test(email_address)){
				status = true;
				//alert("valid.");
			} else {
				status = false;
				alert("Please enter a proper email address.");	
			}
			
		} else {
			alert('Please Fill All Fields Properly...');
		}
		return status;
	}
</script>

</html>