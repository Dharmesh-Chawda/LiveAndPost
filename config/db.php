<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "live_and_post";
$conn = new mysqli($host, $user, $password, $dbname);
if (!$conn) {
    die("Connection failed" . $conn->error);
}
