<?php
// Replace DB_HOST, DB_USERNAME, DB_PASSWORD, and DB_NAME with your actual database credentials
$conn = mysqli_connect('localhost', 'root', '', 'ts_db');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Delete the record with the provided ID from the database
    $query = "DELETE FROM kgcm WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Record deleted successfully
        echo "Record deleted successfully.";
    } else {
        // Failed to delete record
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>