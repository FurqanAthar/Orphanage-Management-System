<?php
 include_once 'config.php';
$uID =(isset($_GET['ID']) ? $_GET['ID'] : '');

$upass =(isset($_GET['Password']) ? $_GET['Password'] : '');
$uname = "";

if($conn){
    $sql = "SELECT `employee_id`, `First_name` FROM `employee` WHERE `Email` ='$uID' AND `Password`='$upass'";
    $result = mysqli_query($conn,$sql);
    $row = $result->fetch_assoc();
    $uname = $row["First_name"];
    $uId = $row['employee_id'];
    if (mysqli_num_rows($result)==0)
    {
        echo "Wrong Username and Password";
    }
    else
    {
        session_start();
        $_SESSION["uname"]=$uname;
        $_SESSION['adminId'] = $uId;
        header("Location: adminDashboard.php", true, 301);
        exit();
    }
}
else
{
    echo 'Error in connection';
}




?>