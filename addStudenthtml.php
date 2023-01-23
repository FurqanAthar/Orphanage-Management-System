<?php
include_once 'config.php';
$message = "";
if(isset($_POST['orphanSubmit'])){
    $fname = $_POST['firstName'];
    $sname = $_POST['lastName'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $cnic = $_POST['CNIC'];
    $place_birth = $_POST['pob'];
	$age = $_POST['age'];
	$year = $_POST['year'];
    $cnicCheck = False;

    $sqlQuery = "SELECT * FROM `student`";
    if($queryRun = $conn->query($sqlQuery)){
        while($dataRow = mysqli_fetch_array($queryRun)){
            if($dataRow['CNIC'] == $cnic){
                $cnicCheck = True;
            }
        }
    }
    if(!$cnicCheck){
        if($conn){
				$conn->autocommit(False);
				$errorArray = array();
				list($roomAlotId, $roomAlotFilled) = roomAlot();
				$sql = "INSERT INTO `student` (`First_name`,`Last_name`,`DOB`,`Gender` , `CNIC`, `Place_birth`, `age`, `roomId`, `enrollmentYear`) VALUES ('$fname','$sname','$dob','$gender','$cnic','$place_birth', '$age', '$roomAlotId', '$year')";
				if($conn->query($sql)){
					$roomAlotFilled = $roomAlotFilled + 1;
					$sqlQuery = "UPDATE `room` SET `filled` = '$roomAlotFilled' WHERE `id` = '$roomAlotId'";
					if($conn->query($sqlQuery)){
						$sqlQuery = "SELECT `student_id` FROM `student` WHERE `CNIC`='$cnic'";
						if($queryRun = $conn->query($sqlQuery)){
							$dataRow = mysqli_fetch_array($queryRun);
							$sqlQuery = "INSERT INTO `academics`(`id`, `year`) VALUES('$dataRow[0]', '$year')";
							if($queryRun = $conn->query($sqlQuery)){
								$sqlQuery = "INSERT INTO `expenditure`(`id`, `year`) VALUES('$dataRow[0]', '$year')";
								if($queryRun = $conn->query($sqlQuery)){
									$message = "Orphan Enrolled!";
								}
								else{
									array_push($errorArray, 'error');
								}
							}
							else{
								array_push($errorArray, 'error');
							}
						}
						else{
							array_push($errorArray, 'error');
						}
					}
					else{
						array_push($errorArray, 'error');
					}
				}
				else{
					array_push($errorArray, 'error');
				}
				if(!empty($errorArray)){
					$message = "Failed enrollment, Try Again!";
					$conn->rollback();
				}
				$conn->commit();
        }
        mysqli_close($conn);
    }
    else{
		$message = "Student with same B-FORM already enrolled, Try Again!";
    }
}

function roomAlot(){
    $conn = mysqli_connect('localhost', 'root', '', 'oms');
    $sqlQuery = "SELECT count(*) FROM `room`";
    if($queryRun = $conn->query($sqlQuery)){
        if(mysqli_fetch_array($queryRun)[0] == 0){
            $sqlQuery = "INSERT INTO `room`(`capacity`) VALUES(2)";
            $queryRun = $conn->query($sqlQuery);
        }
        $sqlQuery = "SELECT * FROM `room` ORDER BY `id` DESC LIMIT 1";
        if($queryRun = $conn->query($sqlQuery)){
            echo "ok";
            $dataRow = mysqli_fetch_array($queryRun);
            if($dataRow['filled'] < $dataRow['capacity']){
                return array ($dataRow['id'], $dataRow['filled']);
            }
            else{
                $sqlQuery = "INSERT INTO `room`(`capacity`) VALUES(2)";
                if($queryRun = $conn->query($sqlQuery)){
                    return array($dataRow['id'] + 1, 0);
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Student</title>
	<link rel="stylesheet" href="styling/addStudent-style.css"> 
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
		
		<a href="addStudenthtml.php"><img src="styling/icons/045-monitor.png" class="menuicons">Add Student</a>
		<a href="editStudent.php"><img src="styling/icons/045-monitor.png" class="menuicons">Add Student</a>
		<a href="approve_application.php"><img src="styling/icons/approve.png" class="menuicons"><span>Approve Applications</span></a>
		<a href="createEvent.html"><img src="styling/icons/036-calendar.png" class="menuicons"><span>Add Event</span></a>
	</div>


	<div class = "studentform">
		<h1 class= "formtitle">Student Admission Form</h1>
		<form action = "addStudenthtml.php" method="POST">

			<?php echo $message; ?>
			<div class="studentdata">
				<label><strong>First Name</strong></label>
				<input type="text" name="firstName" placeholder="John">

				<label><strong>Last Name</strong></label>
				<input type="text" name="lastName" placeholder="Doe">

				<label><strong>Date of Birth</strong></label>
				<input type="date" name="dob" placeholder="mm-dd-yyyy">

				<label><strong>Gender</strong></label>
				<input type="text" name="gender" placeholder="female"> 

				<label><strong>CNIC/B-form No.</strong></label>
				<input type="text" name="CNIC" placeholder="XXXXX-XXXXXX-X">

				<label><strong>Place of Birth</strong></label>
				<input type="text" name="pob" placeholder="Islamabad, Pakistan">
				
				<label><strong>age</strong></label>
				<input type="number" name="age" placeholder="XX">
				
				<label><strong>Year</strong></label>
				<input type="number" name="year" placeholder="XXXX">
			</div >
				<input type="submit" name="orphanSubmit" value="Add Student">
			</div>
		</form>
	</div>
	
	<div>
		


	</div>

</body>
</html>