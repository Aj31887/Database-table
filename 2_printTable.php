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
    echo "Connected to the database successfully.<br><br>";
}

///////////////////////////////////

$sql = "SELECT id, firstname, lastname, mobile, email FROM kompisar";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo '<table style="border-spacing: 20px;"><tr>
  <th>ID</th>
  <th>Name</th>
  <th>Mobile</th>
  <th>Email</th>
  </tr>';
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<tr>
    <td>".$row["id"]."</td>
    <td>".$row["firstname"]." ".$row["lastname"]."</td>
    <td>".$row["mobile"]."</td>
    <td>".$row["email"]."</td>

    
    </tr>";
  }
  echo "</table>";
} else {
  echo "0 results";
}
$conn->close();
?>