<?php

session_start();

    $Email=$_SESSION['owner_id'];
?>   
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Gym Owner Profile</title>
	<link rel="stylesheet" type="text/css" href="style.css">
    <style>
        /* Header */
        body {
	font-family: Arial, sans-serif;
	margin: 0;
	padding: 0;
}

header {
	background-color: #333;
	color: #fff;
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
	padding: 0.7rem;
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
	padding: 20px;
	margin-top: 20px;

}
input[type="email" i] {
    padding: 0.5rem;
    background-color: #eee;
}

input[type="tel" i] {
    padding: 0.5rem;
    background-color: #eee;
}

#price-per-hour {
	width: 300px;
    padding: 0.5rem;
    background-color: white;
}
form input[type="submit"]:hover {
	background-color: #555;
}

/* Header */
header {
  background-color: #262626;
  color: #fff;
  display: flex;
  justify-content: space-between;
  padding: 10px 50px;
  padding-top: 30px;
  padding-bottom: 30px;
  padding: 40px;
}

header h2 {
  margin: 0;
}

header a {
  color: #fff;
  text-decoration: none;
  font-size: 20px;
  margin-right: 20px;
}

/* Main content */
main {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 50px 0;
}

h1 {
  font-size: 40px;
  margin-bottom: 20px;
}

.profile {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 20px;
  /* border: 1px solid #ccc; */
  border-radius: 10px;
  max-width: 900px;
  width: 80%;
  margin-left: 280px;
  margin-top: 50px;
  background-color: #f2f2f2;
  margin-bottom: 100px;
}

.profile h2 {
  font-size: 30px;
  margin-bottom: 20px;
}

.profile label {
  font-size: 20px;
  margin-bottom: 10px;
}

.profile input[type="text"] {
  font-size: 18px;
  padding: 10px;
  border: none;
  border-radius: 5px;
  margin-bottom: 20px;
  width: 100%;
  background-color: #f1f1f1;
}

.profile button {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 15px 32px;
 
}

#address
{
	/* padding: 0px; */
	/* height: 150px; */
	background-color: white	;


	/* width: 300px; */
}
#description{
    width: 400px;
    height: 150px;
}
#phone
{
	background-color: white	;
}
#city
{
	background-color: white	;
}
#state
{
	background-color: white	;
}
#zip
{
	background-color: white	;
}
#l1{
            font-size: 20px;
            margin-left: 500px;
        }
    </style>
	<link rel="stylesheet" href="css/dynamic.css">
	<link rel="stylesheet" href="css/cprofile.css">
</head>
<body>
	<header>
		<div class="container">
			<nav>
				<ul>
					<li><a href="mainpage.html">Home</a></li>
					<li><a href="FitnessInstituteLinks.html">Fitness Institute List</a></li>
                    <li><a href="owner_booking_list.php">Bookings List</a></li>
					<li><a href="mainpage.html">Log-Out</a></li>
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
				</ul>
			</nav>
		</div>
	</header>
    
	<section class="profile">
		<div class="container">
            <br>
			<?php
			if(isset($_POST['update']))
			{   
    			$conn = new mysqli("localhost","root","","gym");
    			$sql="UPDATE owner_reg SET Phone=?, Address=?, City=?, State=?, Zip_code=?, Price=?, Description=?  WHERE Email=?";
    			$phone=$_POST['phone'];
    			$address=$_POST['address'];
				$City=$_POST['City'];
				$State=$_POST['State'];
				$Zip_code=$_POST['Zip_code'];
				$price=$_POST['price'];
				$Description=$_POST['Description'];
    			$sql= $conn->prepare($sql);
    			$sql->bind_param("isssiiss", $phone,$address,$City,$State,$Zip_code,$price,$Description,$Email);
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
			<h1>Gym Owner Profile</h1>
			<form action="" method="post">
				<div class="form-group">
					<label for="gym-name">Gym Name</label>
					<?php
                    $conn = new mysqli("localhost","root","","gym");
                    $sql="select Gym_Name from owner_reg where Email='$Email'";
                    $result=$conn->query($sql);
                    if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo $row["Gym_Name"];
                    }
                } 
            ?>
			<br></br>
					<!-- <input type="text" id="gym-name" name="gym-name" value="Gym-Name"> -->
				</div>
				<div class="form-group">
					<label for="owner-name">Owner Name</label>
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
            <br></br>
					<!-- <input type="text" id="owner-name" name="owner-name" value="Name"> -->
				</div>
				<div class="form-group">
					<label for="email">Email</label>
                    <?php echo $Email ?>
                    <br></br>
					<!-- <input type="email" id="email" name="email" value="Email"> -->
				</div>
				<div class="form-group">
					<label for="phone">Phone</label>
					<input type="tel" id="phone" name="phone" value=
					<?php
                    $conn = new mysqli("localhost","root","","gym");
                    $sql="select Phone from owner_reg where Email='$Email'";
                    $result=$conn->query($sql);
                    if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo $row["Phone"];
                    }
                } 
            ?>
			>
				</div>
				<div class="form-group">
					<label for="address">Address</label>
					<input type="text" id="address" name="address" value='<?php
                    $sql="select Address from owner_reg where Email='$Email'";
                    $result=$conn->query($sql);
                    if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
						$address = trim($row["Address"]);
						echo $address;
                    }
                } 
            ?>'
			>
				</div>
				<div class="form-group">
					<label for="city">City</label>
					<input type="text" id="city" name="City" value=
					<?php
                    $conn = new mysqli("localhost","root","","gym");
                    $sql="select City from owner_reg where Email='$Email'";
                    $result=$conn->query($sql);
                    if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo $row["City"];
                    }
                } 
            ?>
					>
				</div>
				<div class="form-group">
					<label for="state">State</label>
					<input type="text" id="state" name="State" value=
					<?php
                    $conn = new mysqli("localhost","root","","gym");
                    $sql="select State from owner_reg where Email='$Email'";
                    $result=$conn->query($sql);
                    if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo $row["State"];
                    }
                } 
            ?>>
				</div>
				<div class="form-group">
					<label for="zip">Zip Code</label>
					<input type="text" id="zip" name="Zip_code" value=
					<?php
                    $conn = new mysqli("localhost","root","","gym");
                    $sql="select Zip_code from owner_reg where Email='$Email'";
                    $result=$conn->query($sql);
                    if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo $row["Zip_code"];
                    }
                } 
            ?>>
				</div>
				<div class="form-group">
					<label for="price-per-hour">Price (per hour)</label>
					<input type="number" class="form-control" name="price" id="price-per-hour" placeholder=
					<?php
                    $conn = new mysqli("localhost","root","","gym");
                    $sql="select Price from owner_reg where Email='$Email'";
                    $result=$conn->query($sql);
                    if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo $row["Price"];
                    }
                } 
            ?>>
				  </div>
				<div class="form-group">
					<label for="description">Description</label>
					<textarea id="description" name="Description">We are a top-notch gym with state-of-the-art equipment and world-class trainers.</textarea>
				</div>
				<div class="form-group">
					<input type="submit" id="sub" value="Save Changes" name="update">
				</div>
			</form>
		</div>
	</section>

	<!-- <footer>
		<div class="container">
			<p>&copy; 2023 Gym App</p>
		</div>
	</footer> -->
</body>
</html>
