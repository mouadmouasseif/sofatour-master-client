<?php

session_start();
if (!isset($_SESSION['id_user'])) {
    include("../Ressources/se_connecter.php");
    exit();
}

include 'connection_database.php';


$data = json_decode(file_get_contents("php://input"));


$numero_devis = filter_var($data->numero_devis, FILTER_SANITIZE_STRING);
$confirmer = $data->confirmer ? 1 : 0; // Convert true/false to 1/0
$annuler = 0;
try {
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "UPDATE client_devis_client SET confirmer = :confirmer , annuler = :annuler WHERE Numero_devis = :numero_devis";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':confirmer', $confirmer, PDO::PARAM_INT);
    $stmt->bindParam(':annuler', $annuler, PDO::PARAM_INT);
    $stmt->bindParam(':numero_devis', $numero_devis, PDO::PARAM_STR);
    $stmt->execute();

    $response = ['success' => true, 'message' => 'Records updated successfully'];
} catch (PDOException $e) {
    $response = ['success' => false, 'message' => 'Error updating records: ' . $e->getMessage()];
}

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>