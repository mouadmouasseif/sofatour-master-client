<?php 

session_start();

include 'connection_database.php';

if (isset($_GET['id_societe'])) {
    $id_societe = intval($_GET['id_societe']);

    $query = "
        SELECT ldp.id_ligne_devis_prestation, ldp.designation 
        FROM ligne_devis_prestation ldp
        JOIN societe_prestations sp ON ldp.id_ligne_devis_prestation = sp.id_prestation
        WHERE sp.id_societe = :id_societe
    ";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id_societe', $id_societe, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    header('Content-Type: application/json');
    echo json_encode($result);
    exit();
}


?>