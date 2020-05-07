<?php
session_start();
include_once "config.php";

$name = $_POST['name'];
$email = $_POST['email'];
$student_id = $_POST['student_id'];
$password = $_POST['password'];
$phone_number = $_POST['phone_number'];

if($name != ""){
    if($email != ""){
        if($student_id != ""){
            if($password != ""){
                if($phone_number != ""){

                    $sql_user = "SELECT email FROM users WHERE email='$email'";
                    $query_user = mysqli_query($connect, $sql_user);
                    $rows_user = mysqli_num_rows($query_user);

                    if($rows_user < 1){
                        if(strlen($student_id) == 9 && is_numeric($student_id)){
                            if(strlen($password) > 6){

                                $date = date("Y-m-d");

                                $sql = "INSERT INTO users (name,email,student_id,password,phone_number,user_type,date) VALUES ('$name','$email','$student_id','$password','$phone_number',0,$date)";
								
								
								
                                $query = mysqli_query($connect, $sql);

								
									
									
                                if($query){
                                $sql_last_row = "SELECT id FROM users ORDER BY id desc";
                                $query_last_row = mysqli_query($connect,$sql_last_row);
                                $row_last_row = mysqli_fetch_array($query_last_row);
                                $newID = $row_last_row['id'];

                                if($query_last_row){

                                    $_SESSION['id'] = $newID;
                                    $_SESSION['email'] = $email;
                                    $_SESSION['user_type'] = 0;

                                    if($_SESSION['id'] && $_SESSION['email']){
                                        echo true;
                                    }
                                }else{
                                    echo "error occured in getting last row";
                                }

                                }else{
                                    echo "error occured in insertion";
                                }
                            }else{
                                echo "Password length should be more than 6";
                            }
                        }else{
                            echo "The student id number should be 9 digits";
                        }
                    }else{
                        echo "This email exists try another one.";
                    }
                }else{
                    echo "Phone number is required";
                }
            }else{
                echo "You should enter the password";
            }

        }else{
            echo "You should enter the student id";
        }


    }else{
        echo "You should enter you email";
    }


}else{
    echo "You should enter your name";
}


?>
