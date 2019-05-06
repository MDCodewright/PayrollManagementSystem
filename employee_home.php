<?php
	// start seesion
	session_start();
	include 'employee_dashboard.php';
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "payroll";

	//login information
	$userlog = $_SESSION["employeeNumber"];

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
	$sqlbasicinfo = "SELECT employee_no, first_name, second_name, last_name, id_no, gender, date_of_birth, religion FROM employee WHERE employee_no='$userlog'";
	$sqlcontactinfo = "SELECT email_adress, phone_no, place_of_residence FROM employee WHERE employee_no='$userlog'";
	$sqlfinancialinfo = "SELECT bank_name, acount_no FROM employee WHERE employee_no='$userlog'";
	$resultbasicinfo = $conn->query($sqlbasicinfo);
	$resultcontactinfo = $conn->query($sqlcontactinfo);
	$resultfinancialinfo = $conn->query($sqlfinancialinfo);

	// output data
	echo "<div class='container-fluid'>";
	if (!empty($resultbasicinfo)) {
	    echo "<div class='col-sm-6'>
			  <div class='panel panel-primary'>
	  		  <div class='panel-heading'>Basic Information</div>
	  		  <div class='panel-body'>
	            <table class='table table-bordered'>";
	    // output data of each row
	    while($row = $resultbasicinfo->fetch_assoc()) {
	        echo "<tr><td>Employee Number</td><td>".$row["employee_no"]."</tr>
	        	  <tr><td>Name</td><td>".$row["first_name"]." ".$row["second_name"]." ".$row["last_name"]."</td></tr>
	        	  <tr><td>ID Number</td><td>".$row["id_no"]."</td></tr>
	        	  <tr><td>Gender</td><td>".$row["gender"]."</td></tr>
	        	  <tr><td>Date of Birth</td><td>".$row["date_of_birth"]."</td></tr>
	        	  <tr><td>Religion</td><td>".$row["religion"]."</td></tr>";
	    }
	    echo "</table></div></div></div>";
	}
    if(!empty($resultcontactinfo)) {
    echo "<div class='col-sm-6'>
		  <div class='panel panel-primary'>
  		  <div class='panel-heading'>Contact Information</div>
  		  <div class='panel-body'>
            <table class='table table-bordered'>";
    // output data of each row
    while($row = $resultcontactinfo->fetch_assoc()) {
        echo "<tr><td>E-mail</td><td>".$row["email_adress"]."</tr>
        	  <tr><td>Phone Number</td><td>".$row["phone_no"]."</td></tr>
        	  <tr><td>Place of Residence</td><td>".$row["place_of_residence"]."</td></tr>";
    }
    echo "</table></div></div></div>";
	    
	}
	echo "</div>";
	// financial information
	echo "<div class='container-fluid'>";
	if (!empty($resultfinancialinfo)) {
	    echo "<div class='col-sm-6'>
			  <div class='panel panel-primary'>
	  		  <div class='panel-heading'>Financial Information</div>
	  		  <div class='panel-body'>
	            <table class='table table-bordered'>";
	    // output data of each row
	    while($row = $resultfinancialinfo->fetch_assoc()) {
	        echo "<tr><td>Bank Name</td><td>".$row["bank_name"]."</tr>
	        	  <tr><td>Account Number</td><td>".$row["acount_no"]."</td></tr>";
	    }
	    echo "</table></div></div></div></div></div>";
	}

	$conn->close();

 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title> Home | Employee</title>
 	<link rel="stylesheet" type="text/css" href="index.css">
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <script src="C:\xampp\htdocs\GroupEmployeeProject\js\jquery-1.12.0.min.js">
    </script>
    <script src="C:\xampp\htdocs\GroupEmployeeProject\js\bootstrap.min.js">
    </script>
 </head>
 <body>
 	<div class="container-fluid">
			<div class="col-sm-offset-4 col-sm-2">
			<a href="updateInformation.php"><button class="btn btn-primary">Update Information</button></a>
			</div>
	</div>
 </body>
 </html>