<?php

if(isset($_POST['search']))
{
    $valueToSearch = $_POST['valueToSearch'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM `kgc` WHERE CONCAT(`id`, `ic`, `fname`, `lname`, `hadd`, `pn`, `fnk`, `lnk`, `ick`, `relay`, `pnk`) LIKE '%".$valueToSearch."%'";
    $search_result = filterTable($query);
    
}
 else {
    $query = "SELECT * FROM `kgc`";
    $search_result = filterTable($query);
}

// function to connect and execute the query
function filterTable($query)
{
    $connect = mysqli_connect("localhost", "root", "", "ts_db");
    $filter_Result = mysqli_query($connect, $query);
    return $filter_Result;
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>KGC</title>
        <style>
            table,tr,th,td
            {
                border: 1px solid black;
                margin-left: auto;
                margin-right: auto;
                width: 50cm
            }
            body{
                background-image: url("WB.gif");
                background-position: center;
                background-repeat: initial;
            }
        </style>
    </head>
    <body>
        
        <form action="cpsm.php" method="post">
            <input type="text" name="valueToSearch" placeholder="Value To Search"><br><br>
            <input type="submit" name="search" value="Filter"><br><br>
            
            <table>
                <tr>
                    <th>IC Number</th>
                    <th>First Name</th>
                    <th>Home Address</th>
                    <th>Phone Number</th>
                    <th>Name(Next of Kin)</th>
                    <th>IC Number</th>
                    <th>Relationship</th>
                    <th>Phone Number</th>

                </tr>

      <!-- populate table from mysql database -->
                <?php while($row = mysqli_fetch_array($search_result)):?>
                <tr>
                    
                    <td><?php echo $row['ic'];?></td>
                    <td><?php echo $row['name'];?></td>
                    <td><?php echo $row['hadd'];?></td>
                    <td><?php echo $row['pn'];?></td>
                    <td><?php echo $row['nk'];?></td>
                    <td><?php echo $row['ick'];?></td>
                    <td><?php echo $row['relay'];?></td>
                    <td><?php echo $row['pnk'];?></td>
                </tr>
                <?php endwhile;?>
            </table>
        </form>
        
    </body>
</html>