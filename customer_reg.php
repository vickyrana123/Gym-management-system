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
        $otp_str=str_shuffle("0123456789");
        $otp=substr($otp_str,0,5);
        // $act_str=rand(100000,10000000);
        // $activation_code=str_shuffle("abcdefghijklmno".$act_str);

        $Name=$_POST['Name'];
        $Email=$_POST['Email'];
        $Password=$_POST['Password'];
        $Con_Password=$_POST['Con_Password'];
        $sql="select * from `gym`.`customer_reg` where Email='.$Email.'";
        $result=$con->query($sql);
        if ($result->num_rows > 1) {
            $row = $result->fetch_assoc();
            $status=$row['status'];
            if($status=='active')
            {
                echo "<script>alert('Email already registered')</script>";
            }
            else{
                $update="update customer_reg set Name='.$Name.',Email='.$Email.',Password='.$Password.',Con_Password='.$Con_Password.' ,OTP='.$otp.';";
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
                $sql='insert into `gym`.`customer_reg` (`Name`, `Email`, `Password`, `Con_Password`,`OTP`,`Date`) VALUES ("'.$Name.'", "'.$Email.'", "'.$Password.'", "'.$Con_Password.'", "'.$otp.'",current_timestamp());';
                $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; 
                if(!preg_match("/^[a-zA-z]*$/",$Name))
                {
                    echo "<br><h1>Invalid Name. Please go back and try again.";
                }
                else
                {
                if (!preg_match($regex, $Email)) {
                        echo "<h1><br>Invalid email address. Please go back and try again.";
                }
                else
                {
                    // echo '<script>alert("Please check your email address for verification code")</script>';
                    if($con->query($sql)==true)
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
                            
                              header('Location: otp.php');
                          }
                          else
                          {
                              $message = $mail->ErrorInfo;
                          }
                      
                    }
                    else{
                        echo("ERROR: $sql <br> $con->error");
                    }
                }
      }


      }
    }

?>







   

    

 


