<?php 
// include('php/connection.php');
// $quantitys=$_POST['quantity'];
// $prodductids = $_POST['prodductid'];
// session_start();

//             if (isset($_POST['gotocart'])) {
               
//                 if (isset($_SESSION['username'])) {

//                     // $productid = $_POST['productid'];
//                     // $quantity = $_POST['quantity'];

//                        $productid = $prodductids;
//                     $quantity = $quantitys;
                  
                  
//                     echo $_SESSION['ID'];
                
//                     $userid    = $_SESSION['ID'];

//                     $insertquery = "INSERT into cart (cart_quantity,user_id,product_id )
//                                   values('$quantity','$userid','$productid')";
//                     mysqli_query($conn,$insertquery);

                    
//                     // Perform actual purchase logic or redirect to a purchase page
//                     // header("location:./php/myorder.php?id=$rid&uname=$username");
//                     // header("location:homepage.php");
//                 } else {
//                     header('location:signin.html');
//                 }
//             }
include('php/connection.php');
session_start();

if (isset($_POST['quantity']) && isset($_POST['productid'])) {
    $quantity = $_POST['quantity'];
    $productid = $_POST['productid'];

    if (isset($_SESSION['ID'])) {
        $userid = $_SESSION['ID'];

        $insertquery = "INSERT into cart (cart_quantity, user_id, product_id)
                        values ('$quantity', '$userid', '$productid')";
        
        if (mysqli_query($conn, $insertquery)) {
            echo "success"; // Send a success response to the AJAX call
        } else {
            echo "error"; // Send an error response to the AJAX call
        }
    } else {
        echo "not_logged_in"; // Send a response indicating the user is not logged in
    }
} else {
    echo "missing_data"; // Send a response indicating missing data
}
         
            
            ?>