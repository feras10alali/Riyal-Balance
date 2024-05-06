
<?php
$servername = "209.38.164.41";
$username = "website"; 
$password = "Fs1$*7426913085*$1Fs"; 
$dbname = "website%users"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize input data
function sanitize_data($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// Insert data into database
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
  $first_name = sanitize_data($_POST["first_name"]);
  $last_name = sanitize_data($_POST["last_name"]);
  $bd = sanitize_data($_POST["bd"]);
  $email = sanitize_data($_POST["email"]);
  $salary = sanitize_data($_POST["salary"]);
  $password = password_hash(sanitize_data($_POST["password"]), PASSWORD_DEFAULT);

  $sql = "INSERT INTO rigester (first_name, last_name, bd, email, salary, password)
          VALUES ('$first_name', '$last_name', '$bd', '$email', '$salary', '$password')";

  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

// Retrieve data from database
$sql = "SELECT * FROM rigester";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    echo "ID: " . $row["ID"]. " - Name: " . $row["first_name"]. " " . $row["last_name"]. " - Email: " . $row["email"]. "<br>";
  }
} else {
  echo "0 results";
}

$conn->close();
?>
