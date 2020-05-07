<?php
session_start();
?>
<html>

    <head>

        <title>KFUPM Activities</title>

        <link rel="stylesheet" href="css/bootstrap.css" >
        <link rel="stylesheet" href="css/style.css" >
        <!-- Font Awesome Icon Library -->
        <link rel="stylesheet" href="css/font-awesome-all.min.css">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8">

    </head>


    <body>

        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                    <a href="index.php"> <img alt="KFUPM Activities" src="images/logo.png"> </a>
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">

                        <li class="nav-item active">
                            <a class="nav-link" href="index.php" >Home</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="activities.php">Activities</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="contact-us.php">Contact us</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="about-us.php">About us</a>
                        </li>
                        <?php
                        if(isset($_SESSION['id']) && isset($_SESSION['email'])){

                            if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 0){
                        ?>
                        <li class="nav-item active">
                            <a class="nav-link btn btn-primary" href="user/index.php">Dashboard</a>
                        </li>

                        <?php
                            }else{
                        ?>
                        <li class="nav-item active">
                            <a class="nav-link btn btn-primary" href="admin/index.php">Dashboard</a>
                        </li>
                        <?php
                            }
                        }
                        ?>
                    </ul>

                    <?php
                    if(isset($_SESSION['id']) && isset($_SESSION['email'])){

                        if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 0){
                    ?>
                    <a class="nav-link btn btn-danger" id="logoutBtn" href="logout.php">Logout</a>
                    <?php
                        }
                    }
                    ?>

                </div>
            </nav>


        </header>

        <div id="container" class="row-sm-12">


