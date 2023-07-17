

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>contact</title>
<style>
    *{
    margin: 0;
    padding: 0;
}
header {
			background-color: #333;
			color: #fff;
			display: flex;
			flex-direction: row;
			justify-content: space-between;
			align-items: center;
			padding: 40px;
		}
		header nav {
			display: flex;
			flex-direction: row;
			align-items: center;
		}
		header nav ul {
			display: flex;
			flex-direction: row;
			list-style: none;
			margin: 0;
			padding: 0;
		}
		header nav ul li {
			margin-right: 40px;
			font-size: 18px;
			cursor: pointer;
		}
		#logo {
			font-size: 30px;
			font-weight: bold;
			cursor: pointer;
			margin-left: 40px;
		}
		#free-trial-btn{
			background-color:#ff0000;
			color: #fff;
			font-size: 16px;
			padding: 10px 20px;
			border-radius: 5px;
			margin-right: 20px;
			cursor: pointer;
            text-decoration: none;
		}
		#free-trial-btn:hover{
			background-color: #ff0000;
		}
        /* .description {
  max-width: 800px;
  margin: 0 auto;
  text-align: center;
  padding: 50px 0;
} */

/* .description h1 {
  font-size: 3rem;
  margin-bottom: 20px;
}

.description p {
  font-size: 1.2rem;
  line-height: 1.6;
  margin-bottom: 20px;
}

.description button {
  background-color: #ff0000;
  color: #fff;
  padding: 12px 24px;
  font-size: 1.2rem;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: all 0.3s ease;
} */

/* .description button:hover {
  background-color: #1a237e;
} */


.r2{
    margin-top: 130px;
    margin-left: 210px;
    display: inline-block;
    background-color: ghostwhite;
    font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    border-radius: 10px;
    padding-right: 500px;
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);;
}

.r2 h4{
    margin-left: 50px;
    margin-top: 70px;
}
.r2 h1{
    margin-left: 50px;
}

.r2 input{
    margin-left: 50px;
    padding-right: 200px;
    border-radius: 4px;
    font-size: 20px;
    padding-bottom: 10px;
    font-family: Georgia, 'Times New Roman', Times, serif;
    border: 2px solid #ccc;
}

.r2 textarea{
    margin-left: 50px;
    border-radius: 4px;
    padding-right: 250px;
    font-size: 20px;
    font-family: Georgia, 'Times New Roman', Times, serif;
    border: 2px solid #ccc;
}

.r2 button{
    margin-left: 140px;
    margin-bottom: 50px;
    font-size: 20px;
    width: 50%;
    border-radius: 7px;
    background-color: #ff0000;
    padding-top: 15px;
    padding-bottom: 15px;
    border: 2px solid #ccc;
    color: azure;
}

.r3{
    background-color: #ff0000;
    margin-top: 130px;
    padding-right: 1200px;
    display: inline-block;
    border-radius: 2px;
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);;;
    margin-bottom: 50px;
}

.r3 h2{
    margin-left: 50px;
}
.r3 h4{
    margin-left: 50px;
}

.a1{
    color: azure;
    text-decoration: none;
}
.a2{
    color: azure;
    text-decoration: none;
}

.f1{
    margin-bottom: 120px;
    margin-left: 10px;

}
.a3{
    color: azure;
    text-decoration: none;
}

.s1{
    margin-top: 150px;
}
.s2{
    background-color: #333;
    color: azure;
    padding-top: 50px;
    padding-left: 50px;
}
.k2{
    font-size: 40px;
    margin-bottom: 15px ;
}
.k3{
    font-size: 16px;
    font-weight: normal;
    margin-top: 20px;
}
.z1{
    color: azure;
    text-decoration: none;
}
.l1{
    color: azure;
    text-decoration: none;

}
</style>    
<link rel="stylesheet" href="css/dynamic.css">
<link rel="stylesheet" href="css/cprofile.css">
</head>
<body>
    <header>
        <div id="logo">My Gym</div>
        <nav>
            <ul>
                <li><a href="mainpage.html" class="z1">Home</a></li>
                <li><a href="getstarted.html" class="a1">About</a></li>
                <li><a href="FitnessInstituteLinks.html" class="a3">Fitness Institute List</a></li>
                <li><a href="Gallery.html" class="l1">Gallery</a></li>
                <!-- <li>Contacts</li> -->
            </ul>
            <div>
                <button id="free-trial-btn"><a href="login.html" class="a2">Login</a></button>
                <!-- <button id="contact-btn">Contact</button> -->
                <!-- </ -->
            </div>    
        </nav>
    </header>
    <?php
  
  if(isset($_POST['submit']))
  {  
      $servername="localhost";
      $username="root";
      $password="";
      
      $con = mysqli_connect($servername,$username,$password);
      if(!$con){
          die("connection fail due to " .mysqli_connect_error());
      }
      $Email=$_POST['Email'];
      $Password=$_POST['Pass'];
      $message=$_POST['Text'];
      $sql='insert into `gym`.`contact` (`Email`, `Password`, `Message`, `Date`) VALUES ("'.$Email.'", "'.$Password.'", "'.$message.'", current_timestamp());';
      if(!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/',$Email))
      {
            echo "<br><h2>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Invalid Email address. Please try again!";
      }
      else
      {
      if($con->query($sql)==true)
      {
        
          echo "<br><h2>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Your message has been sent successfully!";
      }
      else{
          echo("ERROR: $sql <br> $con->error");
      }
    }
      $con->close();
  }
  ?>
    <!-- <div class="r1">

    </div> -->
    <form action="contact.php" method="post" class="f1">
    <div class="r2">
        <h4>Available 24/7</h4>
        <h1>Get In Touch!</h1>
        <br>
        <input name="Email" class="i1" placeholder="&nbsp;Enter Email" type="text" required>
        <br>
        <br>
        <input name="Pass" class="i2" placeholder="&nbsp;Password" type="text" required>
        <br>
        <br>
        <textarea name="Text" placeholder="&nbsp;Message" style="height: 150px" required></textarea>
        <br>
        <br>
        <button class="b1" id="message" type="submit" name="submit">Send Message</button>
    </div>
    </form>
    <div class="s1">

    </div>
    <div class="s2">
        <h2 class="k1">For any queries? Call 8849943937</h2>
        <br>
        <h2 class="k1">&emsp;&emsp;&emsp;&emsp;&emsp;OR</h2>
        <br>
        <h2 class="k1">Mail vickrana281@gmail.com</h2>
        <br>
        <h1 class="k2">My Gym</h1>
		<h2 class="k3">It's time to wake up and take charge of your health, <br>
			body & life. our mission is to provide you with<br> 
			the ultimate fitness experience. We focuses on your<br> 
			specific fitness needs which helps you to <br>
			achieve you personal goals.</h2>
			<br>
            <br>
    </div>
</body>
</html>
