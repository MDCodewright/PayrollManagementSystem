<?php
    $db_host = 'localhost'; // Server Name
    $db_user = 'root'; // Username
    $db_pass = ''; // Password
    $db_name = 'payroll'; // Database Name

    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    if (!$conn) {
      die ('Failed to connect to MySQL: ' . mysqli_connect_error());  
    }

    $sql = 'SELECT first_name, second_name, last_name, employee_no FROM employee';
        
    $query = mysqli_query($conn, $sql);

    if (!$query) {
      die ('SQL Error: ' . mysqli_error($conn));
    }
?>

<!DOCTYPE html>
<html>
<head>
  <title></title>

    <script src="jquery-1.12.4.min.js"></script>
    <link rel="stylesheet" href="datatables.min.css"/>
    <script src="datatables.min.js"></script>

  <script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
  </script>

</head>
<body>
  <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Employee Number</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </thead>
        <tbody>
            <?php
              while ($row = mysqli_fetch_array($query))
              {
                echo '<tr>
                        <td>'.$row['first_name'].' '.$row['second_name'].' '.$row['last_name'].'</td>
                        <td>'.$row['employee_no'].'</td>
                      </tr>';
              }
              ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </tfoot>
    </table>
</body>
</html>