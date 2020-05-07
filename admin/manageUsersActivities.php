<?php
include_once "../page/admin_header.php";
include_once "../config.php";
?>


<div id="requestsFilter" class="filterBar">
    <form class="form-group" method="post"><input type="text" class="form-control" placeholder="search for an activity" id="searchBox"></form>
</div>

<div id="recentActivities" >

    <h3>Activities</h3>
    <h4>Sorted by most recently added activities</h4>

    <?php

    $sql = "SELECT * FROM activities";
    $query = mysqli_query($connect,$sql);
    $rows = mysqli_num_rows($query);

    if($rows < 1){
        echo "<span style='font-size:24px;margin-top: 20px;' class='badge badge-pill badge-info'>There is no activities</span>";
    }

    while($row = mysqli_fetch_array($query)){

        $statusText = "Pending";
        switch($row['status']){
            case 1: $statusText = "Approved";break;
            case 2: $statusText = "Rejected";break;
        }

    ?>

    <div id="activityCard<?php echo $row['id'];?>" class="activityCard card col-sm-10 col-md-5">
        <div class="card-body">
            <h5  class="card-title"><?php echo $row['title'];?></h5>
            <p class="card-text"><?php echo $row['description'];?></p>
            <div class="accessDetails">
                <ul>
                    <span>
                        <li>Date : <span class="value"><?php echo $row['date'];?></span></li>
                        <li>Time : <span class="value"><?php echo $row['time'];?></span></li>
                        <li>Place : <span class="value"><?php $place=strlen($row['place'])>=5?$row['place']:"Building ".$row['place']; echo $place;?></span></li>
                        <li>Status : <span class="value">
                            <select class="status form-control" id="<?php echo $row['id'];?>">
                                <option value="Approved" <?php if($statusText == "Approved")echo "selected='selected'"?>>Approved</option>
                                <option value="Rejected" <?php if($statusText == "Rejected")echo "selected='selected'"?>>Rejected</option>
                            </select>
                            
                            </span></li>
                    </span>
                </ul>
            </div>
            <a href="../activityDetails.php?id=<?php echo $row['id'];?>" class="card-link btn btn-info">Read More</a>
            <a href="editActivity.php?id=<?php echo $row['id'];?>" class="card-link btn btn-success">Edit</a>
            <a href="?delete=<?php echo $row['id'];?>" class="card-link btn btn-danger">Delete</a>
        </div>
    </div>

    <?php

    }

    if(isset($_GET['delete'])){

        $activity_id = $_GET['delete'];

        $sql = "DELETE FROM activities WHERE id='$activity_id'";
        $query = mysqli_query($connect,$sql);

        if($query){
            header("Location: ".$_SERVER['PHP_SELF']);
        }else{
            echo "Error occured !";
        }

    }

    ?>

</div>


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

<script>
    
    $(document).ready(function(){
        
        
        $(".status").change(function(){
            
            var id = $(this).attr("id");
            var value = $(this).val();
            
            var currentElement = $(this);
            
            $.get("ajaxProcess.php?changeStatus="+id+"&value="+value,function(data){
                
                
                if(data == "true"){
                    currentElement.after("<h5 style='color:green;'>Status is changed</h5>");
                }else{
                    alert(data);
                }
                
            })
            
            
        });
        
        
    });
    


</script>


</html>