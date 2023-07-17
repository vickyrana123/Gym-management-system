<?php

session_start();

$Email=$_SESSION['id'];



if(isset($_POST['submit']))
{
    $con = new mysqli("localhost","root","","gym");
    if(!$con){
        die("connection fail due to " .mysqli_connect_error());
    }
    $otp_str=str_shuffle("0123456789");
    $otp=substr($otp_str,0,5);
    $tran_id = substr(uniqid('TN'), 0, 10);
    $card_number=$_POST['number'];
    $card_holder=$_POST['holder'];
    $expiry=$_POST['Expiary'];
    $cvc=$_POST['CVC'];
    function validateExpiryDate($expiry) {
      $expiryDate = trim($expiry);
      $expiryDateTime = DateTime::createFromFormat('m/y', $expiryDate);
      $now = new DateTime();
      return ($expiryDateTime && $expiryDateTime >= $now);
    }
    
    $sql="select Price from customer_reg where Email='$Email'";
    $result=$con->query($sql);
    if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $price=$row["Price"];
        // echo $price;
    }
    } 
    $insert='insert into payment(`Transaction_id`,`Email`,`Card_number`,`Card_Holder`,`Expires_date`,`CVC`,`Amount`,`OTP`) values("'.$tran_id.'","'.$Email.'","'.$card_number.'","'.$card_holder.'","'.$expiry.'","'.$cvc.'","'.$price.'","'.$otp.'");';
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
    if(!ctype_digit($card_number) && strlen($card_number) < 13 || strlen($card_number) > 19)
    {
        echo "Invalid card number. Please go back and try again.";
    }
    else
    {
        if(!preg_match("/^[a-zA-Z'\\-\\s]+$/",$card_holder))
        {
            echo "Invalid card holder name. Please go back and try again.";
        }
        else
        {
            if(!validateExpiryDate($expiry))
            {
                echo "Invalid expiary date. Please go back and try again.";
            }
            else
            {
                if(!preg_match('/^[0-9]{3}$/',$cvc))
                {
                    echo "Invalid CVC. Please go back and try again.";
                }
                else
                {
                  if($con->query($insert)==true)
                  {
                    if($mail->send())
                    {
                      echo '<script>alert("Please check your email address for verification code")</script>';
                      header('Refresh:1; url=Payment_otp.php');
                      $_SESSION['transaction'] = $tran_id;
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
  }


?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Payment Page</title>
    <script src="Payment.js" defer></script>
	<style>
@import url(https://fonts.googleapis.com/css?family=Lato:400,300,700);
body,html {
  height:100%;
  margin:0;
  font-family:lato;
}

h2 {
  margin-bottom:0px;
  margin-top:25px;
  text-align:center;
  font-weight:200;
  font-size:19px;
  font-size:1.2rem;
  
}
.container {
  height:100%;
  -webkit-box-pack:center;
  -webkit-justify-content:center;
      -ms-flex-pack:center;
          justify-content:center;
  -webkit-box-align:center;
  -webkit-align-items:center;
      -ms-flex-align:center;
          align-items:center;
  display:-webkit-box;
  display:-webkit-flex;
  display:-ms-flexbox;
  display:flex;
  background:-webkit-linear-gradient(#c5e5e5, #ccddf9);
  background:linear-gradient(#c9e5e9,#ccddf9);
}
.dropdown-select.visible {
  display:block;
}
.dropdown {
  position:relative;
}
ul {
  margin:0;
  padding:0;
}
ul li {
  list-style:none;
  padding-left:10px;
  cursor:pointer;
}
ul li:hover {
  background:rgba(255,255,255,0.1);
}
.dropdown-select {
  position:absolute;
  background:#77aaee;
  text-align:left;
  box-shadow:0px 3px 5px 0px rgba(0,0,0,0.1);
  border-bottom-right-radius:5px;
  border-bottom-left-radius:5px;
  width:90%;
  left:2px;
  line-height:2em;
  margin-top:2px;
  box-sizing:border-box;
}
.thin {
  font-weight:400;
}
.small {
  font-size:12px;
  font-size:.8rem;
}
.half-input-table {
  border-collapse:collapse;
  width:100%;
}
.half-input-table td:first-of-type {
  border-right:10px solid #4488dd;
  width:50%;
}
.window {
  height:540px;
  width:800px;
  background:#fff;
  display:-webkit-box;
  display:-webkit-flex;
  display:-ms-flexbox;
  display:flex;
  box-shadow: 0px 15px 50px 10px rgba(0, 0, 0, 0.2);
  border-radius:30px;
  z-index:10;
}
.order-info {
  height:100%;
  width:50%;
  padding-left:25px;
  padding-right:25px;
  box-sizing:border-box;
  display:-webkit-box;
  display:-webkit-flex;
  display:-ms-flexbox;
  display:flex;
  -webkit-box-pack:center;
  -webkit-justify-content:center;
      -ms-flex-pack:center;
          justify-content:center;
  position:relative;
}
.price {
  bottom:0px;
  position:absolute;
  right:0px;
  color:#4488dd;
}
.order-table td:first-of-type {
  width:25%;
}
.order-table {
    position:relative;
}
.line {
  height:1px;
  width:100%;
  margin-top:10px;
  margin-bottom:10px;
  background:#ddd;
}
.order-table td:last-of-type {
  vertical-align:top;
  padding-left:25px;
}
.order-info-content {
  table-layout:fixed;
  margin-top: 130px;

}

.full-width {
  width:100%;
}
.pay-btn {
  border:none;
  background:#22b877;
  line-height:2em;
  border-radius:10px;
  font-size:19px;
  font-size:1.2rem;
  color:#fff;
  cursor:pointer;
  position:absolute;
  bottom:25px;
  width:calc(100% - 50px);
  -webkit-transition:all .2s ease;
          transition:all .2s ease;
}
.pay-btn:hover {
  background:#22a877;
    color:#eee;
  -webkit-transition:all .2s ease;
          transition:all .2s ease;
}

.total {
  margin-top:25px;
  font-size:20px;
  font-size:1.3rem;
  position:absolute;
  bottom:30px;
  right:27px;
  left:35px;
}
.dense {
  line-height:1.2em;
  font-size:16px;
  font-size:1rem;
}
.input-field {
  background:rgba(255,255,255,0.1);
  margin-bottom:10px;
  margin-top:3px;
  line-height:1.5em;
  font-size:20px;
  font-size:1.3rem;
  border:none;
  padding:5px 10px 5px 10px;
  color:#fff;
  box-sizing:border-box;
  width:100%;
  margin-left:auto;
  margin-right:auto;
}
.credit-info {
  background:#4488dd;
  height:100%;
  width:50%;
  color:#eee;
  -webkit-box-pack:center;
  -webkit-justify-content:center;
      -ms-flex-pack:center;
          justify-content:center;
  font-size:14px;
  font-size:.9rem;
  display:-webkit-box;
  display:-webkit-flex;
  display:-ms-flexbox;
  display:flex;
  box-sizing:border-box;
  padding-left:25px;
  padding-right:25px;
  border-top-right-radius:30px;
  border-bottom-right-radius:30px;
  position:relative;
}
.dropdown-btn {
  background:rgba(255,255,255,0.1);
  width:100%;
  border-radius:5px;
  text-align:center;
  line-height:1.5em;
  cursor:pointer;
  position:relative;
  -webkit-transition:background .2s ease;
          transition:background .2s ease;
}
.dropdown-btn:after {
  content: '\25BE';
  right:8px;
  position:absolute;
}
.dropdown-btn:hover {
  background:rgba(255,255,255,0.2);
  -webkit-transition:background .2s ease;
          transition:background .2s ease;
}
.dropdown-select {
  display:none;
}
.credit-card-image {
  display:block;
  max-height:80px;
  margin-left:auto;
  margin-right:auto;
  margin-top:35px;
  margin-bottom:15px;
}
.credit-info-content {
  margin-top:25px;
  -webkit-flex-flow:column;
      -ms-flex-flow:column;
          flex-flow:column;
  display:-webkit-box;
  display:-webkit-flex;
  display:-ms-flexbox;
  display:flex;
  width:100%;
}
@media (max-width: 600px) {
  .window {
    width: 100%;
    height: 100%;
    display:block;
    border-radius:0px;
  }
  .order-info {
    width:100%;
    height:auto;
    padding-bottom:100px;
    border-radius:0px;
  }
  .credit-info {
    width:100%;
    height:auto;
    padding-bottom:100px;
    border-radius:0px;
  }
  .pay-btn {
    border-radius:0px;
  }
}
	</style>
  </head>
  <body>
    <div class='container'>
      <div class='window'>
        <div class='order-info'>
          <div class='order-info-content'>
            <img src="Gym.jpg" height="250"> 
            <div class='total'>
              <span style='float:left;'>
                <!-- <div class='thin dense'>VAT 19%</div>
                <div class='thin dense'>Delivery</div> -->
                TOTAL
              </span>
              <span style='float:right; text-align:right;'>
              Rs.
                <!-- <div class='thin dense'>$68.75</div>
                <div class='thin dense'>$4.95</div> -->
                <?php
                    $conn = new mysqli("localhost","root","","gym");
                       $sql="select Name,Customer_Gym,Customer_Date,Time_IN,Time_Out,Price from customer_reg where Email='$Email'";
                        if($conn->connect_error)
                        {
                            die("Failed to connect: " .$conn->connect_error);
                        }
                        else
                        {
                            $result=$conn->query($sql);
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    $price=$row["Price"];
                                    echo $price;
                                }
                            } 
                        }
                    ?>
              </span>
            </div>
    </div>
    </div>
            <div class='credit-info'>
              <div class='credit-info-content'>
                <table class='half-input-table'>
                  <!-- <tr><td>Please select your card: </td><td><div class='dropdown' id='card-dropdown'><div class='dropdown-btn' id='current-card'>Visa</div> -->
                    <div class='dropdown-select'>
                    <ul>
                      <li>Master Card</li>
                      <li>American Express</li>
                      </ul></div>
                    </div>
                   </td></tr>
                </table>
                <img src='https://dl.dropboxusercontent.com/s/ubamyu6mzov5c80/visa_logo%20%281%29.png' height='80' class='credit-card-image' id='credit-card-image'></img>
              <form action="" method="post">
                Card Number
                <input class='input-field' id="card-number-input" type="text" name="number" pattern="\d{4} \d{4} \d{4} \d{4}" maxlength="19" required></input>
                Card Holder
                <input class='input-field' type="text" name="holder" required></input>
                <table class='half-input-table'>
                  <tr>
                    <td> Expires
                      <input class='input-field' id="expiry-date-input"  name="Expiary" maxlength="5" required></input>
                    </td>
                    <td>CVC
                      <input class='input-field' name="CVC" maxlength="3" required></input>
                    </td>
                  </tr>
                </table>
                <button class='pay-btn' name="submit">Pay</button>
                </form>
    
              </div>
    
            </div>
          </div>
    </div>
  <!-- <script>
    var cardDrop = document.getElementById('card-dropdown');
var activeDropdown;
cardDrop.addEventListener('click',function(){
  var node;
  for (var i = 0; i < this.childNodes.length-1; i++)
    node = this.childNodes[i];
    if (node.className === 'dropdown-select') {
      node.classList.add('visible');
       activeDropdown = node; 
    };
})

window.onclick = function(e) {
  console.log(e.target.tagName)
  console.log('dropdown');
  console.log(activeDropdown)
  if (e.target.tagName === 'LI' && activeDropdown){
    if (e.target.innerHTML === 'Master Card') {
      document.getElementById('credit-card-image').src = 'https://dl.dropboxusercontent.com/s/2vbqk5lcpi7hjoc/MasterCard_Logo.svg.png';
          activeDropdown.classList.remove('visible');
      activeDropdown = null;
      e.target.innerHTML = document.getElementById('current-card').innerHTML;
      document.getElementById('current-card').innerHTML = 'Master Card';
    }
    else if (e.target.innerHTML === 'American Express') {
         document.getElementById('credit-card-image').src = 'https://dl.dropboxusercontent.com/s/f5hyn6u05ktql8d/amex-icon-6902.png';
          activeDropdown.classList.remove('visible');
      activeDropdown = null;
      e.target.innerHTML = document.getElementById('current-card').innerHTML;
      document.getElementById('current-card').innerHTML = 'American Express';      
    }
    else if (e.target.innerHTML === 'Visa') {
         document.getElementById('credit-card-image').src = 'https://dl.dropboxusercontent.com/s/ubamyu6mzov5c80/visa_logo%20%281%29.png';
          activeDropdown.classList.remove('visible');
      activeDropdown = null;
      e.target.innerHTML = document.getElementById('current-card').innerHTML;
      document.getElementById('current-card').innerHTML = 'Visa';
    }
  }
  else if (e.target.className !== 'dropdown-btn' && activeDropdown) {
    activeDropdown.classList.remove('visible');
    activeDropdown = null;
  }
}

  </script>   -->
  </body>
</html>