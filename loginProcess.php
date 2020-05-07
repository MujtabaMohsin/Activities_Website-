<?php
session_start();

include_once "config.php";

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email='$email' && password='$password'";

$query = mysqli_query($connect,$sql);

if($query){

    $row = mysqli_fetch_array($query);
    $rows = mysqli_num_rows($query);

    if($rows == 1){

        $user_id = $row['id'];

        $_SESSION['id'] = $user_id;
        $_SESSION['email'] = $email;

        if($row['user_type'] == 1){
            $_SESSION['user_type'] = 1;
            echo "admin";
        }else{
            $_SESSION['user_type'] = 0;
            echo "user";
        }


    }else{
        echo "email or password is wrong , try again";
    }

}else{
    echo "Error occured";
}

