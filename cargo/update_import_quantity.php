<?php
$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'];

// Update the import quantity
$sql = "UPDATE import SET quantity = quantity + $quantity WHERE product_id = $product_id";
mysqli_query($conn, $sql);

// Update the furniture quantity
$sql = "UPDATE furniture SETquantity = quantity + $quantity WHERE product_id = $product_id";
mysqli_query($conn, $sql);
?>