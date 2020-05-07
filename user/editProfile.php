<?php
include_once "../page/user_header.php";
include_once "../config.php";

function uploadFile(){
    $currentDir = getcwd();
    $uploadDirectory = "../images/";

    $errors = []; // Store all foreseen and unforseen errors here

    $fileExtensions = ['jpeg','jpg','png']; // Get all the file extensions

    $fileName = $_FILES['fileUp']['name'];
    $fileSize = $_FILES['fileUp']['size'];
    $fileTmpName  = $_FILES['fileUp']['tmp_name'];
    $fileType = $_FILES['fileUp']['type'];
    $fileExtension = strtolower(end(explode('.',$fileName)));

    $uploadPath = $currentDir . $uploadDirectory . basename($fileName); 

    if (isset($_POST['submit'])) {

        if (! in_array($fileExtension,$fileExtensions)) {
            $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
        }

        if ($fileSize > 2000000) {
            $errors[] = "This file is more than 2MB. Sorry, it has to be less than or equal to 2MB";
        }

        if (empty($errors)) {
            $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

            if ($didUpload) {
                return true;
            } else {
                return "An error occurred somewhere. Try again or contact the admin";
            }
        } else {
            foreach ($errors as $error) {
                return $error . "These are the errors" . "\n";
            }
        }
    }

}

if(isset($_POST['submit'])){


    $name = $_POST['n'];
    $studentID = $_POST['sid'];
    $email = $_POST['e'];
    $phone = $_POST['pn'];
    $fileName = $_FILES['fileUp']['name'];
    $user_id = $_SESSION['id'];


    if(!empty($name) && !empty($studentID) && !empty($email) && !empty($phone) ){

        $uplaodResult = uploadFile();

        if($uplaodResult){


            $sql = "UPDATE users SET name='$name' , student_id='$studentID' , phone_number='$phone' ,  email='$email' , profile_image='$fileName' WHERE id=$user_id";


            if (mysqli_query($connect, $sql)) {                        

                echo '<div class="alert alert-success"><strong>Success!</strong> Profile is updated successfuly</div>';

                echo $fileName;



            }else {
                echo "Error updating record: 1" . mysqli_error($connect);
            }




        }else{
            echo $uplaodResult;
        }

    }else{

        echo '<div class="alert alert-danger"><strong>Error!</strong> Nothing should be empty</div>';
    }


}

?>

<?php

$user_id = $_SESSION['id'];


//-------------------

$sql = "SELECT * FROM users WHERE id = $user_id";


$query = mysqli_query($connect,$sql);



while($row = mysqli_fetch_array($query)){




?>

<div id="editProfile" class="col-sm-6">


    <h1 style="text-align: center;margin: 10px;">Edit profile</h1>

    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">

        <div id="userPhoto">
            <img src="../images/account_icon.png" class="img-fluid rounded-circle">
            <input type="file" name="fileUp" id="fileBrowser" style="display:none;"/>
            <label>Click To Change</label>

        </div>

        <div class="form-group">
            <label class="control-label"><strong>Name:</strong></label>
            <div class="">
                <input type="text" value="<?php echo $row['name'];?>" class="form-control" id="name" placeholder="Name" name="n">
            </div>
        </div>

        <br>



        <div class="form-group">
            <label class="control-label" for="name"><strong>Student ID:</strong></label>
            <div class="">
                <input type="text" class="form-control" value="<?php echo $row['student_id'];?>" id="name" placeholder="Student ID" name="sid">
            </div>
        </div>

        <br>

        <div class="form-group">
            <label class="control-label" for="name"><strong>Phone Number:</strong></label>
            <div class="">
                <input type="text" value="<?php echo $row['phone_number'];?>" class="form-control" id="name" placeholder="Phone Number" name="pn">
            </div>
        </div>

        <br>

        <div class="form-group">
            <label class="control-label" for="name"><strong>Email:</strong></label>
            <div class="">
                <input type="email" class="form-control" id="name" value="<?php echo $row['email'];?>" placeholder="Email" name="e">
            </div>
        </div>

        <br>

        <div class="form-group">
            <label class="control-label" for="name"><strong>Change Passowrd:</strong></label>
            <div class="">
                <a href="../user/changePassword.php">Click Here to change password</a>
            </div>
        </div>




        <br>

        <div class="form-group">        
            <input type="submit" name="submit" class="btn btn-primary" value="Save">
        </div>
    </form>

    <?php
                                        }



    ?>



</div>

</div>






<?php
include_once "../page/footer.html";

?>

</body>

<script>


    $(document).ready(function(){

        $("#userPhoto img").click(function() {
            $("#fileBrowser").click();
        });

        $("#fileBrowser").change(function(){

            readURL(this);

        })

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#userPhoto img').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }


    })


</script>


</html> 