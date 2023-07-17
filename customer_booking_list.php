<?php

session_start();

$Email=$_SESSION['id'];
?>
<!DOCTYPE html>
<html>

<head>
    <title>Booking Details</title>
    <link rel="stylesheet" type="text/css" href="bookingdisplay.css">
    <style>
        #l2{
            font-size:  20px;
            margin-left: 1200px;
        }
        </style>
        <link rel="stylesheet" href="css/dynamic.css">
        <link rel="stylesheet" href="css/table.css">
</head>

<body>
    <header>
        <h1>Booking Details</h1> 
        <label id="l2">
        <?php
                $conn = new mysqli("localhost","root","","gym");
                $sql="select Name from customer_reg where Email='$Email'";
				if($conn->connect_error)
				{
					die("Failed to connect: " .$conn->connect_error);
				}
				else
				{
                $result=$conn->query($sql);
                if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo $row["Name"];
                    }
                } 
			}
            ?>
        </label>       
    </header>
    <header>
		<nav>
			<ul>
                <li><a href="mainpage.html">Home</a></li>
                <li><a href="customer_profile.php">Back to Profile</a></li>
				<li><a href="FitnessInstituteLinks.html">Fitness Institutes</a></li>				
				<li><a href="mainpage.html">Log-Out</a></li>
			</ul>
		</nav>
	</header>

    <div class="container">
        <h2>Upcoming Sessions</h2>
        <table>
            <thead>
                <tr>
                    <th>Gym Name</th>
                    <th>Date</th>
                    <th>Time In</th>
                    <th>Time Out</th>
                    <th>Bill Amount</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop through upcoming sessions -->
                    <?php
                    $conn = new mysqli("localhost","root","","gym");
                    $s="";
                    $sql="select Name,Customer_Gym,Customer_Date,Time_IN,Time_Out,Price from customer_reg where Email='$Email'";
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
                        echo "<tr>
                        <td>".$row["Customer_Gym"]."</td>
                        <td>".$row["Customer_Date"]."</td>
                        <td>".$row["Time_IN"]."</td>
                        <td>".$row["Time_Out"]."</td>
                        <td>".$row["Price"]."</td>
                        </tr>";
                        
                    }
                    } 
                    }
            ?>    
            </tbody>
        </table>
    </div>

    <div class="container">
        <h2>Booking History</h2>
        <table>
            <thead>
                <tr>
                    <th>Gym Name</th>
                    <th>Date</th>
                    <th>Time In</th>
                    <th>Time Out</th>
                    <th>Bill Amount</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop through completed bookings -->
                <?php
                $sql="SELECT DISTINCT booking.Customer_Gym,booking.Customer_Date,booking.Time_IN,booking.Time_Out,booking.Price FROM booking INNER JOIN customer_reg ON booking.Email=customer_reg.Email WHERE booking.Time_IN!=customer_reg.Time_in && booking.Price!=0;";
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
                ?>
                <tr>
                    <td><?php echo $row["Customer_Gym"]; ?></td>
                    <td><?php echo $row["Customer_Date"]; ?></td>
                    <td><?php echo $row["Time_IN"]; ?></td>
                    <td><?php echo $row["Time_Out"]; ?></td>
                    <td><?php echo $row["Price"]; ?></td>
                    <td><?php echo "Completed";?></td>
                </tr>
                <?php
                }
                }
            }
                ?>
            </tbody>
        </table>
    </div>

</body>

</html>