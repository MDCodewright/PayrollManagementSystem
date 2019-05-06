<?php

        require_once __DIR__."/config.php";
        require_once __DIR__."/EnvayaSMS.php";
        $servername="localhost";
        $username="root";
        $password="";
        $dbname="payroll";
         $con=mysqli_connect($servername,$username,$password,$dbname)or die("couldnt connect");
         $employeeNumber=$_POST['employee_no'];
         $reason=$_POST['reason'];
         $amount=$_POST['amount'];
         $fullName=$_POST['name'];


        $query_if_pending="SELECT status FROM application WHERE employee_no='$employeeNumber' AND status='pending'";
        $query_result=mysqli_query($con,$query_if_pending);
        if (!$query_result)
        {
            die('Query did not run');
        }
        else{
            if(mysqli_num_rows($query_result)==NULL)
            {

                $query= "INSERT INTO application(`employee_no`,`user_name`,`reason`, `amount`,`status`) VALUES('$employeeNumber','$fullName','$reason',$amount,'pending')";

                $submit= mysqli_query($con,$query) or die ("Couldn't submit");

                if($submit){

                    $message = new EnvayaSMS_OutgoingMessage();
                    $message->id = uniqid("");
                    $message->to = "+254707440470";
                    $message->message = "Hello HR. You have a new advance application. Kindly check online. Thanks.";

                    file_put_contents($OUTGOING_DIR_NAME."/{$message->id}.json", json_encode($message));

                    echo "<script>alert('Advance request was sent. We shall notify upon approval or denial. Thank you.');
                    window.location.href = 'employee_home.php';
                   </script>";

                }


            }
            else{

                echo "<script>alert('Please wait for the approval of previous request. Thank you.');
                    window.location.href = 'employee_home.php';
                   </script>";

            }

        }



?>