<?php

    //start ses
//0716213530
//sion
    session_start();

    mysqli_connect('localhost','root','');
    mysqli_select_db('payroll');
    if (isset($_POST['employee_no'])&&isset($_POST['password']))
    {
            $employeeNumber=$_POST['employee_no'];
            $password=$_POST['password'];

            //get the id
            $_SESSION["employeeNumber"] = $employeeNumber;
            //set cookie


            $query="SELECT employee_no,password FROM employee WHERE employee_no='$employeeNumber' AND password='$password'";
        if (!$query_run=mysqli_query($query))
        {
            die('Query did not run');
        }   
        
        else{
            if (mysqli_num_rows($query_run) == NULL) {
                echo "<script>alert('User doesn\'t exist');</script>";
                }
            else{
                echo "<script>alert('Hello Sir. Karibu');
                        window.location.href='employee_home.php';
                        </script>";
                }
            }
            
    }
   

?>
<!DOCTYPE html>
<html>
<head>
    <title>Welcome to Payroll Management System | Login</title>
    <link rel="stylesheet" type="text/css" href="index.css">
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <script src="js/jquery-1.12.0.min.js">
    </script>
    <script src="js/bootstrap.min.js">
    </script>

    <script>
        function validate(){
            var patt='/[a-z}/';
            // var patt=[abc];
            var x=document.getElementById('name').value;
            if(patt.test(x)!=true){
                document.getElementById('name').style.color='red';
                var r=alert('Invalid name.\nName must not contain numbers!!');

                // var alert =alert('Invalid name.\nName must not contain numbers!!');
                if (r==true) {
                    alert("Please correct your name");
                }
            }
        }
    </script>

<!-- styling -->

</head>
<body>
    <div class="container">
    <div class="col-sm-5" style="padding-top: 20%; font-size: 450%; color: blue;">
        WELCOME
    </div>
    <div class="col-sm-2">
        <hr style="border-left: 3px solid blue;
            height: 500px;
            position: absolute;
            left: 50%;
            margin-left: -3px;
            top: 0;">
    </div>
    <div class="col-sm-5" style="padding-top: 17%;">
        <form class="form-horizontal" role="form" action="index.php" method="POST">
            <div class="form-group">
            <label class="control-label col-sm-4" for="email">Employee Number:</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="email" name="employee_no" placeholder="Enter employee number" required="">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-4" for="pwd">Password:</label>
            <div class="col-sm-8"> 
              <input type="password" class="form-control" id="pwd" name="password" placeholder="Enter password" required="">
            </div>
          </div>
          <div class="form-group"> 
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
              <button type="submit" class="btn btn-primary">Login</button>
            </div>
            <div class="col-sm-4"> 
                <button type="button" class="btn btn-primary" onclick="document.getElementById('id01').style.display='block'">Sign Up</button>
            </div>
          </div>
        </form>
    </div>
</div>



<!-- styling -->
<!-- The Modal -->
<div id="id01" class="modal">
    <div class="col-sm-offset-3 col-sm-6">
  <div class="panel panel-primary">
    <div class="panel-heading">Sign Up Below</div>
    <div class="panel-body">
          <form class="form-horizontal" class="modal-content animate" method="POST" action="registerEmployee.php">
          <div class="form-group">
            <div class="col-sm-offset-1 col-sm-1">
                <span class="glyphicon glyphicon-user" />
            </div>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter first name" required="" pattern="[a-zA-Z]*">
              </div>
          </div>
          <div class="form-group">
              <div class="col-sm-offset-1 col-sm-1">
                  <span class="glyphicon glyphicon-user" />
              </div>
              <div class="col-sm-8">
                  <input type="text" class="form-control" id="sname" name="sname" placeholder="Enter second name" required="" pattern="[a-zA-Z]*">
              </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-1 col-sm-1">
                <span class="glyphicon glyphicon-user" />
            </div>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="lname" name="lname" placeholder="Enter last name" required="" pattern="[a-zA-Z]*">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-1 col-sm-1">
                <span class="glyphicon glyphicon-modal-window" />
            </div>
            <div class="col-sm-8"> 
              <input type="number" class="form-control" id="id_no" name="id_no" placeholder="Enter id number" required="">
            </div>
          </div>
          <div class="form-group">
                    <label class="col-sm-2">Birth Date</label>
                  <div class=" col-sm-3">
                      <input type="date" class="form-control" name="birth_day" max="2000-01-01" required=""/>
                  </div>
                    <div class="col-sm-offset-1 col-sm-2">
                        <label class="radio-inline"><input type="radio" name="gender" value="MALE" required="">Male</label>
                    </div>
                    <div class="col-sm-2">
                      <label class="radio-inline"><input type="radio" name="gender" value="FEMALE" required="">Female</label>
                    </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-1 col-sm-1">
                <span class="glyphicon glyphicon-briefcase" />
            </div>
            <div class="col-sm-8">
                    <select class="form-control" id="bank" name="bank" required="">
                        <option value="EQUITY">    Equity Bank</option>
                        <option value="COOP"> Cooperative Bank </option>
                        <option value="KCB"> KCB </option>
                        <option value="FAMILY"> Family Bank </option>
                        <option value="POST"> Post Bank </option>
                        <option value="NATIONAL"> National Bank </option>
                    </select>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-1 col-sm-1">
                <span class="glyphicon glyphicon-list-alt" />
            </div>
            <div class="col-sm-8"> 
              <input type="number" class="form-control" id="bank_no" name="bank_no" placeholder="Enter account number" required="">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-1 col-sm-1">
                <span class="glyphicon glyphicon-envelope" />
            </div>
            <div class="col-sm-8"> 
              <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required="">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-1 col-sm-1">
                <span class="glyphicon glyphicon-phone" />
            </div>
            <div class="col-sm-8"> 
              <input type="number" class="form-control" id="phone_no" name="phone_no" placeholder="Enter phone number" min="0700000000" max="0799999999" required="">
            </div>
          </div>
          <div class="form-group"> 
            <div class="col-sm-offset-2 col-sm-2">
              <button type="submit" class="btn btn-success">Sign Up</button>
            </div>
          </div>
        </form>
      </div>
</div>
<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

</body>

</html>
