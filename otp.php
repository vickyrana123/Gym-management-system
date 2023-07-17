<?php

require('customer_reg.php');
date_default_timezone_set("Asia/Calcutta");
    if(isset($_POST['submit']))
    {

        // if(isset($_GET['activation_code']))
        // {
        //     $activation_code=$_POST['activation_code'];
            $con = new mysqli("localhost","root","","gym");
            $otp=$_POST['rough'];
            $ver="select * from customer_reg where OTP=$otp;";
            $result=$con->query($ver);
            if ($result->num_rows >= 1) {

                $row = $result->fetch_assoc();
                $rowotp=$row['OTP'];
                $rowsignuptime=$row['Date'];

                $rowsignuptime=date('d-m-Y h:i:s',strtotime($rowsignuptime));
                $rowsignuptime=date_create($rowsignuptime);
                date_modify($rowsignuptime,"+1 minute");
                $timeup=date_format($rowsignuptime,'d-m-Y h:i:s');
                if($rowotp!=$otp)
                {
                    echo '<script>alert("Please provide correct OTP!")</script>';
                }
                else
                {
                    if(date('d-m-Y h:i:s')>=$timeup)
                    {
                        echo '<script>alert("Your time is up!")</script>';
                        header("Refresh:1;url=customer_reg.php");
                    }
                    else
                    {
                        $sql1='update customer_reg set status="Active" where OTP='.$otp.';';
                        $result1=$con->query($sql1);
                        if($result1)
                        {
                            echo '<script>alert("Your account is activated successfully!")</script>';
                            header("Refresh:1;url=login.html");
                        }
                        else{
                            echo '<script>alert("Opss.. Your account is not activated!")</script>';
                        }
                    }
                }

            }
            else
            {
                echo '<script>alert("Please provide correct OTP!")</script>';
            }
        }
    



?>
<!DOCTYPE html>
<html>
<head>
	<title>Email Verification OTP Page</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
		body {
			font-family: Arial, Helvetica, sans-serif;
			background-color: #f2f2f2;
		}
		.container {
			background-color: #ffffff;
			border-radius: 5px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
			padding: 20px;
			margin: auto;
			margin-top: 50px;
			max-width: 500px;
			text-align: center;
		}
		input[type="text"] {
			padding: 10px;
			border-radius: 5px;
			border: none;
			background-color: #f2f2f2;
			margin-bottom: 20px;
			width: 100%;
			box-sizing: border-box;
			font-size: 16px;
		}
		input[type="submit"] {
			background-color: #4CAF50;
			color: #ffffff;
			border-radius: 5px;
			border: none;
			padding: 10px 20px;
			font-size: 16px;
			cursor: pointer;
		}
	</style>
</head>
<body>
	<div class="container">
		<h1>Email Verification</h1>
		<p>Please enter the OTP sent to your email address:</p>
		<form action="" method="POST">
			<input type="text" name="rough" placeholder="Enter OTP" required>
			<input type="submit" name="submit" value="Verify">
		</form>
	</div>
</body>
</html>
