<?php

include_once "../config.php";


if($_GET['reject'] != null){

$request_id = $_GET['reject'];

$sql_requests = "UPDATE participation_requests SET status='2' WHERE id='$request_id'";
$query_request = mysqli_query($connect, $sql_requests);

if($query_request){
    
    echo true;
    
}else{
    echo "Unable to retrieve participation_requests data";
}
    
}

if($_GET['accept'] != null){

$request_id = $_GET['accept'];

$sql_requests = "UPDATE participation_requests SET status='1' WHERE id='$request_id'";
$query_request = mysqli_query($connect, $sql_requests);

if($query_request){
    
    echo true;
    
}else{
    echo "Unable to retrieve participation_requests data";
}
    
}