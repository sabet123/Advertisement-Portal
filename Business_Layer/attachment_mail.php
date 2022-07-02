<?php
	$user_name = ucwords(strtolower($_POST['user_name']));
	$user_email = $_POST['user_email'];
	$job_title = $_POST['job_title'];
	$user_resume = $_FILES['user_resume']['tmp_name'];
    $filename = $_FILES['user_resume']['name'];
	$to = 'jobs@thebordernews.com';
//define the subject of the email
$subject = "Job Application For $job_title";

$message = "$user_name applied for the post of $job_title.";

	//*** Uniqid Session ***//  
$strSid = md5(uniqid(time()));  
  
$strHeader = "";  

  
$strHeader .= "MIME-Version: 1.0\n";  
$strHeader .= "Content-Type: multipart/mixed; boundary=\"".$strSid."\"\n\n";  
$strHeader .= "This is a multi-part message in MIME format.\n";  
  
$strHeader .= "--".$strSid."\n";  
$strHeader .= "Content-type: text/html; charset=utf-8\n";  
$strHeader .= "Content-Transfer-Encoding: 7bit\n\n";  
$strHeader .= $message."\n\n";  
  
//*** Attachment ***//  
 
$strFilesName = $_FILES['user_resume']['name'];  
$strContent = chunk_split(base64_encode(file_get_contents($_FILES['user_resume']['tmp_name'])));  
$strHeader .= "--".$strSid."\n";  
$strHeader .= "Content-Type: application/octet-stream; name=\"".$strFilesName."\"\n";  
$strHeader .= "Content-Transfer-Encoding: base64\n";  
$strHeader .= "Content-Disposition: attachment; filename=\"".$strFilesName."\"\n\n";  
$strHeader .= $strContent."\n\n";  

   $mail_sent = @mail($to, $subject, $message, $strHeader);

if($mail_sent)
{
	//Your code
}

else
{
	//Your code
}

?>