<?php
include_once "page/header.php";
include_once "config.php";
?>

<div class="filterBar">
    <form class="form-group" method="post"><input type="text" class="form-control" placeholder="search for an activity" id="searchBox"></form>
</div>

<div id="activities" >


    <?php

    $sql = "SELECT * FROM activities";
    $query = mysqli_query($connect, $sql);

    $rows = mysqli_num_rows($query);

    if($rows == 0){
        echo "<span style='font-size: 24px' class='badge badge-pill badge-secondary'>There is no activities</span>";

        die();
    }

    if(!$query){
        echo "<span style='font-size: 24px' class='badge badge-pill badge-secondary'>There is no requests for the activities</span>";
    }

    while($row = mysqli_fetch_array($query)){


    ?>
    <div id="activityCard<?php echo $row['id'];?>" class="activityCard card col-md-5">
        <div class="card-body">
            <h5 class="card-title" id="<?php echo $row['id'];?>"><?php echo $row['title'];?></h5>
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
            <a href="activityDetails.php?id=<?php echo $row['id'];?>" class="card-link btn btn-info">Read more</a>
            <a href="manageActivityRequests.html" class="card-link btn btn-success">Participate</a>
        </div>
    </div>

    <?php
    }
    ?>


</div>

<?php
include_once "page/footer.html";
?>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="bootstrap.js"></script>

</body>

<script src="js/jquery.js"></script>

<script src="js/script.js"></script>

<script>

    $(document).ready(function(){

        $("#searchBox").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".activityCard .card-title").filter(function() {
                var currentElement = $(this).attr("id");
                $("#activityCard"+currentElement).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });



    });
</script>



</html>