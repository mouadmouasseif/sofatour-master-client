<?php
require_once '../connection_database.php';

$response = ['success' => false, 'messages' => ''];

if ($_POST) {
    $designation = $_POST['designation'];
    $prestation = $_POST['prestation'];
    $type = $_POST['type'];
    $societe = $_POST['societe'];

    try {
        $conn->beginTransaction();

        // Insérer la prestation dans `ligne_devis_prestation`
        $stmt = $conn->prepare("
            INSERT INTO ligne_devis_prestation (designation, prestation, client_ligne_devis_type_prestation)
            VALUES (:designation, :prestation, :type)
        ");
        $stmt->execute([
            ':designation' => $designation,
            ':prestation' => $prestation,
            ':type' => $type
        ]);

        $prestationId = $conn->lastInsertId();

        // Associer la prestation à une société
        $stmt = $conn->prepare("
            INSERT INTO societe_prestations (id_societe, id_prestation)
            VALUES (:societe, :prestationId)
        ");
        $stmt->execute([
            ':societe' => $societe,
            ':prestationId' => $prestationId
        ]);

        $conn->commit();
        $response['success'] = true;
        $response['messages'] = 'Prestation ajoutée avec succès';
    } catch (Exception $e) {
        $conn->rollBack();
        $response['messages'] = 'Erreur : ' . $e->getMessage();
    }
}

echo json_encode($response);
