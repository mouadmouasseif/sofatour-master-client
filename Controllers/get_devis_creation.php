<?php

session_start();
if (!isset($_SESSION['id_user'])) {
    include("../Ressources/se_connecter.php");
    exit();
}

include 'connection_database.php';

 $numero_devis = $_GET['numero_devis'];
 $id_client = $_GET['id_client'];
 $version = $_GET['version'];

 $queryDevisClient = "SELECT id_client_devis, id_client, utilisateurs, version_devis, Numero_devis, prix_total_ttc FROM client_devis_client WHERE id_client = :id_client AND Numero_devis = :numero_devis AND version_devis = :versions";
 $stmtDevisClient = $conn->prepare($queryDevisClient);
 $stmtDevisClient->bindParam(':id_client',  $id_client , PDO::PARAM_INT);
 $stmtDevisClient->bindParam(':numero_devis',  $numero_devis , PDO::PARAM_STR);
 $stmtDevisClient->bindParam(':versions',  $version , PDO::PARAM_INT);

 $stmtDevisClient->execute();
 $client_devis_client = $stmtDevisClient->fetch(PDO::FETCH_ASSOC);

//  var_dump($client_devis_client['id_client_devis']);

  $queryDevis = "SELECT le_devis, a_devis, objet, date_d_entree, du_date, a_tel_date, TVA , devis_objet FROM client_devis WHERE id_client_devis = :id_client_devis ";
  $stmtDevis = $conn->prepare($queryDevis);
  $stmtDevis->bindParam(':id_client_devis',  $client_devis_client['id_client_devis'] , PDO::PARAM_INT);
  $stmtDevis->execute();
  $client_devis = $stmtDevis->fetch(PDO::FETCH_ASSOC);



  $queryLigneDevis = "SELECT prestation, unite, nbr_jour, pu_ht, pt_ht, client_ligne_devis_type_prestation,   ligne_devis_prestation FROM client_ligne_devis WHERE client_ligne_devis_type_prestation = 1 AND client_devis = :client_devis";
  $stmtLigneDevis = $conn->prepare($queryLigneDevis);
  $stmtLigneDevis->bindParam(':client_devis', $client_devis_client['id_client_devis'], PDO::PARAM_INT);
  $stmtLigneDevis->execute();
  $client_ligne_devis = $stmtLigneDevis->fetchAll(PDO::FETCH_ASSOC);


  $queryLigneDevis2 = "SELECT prestation, unite, nbr_jour, pu_ht, pt_ht, client_ligne_devis_type_prestation , ligne_devis_prestation FROM client_ligne_devis WHERE client_ligne_devis_type_prestation = 2 AND client_devis = :client_devis";
  $stmtLigneDevis2 = $conn->prepare($queryLigneDevis2);
  $stmtLigneDevis2->bindParam(':client_devis', $client_devis_client['id_client_devis'], PDO::PARAM_INT);
  $stmtLigneDevis2->execute();
  $client_ligne_devi2 = $stmtLigneDevis2->fetchAll(PDO::FETCH_ASSOC);

  $queryLigneDevis3 = "SELECT prestation, unite, nbr_jour, pu_ht, pt_ht, client_ligne_devis_type_prestation , ligne_devis_prestation FROM client_ligne_devis WHERE client_ligne_devis_type_prestation = 3 AND client_devis = :client_devis";
  $stmtLigneDevis3 = $conn->prepare($queryLigneDevis3);
  $stmtLigneDevis3->bindParam(':client_devis', $client_devis_client['id_client_devis'], PDO::PARAM_INT);
  $stmtLigneDevis3->execute();
  $client_ligne_devi3 = $stmtLigneDevis3->fetchAll(PDO::FETCH_ASSOC);

  $responseData = array(
      'client_devis_factrue_client' => $client_devis_client,
      'client_devis' => $client_devis,
      'client_ligne_devis_1' => $client_ligne_devis,
      'client_ligne_devis_2' => $client_ligne_devi2, // Empty for client_ligne_devis_2
      'client_ligne_devis_3' => $client_ligne_devi3, // Empty for client_ligne_devis_2
  );

  // Set the content type to JSON
  header('Content-Type: application/json');

  // Send the JSON response
  echo json_encode($responseData);
?>