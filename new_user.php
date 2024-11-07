<?php
include "validate.php";
// session start here...
session_start();
// get all 3 strings from the form (and scrub w/ validation function)
if ($_SERVER["REQUEST_METHOD"] = "$_POST") {
    $username = test_input($_POST["user"]);
    $password = test_input($_POST["pwd"]);
    $password_repeat = test_input($_POST["repeat"]);

    if ($password != $password_repeat) {
        echo "Password do not match";
    }
}
// make sure that the two password values match!


// create the password_hash using the PASSWORD_DEFAULT argument
$password_hashed = password_hash($password,PASSWORD_DEFAULT);
// login to the database
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "games";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$query = "SELECT * FROM users WHERE username = '$username'";
$result = $conn->query($query);
if ($result -> num_rows > 0 ){
  echo "Username already exists";
} else {
  $sql = "INSERT INTO users (username, password) VALUES (`$username`,`$password_hashed`)";

}

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
// make sure that the new user is not already in the database

// insert username and password hash into db (put the username in the session
// or make them login)

