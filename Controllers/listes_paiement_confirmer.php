<?php

session_start();
if (!isset($_SESSION['id_user'])) {
    include("../Ressources/se_connecter.php");
    exit();
}

include 'connection_database.php';


$data = json_decode(file_get_contents("php://input"));


$numero_paiement = $data->numero_paiement;
$confirmer = $data->confirmer; // Convert true/false to 1/0
$commentaire = $data->commentaire; // Convert true/false to 1/0
$annuler = 0;
try {
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "UPDATE devis_paiements SET statut = :confirmer , commentaire	= :commentaire  WHERE id_devis_paiements = :numero_paiement";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':confirmer', $confirmer, PDO::PARAM_STR);
    $stmt->bindParam(':commentaire', $commentaire, PDO::PARAM_STR);
    $stmt->bindParam(':numero_paiement', $numero_paiement, PDO::PARAM_STR);
    
    $stmt->execute();

    $response = ['success' => true, 'message' => 'Records updated successfully'];
} catch (PDOException $e) {
    $response = ['success' => false, 'message' => 'Error updating records: ' . $e->getMessage()];
}

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>