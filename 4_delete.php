
<?php

echo '<a href="index.php">Back to the main menu</a><br><br>';

// define variables and set to empty values
$idErr = "";
$id = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {


  if (empty($_POST["id"])) {
    $idErr = "id is required";
  } else {
    $id = test_input($_POST["id"]);
    // check if name only contains letters and whitespace
    if (!preg_match('/[0-9]{1,6}/',$id)) {
      $idErr = "Only numbers between one and six digits allowed";
    }
  }




//////////////////////////////////
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

// sql to delete a record
$sql = "DELETE FROM kompisar WHERE id=$id";

if ($conn->query($sql) === TRUE) {
  echo "Record deleted successfully";
} else {
  echo "Error deleting record: " . $conn->error;
}

$conn->close();


 
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>


<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

<h2>Enter the ID number of the record you want to delete</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  

  id: <input type="text" name="id" value="<?php echo $id;?>">
  <span class="error">* <?php echo $idErr; $idErr = ""; ?></span>
  <br><br>



  <input type="submit" name="submit" value="Submit">  
</form>



</body>
</html>