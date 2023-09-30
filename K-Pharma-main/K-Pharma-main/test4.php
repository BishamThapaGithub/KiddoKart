<?php
session_start();
include_once('./php/connection.php'); 


   
        $userid = $_SESSION['ID'];
        // $user_ID = $_POST['user_id'];
        $query = "SELECT COUNT(*) AS carts FROM cart WHERE user_id = '$userid'"; // Enclosed $user_ID in single quotes
        $result = mysqli_query($conn, $query);
        
       
            $rowCartItem = mysqli_fetch_assoc($result);
            $totalCartItem = $rowCartItem['carts'];
            echo $totalCartItem;
          
         
      
   
