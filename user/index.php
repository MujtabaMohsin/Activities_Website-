<?php
include_once "../page/user_header.php";
include_once "../config.php";
?>


<div id="adminStatistics" >

	<br>


	<h2>Welecom Back User</h2>
	<br>
	<h3>My Statistics</h3>

	<br>

    
    <?php
    
    $user_id = $_SESSION['user_id'];
    $sql_activity = "SELECT * FROM activities WHERE user_id='$user_id'";
    $query_activity = mysqli_query($connect,$sql_activity);
    $rows_activity = 0;
    if($query_activity){
        $rows_activity = mysqli_num_rows($query_activity);
    }
    
    $sql_requests = "SELECT * FROM participation_requests WHERE requester='$user_id' && status='1'";
    $query_requests = mysqli_query($connect,$sql_requests);
    $rows_requests = 0;
    if($query_requests){
        $rows_requests = mysqli_num_rows($query_requests);
    }
    
    $sql_reviews = "SELECT * FROM comments WHERE commenter_id='$user_id'";
    $query_reviews = mysqli_query($connect,$sql_reviews);
    $rows_reviews = 0;
    if($query_reviews){
        $rows_reviews = mysqli_num_rows($query_reviews);
    }
?>
	<table align="center" style="text-align: left;" class="table table-striped col-sm-12 col-md-6 col-lg-4">
		<tbody>
			<tr>
				<th scope="col">My activities</th>
				<td class="badge badge-info"><?php echo $rows_activity;?></td>
			</tr>

			<tr>
				<th scope="col">My participations in others' activities</th>
				<td class="badge badge-info"><?php echo $rows_requests;?></td>
			</tr>

			<tr>
				<th scope="col">My reviews</th>
				<td class="badge badge-info"><?php echo $rows_reviews;?></td>
			</tr>

		</tbody>
	</table>
	<br>
	<br>

	<h3>Recent Activites</h3>
 
	<div id="activities" >

		<?php

		$sql = "SELECT * FROM activities";

		$query = mysqli_query($connect, $sql);

		while($row = mysqli_fetch_array($query)){

			$activity_id = $row['id'];

			$statusText = "Pending";
			switch($row['status']){
				case 1: $statusText = "Approved";break;
				case 2: $statusText = "Rejected";break;
			}

		?>

		<div id="activityCard" class="activityCard card col-sm-10 col-lg-5">
			<div class="card-body">
				<h5 class="card-title"><?php echo $row['title'];?></h5>
				<p class="card-text"><?php echo $row['description'];?></p>
				<div class="accessDetails">
					<ul>
						<span>
							<li>Date : <span class="value"><?php echo $row['date'];?></span></li>
							<li>Time : <span class="value"><?php echo $row['time'];?></span></li>
							<li>Place : <span class="value"><?php $place=strlen($row['place'])>=5?$row['place']:"Building ".$row['place']; echo $place;?></span></li>
							<li>Status : <span class="value"><?php echo $statusText;?></span></li>
						</span>
					</ul>

					<?php

			if($row['status'] == 1){

				$sql_requests = "SELECT * FROM participation_requests WHERE activity_id='$activity_id'";
				$query_requests = mysqli_query($connect, $sql_requests);

				if($query_requests){
					$participants = 0;
					$waiting_requests = 0;
					while($row_requests = mysqli_fetch_array($query_requests)){

						if($row_requests['status'] == 1)
							$participants++;


						if($row_requests['status'] == 0)
							$waiting_requests++;

					}

					?>
					<div>
						<span class="badge badge-info">Participants : <?php echo $participants;?></span>
						<span class="badge badge-info">Waiting Requests : <?php echo $waiting_requests;?></span>
					</div>

					<?php
				}else{
					echo "Error: Requests informatio is not retrieved";
				}
			}
					?>

				</div>
				<a href="../activityDetails.php?id=<?php echo $row['id'];?>"><button  class="btn btn-info" >Read More</button></a>
				<?php
			if($row['status'] == 1){
				?>
				<a href="editActivity.php?id=<?php echo $row['id'];?>"><button  class=" btn btn-primary " style="width: 81px">Edit</button></a>
				<button  class="removeActivity btn btn-danger">Remove</button>
				<a href="checkUsersRequests.php"><button  class=" btn btn-secondary">Requests</button></a>
				<?php
			}else if($row['status'] == 2){
				?>
				<a><button class="btn btn-secondary rejectionReasonBtn" value="<?php echo $row['id'];?>">Why ?</button></a>
				<a href="editActivity.php?id=<?php echo $row['id'];?>"><button  class=" btn btn-primary " style="width: 81px">Edit</button></a>
				<?php
			}
				?>
			</div>
		</div>

		<div id="rejectionReasonMessage<?php echo $row['id'];?>" class="popUpWindow">
			<div id="MessageWindow" class="col-sm-10 col-md-8 col-lg-6">

				<p>
					<?php
			$sql_requests = "SELECT * FROM offering_requests WHERE activity_id='{$row['id']}'";
			$query_requests = mysqli_query($connect,$sql_requests);

			$row_requests = mysqli_fetch_array($query_requests);

			echo $row_requests['description'];

					?>

				</p>


			</div>
		</div>

		<?php
		}
		?>

	</div>

</div>


<?php
include_once "../page/user_footer.html";

?>

<script src="../js/bootstrap.js"></script>

<script> 

	$(document).ready(function() { 
		$(".removeActivity").click(function() { 
			var r = confirm("Are you sure to remove it?");
			if (r == true) {

			}
		}); 
	}); 



	$(document).ready(function(){
		$("#searchBox").on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$(".activityCard .card-title").filter(function() {
				var currentElement = $(this).attr("id");
				$("#activityCard"+currentElement).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		});

		$(".rejectionReasonBtn").click(function(){

			var id = $(this).val();

			$("#rejectionReasonMessage"+id).fadeIn(200);

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


	});


</script> 

</body>

<script src="../js/jquery.js"></script>

<script src="../js/script.js"></script>


</html>