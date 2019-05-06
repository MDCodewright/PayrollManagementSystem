<?php
    session_start();
    include('hr_dashboard.php');
    $db_host = 'localhost'; // Server Name
    $db_user = 'root'; // Username
    $db_pass = ''; // Password
    $db_name = 'payroll'; // Database Name

    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    if (!$conn) {
        die ('Failed to connect to MySQL: ' . mysqli_connect_error());
    }


    $sql = 'SELECT amount,employee_no,user_name,reason,status FROM application WHERE status="pending"';
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
            $(".clickable_row").click(function(){
                window.location.href="../calculate_pay.php";
            });


        } );
        function denialReason() {
           var reason = prompt("Enter a reason for denial");
           var employeeNum = document.getElementById('employeeNumber').value;
            if (reason == null || reason == "") {
//                window.location.href="advance_approval.php";
            }
            else{
               window.location.href="advance_denial_notification.php?reason="+reason+"&employee_numb="+employeeNum;
               return false;
            }
        }
        function approved() {
            var employeeNum = document.getElementById('employeeNumber').value;
            window.location.href="approved_advance.php?employee_numb="+employeeNum;
        }

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
        <th>Approve</th>
        <th>Deny</th>

    </tr>
    </thead>
    <tbody>

                <?php
                while ($row = mysqli_fetch_array($query)) {
                    echo
                            '<tr>
                            <td>' . $row['user_name'] . '</td>
                            <td> ' . $row['employee_no'] . '
                            <input type="text" value="'.$row['employee_no'].'" id="employeeNumber" style="visibility:hidden;"/>
                            </td></a>
                            <td>' . $row['amount'] . '</td>
                            <td>' . $row['reason'] . '</td>
                            <td>' . $row['status'] . '</td>
                            <td onclick="approved()"><a href="#">Approve</td>
                            <td onclick="denialReason()"><a href="#">Deny</td>
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
        <th>Approve</th>
        <th>Deny</th>
    </tr>
    </tfoot>
</table>
</body>
</html>