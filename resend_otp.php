<?php
session_start();

$Email=$_SESSION['id'];
$tran_id=$_SESSION['transaction'];

date_default_timezone_set("Asia/Calcutta");
// include_once('Payment_otp.php');

          $con = new mysqli("localhost","root","","gym");
          $otp_str=str_shuffle("0123456789");
          $otp=substr($otp_str,0,5);
          $update="UPDATE payment SET OTP='$otp' WHERE Transaction_id='$tran_id'";
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
    $mail->Subject = 'My Gym verification code';
    
    $message_body = '
    <p>Dear Customer,</p>
    <p><b>'.$otp.'</b> is your one time password(OTP).</p>
    <p>Please enter the OTP to proceed.</p>
    <p>Thank You</p>
    <p>Team My Gym</p>
    ';
    $mail->Body = $message_body;
    if($con->query($update)==true)
    {
      if($mail->send())
      {
        if(isset($_POST['verify']))
        {
            echo "hello";
            $otp=$_POST['input1'];
            $ver="select * from payment where OTP=$otp && Transaction_id='$tran_id';";
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
                        header("Refresh:1;url=Payment.php");
                    }
                    else
                    {
                        $sql1='update payment set Status="Completed" where OTP='.$otp.';';
                        $result1=$con->query($sql1);
                        if($result1)
                        {
                            header("Refresh:1;url=success.php");
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
      }
      else
      {
        $message = $mail->ErrorInfo;
      }  

    }
    
?>   


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payment</title>
  <style>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}
body {
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #4FAAF4;
}
:where(.container, form, .input-field, header) {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}
.container {
  background: #fff;
  padding: 35px 65px 50px 65px;
  border-radius: 20px;
  row-gap: 20px;
  box-shadow: 0 5px 10px rgba(0, 0, 0, .1);
}
.container header{
  height: 150px;
  width: 150px;
  background-image: url('images/image.gif');
  background-size: cover;
  background-position: center;
}
.container h4 {
  font-size: 1.25rem;
  color: #333;
  font-weight: 500;
}
.container p {
  max-width: 250px;
  text-align: center;
  font-size: 13px;
}
.container p a {
  color: #4FAAF4;
  text-decoration: none;
}
.container p a:hover {
  text-decoration: underline;
}

.i1{
  border-radius: 13px;
  font-size: 1.125rem;
  text-align: center;
  border: 1px solid #ddd;
  border-color: #333;
  padding-top: 5px;
  padding-bottom: 5px;
}

.b1{
  margin-top: 25px;
  margin-bottom: 15px;
  width: 100%;
  color: #fff;
  font-size: 1rem;
  border: none;
  padding: 9px 0;
  cursor: pointer;
  border-radius: 15px;
  background: #287ED4;
  opacity: .5;

}
  </style>
</head>
<body>
<div class="container">
    <header></header>
    <img src="tick.jpg" height="100">
    <h4>Enter OTP</h4>
    <p>We have sent you access code via Email</p>
    <form action="">
      <input type="number" class="i1" name="input1" required/>
      <button class="b1" name="verify">Verify</button>
    </form>
    <p>Didn't receive the code <br> <a href="resend_otp.php" name="resend">Resend code</a></p>
  </div>  
</body>
</html>





