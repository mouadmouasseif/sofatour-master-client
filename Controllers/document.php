<?php
session_start();

if (!isset($_SESSION['id_user'])) {
    echo json_encode(['success' => false, 'message' => 'Utilisateur non connecté.']);
    exit();
}

include 'connection_database.php';

try {
    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data['a_devis']) && !isset($data['le_devis'])) {
        echo json_encode(['success' => false, 'message' => 'Données manquantes.']);
        exit();
    }

    $a_devis = htmlspecialchars(strip_tags($data['a_devis']));
    $le_devis = htmlspecialchars(strip_tags($data['le_devis'])); // Format attendu : YYYY-MM-DD
    $numero_devis_facture = htmlspecialchars(strip_tags($_GET['numero_devis_facture']));

    if($data['De_Fa'] == 'Devis')
    {
    $query = "UPDATE client_devis 
              SET a_devis = :a_devis, le_devis = :le_devis 
              WHERE id_client_devis = (
                  SELECT id_client_devis 
                  FROM client_devis_client 
                  WHERE Numero_devis = :numero_devis_facture
              )";
    }
   else
   {
            $query = "UPDATE client_devis 
            SET a_devis = :a_devis, le_devis = :le_devis 
            WHERE id_client_devis = (
                SELECT id_client_Facture 
                FROM client_facture_client 
                WHERE Numero_Facture = :numero_devis_facture
            )";

   }
       


    $stmt = $conn->prepare($query);
    $stmt->bindParam(':a_devis', $a_devis, PDO::PARAM_STR);
    $stmt->bindParam(':le_devis', $le_devis, PDO::PARAM_STR);
    $stmt->bindParam(':numero_devis_facture', $numero_devis_facture, PDO::PARAM_STR);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Modifications enregistrées avec succès.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erreur lors de la mise à jour.']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Erreur serveur : ' . $e->getMessage()]);
} finally {
    $conn = null;
}
?>
