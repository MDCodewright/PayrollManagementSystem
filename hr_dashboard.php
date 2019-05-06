<?php

    mysql_connect('localhost','root','');
    mysql_select_db('payroll');
    
    
    $query="SELECT id FROM employee WHERE status='unverified'";
    if (!$query_run=mysql_query($query))
    {
      die('Query did not run');
    }  
    else{
       if(mysql_num_rows($query_run)==NULL)
         {
           $counter = 0;
         }
       else{
            $counter = mysql_num_rows($query_run);
           }
      
     }

        $query_advance="SELECT employee_no FROM application WHERE status='pending'";
        if (!$query_advance_run=mysql_query($query_advance))
        {
            die('Query did not run');
        }
        else{
            if(mysql_num_rows($query_advance_run)==NULL)
            {
                $counterAdvance = 0;
            }
            else{
                $counterAdvance = mysql_num_rows($query_advance_run);
            }

        }

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>HR | Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css" />
    <script src="js/jquery-1.12.0.min.js">
    </script>
    <script src="js/bootstrap.min.js">
    </script>
    <script src="changePass.js"></script>


    <style type="text/css">
      .activeclass{
        background-color: black;
        color: white;
      }
    </style>

    <script type="text/javascript">
        function checkPassword(){
            var newpwd=document.getElementById('newpwd').value;
            var reenterpwd=document.getElementById('reenterpwd').value;
            if (newpwd!=reenterpwd) {
                alert('Password doesn\'t match');
            }
        }
    </script>

</head>
<body>

<nav class="navbar" style="background-color: #337ab7;">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar" style="color: white;"></span>
        <span class="icon-bar" style="color: white;"></span>
        <span class="icon-bar" style="color: white;"></span>
      </button>
      <a class="navbar-brand" href="hr_home.php" style="color: white;">Admin</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="hr_home.php" style="color: white;">Home</a></li>
      <li><a href="advance_record.php" style="color: white;">Advance Record</a></li>
          <li><a href="finance_info.php" style="color: white;">Finance Information</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color: white;">Reports <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="monthly_report_advance_request.php">Report on monthly advance request</a></li>
          </ul>
        </li>
      </ul>


      <ul class="nav navbar-nav navbar-right">
        <li><a href="new_employees.php" id="notify_text" style="color: white;">New Employees <label id="counter"></label><span class="glyphicon glyphicon-bell" id="notify">
          <?php 
          if($counter > 0 )
            echo "<script>
                    document.getElementById('notify').style.color = 'red';
                    document.getElementById('notify_text').style.color = 'red';
                    document.getElementById('counter').innerText= '($counter)';
                  </script>";
         ?></span></a></li>
          <li><a href="advance_approval.php" id="advance_notify_text" style="color: white;">Advance Requests<label id="counterAdvance"></label><span class="glyphicon glyphicon-bell" id="advance_notify">
          <?php
          if($counterAdvance > 0 )
              echo "<script>
                    document.getElementById('advance_notify').style.color = 'red';
                    document.getElementById('advance_notify_text').style.color = 'red';
                    document.getElementById('counterAdvance').innerText= '($counterAdvance)';
                  </script>";
          ?></span></a></li>
<!--        <li><a type="button" data-toggle="modal" data-target="#changePassword" style="color: white;"><span class="glyphicon glyphicon-user"></span> Change Password</a></li>-->

        <li><a href="hr_login.php" style="color: white;"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>



<!-- change password -->
<div class="modal fade" id="changePassword" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" align="center">
                CHANGE PASSWORD
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" action="change_password.php" method="POST" autocomplete="on" onsubmit="checkPassword()">
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="oldpwd">Old Password:</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" placeholder="Enter old password..." id="oldpwd" name="oldpwd" required onkeypress="processStart()">
                        </div>
                        <div id="underOldPwd"></div>

                    </div>
                    <div class="form-group">
                        <label  class="control-label col-sm-4" for="pwd">New Password:</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" placeholder="Enter new password..." id="newpwd" name="password" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="control-label col-sm-4" for="pwd">Re-Enter New Password:</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" placeholder="Re-enter new password..." id="reenterpwd" name="password" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group">
                            <div class="col-sm-offset-6">
                                <div class="col-sm-3">
                                    <button type="submit" class="btn btn-default">Change Password</button>
                                </div>
                            </div>
                            <div class="col-sm-offset-10">
                                <div class="col-sm-2">
                                    <a href="Doctor_Dashboard.php" type="button"><button type="button" class="btn btn-default">Cancel</button></a>
                                </div>

                            </div>
                        </div>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>

