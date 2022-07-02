<?php
	include('includes/config.php');

	function deleteOldJobsAdvertisement() {
		//echo "this is delete old jobs method";
		$query_find = "select * from jobs order by job_id";
		$result_find = mysql_query($query_find) or die(mysql_error());
		
		$current_date = date('Y-m-d');
		$current_date_exploded = explode('-',$current_date);
		
		$current_date_days = $current_date_exploded[0] * 365 + $current_date_exploded[1] * 30 + $current_date_exploded[2]; 
		//echo "current date=".$current_date."<br /> exploded=";
		//print_r($current_date_exploded);
		//echo $current_date_days;
		
		while($row_find = mysql_fetch_assoc($result_find)) {
			$published_date = explode('-',$row_find['published_date']);
			$total_days = $published_date[0] * 365 + $published_date[1] * 30 + $published_date[2];
			
			$publicity_days_count = $current_date_days - $total_days;
			//echo $publicity_days_count . "<br /><br />";
			if($publicity_days_count > 60) {
				$query_delete = "delete from jobs where job_id=".$row_find['job_id'];
				//echo "<br />".$query_delete;
				mysql_query($query_delete) or die(mysql_error());
			}
		}
	}

	function reAssignJobIDS() {
		$query_arrange = "select * from jobs order by job_id";
		$result_arrange = mysql_query($query_arrange) or die(mysql_error());
		
		$i = 1;
		while($row_arrange = mysql_fetch_assoc($result_arrange)) {
			$query_re_assign = "update jobs set job_id='$i' where job_id=".$row_arrange['job_id'];
			//echo $query_re_assign . "<br />";
			mysql_query($query_re_assign) or die(mysql_error());
			$i = $i + 1;
		}
	}
?>