<?php
include_once 'config.php';
$message = "";
$searchqueryparameter = $_GET['appId'];
$searchquerytabletype = $_GET['type'];
if($searchquerytabletype == 'sponsor'){
  $sqlQuery = "SELECT * FROM `sponsor_application` WHERE sponAppID = $searchqueryparameter";
  if($queryRun = $conn->query($sqlQuery))
  {
    $dataRow = mysqli_fetch_array($queryRun);
    $statusUpdate = "Rejected";
    if($dataRow['income'] >= 40000){
      $statusUpdate = 'Approved';
      
    }
    $sql = "UPDATE sponsor_application SET `status` ='$statusUpdate' WHERE sponAppID =$searchqueryparameter";
    if ($dataRow['status'] == 'Approved')
    {
      $type_ = 'Application';
      $title = '';
      $doe = ' ';
      $eventId = ' ';
      $notfMessage = 'Message=New event '.$title.' is arriving at '.$doe.' Grab your seat!&eventid='.$eventId;
      $id_ = $dataRow['sponAppID'];
      $sq = "INSERT INTO `sponsor_notifications` (`type`,`message`,`id`) VALUES('$type_','$notfMessage','$id_')";
      if($sq)
      {
        echo "Notification added; ";
      }
      else
      {
        echo " Notification Not added";
      }
    }
    
    if (mysqli_query($conn,$sql)) {
      header('Location:approve_application.php');
    } else {
      echo "Error updating record: " . mysqli_error($conn);
    }
  }











  if($searchquerytabletype == 'guardian')
  {
    $sqlQuery = "SELECT * FROM `guardian_application` WHERE guardAppID = $searchqueryparameter";
  if($queryRun = $conn->query($sqlQuery))
  {
    $dataRow = mysqli_fetch_array($queryRun);
    $statusUpdate = "Rejected";
    if ($dataRow['income']>=40000)
    {
      $statusUpdate = "Approved";
      $sql = "UPDATE guardian_application SET `status` ='$statusUpdate' WHERE guardAppID =$searchqueryparameter";

    }
    $sql = "UPDATE guardian_application SET `status` ='$statusUpdate' WHERE guardAppID =$searchqueryparameter";
    if ($statusUpdate == 'Approved')
    {
      $type_ = 'Application';
      $message_ = 'Message= Your Application has been approved';
      $id_ = $dataRow['guardAppID'];
      $sq = "INSERT INTO `guardian_notifications` (`type`,`message`,`id`) VALUES('$type_','$message_','$id_')";
      if($sq)
      {
        echo "Notification added; ";
      }
      else
      {
        echo "Error updating Not: " . mysqli_error($conn);
      }
    }

    
  }
  
if (mysqli_query($conn,$sql)) {
      header('Location:approve_application.php');
    } else {
      echo "Error updating record: " . mysqli_error($conn);
    }}}
?>