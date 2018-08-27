<?php
    function check_if_added_to_cart($item_id)
    {
        $con = mysqli_connect("localhost", "root", "", "store");
        $user_id = $_SESSION['id'];
        $query = "SELECT * FROM users_items WHERE item_id='$item_id' AND user_id ='$user_id' AND status='Added to cart';";
        $result = mysqli_query($con, $query);
        $rows=mysqli_num_rows($result);
        if($rows >= 1)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }
?>