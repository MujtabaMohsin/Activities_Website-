<?php
include_once "../page/admin_header.php";
include_once "../config.php";
?>


<div id="addActivityTypeContainer" class="col-lg-8">


    <h1>Add New Activity Type</h1>

    <form class="form-group" method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">

        <div>

            <input type="text" name="new_type" class="form-control" placeholder="Enter Type Name" >

        </div>

        <div>
            <input type="submit" name="submit" value="add" class="btn btn-primary"/>
        </div>
    </form>

    <ul class="list-group">
        <h4>Available Types : </h4>


        <?php

        $sql = "SELECT * FROM activity_types";
        $query = mysqli_query($connect,$sql);
        $rows = mysqli_num_rows($query);

        if($rows < 1){
            echo "<span style='font-size:24px;margin-top: 20px;' class='badge badge-pill badge-info'>There is no users</span>";
        }

        while($row = mysqli_fetch_array($query)){
        ?>

        <li class="list-group-item list-group-item-action"><?php echo $row['name'];?><a class="btn btn-danger" href="newActivityType.php?delete=<?php echo $row['id'];?>">Delete</a></li>

        <?php
        }
        ?>

    </ul>


</div>



<?php

// When form is submitted

if(isset($_POST['submit'])){

    if($_POST['new_type'] != ""){

        $name = $_POST['new_type'];


        $query = mysqli_query($connect,"INSERT INTO `activity_types` (`name`) VALUES ('$name')");


        if($query){
            header("Location: ".$_SERVER['PHP_SELF']);
        }
        else{
            echo "Error occured !";
        }

    }

    else{
        echo "Type the name!";
    }

}

if(isset($_GET['delete'])){

    $id = $_GET['delete'];

    $sql = "DELETE FROM `activity_types` WHERE id='$id'";
    $query = mysqli_query($connect, $sql);

    if($query){

?>

<script>
    window.location.href = "newActivityType.php";
</script>

<?php

    }else{
        echo "Unable to delete";
    }

}

?>

<script src="js/bootstrap.js"></script>

<?php
include_once "../page/user_footer.html";

?>



<script> 

</script> 


</body>


</html> 