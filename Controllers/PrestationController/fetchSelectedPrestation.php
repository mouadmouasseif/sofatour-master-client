<?php
require_once '../connection_database.php';

$response = ['success' => false, 'messages' => 'Aucune donnée trouvée'];

if ($_POST) {
    if (isset($_POST['prestationId'])) {
        $prestationId = $_POST['prestationId'];

        try {
            $sql = "
                SELECT 
                    p.id_ligne_devis_prestation AS prestationId,
                    p.designation,
                    p.prestation,
                    t.ligne_devis_type_prestation AS type,
                    s.societe_name AS societe,
                    t.id_client_ligne_devis_type_prestation AS type_id,
                    s.id_societe AS societe_id
                FROM ligne_devis_prestation p
                LEFT JOIN client_ligne_devis_type_prestation t 
                    ON p.client_ligne_devis_type_prestation = t.id_client_ligne_devis_type_prestation
                LEFT JOIN societe_prestations sp 
                    ON p.id_ligne_devis_prestation = sp.id_prestation
                LEFT JOIN societes s 
                    ON sp.id_societe = s.id_societe
                WHERE p.id_ligne_devis_prestation = :prestationId
            ";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':prestationId', $prestationId);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                $response = array_merge($result, ['success' => true]);
            } else {
                $response['messages'] = "Aucune prestation trouvée.";
            }
        } catch (PDOException $e) {
            $response['messages'] = $e->getMessage();
        }
    } else {
        $response['messages'] = "L'ID de la prestation est manquant.";
    }
}

echo json_encode($response);
