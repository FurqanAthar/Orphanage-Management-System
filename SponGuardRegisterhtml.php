<?php
	include 'config.php';
	session_start();
	$type = @$_SESSION['type'];
	$successMessage = "";
	$prefStIdError = "";
	$firstname = "";
	$lastName = "";
	$email = "";
	$cnic = "";
	$contact = "";
	$income = "";
	$address = "";
	$prefStId = "";
	if(isset($_POST['Register'])){
		echo "Yes";
		$firstname = $_POST['firstName'];
		$lastName = $_POST['lastName'];
		$email = $_POST['email'];
		$cnic = $_POST['CNIC'];
		$contact = $_POST['Contact'];
		$income = $_POST['Income'];
		$address = $_POST['Address'];
		$prefStId = $_POST['PSID'];
		$sqlQuery = "SELECT * FROM `student`";
		if($queryRun = $conn->query($sqlQuery)){
			$studentFound = False;
			while($dataRow = mysqli_fetch_array($queryRun)){
				if($_POST['PSID'] == $dataRow['student_id']){
					$studentFound = True;
				}
			}
			if($studentFound){
				if($_POST['type'] == 'sponsor'){
					$sqlQuery = "INSERT INTO `sponsor_application`(`firstname`, `lastname`, `email`, `cnic`, `contact`, `income`, `address`, `prefStID`) VALUES('$firstname', '$lastName', '$email', '$cnic', '$contact', '$income', '$address', '$prefStId')";
				}
				if($_POST['type'] == 'guardian'){
					$sqlQuery = "INSERT INTO `guardian_application`(`firstname`, `lastname`, `email`, `cnic`, `contact`, `income`, `address`, `prefStID`) VALUES('$firstname', '$lastName', '$email', '$cnic', '$contact', '$income', '$address', '$prefStId')";
				}
				if($queryRun = $conn->query($sqlQuery)){
					$successMessage = "Application Submitted Successfully";
				}
				else{
					$successMessage = "Please provide correct details";
				}
			}
			else{
				$prefStIdError = "Student with this ID doesn't exist. Try Again";
			}
		}
	}
	else if($_SESSION['accountId']){
		$accountId = @$_SESSION['accountId'];
		$accountFirstName = @$_SESSION['firstname'];
		$accountLastName = @$_SESSION['secondname'];
		$sqlQuery = "SELECT * FROM `$type` WHERE `id`='$accountId'";
		if($queryRun = $conn->query($sqlQuery)){
			$dataRow = mysqli_fetch_array($queryRun);
			$firstname = $dataRow['firstname'];
			$lastName = $dataRow['lastname'];
			$email = $dataRow['email'];
			$cnic = $dataRow['cnic'];
			$contact = $dataRow['contact'];
			$income = $dataRow['income'];
			$address = $dataRow['address'];
		}
	}
	else if(!$_SESSION['accountId']){
		header('Location:SponGuardLogin.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Sponsor Guardian Application - OMS</title>
	<link rel = "stylesheet" type="text/css" href ="styling/sponsorGuardianRegistration-style.css">
</head>
<body>
	
	<!--Form-->
	<div class = "loginarea">
		<img src="styling/images/avicon.jpg" class="icon">
		<h1 class="logintext">Application</h1>

		<form action = "SponGuardRegisterhtml.php" method="POST">

			<div class="userdata">
				<label><strong>First Name</strong></label>
				<input type="text" name="firstName" placeholder="John" value="<?php echo $firstname; ?>"><br>

				<label><strong>Last Name</strong></label>
				<input type="text" name="lastName" placeholder="Doe" value="<?php echo $lastName; ?>"><br>

				<label><strong>Email</strong></label>
				<input type="email" name="email" placeholder="johndoe@email.com" value=<?php echo $email; ?>><br>

				<label><strong>CNIC</strong></label>
				<input type="text" name="CNIC" placeholder="XXXXX-XXXXXX-X" value="<?php echo $cnic; ?>"><br>

				<label><strong>Contact</strong></label>
				<input type="text" name="Contact" placeholder="+92 3XX XXXXXXX" value="<?php echo $contact; ?>"><br>

				<label><strong>Monthly Income</strong></label>
				<input type="number" name="Income" placeholder="40000" value="<?php echo $income; ?>"><br>

				<label><strong>Address</strong></label>
				<input type="text" name="Address" placeholder="House No. 422, Apartment 32, ZOF Housing, Lahore, Punjab, Pakistan" value="<?php echo $address; ?>">

				<label><strong>Prefered Student ID</strong></label>
				<input type="number" name="PSID" placeholder="122-321" value="<?php echo $prefStId; ?>"><br>
				<?php echo $prefStIdError; ?>

			</div>
			<div class="rad">
				<input type="radio" name="type" checked value="sponsor"> Sponsorship
				<input type="radio" name="type" value="guardian"> Adoption
			</div>

				<input type="submit" name="Register" value="Register"><br>
				<?php echo $successMessage; ?>
		</form>
	</div>
	

	<div style = "margin-top: 500px"></div> 
</body>
</html>