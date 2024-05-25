<?php
$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'];

// Update the export quantity
$sql = "UPDATE export SET quantity = quantity + $quantity WHERE product_id = $product_id";
mysqli_query($conn, $sql);

// Update the furniture quantity
$sql = "UPDATE furniture SET quantity = quantity - $quantity WHERE product_id = $product_id";
mysqli_query($conn, $sql);
?>