<!DOCTYPE html>
<html>
<head>
	<title>Owner's Booking Details</title>
	<link rel="stylesheet" type="text/css" href="bookingdisplay.css">
    <style>
            td{
                width: 15px;
            }
        </style>
</head>
<body>
	<header>
		<h1>Gym Owner List</h1>
	</header>
    <header>
		<nav>
			<ul>
                <!-- <li><a href="owner_profile.php">Back to Profile</a></li> -->
				<li><a href="mainpage.html">Home</a></li>
				<!-- <li><a href="FitnessInstituteLinks.html">Fitness Institutes</a></li>				
				<li><a href="mainpage.html">Log-Out</a></li> --> 
			</ul>
		</nav>
	</header>
	
	<div class="container">
		<table>
			<thead>
				<tr>
					<th>Gym Name</th>
                    <th>Owner Name</th>
					<th>Email</th>
					<th>Address</th>
					<th>Phone</th>
					<th>City</th>
                    <th>State</th>
				</tr>
			</thead>
			<tbody>
                <?php
                // echo $Email;
                    $conn = new mysqli("localhost","root","","gym");
                    $sql="select Gym_Name,Name,Email,Address,Phone,City,State from owner_reg;";
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
                        <td>".$row["Gym_Name"]."</td>
                        <td>".$row["Name"]."</td>
                        <td>".$row["Email"]."</td>
                        <td>".$row["Address"]."</td>
                        <td>".$row["Phone"]."</td>
                        <td>".$row["City"]."</td>
                        <td>".$row["State"]."</td>
                        </tr>";  
                    }
                    } 
                    else
                    {
                        echo "Error";
                    }
                    }
                ?>  
				<!-- Add more rows for additional bookings -->
			</tbody>
		</table>
	</div>
</body>
</html>