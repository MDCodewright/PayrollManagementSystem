<?php

        $db_host = 'localhost'; // Server Name
        $db_user = 'root'; // Username
        $db_pass = ''; // Password
        $db_name = 'payroll'; // Database Name
        $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

        $userpresent = $_POST["employee_no"];
        $basicSalary=$_POST['basic_pay'];
        $houseAllowance=$_POST['house_allowance'];
        $transportAllowance=$_POST['transport_allowance'];
        $overtimeRate=$_POST['overtime_rate'];

        $query = "UPDATE finance SET basic_salary=$basicSalary,house_allowance=$houseAllowance,transport_allowance=$transportAllowance,overtime_rate=$overtimeRate  WHERE employee_no='$userpresent'";

        if (!$query_run=mysqli_query($conn,$query))
        {
            die('Query did not run');
        }
        else{
            echo '<script type="text/javascript">';
            echo 'alert("Update was successful");';
            echo 'window.location.href= "hr_home.php";';
            echo '</script>';
        }