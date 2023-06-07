<?php
// Replace DB_HOST, DB_USERNAME, DB_PASSWORD, and DB_NAME with your actual database credentials
$conn = mysqli_connect('localhost', 'root', '', 'ts_db');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM kgcm WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        die("Record not found.");
    }
}

// Handle update functionality
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $ic = $_POST['ic'];
    $hadd = $_POST['hadd'];
    $cl = $_POST['cl'];
    $pn = $_POST['pn'];
    $nk = $_POST['nk'];
    $ick = $_POST['ick'];
    $relay = $_POST['relay'];
    $pnk = $_POST['pnk'];

    $query = "UPDATE kgcm SET name = '$name',ic = '$ic , hadd = '$hadd', cl = '$cl', pn = '$pn', nk = '$nk', ick = '$ick', relay = '$relay', pnk = '$pnk' WHERE id = $id";

    if (mysqli_query($conn, $query)) {
        echo "Data updated successfully.";
        // Redirect back to index.php after updating the record
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KGC Member - Edit</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }
        .container {
            max-width: 800px; /* Adjust the maximum width */
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #4caf50;
        }
        form {
            display: flex;
            flex-wrap: wrap; /* Allow wrapping form elements */
            justify-content: center;
            margin-bottom: 20px;
        }
        .form-group {
            width: 100%;
            margin-bottom: 10px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button[type="submit"] {
            padding: 8px 16px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Member Data</h2>

        <form action="edit.php" method="POST">
            <div class="form-group">
                <label for="id">ID:</label>
                <input type="text" id="id" name="id" required value="<?= $row['id'] ?>" readonly>
            </div>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required value="<?= $row['name'] ?>">
            </div>
            <div class="form-group">
                <label for="ic">IC Number:</label>
                <input type="text" id="ic" name="ic" required value="<?= $row['ic'] ?>">
            </div>
            <div class="form-group">
                <label for="hadd">Home Address:</label>
                <input type="text" id="hadd" name="hadd" required value="<?= $row['hadd'] ?>">
            </div>
            <div class="form-group">
                <label for="cl">Card Location:</label>
                <input type="text" id="cl" name="cl" required value="<?= $row['cl'] ?>">
            </div>
            <div class="form-group">
                <label for="pn">Phone Number:</label>
                <input type="text" id="pn" name="pn" required value="<?= $row['pn'] ?>">
            </div>
            <div class="form-group">
                <label for="nk">Name (Next of Kin):</label>
                <input type="text" id="nk" name="nk" required value="<?= $row['nk'] ?>">
            </div>
            <div class="form-group">
                <label for="ick">IC Number (Next of Kin):</label>
                <input type="text" id="ick" name="ick" required value="<?= $row['ick'] ?>">
            </div>
            <div class="form-group">
                <label for="relay">Relationship:</label>
                <input type="text" id="relay" name="relay" required value="<?= $row['relay'] ?>">
            </div>
            <div class="form-group">
                <label for="pnk">Phone Number (Next of Kin):</label>
                <input type="text" id="pnk" name="pnk" required value="<?= $row['pnk'] ?>">
            </div>
            <button type="submit" name="update">Update</button>
        </form>
    </div>
</body>
</html>
