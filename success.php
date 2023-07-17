<html>
    <head>
        <title>Status</title>
        <style>
            h1{
                color: green;
                margin-left: 400px;
            }
            #i1{
                margin-top: 140px;
                margin-left: 600px;
            }
            button{
                background-color: green;
                color: azure;
                font-size: 20px;
                border-radius: 10px;
                padding: 20px;
                padding-left: 60px;
                padding-right: 60px;
                cursor: pointer;
                margin-left: 230px;
            }
            </style>
    </head>
    <body>
        <img src="Success.png" id="i1">
    <h1>Your Transaction has been Successfully Completed<h1>
        <br>
        <br>
        <br>
        <br>
     <form action="mainpage.html">
        <button>Back</button>
     </form>   
    </body>
</html>
<?php

session_start();

$Email=$_SESSION['id'];

    $con = new mysqli("localhost","root","","gym");
    if(!$con){
        die("connection fail due to " .mysqli_connect_error());
    }
    $sql="select * from payment where Email='.$Email.'";
    $result=$con->query($sql);
    if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $amount=$row["Amount"];
        // $transaction=$row["Transaction_id"];
        // $status=$row["Status"];
    }
    }

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

    $con = new mysqli("localhost","root","","gym");
    if(!$con){
        die("connection fail due to " .mysqli_connect_error());
    }
    $sql="select * from payment where Email='.$Email.'";
    $result=$con->query($sql);
    if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $price=$row["Amount"];
        $transaction=$row["Transaction_id"];
        $status=$row["Status"];
    }
    }


    $mail->Subject = 'Payment status';
    $message_body = '<b>Your transaction has been completed successfully!</b>';

    // $message_body = '<p>' . date("l, F j, Y") . '</p>';
    // $message_body .= '<p>Transaction id : '.$transaction.'</p>';
    // $message_body .= '<p>Status : '.$status.'</p>';


    $mail->Body = $message_body;
    if($mail->send())
    {
    }
    else
    {
        $message = $mail->ErrorInfo;
    }  

?>