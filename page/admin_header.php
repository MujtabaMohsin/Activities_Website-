<?php
session_start();
if(!isset($_SESSION['id']) || !isset($_SESSION['email']) || !isset($_SESSION['user_type']) || $_SESSION['user_type'] != 1){

    header("Location: ../index.php");

}

?>
<html>

    <head>

        <title>KFUPM Activities</title>

        <link rel="stylesheet" href="../css/bootstrap.css" >
        <link rel="stylesheet" href="../css/style.css" >

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8">

    </head>

    
    <body>

        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div>

                    <a class="navbar-brand" href="../index.php"><img alt="logo" src="../images/logo.png"></a>
                </div>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          
                        <li class="nav-item active">
                            <a class="nav-link btn btn-primary" href="index.php">Dashboard</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="manageOfferingRequests.php">Activity Offering Requests</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="manageUsersActivities.php">Users Activities</a>
                        </li>

                        <li class="nav-item active">
                            <a class="nav-link" href="manageUsers.php">Users</a>
                        </li>

                        <li class="nav-item active">
                            <a class="nav-link" href="newActivityType.php">Add Activity Type</a>
                        </li>
                    </ul>
                    <a class="nav-link btn btn-danger" id="logoutBtn" href="../logout.php">Logout</a>

                </div>
            </nav>


        </header>


        <div id="container" class="row-sm-12">