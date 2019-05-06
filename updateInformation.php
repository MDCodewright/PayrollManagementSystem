<?php
 session_start();

  include('employee_dashboard.php');
  mysql_connect('localhost','root','');
    mysql_select_db('payroll');
    if (isset($_POST['email'])&&isset($_POST['phone_no'])&&isset($_POST['place'])&&isset($_POST['religion']))
    {
            $userpresent = $_SESSION["employeeNumber"];
            $email=$_POST['email'];
            $phone_no=$_POST['phone_no'];
            $place=$_POST['place'];
            $religion=$_POST['religion'];

            $query = "UPDATE employee SET email_adress = '$email', phone_no = '$phone_no',religion = '$religion',place_of_residence = '$place' WHERE employee_no = '$userpresent'";
            if (!$query_run=mysql_query($query))
            {
              die('Query did not run');
            }  
            else{
              echo '<script type="text/javascript">'; 
              echo 'alert("Update was successful");'; 
              echo 'window.location.href= "employee_home.php";';
              echo '</script>'; 
            }

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

	<div class="container col-sm-offset-1 col-sm-4">
		<div class="panel panel-primary">
			<div class="panel-heading"> Update Details</div>
			<div class="panel-body">
				<form class="form-horizontal" method="POST" action="updateInformation.php">
					      <div class="form-group">
            			<div class="col-sm-offset-1 col-sm-1">
                			<span class="glyphicon glyphicon-envelope" />
            			</div>
            			<div class="col-sm-10"> 
             				<input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required="">
            			</div>
          			</div>
          			<div class="form-group">
            			<div class="col-sm-offset-1 col-sm-1">
                			<span class="glyphicon glyphicon-earphone" />
            			</div>
            			<div class="col-sm-10"> 
              				<input type="number" class="form-control" id="phone_no" name="phone_no" placeholder="Enter phone number" required="" min="0700000000" max="0799999999">
            			</div>
            		</div>
                <div class="form-group">
                  <div class="col-sm-offset-1 col-sm-1">
                      <span class="glyphicon glyphicon-home" />
                  </div>
                  <div class="col-sm-10"> 
                      <input type="text" class="form-control" id="place" name="place" placeholder="Place of Residence" required="" pattern="[a-zA-Z]*">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-1 col-sm-1">
                      <span class="glyphicon glyphicon-unchecked" />
                  </div>
                  <div class="col-sm-10"> 
                  <select class="form-control" id="religion" name="religion">
                    <option value="CHRISTIAN">Christian</option>
                    <option value="MUSLIM">Muslim</option>
                    <option value="HINDU">Hindu</option>
                  </select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-9 col-sm-3">
                    <input type="submit" name="update_button" class="btn btn-primary" />
                  </div>
                  
                </div>
				</form>
			</div>
		</div>
	</div>

</body>
</html>