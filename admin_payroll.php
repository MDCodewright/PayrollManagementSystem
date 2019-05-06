<?php
  // start seesion
  session_start();
  include 'advance_dash.php';
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "payroll";
  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  } 
 if(isset($_GET['id']))
 {
 	$id = $_GET['id'];
 	$query = mysqli_query($conn, "SELECT * FROM advance WHERE employee_no = '$id'");
 	$result = mysqli_fetch_array($query);

 	$employee_no = $result['employee_no'];
 	$amount = $result['amount'];
  $name = $result['name'];

 }
  ?>
 
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="utf-8">
    <title>employee project</title>
  </head>
  <style>
  #class_project
  {
    float: right;
  }
</style>
  <body>
   <center> <div class="container-fluid">
      <div class="col-sm-6">
        <div class="cpanel panel-panel">PAYROLL CALCULATOR</div>

        <form action="insert_payrolldata.php" method="POST">
          <table class="table table-bordered">
            <tr>
            <td>Employee Name</td>
             <td><input type="text" name="name" value="<?php echo $name ?>" required="required" readonly="readonly"></td>
            </tr>
            <tr>
            <td>Employee Number</td>
             <td><input type="text" name="emp_no" value="<?php echo $employee_no ?>" required="required" readonly="readonly" ></td>
            </tr>
            <br>
            <tr>
              <td>Advance</td>
              <td><input type="number" name="advance" value="<?php echo $amount ?>" required="required"></td>
            </tr>
            <br>
            <tr>
              <td>NHIF deduction</td>
              <td><input type="number" name="nhif" required="required"></td>
            </tr>
            <br>
            <tr>
              <td>NSSF deduction</td>
              <td><input type="number" name="nssf" required="required"></td>
            </tr>
            <br>
            <tr>
            	<td>Basic Salary</td>
              <td><input type="number" name="basic" required="required"></td>
            </tr>
            <br>
            <tr>
              <td>House Allowance</td>
              <td><input type="number" name="house_allowance" required="required"></td>
            </tr>
            <br>
            <tr>
              <td>Transport Allowance</td>
              <td><input type="number" name="transport_allowance"  required="required"></td>
            </tr>
            <br>
            <tr>
              <td>Hours Overwork(Optional)</td>
              <td><input type="number" name="hours"></td>
            </tr>
            <br>
            <tr>
              <td>Rate per Hour Overworked(Optional)</td>
              <td><select name="rate">
              	<option>Select Rate</option>
              	<option value="100">100</option>
                <option value="200">200</option>
                <option value="500">500</option>
                <option value="1000">1000</option>
            </select>
                </td>
            </tr>
            <br>
             <tr>
              <td>Year</td>
              <td><select name="year">
              	<option>Select Year</option>
                <option value="2016">2016</option>
              	<option value="2017">2017</option>
                <option value="2018">2018</option>
                
            </select>
                </td>
            </tr>
            <br>
            <tr>
              <td>Month</td>
              <td><select name="month">
              	<option>Select Month</option>
              	<option value="January">January</option>
                <option value="February">February</option>
                <option value="March">March</option>
                <option value="April">April</option>
                <option value="May">May</option>
                <option value="June">June</option>
                <option value="July">July</option>
                <option value="August">August</option>
                <option value="September">September</option>
                <option value="October">October</option>
                <option value="November">November</option>
                <option value="December">December</option>
               
            </select>
                </td>
            </tr>
          </table>
        <input type="submit" name="submit" value="INSERT">
        </form>
    </div>
    </div>
  </center>
  </body>
  </html>
  