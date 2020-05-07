<?php
include_once "page/header.php";
include_once "config.php";
$activity_id = $_GET['id'];

$sql = "SELECT * FROM activities WHERE id='$activity_id'";

$query = mysqli_query($connect,$sql);

$row = mysqli_fetch_array($query);

$rows = mysqli_num_rows($query);

if($rows < 1){
    echo "<div class='badge-info' style='width:80%; margin-top:20px;margin-right:auto;margin-left:auto;text-align: center;padding: 10px;font-size: 32px;border-radius: 20px;'>There is no such activity with this id number</div>";

    die();
}
?>

<div id="activityDetails" class="row-sm-12">


    <div id="details" class="col-sm-12 col-md-8 col-lg-10">

        <h3><?php echo $row['title'];?></h3>

        <p><?php echo $row['description'];?></p>

        <div class="accessDetails">
            <ul>
                <li>Date : <?php echo $row['date'];?></li>
                <li>Time : <?php echo $row['time'];?></li>
                <li>Place : <?php $place=strlen($row['place'])>=5?$row['place']:"Building ".$row['place']; echo $place;?></li>
            </ul>
        </div>

        <div><a href="participateProcess.php" class="card-link btn btn-success">Participate</a></div>

    </div>

    <div id="ownerDetails" class="col-sm-12 col-md-4 col-lg-2">

        <h5>Organizer Details</h5>

        <?php 

        $user_id = $row['user_id'];

        $sql_user = "SELECT * FROM users WHERE id='$user_id'";
        $query_user = mysqli_query($connect,$sql_user);

        $row_user = mysqli_fetch_array($query_user);

        $profile_image = $row_user['profile_image'];

        if($profile_image != ""){
        ?>

        <img src="images/<?php echo $profile_image;?>">

        <?php
        }else{
        ?>
        <img src="images/account_icon.png" class="img-fluid rounded-circle">
        <?php
        }
        ?>
        <h4 id="name"><?php echo $row_user['name'];?></h4>
        <h3 id="name"><?php echo $row_user['email'];?></h3>
    </div>

</div>

<div id="comments"  class="comments">

    <?php

    if(isset($_SESSION['id']) && isset($_SESSION['email'])){

        if(isset($_POST['submitComment'])){


            if($_POST['commentContent'] != ""){

                if($_POST['rating'] != 0){

                    $userID = $_SESSION['id'];
                    $commentContent = $_POST['commentContent'];
                    $activityID = $_GET['id'];


                    $rating = $_POST['rating'];


                    $sql = "INSERT INTO comments (commenter_id,activity_id,content,review) VALUES ('$userID','$activityID','$commentContent','$rating')";

                    $query = mysqli_query($connect,$sql);

                    if($query){
                        echo "<h4 class='errorMessage'>* Comment is inserted</h4>";
                    }else{
                        echo "<h4 class='errorMessage'>* Error occured</h4>";
                    }

                }else{
                    echo "<h4 class='errorMessage'>* The rating required</h4>";
                }

            }else{
                echo "<h4 class='errorMessage'>* You should write some comment</h4>";
            }

        }

    ?>

    <form id="addCommentForm" method="post" action="<?php echo $_SERVER['PHP_SELF']."?id=".$_GET['id'];?>">


        <h3>Add Review</h3>
        <textarea name="commentContent" placeholder="Enter you comment .."></textarea>
        <label style="margin: 2px;">How was the activity ? </label>
        <strong>bad</strong>
        <span id="star1" class="fa fa-star"></span>
        <span id="star2" class="fa fa-star"></span>
        <span id="star3" class="fa fa-star"></span>
        <span id="star4" class="fa fa-star"></span>
        <span id="star5" class="fa fa-star"></span> <strong>Excellent</strong>
        <input type="hidden" value="0" name="rating" id="rating"/>
        <input type="submit" name="submitComment" value="add" class="card-link btn btn-success" />
    </form>

    <?php

    }else{
    ?>
    <div id="loginMessage" class="badge badge-info col-sm-12">You should login to add review</div>

    <?php
    }

    $activityID = $_GET['id'];
    $sql_comment = "SELECT * FROM comments WHERE activity_id = $activityID" ;
    $query_comment = mysqli_query($connect,$sql_comment);

    $rows = mysqli_num_rows($query_comment);

    if($rows > 0){

    ?>

    <h3>Comments</h3>

    <?php

        while($row_comment = mysqli_fetch_array($query_comment)){

            $commenter_id = $row_comment['commenter_id']; 

            $sql_commenter = "SELECT * FROM users WHERE id='$commenter_id'";
            $query_commenter = mysqli_query($connect,$sql_commenter);
            $row_commenter = mysqli_fetch_array($query_commenter);

    ?>
    <div class="comment">

        <h6 class="commenterDetails">Name : <?php echo $row_commenter['name'];?> <br>Rating: <?php echo $row_comment['review'];?> out of 5 </h6>
        <p><?php echo $row_comment['content'];?></p>
    </div>

    <?php      
        }
    }
    ?>

</div>


</div>


<?php
include_once "page/footer.html";
?>


</body>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="bootstrap.js"></script>

<script src="js/jquery.js"></script>

<script src="js/script.js"></script>

<script>

    $(document).ready(function(){

        $("#star1").click(function(){
            $(this).css({"color":"orange"});
            $("#star2").css({"color":"#212529"});
            $("#star3").css({"color":"#212529"});
            $("#star4").css({"color":"#212529"});
            $("#star5").css({"color":"#212529"});

            $("#rating").val(1);
        });

        $("#star2").click(function(){
            $("#star1").css({"color":"orange"});
            $(this).css({"color":"orange"});
            $("#star3").css({"color":"#212529"});
            $("#star4").css({"color":"#212529"});
            $("#star5").css({"color":"#212529"});

            $("#rating").val(2);
        });

        $("#star3").click(function(){
            $("#star1").css({"color":"orange"});
            $("#star2").css({"color":"orange"});
            $(this).css({"color":"orange"});
            $("#star4").css({"color":"#212529"});
            $("#star5").css({"color":"#212529"});

            $("#rating").val(3);
        });

        $("#star4").click(function(){
            $("#star1").css({"color":"orange"});
            $("#star2").css({"color":"orange"});
            $("#star3").css({"color":"orange"});
            $(this).css({"color":"orange"});
            $("#star5").css({"color":"#212529"});

            $("#rating").val(4);
        });

        $("#star5").click(function(){
            $("#star1").css({"color":"orange"});
            $("#star2").css({"color":"orange"});
            $("#star3").css({"color":"orange"});
            $("#star4").css({"color":"orange"});
            $(this).css({"color":"orange"});

            $("#rating").val(5);
        });

    })

</script>


</html>