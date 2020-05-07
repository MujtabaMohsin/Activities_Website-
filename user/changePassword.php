<?php
include_once "../page/user_header.php";
include_once "../config.php";
?>

<?php 
if($_SERVER['REQUEST_METHOD'] == 'POST'){


    $current = $_POST['current'];
    $new1 = $_POST['new1'];
    $new2 = $_POST['new2'];

    $user_id = $_SESSION['id'];


    $sql = "SELECT password FROM users WHERE id = $user_id";

    $query = mysqli_query($connect, $sql);

    while($row = mysqli_fetch_array($query)){

        $old_pass = $row['password'];
    }


    if( $current == $old_pass){


        if( $new1 == $new2 ){


            if( strlen($new1) > 6){


                //if all rules are ok

                $sql = "UPDATE users SET password=$new1 WHERE id=$user_id";

                if (mysqli_query($connect, $sql)) {
                    echo '<div class="alert alert-success"><strong>Success!</strong> Password is updated successfuly</div>';
                } else {
                    echo "Error updating record: " . mysqli_error($connect);
                }


            }

            else{

                echo '<div class="alert alert-danger"><strong>Warning! </strong>New password should be more than 6 digits</div>';
            }

        }
        else{

            echo '<div class="alert alert-danger"><strong>Warning! </strong>Repeat password is incorrect</div>';


        }
    }
    else{

        echo '<div class="alert alert-danger"><strong>Warning! </strong> Current password is incorrect</div>';

    }


}

?>



<div id="offerActivityContainer" class="col-sm-9">


    <h1 style="text-align: center; padding: 10px">Change Password</h1>






    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">



        <br>

        <div class="form-group">
            <label class="control-label col-sm-2" for="name"><strong>Current Password:</strong></label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="name" placeholder="Current Password" name="current">
            </div>
        </div>

        <br>

        <div class="form-group">
            <label class="control-label col-sm-2" for="name"><strong>New Password:</strong></label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="name" placeholder="New Password" name="new1">
            </div>
        </div>

        <br>

        <div class="form-group">
            <label class="control-label col-sm-2" for="name"><strong>Repeat Password:</strong></label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="name" placeholder="New Password" name="new2">
            </div>
        </div>

        <br>



        <div class="form-group">        
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>



</div>

</div>






<?php
    include_once "../page/user_footer.html";
?>



<script> 






</script> 


</body>


</html> 