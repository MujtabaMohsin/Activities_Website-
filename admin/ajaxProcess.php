<?php

include_once "../config.php";

if($_GET['changeStatus'] != null && $_GET['value'] != null){

    $id = $_GET['changeStatus'];
    $value = $_GET['value'];

    $statusNumber = 1;

    if($value == "Approved")
        $statusNumber = 1;

    else if($value == "Rejected")
        $statusNumber = 2;

    $sql_activity = "UPDATE activities SET status='$statusNumber' WHERE id='$id'";

    $query_activity = mysqli_query($connect,$sql_activity);

    if($query_activity){

        echo "true";

    }else{
        echo "Query Error";
    }

}

?>