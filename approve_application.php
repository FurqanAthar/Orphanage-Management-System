<!DOCTYPE html>
<html>
<head>
	
	<title>Admin Dashboard</title>
	<link rel="stylesheet" href="styling/adminapprove.css"> 
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
		
		<a href="addStudent.html"><img src="styling/icons/045-monitor.png" class="menuicons">Add Student</a>
		<a href="editStudent.php"><img src="styling/icons/045-monitor.png" class="menuicons">Add Student</a>
		<a href="approve_application.php"><img src="styling/icons/approve.png" class="menuicons"><span>Approve Applications</span></a>
		<a href="createEvent.html"><img src="styling/icons/036-calendar.png" class="menuicons"><span>Add Event</span></a>
	
	 <div>
	</div>
	<div class = "approve">
	<table width="500" border="5" align="center">
        <tr>
            <th>Application ID</th>
            <th>Pref Student ID</th>
            <th>Income</th>
            <th>Status</th>
			<th>Verify</th>
        </tr>
	<?php
		include_once 'config.php';
		$temp = 'Pending';
		$sql = "SELECT * FROM `sponsor_application` WHERE `status`='$temp'";
    	$result = $conn->query($sql);
		// session_start();
		$type = 'sponsor';
        while($data= mysqli_fetch_array($result))
				{
						$appId = $data['sponAppID'];
                        $income = $data['income'];
                        $prefStId = $data['prefStID'];
						$status = $data['status'];
						echo "<tr>";
						echo "<td>$appId</td>";
                        echo "<td>$prefStId</td>";
                        echo "<td>$income</td>";
						echo "<td>$status</td>";
						echo"<td>
						<a style = 'color:black; font-weight:700; border:4px;' href='admin_approve_app.php?appId={$appId}&type={$type}'>Verify</a>
						</td>";
						echo "</tr>";
				}
		$temp2 = 'Pending';
		$sql2 = "SELECT * FROM `guardian_application` WHERE `status`='$temp2'";
    	$result2 = $conn->query($sql2);
		// session_start();
		$type2 = 'guardian';
        while($data2= mysqli_fetch_array($result2))
				{
						$appId = $data2['guardAppID'];
                        $income = $data2['income'];
                        $prefStId = $data2['prefStID'];
						$status = $data2['status'];
						echo "<tr>";
						echo "<td>$appId</td>";
                        echo "<td>$prefStId</td>";
                        echo "<td>$income</td>";
						echo "<td>$status</td>";
						echo"<td>
						<a style = 'color:black; font-weight:700; border:4px;' href='admin_approve_app.php?appId={$appId}&type={$type2}'>Verify</a>
						</td>";
						echo "</tr>";
				}
				
	?>
						
						
	</div>
</body>
</html>
