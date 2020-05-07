<?php
ob_start();
include_once "../page/admin_header.php";
include_once "../config.php";
?>

<div id="manageUsers">

	<h2>Manage Users</h2>

	<?php

	$sql = "SELECT * FROM users WHERE user_type='0' || user_type='2' order by id desc";
	$query = mysqli_query($connect,$sql);

	if($query){

		$rows = mysqli_num_rows($query);

		if($rows < 1){
			echo "<span style='font-size:24px;margin-top: 20px;' class='badge badge-pill badge-info'>There is no users</span>";
		}
	?>

	<table class="table col-lg-10">
		<thead width="100%;" class="thead-dark">
			<tr>
				<th scope="col">#</th>
				<th scope="col">Student ID No.</th>
				<th scope="col">Name</th>
				<th scope="col">Phone No.</th>
				<th scope="col">Status</th>
				<th scope="col">Operation</th>
			</tr>
		</thead>

		<?php

		while($row = mysqli_fetch_array($query)){
			$statusText = "";
			switch($row['user_type']){
				case 0: $statusText = "Active";break;
				case 1: $statusText = "Admin";break;	
				case 2: $statusText = "Blocked";break;
			}


			$opreationText = "";
			switch($row['user_type']){
				case 0: $opreationText = "Block";break;
				case 1: $opreationText = "";break;	
				case 2: $opreationText = "Activate";break;

			}
			$number++;

		?>
		<tbody>
			<tr>
				<th scope="row"><?php echo $GLOBALS['number'];?></th>

				<td><?php echo $row['student_id'];?></td>
				<td><?php echo $row['name'];?></td>
				<td><?php echo $row['phone_number'];?></td>
				<td><?php echo $statusText;?></td>


				<td><?php if($row['user_type'] == 2){ ?>
					<a href="?activate=<?php echo $row['id'] ;?>" class="btn btn-primary">Activate</a>  <?php }else{ ?>
					<a href="?block=<?php echo $row['id'] ;?>" class="btn btn-primary">Block</a>
					<?php } ?>
					<a href="?delete=<?php echo $row['id'] ;?>" class="btn btn-danger">Delete</a></td>


			</tr>


		</tbody>
		<?php

		}

	}else{
		echo "Problem in retrieving users";
	}

	if(isset($_GET['delete'])){

		$user_id = $_GET['delete'];

		$sql = "DELETE FROM users WHERE id='$user_id'";
		$query = mysqli_query($connect,$sql);

		if($query){
			header("Location: ".$_SERVER['PHP_SELF']);
		}
		else {
			echo "Error occured !";
		}

	}


	if(isset($_GET['block'])){

		$user_id = $_GET['block'];

		$sql2 = "SELECT user_type FROM users WHERE id = $user_id ";
		$query2 = mysqli_query($connect,$sql2);
		$row2 = mysqli_fetch_array($query2);

		if( $row2['user_type'] == 0 ){
			$sql = "UPDATE users SET user_type = '2' WHERE id='$user_id'";
		}
		else if($row2['user_type'] == 2){
			$sql = "UPDATE users SET user_type = 0 WHERE id='$user_id'";

		}

		$query = mysqli_query($connect,$sql);

		if($query){
			header("Location: ".$_SERVER['PHP_SELF']);
		}
		else{
			echo "Error occured !";
		}

	}


	if(isset($_GET['activate'])){

		$user_id = $_GET['activate'];

		$sql = "UPDATE users SET user_type='0' WHERE id='$user_id'";
		$query = mysqli_query($connect,$sql);

		if($query){
			header("Location: ".$_SERVER['PHP_SELF']);
		}else{
			echo "There is problem in activating the user";
		}

	}

		?>
	</table>




</div>




<?php
include_once "../page/user_footer.html";
?>



<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="bootstrap.js"></script>

</body>

<script src="../js/jquery.js"></script>

<script src="../js/script.js"></script>


