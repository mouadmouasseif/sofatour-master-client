<?php
require_once '../connection_database.php';

$response = ['success' => false, 'messages' => ''];

if (isset($_POST['prestationId'])) {
    $prestationId = $_POST['prestationId'];

    try {
        $conn->beginTransaction();

        // Supprimer l'association avec les sociétés
        $stmt = $conn->prepare("
            DELETE FROM societe_prestations 
            WHERE id_prestation = :prestationId
        ");
        $stmt->execute([':prestationId' => $prestationId]);

        // Supprimer la prestation
        $stmt = $conn->prepare("
            DELETE FROM ligne_devis_prestation 
            WHERE id_ligne_devis_prestation = :prestationId
        ");
        $stmt->execute([':prestationId' => $prestationId]);

        $conn->commit();
        $response['success'] = true;
        $response['messages'] = 'Prestation supprimée avec succès';
    } catch (Exception $e) {
        $conn->rollBack();
        $response['messages'] = 'Erreur : ' . $e->getMessage();
    }
}

echo json_encode($response);
