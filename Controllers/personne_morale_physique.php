<?php
session_start();
if (!isset($_SESSION['id_user'])) {
    include("../Ressources/se_connecter.php");
    exit();
}
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'connection_database.php';
function clean_input($input) {
    if($input != null)
    return htmlspecialchars(strip_tags($input), ENT_QUOTES, 'UTF-8');
    else
    return null;
}
 // Set the PDO error mode to exception
 try {
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $json_data = file_get_contents('php://input');
    $data = json_decode($json_data);

    // Données de l'utilisateur
    $societe = clean_input($data->clients->societe);
    $ice = clean_input($data->clients->ice);
    $rc = clean_input($data->clients->rc);
    $adresse = clean_input($data->clients->adresse);
    $nom_complet = clean_input($data->clients->nom_complet);
    $date_d_entree = clean_input($data->clients->date_d_entree);
    $utilisateurs = clean_input($data->clients->utilisateurs);
    $client_type = clean_input($data->clients->client_type);
    $avance = filter_var($data->clients->avance, FILTER_VALIDATE_BOOLEAN);
    $client_secteur = clean_input($data->clients->client_secteur);
    $Agence_evementiel = filter_var($data->clients->Agence_evementiel, FILTER_VALIDATE_BOOLEAN);
    $client_id_societe = clean_input($data->clients->id_societe);
    

    // Insertion des données dans la table 'clients' (utilisation de requêtes préparées)
    if($_GET['client_type'] != 'Personne_Physique' && $_GET['client_type'] != 'Personne_Individuelle')
    {
        if($client_secteur == 3)
        {
            $stmt_clients = $conn->prepare("INSERT INTO clients (societe, adresse, date_d_entree, utilisateurs ,client_type, avance, client_secteur, Agence_evementiel, id_societe)
            VALUES (?, ?, ?, ? , ?, ?, ?, ? , ?)");

            $stmt_clients->execute([$societe , $adresse, $date_d_entree, $utilisateurs  , $client_type, $avance, $client_secteur, $Agence_evementiel , $client_id_societe]);

        }
        else
        {
            $stmt_clients = $conn->prepare("INSERT INTO clients (societe, ice, rc, adresse, date_d_entree, utilisateurs ,client_type, avance, client_secteur, Agence_evementiel, id_societe)
            VALUES (?, ?, ?, ?, ?, ? , ?, ?, ?, ? , ?)");

            $stmt_clients->execute([$societe, $ice, $rc, $adresse, $date_d_entree, $utilisateurs  , $client_type, $avance, $client_secteur, $Agence_evementiel , $client_id_societe]);
        }
    }
    else
    {
        $stmt_clients = $conn->prepare("INSERT INTO clients (adresse, date_d_entree, utilisateurs, nom_complet ,client_type, avance , Agence_evementiel, id_societe)
        VALUES (?, ?, ?, ? , ?, ?, ? ,?)");

        $stmt_clients->execute([$adresse, $date_d_entree, $utilisateurs , $nom_complet , $client_type, $avance , $Agence_evementiel, $client_id_societe]);
    }
   

    $last_inserted_id = $conn->lastInsertId();

    // Traitement des responsables/interlocuteurs
    $stmt_responsable = $conn->prepare("INSERT INTO client_responsable_interlocuteur (nom_complet, email, c_responsable_interlocuteur, numero_telephone, clients)
                                        VALUES (?, ?, ?, ?, ?)");
   
    foreach ($data->responsable_interlocuteurs as $responsable) {
        $nom_complet = clean_input($responsable->nom_complet);
        $email = clean_input($responsable->email);
        $c_responsable_interlocuteur = clean_input($responsable->c_responsable_interlocuteur);
        $numero_telephone = clean_input($responsable->numero_telephone);

        // Insertion des données dans la table 'client_responsable_interlocuteur'
     
        $stmt_responsable->execute([$nom_complet, $email, $c_responsable_interlocuteur, $numero_telephone, $last_inserted_id]);
    }
    $stmt_responsable->closeCursor();

    // Traitement des modalités de paiement
    if ($avance == false) {
        $stmt_sans_avances = $conn->prepare("INSERT INTO client_modalite_payement_sans_avance (Totalite, etalonage, semaine, mois, clients)
                                            VALUES (?, ?, ?, ?, ?)");

        $totalite = filter_var($data->client_modalite_payement_sans_avances->Totalite, FILTER_VALIDATE_BOOLEAN);
        $etalonage_sans_avances = clean_input($data->client_modalite_payement_sans_avances->etalonage);
        $semaine_sans_avances = filter_var($data->client_modalite_payement_sans_avances->semaine, FILTER_VALIDATE_BOOLEAN);
        $mois_sans_avances = filter_var($data->client_modalite_payement_sans_avances->mois, FILTER_VALIDATE_BOOLEAN);

        // Insertion des données dans la table 'client_modalite_payement_sans_avance'
        $stmt_sans_avances->execute([$totalite, $etalonage_sans_avances, $semaine_sans_avances, $mois_sans_avances, $last_inserted_id]);

        $stmt_sans_avances->closeCursor();
    } else {
        $stmt_avances = $conn->prepare("INSERT INTO client_modalite_payement_avance (pourcentage, etalonage, semaine, mois, clients)
                                        VALUES (?, ?, ?, ?, ?)");

        $pourcentage_avances = clean_input($data->client_modalite_payement_avances->pourcentage);
        $etalonage_avances = clean_input($data->client_modalite_payement_avances->etalonage);
        $semaine_avances = filter_var($data->client_modalite_payement_avances->semaine, FILTER_VALIDATE_BOOLEAN);
        $mois_avances = filter_var($data->client_modalite_payement_avances->mois, FILTER_VALIDATE_BOOLEAN);

        // Insertion des données dans la table 'client_modalite_payement_avance'
        $stmt_avances->execute([$pourcentage_avances, $etalonage_avances, $semaine_avances, $mois_avances, $last_inserted_id]);

        $stmt_avances->closeCursor();
    }

    $response = ['success' => true];
    echo json_encode($response);
} catch (PDOException $e) {
      // Répondre au script JavaScript avec une réponse JSON
  if ($e->getCode() == '23000' && strpos($e->getMessage(), 'clients.societe') !== false) {
    // Duplicate entry for 'societe' column
    $response = ['success' => false, 'error' => 'Duplicate entry for Societe'];
} else {
    // Other PDO exceptions
    $response = ['success' => false ,'error' => $e->getMessage()];
}
    echo json_encode($response);
} finally {
 // Fermer la connexion à la base de données
         $conn = null;
}

?>