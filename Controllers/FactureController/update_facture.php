<?php

session_start();
if (!isset($_SESSION['id_user'])) {
    include("../Ressources/se_connecter.php");
    exit();
}

include '../connection_database.php';


try {
    $conn->beginTransaction(); 

    $data = json_decode(file_get_contents("php://input"), true);

    //error_log("Donnee Recu : " . json_encode($data));

    if (
        !isset($data['client_devis_factrue_client']) ||
        !isset($data['client_devis']) ||
        !isset($data['client_ligne_devis_1']) ||
        !isset($data['client_ligne_devis_2']) ||
        !isset($data['client_ligne_devis_3'])
    ) {
        throw new Exception('Donnees manquantes.');
    }

    $client_devis_factrue_client = $data['client_devis_factrue_client'];
    $client_devis = $data['client_devis'];
    $client_ligne_devis_1 = $data['client_ligne_devis_1'];
    $client_ligne_devis_2 = $data['client_ligne_devis_2'];
    $client_ligne_devis_3 = $data['client_ligne_devis_3'];


    $updateFactureQuery = " UPDATE client_facture_client SET Numero_Facture = :Numero_Facture, prix_total_ttc = :prix_total_ttc, utilisateurs = :utilisateurs WHERE id_client_Facture = :id_client_Facture";

    $stmtUpdateFacture = $conn->prepare($updateFactureQuery);
    $stmtUpdateFacture->bindParam(':Numero_Facture', $client_devis_factrue_client['Numero_Facture'], PDO::PARAM_STR);
    $stmtUpdateFacture->bindParam(':prix_total_ttc', $client_devis_factrue_client['prix_total_ttc'], PDO::PARAM_STR);
    $stmtUpdateFacture->bindParam(':utilisateurs', $client_devis_factrue_client['utilisateurs'], PDO::PARAM_INT);
    $stmtUpdateFacture->bindParam(':id_client_Facture', $client_devis_factrue_client['id_client_Facture'], PDO::PARAM_INT);
    $stmtUpdateFacture->execute();


    $updateDevisQuery = "UPDATE client_devis SET le_devis = :le_devis, a_devis = :a_devis, objet = :objet, du_date = :du_date, a_tel_date = :a_tel_date, TVA = :TVA, devis_objet = :devis_objet WHERE id_client_devis = :id_client_devis ";

    $stmtUpdateDevis = $conn->prepare($updateDevisQuery);
    $stmtUpdateDevis->bindParam(':le_devis', $client_devis['le_devis'], PDO::PARAM_STR);
    $stmtUpdateDevis->bindParam(':a_devis', $client_devis['a_devis'], PDO::PARAM_STR);
    $stmtUpdateDevis->bindParam(':objet', $client_devis['objet'], PDO::PARAM_STR);
    $stmtUpdateDevis->bindParam(':du_date', $client_devis['du_date'], PDO::PARAM_STR);
    $stmtUpdateDevis->bindParam(':a_tel_date', $client_devis['a_tel_date'], PDO::PARAM_STR);
    $stmtUpdateDevis->bindParam(':TVA', $client_devis['TVA'], PDO::PARAM_INT);
    $stmtUpdateDevis->bindParam(':devis_objet', $client_devis['devis_objet'], PDO::PARAM_INT);
    $stmtUpdateDevis->bindParam(':id_client_devis', $client_devis_factrue_client['id_client_Facture'], PDO::PARAM_INT);
    $stmtUpdateDevis->execute();

    $deleteLignesQuery = "DELETE FROM client_ligne_devis WHERE client_devis = :client_devis";
    $stmtDeleteLignes = $conn->prepare($deleteLignesQuery);
    $stmtDeleteLignes->bindParam(':client_devis', $client_devis_factrue_client['id_client_Facture'], PDO::PARAM_INT);
    $stmtDeleteLignes->execute();

    $insertLigneDevisQuery = "INSERT INTO client_ligne_devis (prestation, unite, nbr_jour, pu_ht, pt_ht, client_ligne_devis_type_prestation, client_devis, ligne_devis_prestation) VALUES (:prestation, :unite, :nbr_jour, :pu_ht, :pt_ht, :client_ligne_devis_type_prestation, :client_devis, :ligne_devis_prestation) ";

    $stmtInsertLigneDevis = $conn->prepare($insertLigneDevisQuery);

    foreach ($client_ligne_devis_1 as $ligne) {
        $stmtInsertLigneDevis->execute([
            ':prestation' => $ligne['prestation'],
            ':unite' => $ligne['unite'],
            ':nbr_jour' => $ligne['nbr_jour'],
            ':pu_ht' => $ligne['pu_ht'],
            ':pt_ht' => $ligne['pt_ht'],
            ':client_ligne_devis_type_prestation' => 1,
            ':client_devis' => $client_devis_factrue_client['id_client_Facture'],
            ':ligne_devis_prestation' => $ligne['ligne_devis_prestation']
        ]);
    }

    foreach ($client_ligne_devis_2 as $ligne) {
        $stmtInsertLigneDevis->execute([
            ':prestation' => $ligne['prestation'],
            ':unite' => $ligne['unite'],
            ':nbr_jour' => $ligne['nbr_jour'],
            ':pu_ht' => $ligne['pu_ht'],
            ':pt_ht' => $ligne['pt_ht'],
            ':client_ligne_devis_type_prestation' => 2,
            ':client_devis' => $client_devis_factrue_client['id_client_Facture'],
            ':ligne_devis_prestation' => $ligne['ligne_devis_prestation']
        ]);
    }

    foreach ($client_ligne_devis_3 as $ligne) {
        $stmtInsertLigneDevis->execute([
            ':prestation' => $ligne['prestation'],
            ':unite' => $ligne['unite'],
            ':nbr_jour' => $ligne['nbr_jour'],
            ':pu_ht' => $ligne['pu_ht'],
            ':pt_ht' => $ligne['pt_ht'],
            ':client_ligne_devis_type_prestation' => 3,
            ':client_devis' => $client_devis_factrue_client['id_client_Facture'],
            ':ligne_devis_prestation' => $ligne['ligne_devis_prestation']
        ]);
    }

    $conn->commit(); 
    echo json_encode(['success' => true, 'message' => 'Facture mise à jour avec succès.']);


} catch (Exception $e) {

    $conn->rollBack();
    echo json_encode(['success' => false, 'message' => 'Erreur : ' . $e->getMessage()]);

}finally{
 $conn = null;
}