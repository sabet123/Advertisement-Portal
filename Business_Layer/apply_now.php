<?php
	include('includes/config.php');
?>

<?php
	if($_REQUEST['check_submit']) {
		$job_id = $_REQUEST['job_id'];
		$user_id = $_SESSION['user_id'];

		//this code is written for the purpose to find the email address of the user who posted the job.
		$query_find_email = "select u.user_id,u.email_address,j.job_id,j.user_id,j.job_title from users as u, jobs as j where"
			. " u.user_id = j.user_id and j.job_id='$job_id'";
		$result_find_email = mysql_query($query_find_email) or die(mysql_error());
		$row_find_email = mysql_fetch_assoc($result_find_email);

		$to = $row_find_email['email_address'];
		$job_title = $row_find_email['job_title'];

		//this code is for to find the email address of the current user who wants to apply for a job.
		$query_user_email = "select * from users where user_id='$user_id'";
		$result_user_email = mysql_query($query_user_email) or die(mysql_error());
		$row_user_email = mysql_fetch_assoc($result_user_email);

		$sender_email = $row_user_email['email_address'];
		
		//$user_name = ucwords(strtolower($_POST['user_name']));

		//$user_email = $_POST['user_email'];
		//$job_title = $_POST['job_title'];
		//$user_resume = $_FILES['user_resume']['tmp_name'];
    	//$filename = $_FILES['user_resume']['name'];
		$user_resume = $_FILES['cv']['tmp_name'];
    	$filename = $_FILES['cv']['name'];

		//define the subject of the email
		$subject = "Job Application For $job_title";
	
		$message = "Application for the post of $job_title.";
	
		//*** Uniqid Session ***//
		$strSid = md5(uniqid(time()));
		$strHeader = "From:'$sender_email'";

		$strHeader .= "MIME-Version: 1.0\n";  
		$strHeader .= "Content-Type: multipart/mixed; boundary=\"".$strSid."\"\n\n";  
		$strHeader .= "This is a multi-part message in MIME format.\n";  
		  
		$strHeader .= "--".$strSid."\n";  
		$strHeader .= "Content-type: text/html; charset=utf-8\n";  
		$strHeader .= "Content-Transfer-Encoding: 7bit\n\n";  
		$strHeader .= $message."\n\n";

		//*** Attachment ***//  

		$strFilesName = $_FILES['cv']['name'];  
		$strContent = chunk_split(base64_encode(file_get_contents($_FILES['cv']['tmp_name'])));  
		$strHeader .= "--".$strSid."\n";
		$strHeader .= "Content-Type: application/octet-stream; name=\"".$strFilesName."\"\n";  
		$strHeader .= "Content-Transfer-Encoding: base64\n";  
		$strHeader .= "Content-Disposition: attachment; filename=\"".$strFilesName."\"\n\n";  
		$strHeader .= $strContent."\n\n";

		$mail_sent = @mail($to, $subject, $message, $strHeader);

		if($mail_sent)
		{
			?>
			<script>
				alert('Your message has been sent successfully.');
			</script>
			<?php
		}
		
		else
		{
			?>
			<script>
				alert('Your message has not been sent successfully.');
			</script>
			<?php
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Apply Now</title>
    <link rel="stylesheet" href="../Presentation_Layer/styles/default.css" />
    <script src="../Presentation_Layer/js/functions.js"></script>
</head>

<body>
	<?php
		include("includes/header.php");
	?>

    <div style="width:1000px; margin:auto;">
    	<form id="apply_now_form" name="apply_now_form" method="post" enctype="multipart/form-data">
            <div class="width-100percent;" style="min-height:500px;">
            	<div style="margin-left:65px; margin-top:50px; height:200px;width:400px; border:1px solid black;">
                	<table cellspacing="30">
                	<tr>
                    	<td>Upload CV</td>
                        <td><input type="file" id="cv" name="cv" value="" /></td>
                    </tr>
                    
                    <tr>
                    	<td>&nbsp;</td>
                        <td>
                        	<input type="hidden" id="check_submit" name="check_submit" value="check_submit" />
                            <input type="button" id="submit_form" value="Submit" name="submit_form" 
                            	onclick="javascript: if(validate()) {post_form('apply_now_form');}" />
                        
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
	function validate() {
		var status = false;
		
		if(document.getElementById('cv').value != '') {
			status = true;
			//alert('true');
		} else {
			alert('Please select a file');
		}
		
		return status;
	}
</script>
</html>