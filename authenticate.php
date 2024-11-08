<?php
// start session
session_start();
$user = test_input($_POST["user"]);
$post_password = test_input($_POST["pwd"]);
// login to the softball database
$servername = "localhost";
$username = "root";
$pass = "";
$dbname = "softball";

// Create connection
$conn = new mysqli($servername, $username, $pass, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT password FROM users WHERE username = `$user` ";
$result = $conn->query($sql);

if ($result->num_rows < 1) {
    header("Location: index.php");
} else {
    $row = $result->fetch_assoc();
    if (password_verify($post_password, $row['password'])) {
        echo "Logged in";
        $_SESSION["username"] = $user;
        header("Location: games.php");
        exit();
    } else {
        echo "Invalid password";
        header("Location: login.php");
        exit();
    }
}

$conn->close();

header("location: games.php");
// select password from users where username = <what the user typed in>

// if no rows, then username is not valid (but don't tell Mallory) just send
// her back to the login

// otherwise, password_verify(password from form, password from db)

// if good, put username in session, otherwise send back to login

