

 <link rel="stylesheet" href="../Presentation_Layer/styles/default.css" />
		
        <div class="header">
        	<ul class="header-menus">
            	<?php
					if($_SESSION['user_id'] > 0) {
				?>
            	<li><a href="index_main.php">Home</a></li>
                <li>|</li>
                                <li>|</li>
                <li><a href="about_us.php">About Us</a></li>
                <li>|</li>
                <li><a href="contact_us.php">Contact Us</a></li>
                <li>|</li>
                <li><a href="join_us.php">Join Us</a></li>
                <li>|</li>
                <li><a href="feed_back.php">Feed Back</a></li>
                <li>|</li>
                <li class="sub-menu"><a href="">Profile</a>
                	<ul>
                    	<li><a href="companies.php">Add Company</a></li>
                        <li><a href="advertise_job.php">Advertise Job</a></li>
                        <li><a href="update_profile.php">Update Profile</a></li>
                        <li><a href="signout.php">Sign Out</a></li>
                    </ul>
                </li>
                <?php
					}
				?>
            </ul>	
        </div>
        
