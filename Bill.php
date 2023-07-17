<?php

session_start();

$Email=$_SESSION['id'];

if(isset($_POST['book']))
{   
    $conn = new mysqli("localhost","root","","gym");
    $sql="UPDATE customer_reg SET Customer_gym=?, Customer_Date=?, Time_in=?, Time_out=? WHERE Email=?";
    $Customer_gym=$_POST['Customer_gym'];
    $Customer_Date=date('Y-m-d',strtotime($_POST['Customer_Date']));
    $time_in=$_POST['time_in'];
    $time_out=$_POST['time_out'];
    $stmt= $conn->prepare($sql);

    $stmt->bind_param("sssss", $Customer_gym, $Customer_Date, $time_in, $time_out, $Email);
    if($stmt->execute())
    {
        // echo "&emsp;&emsp;&emsp;&emsp;&emsp;BOOKING CONFIRMED!";
    }
    else
    {
        echo "ERROR!";  
    }	
    $sql1="INSERT INTO `booking` (`Name`, `Email`, `Customer_Gym`, `Customer_Date`, `Time_IN`, `Time_Out` ,`Price`) SELECT Name,Email,Customer_gym,Customer_Date,Time_iN,Time_out,Price FROM customer_reg WHERE Email=?";
    $stmt1=$conn->prepare($sql1);
    $stmt1->bind_param("s",$Email);
    if($stmt1->execute())
    {
        // echo "&emsp;&emsp;&emsp;&emsp;&emsp;BOOKING CONFIRMED!";
    }
    $sql2="update booking set Status='Receive' where Email=?";
    $stmt1=$conn->prepare($sql2);
    $stmt1->bind_param("s",$Email);
    if($stmt1->execute())
    {
        // echo "&emsp;&emsp;&emsp;&emsp;&emsp;BOOKING CONFIRMED!";
    }

}
?>

<?php

if(isset($_POST['book']))
{   
    $conn = new mysqli("localhost","root","","gym");
    $sql="UPDATE customer_reg
    INNER JOIN owner_reg
    ON customer_reg.Customer_gym = owner_reg.Gym_Name
    SET customer_reg.Price = owner_reg.Price;";
    if($conn->connect_error)
    {
        die("Failed to connect: " .$conn->connect_error);
    }
    else
    {
        $result=$conn->query($sql);
    }
}   
?>
<!DOCTYPE html>
<html>
<head>
	<title>Gym Billing</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
		body {
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 0;
			background-color: #f2f2f2;
		}

		header {
			background-color: #222222;
			color: white;
			padding: 20px;
			text-align: center;
		}

		h1 {
			margin: 0;
		}

		main {
			margin: 20px;
			padding: 20px;
			background-color: white;
			border-radius: 10px;
			box-shadow: 0px 0px 10px #888888;
		}

		table {
			width: 100%;
			border-collapse: collapse;
		}

		th, td {
			padding: 18px;
			text-align: left;
			border-bottom: 2px solid #dddddd;
		}
        td{
            font-size: 17px;
        }

        th{
            font-size: 20px;
        }

		tr:nth-child(even) {
			background-color: #f2f2f2;
		}

		.total {
			font-weight: bold;
		}

		@media only screen and (max-width: 600px) {
			main {
				margin: 10px;
				padding: 10px;
			}

			table {
				font-size: 20px;
			}
		}

        button {
			background-color: #4CAF50;
			color: #fff;
			border: none;
			padding: 10px 20px;
			border-radius: 5px;
			font-size: 20px;
			cursor: pointer;
			/* float: right; */
            align-self: center;
			margin-top: 20px;
            padding-left: 50px;
            padding-right: 50px;
            padding-top: 20px;
            padding-bottom: 20px;
            /* margin-left: 570px; */
		}

		button:hover {
			background-color: #3e8e41;
		}
	</style>
</head>
<body>
	<header>
		<h1>Gym Billing</h1>
	</header>
	<main>
		<table>
			<tr>
				<th colspan="2">Customer Information</th>
			</tr>
			<tr>
				<td>Name:</td>
				<td id="customerName">
                    <?php
                    $conn = new mysqli("localhost","root","","gym");
                    $sql="select Name,Customer_Gym,Customer_Date,Time_IN,Time_Out from customer_reg where Email='$Email'";
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
                </td>
			</tr>
			<tr>
				<td>Gym:</td>
				<td id="gymName">
                <?php
                    // $conn = new mysqli("localhost","root","","gym");
                    // $sql="select Name,Customer_Gym,Customer_Date,Time_IN,Time_Out from customer_reg where Email='$Email'";
                    if($conn->connect_error)
                    {
                        die("Failed to connect: " .$conn->connect_error);
                    }
                    else
                    {
                    $result=$conn->query($sql);
                    if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo $row["Customer_Gym"];
                        }
                    } 
                    }
                    ?>
                </td>

			</tr>
			<tr>
				<td>Date:</td>
				<td id="date">
                <?php
                    // $conn = new mysqli("localhost","root","","gym");
                    // $sql="select Name,Customer_Gym,Customer_Date,Time_IN,Time_Out from customer_reg where Email='$Email'";
                    if($conn->connect_error)
                    {
                        die("Failed to connect: " .$conn->connect_error);
                    }
                    else
                    {
                    $result=$conn->query($sql);
                    if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo $row["Customer_Date"];
                        }
                    } 
                    }
                    ?>
                </td>
			</tr>
			<tr>
				<th colspan="2">Booking Information</th>
			</tr>
			<tr>
				<td>Time-in:</td>
				<td id="timeIn">
                <?php
                    // $conn = new mysqli("localhost","root","","gym");
                    // $sql="select Name,Customer_Gym,Customer_Date,Time_IN,Time_Out from customer_reg where Email='$Email'";
                    if($conn->connect_error)
                    {
                        die("Failed to connect: " .$conn->connect_error);
                    }
                    else
                    {
                    $result=$conn->query($sql);
                    if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo $row["Time_IN"];
                        }
                    } 
                    }
                    ?>
                </td>
			</tr>
			<tr>
				<td>Time-out:</td>
				<td id="timeOut">
                <?php
                    if($conn->connect_error)
                    {
                        die("Failed to connect: " .$conn->connect_error);
                    }
                    else
                    {
                    $result=$conn->query($sql);
                    if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo $row["Time_Out"];
                        }
                    } 
                    }
                    ?>
                </td>
			</tr>
			<tr>
				<th colspan="2">Total Amount</th>
			</tr>
			<tr>
				<td colspan="2" class="total" id="totalAmount">
                    <?php
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
                </td>
			</tr>
		</table>
        <form action="Payment.php" method="post">
        <div align="center">
        <button> Make Payment </button>
        </div>
        </form>   

        
	</main>
</body>


</html>