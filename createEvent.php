<?php
	include_once 'config.php';
	$message = "";
	if(isset($_POST['eventCreate'])){
		$title = $_POST['title'];
		$doe = $_POST['doe'];
		$cap = $_POST['capacity'];
		$eventbudget = $_POST['eventbudget'];
		$location = $_POST['location'];
		$year = $_POST['year'];

		if($conn){
			$conn->autocommit(False);
			$errorArray = array();
			if($year){
				checkIfBudgetYear($year);
				$sql = "INSERT INTO `event` (`title`,`doe`,`capacity`,`event_budget` , `Location`, `year`) VALUES ('$title','$doe','$cap','$eventbudget','$location', '$year')";
				if($conn->query($sql)){
					$sqlQuery = "SELECT * FROM `budget` WHERE `year`='$year'";
					if($queryRun = $conn->query($sqlQuery)){
						$dataRow = mysqli_fetch_array($queryRun);
						$newAddition = $dataRow['events'] + $eventbudget;
						$sqlQuery = "UPDATE `budget` SET `events`='$newAddition' WHERE `year`=$year";
						if($conn->query($sqlQuery)){
							$sqlQuery = "SELECT `event_id` FROM `event` ORDER BY `event_id` DESC LIMIT 1";
							$queryRun = $conn->query($sqlQuery);
							$dataRow = mysqli_fetch_array($queryRun);
							$eventId = $dataRow[0];
							settype($eventId, "string");
							$notfMessage = 'Message=New event '.$title.' is arriving at '.$doe.' Grab your seat!&eventid='.$eventId;
							$sqlQuery = "SELECT `id` from `sponsor`";
							$queryRun = $conn->query($sqlQuery);
							while($dataRow = mysqli_fetch_array($queryRun)){
								$sqlQuery = "INSERT INTO `sponsor_notifications`(`id`, `type`, `message`) VALUES('$dataRow[0]', 'event', '$notfMessage')";
								if($conn->query($sqlQuery)){
								}
								else{
									array_push($errorArray, 'Error');
								}
							}
							//$notfMessage = 'Message=New event'.$title.' is arriving at '.$doe.' Grab your seat!&eventid='.$eventId;
							$sqlQuery = "SELECT `id` from `guardian`";
							$queryRun = $conn->query($sqlQuery);
							while($dataRow = mysqli_fetch_array($queryRun)){
								$sqlQuery = "INSERT INTO `guardian_notifications`(`id`, `type`, `message`) VALUES('$dataRow[0]', 'event', '$notfMessage')";
								if($conn->query($sqlQuery)){
									$message = "Event created successfully!";
								}
								else{
									array_push($errorArray, 'Error');
								}
							}
						}
						else{
							array_push($errorArray, 'Error');
						}
					}
					else{
						array_push($errorArray, 'Error');
					}
				}
				else{
					array_push($errorArray, 'Error');
				}
			}
		}
		if(!empty($errorArray)){
			$message = "Event Creation Failed!";
			$conn->rollback();
		}
		$conn->commit();
		mysqli_close($conn);
	}
	function checkIfBudgetYear(int $year){
		$conn = mysqli_connect('localhost', 'root','', 'oms');
		if($conn){
			$sqlQuery = "SELECT count(*) FROM `budget` WHERE `year`='$year'";
			if($queryRun = $conn->query($sqlQuery)){
				$dataRow = mysqli_fetch_array($queryRun);
				if(!$dataRow[0]){
					$sqlQuery = "INSERT INTO `budget`(`year`) VALUES('$year')";
					$conn->query($sqlQuery);
					return;
				}
			}
		}
		return;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Dashboard</title>
	<link rel="stylesheet" href="styling/createEvent-style.css"> 
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
		<a href="approve_application.php"><img src="styling/icons/approve.png" class="menuicons"><span>Approve Applications</span></a>
		<a href="createEvent.html"><img src="styling/icons/036-calendar.png" class="menuicons"><span>Add Event</span></a>
	</div>


	<div class = "eventform">
		<h1 class= "formtitle">Event Details</h1>
		<?php echo $message; ?>
		<form action = "createEvent.php" method="POST">

			<div class="eventdetails">
				<label><strong>Title</strong></label>
				<input type="text" name="title" placeholder="Annual Children's Day Party">

				<label><strong>Date of Event</strong></label>
				<input type="date" name="doe" placeholder="mm-dd-yyyy">

				<label><strong>Capacity</strong></label>
				<input type="int" name="capacity" placeholder="80"> 

				<label><strong>Event Budget</strong></label>
				<input type="int" name="eventbudget" placeholder="150,000">

				<label><strong>Location</strong></label>
				<input type="text" name="location" placeholder="Islamabad, Pakistan">
				
				<label><strong>Year</strong></label>
				<input type="int" name="year" placeholder="XXXX">
			</div >
				<input type="submit" name="eventCreate" value="Create">
			</div>
		</form>
	</div>
	
	<div>
		


	</div>

</body>
</html>