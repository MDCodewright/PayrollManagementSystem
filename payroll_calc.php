<?php

    include('hr_dashboard.php');
    $db_host = 'localhost'; // Server Name
    $db_user = 'root'; // Username
    $db_pass = ''; // Password
    $db_name = 'payroll'; // Database Name

    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    if (!$conn) {
        die ('Failed to connect to MySQL: ' . mysqli_connect_error());
    }

    $employee_no=$_GET['employeeNumber'];


    $basic_info = "SELECT employee_no, first_name, second_name, last_name FROM employee WHERE employee_no='$employee_no'";
    $basic_info_result = $conn->query($basic_info);
    while($row = $basic_info_result->fetch_assoc()) {
        $firstName = $row['first_name'];
        $secondName = $row['second_name'];
        $lastName = $row['last_name'];
    }


    $sqlgrossearnings = "SELECT basic_salary, transport_allowance, house_allowance, overtime_rate FROM finance WHERE employee_no='$employee_no'";
    $sqlgrossearnings_result = mysqli_query( $conn, $sqlgrossearnings );
    $sqlgrossearningsData  = $sqlgrossearnings_result->fetch_all(MYSQLI_ASSOC);

    foreach ($sqlgrossearningsData as $row_earnings)
    {
        $basicSalary = $row_earnings['basic_salary'];
        $transportAllowance = $row_earnings['transport_allowance'];
        $houseAllowance = $row_earnings['house_allowance'];
        $overtimeRate=$row_earnings['overtime_rate'];
    }

    $totalAdvance=array();
    $select_advance = "SELECT amount FROM application WHERE employee_no='$employee_no' AND status='approved' ";
    $select_advance_result = mysqli_query( $conn, $select_advance );
    $dataAdvance   = $select_advance_result->fetch_all(MYSQLI_ASSOC);

    foreach ($dataAdvance as $row)
    {
        $totalAdvance[]=$row['amount'];
    }
    $totalAdvanceAmount =  array_sum($totalAdvance);



    $conn->close();





 ?>
<!DOCTYPE html>
<html>
<head>
    <title> Home | Employee</title>
    <link rel="stylesheet" type="text/css" href="index.css">
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <script src="js/jquery-1.12.0.min.js">
    </script>
    <script src="js/bootstrap.min.js">
    </script>
</head>
<body>
<div class="container-fluid">
    <form class="form-horizontal" method="POST" action="payslip_generation.php">
    <div class="col-sm-6">

        <div class="panel panel-primary">
            <div class="panel-heading">
                Gross Earnings
            </div>
            <div class="panel-body">
                    <div class="form-group">
                        <div class="col-sm-3">
                            <label>Employee Name</label>
                        </div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="employee_name" name="employee_name" readonly
                                   value="<?php echo $firstName.' '.$secondName.' '.$lastName;?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-3">
                            <label>Employee Number</label>
                        </div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="employee_number" name="employee_number" readonly
                                   value="<?php echo $employee_no;?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-3">
                            <label>Basic salary</label>
                        </div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="basic_salary" name="basic_salary" readonly
                                   value="<?php echo $basicSalary;?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-3">
                            <label>House Allowance</label>
                        </div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="house_allowance" name="house_allowance" readonly
                                   value="<?php echo $houseAllowance;?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-3">
                            <label>Transport Allowance</label>
                        </div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="transport_allowance" name="transport_allowance" readonly
                                   value="<?php echo $transportAllowance;?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-3">
                            <label>Overtime Rate</label>
                        </div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="overtime_rate" name="overtime_rate" readonly
                                   value="<?php echo $overtimeRate;?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-3">
                            <label>Overtime Hours Worked</label>
                        </div>
                        <div class="col-sm-7">
                            <input type="number" class="form-control" id="overtime_hours" name="overtime_hours" value="0" placeholder="Enter the overtime hours worked"/>
                        </div>
                    </div>
                    <div class="form-group">

                        <div class="col-sm-offset-7 col-sm-3">
                            <button type="button" class="btn btn-primary" onclick="calculateGrossDeductions()">Calculate All</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-3">
                            <label>Gross Salary</label>
                        </div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="gross_pay" name="gross_pay" value="" readonly/>
                        </div>
                    </div>
            </div>

        </div>
    </div>
    <div class="col-sm-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Deductions
            </div>
            <div class="panel-body">

                    <div class="form-group">
                        <div class="col-sm-3">
                            <label>Advance</label>
                        </div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="advance" name="advance" readonly value="<?php echo $totalAdvanceAmount; ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-3">
                            <label>NSSF</label>
                        </div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="nssf" name="nssf" readonly value="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-3">
                            <label>NHIF</label>
                        </div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="nhif" name="nhif" readonly value="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-3">
                            <label>INCOME TAX</label>
                        </div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="income_tax" name="income_tax" readonly value="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-3">
                            <label>Personal Relief</label>
                        </div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="personal_relief" name="personal_relief" readonly value="1480" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-3">
                            <label>PAYE</label>
                        </div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="paye" name="paye" readonly value="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div>
                            <div class="col-sm-3">
                                <label>Total Deductions</label>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="deductions" name="deductions" value="" readonly/>
                            </div>
                        </div>
                    </div>


            </div>
        </div>

            <div class="panel panel-primary">
                <div class="panel-heading">
                    NET EARNINGS
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="col-sm-3">
                            <label>Net Pay</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="net_pay" name="net_pay" value="" readonly/>
                        </div>

                        <div class="col-sm-3">
                            <input type="submit" class="btn btn-primary" value="Generate Payslip"></button>
                        </div>

                    </div>
            </div>
         </div>
    </div>
    </form>
</div>
</body>

<script>
    function calculateGrossDeductions() {

        var PAYE;
        var NHIF;

        var NSSF=1080;
        var personalRelief=eval(document.getElementById('personal_relief').value);
        var advance = eval(document.getElementById('advance').value);
        var basicPay= eval(document.getElementById('basic_salary').value);
        var transportAllowance = eval(document.getElementById('transport_allowance').value);
        var houseAllowance = eval(document.getElementById('house_allowance').value);
        var overtimeRate = eval(document.getElementById('overtime_rate').value);
        var overtimeHours = eval(document.getElementById('overtime_hours').value);
        //gross pay updated
        var grossPay = basicPay+transportAllowance+houseAllowance+(overtimeRate*overtimeHours);
        document.getElementById('gross_pay').value = grossPay;
        //calculating paye and nhif
        var grossPAYE=grossPay-NSSF;
        var grossNHIF=grossPay;

        //NHIF
            if(grossNHIF<=5999){
                NHIF = 150;
                document.getElementById('nhif').value = NHIF;
            }
            else if(grossNHIF>=6000 && grossNHIF<=7999){
                NHIF = 300;
                document.getElementById('nhif').value = NHIF;
            }
            else if(grossNHIF>=8000 && grossNHIF<=11999){
                NHIF = 400;
                document.getElementById('nhif').value = NHIF;
            }
            else if(grossNHIF>=12000 && grossNHIF<=14999){
                NHIF = 500;
                document.getElementById('nhif').value = NHIF;
            }
            else if(grossNHIF>=15000 && grossNHIF<=19999){
                NHIF = 600;
                document.getElementById('nhif').value = NHIF;
            }
            else if(grossNHIF>=20000 && grossNHIF<=24999){
                NHIF = 750;
                document.getElementById('nhif').value = NHIF;
            }
            else if(grossNHIF>=25000 && grossNHIF<=29999){
                NHIF = 850;
                document.getElementById('nhif').value = NHIF;
            }
            else if(grossNHIF>=30000 && grossNHIF<=34999){
                NHIF = 900;
                document.getElementById('nhif').value = NHIF;
            }
            else if(grossNHIF>=35000 && grossNHIF<=39999){
                NHIF = 950;
                document.getElementById('nhif').value = NHIF;
            }
            else if(grossNHIF>=40000 && grossNHIF<=44999){
                NHIF = 1000;
                document.getElementById('nhif').value = NHIF;
            }
            else if(grossNHIF>=55000 && grossNHIF<=49999){
                NHIF = 1100;
                document.getElementById('nhif').value = NHIF;
            }
            else if(grossNHIF>=50000 && grossNHIF<=59999){
                NHIF = 1200;
                document.getElementById('nhif').value = NHIF;
            }
            else if(grossNHIF>=60000 && grossNHIF<=69999){
                NHIF = 1300;
                document.getElementById('nhif').value = NHIF;
            }
            else if(grossNHIF>=70000 && grossNHIF<=79999){
                NHIF = 1400;
                document.getElementById('nhif').value = NHIF;
            }
            else if(grossNHIF>=80000 && grossNHIF<=89999){
                NHIF = 1500;
                document.getElementById('nhif').value = NHIF;
            }
            else if(grossNHIF>=90000 && grossNHIF<=99999){
                NHIF = 1600;
                document.getElementById('nhif').value = NHIF;
            }
            else{
                NHIF = 1700;
                document.getElementById('nhif').value = NHIF;
            }

        //NSSF Calculator
            document.getElementById('nssf').value = NSSF;
        //PAYE calculator
        if(grossPAYE<=13486){
            PAYE=0;
            document.getElementById('income_tax').value = PAYE;
        }
        else {
                PAYE = 0.1*12298;
                grossPAYE=grossPAYE - 12298;
                if (grossPAYE >= 11587){
                    PAYE = PAYE+(0.15*11587);
                    grossPAYE = grossPAYE - 11587;
                    if (grossPAYE >= 11587){
                        PAYE = PAYE+(0.20*11587);
                        grossPAYE = grossPAYE - 11587;
                        if (grossPAYE >= 11587){
                            PAYE = PAYE+(0.25*11587);
                            grossPAYE = grossPAYE - 11587;
                            if (grossPAYE > 47059){
                                PAYE = PAYE+(0.30*grossPAYE);
                                document.getElementById('income_tax').value = PAYE;
                                document.getElementById('paye').value = PAYE-personalRelief;
                                document.getElementById('deductions').value = (PAYE-personalRelief)+NHIF+NSSF+advance;
                                document.getElementById('net_pay').value = grossPay-((PAYE-personalRelief)+NHIF+NSSF+advance);
                            }
                            else{
                                PAYE = PAYE + 0.30*grossPAYE;
                                document.getElementById('income_tax').value = PAYE;
                                document.getElementById('paye').value = PAYE-personalRelief;
                                document.getElementById('deductions').value = (PAYE-personalRelief)+NHIF+NSSF+advance;
                                document.getElementById('net_pay').value = grossPay-((PAYE-personalRelief)+NHIF+NSSF+advance);
                            }
                        }
                        else{
                            PAYE = PAYE + 0.25*grossPAYE;
                            document.getElementById('income_tax').value = PAYE;
                            document.getElementById('paye').value = PAYE-personalRelief;
                            document.getElementById('deductions').value = (PAYE-personalRelief)+NHIF+NSSF+advance;
                            document.getElementById('net_pay').value = grossPay-((PAYE-personalRelief)+NHIF+NSSF+advance);
                        }

                    }
                    else{
                        PAYE = PAYE + 0.20*grossPAYE;
                        document.getElementById('income_tax').value = PAYE;
                        document.getElementById('paye').value = PAYE-personalRelief;
                        document.getElementById('deductions').value = (PAYE-personalRelief)+NHIF+NSSF+advance;
                        document.getElementById('net_pay').value = grossPay-((PAYE-personalRelief)+NHIF+NSSF+advance);
                    }

                }
                else {
                        PAYE = PAYE + 0.15*grossPAYE;
                        document.getElementById('income_tax').value = PAYE;
                        document.getElementById('paye').value = PAYE-personalRelief;
                        document.getElementById('deductions').value = (PAYE-personalRelief)+NHIF+NSSF+advance;
                        document.getElementById('net_pay').value = grossPay-((PAYE-personalRelief)+NHIF+NSSF+advance);
                    }
            }



    }
</script>

</html>