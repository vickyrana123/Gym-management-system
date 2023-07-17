<?php

session_start();

$Email=$_SESSION['owner_id'];

?>


<!DOCTYPE html>
<html>
<head>
	<title>Owner's Booking Details</title>
	<link rel="stylesheet" type="text/css" href="bookingdisplay.css">
    <style>
        #l1{
            font-size: 20px;
            margin-left: 1200px;
        }
        h2{
            margin-left: 320px;
            font-size: 35px;
        }
        </style>
        <link rel="stylesheet" href="css/dynamic.css">
        <link rel="stylesheet" href="css/table.css">
</head>
<body>
	<header>
		<h1>Owner's Booking Details</h1>
        <label id="l1">
        <?php
                    $conn = new mysqli("localhost","root","","gym");
                    $sql="select Name from owner_reg where Email='$Email'";
                    $result=$conn->query($sql);
                    if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo $row["Name"];
                    }
                } 
            ?>
        </label>
	</header>

    <header>
		<nav>
			<ul>
                <li><a href="owner_profile.php">Back to Profile</a></li>
				<li><a href="mainpage.html">Home</a></li>
				<li><a href="FitnessInstituteLinks.html">Fitness Institutes</a></li>				
				<li><a href="mainpage.html">Log-Out</a></li>
			</ul>
		</nav>
	</header>
	
	<!-- <div class="container">
        <h2>Upcoming Bookings</h2>
		<table>
			<thead>
				<tr>
					<th>Customer Name</th>
					<th>Gym Name</th>
					<th>Date</th>
					<th>Time In</th>
					<th>Time Out</th>
					<th>Bill Amount</th>
				</tr>
			</thead>
			<tbody>
				<!-- Loop through all bookings -->
                <?php
                // echo $Email;
                    $conn = new mysqli("localhost","root","","gym");
                    $sql="select customer_reg.Name,customer_reg.Customer_gym,customer_reg.Customer_Date,customer_reg.Time_in,customer_reg.Time_out,customer_reg.Price FROM customer_reg INNER JOIN owner_reg ON customer_reg.Customer_gym=owner_reg.Gym_Name WHERE owner_reg.Email='$Email'";
                    if($conn->connect_error)
                    {
                        die("Failed to connect: " .$conn->connect_error);
                    }
                    else
                    {
                    $result=$conn->query($sql);
                    if ($result->num_rows > 0) {

                    while($row = $result->fetch_assoc()) 
                    {

                        // echo "<tr>
                        // <td>".$row["Name"]."</td>
                        // <td>".$row["Customer_gym"]."</td>
                        // <td>".$row["Customer_Date"]."</td>
                        // <td>".$row["Time_in"]."</td>
                        // <td>".$row["Time_out"]."</td>
                        // <td>".$row["Price"]."</td>
                        // </tr>";  
                    }
                    } 
                    else
                    {
                        // echo "Error";
                    }
                    }

                ?>  

			</tbody>
		</table>
	</div> 
    <?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ctp'])) {
    $rn = $_POST['ctp'];
    $sql3 = "UPDATE booking SET Status='Approved' WHERE Book_id='" . $rn . "'";
    $pc = $conn->prepare($sql3);
    $pc->execute();
    $sql1="select Email from booking where Book_id='" . $rn . "'";
    $result=$conn->query($sql1);
    if ($result->num_rows > 0) {
    if ($row = $result->fetch_assoc()) {
        $email = $row['Email']; // fetch the email address value from the row
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
    $mail->AddAddress($email);
    $mail->IsHTML(true);

    $mail->Subject = 'GYM SLOT STATUS';
    $message_body = '<b>Your request is approved successfully!</b>';
    $mail->Body = $message_body;
    if($mail->send())
    {
    }
    else
    {
        $message = $mail->ErrorInfo;
    }  
    // header('Location: ' . $_SERVER['PHP_SELF']);
    // exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['rec'])) {
    $rn = $_POST['rec'];
    $sql3 = "UPDATE booking SET Status='Reject' WHERE Book_id='" . $rn . "'";
    $pc = $conn->prepare($sql3);
    $pc->execute();
    $sqlr="select Email from booking where Book_id='" . $rn . "'";
    $result=$conn->query($sqlr);
    if ($result->num_rows > 0) {
    if ($row = $result->fetch_assoc()) {
        $email = $row['Email']; // fetch the email address value from the row
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
    $mail->AddAddress($email);
    $mail->IsHTML(true);

    $mail->Subject = 'GYM SLOT STATUS';
    $message_body = '<b>Your request is rejected!</b>';
    $mail->Body = $message_body;
    if($mail->send())
    {
    }
    else
    {
        $message = $mail->ErrorInfo;
    }  
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ptc'])) {
    $rn = $_POST['ptc'];
    $sql2 = "UPDATE booking SET Status='Complete' WHERE Book_id='" . $rn . "'";
    $pc = $conn->prepare($sql2);
    $pc->execute();
    $sql1="select Email from booking where Book_id='" . $rn . "'";
    $result=$conn->query($sql1);
    if ($result->num_rows > 0) {
    if ($row = $result->fetch_assoc()) {
        $email = $row['Email']; // fetch the email address value from the row
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
    $mail->AddAddress($email);
    $mail->IsHTML(true);

    $mail->Subject = 'GYM SLOT STATUS';
    $message_body = '<b>Your request is Completed!</b>';
    $mail->Body = $message_body;
    if($mail->send())
    {
    }
    else
    {
        $message = $mail->ErrorInfo;
    } 

//
 }

?>    

    <div class="container">
        <h2>Bookings</h2>
		<table>
			<thead>
				<tr>
					<th>Customer Name</th>
					<th>Gym Name</th>
					<th>Date</th>
					<th>Time In</th>
					<th>Time Out</th>
					<th>Bill Amount</th>
					<th>Status</th>
                    <th>Action</th>
				</tr>
                <?php
$sql="select booking.Name,booking.Book_id,booking.Customer_gym,booking.Customer_Date,booking.Time_in,booking.Time_out,booking.Price,booking.Status from booking inner join owner_reg on owner_reg.Gym_Name=booking.Customer_Gym where owner_reg.Email='$Email'";

$result=mysqli_query($conn,$sql);
if($result->num_rows>0){
while($row=$result->fetch_assoc()){
    echo "<tr>";
    echo "<td>";echo $row['Name'];echo "</td>";    
    echo "<td>";echo $row['Customer_gym'];echo "</td>"; 
    echo "<td>";echo $row['Customer_Date'];echo "</td>"; 
    echo "<td>";echo $row['Time_in'];echo "</td>"; 
    echo "<td>";echo $row['Time_out'];echo "</td>"; 
    echo "<td>";echo $row['Price'];echo "</td>"; 
    echo "<td>";echo $row['Status'];echo "</td>"; 
    // echo "<td>";echo $row['order_status'];echo "</td>"; 
    echo "<td> <div>
   
    <form action='' method='post'><input  type='hidden' value='".$row['Book_id']."' name='ctp'><input type='submit' id='app' value='APPROVED'></input></form> 
    <form action='' method='post'><input id='change' type='hidden' value='".$row['Book_id']."' name='rec'><input type='submit' id='rej' value='REJECT'></input></form> 
    <form action='' method='post'><input id='change' type='hidden' value='".$row['Book_id']."' name='ptc'><input type='submit' id='comp' value='COMPLETE'></input></form>
    </div>";
    
    echo "</tr>";
}
}
else{
    echo "No bookings yet";
}
?>
			</thead>
			<!-- <tbody>
            <?php

                // $sql="select booking.Name,booking.Customer_gym,booking.Customer_Date,booking.Time_in,booking.Time_out,booking.Price,booking.Status FROM booking INNER JOIN owner_reg ON booking.Customer_gym=owner_reg.Gym_Name WHERE owner_reg.Email='$Email'";
                
                // if($conn->connect_error)
                // {
                //     die("Failed to connect: " .$conn->connect_error);
                // }
                // else
                // {
                // $result=$conn->query($sql);
                // if ($result->num_rows >= 0) {
                // while($row = $result->fetch_assoc()) 
                // {
                ?>
                <tr>
                    <td><?php echo $row["Name"]; ?></td>
                    <td><?php echo $row["Customer_gym"]; ?></td>
                    <td><?php echo $row["Customer_Date"]; ?></td>
                    <td><?php echo $row["Time_in"]; ?></td>
                    <td><?php echo $row["Time_out"]; ?></td>
                    <td><?php echo $row["Price"]; ?></td>
                    <td><?php echo $row["Status"]; ?></td>
                    <td> <div>
                    <form action='owner_booking_list.php' method='post'>
                    <input type='submit' value='COMPLETE' name='cmt'>
                    <input type='submit' value='PENDING' name='pen'>
                    </form>

                </div>
                </tr>

			</tbody> -->
		</table>
	</div>
	
</body>
</html>

