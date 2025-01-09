<?php
    session_start();
    if (!isset($_SESSION['id_user'])) {
        include("../Ressources/se_connecter.php");
        exit();
    }
    
    include 'connection_database.php';


    // Fetch data from devis_mode_paiements table
    $sql = "SELECT id_devis_mode_paiements ,libeller FROM devis_mode_paiements";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $paymentModes = array();

    foreach ($result as $row) {
        $paymentModes[$row['id_devis_mode_paiements']] = $row['libeller'];
    }


    // Return data as JSON
    header('Content-Type: application/json');
    echo json_encode($paymentModes);

    // Close the connection
    $pdo = null;
?>
