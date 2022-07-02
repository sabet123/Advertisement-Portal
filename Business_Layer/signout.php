<?php
	include('includes/config.php');
	
	if(isset($_SESSION['user_id'])) {
		session_destroy();
?>
	<script>
		location.replace('index.php');
	</script>
    <?php
	}
	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="../Presentation_Layer/styles/default.css" />
	<title>Sign Out</title>
</head>

<body>

</body>
</html>