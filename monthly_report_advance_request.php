<?php

        include('hr_dashboard.php');
        $db_host = 'localhost'; // Server Name
        $db_user = 'root'; // Username
        $db_pass = ''; // Password
        $db_name = 'payroll'; // Database Name

        $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

        $amountArray = array();
        $numberArray = array();
        $nameArray = array();

        $select_advance = "SELECT advance FROM salary WHERE advance>'0'";
        $select_advance_result = mysqli_query( $conn, $select_advance );
        $dataAdvance   = $select_advance_result->fetch_all(MYSQLI_ASSOC);
        $counter = mysqli_num_rows($select_advance_result);
        foreach ($dataAdvance as $row)
        {

            $amountArray[] = $row['advance'];

        }


        $select_number = "SELECT user_name,employee_no FROM salary WHERE advance>'0'";
        $select_number_result = mysqli_query( $conn, $select_number );
        $dataNumber   = $select_number_result->fetch_all(MYSQLI_ASSOC);
        foreach ($dataNumber as $row_number)
        {
            $numberArray[] =$row_number['employee_no'];
            $nameArray[] = $row_number['user_name'];

        }


//        foreach ($dataAdvance as $row)
//        {
//            echo $row['advance'];
//        }


if (!$select_advance_result) {
            die ('SQL Error: ' . mysqli_error($conn));
        }


?>

<!DOCTYPE html>
<html>
<head>
	<title>My Chart Js</title>
	<script src="Chart.min.js"></script>
	<link rel="stylesheet" href="css\bootstrap.min.css" />
 	<script src="js\jquery-1.12.0.min.js"></script>
	<script src="js\bootstrap.min.js"></script>
</head>
<body>

	<div class="container">
		<canvas id="myChart"></canvas>
	</div>

<script>
let myChart = document.getElementById('myChart').getContext('2d');

	Chart.defaults.globalFontFamily = 'Lato';
	Chart.defaults.globalFontSize = 18;
	Chart.defaults.globalFontColor = '#777';

	let massPopChart = new Chart(myChart, {
    type:'bar',
		data:{
        labels:[
                <?php
                    for ($i=0;$i<$counter;$i++){
                        echo "'";
                        echo $nameArray[$i];
                        echo "(";
                        echo $numberArray[$i];
                        echo ")";
                        echo "'";
                        echo ',';
                    }
                ?>
            ],

			datasets:[{
            label:'Advance Requests',
				data:[
                <?php
                for ($i=0;$i<$counter;$i++){
                    echo $amountArray[$i].',';
                    //echo $amountArray[$i].',';
                }
                ?>


                ],
				//backgroundColor:'blue'
				backgroundColor:[
                'green', 'red','blue','orange','black'
            ],
				borderWidth:0.5,
				borderColor:'#777',
				hoverBorderWidth:1,
				hoverBorderColor:'#000'
			}]
		},
		options:{
        title:{
            display:true,
				text:'Monthly Advance Request Report',
				fontSize:25
			},
        legend:{
            display:false,
            position:'right',
				labels:{
                fontColor:'#000'
				}
			},
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }

	});
</script>

</body>
</html>