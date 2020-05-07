<?php
ob_start();
include_once "../page/user_header.php";
include_once "../config.php";
?>

<div id="offerActivityContainer" class="col-sm-8">


	<h1 style="text-align: center; padding: 10px">Offer New Activity</h1>

	<form method="post" action="<?php $_PHP_SELF ?>">


		<div class="form-group">

			<label class="control-label"><strong>Type of Activity:</strong></label>
			<div class="col-sm-10">


				<?php

				$sql_types = "SELECT * FROM activity_types";
                $query_types = mysqli_query($connect, $sql_types);

                if($query_types){

                    while($row = mysqli_fetch_array($query_types)){

                ?>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="activityType" id="inlineRadio1" value="<?php echo $row['id'];?>">
					<label class="form-check-label" for="inlineRadio1"><?php echo $row['name'];?></label>
				</div>
				<?php
                    }

                }
                ?>


				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="activityType" id="inlineRadio2" value="2">
					<label class="form-check-label" for="inlineRadio2" name="activityType">Other</label>
				</div>

			</div>

		</div>

		<div class="form-group">
			<label class="control-label"><strong>Title :</strong></label>
			<input type="text" class="form-control" id="name" placeholder="Enter a title" name="title">
		</div>


		<div class="form-group">
			<label class="control-label" for="date"><strong>Date:</strong></label>
			<input type="date" class="form-control" id="name" name="date">
		</div>

		<br>

		<div class="form-group">
			<label class="control-label" for="time"><strong>Time:</strong></label>
			<input type="time" class="form-control" id="time" name="time">
		</div>

		<br>

		<div class="form-group">
			<label class="control-label" for="time"><strong>Place:</strong></label>
			<select class="custom-select" name="place">
				<option value="" selected style="display:none">Select a place</option>
				<option value="4">Bulding 4</option>
				<option value="6">Bulding 6</option>
				<option value="11">Bulding 11</option>
				<option value="19">Bulding 19</option>
				<option value="24">Bulding 24</option>
				<option value="39">Bulding 39</option>
				<option value="68">Bulding 68</option>
				<option value="0">other</option>
			</select>
			<input type="text" name="otherPlace" placeholder="Enter place description" class="form-control" style="display:none; margin-top: 10px;">
		</div>

		<div class="form-group">
			<label class="control-label"><strong>Description:</strong></label>
			<div class="md-form">
				<textarea id="form7" class="md-textarea form-control" name="desc" rows="3" placeholder="Briefly describe the activity"></textarea>
			</div>
		</div>

		<p>
			* By submitting the form a request will be sent to an admenistrator for approval
		</p>

		<div class="form-group">
			<button type="submit" name="submit" class="btn btn-primary">Submit The Request</button>
		</div>
	</form>

</div>

</div>


<script src="js/bootstrap.js"></script>


<?php

// When form is submitted

if(isset($_POST['submit'])){

    if($_POST['activityType'] != ""){
        if($_POST['title'] != ""){
            if($_POST['desc'] != ""){
                if($_POST['date'] != ""){
                    if($_POST['time'] != ""){
                        if($_POST['place'] != ""){

                            $activityType = $_POST['activityType'];
                            $title = $_POST['title'];
                            $desc = $_POST['desc'];
                            $date = $_POST['date'];
                            $time = $_POST['time'];
                            $place = $_POST['place'];
                            $user_id = $_SESSION['id'];
                            
							$sql = "INSERT INTO activities (title,description ,date ,time ,place ,type,rating,user_id,status) VALUES ('$title','$desc','$date','$time','$place','$activityType','0','$user_id','0')";
							
							
                            //$query = mysqli_query($connect,);

							
							echo $sql;
							
//                            if($query){
//                                header("Location: manageMyActivities.php");
//                            }else{
//                                echo "Error occured";
//                            }

                        }else{
                            echo "Select the place";
                        }
                    }else{
                        echo "Specity the activity time";
                    }

                }else{
                    echo "Choose a date for the activity";
                }
            }else{
                echo "Enter a breif description for the activity";
            }

        }else{
            echo "Enter a title for the activity";
        }

    }else{
        echo "Select the type of your activity";
    }



}


include_once "../page/user_footer.html";

?>


<script>
	$(document).ready(function() {
		$(".removeActivity").click(function() {
			var r = confirm("Are you sure to remove it?");
			if (r == true) {

			}
		});
	});



	$(document).ready(function() {

		$(document).ready(function() {
			$("#searchBox").on("keyup", function() {
				var value = $(this).val().toLowerCase();
				$(".activityCard .card-title").filter(function() {
					var currentElement = $(this).attr("id");
					$("#activityCard" + currentElement).toggle($(this).text().toLowerCase().indexOf(value) > -1)
				});
			});
		});


		$(".custom-select").change(function() {

			var value = $(this).val();

			if (value == 0) {
				$("input[name='otherPlace']").show();
				$(this).val = $("input[name='otherPlace']").val();
			} else {
				$("input[name='otherPlace']").hide();
			}


		})


	});

</script>


</body>


</html>
