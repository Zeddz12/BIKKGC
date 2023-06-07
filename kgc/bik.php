<?php
// Replace DB_HOST, DB_USERNAME, DB_PASSWORD, and DB_NAME with your actual database credentials
$conn = mysqli_connect('localhost', 'root', '', 'ts_db');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$searchQuery = '';

// Handle search functionality
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['search'])) {
    $searchQuery = $_GET['search'];

    $query = "SELECT * FROM bikm WHERE nw LIKE '%$searchQuery%' OR icw LIKE '%$searchQuery%' OR telw LIKE '%$searchQuery%' OR nm LIKE '%$searchQuery%' OR icm LIKE '%$searchQuery%' OR thb LIKE '%$searchQuery%'";

    $result = mysqli_query($conn, $query);
}

// Handle add functionality
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    $nw = isset($_POST['nw']) ? $_POST['nw'] : '';
    $icw = isset($_POST['icw']) ? $_POST['icw'] : '';
    $telw = isset($_POST['telw']) ? $_POST['telw'] : '';
    $alw = isset($_POST['alw']) ? $_POST['alw'] : '';
    $nb = isset($_POST['nb']) ? $_POST['nb'] : '';
    $nm = isset($_POST['nm']) ? $_POST['nm'] : '';
    $icm = isset($_POST['icm']) ? $_POST['icm'] : '';
    $jm = isset($_POST['jm']) ? $_POST['jm'] : '';
    $sm = isset($_POST['sm']) ? $_POST['sm'] : '';
    $bhm = isset($_POST['bhm']) ? $_POST['bhm'] : '';
    $drm = isset($_POST['drm']) ? $_POST['drm'] : '';
    $hm = isset($_POST['hm']) ? $_POST['hm'] : '';
    $thb = isset($_POST['thb']) ? $_POST['thb'] : '';
    $tkd = isset($_POST['tkd']) ? $_POST['tkd'] : '';
    $tdb = isset($_POST['tdb']) ? $_POST['tdb'] : '';


    $query = "INSERT INTO bikm (nw, icw, telw, alw, nb, jm, nm, icm, sm, bhm, drm, hm, thb, tkd, tdb) VALUES ('$nw', '$icw', '$telw', '$alw', '$nb', '$jm', '$nm', '$icm', '$sm', '$bhm', '$drm', '$hm', '$thb', '$tkd', '$tdb')";


    if (mysqli_query($conn, $query)) {
        echo "Data inserted successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Handle delete functionality
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['idbik'])) {
    $id = $_GET['idbik'];

    $query = "DELETE FROM bikm WHERE idbik = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id);

    if (mysqli_stmt_execute($stmt)) {
        echo "Data deleted successfully.";
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
    <title>BIK Member</title>
    <style>
          body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }
        .container {
            max-width: 1700px; /* Adjust the maximum width */
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
        h3 {
            text-align: center;
            margin-bottom: 10px;
        }
        input[type="text"] {
            padding: 8px;
            width: 100%; /* Adjust the width to fill the container */
            margin-bottom: 10px;
        }
        button[type="subangsait"] {
            padding: 8px 16px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            color: #4caf50;
        }
        p {
            margin: 0;
        }
        a {
            text-decoration: none;
            color: #4caf50;
        }
        .delete-link {
            color: red;
        }
        .edit-link {
            color: blue;
        }

        form.add-member-form {
            margin-bottom: 20px;
        }

        form.add-member-form h3 {
            text-align: center;
            margin-bottom: 10px;
            color: #4caf50;
        }

        .form-group {
            margin-bottom: 20px; /* Adjust the vertical spacing */
            margin-left: 1.3%;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            color: #4caf50;
        }

        .form-group input[type="text"] {
            padding: 8px;
            width: 100%; /* Adjust the width to fill the container */
            margin-top: 5px;
        }

        button[name="add"] {
            display: block;
            margin: 27px auto;
            margin-left: 25px;
            padding: 8px 16px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        .navbar {
            background-color: #333;
            overflow: hidden;
        }
        .navbar2 {
            background-color: wheat;
            overflow: hidden;
        }
        .navbar a {
            float: left;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 18px;
        }
        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }
        .navbar a.active {
            background-color: #4caf50;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome to BIK Member Database</h2>

        <div class="navbar">
            <a href="index.php">KGC</a>
            <a class="active" href="bik.php">BIK</a>
        </div>

        <form action="bik.php" method="GET">
            <input type="text" name="search" required placeholder="Search data">
            <button type="subangsait">Search</button>
        </form>

        <div class="navbar2">
        <form action="bik.php" method="POST" class="add-member-form">
            
            <div class="form-group">
                <label for="nw">Nama Waris:</label>
                <input type="text" id="nw" name="nw" required placeholder="Nama Waris">
            </div>
            <div class="form-group">
                <label for="icw">Nombor Kad Pengenalan Waris:</label>
                <input type="text" id="icw" name="icw" required placeholder="IC Waris">
            </div>
            <div class="form-group">
                <label for="telw">No.Tel Waris:</label>
                <input type="text" id="telw" name="telw" required placeholder="No.Tel Waris">
            </div>
            <div class="form-group">
                <label for="alw">Alamat Waris:</label>
                <input type="text" id="alw" name="alw" required placeholder="Alamat Waris">
            </div>
            <div class="form-group">
                <label for="pn">Nom dan Nama Bank Waris:</label>
                <input type="text" id="nb" name="nb" required placeholder="Nom dan Nama Bank Waris">
            </div>
            <div class="form-group">
                <label for="nm">Nama (Pemegang KGC):</label>
                <input type="text" id="nm" name="nm" required placeholder="Nama ">
            </div>
            <div class="form-group">
                <label for="icm">Nombor Kad Pengenalan:</label>
                <input type="text" id="icm" name="icm" required placeholder="IC (Pemegang KGC)">
            </div>
            <div class="form-group">
                <label for="nk">Jantina:</label>
                <input type="text" id="jm" name="jm" required placeholder="Jantina (Pemegang KGC)">
            </div>
            <div class="form-group">
               <label for="sm">Bangsa:</label>
               <input type="text" id="sm" name="sm" required placeholder="Bangsa (Pemegang KGC)">
            </div>
            <div class="form-group">
               <label for="bhm">Lokasi tuntutan:</label>
               <input type="text" id="bhm" name="bhm" required placeholder="Lokasi Tuntutan">
            </div>
            <div class="form-group">
               <label for="drm">Daerah :</label>
               <input type="text" id="drm" name="drm" required placeholder="Daerah">
            </div>
            <div class="form-group">
               <label for="hm">Hubungan :</label>
               <input type="text" id="hm" name="hm" required placeholder="Hubungan (Pemegang KGC)">
            </div>
            <div class="form-group">
                <label for="thb">Tarikh Hantar Borang:</label>
                <input type="date" id="thb" name="thb" required placeholder="Tarikh Hantar Borang">
            </div>
            <div class="form-group">
                <label for="tkd">Tarikh Kelulusan:</label>
                <input type="date" id="tkd" name="tkd" required placeholder="Tarikh Kelulusan">
            </div>
            <div class="form-group">
                <label for="tdb">Tarikh Dibayar:</label>
                <input type="date" id="tdb" name="tdb" required placeholder="Tarikh Dibayar">
            </div>
            <button type="subangsait" name="add">Add</button>
    </div>
        </form>

        <?php if ($searchQuery !== ''): ?>
            <?php if (mysqli_num_rows($result) > 0): ?>
                <table>
    <tr>
        <th>Nama Waris</th>
        <th>IC Waris</th>
        <th>No.Tel Waris</th>
        <th>Alamat Waris</th>
        <th>Nom dan Nama Bank</th>
        <th>Nama Si Mati</th>
        <th>IC Si Mati</th>
        <th>Jantina Si Mati</th>
        <th>Bangsa Si Mati</th>
        <th>Bahagian Si Mati</th>
        <th>Daerah Si Mati</th>
        <th>Hubungan Si Mati</th>
        <th>Tarikh Hantar Borang</th>
        <th>Tarikh Kelulusan</th>
        <th>Tarikh Dibayar</th>
        <th>Action</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?= $row['nw'] ?></td>
            <td><?= $row['icw'] ?></td>
            <td><?= $row['telw'] ?></td>
            <td><?= $row['alw'] ?></td>
            <td><?= $row['nb'] ?></td>
            <td><?= $row['nm'] ?></td>
            <td><?= $row['icm'] ?></td>
            <td><?= $row['jm'] ?></td>
            <td><?= $row['sm'] ?></td>
            <td><?= $row['bhm'] ?></td>
            <td><?= $row['drm'] ?></td>
            <td><?= $row['hm'] ?></td>
            <td><?= $row['thb'] ?></td>
            <td><?= $row['tkd'] ?></td>
            <td><?= $row['tdb'] ?></td>
            <td>
            <a class="edit-link" href="edit1.php?id=<?= $row['idbik'] ?>">Edit</a>
            <a class="delete-link" href="bik.php?idbik=<?= $row['idbik'] ?>" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>
<?php endif; ?>
        <?php endif; ?>
    </div>
</body>
</html>
