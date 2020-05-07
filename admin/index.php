<?php
include_once "../config.php";
include_once "../page/admin_header.php";
?>


<div id="adminStatistics" >

	<br>

	<h2>Welecom Back Admin</h2>
	<br>
	<h3>Statistics</h3>

	<?php

	$sql_users = "SELECT * FROM users";
	$query_users = mysqli_query($connect,$sql_users);

	$rows_users = 0;
	if($query_users){
		$rows_users = mysqli_num_rows($query_users);
	}

	$today_registered_users = 0;

	while($row_users = mysqli_fetch_array($query_users)){

		$today = date("Y-m-d");

		// echo $today." = ".$row_users['date']."<br>";

		if($today == $row_users['date'])
			$today_registered_users++;   
	}

	$sql_activity = "SELECT * FROM activities";
	$query_activity = mysqli_query($connect,$sql_activity);

	$number_of_activities = 0;
	$number_of_today_activities = 0;
	$numberOfPendingRequests = 0;
	if($query_activity){
		$number_of_activities = mysqli_num_rows($query_activity);
		while($row_activity = mysqli_fetch_array($query_activity)){

			if($row_activity['creation_date'] == date("Y-m-d"))
				$number_of_today_activities++;

			if($row_activity['status'] == 0)
				$numberOfPendingRequests++;

		}
	}

	$sql_requests = "SELECT * FROM requests";
	$query_requests = mysqli_query($connect, $sql_requests);

	$rows_requests = 0;
	if($query_requests){
		$rows_requests = mysqli_num_rows($query_requests);

	}

	$sql_comments = "SELECT * FROM comments";
	$query_comments = mysqli_query($connect, $sql_comments);

	$rows_comments = mysqli_num_rows($query_comments);


	?>


	<br>
	<table align="center" class="table table-striped col-sm-10 col-md-7 col-lg-6">
		<tbody>
			<tr>
				<th scope="col">Total number of users</th>
				<td class="badge badge-info"><?php echo $rows_users;?></td>
			</tr>

			<tr>
				<th scope="col">Number of users registered today</th>
				<td class="badge badge-info"><?php echo $today_registered_users;?></td>
			</tr>

			<tr>
				<th scope="col">Total number of activities</th>
				<td class="badge badge-info"><?php echo $number_of_activities;?></td>
			</tr>

			<tr>
				<th scope="col">Number of today added activities</th>
				<td class="badge badge-info"><?php echo $number_of_today_activities;?></td>
			</tr>

			<tr>
				<th scope="col">Number of requests waiting for approval</th>
				<td class="badge badge-info"><?php echo $numberOfPendingRequests;?></td>
			</tr>

			<tr>
				<th scope="col">Total number of rejected requests</th>
				<td class="badge badge-info"><?php echo $rows_requests;?></td>
			</tr>

			<tr>
				<th scope="col">Total number of reviews</th>
				<td class="badge badge-info"><?php echo $rows_comments;?></td>
			</tr>



		</tbody>
	</table>
	<br>

 
</div>

 

<?php
include_once "../page/user_footer.html";
?>


<script src="../js/bootstrap.js"></script>

</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.js"></script>
<script src="../js/script.js"></script>
<script>

	$(document).ready(function(){

		$('.num').each(function() {
			var $this = $(this), countTo = $this.attr("data-source")

			$({ countNum: $this.text()}).animate({
				countNum: countTo
			},

												 {

				duration: 8000,
				easing:'linear',
				step: function() {
					$this.text(Math.floor(this.countNum));
				},
				complete: function() {
					$this.text(this.countNum);
					//alert('finished');
				}

			});  



		});

	});

</script>


</html>