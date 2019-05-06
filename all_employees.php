<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>



<div class="container_fluid">
  <table>
    <thead>
      <tr>
        <th>Employee ID</th>
        <th>Employee Name</th>
        <th>Employee Number</th>
       
        <th>ACTION</th>
      </tr>
    </thead>
    <tbody>
      <?php
  $conn = mysqli_connect("localhost","root","","payroll") or die(mysqli_error($conn));
    $query = mysqli_query($conn,"SELECT * FROM employee");
    while($row = mysqli_fetch_array($query))
    {

      $id = $row['id'];
      $emp_no = $row['employee_no'];
      $first_name = $row['first_name'];
      $second_name = $row['second_name'];
      $last_name = $row['last_name'];
    ?>

            <tr>
      <td><?php echo $id ?></td>
       <td><?php echo "$first_name" . "$second_name" . "$last_name" ?></td>
      <td><?php echo $emp_no ?></td>
      <td>
        <a href="admin_payroll.php?id=<?php echo $emp_no ?>"><font color="orange">CALC. PAYROLL</font></a></td>
    </tr>
<?php
    }
    ?>
    
    </tbody>
  </table>
</div>
</body>
</html>