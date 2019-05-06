<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "payroll";

	$old_pass =$_POST["oldpwd"];
	$passwordSet = $_POST['newpassword'];

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

	$sql = "UPDATE employee SET password='$passwordSet' WHERE password='$old_pass'";
	$result = $conn->query($sql);

	if ($result){
	    echo '<script>
                alert("Password changed successfully");
                window.location.href="employee_home.php";
              </script>';
    }
