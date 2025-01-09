<?php 	

include 'connection_database.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$productName 		= $_POST['productName'];
  // $productImage 	= $_POST['productImage'];
  $quantity 			= $_POST['quantity'];
  $quantity_initial 			= $_POST['quantity_initial'];
  $rate 					= $_POST['rate'];
  $SocieteName      = $_POST['SocieteName'];
  $categoryName 	= $_POST['categoryName'];
  $productStatus 	= $_POST['productStatus'];

	$type = explode('.', $_FILES['productImage']['name']);
	$type = $type[count($type)-1];		
    $name_file = uniqid(rand()).'.'.$type;
	$url = '../Ressources/documents/photo_produits/'.$name_file;
	if(in_array($type, array('gif', 'jpg', 'jpeg', 'png', 'JPG', 'GIF', 'JPEG', 'PNG'))) {
		if(is_uploaded_file($_FILES['productImage']['tmp_name'])) {			
			if(move_uploaded_file($_FILES['productImage']['tmp_name'], $url)) {
				
				$sql = "INSERT INTO product (product_name, product_image , id_societe , categories_id, quantity_initiale , quantity, rate, active, status) 
				VALUES ('$productName', '$name_file', '$SocieteName' , '$categoryName', '$quantity_initial' , '$quantity', '$rate', '$productStatus', 1)";

				if($conn->query($sql) == true) {
					$valid['success'] = true;
					$valid['messages'] = "Successfully Added";	
                  //  header("Location:../Ressources/index.php?page_name=Produits&page=Stocks_id&success=Successfully Added.");
				} else {
					$valid['success'] = false;
					$valid['messages'] = "Error while adding the members";
                  //  header("Location:../Ressources/index.php?page_name=Produits&page=Stocks_id&error=Error while adding the members");

				}

			}	else {
				return false;
			}	// /else	
		} // if
	} // if in_array 		


	echo json_encode($valid);
 
} // /if $_POST