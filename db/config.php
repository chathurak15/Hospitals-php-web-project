<?php
$dbname="care_compass_hospitals";
$host="localhost";
$user="root";
$pass="";

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
