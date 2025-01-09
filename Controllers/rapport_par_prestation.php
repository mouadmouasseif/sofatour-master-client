<?php
    session_start();
    if (!isset($_SESSION['id_user'])) {
        include("../Ressources/se_connecter.php");
        exit();
    }


// Récupérer les données POST
$postData = json_decode(file_get_contents("php://input"), true);

if (isset($postData['annee']) && isset($postData['prestation']) &&  isset($postData['DeFa']) ) {
    include '../Controllers/connection_database.php'; // Inclure le fichier de connexion à la base de données

    $annee = $postData['annee'];
    $prestations = $postData['prestation'];
    $DeFa = $postData['DeFa'];

    // Préparation de la requête SQL
    $placeholders = implode(',', array_fill(0, count($prestations), '?'));


    $query = '';
    if( $DeFa  == 'D')
    {
        $query = "SELECT SUM(cld.pt_ht + (cld.pt_ht * (cd.TVA/100))) AS total_prix, ldp.designation ,  ldp.prestation , ldp.id_ligne_devis_prestation
              FROM client_devis_client cdc
              JOIN client_devis cd ON cd.id_client_devis = cdc.id_client_devis 
              JOIN client_ligne_devis cld ON cld.client_devis = cd.id_client_devis
              JOIN ligne_devis_prestation ldp ON ldp.id_ligne_devis_prestation = cld.ligne_devis_prestation 
               JOIN 
                (SELECT 
                    Numero_devis, 
                    MAX(version_devis) AS devis_max, 
                    id_client, 
                    id_client_devis, 
                    utilisateurs 
                FROM 
                    client_devis_client 
                GROUP BY 
                    Numero_devis
                ) max_version 
                ON max_version.Numero_devis = cdc.Numero_devis 
                AND cdc.version_devis = max_version.devis_max 
                AND cdc.id_client = max_version.id_client
              WHERE EXTRACT(YEAR FROM cd.du_date) = ? AND confirmer = 1 AND annuler = 0 AND ldp.id_ligne_devis_prestation IN ($placeholders)
              GROUP BY ldp.id_ligne_devis_prestation
              ORDER BY total_prix DESC";
    }
    else if( $DeFa  == 'F')
    {

        $query = "SELECT SUM(cld.pt_ht + (cld.pt_ht * (cd.TVA/100))) AS total_prix, ldp.designation ,  ldp.prestation , ldp.id_ligne_devis_prestation
            FROM client_facture_client cdc
            JOIN client_devis cd ON cd.id_client_devis = cdc.id_client_Facture 
            JOIN client_ligne_devis cld ON cld.client_devis = cd.id_client_devis
            JOIN ligne_devis_prestation ldp ON ldp.id_ligne_devis_prestation = cld.ligne_devis_prestation 
            WHERE EXTRACT(YEAR FROM cd.du_date) = ? AND ldp.id_ligne_devis_prestation IN ($placeholders)
            GROUP BY ldp.id_ligne_devis_prestation
            ORDER BY total_prix DESC;";
    }

   

    $stmt = $conn->prepare($query);

    // Lier les valeurs des paramètres de la requête
    $params = array_merge([$annee], $prestations);
    $stmt->execute($params);

    // Récupérer les résultats de la requête
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Préparer la réponse JSON
    $response = [
        'success' => true,
        'data' => $results
    ];

    // Envoyer la réponse JSON
    header('Content-Type: application/json');
    echo json_encode($response);


    



} else {
    // Si les données nécessaires ne sont pas fournies
    $response = [
        'success' => false,
        'message' => 'Paramètres manquants'
    ];

    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
