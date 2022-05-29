

<?php

echo '<a href="index.php">Back to the main menu</a><br><br>';

// define variables and set to empty values
$firstnameErr = $lastnameErr = $mobileErr = $emailErr = "";
$firstname = $lastname = $mobile = $email = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {


  if (empty($_POST["firstname"])) {
    $firstnameErr = "Firstname is required";
  } else {
    $firstname = test_input($_POST["firstname"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$firstname)) {
      $firstnameErr = "Only letters and white space allowed";
    }
  }
  

  
  if (empty($_POST["lastname"])) {
    $lastnameErr = "lastname is required";
  } else {
    $lastname = test_input($_POST["lastname"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$lastname)) {
      $lastnameErr = "Only letters and white space allowed";
    }
  }


  if (empty($_POST["mobile"])) {
    $mobileErr = "mobile is required";
  } else {
    $mobile = test_input($_POST["mobile"]);
    // check if name only contains letters and whitespace
    if (!preg_match('/^[0-9]{5,11}+$/',$mobile)) {
      $mobileErr = "A valid mobile number is required!";
    }
  }

  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }
    
  

////////////////////////////////////
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



// prepare and bind
$stmt = $conn->prepare("INSERT INTO kompisar (firstname, lastname, mobile, email) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssis", $firstname, $lastname, $mobile, $email);


$stmt->execute();

echo "New record created successfully <br>" . $firstname . "<br>" . $lastname . "<br>" . $mobile . "<br>" . $email. "<br>";

$stmt->close();
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

<h2>Fill the fields below to add an entry</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  
Firstame: <input type="text" name="firstname" value="<?php echo $firstname;?>">
  <span class="error">* <?php echo $firstnameErr;?></span>
  <br><br>

  lastname: <input type="text" name="lastname" value="<?php echo $lastname;?>">
  <span class="error">* <?php echo $lastnameErr;?></span>
  <br><br>

  mobile: <input type="text" name="mobile" value="<?php echo $mobile;?>">
  <span class="error">* <?php echo $mobileErr; $mobileErr = ""; ?></span>
  <br><br>

  E-mail: <input type="text" name="email" value="<?php echo $email;?>">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>


  <input type="submit" name="submit" value="Submit">  
</form>



</body>
</html>