<?php
session_start();

$Email=$_SESSION['id'];
$con = new mysqli("localhost","root","","gym");
if(!$con){
    die("connection fail due to " .mysqli_connect_error());
}
$otp_str=str_shuffle("0123456789");
$otp=substr($otp_str,0,4);
$tran_id = substr(uniqid('TN'), 0, 10);
$insert='insert into payment(`Transaction_id`,`Email`,`Card_number`,`Card_Holder`,`Expires_date`,`CVC`,`Amount`,`OTP`) values("'.$tran_id.'","'.$Email.'","'.$card_number.'","'.$card_holder.'","'.$expiry.'","'.$cvc.'","'.$price.'","'.$otp.'");';
if($con->query($insert)==true)
{
    echo "success";
}
else
{
    echo "fail";
}
// require('SMTP/class.phpmailer.php');
// require('SMTP/class.smtp.php');

//         $otp_str=str_shuffle("0123456789");
//         echo $otp=substr($otp_str,0,5);

//     $mail=new PHPMailer();
//     $mail->isSMTP();
//     $mail->Host='smtp.gmail.com';
//     $mail->Port=587;
//     $mail->SMTPAuth=true;
//     $mail->SMTPSecure='tls';

//     $mail->Username='vickrana281@gmail.com';
//     $mail->Password='edttieckfppzekry';
//     $mail->setFrom('vickrana281@gmail.com','Vicky Rana');
//     $mail->addAddress('chetanmrana161@gmail.com');
//     $mail->isHTML(true);
//     $mail->Subject="PHP mailer object";
//     $mail->Body="Hello";
//     if($mail->send())
//     {
//         echo "your otp is '.$otp.'";
//     }
//     else{
//         echo 'ERROR';
//     }
?>