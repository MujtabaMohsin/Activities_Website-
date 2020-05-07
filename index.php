<?php
include_once "page/header.php";
include_once "config.php";
?>

<div id="main_slide_bar" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100 img-fluid" src="images/slide_bar_1.jpg" alt="First slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100 img-fluid" src="images/slide_bar_2.jpg" alt="Second slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100 img-fluid" src="images/slide_bar_3.jpg" alt="Third slide">
        </div>
    </div>
    <a class="carousel-control-prev" href="#main_slide_bar" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#main_slide_bar" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>


<p id="intro">
    Our goal is to increase the engagment for activities among the students <br>
    We help you find activities , search for activities , offer activities , and many more in few steps</p>

<?php
if(isset($_SESSION['id']) && isset($_SESSION['email'])){

?>
<style>
    #loginForm, #registerForm{
        display: none;
    }
</style>
<?php
}
?>

<div id="formContainer">
    <form id="loginForm" class="col-sm-12 col-md-8 col-lg-6" method="post">
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" name="email" placeholder="Enter email">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" name="password" placeholder="Password">
        </div>

        <input type="submit" name="submit" value="Login" class="form-control btn btn-primary">
        <h6 id="registerWindowBtn" class="form-control btn btn-success">You don't have an account ? register</h6>
    </form>


    <form id="registerForm" class="col-sm-12 col-md-8 col-lg-6" method="post" >
        <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" id="nameInput" name="name" placeholder="Enter your first and last name">
        </div>
        <div class="form-group">
            <label>Email address</label>
            <input type="email" class="form-control" id="emailInput" name="email" aria-describedby="emailHelp" placeholder="Enter your email">
        </div>
        <div class="form-group">
            <label>Student ID</label>
            <input type="number" class="form-control" id="emailInput" name="student_id" aria-describedby="emailHelp" placeholder="Enter your student id">
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" id="passwordInput" name="password" placeholder="should be at leat 6 letters">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Phone Number</label>
            <input type="number" class="form-control" id="phoneNumberInput" name="phone_number" placeholder="05XXXXXXXX">
        </div>

        <input type="submit" value="Register" name="submitRegister" class="form-control btn btn-primary" />
        <h6 id="loginWindowBtn" class="form-control btn btn-success">Login</h6>
    </form>
</div>



<div id="recentActivities" >

    <h2>Recent Activities</h2>

    <?php

    $sql = "SELECT * FROM activities WHERE status='1'";
    $query = mysqli_query($connect, $sql);

    $rows = mysqli_num_rows($query);

    if($rows == 0){
        echo "<br><br><span style='font-size: 32px; font-weight: normal;' class='badge badge-secondary'>There is no activities available now</span><br><br>";

    }

    while($row = mysqli_fetch_array($query)){


    ?>
    <div class="activityCard card col-md-5">
        <div class="card-body">
            <h5 class="card-title"><?php echo $row['title'];?></h5>
            <p class="card-text"><?php echo $row['description'];?></p>
            <div class="accessDetails">
                <ul>
                    <span>
                        <li>Date : <span class="value"><?php echo $row['date'];?></span></li>
                        <li>Time : <span class="value"><?php echo $row['time'];?></span></li>
                        <li>Place : <span class="value"><?php $place=strlen($row['place'])>=5?$row['place']:"Building ".$row['place']; echo $place;?></span></li>
                    </span>
                </ul>
            </div>
            <a href="activityDetails.php?id=<?php echo $row['id'];?>" class="card-link btn btn-info">Read more</a>
            <?php
        if(isset($_SESSION['id']) && isset($_SESSION['email']) && isset($_SESSION['user_type']) && $_SESSION['user_type'] == 0){
            ?>
            <a href="participateProcess.php?id=<?php echo $row['id'];?>" class="card-link btn btn-success">Participate</a>

            <?php
        }
            ?>
        </div>
    </div>

    <?php
    }
    ?>

</div>

</div>

<?php
include_once "page/footer.html";
?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="bootstrap.js"></script>

</body>

<script src="js/jquery.js"></script>

<script src="js/script.js"></script>

<script>

    $(document).ready(function(){

        $("#registerForm").submit(function(){

            $.post("registerProcess.php",$(this).serialize(),function(data){

                if(data == true){
                    window.location.href = "user/index.php";
                }else{
                    $(".error_message").remove();
                    $("#registerForm").append("<div class='badge badge-danger error_message'>"+data+"</div>");
                }

            });
            return false;
        });

        $("#loginForm").submit(function(){

            $.post("loginProcess.php",$(this).serialize(),function(data){

                if(data == "user"){
                    window.location.href = "user/index.php";
                }else if(data == "admin"){
                    window.location.href = "admin/index.php";
                }else{
                    $(".error_message").remove();
                    $("#loginForm").append("<div class='badge badge-danger error_message'>"+data+"</div>");
                }

            });
            return false;
        });



    })



</script>

</html>