<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "database";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Retrieve data from the database
$sql = "SELECT * FROM table_name";
$result = $conn->query($sql);

// Generate the auto-incremented ID
$id = $conn->insert_id + 1;

// Display the data and the generated ID
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    echo "ID: " . $id . " - " . $row["column_name1"] . " " . $row["column_name2"] . "<br>";
    $id++;
  }
} else {
  echo "0 results";
}

// Close the database connection
$conn->close();
?>

<html>
<head>
  <title>Form</title>
   

</head>
</html>