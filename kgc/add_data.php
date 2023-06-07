<?php
// Replace DB_HOST, DB_USERNAME, DB_PASSWORD, and DB_NAME with your actual database credentials
$conn = mysqli_connect('localhost', 'root', '', 'ts_db');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $ic = $_POST['ic'];
    $name = $_POST['name'];
    $hadd = $_POST['hadd'];
    $pn = $_POST['pn'];
    $nk = $_POST['nk'];
    $ick = $_POST['ick'];
    $relay = $_POST['relay'];
    $pnk = $_POST['pnk'];
    
    // Insert the data into the database
    $query = "INSERT INTO kgcm (ic, name, hadd, pn, nk, ick, relay, pnk)
              VALUES ('$ic', '$name', '$hadd', '$pn', '$nk', '$ick', '$relay', '$pnk')";
    
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Data inserted successfully
        echo "Data inserted successfully.";
    } else {
        // Failed to insert data
        echo "Error inserting data: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>