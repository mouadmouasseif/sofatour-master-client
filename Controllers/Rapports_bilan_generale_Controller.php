<?php
session_start();

if (!isset($_SESSION['id_user'])) {
    include("../Ressources/se_connecter.php");
    exit();
}

include 'connection_database.php';

try {
    // Get the parameters from the URL
    $year = isset($_GET['year']) ? $_GET['year'] : date('Y');
    $client_ligne_devis_type_prestation = isset($_GET['type_prestation']) ? intval($_GET['type_prestation']) : 1;
    $id_societe = isset($_GET['id_societe']);

    // Define the SQL query
    $sql = "
  SELECT 
    DATE_FORMAT(cdc.du_date, '%Y-%m') AS month_year,
    SUM(cdc.prix_total_ttc) AS total_prix_total_ttc
    FROM 
        (SELECT 
            Numero_devis, 
            SUM(cld.pt_ht + (cld.pt_ht * (cd.TVA / 100))) AS prix_total_ttc, 
            date_d_entree, 
            objet, 
            du_date, 
            a_tel_date, 
            version_devis, 
            id_client, 
            utilisateurs, 
            confirmer, 
            annuler 
        FROM 
            client_devis_client cdc 
        JOIN 
            client_devis cd ON cdc.id_client_devis = cd.id_client_devis 
        JOIN 
            client_ligne_devis cld ON cld.client_devis = cd.id_client_devis
            
        WHERE   
            cld.client_ligne_devis_type_prestation = :type_prestation
            AND YEAR(cd.du_date) = :year
            AND confirmer = 1 AND annuler = 0
        GROUP BY 
            Numero_devis, date_d_entree, objet, du_date, a_tel_date, version_devis, id_client, utilisateurs, confirmer, annuler
        ) cdc
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
    JOIN 
        (SELECT 
            societe, 
            id_client, 
            id_societe,
            nom_complet 
        FROM 
            clients
        ) clc 
        ON clc.id_client = cdc.id_client
    JOIN 
        (SELECT 
            id_user, 
            nom, 
            prenom  
        FROM 
            utilisateurs
        ) us 
        ON us.id_user = cdc.utilisateurs
       
    WHERE 
        cdc.du_date IS NOT NULL
        AND clc.id_societe = :id_societe
    GROUP BY 
        month_year
    ORDER BY 
        month_year ASC;
    ";

    // Prepare the statement
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':year', $year, PDO::PARAM_INT);
    $stmt->bindParam(':type_prestation', $client_ligne_devis_type_prestation, PDO::PARAM_INT);
    $stmt->bindParam(':id_societe', $id_societe, PDO::PARAM_INT);

    // Execute the statement
    $stmt->execute();

    // Fetch the results
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return the results as JSON
    echo json_encode($result);

} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

// Close the connection
$conn = null;
?>
