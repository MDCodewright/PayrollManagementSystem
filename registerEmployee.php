<?php

        require_once __DIR__."/config.php";
        require_once __DIR__."/EnvayaSMS.php";

        $servername="localhost";
        $username="root";
        $password="";
        $dbname="payroll";
         $con=mysqli_connect($servername,$username,$password,$dbname)or die("couldnt connect");
         $first_name=$_POST['fname'];
         $second_name=$_POST['sname'];
         $last_name=$_POST['lname'];
         $gender = $_POST['gender'];
         $id_number=$_POST['id_no'];
         $bank_name=$_POST['bank'];
         $account_number=$_POST['bank_no'];
         $email=$_POST['email'];
         $phone_number=$_POST['phone_no'];
         $dob=$_POST['birth_day'];


	$query= "INSERT INTO employee(`first_name`, `second_name`, `last_name`,`gender`,`id_no`, `bank_name`,`acount_no`,`email_adress`,`phone_no`,`password`,`status`,`date_of_birth`) VALUES('$first_name','$second_name','$last_name','$gender',$id_number,'$bank_name',$account_number,'$email',$phone_number,'$id_number','unverified','$dob')";

	$submit= mysqli_query($con,$query) or die ("Couldn't submit");
	 
	if($submit){
        $message = new EnvayaSMS_OutgoingMessage();
        $message->id = uniqid("");
        $message->to = "+254707440470";
        $message->message = "Hello HR. You have a new registered employee. Kindly verify them online. Thanks.";

        file_put_contents($OUTGOING_DIR_NAME."/{$message->id}.json", json_encode($message));
	    echo "<script>alert('Successfully registered. We shall notify you your credentials via mobile. Thank you.');
                window.location.href = 'index.php';
               </script>";

	}

?>