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

    $sql = "SELECT first_name, second_name, last_name, employee_no,bank_name,acount_no FROM employee WHERE status='verified'";
        
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
                window.location.href="calculate_pay.php";

            });


		} );
        
	</script>

</head>
<body>
	<table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Employee Number</th>
                <th>Bank</th>
                <th>Account Number</th>
                <th>Update Information</th>
                <th>Calculate Salary</th>
                
            </tr>
        </thead>
        <tbody>
            <?php
              while ($row = mysqli_fetch_array($query))
              {

                echo
               '<tr>
                    <td>'.$row['first_name'].' '.$row['second_name'].' '.$row['last_name'].'</td>
                    <td>'.$row['employee_no'].'</td></a>
                    <td>'.$row['bank_name'].'</td>
                    <td>'.$row['acount_no'].'</td>
                    <td><a href="update_info.php?employeeNumber='.$row['employee_no'].'">Update Information</td>
                    <td><a href="payroll_calc.php?employeeNumber='.$row['employee_no'].'">Calculate Salary</td>
                </tr>';
              }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Employee Number</th>
                <th>Bank</th>
                <th>Account Number</th>
                <th>Update Information</th>
                <th>Calculate Salary</th>
            </tr>
        </tfoot>
    </table>
</body>
</html>