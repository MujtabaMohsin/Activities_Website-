<?php
ob_start();
include_once "../page/user_header.php";
include_once "../config.php";
?>
<div id="offerContainer" class="col-sm-12 col-md-10 col-lg-8" style="margin: auto">

    <?php
    $activity_id = $_GET['id'];
    $sql_activity = "SELECT * FROM activities WHERE id='$activity_id'";
    $query_activity = mysqli_query($connect, $sql_activity);

    if(!$query_activity)
        die("<br><h1>Error: Unable to get activity details</h1>");

    $row_activity = mysqli_fetch_array($query_activity);

    ?>

    <h1 style="text-align: center; padding: 10px">Edit Activity</h1>

    <form class="form-horizontal" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>?id=<?php echo $activity_id;?>">

        <div class="form-group">

            <label class="control-label"><strong>Type of Activity:</strong></label>
            <div class="col-sm-12">
                <?php

                $sql_types = "SELECT * FROM activity_types";
                $query_types = mysqli_query($connect, $sql_types);

                if($query_types){

                    while($row_types = mysqli_fetch_array($query_types)){

                ?>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="type" value="<?php echo $row_types['id'];?>" <?php if($row_activity['type']==$row_types['id'])echo "checked='checked'";?>>
                    <label class="form-check-label" selected="selected" for="inlineRadio1"><?php echo $row_types['name'];?></label>
                </div>
                <?php
                    }
                }
                ?>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                    <label class="form-check-label" for="inlineRadio2">Other</label>
                </div>

            </div>

        </div>

        <br>

        <div class="form-group">
            <label class="control-label" for="name"><strong>Title of Activity:</strong></label>
            <div class="col-sm-12">
                <input type="text" class="form-control" id="name" placeholder="Enter name" name="title" value="<?php echo $row_activity['title'];?>">
            </div>
        </div>

        <br>

        <div class="form-group">
            <label class="control-label" for="date"><strong>Start Date:</strong></label>
            <div class="col-sm-12">
                <input type="date" class="form-control" id="name"  name="date" value="<?php echo $row_activity['date'];?>">
            </div>
        </div>

        <br>

        <br>

        <div class="form-group">
            <label class="control-label" for="time"><strong>Time:</strong></label>
            <div class="col-sm-12">
                <input type="time" class="form-control" id="time" name="time" value="<?php echo $row_activity['time'];?>">
            </div>
        </div>

        <br>

        <div class="form-group">
            <label class="control-label" for="time"><strong>Place:</strong></label>
            <div class="col-sm-12">
                <select class="custom-select place" name="place">
                    <option <?php if($row_activity['place']==4)echo "selected"; ?> value="4">Bulding 4</option>
                    <option <?php if($row_activity['place']==6)echo "selected"; ?> value="6">Bulding 6</option>
                    <option <?php if($row_activity['place']==11)echo "selected"; ?> value="11">Bulding 11</option>
                    <option <?php if($row_activity['place']==19)echo "selected"; ?> value="19">Bulding 19</option>
                    <option <?php if($row_activity['place']==24)echo "selected"; ?> value="24">Bulding 24</option>
                    <option <?php if($row_activity['place']==39)echo "selected"; ?> value="39">Bulding 39</option>
                    <option <?php if($row_activity['place']==68)echo "selected"; ?> value="68">Bulding 68</option>
                    <option <?php if($row_activity['place']==0)echo "selected"; ?> value="0">Other</option>
                </select>

            </div>
            <?php
            if($row_activity['place']==0){
            ?>
            <input type="text" name="place_desc" placeholder="Enter place description" class="form-control" id="otherPlace" style="margin-top: 10px;" value="<?php echo $row_activity['place_desc'];?>">
            <?php
            }
            ?>
        </div>

        <br>


        <div class="form-group">
            <label class="control-label" for="time"><strong>Description:</strong></label>
            <div class="col-sm-12">

                <div class="md-form">
                    <textarea id="form7" name="desc" class="md-textarea form-control" rows="3"><?php echo $row_activity['description'];?></textarea>
                </div>


            </div>
        </div>

        <br>

        <div class="form-group">        
            <div class="col-sm-offset-2 col-sm-12">
                <input type="submit" name="submit" class="btn btn-primary" value="submit">
            </div>
        </div>
    </form>

</div>

</div>

<?php

if(isset($_POST['submit'])){

    $activity_id = $_GET['id'];

    $title = $_POST['title'];
    $desc = $_POST['desc'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $place = $_POST['place'];
    $place_desc = $_POST['place_desc'];
    $type = $_POST['type'];
    $status = 0;

    $sql_update_activity = "UPDATE activities SET title='$title' , description='$desc' , date='$date' , time='$time' , place='$place' , place_desc='$place_desc' , type='$type' , status='$status' WHERE id='$activity_id'";
    $query_update_activity = mysqli_query($connect, $sql_update_activity);

    if($query_update_activity){

        header("Location: manageMyActivities.php");

    }else{
        echo "<h3 style='text-align: center; color:red;'><br>Error: can't edit activity</h3>";
    }



}

include_once "../page/user_footer.html";
?>

<script> 

    $(document).ready(function(){

        $(".removeActivity").click(function() { 
            var r = confirm("Are you sure to remove it?");
            if (r == true) {

            }
        }); 


        $("#searchBox").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".activityCard .card-title").filter(function() {
                var currentElement = $(this).attr("id");
                $("#activityCard"+currentElement).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

        $("select.place").change(function(){

            var value = $(this).val();

            if(value == 0){
                $("#otherPlace").slideDown(400);
            }else{
                $("#otherPlace").slideUp(400);
            }

        })



    });





</script> 


</body>


</html> 