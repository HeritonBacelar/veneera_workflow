<?php

include_once('dbConn.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get values from the form
$issue_id = $_POST['issue'];
$product_id = $_POST['product'];
$status_id = $_POST['status'];
$order_id = $_POST['order_id'];
$info = $_POST['info'];
$warranty = $_POST['warranty'];

// Insert data into rcl_order table
$sql = "INSERT INTO rcl_order (rcl_date, order_id, warranty, product_id, issue_id, status_id, Info) 
        VALUES (NOW(), $order_id, $warranty, $product_id, $issue_id, $status_id, '$info')";

if ($conn->query($sql) === TRUE) {
    header('Location: create_success.php');
} else {
    //echo "Error: " . $sql . "<br>" . $conn->error; 
    echo 'option not found in the database';
}

// Close connection
$conn->close();

?>