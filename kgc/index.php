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

    $query = "SELECT * FROM kgcm WHERE name LIKE '%$searchQuery%' OR ic LIKE '%$searchQuery%' OR nk LIKE '%$searchQuery%' OR hadd LIKE '%$searchQuery%' OR cl LIKE '%$searchQuery%' OR relay LIKE '%$searchQuery%'";

    $result = mysqli_query($conn, $query);
}

// Handle add functionality
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    $name = $_POST['name'];
    $ic = $_POST['ic'];
    $hadd = $_POST['hadd'];
    $cl = $_POST['cl'];
    $pn = $_POST['pn'];
    $nk = $_POST['nk'];
    $ick = $_POST['ick'];
    $relay = $_POST['relay'];
    $pnk = $_POST['pnk'];

    $query = "INSERT INTO kgcm (name, ic, hadd, cl, pn, nk, ick, relay, pnk) VALUES ('$name', '$ic', '$hadd', '$cl', '$pn', '$nk', '$ick', '$relay', '$pnk')";

    if (mysqli_query($conn, $query)) {
        echo "Data inserted successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Handle delete functionality
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM kgcm WHERE id = $id";

    if (mysqli_query($conn, $query)) {
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
    <title>KGC Member</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        .container {
            max-width: 2000px;
            /* Adjust the maximum width */
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
            /* Allow wrapping form elements */
            justify-content: center;
            margin-bottom: 20px;
        }

        h3 {
            text-align: center;
            margin-bottom: 10px;
        }

        input[type="text"] {
            padding: 8px;
            width: 100%;
            /* Adjust the width to fill the container */
            margin-bottom: 10px;
        }

        button[type="submit"] {
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

        th,
        td {
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
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 20px;
            /* Adjust the vertical spacing */
        }

        .form-group label {
            display: block;
            font-weight: bold;
            color: #4caf50;
            flex-basis: 100%;
        }

        .form-group input[type="text"] {
            padding: 8px;
            width: 100%;
            /* Adjust the width to fill the container */
            margin-top: 5px;
        }

        button[name="add"] {
            display: block;
            margin: 27px auto;
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
        <h2>Welcome to KGC Member Database</h2>

        <div class="navbar">
            <a class="active" href="index.php">KGC</a>
            <a href="bik.php">BIK</a>
        </div>

        <form action="index.php" method="GET">
            <input type="text" name="search" required placeholder="Search data">
            <button type="submit">Search</button>
        </form>

        <div class="navbar2">
        <form action="index.php" method="POST" class="add-member-form">
            <div class="form-group">
            <div class="form-group">
                <label for="name">Nama:</label>
                <input type="text" id="name" name="name" required placeholder="Name">
            </div>
                <label for="ic">Nombor KP:</label>
                <input type="text" id="ic" name="ic" required placeholder="IC Number">
            </div>
            <div class="form-group">
                <label for="hadd">Alamat:</label>
                <input type="text" id="hadd" name="hadd" required placeholder="Home Address">
            </div>
            <div class="form-group">
                <label for="cl">Lokasi Tuntutan:</label>
                <input type="text" id="cl" name="cl" required placeholder="Card Location">
            </div>
            <div class="form-group">
                <label for="pn">No.Tel :</label>
                <input type="text" id="pn" name="pn" required placeholder="Phone Number">
            </div>
            <div class="form-group">
                <label for="nk">Nama (Waris):</label>
                <input type="text" id="nk" name="nk" required placeholder="Name (Next of Kin)">
            </div>
            <div class="form-group">
                <label for="ick">Nombor KP(Waris):</label>
                <input type="text" id="ick" name="ick" required placeholder="Next of Kin IC Number">
            </div>
            <div class="form-group">
                <label for="relay">Hubungan:</label>
                <input type="text" id="relay" name="relay" required placeholder="Relationship">
            </div>
            <div class="form-group">
                <label for="pnk">No.Tel (Waris):</label>
                <input type="text" id="pnk" name="pnk" required placeholder="Next of Kin Phone Number">
            </div>
            <button type="submit" name="add">Add</button>
    </div>
        </form>

        <?php if ($searchQuery !== ''): ?>
            <?php if (mysqli_num_rows($result) > 0): ?>
                <table>
                    <tr>
                        <th>Nama</th>
                        <th>Nombor Kad Pengenalan</th>
                        <th>Alamat</th>
                        <th>Lokasi Tuntutan</th>
                        <th>NO.Tel</th>
                        <th>Nama (Waris)</th>
                        <th>Nombor Kad Pengenalan (Waris)</th>
                        <th>Hubungan</th>
                        <th>No.Tel (Waris)</th>
                        <th>Action</th>
                    </tr>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= $row['name'] ?></td>
                            <td><?= $row['ic'] ?></td>
                            <td><?= $row['hadd'] ?></td>
                            <td><?= $row['cl'] ?></td>
                            <td><?= $row['pn'] ?></td>
                            <td><?= $row['nk'] ?></td>
                            <td><?= $row['ick'] ?></td>
                            <td><?= $row['relay'] ?></td>
                            <td><?= $row['pnk'] ?></td>
                            <td>
                                <a class="edit-link" href="edit.php?id=<?= $row['id'] ?>">Edit</a>
                                <a class="delete-link" href="index.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            <?php else: ?>
                <p>No results found.</p>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</body>
</html>
