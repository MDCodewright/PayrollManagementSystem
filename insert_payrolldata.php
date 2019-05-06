 <?php
  $conn = mysqli_connect("localhost","root","","payroll") or die(mysqli_error($conn));
  if(isset($_POST['submit']))
  {
    $name = $_POST['name'];
  	$emp_no = $_POST['emp_no'];
  	$nhif = $_POST['nhif'];
    $month = $_POST['month'];
    $year = $_POST['year'];
    $advance = $_POST['advance'];
  	$nssf = $_POST['nssf'];
  	$basic_salary = $_POST['basic'];
  	$house_allowance = $_POST['house_allowance'];
  	$transport_allowance = $_POST['transport_allowance'];
  	$hours = $_POST['hours'];
  	$rate = $_POST['rate'];
    

     if($basic_salary > 0 && $basic_salary < 147580)
     {
      $PAYE = 0.1 * $basic_salary;
     }
     else if($basic_salary > 147580 && $basic_salary < 286623)
     {
      $PAYE = 0.15 * $basic_salary;
     }
     else if($basic_salary > 286623)
     {
      $PAYE = 0.2 * $basic_salary; 
     }
     else
     {
      echo "Invalid Amount";
     }
    $overtime = $hours * $rate;
  	$gross_deductions = $nssf + $nhif + $PAYE + $advance;
    $gross_allowance = $overtime + $house_allowance + $transport_allowance;
    $gross_salary = $basic_salary + $gross_allowance;
    $net_salary = $gross_salary - $gross_deductions;

    $insert_data = mysqli_query($conn, "INSERT INTO payroll_data(name, emp_number, nhif, nssf, advance, gross_ded, gross_salary, net_salary, gross_allowance, PAYE, house_allowance, transport_allowance, hours, rate, overtime, basic_salary, month, year) VALUES ('$name','$emp_no','$nhif','$nssf','$advance','$gross_deductions','$gross_salary','$net_salary','$gross_allowance','$PAYE','$house_allowance','$transport_allowance','$hours','$rate','$overtime','$basic_salary','month','$year')") or die(mysqli_error($conn));
    //print_r($insert_data);

    if($insert_data)
    {

      ?>
      <script type="text/javascript">
        window.alert("Employee rate inserted successfully");
        window.location.href="all_employees.php";
      </script>
      <?php
    }
    else
    {
      ?>
      <script type="text/javascript">
        window.alert("Employee rate not inserted");
        window.location.href="all_employees.php";
      </script>
      <?php
    }



  }
  
  
 

  ?>