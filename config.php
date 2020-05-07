<?php
define('HOST',"localhost");
define('USER',"root");
define('PASS',"");
define('DB',"KFUPM_Activities");

$connect = @mysqli_connect(HOST,USER,PASS,DB) or die("Connection Failed");

date_default_timezone_set("Asia/Riyadh");


?>