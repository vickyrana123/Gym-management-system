<?php

    session_start();

if(isset($_POST['submit']))
{
    $conn = new mysqli("localhost","root","","gym");

    $Email=$_POST['Email'];
    $Password=$_POST['Password'];

    if($conn->connect_error)
    {
        die("Failed to connect: " .$conn->connect_error);
    }
    else
    {
        $stmt=$conn->prepare("select * from owner_reg where Email = ?");
        $stmt->bind_param("s",$Email);
        $stmt->execute();
        $stmt_result=$stmt->get_result();
        if($stmt_result->num_rows>0)
        {
            $data=$stmt_result->fetch_assoc();
            if($data['Pass']==$Password)
            {
                header('Location: owner_profile.php');
                $_SESSION['owner_id'] = $Email;
            }
            else
            {
                echo "<br><h1>Invalid Email or Password!";
            }
        }
        else
        {
            echo '<script>alert("Invalid Email or Password!")</script>'; 
            header('Refresh:4; url=login.html');
        }
    }
}    
    ?>      

  