<?php
include_once "../page/user_header.php";
include_once "../config.php";
?>

<div id="offerContainer" style="text-align:center;">
    <br>
    <h3 style="text-align: center">Check Requests for an Activity:</h3>
    <br>
    <?php
    $activity_id = $_GET['id'];
    $sql_activity = "SELECT title FROM activities WHERE id='$activity_id'";
    $query_activity = mysqli_query($connect, $sql_activity);
    $row_activity = mysqli_fetch_array($query_activity);

    ?>
    <h4 style="text-align: center; color: #007bff"><?php echo $row_activity['title'];?></h4>
    <br> <br>

    <table class="table col-sm-12 col-md-10" style="margin:auto;">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Phone No.</th>
                <th scope="col">Status</th>
                <th scope="col">Accept/Reject</th>
            </tr>
        </thead>
        <tbody>

            <?php

            $sql_requests = "SELECT * FROM participation_requests WHERE activity_id='$activity_id'";
            $query_requests = mysqli_query($connect, $sql_requests);

            $counter = 1;
            if($query_requests){

                while($row_requests = mysqli_fetch_array($query_requests)){

                    $user_id = $row_requests['requester_id'];
                    $sql_users = "SELECT name,phone_number FROM users WHERE id='$user_id'";
                    $query_users = mysqli_query($connect, $sql_users);
                    $row_users = mysqli_fetch_array($query_users);

            ?>
            <tr id="request<?php echo $row_requests['id'];?>">
                <th scope="row"><?php echo $counter++;?></th>
                <td><?php echo $row_users['name'];?></td>
                <td><?php echo $row_users['phone_number'];?></td>
                <td class="status">
                    <?php 
                    if($row_requests['status']==1){
                        echo "<span style='color:green;'>Accepted</span>";
                    }else if($row_requests['status']==2){
                        echo "<span style='color:red;'>Rejected</span>";
                    }else{
                        echo "<span style='color:#333;'>Pending</span>";
                    }
                    ?>
                </td>
                <?php
                    if($row_requests['status'] == 0){
                ?>
                <td><button id="<?php echo $row_requests['id'];?>" class="acceptRequest btn btn-primary btn-sm" >Acccept</button>

                    <button id="<?php echo $row_requests['id'];?>" class="removeRequest btn btn-danger btn-sm">Reject</button></td>
                <?php
                    }else{
                ?>
                <td></td>
                <?php
                    }
                ?>
            </tr>
            <?php
                }
            }
            ?>

        </tbody>
    </table>


    <?php 

    if($query_requests){
        $rows_requests = mysqli_num_rows($query_requests);

        if($rows_requests == 0){
            echo "<div class='badge badge-info' >There is no requests for this activity</div>";
        }

    }
    ?>





</div>

</div>






<?php
include_once "../page/user_footer.html";
?>


<script> 

    $(document).ready(function() { 

        $(".removeRequest").click(function() { 
            var r = confirm("Do you  want to reject the request ?");
            if (r == true) {

                $request_id = $(this).attr("id");
                $.get("processRequest.php?reject="+$request_id,function(data){

                    if(data == true){

                        $("tr#request"+$request_id+" td.status").html("<span style='color:red;'>Rejected</span>");

                    }else{
                        alert(data);
                    }

                })

            }
        }); 

        $(".acceptRequest").click(function() { 
            var r = confirm("Do you  want to accept the request ?");
            if (r == true) {

                $request_id = $(this).attr("id");
                $.get("processRequest.php?accept="+$request_id,function(data){

                    if(data == true){

                        $("tr#request"+$request_id+" td.status").html("<span style='color:green;'>Accepted</span>");

                    }else{
                        alert(data);
                    }

                })

            }
        }); 

    }); 

</script>


</body>


</html> 