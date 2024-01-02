<?php
include_once('connection.php');

function getTotalUsers() {
    global $conn;  

    $sql = "SELECT COUNT(*) as total_users FROM users";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['total_users'];
    } else {
        return 0;
    }
}
function getTotalCategories() {
    global $conn; 

    $sql = "SELECT COUNT(*) as total_categories FROM categories";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['total_categories'];
    } else {
        return 0;
    }
}

function getTotalOrders() {
    global $conn; 

    $sql = "SELECT COUNT(*) as total_orders FROM orders";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['total_orders'];
    } else {
        return 0;
    }
}

function getTotalProducts() {
    global $conn; 

    $sql = "SELECT COUNT(*) as total_products FROM products";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['total_products'];
    } else {
        return 0;
    }
}

?>


