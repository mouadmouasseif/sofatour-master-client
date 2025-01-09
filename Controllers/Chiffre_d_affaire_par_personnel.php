<?php
session_start();

// Vérification de l'authentification de l'utilisateur
if (!isset($_SESSION['id_user'])) {
    include("../Ressources/se_connecter.php");
    exit();
}

include 'connection_database.php';

// Définir le type de contenu comme JSON
header('Content-Type: application/json');

// Récupération des données entrantes
$input = json_decode(file_get_contents('php://input'), true);

// Validation des entrées
if (!isset($input['DeFa']) || !isset($input['id_societe']) || !isset($input['year'])) {
    echo json_encode(['error' => 'Les paramètres DeFa, id_societe et year sont requis.']);
    exit();
}

$DeFa = $input['DeFa'];
$id_societe = $input['id_societe'];
$year = $input['year'];

try {
    // Configuration de PDO pour afficher les erreurs SQL
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Construction de la requête en fonction de la valeur de $DeFa
    $query = "";

    if ($DeFa === 'D') {
        $query = "  SELECT SUM(prix_total_ttc) AS total_prix, us.nom, us.prenom
        FROM client_devis_client cdc
        JOIN utilisateurs us ON us.id_user = cdc.utilisateurs
        JOIN clients cls ON cls.utilisateurs = us.id_user
        JOIN client_devis cd ON cd.id_client_devis = cdc.id_client_devis
        JOIN societes u_soc ON cls.id_societe = u_soc.id_societe
        JOIN (
            SELECT 
                Numero_devis, 
                MAX(version_devis) AS devis_max, 
                id_client, 
                id_client_devis, 
                utilisateurs 
            FROM client_devis_client 
            GROUP BY Numero_devis
        ) max_version 
        ON max_version.Numero_devis = cdc.Numero_devis 
        AND cdc.version_devis = max_version.devis_max 
        AND cdc.id_client = max_version.id_client
        WHERE EXTRACT(YEAR FROM cd.du_date) = :year
          AND cdc.confirmer = 1 
          AND cdc.annuler = 0
          AND u_soc.id_societe = :id_societe
        GROUP BY us.id_user, us.nom, us.prenom 
        ORDER BY total_prix DESC;";
    } elseif ($DeFa === 'F') {
        $query = "SELECT 
        SUM(prix_total_ttc) AS total_prix, 
        us.nom, 
        us.prenom 
        FROM 
        client_facture_client cdc
        JOIN 
        client_devis cd 
        ON cd.id_client_devis = cdc.id_client_facture
        JOIN 
        utilisateurs us 
        ON us.id_user = cdc.utilisateurs
        JOIN 
        utilisateur_societes u_soc 
        ON us.id_user = u_soc.id_user
        WHERE 
        EXTRACT(YEAR FROM cd.du_date) = :year
        AND u_soc.id_societe = :id_societe
        GROUP BY 
        us.id_user, 
        us.nom, 
        us.prenom 
        ORDER BY 
        total_prix DESC;";
    } else {
        echo json_encode(['error' => 'Le paramètre DeFa est invalide.']);
        exit();
    }

    // Préparation et exécution de la requête
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':year', $year, PDO::PARAM_INT);
    $stmt->bindParam(':id_societe', $id_societe, PDO::PARAM_INT);

    $stmt->execute();

    // Récupération des résultats
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Envoi des résultats en JSON
    echo json_encode($results);

} catch (PDOException $e) {
    // Gestion des erreurs SQL
    echo json_encode(['error' => 'Erreur SQL : ' . $e->getMessage()]);
} catch (Exception $e) {
    // Gestion des autres erreurs
    echo json_encode(['error' => 'Erreur : ' . $e->getMessage()]);
} finally {
    // Fermeture de la connexion à la base de données
    $conn = null;
}
?>
