<?php
session_start();

if(!isset($_SESSION['id']) || !isset($_SESSION['email'])){
    header("Location: ../index.php");
}

?>

<!DOCTYPE html>
<html>

    <head>

        <title>Offer a New Activity</title>

        <link rel="stylesheet" href="../css/bootstrap.css" >
        <link rel="stylesheet" href="../css/style.css" >

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <script src="../js/jquery.js"></script>

        <meta charset="utf-8">


    </head>

    <body>

        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                    <a class="navbar-brand" href="../index.php"><img alt="logo" src="../images/logo.png"></a>
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                        
                        <li class="nav-item active">
                            <a class="nav-link" href="../index.php">Home</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link btn btn-primary" href="index.php">Dashboard</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="offerNewActivity.php">Add New Activity</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="manageMyActivities.php">My Activities</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="manageMyRequests.php">My Participation Requests</a>
                        </li>
                    </ul>
                    <a class="nav-link btn btn-danger" id="logoutBtn" href="../logout.php">Logout</a>

                </div>

                <span id="profile_icon"><a href="../user/editProfile.php"><img class="rounded-circle" src="../images/account_icon.png" title="User Profile"></a></span>
            </nav>

        </header>






        <div id="container">
