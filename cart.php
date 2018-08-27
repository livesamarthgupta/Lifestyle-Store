<!DOCTYPE html>
<?php
    require 'includes/common.php';
    if(!isset($_SESSION['id']))
    {
        header('location: index.php');
    }
    
?>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Cart | Life Style Store</title>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container-fluid" id="content">
            <?php
                include 'includes/header.php';
            ?>
            <div class="row decor_bg">
                <div class="col-md-6 col-md-offset-3">
                    <table class="table table-striped">
                        <?php
                            $user_id = $_SESSION['id'];
                            $query = "SELECT * FROM users_items as ui INNER JOIN items as i on user_id = '$user_id' AND ui.item_id = i.id and status = 'Added to cart';";
                            $result = mysqli_query($con, $query) or die(mysqli_error($con));
                            $sum = 0;
                            $id = "";
                            if(mysqli_num_rows($result)==0)
                            {
                                echo "<center><h1>Add items to cart first!</h1></center>";
                            }
                            else
                            {
                             
                        ?>
                        <thead>
                            <tr>
                                <th>Item Number</th>
                                <th>Item Name</th>
                                <th>Price</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            while ($row = mysqli_fetch_array($result))
                                {
                                    $sum+= $row["price"];
                                    $id .= $row["id"] . ",";
                                    echo "<tr><td>" . "#" . $row["id"] . "</td><td>" . $row["name"] . "</td><td>Rs " . $row["price"] . "</td><td><a href='cart-remove.php?id={$row['id']}' class='remove_item_link'> Remove</a></td></tr>";
                                }
                                $id = rtrim($id, ", ");
                                echo "<tr><td></td><td>Total</td><td>Rs " . $sum . "</td><td><a href='success.php?itemsid=" . $id . "' class='btn btn-primary'>Confirm Order</a></td></tr>";
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php
                include 'includes/footer.php';
        ?>
    </body>
</html>