<?php 
    include('config.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Student</title>
	<link rel="stylesheet" href="styling/addStudent-style.css"> 
</head>
<body>
	<header>

		<div class="lefttop">
			<img src="styling/icons/oms-white.png" class="omsimg">
		</div>
		<div class="rightop">
			<a href="#" class="logoutoption">
				Logout
			</a>
		</div>
	</header>

    <div class = "studentform">
        <h1 class= "formtitle">Student You Want to Edit Information of</h1>
        <form action = "editStudentDetail.php" method="POST">

            <div class="studentdata">
                <label><strong>Student ID</strong></label>
                <input type="text" name="idFind" placeholder="XX">

                <label><strong>CNIC/B-form No.</strong></label>
                <input type="text" name="CNICFind" placeholder="XXXXX-XXXXXX-X">
                
                <label><strong>Year</strong></label>
                <input type="text" name="yearFind" placeholder="XXXX">
            </div >
                <input type="submit" name="orphanFind" value="Search">
            </div>
        </form>
        </div>
	
</body>
</html>