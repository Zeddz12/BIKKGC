<?php
// Replace DB_HOST, DB_USERNAME, DB_PASSWORD, and DB_NAME with your actual database credentials
$conn = mysqli_connect('localhost', 'root', '', 'ts_db');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$row = array(); // Initialize an empty array to store the retrieved data

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM bikm WHERE idbik = $id";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        die("Record not found.");
    }
}

// Handle update functionality
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $id = $_POST['idbik'];
    $nw = $_POST['nw'];
    $icw = $_POST['icw'];
    $telw = $_POST['telw'];
    $alw = $_POST['alw'];
    $nb = $_POST['nb'];
    $nm = $_POST['nm'];
    $icm = $_POST['icm'];
    $jm = $_POST['jm'];
    $sm = $_POST['sm'];
    $bhm = $_POST['bhm'];
    $drm = $_POST['drm'];
    $hm = $_POST['hm'];
    $thb = $_POST['thb'];
    $tkd = $_POST['tkd'];
    $tdb = $_POST['tdb'];

    $query = "UPDATE bikm SET nw = '$nw', icw = '$icw', telw = '$telw', alw = '$alw', nb = '$nb', nm = '$nm', icm = '$icm', jm = '$jm', sm = '$sm', bhm = '$bhm', drm = '$drm', hm = '$hm', thb = '$thb', tkd = '$tkd', tdb = '$tdb'  WHERE idbik = $id";

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
            max-width: 800px;
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
            flex-wrap: wrap;
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

        <form action="edit1.php" method="POST">
            <div class="form-group">
                <label for="idbik">ID:</label>
                <input type="text" id="idbik" name="idbik" required value="<?= $row['idbik'] ?>" readonly>
            </div>
            <div class="form-group">
                <label for="nw">Nama Waris:</label>
                <input type="text" id="nw" name="nw" required value="<?= $row['nw'] ?>">
            </div>
            <div class="form-group">
                <label for="icw">Nombor Kad Pengenalan Waris:</label>
                <input type="text" id="icw" name="icw" required value="<?= $row['icw'] ?>">
            </div>
            <div class="form-group">
                <label for="telw">No.Tel Waris:</label>
                <input type="text" id="telw" name="telw" required value="<?= $row['telw'] ?>">
            </div>
            <div class="form-group">
                <label for="alw">Alamat Waris:</label>
                <input type="text" id="alw" name="alw" required value="<?= $row['alw'] ?>">
            </div>
            <div class="form-group">
                <label for="nb">Nom dan Nama Bank Waris:</label>
                <input type="text" id="nb" name="nb" required value="<?= $row['nb'] ?>">
            </div>
            <div class="form-group">
                <label for="nm">Nama (Si Mati):</label>
                <input type="text" id="nm" name="nm" required value="<?= $row['nm'] ?>">
            </div>
            <div class="form-group">
                <label for="icm">Nombor Kad Pengenalan:</label>
                <input type="text" id="icm" name="icm" required value="<?= $row['icm'] ?>">
            </div>
            <div class="form-group">
                <label for="jm">Jantina :</label>
                <input type="text" id="jm" name="jm" required value="<?= $row['jm'] ?>">
            </div>
            <div class="form-group">
                <label for="sm">Bangsa :</label>
                <input type="text" id="sm" name="sm" required value="<?= $row['sm'] ?>">
            </div>
            <div class="form-group">
                <label for="bhm">Lokasi Tuntutan:</label>
                <input type="text" id="bhm" name="bhm" required value="<?= $row['bhm'] ?>">
            </div>
            <div class="form-group">
                <label for="drm">Daerah:</label>
                <input type="text" id="drm" name="drm" required value="<?= $row['drm'] ?>">
            </div>
            <div class="form-group">
                <label for="hm">Halangan Masuk:</label>
                <input type="text" id="hm" name="hm" required value="<?= $row['hm'] ?>">
            </div>
            <div class="form-group">
                <label for="thb">Tarikh Hantar Borang:</label>
                <input type="text" id="thb" name="thb" required value="<?= $row['thb'] ?>">
            </div>
            <div class="form-group">
                <label for="tkd">Tarikh Kelulusan:</label>
                <input type="text" id="tkd" name="tkd" required value="<?= $row['tkd'] ?>">
            </div>
            <div class="form-group">
                <label for="tdb">Tarikh Dibayar:</label>
                <input type="text" id="tdb" name="tdb" required value="<?= $row['tdb'] ?>">
            </div>
            <button type="submit" name="update">Update</button>
        </form>
    </div>
</body>
</html>
