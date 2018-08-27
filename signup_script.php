<?php
    require 'includes/common.php';
   
    $email = $_POST['email'];
    $password = $_POST['password'];
    $contact = mysqli_real_escape_string($con, $_POST['contact']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $city = mysqli_real_escape_string($con, $_POST['city']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    
    
    $regex_email = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";
    if (!preg_match($regex_email, $email)) 
    {
        echo '<center><h1>Enter Correct Email!</h1></center>';
    }
    if (strlen($password) < 6) 
    {
        echo '<center><h1>Password Length must be greater than 6!</center></h1>';
    }
    
    $password = md5($password);
    $email = mysqli_real_escape_string($con, $email);
    
    $query = "select id from users where email = '$email';";
    $result = mysqli_query($con, $query) or die(mysqli_error($con));
    if(mysqli_num_rows($result) > 0)
    {
        echo '<center><h1>Email-id already exists!</h1></center>';
    }
    else
    {
        $query = "insert into users(name, email, password, contact, city, address) values('$name','$email','$password','$contact','$city','$address');";
        $result = mysqli_query($con, $query) or die(mysqli_error($con));
        $_SESSION['id'] = mysqli_insert_id($con);
        header('location: products.php');
    }
?>
