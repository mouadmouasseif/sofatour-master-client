<?php

require_once '../connection_database.php';

session_start();
if(!isset($_SESSION['id_user'])){
    include '../Ressources/se_connecter.php';
    exit();
}

$numero_facture = $_GET['numero_facture'];
$id_client = $_GET['id_client'];

if (empty($numero_facture) || empty($id_client)) {
    echo json_encode(['error' => 'Missing parameters']);
    exit();
}

$queryFactureClient = "SELECT id_client_Facture, id_client, utilisateurs, Numero_Facture, prix_total_ttc FROM client_facture_client WHERE id_client = :id_client AND Numero_Facture = :numero_facture";
$stmtFactureClient = $conn->prepare($queryFactureClient);
$stmtFactureClient->bindParam(':id_client', $id_client, PDO::PARAM_INT);
$stmtFactureClient->bindParam(':numero_facture', $numero_facture, PDO::PARAM_STR);
$stmtFactureClient->execute();
$client_facture_client = $stmtFactureClient->fetch(PDO::FETCH_ASSOC);

if($client_facture_client){

    $queryFacture = "SELECT le_devis, a_devis, objet, date_d_entree, du_date, a_tel_date, TVA, devis_objet FROM client_devis WHERE id_client_devis = :id_client_devis";
    $stmtFacture = $conn->prepare($queryFacture);
    $stmtFacture->bindParam(':id_client_devis', $client_facture_client['id_client_Facture'], PDO::PARAM_INT);
    $stmtFacture->execute();
    $client_facture = $stmtFacture->fetch(PDO::FETCH_ASSOC);


    $queryLigneFacture = "SELECT prestation, unite, nbr_jour, pu_ht, pt_ht, client_ligne_devis_type_prestation, ligne_devis_prestation FROM client_ligne_devis WHERE client_ligne_devis_type_prestation = :type_prestation AND client_devis = :client_devis";
    $types_prestation = [1, 2, 3];
    $client_ligne_facture = [];

    foreach ($types_prestation as $type) {
        $stmtLigneFacture = $conn->prepare($queryLigneFacture);
        $stmtLigneFacture->bindParam(':type_prestation', $type, PDO::PARAM_INT);
        $stmtLigneFacture->bindParam(':client_devis', $client_facture_client['id_client_Facture'], PDO::PARAM_INT);
        $stmtLigneFacture->execute();
        $client_ligne_facture[$type] = $stmtLigneFacture->fetchAll(PDO::FETCH_ASSOC);
    }

    $responseData = array(
        'client_devis_factrue_client' => $client_facture_client,
        'client_devis' => $client_facture,
        'client_ligne_devis_1' => $client_ligne_facture[1],
        'client_ligne_devis_2' => $client_ligne_facture[2],
        'client_ligne_devis_3' => $client_ligne_facture[3],
    );

    header('Content-Type: application/json');

    //error_log("Data recupere : ". $responseData);

    echo json_encode($responseData);



}else{
    http_response_code(404);
    echo json_encode(['error' => 'Facture non trouvée']);
}












