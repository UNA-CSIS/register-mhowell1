<?php
session_start();
include "validate.php";

$user = test_input($_POST["user"]);
$post_password = test_input($_POST["pwd"]);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "softball";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT password FROM users WHERE username = '$user'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    if ($row = $result->fetch_assoc()) {
        $verified = password_verify($post_password, trim($row['password']));
        if ($verified) {
          $_SESSION['username'] = $user;
            $_SESSION['error'] = '';
        } else {
            $_SESSION['error'] = 'invalid username or password';
        }
    }
} else {
    $_SESSION['error'] = 'invalid username or password';
}

$conn->close();

header("Location: index.php");
exit;
