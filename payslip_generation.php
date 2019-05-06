<?php
    include 'hr_dashboard.php';
    //files for sending sms
    require_once __DIR__."/config.php";
    require_once __DIR__."/EnvayaSMS.php";

    $db_host = 'localhost'; // Server Name
    $db_user = 'root'; // Username
    $db_pass = ''; // Password
    $db_name = 'payroll'; // Database Name

    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    if (!$conn) {
        die ('Failed to connect to MySQL: ' . mysqli_connect_error());
    }
        $employeeName = $_POST['employee_name'];
        $employeeNumber = $_POST['employee_number'];
        $basicSalary = $_POST['basic_salary'];
        $houseAllowance = $_POST['house_allowance'];
        $transportAllowance=$_POST['transport_allowance'];
        $overtimeRate = $_POST['overtime_rate'];
        $overtimeHours = $_POST['overtime_hours'];
        $grossPay = $_POST['gross_pay'];
        $advance=$_POST['advance'];
        $NSSF = $_POST['nssf'];
        $NHIF = $_POST['nhif'];
        $PAYE = $_POST['paye'];
        $totalDeductions = $_POST['deductions'];
        $netPay = $_POST['net_pay'];

        $query_salary = "INSERT INTO salary(`employee_no`,`user_name`,`basic_salary`,`house_allowance`,`transport_allowance`,`advance`,`overtime`,`gross_pay`,
                          `paye`,`nssf`,`nhif`,`total_deductions`,`net_pay`,`status`) 
                        VALUES ('$employeeNumber','$employeeName',$basicSalary,$houseAllowance,$transportAllowance,$advance,$overtimeHours*$overtimeRate,$grossPay,
                        $PAYE,$NSSF,$NHIF,$totalDeductions,$netPay,'completed')";

        $query_salary_run=mysqli_query($conn,$query_salary);

        $sql_select_phone = "SELECT phone_no,first_name FROM employee WHERE employee_no='$employeeNumber'";
        $query_phone_result = mysqli_query($conn, $sql_select_phone);

        //insert employee number into finance


        while ($row = mysqli_fetch_array($query_phone_result)) {
            $user_phone=$row['phone_no'];
            $user_name=$row['first_name'];
        }

        $message = new EnvayaSMS_OutgoingMessage();
        $message->id = uniqid("");
        $message->to = "+254$user_phone";
        $message->message = "Hello $user_name. Your salary has been processed. Kindly check with the finance. You can also get your payslip through your account.";

        file_put_contents($OUTGOING_DIR_NAME."/{$message->id}.json", json_encode($message));

?>

<html>
<head>
    <title>Payslip</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<script src="js/jquery-1.12.0.min.js">
	</script>
	<script src="js/bootstrap.min.js">
	</script>

	<style>
        @CHARSET "UTF-8";
                .page-break {
            page-break-after: always;
                    page-break-inside: avoid;
                    clear:both;
                }
                .page-break-before {
            page-break-before: always;
                    page-break-inside: avoid;
                    clear:both;
                }
	</style>
 </head>
<body onload="generate()" >
<!--	<button onclick="sendPdf()">Send Pdf</button>-->
<div id="html-2-pdfwrapper" style='position: absolute; left: 20px; top: 50px; bottom: 0; overflow: auto; width: 600px;visibility: hidden;'>

	<h1>PAYSLIP</h1>
		<h4><label>Employee Name:<?php echo " ".$employeeName;?></label></h4><br>
		<h4><label>Employee Number:<?php echo " ".$employeeNumber;?></label></h4><br>
		<h4><label>Date:<?php echo date("Y-m-d");?></label></h4>

		<table>
			<thead>
				<tr>
					<th>Earnings</th>
					<th><?php echo " ";?></th>

				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Basic Salary</td>
					<td><?php echo " ".$basicSalary;?></td>

				</tr>
				<tr>
					<td>House Allowance</td>
					<td><?php echo " ".$houseAllowance;?></td>

				</tr>
				<tr>
					<td>Transport Allowance</td>
					<td><?php echo " ".$transportAllowance;?></td>

				</tr>
                <tr>
                    <td>Overtime</td>
                    <td><?php echo " ".$overtimeRate*$overtimeHours;?></td>

                </tr>
                <tr>
                    <td>Gross Salary</td>
                    <td><?php echo " ".$grossPay;?></td>

                </tr>

                <tr>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td><h3>Deductions</h3></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Advance</td>
                    <td><?php echo " ".$advance;?></td>
                </tr>
                <tr>
                    <td>NHIF</td>

                    <td><?php echo " ".$NHIF;?></td>
                </tr>

                <tr>
                    <td>NSSF</td>
                    <td><?php echo " ".$NSSF;?></td>
                </tr>
                <tr>
                    <td>PAYE</td>
                    <td><?php echo " ".$PAYE;?></td>
                </tr>
                <tr>
                    <td>Total Deductions</td>
                    <td><?php echo " ".$totalDeductions;?></td>
                </tr>


			</tbody>
			<tfoot>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
				<tr>
					<td>Net Salary</td>
					<td><?php echo " ".$netPay;?></td>

				</tr>


			</tfoot>
		</table>

</div>

<script src='dist/jspdf.min.js'></script>

<script>

margins = {
    top: 70,
	  bottom: 40,
	  left: 30,
	  width: 550
	};

	generate = function()
    {
        var pdf = new jsPDF('p', 'pt', 'a4');
        pdf.setFontSize(18);
        pdf.fromHTML(document.getElementById('html-2-pdfwrapper'),
            margins.left, // x coord
            margins.top,
			{
				// y coord
				width: margins.width// max width of content on PDF
			}, function(dispose) {
        headerFooterFormatting(pdf, pdf.internal.getNumberOfPages());
    },
			margins);

		var iframe = document.createElement('iframe');
		iframe.setAttribute('style','position:absolute;left:0; top:60px; bottom:0; height:100%; width:650px; padding:20px;');
		document.body.appendChild(iframe);

		iframe.src = pdf.output('datauristring');
		};
		function headerFooterFormatting(doc)
		{
            header(doc);
        };

		function header(doc)
		{
            doc.setFontSize(30);
            doc.setTextColor(40);
            doc.setFontStyle('normal');


            doc.text("Employee Payroll", margins.left + 127, 40 );
            doc.setLineCap(2);
            doc.line(150, 60, margins.width + -150,60); // horizontal line
        };

		function imgToBase64(url, callback, imgVariable) {

            if (!window.FileReader) {
                callback(null);
                return;
            }
            var xhr = new XMLHttpRequest();
            xhr.responseType = 'blob';
            xhr.onload = function() {
                var reader = new FileReader();
                reader.onloadend = function() {
                    imgVariable = reader.result.replace('text/xml', 'image/jpeg');
                    callback(imgVariable);
                };
                reader.readAsDataURL(xhr.response);
            };
            xhr.open('GET', url);
            xhr.send();
        };
		function sendPdf() {
            var data = new FormData();
            data.append("data" , pdf);
            var xhr = new XMLHttpRequest();
            xhr.open( 'post', 'send_payslip.php', true );
            xhr.send(data);
        }

 </script>
</body>
</html>

