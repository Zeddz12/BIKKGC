<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>KGC</title>
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-header">
                        <h4>KGC Member </h4>
                        <nav>
                            <a href="./index.php" style="color:black; background: ffc;">Back</a>
                            <a href="./bik.php" style="color:black; background: ffc;">BIK</a>
                        </nav>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-7">

                                <form id="searchForm" action="search_data.php" method="GET">
                                    <div class="input-group mb-3">
                                        <input type="text" name="search" required value="" class="form-control" placeholder="Search data">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-body">
                        <table id="dataTable" class="table table-bordered" style="display: none;">
                            <thead>
                                <tr>
                                    <th>IC Number</th>
                                    <th>Name</th>
                                    <th>Home Address</th>
                                    <th>Phone Number</th>
                                    <th>Name (Next of Kin)</th>
                                    <th>Next of Kin IC Number</th>
                                    <th>Relationship</th>
                                    <th>Next of Kin Phone Number</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Table rows will be dynamically added here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // JavaScript code to handle search functionality
        document.getElementById('searchForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent form submission

            var searchQuery = document.getElementsByName('search')[0].value;
            var table = document.getElementById('dataTable');
            var tbody = table.getElementsByTagName('tbody')[0];
            
            // Clear existing table rows
            while (tbody.firstChild) {
                tbody.removeChild(tbody.firstChild);
            }

            // Make an AJAX request to search_data.php
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'search_data.php?search=' + encodeURIComponent(searchQuery), true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Insert the retrieved table rows into the table
                    tbody.innerHTML = xhr.responseText;
                    table.style.display = ''; // Show the table
                } else {
                    console.log('Error: ' + xhr.status);
                }
            };
            xhr.send();
        });
    </script>
</body>
</html>