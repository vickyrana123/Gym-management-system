<?php
if(isset($_POST['register']))
{

    $servername="localhost";
    $username="root";
    $password="";

    $con = mysqli_connect($servername,$username,$password);
    if(!$con){
        die("connection fail due to " .mysqli_connect_error());
    }

    $Name=$_POST['Name'];
    $Email=$_POST['Email'];
    $Pass=$_POST['Pass'];
    $Con_Pass=$_POST['Con_Pass'];
    $Gym_Name=$_POST['Gym_Name'];
    $Address=$_POST['Address'];
    $Phone=$_POST['Phone'];
    $otp_str=str_shuffle("0123456789");
    $otp=substr($otp_str,0,5);

    $sql="select * from `gym`.`owner_reg` where Email='.$Email.'";
        $result=$con->query($sql);
        if ($result->num_rows > 1) {
            $row = $result->fetch_assoc();
            $status=$row['status'];
            if($status=='active')
            {
                echo "<script>alert('Email already registered')</script>";
            }
            else{
                $update="update owner_reg set Name='.$Name.',Email='.$Email.',Pass='.$Pass.',Con_Pass='.$Con_Pass.' ,OTP='.$otp.';";
                $result1=$con->query($update);
                if($update)
                {
                    require('SMTP/class.phpmailer.php');
                    require('SMTP/class.smtp.php');
    $mail = new PHPMailer;
	$mail->IsSMTP();
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = '587';
	$mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';

    $mail->Username='vickrana281@gmail.com';
    $mail->Password='edttieckfppzekry';
    $mail->setFrom('vickrana281@gmail.com','My Gym');
	$mail->AddAddress($Email);
	$mail->IsHTML(true);
	$mail->Subject = 'OTP for verify your Email Address';

	$message_body = '
	<p>For verify your email address, enter this OTP: <b>'.$otp.'</b></p>
	<p>Sincerely,</p>
	';
	$mail->Body = $message_body;

	if($mail->Send())
	{
        echo '<script>alert("Please check your email address for OTP")</script>';
	}
	else
	{
		$message = $mail->ErrorInfo;
	}
                }
            }
        }
        else{
            require('SMTP/class.phpmailer.php');
            require('SMTP/class.smtp.php');
    $mail = new PHPMailer;
    $mail->IsSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = '587';
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';

    $mail->Username='vickrana281@gmail.com';
    $mail->Password='edttieckfppzekry';
    $mail->setFrom('vickrana281@gmail.com','My Gym');
    $mail->AddAddress($Email);
    $mail->IsHTML(true);
    $mail->Subject = 'OTP for verify your Email Address';

    $message_body = '
    <p>For verify your email address, enter this OTP: <b>'.$otp.'</b></p>
    <p>Sincerely,</p>
    ';
    $mail->Body = $message_body;

    if($mail->Send())
    {
        $sql='INSERT INTO `gym`.`owner_reg` (`Name`, `Email`, `Pass`, `Con_Pass`, `Gym_Name`, `Address`, `Phone`,`OTP`, `Date`) VALUES ("'.$Name.'", "'.$Email.'", "'.$Pass.'", "'.$Con_Pass.'", "'.$Gym_Name.'", "'.$Address.'", "'.$Phone.'","'.$otp.'", current_timestamp());';        // echo $sql;
        $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; 
        if(!preg_match('/^[0-9]{10}+$/', $Phone))
        {
            echo "<h1><br>Invalid phone number. Please go back and try again.";
        }
        else
        {
        if(!preg_match("/^[a-zA-z]*$/",$Name))
        {
            echo "<h1><br>Invalid Name. Please go back and try again.";
        }
        else
        {
        if (!preg_match($regex, $Email)) {
                echo "<h1><br>Invalid email address. Please go back and try again.";
        }
        else
        {
            if($con->query($sql)==true)
            {
                echo '<script>alert("Please check your email address for verification code")</script>';
                header('Location: otp1.php');
    
            }
            else{
                echo("ERROR: $sql <br> $con->error");
            }
        }
        }
        }
        
    }
    else
    {
        $message = $mail->ErrorInfo;
    }
    }

    $con->close();
    // $sql='INSERT INTO `gym`.`owner_reg` (`Name`, `Email`, `Pass`, `Con_Pass`, `Gym_Name`, `Address`, `Phone`, `Date`) VALUES ("'.$Name.'", "'.$Email.'", "'.$Pass.'", "'.$Con_Pass.'", "'.$Gym_Name.'", "'.$Address.'", "'.$Phone.'", current_timestamp());';
    // $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; 
    // if (!preg_match($regex, $Email)) {
    //         echo "<h1><br>Invalid email address. Please go back and try again.";
    // }
    // else
    // {
    //     if($conn->query($sql) == true)
    //     {
    //         header('Location: login.html');
    //     }
    //     else{
    //         echo "ERROR: $sql <br> $conn->error";
    //     }
    // }

    //     $conn->close();
}

?>



