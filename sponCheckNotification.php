<?php
    include('config.php');
    session_start();
    if(!isset($_SESSION['accountId'])){
        Header('Location:SponGuardLogin.php');
    }
    $errorMessage = "";
    $accountId = @$_SESSION['accountId'];
    $accountFirstName = @$_SESSION['firstname'];
	$accountLastName = @$_SESSION['secondname'];
    $accountType = @$_SESSION['type'];
    if(isset($_GET['read'])){
        $notificationId = $_GET['notfId'];
        $sqlQuery = "UPDATE `sponsor_notifications` SET `status`='Read' WHERE `notfId`='$notificationId'";
        if(!$conn->query($sqlQuery)){
            echo $conn->error;
        }
        else{
            header('Location:sponCheckNotification.php');
        }
    }
    if(isset($_GET['seatConfirm'])){
        $eventId = $_GET['eventId'];
        $notificationId = $_GET['notfId'];
        $sqlQuery = "SELECT * FROM `event` WHERE `event_id`='$eventId'";
        if($queryRun = $conn->query($sqlQuery)){
            $dataRow = mysqli_fetch_array($queryRun);
            if($dataRow['filled'] < $dataRow['capacity']){
                $filledNew = $dataRow['filled'] + 1;
                $sqlQuery1 = "UPDATE `event` SET `filled`='$filledNew' WHERE `event_id`=$eventId";
                if($conn->query($sqlQuery1)){
                    $errorMessage = "Your Seat is booked! Please arrive on time :)";
                    $sqlQuery3 = "UPDATE `sponsor_notifications` SET `status`='Read' WHERE `notfId`='$notificationId'";
                    if($conn->query($sqlQuery3)){
                        header('Location:sponCheckNotification.php');
                    }
                }
                else{
                    $errorMessage = "Seat Confirmation Failed!";
                }
            }
            else{
                $sqlQuery3 = "UPDATE `sponsor_notifications` SET `status`='Read' WHERE `notfId`='$notificationId'";
                $conn->query($sqlQuery3);
                $errorMessage = "Capacity is Full!. Be quick next time :)";
            }
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title> Sponsor Notifications - OMS</title>
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
    <div class="tablebox">
    <h1 style="color:white;"><?php echo $errorMessage; ?></h1>
        <table class="apptable">
            <caption> Notifications - Unread </caption>
            <tr>
                <th>Message</th>
                <th>Status</th>
                <th>Decision</th>
            </tr>
            <?php
                if($conn)
                {
                    $sqlQuery = "SELECT * FROM `sponsor_notifications` WHERE `id`='$accountId' and `status`='Unread'";
                    if($queryRun = $conn->query($sqlQuery)){
                        while($dataRow = mysqli_fetch_array($queryRun)){
                            $message = parse_str($dataRow['message'], $parsedMessage);
                            $messageFinal = $parsedMessage['Message'];
                            $notfId = $dataRow['notfId'];
                            echo "<tr>";
                            echo "<td>$messageFinal</td>";
                            echo "<td><a style = 'color:white; font-weight:700; border:4px;' href='sponCheckNotification.php?notfId={$notfId}&read=True'>Mark As Read</a></td>";
                            if($dataRow['type'] == 'event'){
                                $eventId = $parsedMessage['eventid'];
                                echo"<td><a style = 'color:white; font-weight:700; border:4px;' href='sponCheckNotification.php?notfId={$notfId}&seatConfirm=True&eventId={$eventId}'>Confirm Seat</a></td>";
                            }
                            echo "</tr>";
                        }
                    }
                }
                ?>
        </table>
        <table class="apptable">
            <caption> Notifications - Marked Read </caption>
            <tr>
                <th>Message</th>
            </tr>
            <?php
                if($conn)
                {
                    $sqlQuery = "SELECT * FROM `sponsor_notifications` WHERE `id`='$accountId' and `status`='Read'";
                    if($queryRun = $conn->query($sqlQuery)){
                        while($dataRow = mysqli_fetch_array($queryRun)){
                            $message = parse_str($dataRow['message'], $parsedMessage);
                            $messageFinal = $parsedMessage['Message'];
                            $notfId = $dataRow['notfId'];
                            echo "<tr>";
                            echo "<td>$messageFinal</td>";
                            echo "</tr>";
                        }
                    }
                }
            ?>
        </table>
    </div>
</body>
</html>