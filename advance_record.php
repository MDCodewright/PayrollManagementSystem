<?php
    include('hr_dashboard.php');
    $db_host = 'localhost'; // Server Name
    $db_user = 'root'; // Username
    $db_pass = ''; // Password
    $db_name = 'payroll'; // Database Name

    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    if (!$conn) {
        die ('Failed to connect to MySQL: ' . mysqli_connect_error());
    }


    $sql = 'SELECT amount,employee_no,user_name,reason,status FROM application';
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


    <link rel="stylesheet" type="text/css" href="datatables.min.css"/>

    <script type="text/javascript" src="datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
            //clickable row


        } );

    </script>

</head>
<body>
<table id="example" class="display" style="width:100%">
    <thead>
    <tr>
        <th>Name</th>
        <th>Employee Number</th>
        <th>Amount</th>
        <th>Reason</th>
        <th>Status</th>


    </tr>
    </thead>
    <tbody>

    <?php
    while ($row = mysqli_fetch_array($query)) {
        echo
            '<tr>
                            <td>' . $row['user_name'] . '</td>
                            <td> ' . $row['employee_no'].'</td>
                            <td>' . $row['amount'] . '</td>
                            <td>' . $row['reason'] . '</td>
                            <td>' . $row['status'] . '</td>
                        </tr>'
        ;
    }?>

    </tbody>
    <tfoot>
    <tr>
        <th>Name</th>
        <th>Employee Number</th>
        <th>Amount</th>
        <th>Reason</th>
        <th>Status</th>

    </tr>
    </tfoot>
</table>
</body>
</html>