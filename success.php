<!DOCTYPE html>
<?php
    require 'includes/common.php';
    if(!isset($_SESSION['id']))
    {
        header('location: index.php');
    }
    $user_id = $_SESSION['id'];
    $item_ids_string = $_GET['itemsid'];
    $query = "update users_items set status = 'Confirmed' where user_id = '$user_id' and item_id IN ($item_ids_string) and status = 'Added to cart';";
    $result = mysqli_query($con, $query) or die(mysqli_error($con));
    
?>
<html lang="en">
    <head>
        <meta name="viewport" content="width = device-width, initial-scale = 1">
        <title>Success | Life Style Store</title>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
        <?php
            include 'includes/header.php';
        ?>
        <div class="container-fluid" id="content">
            <div class="col-md-12">
                <div class="jumbotron">
                    <h3 align="center">Your order is confirmed. Thank you for shopping with us.</h3><hr>
                    <p align="center">Click <a href="products.php">here</a> to purchase any other item.</p>
                </div>
            </div>
        </div>
        <?php
            include 'includes/footer.php';
        ?>
    </body>
</html>