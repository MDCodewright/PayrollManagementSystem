<?php
    session_start();
    include('employee_dashboard.php');
    $db_host = 'localhost'; // Server Name
    $db_user = 'root'; // Username
    $db_pass = ''; // Password
    $db_name = 'payroll'; // Database Name

    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    $userpresent = $_SESSION["employeeNumber"];



    $select_query = "SELECT first_name, second_name, last_name FROM employee WHERE employee_no='$userpresent'";
    $select_result=mysqli_query($conn,$select_query);
    if (!$select_result) {
        die ('SQL Error: ' . mysqli_error($conn));
    }
    while ($row = mysqli_fetch_assoc($select_result))
    {
        $firstName = $row['first_name'];
        $secondName = $row['second_name'];
        $lastName = $row['last_name'];
    }
    $full_name=$firstName.' '.$secondName.' '.$lastName;

    $select_salary_query = "SELECT basic_salary,house_allowance,transport_allowance FROM finance WHERE employee_no='$userpresent'";
    $select_salary_query_result = mysqli_query( $conn, $select_salary_query );
    $data   = $select_salary_query_result->fetch_all(MYSQLI_ASSOC);
    foreach ($data as $row)
    {
        $totalSalary = $row['basic_salary']+$row['house_allowance']+$row['transport_allowance'];
    }

    $totalAdvance=array();
    $select_advance = "SELECT amount FROM application WHERE employee_no='$userpresent' AND status='approved' ";
    $select_advance_result = mysqli_query( $conn, $select_advance );
    $dataAdvance   = $select_advance_result->fetch_all(MYSQLI_ASSOC);

    foreach ($dataAdvance as $row)
   {
       $totalAdvance[]=$row['amount'];
   }
    $totalAdvanceAmount =  array_sum($totalAdvance);


    if (!$select_salary_query_result) {
        die ('SQL Error: ' . mysqli_error($conn));
    }






?>

<!DOCTYPE html>
<html>

<head>
    <title>Request Advance | Employee </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <script src="js/jquery-1.12.0.min.js">
    </script>
    <script src="js/bootstrap.min.js">
    </script>
</head>
<body>
    <div class="container">
    <div class="col-sm-offset-2 col-sm-8">
    <div class="panel panel-primary">
        <div class="panel-heading">Request For Advance</div>
        <div class="panel-body">
            <form class="form-horizontal" method="POST" action="advance_request_db.php">
                <?php
                    echo
                        '<div class="form-group">
                            <div class="col-sm-offset-1 col-sm-2">
                                <label>Name:</label>
                            </div>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" id="name" name="name" readonly
                                   value="'.$full_name.'">
                        </div>
                    </div>';
                ?>
                <div class="form-group">
                    <div class="col-sm-3">
                        <label>Employee Number:</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="employee_no" name="employee_no" readonly
                               value="<?php echo $userpresent;?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-1 col-sm-2">
                        <label>Reason:</label>
                    </div>
                    <div class="col-sm-9">
                        <select class="form-control" id="reasons" name="reason" required>
                            <option value="School fees">   School fees</option>
                            <option value="Hospital Bill"> Hospital Bill </option>
                            <option value="Emergency">     Emergency </option>
                            <option value="Repay a  Loan"> Loan repayment </option>
                            <option value="Rent">          Rent Payment </option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                                <div class="col-sm-offset-1 col-sm-2">
                                    <label>Maximum Advance:</label>
                                </div>
                                <div class="col-sm-9">
                                <input type="text" class="form-control" id="max_amount" name="max_amount" readonly
                                       value="
                                        <?php echo ($totalSalary/2)-$totalAdvanceAmount;?>">
                            </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-1 col-sm-2">
                        <label>Amount:</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="amount" name="amount" placeholder="Enter your amount" required="" max="<?php echo ($totalSalary/2)-$totalAdvanceAmount;?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-8 col-sm-4">
                        <input class="form-control" type="submit" value="SEND"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
    </div>

<script>

</script>
</body>
</html>
