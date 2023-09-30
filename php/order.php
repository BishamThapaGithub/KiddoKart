<?php
include('connection.php');
session_start();

if (isset($_POST['myorder'])) {
    if (isset($_SESSION['ID'])) {
        $userid = $_SESSION['ID'];
        
        // Check if productid and quantity arrays are set
        if (isset($_POST['productid']) && isset($_POST['quantity'])) {
            $productids = $_POST['productid'];
            $quantities = $_POST['quantity'];
            
            // Loop through the products and insert each one into the orders table
            for ($i = 0; $i < count($productids); $i++) {
                $productid = $productids[$i];
                $orderQuantity = $quantities[$i];
                
                // Insert into orders table
                $insertquery = "INSERT INTO orders (product_id, users_id, order_quantity) VALUES (?, ?, ?)";
                $stmt = mysqli_prepare($conn, $insertquery);
                mysqli_stmt_bind_param($stmt, "iii", $productid, $userid, $orderQuantity);
                
                if (mysqli_stmt_execute($stmt)) {
                    // Successful insert
                } else {
                    // Handle insert error
                    echo "Error inserting into orders: " . mysqli_error($conn);
                }
                
                mysqli_stmt_close($stmt);
            }
            
            // After inserting all products, you can proceed to delete from cart
            // (You may need to adapt this part according to your database schema)
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
            
            mysqli_stmt_close($stmt_delete);
        }
    } else {
        header('location:../signin.html');
    }
}

?>