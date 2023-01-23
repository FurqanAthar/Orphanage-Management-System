<?php
    include 'config.php';
    session_start();
    $accountId = @$_SESSION['accountId'];
    $accountFirstName = @$_SESSION['firstname'];
    $accountLastName = @$_SESSION['secondname'];
    $cnic = '';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Sponsor My Applications - OMS</title>
	<link rel = "stylesheet" type="text/css" href ="styling/sponTable-style.css">
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
			<h4><?php echo $accountFirstName; echo " ".$accountLastName;?></h4>
		</center>
		
		<a href="SponMyApplication.php"><img src="styling/icons/045-monitor.png" class="menuicons">My Applications</a>
		<a href="SponGuardRegisterhtml.php"><img src="styling/icons/approve.png" class="menuicons"><span>Apply as Sponsor</span></a>
		<a href="#"><img src="styling/icons/036-calendar.png" class="menuicons"><span>Notifications</span></a>
    </div>
    <div class="tablebox">
        <table class="apptable">
            <caption> My Sponsor Applications - Submitted</caption>
            <tr>
                <th>Application ID</th>
                <th>Email</th>
                <th>CNIC</th>
                <th>Contact</th>
                <th>Income</th>
                <th>Address</th>
                <th>Pref Student ID</th>
                <th>Status</th>
            </tr>
            <?php
                if($conn)
                {
                    $sqlQuery = "SELECT * FROM `sponsor` WHERE `id` = '$accountId'";
                    $execute = $conn->query($sqlQuery);
                    if($execute)
                    {
                        $data = mysqli_fetch_array($execute);
                        $cnic = $data['cnic'];
                        $sqlQuery2 = "SELECT * FROM `sponsor_application` WHERE `cnic` = '$cnic'";  
                        $execute2 = $conn->query($sqlQuery2);
                        while($dataRow = mysqli_fetch_array($execute2)){
                            $appId = $dataRow['sponAppID'];
                            $email = $dataRow['email'];
                            $cnic = $dataRow['cnic'];
                            $contact = $dataRow['contact'];
                            $income = $dataRow['income'];
                            $address = $dataRow['address'];
                            $prefStId = $dataRow['prefStID'];
                            $status = $dataRow['status'];
                            echo "<tr>";
                                echo "<td>$appId</td>";
                                echo "<td>$email</td>";
                                echo "<td>$cnic</td>";
                                echo "<td>$contact</td>";
                                echo "<td>$income</td>";
                                echo "<td>$address</td>";
                                echo "<td>$prefStId</td>";
                                echo "<td>$status</td>";
                            echo "</tr>";
                        }
                    }
                }
            ?>
        </table>
    </div>
</body>
</html>