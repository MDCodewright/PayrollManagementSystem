<?php

    include('hr_dashboard.php');
    $db_host = 'localhost'; // Server Name
    $db_user = 'root'; // Username
    $db_pass = ''; // Password
    $db_name = 'payroll'; // Database Name

    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    $userpresent = $_GET["employeeNumber"];



        $select_query = "SELECT first_name, second_name, last_name,bank_name,acount_no FROM employee WHERE employee_no='$userpresent'";

        $select_result=mysqli_query($conn,$select_query);
        if (!$select_result) {
            die ('SQL Error: ' . mysqli_error($conn));
        }


?>
<!DOCTYPE html>
<html>
<head>
    <title> Update Info | Employee Home</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <script src="js/jquery-1.12.0.min.js">
    </script>
    <script src="js/bootstrap.min.js">
    </script>

</head>
<body>

<div class="container col-sm-offset-1 col-sm-5">
    <div class="panel panel-primary">
        <div class="panel-heading"> Update Details</div>
        <div class="panel-body">
            <form class="form-horizontal" method="POST" action="send_updated_info.php">
                <?php
                    while ($row = mysqli_fetch_array($select_result))
                    {

                        echo
                            '<div class="form-group">
                            <div class="col-sm-4">
                                 <label class="control-label">Employee Name:</label>
                            </div>
                            <div class="col-sm-8">
                            <input type="text" class="form-control" id="name" name="name" readonly
                                   value="'.$row['first_name'].' '.$row['second_name'].' '.$row['last_name'].'">
                        </div>
                    </div>';
                    }
            ?>
                <div class="form-group">
                    <div class="col-sm-4">
                        <label class="control-label">Employee Number</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="employee_no" name="employee_no" readonly
                               value="<?php echo $userpresent;?>">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-4">
                        <label class="control-label">Basic Salary</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" id="basic_pay" name="basic_pay" placeholder="Enter the basic salary" required="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4">
                        <label class="control-label">Transport Allowance</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" id="transport_allowance" name="transport_allowance" placeholder="Enter transport allowance" required="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4">
                        <label class="control-label">House Allowance</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" id="house_allowance" name="house_allowance" placeholder="Enter transport allowance" required="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4">
                        <label class="control-label">Overtime Rate</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" id="overtime_rate" name="overtime_rate" placeholder="Overtime Rate per Hour(Ksh.)" required="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-9 col-sm-3">
                        <input type="submit" class="btn btn-primary" value="UPDATE" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
