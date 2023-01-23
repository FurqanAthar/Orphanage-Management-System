<?php
	include 'config.php';
	session_start();
	if(!isset($_SESSION['accountId'])){
		Header('Location:SponGuardLogin.php');
	}
    $accountId = @$_SESSION['accountId'];
    $accountFirstName = @$_SESSION['firstname'];
	$accountLastName = @$_SESSION['secondname'];
	$accountType = @$_SESSION['type'];
	$notfCount = 0;
	
	if($accountType == 'sponsor'){
		$sqlQuery = "SELECT count(*) FROM `sponsor_notifications` WHERE `id`='$accountId' and `status`='Unread'";
		if($queryRun = $conn->query($sqlQuery)){
			$notfCount = mysqli_fetch_array($queryRun)[0];
		}
		else{
			echo $conn->error;
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Sponsor Dashboard</title>
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
			<h4>
                <?php echo $accountFirstName; echo " ".$accountLastName; ?>
			</h4>
		</center>
		
		<a href="SponMyApplication.php"><img src="styling/icons/045-monitor.png" class="menuicons">My Applications</a>
		<a href="SponGuardRegisterhtml.php"><img src="styling/icons/approve.png" class="menuicons"><span>Apply as Sponsor</span></a>
		<a href="sponCheckNotification.php"><img src="styling/icons/036-calendar.png" class="menuicons"><span>Notifications (<?php echo $notfCount; ?>)</span></a>
		


	</div>

</body>
</html>