<?php

session_start();
if (!isset($_SESSION['id_user'])) {
    include("../Front-end/se_connecter/se_connecter.php");
    exit();
}
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
include 'connection_database.php';

function clean_input($input) {
    return htmlspecialchars(strip_tags($input), ENT_QUOTES, 'UTF-8');
}



$societe = clean_input($_GET['search']);


if((strlen($societe) > 0 && $_SESSION['profil'] != 'Administrateur system') || ($_SESSION['profil'] == 'Administrateur system'))
{
    $sql = "";
     if($_SESSION['profil'] != 'Administrateur system' )
     {
        $sql = "SELECT c.*, ct.client_type, cs.Secteur , sc.societe_name
                FROM clients c
                JOIN client_type ct ON ct.id_client_type = c.client_type
                JOIN societes sc ON sc.id_societe = c.id_societe
                JOIN utilisateur_societes us ON us.id_societe = c.id_societe
                LEFT JOIN client_secteur cs ON cs.id_secteur = c.client_secteur" ;
                $sql = $sql . ($societe !=  ""  ? " WHERE us.id_user = ".$_SESSION['id_user']." AND (societe LIKE '".$societe."%' OR nom_complet LIKE '".$societe."%')" : " WHERE us.id_user = ".$_SESSION['id_user']." ");
    }
    else
    {
        $sql = "SELECT c.*, ct.client_type, cs.Secteur , sc.societe_name
        FROM clients c
        JOIN client_type ct ON ct.id_client_type = c.client_type
        JOIN societes sc ON sc.id_societe = c.id_societe
        LEFT JOIN client_secteur cs ON cs.id_secteur = c.client_secteur" ;
        $sql = $sql . ($societe !=  ""  ? "(societe LIKE '".$societe."%' OR nom_complet LIKE '".$societe."%')" : " ");
      
    }

    $stmt = $conn->prepare($sql);
    $stmt->execute();



    // Fetch the data and encode it as JSON
    $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($clients as &$client) {
        // Fetch interlocutors for each client
        $sqlInterlocutors = "SELECT cri.*, ci.type_responsable_interlocuteur
                            FROM client_responsable_interlocuteur cri
                            JOIN c_responsable_interlocuteur ci ON ci.id_c_responsable_interlocuteur = cri.c_responsable_interlocuteur
                            WHERE cri.clients = ?";
        
        $stmtInterlocutors = $conn->prepare($sqlInterlocutors);
        $stmtInterlocutors->execute([$client['id_client']]);
        $client['interlocutors'] = $stmtInterlocutors->fetchAll(PDO::FETCH_ASSOC);

        // Fetch payment modalities (avance) for each client
        $sqlPaymentsAvance = "SELECT * FROM client_modalite_payement_avance WHERE clients = ?";
        $stmtPaymentsAvance = $conn->prepare($sqlPaymentsAvance);
        $stmtPaymentsAvance->execute([$client['id_client']]);
        $client['payment_modalities_avance'] = $stmtPaymentsAvance->fetchAll(PDO::FETCH_ASSOC);

        // Fetch payment modalities (sans avance) for each client
        $sqlPaymentsSansAvance = "SELECT * FROM client_modalite_payement_sans_avance WHERE clients = ?";
        $stmtPaymentsSansAvance = $conn->prepare($sqlPaymentsSansAvance);
        $stmtPaymentsSansAvance->execute([$client['id_client']]);
        $client['payment_modalities_sans_avance'] = $stmtPaymentsSansAvance->fetchAll(PDO::FETCH_ASSOC);
    }

    // Encode the data as JSON
    echo json_encode($clients);
}
else 
{
    echo json_encode([]);
}
?>