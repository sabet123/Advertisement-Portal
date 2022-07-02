<?php
	include("includes/config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>User information</title>
    <link rel="stylesheet" href="../Presentation_Layer/styles/default.css" />
    
</head>

<body>
	<form method="post" id="user_created" >
	<?php
        include("includes/header.php");
    ?>
    <div class="width-100percent">
        <div style="min-height:450px;width:1000px;margin:0 auto;">
        	<div style="margin-left:100px;">
            	<p style="color:#03F;font-size:18px; margin-top:60px;">
                	Congratulations!. Your account has been successfully created.
                </p>
            </div>
        </div>
    </div>
    <?php
        include("includes/footer.php");
    ?>
    </form>
</body>
</html>