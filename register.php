<?php
$fname = $_POST['firstName'];
$sname = $_POST['lastName'];
$upassword = $_POST['Password'];
$email = $_POST['email'];
$cnic = $_POST['CNIC'];
$contact = $_POST['Contact'];
$designation = $_POST['Designation'];
$evc = $_POST['EVC'];
$servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'oms';

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if($conn){
$sql = "INSERT INTO `employee` (`First_name`,`Last_name`,`Email`,`Password` , `Cnic`, `Contact`, `Designation`, `Evc`) VALUES ('$fname','$sname','$email','$upassword','$cnic','$contact', '$designation','$evc')";
if($conn->query($sql)){
            echo "Addition Successful";
        }
        else{
            echo $conn->error;
        }
}
 mysqli_close($conn);
?>


