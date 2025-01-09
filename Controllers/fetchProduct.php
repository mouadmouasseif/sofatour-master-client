<?php 
include 'connection_database.php';

$output = array('data' => array());

try {
    // Use prepared statements for better security
    $sql = "SELECT product.product_id, product.product_name, product.product_image, product.description, 
        product.categories_id, product.quantity_initiale, product.quantity, product.rate, 
        product.active, product.status, categories.categories_name, societes.societe_name
        FROM product 
        INNER JOIN categories ON product.categories_id = categories.categories_id  
        INNER JOIN societes ON product.id_societe = societes.id_societe  
        WHERE product.status != 2 AND product.active != 2;
        ";

    // Prepare and execute the query using PDO
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // Fetch all results
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if(count($result) > 0) { 
        foreach($result as $row) {
            $productId = $row['product_id'];

            // Active status label
            $active = ($row['status'] == 1) 
                ? "<label class='label label-success'>Disponible</label>" 
                : "<label class='label label-danger'>Non disponible</label>";

            // Action buttons
            $button = '<!-- Single button -->
            <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Action <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a type="button" data-toggle="modal" id="editProductModalBtn" data-target="#editProductModal" onclick="editProduct('.$productId.')"> 
                    <i class="glyphicon glyphicon-edit"></i> Modifier</a></li>
                    <li><a type="button" data-toggle="modal" data-target="#removeProductModal" id="removeProductModalBtn" onclick="removeProduct('.$productId.')"> 
                    <i class="glyphicon glyphicon-trash"></i> Supprimer</a></li>       
                </ul>
            </div>';

            // Image processing
            $imageUrl = substr($row['product_image'], 3); // Assuming image path starts with '../'
            $productImage = "<img class='img-round' src='".'documents/photo_produits/'.$row['product_image']."' style='height:30px; width:50px;' />";

            // Append row data to output array
            $output['data'][] = array(
                $productImage,  // Product image
                $row['product_name'],  // Product name
                $row['quantity_initiale'],  // Quantity
                $row['quantity'],  // Quantity
                $row['rate'] . ' DH',  // Product rate
                $row['societe_name'] ,
                $row['categories_name'],  // Category name
                $active,  // Active status
                $button  // Action buttons
            );
        } // /foreach
    } // /if result count

    // Output JSON data
    echo json_encode($output);

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
