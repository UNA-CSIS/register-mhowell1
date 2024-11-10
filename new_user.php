<?php
include "validate.php";
// session start here...
session_start();
// get all 3 strings from the form (and scrub w/ validation function)
if ($_SERVER["REQUEST_METHOD"] = "$_POST") {
    $user = test_input($_POST["user"]);
    $pwd = test_input($_POST["pwd"]);
    $password_repeat = test_input($_POST["repeat"]);

    if ($pwd != $password_repeat) {
      echo "Passwords do not match";
      return;
  }
  
}
// make sure that the two password values match!


// create the password_hash using the PASSWORD_DEFAULT argument
$password_hashed = password_hash($pwd,PASSWORD_DEFAULT);
// login to the database
$servername = "localhost";
$username = "root";
$pass = "";
$dbname = "softball";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

//check if username already exists
$query = "SELECT * FROM users WHERE username = '$user'";
$result = $conn->query($query);
if ($result -> num_rows > 0 ){
  echo "Username already exists";
  header( "refresh:2;url=index.php" );
} else {
  $sql = "INSERT INTO users (username, password) VALUES ('$user', '$password_hashed')";
}

if ($conn->query($sql) === TRUE) {
  echo "New account created";
  header("refresh:2;url=index.php");
};
$conn->close();
