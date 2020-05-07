<?php
session_start();

include_once "config.php";

$activity_id = $_GET['id'];
$user_id = $_SESSION['id'];

if(!isset($_SESSION['id']) || !isset($_SESSION['email'])){
    header("Location: index.php");
    die();
}

$sql_requests = "SELECT * FROM participation_requests WHERE activity_id='$activity_id' && requester_id='$user_id'";
$query_requests = mysqli_query($connect, $sql_requests);

$rows = mysqli_num_rows($query_requests);

if($rows < 1){

    $sql = "INSERT INTO participation_requests (activity_id,requester_id,status) VALUES ('$activity_id','$user_id','0')";

    $query = mysqli_query($connect,$sql);

    if($query){

        header("Location: user/manageMyRequests.php");

    }else{
        echo "Error occured !";
    }

}else{
    echo "You requested this activity previously !";
}

?>