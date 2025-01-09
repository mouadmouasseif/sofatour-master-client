<?php

session_start();
if (!isset($_SESSION['id_user'])) {
    include("../Ressources/se_connecter.php");
    exit();
}

include 'connection_database.php';

// Check if 'det_event' is received
if (isset($_POST['det_event'])) {
    $det_event = $_POST['det_event'];

    // Prepare the SQL query with the received value
    $sql = "SELECT Numero_devis, MAX(version_devis), prix_total_ttc, cdc.id_client , cc.nom_complet , cc.societe FROM client_devis_client cdc JOIN clients cc ON cc.id_client = cdc.id_client WHERE Numero_devis = :det_event";
    
    // Use prepared statements to avoid SQL injection
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':det_event', $det_event, PDO::PARAM_STR);
    $stmt->execute();
    
    // Fetch and process the result as needed
    $result = $stmt->fetch(PDO::FETCH_ASSOC);


     $name = $result['nom_complet']  != null ? $result['nom_complet'] : $result['societe'];

    // Example output
    echo '<a href="'.$url.'Ressources/Document.php?prix_ttc='.$result['prix_total_ttc'].'&id_client='.$result['id_client'].'&societe='.$name.'&De_Fa=Devis&numero_devis='.$result['Numero_devis'].'&version='.$result['MAX(version_devis)'].'">Accéder au devis</a>';
    }
?>
