<?php
session_start();
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    header("location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        Display games here...
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "softball";
        
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "SELECT opponent, site, result FROM games";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
            echo "id: " . $row["opponent"]. " - Name: " . $row["site"]. " " . $row["result"]. "<br>";
          }
        } else {
          echo "0 results";
        }
        $conn->close();
        ?>
    </body>
</html>
