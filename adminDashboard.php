<!DOCTYPE html>
<html>
<head>
	<title>Admin Dashboard</title>
	<link rel="stylesheet" href="styling/adminDashboard-style.css"> 
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

	<div class="menu">
		<center>
			<img src="styling/images/avicon.jpg" class="userimage">
			<!--<h4>GET USER NAME HERE<!h4>-->
			<h4><?php
			session_start();
			echo @$_SESSION['uname'];
			?></h4>
		</center>
		
		<a href="addStudenthtml.php"><img src="styling/icons/045-monitor.png" class="menuicons"><span>Add Student</span></a>
		<a href="editStudent.php"><img src="styling/icons/045-monitor.png" class="menuicons"><span>Edit Student Detail</span></a>
		<a href="approve_application.php"><img src="styling/icons/approve.png" class="menuicons"><span>Approve Applications</span></a>
		<a href="createEvent.php"><img src="styling/icons/036-calendar.png" class="menuicons"><span>Add Event</span></a>
		


	</div>

</body>
</html>