<?php
    require 'includes/common.php';
    
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = $_POST['password'];
    $enc_pass = md5($password);
    $query = "select id from users where email='$email' and password = '$enc_pass';";
    $result = mysqli_query($con, $query) or die(mysqli_error($con));
    $rows = mysqli_num_rows($result);
    if($rows == 0)
    {
        echo '<center><h1>Wrong Username or Password!</h1></center>';
    }
    else
    {
        $row1 = mysqli_fetch_array($result);
        $_SESSION['id'] = $row1['id'];
        header('location: products.php');
    }
?>
