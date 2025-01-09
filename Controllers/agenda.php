<?php
session_start();
if (!isset($_SESSION['id_user'])) {
    include("../Ressources/se_connecter.php");
    exit();
}
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
include 'connection_database.php';
// Replace 'value' with the actual id_client you want to retrieve

$input = json_decode(file_get_contents('php://input'), true);
$societeFilter = isset($input['societe']) ? $input['societe'] : '0'; // 0 signifie "toutes les sociétés"


if ($_SESSION['profil'] == 'Administrateur system') {
        
    $sql = "SELECT
            cdc.Numero_devis,
            cdc.prix_total_ttc,
            cdc.date_d_entree,
            cdc.du_date,
            DATE_ADD(cdc.a_tel_date, INTERVAL 1 DAY) AS a_tel_date,
            cdc.version_devis,
            id_client_devis,
            cdc.objet,
            clc.societe,
            clc.nom_complet,
            us.nom,
            us.prenom,
            cdc.confirmer,
            cdc.annuler
        FROM
            (SELECT
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
                     JOIN
                 client_devis cd
                 ON
                         cdc.id_client_devis = cd.id_client_devis) cdc
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
                 Numero_devis) max_version
            ON
                        max_version.Numero_devis = cdc.Numero_devis
                    AND cdc.id_client = max_version.id_client
                    AND cdc.version_devis = max_version.devis_max
                JOIN
            (SELECT
                 societe,
                 id_client,
                 nom_complet,
                 id_societe
             FROM
                 clients) clc
            ON
                    clc.id_client = cdc.id_client
                JOIN
            (SELECT
                 id_user,
                 nom,
                 prenom
             FROM
                 utilisateurs) us
            ON
                    us.id_user = cdc.utilisateurs";
    
    if ($societeFilter !== '0') {
        $sql .= " WHERE clc.id_societe = :societe ";
    }
    $sql .= " ORDER BY cdc.Numero_devis DESC;";
    $stmt = $conn->prepare($sql);
    if ($societeFilter !== '0') {
        $stmt->bindParam(':societe', $societeFilter, PDO::PARAM_STR);
    }
}
else {
        $sql = "SELECT cdc.Numero_devis, cdc.prix_total_ttc, cdc.date_d_entree, cdc.du_date, DATE_ADD(cdc.a_tel_date, INTERVAL 1 DAY) AS a_tel_date, cdc.version_devis, id_client_devis, cdc.objet, clc.societe, clc.nom_complet, us.nom, us.prenom, cdc.confirmer, cdc.annuler FROM
            (SELECT Numero_devis, prix_total_ttc, date_d_entree, objet, du_date, a_tel_date, version_devis, id_client, utilisateurs, confirmer, annuler FROM client_devis_client cdc JOIN client_devis cd ON cdc.id_client_devis = cd.id_client_devis ) cdc JOIN
            (SELECT Numero_devis, MAX(version_devis) AS devis_max, id_client, id_client_devis, utilisateurs FROM client_devis_client GROUP BY Numero_devis ) max_version ON max_version.Numero_devis = cdc.Numero_devis AND cdc.id_client = max_version.id_client AND cdc.version_devis = max_version.devis_max JOIN
            (SELECT societe, id_client, nom_complet FROM clients ) clc ON clc.id_client = cdc.id_client 
            JOIN 
            (SELECT id_user, nom, prenom FROM utilisateurs ) us ON us.id_user = cdc.utilisateurs 
            JOIN utilisateur_societes us_soc ON us_soc.id_user = us.id_user AND us_soc.id_societe = clc.societe 
            WHERE us.id_user = :id_user ORDER BY cdc.Numero_devis DESC;";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_user', $_SESSION['id_user'], PDO::PARAM_STR);
}

// Prepare and execute the statement
try {
 
    $stmt->execute();

    // Fetch the results
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode( $result );


} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

// Close the connection
$pdo = null;

?>
