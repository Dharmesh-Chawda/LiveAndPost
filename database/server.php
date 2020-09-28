<?php
$username = "";
$email = "";
$errors = array();
$conn = new mysqli("localhost", "root", "", "live_and_post");
if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}
if (isset($_POST['register'])) {
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password1 = $conn->real_escape_string($_POST['password1']);
    $password2 = $conn->real_escape_string($_POST['password2']);

    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($password1)) {
        array_push($errors, "Password is required");
    }
    if ($password2 != $password1) {
        array_push($errors, "The two password do not match");
    }
    if (count($errors) == 0) {
        echo $email;
        echo $username;
        echo $password1;
        $password = md5($password1);
        echo $password;
        $sql = "INSERT INTO user (username,email,password) VALUES ('$username','$email','$password')";
        $conn->query($sql);
    }
}
