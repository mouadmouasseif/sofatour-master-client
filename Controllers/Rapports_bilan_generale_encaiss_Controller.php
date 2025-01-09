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

    // Define the SQL query
    $sql = "
    SELECT 
    DATE_FORMAT(cdc.du_date, '%Y-%m') AS month_year,
    SUM(dp.Montant) AS total_prix_total_ttc 
            FROM 
                (
                    SELECT 
                      cd.id_client_devis,
                        Numero_devis, 
                        prix_total_ttc, 
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
                        JOIN client_devis cd ON cdc.id_client_devis = cd.id_client_devis
                ) cdc
                 JOIN 
                devis_paiements dp ON cdc.id_client_devis = dp.client_devis_client 
            WHERE dp.client_devis_client is NOT NULL 
            AND EXTRACT(YEAR FROM cdc.du_date) = :year
            AND dp.statut = 'Payé'
            AND cdc.confirmer = 1
            AND cdc.annuler  = 0
            GROUP BY month_year ORDER BY month_year;
    ";

    // Prepare the statement
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':year', $year, PDO::PARAM_INT);

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
