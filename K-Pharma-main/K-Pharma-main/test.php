<?php 
include('php/connection.php');
session_start();

            if (isset($_POST['gotocart'])) {
               
                if (isset($_SESSION['username'])) {

                    $productid = $_POST['productid'];
                    

                    echo $_SESSION['ID'];
                
                    $userid    = $_SESSION['ID'];

                    $insertquery = "INSERT into cart (cart_quantity,user_id,product_id)
                                  values(1,'$userid','$productid')";
                    mysqli_query($conn,$insertquery);

                    
                    // Perform actual purchase logic or redirect to a purchase page
                    header("location:./php/viewproducts.php?id=$rid&uname=$username");

                } else {
                    header('location:signin.html');
                }
            }
         
            
            ?>