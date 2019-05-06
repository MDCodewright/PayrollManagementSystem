<?php

        require_once __DIR__."/config.php";
        require_once __DIR__."/EnvayaSMS.php";

        $db_host = 'localhost'; // Server Name
        $db_user = 'root'; // Username
        $db_pass = ''; // Password
        $db_name = 'payroll'; // Database Name

        $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
        if (!$conn) {
            die ('Failed to connect to MySQL: ' . mysqli_connect_error());
        }
        $user_id_no = $_GET["idNumber"];

        $sql_select_id = "SELECT id,phone_no,first_name,second_name,last_name FROM employee WHERE id_no='$user_id_no'";
        $query_id = mysqli_query($conn, $sql_select_id);

        //insert employee number into finance


        while ($row = mysqli_fetch_array($query_id)) {
            $user_id=$row['id'];
            $user_phoneNumber=$row['phone_no'];
            $user_name=$row['first_name'];
            $second_name=$row['second_name'].' '.
            $last_name=$row['last_name'];
        }

        $message = new EnvayaSMS_OutgoingMessage();
        $message->id = uniqid("");
        $message->to = "+254$user_phoneNumber";
        $message->message = "Hello $user_name. Your employee number is 00$user_id. Use your ID number as password to log in.";

        file_put_contents($OUTGOING_DIR_NAME."/{$message->id}.json", json_encode($message));

        $name = $user_name. ' ' . $second_name .' '. $last_name;


        $query_update = "UPDATE employee SET employee_no = '00$user_id',status='verified' WHERE id_no='$user_id_no'";
//        $query_advance = "INSERT INTO application(`employee_no`,`user_name`) VALUES ('00$user_id','$name')";
        $query_finance = "INSERT INTO finance(`employee_no`) VALUES ('00$user_id')";
        $query_salary = "INSERT INTO salary(`employee_no`,`username`,`status`) VALUES ('00$user_id','$name','incomplete')";


        $query_run_finance=mysqli_query($conn, $query_finance);
//        $query_run_advance=mysqli_query($conn, $query_advance);
        if (!$query_run=mysqli_query($conn, $query_update))
        {

                    die('Query did not run');
        }
        else{
            echo '<script type="text/javascript">';
            echo 'alert("Verification was successful. Thank you");';
            echo 'window.location.href="update_info.php?employeeNumber='."00$user_id".'";';
            echo '</script>';
        }







?>