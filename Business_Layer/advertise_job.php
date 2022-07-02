<?php
	include("includes/config.php");
	
	$user_id = $_SESSION['user_id'];
?>

<?php
	if($_REQUEST['check_submit']) {
		
		$job_id = 1; //in case there is no job_id in the database then we use this default value.
		$record_inserted = 0;
		
		$job_title = $_REQUEST['job_title'];
		$job_description = $_REQUEST['job_description'];
		$required_skills = $_REQUEST['required_skills'];
		$company_id = $_REQUEST['company'];
		$initial_salary = $_REQUEST['initial_salary'];
		$current_date = date('Y-m-d');

		$query_count = "select count(*) as row_count from jobs";
		$result_count = mysql_query($query_count) or die(mysql_error());
		$row_count = mysql_fetch_assoc($result_count);
		
		$jobs_count = $row_count['row_count'];
		if($jobs_count == 0) {
			$query_insert = "insert into jobs(job_id, user_id, company_id, job_title, job_description, required_skills, initial_salary, 				published_date) values('$job_id', '$user_id', '$company_id', '$job_title', '$job_description', '$required_skills', 	 																																												 				'$initial_salary','$current_date')";
			//echo "<br />this is in if<br />".$query_insert;
			$record_inserted  = mysql_query($query_insert) or die(mysql_error());
		} else {
			$query_max = "select max(job_id) as job_id from jobs";
			$result_max = mysql_query($query_max) or die(mysql_error());
			$row_max = mysql_fetch_assoc($result_max);
			
			$job_id = $row_max['job_id'];
			$job_id = $job_id + 1;
			
			$query_insert = "insert into jobs(job_id, user_id, company_id, job_title, job_description, required_skills, initial_salary, 				published_date) values('$job_id', '$user_id', '$company_id', '$job_title', '$job_description', '$required_skills', 	 																																												 				'$initial_salary','$current_date')";
			//echo "<br />this is in else<br />".$query_insert;
			$record_inserted = mysql_query($query_insert) or die(mysql_error());
		}
		
		if($record_inserted == 1) {
		?>
        	<script>
				alert('Job has been published');
			</script>
        <?php	
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Advertise Job</title>
         <link rel="stylesheet" href="styles/default.css" />
	    <script language="javascript" type="text/javascript" src="js/populate_combo_boxes.js"></script>
	    <script src="js/functions.js" ></script>
	</head>

<body>
	<?php
		include("includes/header.php");
	?>

    <div style="width:1000px; margin:auto;">
		 
    <form id="advertise_job_form" name="advertise_job_form" method="post" enctype="multipart/form-data">
    	
      <div style="margin-left:65px; min-height:500px;">
        <h1>Advertise Job Form</h1>
        <br /><br />
       	  <table width="418" cellspacing="5px;">
                    
                  <tr>
                      <td width="186">Job Title</td>
                      <td width="220">
                          <input type="text" id="job_title" name="job_title" value="" class="size-210" />
                      </td>
                  </tr>
                    
                  <tr>
                      <td>Job Description</td>
                      <td>
                        <input type="text" id="job_description" name="job_description" value="" class="size-210" />
                      </td>
                  </tr>
                    
                  <tr>
                      <td>Required Skills</td>
                      <td><input name="required_skills" id="required_skills" type="text" value="" class="size-210" /></td>
                  </tr>
                    
                  <tr>
                      <td>Company</td>
                      <td>
                      		<?php
								$query_companies = "select * from companies where user_id='$user_id'";
								$result_companies = mysql_query($query_companies) or die(mysql_error());
							?>
                      		<select id="company" name="company" style="height:30px; width:255px;">
                            	<option value="">-Select Company-</option>
                                <?php
									while($row_companies = mysql_fetch_assoc($result_companies)) {
								?>
                                <option value="<?php echo $row_companies['company_id']; ?>">
									<?php echo $row_companies['company_name']; ?></option>
                                <?php		
									}
								?>
                            </select>
                      </td>
                  </tr>
                    
                  <tr>
                      <td>Initial Salary</td>
                      <td><input type="text" id="initial_salary" name="initial_salary" value="" class="size-210" /></td>
                  </tr>
                    
                  <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                  </tr>
                                       
                  <tr>
                      <td>&nbsp;</td>
                      <td>
                       	  <input type="hidden" id="check_submit" name="check_submit" value="check_submit" />
                          <input type="button" value="Advertise Job" id="advertise_job" name="advertise_job" class="button-style" 
                          	style="height:40px;width:110px;" onClick="javascript: if(validate()) {post_form('advertise_job_form');}" />
                           	  &nbsp;&nbsp;&nbsp;&nbsp;
                          <input type="button" id="back" name="back" value="Back" class="button-style" style="height:40px			
                            ;width:110px;" onClick="goBack();" />
                      </td>
                  </tr>
          </table>
        </div>
        <br /><br />
        </form>   
        </div>

    </div>

 
<?php
	include("includes/footer.php");
?>
</body>

<script>

	function validate() {

		var status = false;

		var job_title = document.getElementById('job_title').value;
		var job_description = document.getElementById('job_description').value;
		var required_skills = document.getElementById('required_skills').value;
		var company_id = document.getElementById('company').value;
		var initial_salary = document.getElementById('initial_salary').value;

		if(job_title != '' && job_description != '' && required_skills != '' && company_id != '' && initial_salary != '') {
			status = true;
		} else {
			alert('Please fill all fields properly.');
		}

		return status;

	}

	function goBack() {
		location.replace('index_main.php');
	}
</script>
</html>