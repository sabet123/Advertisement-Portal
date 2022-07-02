<?php
	include("includes/config.php");
	//echo $_SESSION['user_id'];
?>

<?php
	if($_REQUEST['check_submit']) {
		$from = $_REQUEST['from']; // sender
    	$subject = $_REQUEST['subject'];
    	$message = $_REQUEST['feed_back'];
    	// message lines should not exceed 70 characters (PHP rule), so wrap it
    	$message = wordwrap($message, 70);
    	// send mail
    mail("babukhanpk@gmail.com",$subject,$message,"From: $from\n");
	echo "thanks";
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Feed Back</title>
    <link rel="stylesheet" href="../Presentation_Layer/styles/default.css" />
    <script src="../Presentation_Layer/js/functions.js"></script>
</head>

<body>
	<form id="feed_back_form" name="feed_back_form" method="post" enctype="multipart/form-data">
	<?php
        include("includes/header.php");
    ?>
    <div class="width-100percent">
    	<div style="min-height:350px;width:1000px;margin:0 auto;">
        	<div style="margin-left:65px;margin-right:65px;">
            	<p>
                	Your suggessions and ideas will be highly wellcomed and appreciated. We can 
                    not respond directly to your feed back but will try our level best to improve 
                    our website accordingly.
                </p>
            	<h3>Your Feed Back</h3>
                <table cellspacing="5px">
                	<tr>
                    	<td>From&nbsp;&nbsp;:</td>
                        <td><input type="text" id="from" name="from" value="" style="width:342px; height:25px;" /></td>
                    </tr>
                    
                    <tr>
                    	<td>Subject&nbsp;&nbsp;:</td>
                        <td><input type="text" id="subject" name="subject" value="" style="width:342px; height:25px;" /></td>
                    </tr>
                </table>

                <textarea rows="10" cols="50" id="feed_back" name="feed_back"></textarea>                
                <br />
                <br />

                <input type="hidden" name="check_submit" id="check_submit" value="submit"/> 
		  		<input id="submit_form" name="submit_form" type="button" class="button-style" value="Submit" style="height:40px;
                	width:145px; font-size:18px;" 
            onclick="javascript: if(validate()) {post_form('feed_back_form');}" />
            <br />
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
	function validate() {
		var status = false;

		if(document.getElementById('from').value != '' && document.getElementById('subject').value != '' && 
					document.getElementById('feed_back').value != '') {
			status = true;
		} else {
			alert('Please fill all fields properly...');
		}
		return status;
	}
</script>
</html>