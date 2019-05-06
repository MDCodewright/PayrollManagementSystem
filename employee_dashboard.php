<?php

    $db_host = 'localhost'; // Server Name
    $db_user = 'root'; // Username
    $db_pass = ''; // Password
    $db_name = 'payroll'; // Database Name
    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    if (!$conn) {
        die ('Failed to connect to MySQL: ' . mysqli_connect_error());
    }
    $userlog = $_SESSION["employeeNumber"];

    $password = "SELECT password FROM employee WHERE employee_no='$userlog'";
    $password_result = mysqli_query($conn,$password);
    $dataPassword = $password_result ->fetch_all(MYSQLI_ASSOC);
    foreach ($dataPassword as $row)
    {
        $password =$row['password'];
    }


?>


<!DOCTYPE html>
<html>
<head>
  <title> Employee | Home </title>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css" />
    <script src="js/jquery-1.12.0.min.js">
    </script>
    <script src="js/bootstrap.min.js">
    </script>

    <style type="text/css">
      .activeclass{
        background-color: black;
        color: white;
      }
    </style>

</head>
<body>

  <nav class="navbar" style="background-color: #337ab7;">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#wences">
            <span class="icon-bar" style="background-color: white;"></span>
            <span class="icon-bar" style="background-color: white;"></span>
            <span class="icon-bar" style="background-color: white;"></span>                        
          </button>
          <a class="navbar-brand" href="#" style="color: white;">WebSiteName</a>
      </div>
      <div class="collapse navbar-collapse" id="wences">
        <ul class="nav navbar-nav">
            <li class="activeclass"><a href="employee_home.php"><label>Home</label></a></li>
            <li><a href="advance_request.php" style="color: white;"><label>Request Advance Pay</label></a></li>
            <li><a style="color: white;" data-toggle="modal" data-target="#myModal"><label>Request Payslip</label></a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#" data-toggle="modal" data-target="#changePassword"><span class="glyphicon glyphicon-user" style="color: white;"></span>
          <label  style="color: white;">Change Password</label></a></li>
        <li><a href="index.php"><span class="glyphicon glyphicon-log-out" style="color: white;"></span> 
          <label style="color: white;">Logout</label></a></li>
      </ul>
    </div>
  </div>
  </nav>



      <div id="myModal" class="modal fade" role="dialog">
          <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">What can we include? Tick all to get a fully detailed payslip</h4>
                  </div>
                  <form class="form-horizontal" method="POST" action="customised_payslip.php">
                  <div class="modal-body">
                      <div class="checkbox">
                          <label><input type="checkbox" value="gross_salary" name="gross_salary">Gross salary</label>
                      </div>
                      <div class="checkbox">
                          <label><input type="checkbox" value="deductions" name="deductions">Deductions</label>
                      </div>
                      <div class="modal-footer">
                          <input type="submit" class="btn btn-default" value="Submit"/>
                      </div>
                  </div>
                  </form>

              </div>

          </div>
      </div>

<!--Change password modal-->

  <div class="modal fade" id="changePassword" role="dialog">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header" align="center">
                  CHANGE PASSWORD
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
                  <form class="form-horizontal" role="form" action="change_password.php" method="POST" autocomplete="on" onsubmit="checkPass()">
                      <div class="form-group">
                          <label class="control-label col-sm-4" for="oldpwd">Old Password:</label>
                          <div class="col-sm-8">
                              <input type="password" class="form-control" placeholder="Enter old password..." id="oldpwd" name="oldpwd" required onkeypress="checkPass()">
                          </div>
                      </div>
                      <div class="col-sm-offset-4" id="underOldPwd"></div>
                      <div class="form-group">
                          <label  class="control-label col-sm-4" for="pwd">New Password:</label>
                          <div class="col-sm-8">
                              <input type="password" class="form-control" placeholder="Enter new password..." id="newpwd" name="newpassword" required>
                          </div>
                      </div>
<!--                      <div class="form-group">-->
<!--                          <label  class="control-label col-sm-4" for="pwd">Re-Enter New Password:</label>-->
<!--                          <div class="col-sm-8">-->
<!--                              <input type="password" class="form-control" placeholder="Re-enter new password..." id="reenterpwd" name="reenterpassword" required>-->
<!--                          </div>-->
<!--                      </div>-->
<!--                      <div class="col-sm-offset-4" id="underNewPwd"></div>-->
                      <div class="modal-footer">
                          <div class="form-group">
                              <div class="col-sm-offset-4">
                                  <div class="col-sm-8">
                                      <input type="submit" class="btn btn-default" value="Change Password" />
                                  </div>
                              </div>
                          </div>
                      </div>

              </form>
              </div>
          </div>
      </div>
  </div>

<script>
    function checkPass() {
        var oldPass = document.getElementById('oldpwd').value;
        var truePass  = <?php echo $password; ?>;

        if (oldPass != truePass){
            document.getElementById('underOldPwd').style.visibility = 'visible';
            document.getElementById('underOldPwd').innerHTML = 'Incorrect Old Password';
            document.getElementById('underOldPwd').style.color = 'red';
            document.getElementById('oldpwd').focus();
        }
        else{
            document.getElementById('underOldPwd').style.visibility = 'hidden';

        }
    }
//    function validatePass() {
//        var newPass = document.getElementById('newpwd').value;
//        var newPassReenter = document.getElementById('reenterpwd').value;
//        if (newPass != newPassReenter){
//            document.getElementById('underNewPwd').style.visibility = 'visible';
//            document.getElementById('underNewPwd').innerHTML = 'Password doesn\'t match! Reenter password';
//            document.getElementById('underNewPwd').style.color = 'red';
//            document.getElementById('reenterpwd').focus();
//
//        }
//        else{
//            document.getElementById('underNewPwd').style.visibility = 'hidden';
//        }
//    }
</script>

</body>
</html> 