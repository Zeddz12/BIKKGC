<?php
// Replace DB_HOST, DB_USERNAME, DB_PASSWORD, and DB_NAME with your actual database credentials
$conn = mysqli_connect('localhost', 'root', '', 'ts_db');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if a search query is present
if (isset($_GET['search'])) {
    $searchQuery = $_GET['search'];
    // Modify the query to search for matching records
    $query = "SELECT * FROM kgcm WHERE name LIKE '%$searchQuery%'";
    $result = mysqli_query($conn, $query);

    // Prepare the table rows
    $output = "";
    while ($row = mysqli_fetch_assoc($result)) {
        $output .= "<tr>";
        $output .= "<td>{$row['ic']}</td>";
        $output .= "<td>{$row['name']}</td>";
        $output .= "<td>{$row['hadd']}</td>";
        $output .= "<td>{$row['pn']}</td>";
        $output .= "<td>{$row['nk']}</td>";
        $output .= "<td>{$row['ick']}</td>";
        $output .= "<td>{$row['relay']}</td>";
        $output .= "<td>{$row['pnk']}</td>";
        $output .= "<td>";
        $output .= "<a href='delete_data.php?id={$row['id']}' class='btn btn-danger btn-sm'>Delete</a>";
        $output .= "</td>";
        $output .= "</tr>";
    }

    echo $output;
}

mysqli_close($conn);
?>
<script>
    // JavaScript code to handle search functionality
    document.getElementById('searchForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent form submission

        var searchQuery = document.getElementsByName('search')[0].value;
        var table = document.getElementById('dataTable');
        var rows = table.getElementsByTagName('tr');

        // Loop through all table rows
        for (var i = 0; i < rows.length; i++) {
            var row = rows[i];
            var nameCell = row.getElementsByTagName('td')[1];

            // Check if the name cell contains the search query
            if (nameCell && nameCell.textContent.includes(searchQuery)) {
                row.style.display = ''; // Show the row
            } else {
                row.style.display = 'none'; // Hide the row
            }
        }

        table.style.display = ''; // Show the table
    });
</script>