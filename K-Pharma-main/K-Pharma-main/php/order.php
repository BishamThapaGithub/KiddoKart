<?php
include('connection.php');
session_start();

if (isset($_POST['myorder'])) {
    if (isset($_SESSION['ID'])) {
        $productid = $_POST['productid']; // Assuming product_id is from the cart
        $userid = $_SESSION['ID'];
        $orderQuantity = $_POST['quantity'];
        // Insert into orders table
        $insertquery = "INSERT INTO orders (product_id, users_id,order_quantity) VALUES (?, ?, $orderQuantity)";
        $stmt = mysqli_prepare($conn, $insertquery);
        mysqli_stmt_bind_param($stmt, "ii", $productid, $userid);

        if (mysqli_stmt_execute($stmt)) {
            // Successfully inserted into orders, now delete from cart
            $deletequery = "DELETE FROM cart WHERE user_id = ?";
            $stmt_delete = mysqli_prepare($conn, $deletequery);
            mysqli_stmt_bind_param($stmt_delete, "i", $userid);

            if (mysqli_stmt_execute($stmt_delete)) {
                // Successful deletion from cart
                header("location:../homepage.php?id=$rid&uname=$username");
            } else {
                // Handle delete error
                echo "Error deleting from cart: " . mysqli_error($conn);
            }
        } else {
            // Handle insert error
            echo "Error inserting into orders: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
        mysqli_stmt_close($stmt_delete);
    } else {
        header('location:signin.html');
    }
}
?>