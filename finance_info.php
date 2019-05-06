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


    $sql = 'SELECT employee_no,house_allowance,basic_salary,transport_allowance,overtime_rate FROM finance';
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
        <th>Employee Number</th>
        <th>Basic Salary</th>
        <th>House Allowance</th>
        <th>Transport Allowance</th>
        <th>Overtime Rate</th>


    </tr>
    </thead>
    <tbody>

    <?php
    while ($row = mysqli_fetch_array($query)) {
        echo
            '<tr>
                            <td>' . $row['employee_no'] . '</td>
                            <td> ' . $row['basic_salary'].'</td>
                            <td>' . $row['house_allowance'] . '</td>
                            <td>' . $row['transport_allowance'] . '</td>
                            <td>' . $row['overtime_rate'] . '</td>
                        </tr>'
        ;
    }?>

    </tbody>
    <tfoot>
    <tr>
        <th>Employee Number</th>
        <th>Basic Salary</th>
        <th>House Allowance</th>
        <th>Transport Allowance</th>
        <th>Overtime</th>

    </tr>
    </tfoot>
</table>
</body>
</html>