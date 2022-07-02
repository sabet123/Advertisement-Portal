<?php
	include('includes/config.php');
	include('includes/functions.php');
	//echo $_SESSION['user_id'];
	
	if(!isset($_SESSION['user_id'])) {
?>
<script>
	location.replace('index.php');
</script>

<?php
	}
	// i have to call this method to delete the old jobs so that database does not grow.
	deleteOldJobsAdvertisement();

	//this function rearrange the job_id's so that to remove the holes created due to deletion process.
	reAssignJobIDS();
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Jobs</title>
    <link rel="stylesheet" href="../Presentation_Layer/styles/default.css" />
</head>

<style>
	td {
		width:130px;
		min-height:50px;
	}

	.jobs-area {
		background-color:#EEEEEE;
		border-radius:8px;
		border:2px solid #57043B;
		min-height:300px;
		width:550px;
	}
</style>

<body>
	<?php
        include("includes/header.php");
		
    ?>
    <div class="width-100percent">
    	<div style="min-height:400px;width:1000px;margin:0 auto;">
        	<div style="margin-left:65px;margin-right:65px; min-height:300px;">
            	<br />
                <!-- Start of advertisement area-->
                <?php
					$query_jobs = "select * from countries as c, cities as ct, companies as cmp, jobs as jb"
					. " where c.country_id=ct.country_id and ct.city_id = cmp.city_id and cmp.company_id = jb.company_id"
					. " and cmp.user_id = jb.user_id order by jb.job_id";
					
					$result_jobs = mysql_query($query_jobs) or die(mysql_error());
					//echo mysql_num_rows($result_jobs);
					while($row_jobs = mysql_fetch_assoc($result_jobs)) {
				?>
                <div class="jobs-area">
                <table width="533" cellspacing="20">
                	
                        <tr>
                            <td>Job Title</td>
                            <td><?php echo $row_jobs['job_title'];?></td>
                        </tr>
                        
                        <tr>   
                            <td>Job description</td>
                            <td><?php echo $row_jobs['job_description'];?></td>
                        </tr>
                        
                        <tr>    
                            <td>Required Skills</td>
                            <td><?php echo $row_jobs['required_skills'];?></td>
                        </tr>
                        
                        <tr>    
                            <td>Initial Salary</td>
                            <td><?php echo $row_jobs['initial_salary'];?></td>
                        </tr>
                        
                        <tr>    
                            <td>Location</td>
                            <td>
								<?php 
									echo $row_jobs['address'];
									echo ", " . $row_jobs['city_name'] . ", " . $row_jobs['country_name'];
								?>
                            </td>
                        </tr>
                        
                        <tr>
                        	<td>Published Date</td>
                            <td>
								<?php 
									echo $row_jobs['published_date'];
								?>
                            </td>
                        </tr>
                        
                        <tr>
                            <td>&nbsp;</td>
                            <td>
                            	<a href="apply_now.php?job_id=<?php echo $row_jobs['job_id'];?>">
                                	<img src="images/apply_now3.jpg" height="60px" width="130px" />
                                </a>
                            </td>
                        </tr>
                </table>
              </div>
                <?php
					echo "<br />";
					}
				?>
                
            	<!-- End of advertisement area-->

          </div>
        </div>
    </div>
    <?php
        include("includes/footer.php");
    ?>
</body>
</html>