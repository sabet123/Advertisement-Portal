<?php
	include("includes/config.php");
	
	if($_REQUEST['check_submit_login']) {
		$login_email = $_REQUEST['login_email'];
		$password = md5($_REQUEST['login_password']);

		$query_login = "select * from users where email_address='$login_email' and password='$password'";
		$result_login = mysql_query($query_login) or die (mysql_error());
		$num_rows = mysql_num_rows($result_login);

		if($num_rows == 1) {
			$row_login = mysql_fetch_assoc($result_login);
			$_SESSION['user_full_name'] = $row_login['first_name'] . " " . $row_login['last_name'];
			$_SESSION['user_id'] = $row_login['user_id'];
			?>
            <script>
				location.replace('index_main.php');
			</script>
            <?php
		}
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Directory Pages</title>
    <link rel="stylesheet" href="../Presentation_Layer/styles/default.css" />
    <script src="../Presentation_Layer/js/functions.js" ></script>
    <script src="../Presentation_Layer/js/jquery1.11.0"></script>
</head>

<body>
    
    <?php
		include("includes/header.php");
	?>

    <div style="width:1000px; margin:auto;">
    	<!-- this is the sign in code-->
    <form id="login_form" name="login_form" method="post" enctype="multipart/form-data">
    	
        <div id="login_area" class="width-100percent" style="min-height:500px;">
            <div class="login-area box_shadow">
            	<br />
                <img src="../Presentation_Layer/images/login.png" style="height:150px; width:300px; margin-left:48px;" />
                <table cellspacing="10px">
                    
                    <tr>
                        <td>Email</td>
                        <td><input type="text" id="login_email" name="login_email" value="" class="size-210" /></td>
                    </tr>
                    
                    <tr>
                        
                        <td>Password</td>
                        <td><input type="password" id="login_password" name="login_password" class="size-210" /></td>
                    </tr>
                    
                    <tr>
                    	<td>&nbsp;</td>
                    	<td>
                        	<input type="hidden" id="check_submit_login" name="check_submit_login" value="check_submit_login" />
                            <input type="button" value="Sign In" id="sign_in" name="sign_in" class="button-style" style="height:40px;	
                        		width:100px;" onClick="javascript: if(validate_login()) {post_form('login_form');}" />
                        </td>
                    </tr>

                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            <a href="forget_password.php" style="color:blue; text-decoration:none;
                                font-size:14px;" target="_blank">Forget Password?
                            </a>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="join_us.php" style="color:blue; text-decoration:none;
                                font-size:14px;" target="_blank">Sign Up Now
                            </a>
                        </td>
                        
                    </tr>
                </table>
                
            </div>
        </div>
        
        </form>
       </div>

<?php
	include("includes/footer.php");
?>

</body>

<script>
	function validate_login() {
		var status = false;
		var pattern=/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
    	var email_address = document.getElementById('login_email').value;
		
		if(document.getElementById('login_email').value != '' && document.getElementById('login_password').value != '') {
			if(pattern.test(email_address)){
				status = true;
			} else {
				status = false;
				alert("Please enter a proper email address.");	
			}
		} else {
			alert('Please fill all fields properly');	
		}
		return status;
	}
	
</script>
</html>