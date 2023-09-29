<?php
session_start();
include_once('connection.php'); 

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    
    $query = "SELECT COUNT(*) AS item_count FROM cart WHERE user_id = ?";
    
}
?>


