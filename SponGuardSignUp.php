<?php
	include 'config.php';
	$successMessage = "";
	$error = False;
    $fNameError = "";
    $sNameError = "";
    $emailError = "";
    $cnicError = "";
    $contactError = "";
    $incomeError = "";
	$passwordError = "";
	$firstname = "";
	$lastName = "";
	$email = "";
	$cnic = "";
	$contact = "";
	$income = "";
	$address = "";
	$password = "";
    if(isset($_POST['signUp'])){
        if(empty($_POST['firstName'])){
			$fNameError = 'First Name is required';
			$error = True;
        }
        else{
			if(!preg_match("/^[A-Za-z\. ]*$/",$_POST['firstName'])){
				$fNameError="Only Letters and white space are allowed";
				$error = True;
			}
			else{
				$firstname = $_POST['firstName'];
			}
        }
        if(empty($_POST['lastName'])){
			$sNameError = 'Second Name is required';
			$error = True;
        }
        else{
			if(!preg_match("/^[A-Za-z\. ]*$/",$_POST['lastName'])){
				$sNameError="Only Letters and white space are allowed";
				$error = True;
			}
			else{
				$lastName = $_POST['lastName'];
			}
        }
        if(empty($_POST['email'])){
			$emailError = 'Email is required';
			$error = True;
        }
        else{
			if(!preg_match("/[a-zA-Z0-9._-]{3,}@[a-zA-Z0-9._-]{3,}[.]{1}[a-zA-Z0-9._-]{2,}/",$_POST['email']))
			{
				$emailError="Invalid Email Format";
				$error = True;
			}
			else{
				$email = $_POST['email'];
			}
        }
        if(empty($_POST['Contact'])){
			$contactError = "Please provide Contact";
			$error = True;
        }
        else{
			if(!preg_match("/^[0-9]{4} [0-9]{7}$/",$_POST['Contact']))
			{
				$contactError="Invalid Contact Format";
				$error = True;
			}
			else{
				$contact = $_POST['Contact'];
			}
        }
        if(empty($_POST['Income'])){
			$incomeError = "Income is required";
			$error = True;
        }
        else{
			if(!preg_match("/^[0-9]{1,}$/",$_POST['Income']))
			{
				$incomeError="Enter correct Income";
				$error = True;
			}
			else{
				$income = $_POST['Income'];
			}
        }
        $address = $_POST['Address'];
        if(empty($_POST['password'])){
            $passwordError = "Please provide password for your account";
			$error = True;
		}
        else{
			if(!preg_match("/[A-za-z0-9*\/@#$%]{5,}$/",$_POST['password'])){
				$passwordError = 'Enter password -> Special Characters *@#$%, atleast 1 Capital Alphabet and Numbers';
				$error = True;
			}
			else{
				$password = $_POST['password'];
			}
        }
		$typeApp = $_POST['type'];
		if(empty($_POST['CNIC'])){
			$cnicError = "Please provide CNIC";
			$error = True;
        }
		else{
			if(!preg_match("/^[0-9]{5}-[0-9]{7}-[0-9]{1}$/",$_POST['CNIC']))
			{
				$cnicError="Invalid CNIC Format";
				$error = True;
			}
			else{
				$sqlQuery = "SELECT `cnic` FROM `$typeApp`";
				$cnicErrorCheck = False;
				if($queryRun = $conn->query($sqlQuery)){
					while($dataRow = mysqli_fetch_array($queryRun)){
						if($_POST['CNIC'] == $dataRow['cnic']){
							$error = True;
							$cnicErrorCheck = True;
							$cnicError = "Account Already Created With Same CNIC";
						}
					}
				}
				if(!$cnicErrorCheck){
		            $cnic = $_POST['CNIC'];
				}
			}
		}
		if($error == False){
			if($conn){
				if($typeApp == 'sponsor'){
					$sql = "INSERT INTO `sponsor` (`firstname`,  `lastname`, `email`, `cnic`, `contact`, `income`, `address`, `password`) VALUES('$firstname',  '$lastName', '$email', '$cnic', '$contact', '$income', '$address', '$password')";
				}
				if($typeApp == 'guardian'){
					$sql = "INSERT INTO `guardian` (`firstname`,  `lastname`, `email`, `cnic`, `contact`, `income`, `address`, `password`) VALUES('$firstname',  '$lastName', '$email', '$cnic', '$contact', '$income', '$address', '$password')";
				}
				if($conn->query($sql)){
                    $successMessage = 'Account Created Successfully';
                    header('Location:SponGuardLogin.php');
				}
				else{
					echo $conn->error;
				}
			}
			//mysqli_close($conn);
		}
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Guardian/Sponsor SignUp - OMS</title>
	<link rel = "stylesheet" type="text/css" href ="styling/sponsorGuardianRegistration-style.css">
</head>
<body>
	
	<!--Form-->
	<div class = "loginarea">
		<img src="styling/images/avicon.jpg" class="icon">
		<h1 class="logintext">Register Your Account</h1>

		<form action = "SponGuardSignUp.php" method="POST">

			<div class="userdata">
				<label><strong>First Name</strong></label>
				<input type="text" name="firstName" placeholder="John"><br>
				<?php echo $fNameError; ?><br>

				<label><strong>Last Name</strong></label>
				<input type="text" name="lastName" placeholder="Doe"><br>
				<?php echo $sNameError; ?><br>

				<label><strong>Email</strong></label>
				<input type="email" name="email" placeholder="johndoe@email.com"><br>
				<?php echo $emailError; ?><br>

				<label><strong>CNIC</strong></label>
				<input type="text" name="CNIC" placeholder="XXXXX-XXXXXX-X"><br>
				<?php echo $cnicError; ?><br>

				<label><strong>Contact</strong></label>
				<input type="text" name="Contact" placeholder="+92 3XX XXXXXXX"><br>
				<?php echo $contactError; ?><br>

				<label><strong>Monthly Income</strong></label>
				<input type="number" name="Income" placeholder="40000"><br>
				<?php echo $incomeError; ?><br>

				<label><strong>Address</strong></label>
				<input type="text" name="Address" placeholder="House No. 422, Apartment 32, ZOF Housing, Lahore, Punjab, Pakistan">

				<label><strong>Password</strong></label>
				<input type="password" name="password" placeholder="XXXX"><br>
				<?php echo $passwordError; ?><br><br>

			</div>
			<div class="rad">
				<input type="radio" name="type" checked value="sponsor"> Sponsorship
				<input type="radio" name="type" value="guardian"> Adoption
			</div>

				<input type="submit" name="signUp" value="SIGN UP"><br>
				<?php echo $successMessage; ?>
			<div class="registerlink">
				<p ID="already">Already have an account?</p>
				<a href="SponGuardLogin.php">Login Here</a>
			</div>
		</form>
	</div>
	

	<div style = "margin-top: 500px"></div> 
</body>
</html>