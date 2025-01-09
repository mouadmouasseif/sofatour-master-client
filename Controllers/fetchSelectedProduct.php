<?php 
include 'connection_database.php';

$productId = $_POST['productId'];

// Prepare the SQL query with a placeholder
$sql = "SELECT product_id, product_name, description, product_image, quantity_initiale, categories_id, quantity, rate, active, status 
        FROM product 
        WHERE product_id = :productId";

// Prepare the statement
$stmt = $conn->prepare($sql);

// Bind the parameter
$stmt->bindParam(':productId', $productId, PDO::PARAM_INT);

// Execute the statement
$stmt->execute();

// Fetch the result
$row = $stmt->fetch(PDO::FETCH_ASSOC);

echo json_encode($row);

?>