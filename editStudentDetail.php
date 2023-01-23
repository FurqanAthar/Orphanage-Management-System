<?php 
    include('config.php');
    $message = "";
    $aSchoolName = "";
    $aGrade = "";
    $aPercentage = "";
    $aYear = "";
    $eClothing = "";
    $eEduFee = "";
    $eFood = "";
    $eYear = "";
    $findId = "";
    $findCnic = "";
    $findYear = "";
    if(isset($_POST['orphanFind'])){
        $findId = $_POST['idFind'];
        $findCnic = $_POST['CNICFind'];
        $findYear = $_POST['yearFind'];
        $sqlyQuery1 = "SELECT * FROM `academics` WHERE `id`='$findId' and `year`='$findYear'";
        $sqlyQuery2 = "SELECT * FROM `expenditure` WHERE `id`='$findId' and `year`='$findYear'";
        if($conn){
            if($queryRun = $conn->query($sqlyQuery1)){
                if(mysqli_num_rows($queryRun) == 0){
                    header('Location:addNewYearRecord.php');
                }
                $dataRow = mysqli_fetch_array($queryRun);
                $aSchoolName = $dataRow['schoolName'];
                $aGrade = $dataRow['grade'];
                $aPercentage = $dataRow['percentage'];
                $aYear = $dataRow['year'];
            }
            else{
                echo "<script>alert('Error')</script>";
            }
            if($queryRun = $conn->query($sqlyQuery2)){
                $dataRow = mysqli_fetch_array($queryRun);
                $eClothing = $dataRow['clothing'];
                $eEduFee = $dataRow['eduFee'];
                $eFood = $dataRow['food'];
                $eYear = $dataRow['year'];
            }
            else{
                echo "<script>alert('Error')</script>";
            }
        }
    }
    if(isset($_POST['orphanEdit'])){
        $idEdit = $_POST['idEdit'];
        $aSchoolNameR = $_POST['schoolEdit'];
        $aGradeR = $_POST['gradeEdit'];
        $aPercentageR = $_POST['percentEdit'];
        $aYearR = $_POST['yearEdit1'];
        settype($aYearR, 'int');
        settype($aYear, 'int');
        $eClothingR = $_POST['clothingEdit'];
        settype($eClothing, 'int');
        settype($eClothingR, 'int');
        $eEduFeeR = $_POST['eduFeeEdit'];
        settype($eEduFee, 'int');
        settype($eEduFeeR, 'int');
        $eFoodR =$_POST['foodEdit'];
        settype($eFoodR, 'int');
        settype($eFood, 'int');
        $eYearR = $_POST['yearEdit2'];
        settype($eYear, 'int');
        settype($eYearR, 'int');
        $sqlQuery1 = "UPDATE `academics` SET `schoolName`='$aSchoolNameR', `grade`='$aGradeR', `percentage`='$aPercentageR' WHERE `id`='$idEdit'";
        if($conn->query($sqlQuery1)){
            $message = "Updated Academic Report";
        }
        else{
            echo $conn->error;
            $message = "Failed to update Academic Report";
        }
        $sqlQuery2 = "UPDATE `expenditure` SET `clothing`='$eClothingR', `eduFee`='$eEduFeeR', `food`='$eFoodR' WHERE `id`='$idEdit'";
        if($conn->query($sqlQuery2)){
            list($prevFoodBudget, $prevEduBudget, $prevClothingBudget) = checkIfBudgetYear($aYearR);
            $result1 = ($eFoodR-$eFood) + $prevFoodBudget;
            $result2 = ($eClothingR-$eClothing) + $prevClothingBudget;
            $result3 = ($eEduFeeR-$eEduFee) + $prevEduBudget;
            $sqlQuery = "UPDATE `budget` SET `food`=$result1, `eduFee`=$result3, `clothing`=$result2 WHERE `year`='$aYearR'";
            if($conn->query($sqlQuery)){
                $message = "Updated Expenditure Report";
                //header('Location:adminDashboard.php');
            }
            else{
                echo $conn->error;
                $message = "Updation Failed";
            }

        }
        else{
            $message = "Failed to update Expenditure Report";
        }
    }
    else if (!isset($_POST['orphanFind'])){
        header('Location:editStudent.php');
    }
?>

<?php 
    function checkIfBudgetYear(int $year){
		$conn = mysqli_connect('localhost', 'root','', 'oms');
		if($conn){
			$sqlQuery = "SELECT * FROM `budget` WHERE `year`=$year";
			if($queryRun = $conn->query($sqlQuery)){
				$rowCount = mysqli_num_rows($queryRun);
				$dataRow = mysqli_fetch_array($queryRun);
				if(!$rowCount){
                    echo $rowCount;
					$sqlQuery = "INSERT INTO `budget`(`year`) VALUES('$year')";
					$conn->query($sqlQuery);
					return array(0, 0, 0);
                }
                else{
                    echo '2';
                    return array($dataRow['food'], $dataRow['eduFee'], $dataRow['clothing']);
                }
			}
		}
		return;
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Edit Student Detail</title>
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

    <div class = "studentform">
        <h1 class= "formtitle">Student You Want to Edit Information of</h1>
        <?php echo $message; ?>
        <form action = "editStudentDetail.php" method="POST">
            <div class="studentdata">
                <label><strong>Student ID</strong></label>
                <input type="int" name="idEdit" readonly placeholder="XX" value=<?php echo $findId;?>
                
                <label><strong>School Name</strong></label>
                <input type="text" name="schoolEdit" placeholder="XX" value=<?php echo $aSchoolName;?>>

                <label><strong>Grade</strong></label>
                <input type="text" name="gradeEdit" placeholder="XXXXX-XXXXXX-X" value=<?php echo $aGrade;?>>
                
                <label><strong>Percentage</strong></label>
                <input type="int" name="percentEdit" placeholder="XXXXX-XXXXXX-X" value=<?php echo $aPercentage;?>>

                <label><strong>Year</strong></label>
                <input type="int" name="yearEdit1" readonly placeholder="XXXXX-XXXXXX-X" value=<?php echo $aYear;?>>

                <label><strong>Clothing Expense</strong></label>
                <input type="int" name="clothingEdit" placeholder="XXXXX-XXXXXX-X" value=<?php echo $eClothing;?>>

                <label><strong>Education Fee</strong></label>
                <input type="int" name="eduFeeEdit" placeholder="XXXXX-XXXXXX-X" value=<?php echo $eEduFee;?>>

                <label><strong>Food Expense</strong></label>
                <input type="int" name="foodEdit" placeholder="XXXXX-XXXXXX-X" value=<?php echo $eFood;?>>

                <label><strong>Year</strong></label>
                <input type="int" name="yearEdit2" readonly placeholder="XXXXX-XXXXXX-X" value=<?php echo $eYear;?>>
            </div >
                <input type="submit" name="orphanEdit" value="Update">
            </div>
        </form>
        </div>
	
</body>
</html>