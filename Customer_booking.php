<!DOCTYPE html>
<html>
<head>
	<title>Gym Booking Form</title>
	<style>
		/* CSS styles for the form elements */
        body {
	font-family: Arial, sans-serif;
	margin: 0;
	padding: 0;
}
		form {
			display: inline-block;
			/* margin: 0px; */
			padding: 70px;
			border: 2px solid #ccc;
			border-radius: 10px;
			font-family: Arial, sans-serif;
			background-color: #f9f9f9;
			padding-left: 200px;
			padding-right: 200px;
		}
		
		label {
			display: block;
			margin-bottom: 10px;
			font-weight: bold;
			font-size: 20px;
		}
		
		select, input[type="text"], input[type="time"] , input[type="date"]{
			padding: 5px;
			border: 1px solid #ccc;
			border-radius: 5px;
			font-size: 17px;
			margin-bottom: 10px;
		}
		
		input[type="submit"] {
			background-color: #4CAF50;
			color: #fff;
			border: none;
			padding: 10px 20px;
			border-radius: 5px;
			font-size: 16px;
			cursor: pointer;
		}
		
		input[type="submit"]:hover {
			background-color: #3e8e41;

		}
	</style>
</head>
<body>
    <br><br><br>
	<h1 style="padding-left: 600px;">Gym Booking Form</h1>
    <div style="padding-left: 450px;">
        <form action="Bill.php" method="post">
		<label for="gym_name">Select a Gym:</label>
		<select name="Customer_gym" id="gym_name">
			<option value="Gym A">Gym A</option>
			<option value="Gym B">Gym B</option>
			<option value="Gym C">Gym C</option>
			<option value="Gym D">Gym D</option>
			<option value="Gym E">Gym E</option>
		</select>
		
		<label for="date">Select a Date:</label>
		<input type="date" name="Customer_Date" id="date" required>
		<!-- <br></br> -->
		<label for="time_in">Select a Time In:</label>
		<input type="time" name="time_in" id="time_in" required>
		
		<label for="time_out">Select a Time Out:</label>
		<input type="time" name="time_out" id="time_out" required>
		<br>
		<br>
		<input type="submit" value="Book" name="book">
	</form>
</div>
	
</body>
</html>


