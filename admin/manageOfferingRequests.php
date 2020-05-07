<?php
ob_start();
include_once "../page/admin_header.php";
include_once "../config.php";
?>


<div id="requestsFilter" class="filterBar">
    <form class="form-group" method="post"><input type="text" class="form-control" placeholder="search for an activity" id="searchBox"></form>
</div>

<div id="recentOfferingRequest" >

    <h2>Requests of offering activities</h2>


    <?php

    $sql = "SELECT * FROM activities WHERE status='0'";
    $query = mysqli_query($connect,$sql);

    if(mysqli_num_rows($query) == 0){

        echo "<span style='font-size:24px;margin-top: 20px;' class='badge badge-pill badge-info'>There is no requests</span>";

    }

    while($row = mysqli_fetch_array($query)){
        
        
        
    ?>

    <div class="activityCard card col-sm-10 col-md-5">
        <div class="card-body">
            <h5 id="1" class="card-title"><?php echo $row['title'];?></h5>
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
            <a href="../activityDetails.php?id=<?php echo $row['id'];?>" class="card-link btn btn-info">Read more</a>
            <a href="<?php echo $_SERVER['PHP_SELF'].'?accept_activity='.$row['id'];?>" class="card-link btn btn-success">Accpet</a>
            <a class="card-link btn btn-danger rejectionReasonBtn" style="color:#FFF;">Reject</a>
        </div>
    </div>

    <div id="rejectionReasonMessage" class="popUpWindow">
        <div id="MessageWindow" class="col-sm-10 col-md-8 col-lg-6">
            <h3>Important points to consider</h3>

            <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <input type="text" name="reject_desc" class="form-control" placeholder="Enter the reason for request rejection">
                <input type="submit" name="submit" value="confirm" class="btn btn-primary">
                <input type="hidden" name="activity_id" value="<?php echo $row['id'];?>">
            </form>


        </div>
    </div>


    <?php

    }


    if(isset($_GET['accept_activity'])){

        $activity_id = $_GET['accept_activity'];

        $query = mysqli_query($connect,"UPDATE activities SET status='1' WHERE id='$activity_id'");

        if($query){
            header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);

            echo "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
        }else{
    ?>
    <script>
        alert("There is problem in updating the record");
    </script>
    <?php
        }
    }

    if(isset($_POST['submit'])){

        $activity_id = $_POST['activity_id'];

        $query = mysqli_query($connect,"UPDATE activities SET status='2' WHERE id='$activity_id'");

        $desc = $_POST['reject_desc'];

        $query_requests = mysqli_query($connect,"INSERT INTO offering_requests (activity_id,description) VALUES ('$activity_id','$desc')");

        if($query_requests){

            if($query){
                header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);

            }else{
                echo "Error in updating the status of the activity";
            }

        }else{
            echo "The rejection description is not added";
        }
    }
    ?>



</div>


</div>

<?php
include_once "../page/user_footer.html";
ob_end_flush();
?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="bootstrap.js"></script>


<script>

    $(document).ready(function(){
        
        $(".rejectionReasonBtn").click(function(){

            $("#rejectionReasonMessage").fadeIn(200);

        })

        var overWindow = false;

        $("#MessageWindow").mouseenter(function(){
            overWindow = true;
        });

        $("#MessageWindow").mouseleave(function(){
            overWindow = false;
        });

        $(".popUpWindow").click(function(){
            if(!overWindow){
                $(this).fadeOut(300);
            }
        });


    })
</script>

</body>

<script src="../js/jquery.js"></script>

<script src="../js/script.js"></script>


</html>