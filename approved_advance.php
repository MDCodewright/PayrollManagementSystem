<?php

    require_once __DIR__."/config.php";
    require_once __DIR__."/EnvayaSMS.php";

    $employeeNumber = $_GET['employee_numb'];
    $db_host = 'localhost'; // Server Name
    $db_user = 'root'; // Username
    $db_pass = ''; // Password
    $db_name = 'payroll'; // Database Name

    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);


    $query_number ="SELECT phone_no,first_name FROM employee WHERE employee_no='$employeeNumber'";
    $query_num_result=mysqli_query($conn,$query_number);

    while ($row = $query_num_result->fetch_assoc()){
        $firstName= $row['first_name'];
        $phoneNumber = $row['phone_no'];
    }

    if (!$query_num_result)
    {
        die('Query did not run');
    }


    $query = "UPDATE application SET status = 'approved' WHERE employee_no = '$employeeNumber' AND status='pending'";





    if (!$query_run=mysqli_query($conn,$query))
    {
        die('Query did not run');
    }
    else{
        $message = new EnvayaSMS_OutgoingMessage();
        $message->id = uniqid("");
        $message->to = "+254$phoneNumber";
        $message->message = "Hello $firstName. Your advance request has been approved. Kindly check with the finance. Thanks.";
        file_put_contents($OUTGOING_DIR_NAME."/{$message->id}.json", json_encode($message));

        echo '<script type="text/javascript">';
        echo 'alert("Advance request approved successfully");';
        echo 'window.location.href= "hr_home.php";';
        echo '</script>';
    }

