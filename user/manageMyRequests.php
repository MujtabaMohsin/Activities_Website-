<?php
include_once "../page/user_header.php";
include_once "../config.php";
?>

<div id="offerContainer">
    <br>
    <h3 style="text-align: center">Participation Requests</h3>
    <br>
    <h4 style="text-align: center">Your requests for participation in activities</h4>

    <table id="participationRequestsTable" class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Activity Title</th>
                <th scope="col">Date</th>
                <th scope="col">Time</th>
                <th scope="col">Organizer Name</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $user_id = $_SESSION['id'];
            $sql_request = "SELECT * FROM participation_requests WHERE requester_id='$user_id'";
            $query_request = mysqli_query($connect,$sql_request);
            $rows = mysqli_num_rows($query_request);
            $count = 0;


            while($row_request = mysqli_fetch_array($query_request)){

                $count++;
                if($count <= $rows){

                    $activity_id = $row_request['activity_id'];
                    $sql_activity = "SELECT * FROM activities WHERE id='$activity_id'";
                    $query_activity = mysqli_query($connect,$sql_activity);
                    $row_activity = mysqli_fetch_array($query_activity);

                    $organizer_id = $row_activity['user_id'];

                    $sql_user = "SELECT name FROM users WHERE id='$organizer_id'";
                    $query_user = mysqli_query($connect,$sql_user);
                    $row_user = mysqli_fetch_array($query_user);

                    $status = "";

                    switch($row_request['status']){
                        case 0: $status = "Pending";break;
                        case 1: $status = "Approved";break;
                        case 2: $status = "Rejected";break;
                        default: $status = "Pending";break;
                    }
            ?>
            <tr>
                <th scope="row"><?php echo $count;?></th>
                <td><?php echo $row_activity['title'];?></td>
                <td><?php echo $row_activity['date'];?></td>
                <td><?php echo $row_activity['time'];?></td>
                <td><?php echo $row_user['name'];?></td>
                <td><?php echo $status;?></td>
            </tr>
            <?php
                }
            }

            ?>
        </tbody>
    </table>





</div>

</div>






<?php
include_once "../page/footer.html";
?>


<script> 

    $(document).ready(function() { 
        $(".removeActivity").click(function() { 
            var r = confirm("Are you sure to remove it?");
            if (r == true) {

            }
        }); 
    }); 

</script>


</body>


</html> 