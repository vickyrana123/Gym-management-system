<?php

session_start();

    $Email=$_SESSION['id'];

?>    

<!DOCTYPE html>
<html>
<head>
	<title>Customer Profile</title>
	<link rel="stylesheet" type="text/css" href="style.css">
    <style>
        body {
	font-family: Arial, sans-serif;
	margin: 0;
	padding: 0;
}	

header {
	background-color: #333;
	color: #fff;
	padding: 40px;
}

nav ul {
	margin: 0;
	padding: 0;
	list-style: none;
	display: flex;
	justify-content: flex-end;
}

nav ul li {
	margin: 0 1rem;
}

nav ul li a {
	color: #fff;
	text-decoration: none;
}

main {
	max-width: 800px;
	margin: 2rem auto;
	padding: 2rem;
	background-color: #f2f2f2;
}

h1 {
	font-size: 2.5rem;
	margin-bottom: 1rem;
}

form label {
	display: block;
	font-size: 1.2rem;
	margin-bottom: 0.5rem;
}

form input, form select {
	padding: 0.5rem;
	margin-bottom: 1rem;
	font-size: 1.2rem;
	border-radius: 5px;
	border: none;
}

form input[type="submit"] {
	background-color: #333;
	color: #fff;
	font-size: 1.2rem;
	padding: 0.5rem;
	border: none;
	border-radius: 5px;
	cursor: pointer;
}
.button-container {
  display: flex;
  justify-content: center;
  margin-top: 30px;
  margin-bottom: 30px;
}

.booking-button {
  display: inline-block;
  padding: 20px 30px;
  background-color: #007bff;
  color: #fff;
  border-radius: 4px;
  text-decoration: none;
  font-weight: bold;
}

.booking-button:hover {
  background-color: #0062cc;
}

#l1{
	margin-left: 800px;
	font-size: 20px;
}

    </style>
	<link rel="stylesheet" href="css/dynamic.css">
	<link rel="stylesheet" href="css/cprofile.css">
</head>
<body>
	<header>
		<nav>
			<ul>
				<li><a href="mainpage.html">Home</a></li>
				<li><a href="FitnessInstituteLinks.html">Fitness Institutes</a></li>
				<li><a href="customer_booking_list.php">Bookings List</a></li>
				<li><a href="mainpage.html">Log-Out</a></li>
				<label for="name" id="l1"> 
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
			</ul>
		</nav>
	</header>
	<main>
		<?php
			if(isset($_POST['update']))
			{   
    			$conn = new mysqli("localhost","root","","gym");
    			$sql="UPDATE customer_reg SET Age=?, Gender=? WHERE Email=?";
    			$Age=$_POST['Age'];
    			$Gender=$_POST['Gender'];
    			$sql= $conn->prepare($sql);
    			$sql->bind_param("iss", $Age,$Gender,$Email);
    			if($sql->execute())
    			{
        			echo "Your data updated successfully!";
    			}
    			else
				{
        			echo "ERROR!";
    			}
				$conn->close();
				}
		?>
		<br></br>
		<h1>Customer Profile</h1>
		<br>
		<form action="" method="post">
			<label for="name">Name:</label>
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
            <br></br>
			<!-- <input type="text" id="name" name="name" value="Name" required> -->
			<label for="email">Email:</label>
            <?php echo $Email ?>
            <br></br>    
			<!-- <input type="email" id="email" name="email" value="Email" required> -->
			<label for="age">Age:</label>
			<input type="number" id="age" name="Age" value="25" required>
			<label for="gender">Gender:</label>
			<select id="gender" name="Gender" required>
				<option value="male">Male</option>
				<option value="female">Female</option>
				<option value="other">Other</option>
			</select><br><br>
			<input id="sub" type="submit" value="Save Changes" name="update">
		</form>
			</main>
	<div class="container">
		<!-- <form>
		</form> -->
		<div class="button-container">
		  <a id="book" href="Customer_booking.php" class="booking-button">Book a Session</a>
		</div>
	  </div>
	  
</body>
</html>

