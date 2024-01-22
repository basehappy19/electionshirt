<?php

$hostname = "localhost";

$username = "root";

$password = "";

$database = "vote";

$port = 21;



mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$conn = mysqli_connect($hostname, $username, $password, $database, $port);



if (!$conn) {

    die("เชื่อมต่อกับ database ไม่ได้" . mysqli_connect_error());

}