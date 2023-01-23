<?php
    session_start();
    $successMessage = '';
    if(isset($_POST['Login']))
    {
        include 'config.php';
        $accountID = '';
        $cnicReceived = $_POST['cnic'];
        $passwordReceived = $_POST['password'];
        $accountType = $_POST['type'];
        $check = False;
        if($conn)
        {
            $sqlQuery = "SELECT * FROM `$accountType` WHERE `cnic` = '$cnicReceived'";
            $execute = $conn->query($sqlQuery);
            if($execute){
                while($dataRows = mysqli_fetch_array($execute)){
                    if($dataRows['cnic'] == $cnicReceived && $dataRows['password'] == $passwordReceived){
                        $successMessage = 'Login Successful';
                        $check = True;
                        $accountID = $dataRows['id'];
                        $accountFirstName = $dataRows['firstname'];
                        $accountLastName = $dataRows['lastname'];
                        break;
                    }
                }
                if($check == False){
                    $successMessage = "Login Failed, Please Enter correct Login";
                }
                else{
                    $_SESSION['accountId'] = $accountID;
                    $_SESSION['firstname'] = $accountFirstName;
                    $_SESSION['secondname'] = $accountLastName;
                    $_SESSION['type'] = $accountType;
                    if($accountType == 'sponsor'){
                        header("Location:SponDashboard.php");
                    }
                    if($accountType == 'guardian'){
                        header("Location:GuardDashboard.php");
                    }
                }
            }
            else{
                error.query();
            }
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Guardian/Sponsor Login - OMS</title>
	<link rel = "stylesheet" type="text/css" href ="styling/style.css">
</head>
<body>
	

	<!--Form-->
	<div class = "loginarea">
		<img src="styling/images/avicon.jpg" class="icon">
        <h1 class="logintext">Login</h1><br>
        <?php echo $successMessage; ?>

		<form action = "SponGuardLogin.php" method="POST">

			<div class="userdata">
				<label><strong>CNIC</strong></label>
				<input type="text" name="cnic" placeholder="Please Enter CNIC">

				<label><strong>Password</strong></label>
				<input type="password" name="password" placeholder="Please Enter Password"> 
            <div class="rad">
                <input type="radio" name="type" checked value="sponsor"> As Sponsor
                <input type="radio" name="type" value="guardian"> As Guardian
            </div>
            </div>
				<input type="submit" name="Login" value="Login">
			<div class="registerlink">
				<a href="SponGuardSignUp.php">Register Here</a>
			</div>
		</form>
	</div>
	

	<div style = "margin-top: 500px"></div> 
</body>
</html>