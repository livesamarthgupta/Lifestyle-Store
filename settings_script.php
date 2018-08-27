<?php
    require 'includes/common.php';
    if(!isset($_SESSION['id']))
    {
        header('location: index.php');
    }
    $oldpass = md5($_POST['oldpassword']);
    $newpass = $_POST['password'];
    $repass = $_POST['password1'];
    $user_id = $_SESSION['id'];
    $enc_pass = md5($newpass);
    
    if($newpass != $repass)
    {
        die('<center><h1>Password does not match!</h1></center>');
    }
    else if(strlen($newpass)<6)
    {
        die('<center><h1>New Password too short!</h1></center>');
    }
    
    
    $query = "select * from users where id = '$user_id' and password = '$oldpass';";
    $result = mysqli_query($con, $query) or die(mysqli_error($con));
    if(mysqli_num_rows($result)>=1)
    {
        $query = "update users set password = '$enc_pass' where id = '$user_id';";
        $result = mysqli_query($con, $query) or die(mysqli_error($con));
        header('location: settings.php?success=1&error=0');
    }
    else
    {
        header('location: settings.php?error=1&success=0');
    }
        
?>
