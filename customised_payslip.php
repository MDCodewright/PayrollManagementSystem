<?php
    session_start();
    include 'employee_dashboard.php';
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "payroll";
    $date = date("Y-m-d");
    $userpresent = $_SESSION["employeeNumber"];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);


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
<?php

if (isset($_POST['gross_salary']) && isset($_POST['deductions']) && isset($_POST['net_salary'])){

    $query = "SELECT user_name,basic_salary,house_allowance,gross_pay,transport_allowance,advance,overtime,advance,nssf,nhif,paye,total_deductions,net_pay FROM salary WHERE employee_no='$userpresent'";
    $query_result = mysqli_query($conn,$query);
while ($row = $query_result ->fetch_assoc()){

  echo '<div id="html-2-pdfwrapper" style="position: absolute; left: 20px; top: 50px; bottom: 0; overflow: auto; width: 600px;visibility: hidden;">
            <h1>PAYSLIP</h1>
            <h4><label>Employee Name:'.$row['user_name'].'</label></h4><br>
            <h4><label>Employee Number:'.$userpresent.'</label></h4><br>
            <h4><label>Date:'.$date.'</label></h4>
            <h4><label></label></h4>
            <table>
            <thead>
            <tr>
                <th>Earnings</th><th>'." ".'</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Basic Salary</td>
                <td>'.$row['basic_salary'].'</td>
             </tr>
             <tr>
                <td>House Allowance</td>
                <td>'.$row['house_allowance'].'</td>
              </tr>
              <tr>
                <td>Transport Allowance</td>
                <td>'.$row['transport_allowance'].'</td>
              </tr>
            <tr>
                <td>Overtime</td>
                <td>'.$row['overtime'].'</td>

            </tr>
            <tr>
                <td>Gross Salary</td>
                <td>'.$row['gross_pay'].'</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td><h3>Deductions</h3Deductions></td>
                <td></td>
            </tr>
            <tr>
                    <td>Advance</td>
                    <td>'.$row['advance'].'</td>
                </tr>
            <tr>
                <td>NHIF</td>
                <td>'.$row['nhif'].'</td>
            </tr>

            <tr>
                <td>NSSF</td>
                <td>'.$row['nssf'].'</td>
            </tr>
             <tr>
                <td>PAYE</td>
                <td>'.$row['paye'].'</td>
            </tr>
            <tr>
                <td>Total Deductions</td>
                <td>'.$row['total_deductions'].'</td>
            </tr>
            </tbody>
            <tfoot>
            <tr>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Net Salary</td>
                <td>'.$row['net_pay'].'</td>

            </tr>
            </tfoot>
        </table>

 </div>';

}

}
else if (isset($_POST['gross_salary']) && isset($_POST['net_salary'])) {

    $query = "SELECT user_name,basic_salary,house_allowance,gross_pay,transport_allowance,overtime,net_pay FROM salary WHERE employee_no='$userpresent'";
    $query_result = mysqli_query($conn, $query);
    while ($row = $query_result->fetch_assoc()) {

        echo '<div id="html-2-pdfwrapper" style="position: absolute; left: 20px; top: 50px; bottom: 0; overflow: auto; width: 600px;visibility: hidden;">
            <h1>PAYSLIP</h1>
            <h4><label>Employee Name:' . $row['user_name'] . '</label></h4><br>
            <h4><label>Employee Number:' . $userpresent . '</label></h4><br>
            <h4><label>Date:' . $date . '</label></h4>
            <h4><label></label></h4>
            <table>
            <thead>
            <tr>
                <th>Earnings</th><th>' . " " . '</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Basic Salary</td>
                <td>' . $row['basic_salary'] . '</td>
             </tr>
             <tr>
                <td>House Allowance</td>
                <td>' . $row['house_allowance'] . '</td>
              </tr>
              <tr>
                <td>Transport Allowance</td>
                <td>' . $row['transport_allowance'] . '</td>
              </tr>
            <tr>
                <td>Overtime</td>
                <td>' . $row['overtime'] . '</td>

            </tr>
            <tr>
                <td>Gross Salary</td>
                <td>' . $row['gross_pay'] . '</td>
            </tr>
            </tbody>
            <tfoot>
            <tr>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Net Salary</td>
                <td>' . $row['net_pay'] . '</td>

            </tr>
            </tfoot>
        </table>

 </div>';
    }
}
else if (isset($_POST['gross_salary']) && isset($_POST['deductions'])) {

    $query = "SELECT user_name,basic_salary,house_allowance,gross_pay,transport_allowance,advance,overtime,advance,nssf,nhif,paye,total_deductions,net_pay FROM salary WHERE employee_no='$userpresent'";
    $query_result = mysqli_query($conn, $query);
    while ($row = $query_result->fetch_assoc()) {

        echo '<div id="html-2-pdfwrapper" style="position: absolute; left: 20px; top: 50px; bottom: 0; overflow: auto; width: 600px;visibility: hidden;">
            <h1>PAYSLIP</h1>
            <h4><label>Employee Name:' . $row['user_name'] . '</label></h4><br>
            <h4><label>Employee Number:' . $userpresent . '</label></h4><br>
            <h4><label>Date:' . $date . '</label></h4>
            <h4><label></label></h4>
            <table>
            <thead>
            <tr>
                <th>Earnings</th><th>' . " " . '</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Basic Salary</td>
                <td>' . $row['basic_salary'] . '</td>
             </tr>
             <tr>
                <td>House Allowance</td>
                <td>' . $row['house_allowance'] . '</td>
              </tr>
              <tr>
                <td>Transport Allowance</td>
                <td>' . $row['transport_allowance'] . '</td>
              </tr>
            <tr>
                <td>Overtime</td>
                <td>' . $row['overtime'] . '</td>

            </tr>
            <tr>
                <td>Gross Salary</td>
                <td>' . $row['gross_pay'] . '</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td><h3>Deductions</h3Deductions></td>
                <td></td>
            </tr>
            <tr>
                    <td>Advance</td>
                    <td>'.$row['advance'].'</td>
                </tr>
            <tr>
                <td>NHIF</td>
                <td>'.$row['nhif'].'</td>
            </tr>

            <tr>
                <td>NSSF</td>
                <td>'.$row['nssf'].'</td>
            </tr>
             <tr>
                <td>PAYE</td>
                <td>'.$row['paye'].'</td>
            </tr>
            <tr>
                <td>Total Deductions</td>
                <td>'.$row['total_deductions'].'</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Net Salary</td>
                <td>'.$row['net_pay'].'</td>
            </tr>
            </tbody>
            
        </table>

 </div>';
    }
}
else if (isset($_POST['gross_salary'])) {

    $query = "SELECT user_name,basic_salary,house_allowance,gross_pay,transport_allowance,overtime FROM salary WHERE employee_no='$userpresent'";
    $query_result = mysqli_query($conn, $query);
    while ($row = $query_result->fetch_assoc()) {

        echo '<div id="html-2-pdfwrapper" style="position: absolute; left: 20px; top: 50px; bottom: 0; overflow: auto; width: 600px;visibility: hidden;">
            <h1>PAYSLIP</h1>
            <h4><label>Employee Name:' . $row['user_name'] . '</label></h4><br>
            <h4><label>Employee Number:' . $userpresent . '</label></h4><br>
            <h4><label>Date:' . $date . '</label></h4>
            <h4><label></label></h4>
            <table>
            <thead>
            <tr>
                <th>Earnings</th><th>' . " " . '</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Basic Salary</td>
                <td>' . $row['basic_salary'] . '</td>
             </tr>
             <tr>
                <td>House Allowance</td>
                <td>' . $row['house_allowance'] . '</td>
              </tr>
              <tr>
                <td>Transport Allowance</td>
                <td>' . $row['transport_allowance'] . '</td>
              </tr>
            <tr>
                <td>Overtime</td>
                <td>' . $row['overtime'] . '</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Gross Salary</td>
                <td>' . $row['gross_pay'] . '</td>
            </tr>
            </tbody>
            
        </table>

 </div>';
    }
}
else if (isset($_POST['deductions'])) {

    $query = "SELECT user_name,overtime,advance,nssf,nhif,paye,advance,total_deductions FROM salary WHERE employee_no='$userpresent'";
    $query_result = mysqli_query($conn, $query);
    while ($row = $query_result->fetch_assoc()) {

        echo '<div id="html-2-pdfwrapper" style="position: absolute; left: 20px; top: 50px; bottom: 0; overflow: auto; width: 600px;visibility: hidden;">
            <h1>PAYSLIP</h1>
            <h4><label>Employee Name:' . $row['user_name'] . '</label></h4><br>
            <h4><label>Employee Number:' . $userpresent . '</label></h4><br>
            <h4><label>Date:' . $date . '</label></h4>
            <h4><label></label></h4>
            <table>
            <thead>
            <tr>
                <th>Deductions</th><th>' . " " . '</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Advance</td>
                    <td>'.$row['advance'].'</td>
                </tr>
                <tr>
                    <td>NHIF</td>
                    <td>'.$row['nhif'].'</td>
                </tr>
    
                <tr>
                    <td>NSSF</td>
                    <td>'.$row['nssf'].'</td>
                </tr>
                 <tr>
                    <td>PAYE</td>
                    <td>'.$row['paye'].'</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Total Deductions</td>
                    <td>'.$row['total_deductions'].'</td>
                </tr>
            </tbody>
            
        </table>

 </div>';
    }
}


?>


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

