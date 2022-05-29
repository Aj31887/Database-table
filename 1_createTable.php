<?php

echo '<a href="index.php">Back to the main menu</a><br><br>';



$servername ="localhost";
$username = 'root';
$password ='';
$dbname = 'dbtest1';


//Create connnection
$conn = new mysqli ($servername, $username, $password, $dbname);

//Check Connection
if ($conn->connect_error) {
echo "Didnt connect";
die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected to the database successfully.<br>";
}

///////////////////////////////////

// sql to create table
$sql = "CREATE TABLE kompisar (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
firstname VARCHAR(30) NOT NULL,
lastname VARCHAR(30) NOT NULL,
mobile INT(31) UNSIGNED,
email VARCHAR(50)
)";

if ($conn->query($sql) === TRUE) {
  echo "Table kompisar created successfully";
} else {
  echo "Error creating table: " . $conn->error;
}

$conn->close();
?>
