<?php 	

include 'connection_database.php';


$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {
	$productId 	 = $_POST['productId'];
	$productName = $_POST['editProductName']; 
	$description =$_POST['editDescription'];
	$price 	 = $_POST['editPrice'];
  	$quantity 	 = $_POST['editQuantity'];
 	$rate 		 = $_POST['editRate'];
  	$quantity_initial = $_POST['editQuantity_initial'];
  	$SocieteName      = $_POST['SocieteName'];
  	$categoryName 	= $_POST['editCategoryName'];
  	$productStatus 	= $_POST['editProductStatus'];

				
	$sql = "UPDATE product SET product_name = '$productName', description = '$description' quantity_initiale = '$quantity_initial' , id_societe = '$SocieteName' , categories_id = '$categoryName', quantity = '$quantity', rate = '$rate', active = '$productStatus', status = 1 WHERE product_id = $productId ";

	if($conn->query($sql) == true) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Update";	
      //  header("Location:../Ressources/index.php?page_name=Produits&page=Stocks_id&success=Successfully Update");

	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while updating product info";
      //  header("Location:../Ressources/index.php?page_name=Produits&page=Stocks_id&error=Error while updating product info");

	}

} // /$_POST
	 

echo json_encode($valid);
 
?>