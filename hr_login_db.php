<?php

$db_host = 'localhost'; // Server Name
$db_user = 'root'; // Username
$db_pass = ''; // Password
$db_name = 'payroll'; // Database Name
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (isset($_POST['uname'])&&isset($_POST['password']))
{

    $username=$_POST['uname'];
    $password=$_POST['password'];


    $query="SELECT username,password FROM administrator WHERE username='$username' AND password='$password'";
    if (!$query_run=mysqli_query($conn,$query))
    {
        die('Query did not run');
    }

    else{
        if (mysqli_num_rows($query_run) == NULL) {
            echo '<script type="text/javascript">';
            echo 'alert("User doesn\'t exist");';
            echo 'window.location.href= "hr_login.php";';
            echo '</script>';
        }
        else{
            echo '<script type="text/javascript">';
            echo 'alert("You are most welcome");';
            echo 'window.location.href= "hr_home.php";';
            echo '</script>';
        }
    }

}