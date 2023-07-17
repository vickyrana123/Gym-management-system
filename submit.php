<?php


session_start();
$Email=$_SESSION['id'];

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
             $name=$row["Name"];
             $gym=$row["Customer_Gym"];
             $Time_in=$row['Time_IN'];
             $Time_out=$row['Time_Out'];
         }
     } 
 }

require("config.php");

if(isset($_POST['stripeToken']))
{
    \Stripe\Stripe::setApiKey('sk_test_51N1ooQSCn86nVhuHp1JIA5weeYV7P4BAcPSOr7MqbwyeTtJhGcivNOwg7vksRztOCmvyP1pRdSx0wmYtpbRaYETm00MppaOtXH');

    $token = $_POST['stripeToken'];
    $email = $_POST['stripeEmail'];
    
    $price = str_replace(",", "", $price) * 100;

    // $source = \Stripe\Source::create([
    //     'type' => 'card',
    //     'card' => [
    //         'token' => $token,
    //     ],
    // ]);
        $paymentIntent = \Stripe\PaymentIntent::create([

        'amount' => $price,
        'currency' => 'inr',
        'payment_method_types' => ['card'],
        'payment_method_data' => [
            'type' => 'card',
            'card' => [
                'token' => $token,
            ],
        ],
        'description' => 'My Gym',
        'receipt_email' => $email,
      
        
    ]);

    if($paymentIntent) {
        echo "<pre>";
        print_r($paymentIntent);  
                // header('Location: success.php');
            }

    // $charge=\Stripe\Charge::create([
    //     'source'=>$_POST['stripeToken'],
    //     'amount' => $price,
    //     'description' => 'My Gym',
    //     'receipt_email' => $email,
    //     'currency' => 'inr',


    // ]);
// echo "<pre>";
// print_r($charge);
}



//     $paymentIntentId=$paymentIntent->id;
//     $paymentIntent = \Stripe\PaymentIntent::retrieve($paymentIntentId);
//     // $paymentIntent->confirm();
//     // $payment_method_id=$payment_method->id;
//     if ($paymentIntent->status == 'requires_action') {
//         // Handle the customer's authentication
//         $paymentIntent->confirm(['payment_method'=>$paymentIntent->payment_method]);
//     }
//     if($paymentIntent->status == 'requires_confirmation')
//     {
//         $paymentIntent->confirm();
//     }
//     if ($paymentIntent->status == 'requires_action') {
//         // Handle the customer's authentication
//         $paymentIntent->confirm(['payment_method'=>$paymentIntent->payment_method]);
//     }
//     // $paymentIntent->confirm();   
//         // if ($paymentIntent->status == 'succeeded') {
//         //     // Payment succeeded
//         //     echo "success";
//         //   }
//         //   else {
//         //     // Payment failed
//         //     echo "fail";
//         //   }
//         // }
//         // else if($paymentIntent->status == 'succeeded')
//         // {
//         //     echo "hello";
//         // }
//         // else
//         // {
//         //     echo "fail";
//         // }

    


// }



?>
