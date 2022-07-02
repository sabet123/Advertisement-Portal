<?php
	error_reporting(0);
	include("includes/config.php");

	if($_REQUEST['check_submit']) {
		$email = $_REQUEST['email'];
		
		$query_verify_email = "select * from users where email_address like('$email')";
		$result_verify_email = mysql_query($query_verify_email)  or die (mysql_error());
		$records_count = mysql_num_rows($result_verify_email);
		
		if($records_count == 1) {
			$row = mysql_fetch_assoc($result_verify_email);
			$user_id = $row['user_id'];
			$query_change_password = "update users set password='81dc9bdb52d04dc20036dbd8313ed055' where user_id='$user_id'";
			$row_count2 = mysql_query($query_change_password) or die (mysql_error());
			
			if($row_count2 == 1) {
				// message lines should not exceed 70 characters (PHP rule), so wrap it
				$message = "Your password has been successfully changed. Your new password is 1234. You can change it later on.";
				$message = wordwrap($message, 70);
				$subject = "Forget password request.";
				$from = "babukhan@hotmail.com";
				// send mail
				mail($email,$subject,$message,"From: $from\n");
				?>
				<script>
					
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
    <title>Forget Password</title>
    <link rel="stylesheet" href="styles/default.css" />
    <script src="js/functions.js"></script>
</head>

<body>
	<form id="forget_password_form" name="forget_password_form" method="post" enctype="multipart/form-data">
	<?php
		include("includes/header.php");
	?>
     <div class="width-100percent">
    	<div style="min-height:300px;width:1000px;margin:0 auto;">
        	<div style="margin-left:65px;margin-right:65px;">
            	<table style="margin:100px;">
                	<tr>
                    	<td>Your Email:</td>
                        <td>
                        	<input type="text" id="email" name="email" style="width:200px;height:22px;" value="" />
                        </td>
                        <td>
                        	<input type="hidden" name="check_submit" id="check_submit" value="submit"/> 
		  					<input id="submit_form" name="submit_form" type="button" class="button-style" value="Submit" 
                            	style="height:40px;width:145px; font-size:18px;" 
            					onclick="javascript: if(validate()) {post_form('forget_password_form');}" />
                        </td>
                    </tr>

                </table>
            </div>
        </div>
     </div>
    <?php
		include("includes/footer.php");
	?>
</form>
</body>

<script>
	function validate() {
		var status = false;

		var pattern=/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
    	var email_address = document.getElementById('email').value;
		
		if(document.getElementById('email').value != '') {
			if(pattern.test(email_address)){
				status = true;
			} else {
				alert("Please enter a proper email address.");	
			}
		} else {
			alert('Please enter an email address...');
		}
		return status;
	}
</script>

</html>