<?php
require_once '../connection_database.php';

$response = ['success' => false, 'messages' => 'Une erreur s\'est produite'];

if ($_POST) {
    
    error_log("Données reçues : " . print_r($_POST, true));

    $prestationId = $_POST['prestationId'] ?? null;
    $designation = $_POST['editDesignation'] ?? null;
    $prestation = $_POST['editPrestation'] ?? null;
    $type = $_POST['editType'] ?? null;
    $societe = $_POST['editSociete'] ?? null;

    // Validate required fields
    if (!$prestationId || !$designation || !$prestation || !$type || !$societe) {
        $response['messages'] = 'Tous les champs sont requis.';
        echo json_encode($response);
        exit;
    }

    try {
        // Start a transaction for atomicity
        $conn->beginTransaction();
        error_log("Début de la transaction pour prestationId: $prestationId");

        // Update main table
        $sql = "
            UPDATE ligne_devis_prestation
            SET 
                designation = :designation,
                prestation = :prestation,
                client_ligne_devis_type_prestation = :type
            WHERE id_ligne_devis_prestation = :prestationId
        ";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':designation', $designation);
        $stmt->bindParam(':prestation', $prestation);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':prestationId', $prestationId);

        if (!$stmt->execute()) {
            $errorInfo = $stmt->errorInfo();
            error_log("Erreur lors de la mise à jour principale: " . json_encode($errorInfo));
            $conn->rollBack();
            $response['messages'] = 'Erreur lors de la mise à jour de la prestation.';
            echo json_encode($response);
            exit;
        }

        error_log("Mise à jour principale réussie pour prestationId: $prestationId");

        // Update related societe
        $sqlSociete = "
            UPDATE societe_prestations
            SET id_societe = :societe
            WHERE id_prestation = :prestationId
        ";
        $stmtSociete = $conn->prepare($sqlSociete);
        $stmtSociete->bindParam(':societe', $societe);
        $stmtSociete->bindParam(':prestationId', $prestationId);

        if (!$stmtSociete->execute()) {
            $errorInfo = $stmtSociete->errorInfo();
            error_log("Erreur lors de la mise à jour de la société: " . json_encode($errorInfo));
            $conn->rollBack();
            $response['messages'] = 'Erreur lors de la mise à jour de la société liée.';
            echo json_encode($response);
            exit;
        }

        error_log("Mise à jour de la société réussie pour prestationId: $prestationId");

        // Commit transaction if both queries succeed
        $conn->commit();
        error_log("Transaction terminée avec succès pour prestationId: $prestationId");
        $response = ['success' => true, 'messages' => 'Prestation mise à jour avec succès'];

    } catch (PDOException $e) {
        // Rollback transaction in case of exception
        $conn->rollBack();
        error_log("Exception lors de la transaction pour prestationId $prestationId: " . $e->getMessage());
        $response = ['success' => false, 'messages' => 'Erreur PDO : ' . $e->getMessage()];
    }
} else {
    $response['messages'] = 'Aucune donnée reçue.';
}

// Send the response as JSON
echo json_encode($response);
