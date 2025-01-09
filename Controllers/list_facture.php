    <?php
    if (!isset($_SESSION['id_user'])) {
        include("../Front-end/se_connecter/se_connecter.php");
        exit();
    }
    // error_reporting(E_ALL);
    // ini_set('display_errors', 1);
    include 'connection_database.php';
    // Replace 'value' with the actual id_client you want to retrieve
    $idClient = isset($_GET['id_client']) ? $_GET['id_client'] : '';
    $De_Fa = isset($_GET['De_Fa']) ? $_GET['De_Fa'] : '' ;
    $societe = isset($_GET['societe']) ? $_GET['societe'] : '';

    $page_name = isset($_GET['page_name']) ? $_GET['page_name'] : '';

    if($idClient != '')
    {
        // if($_SESSION['profil'] == 'Administrateur system' )
        // {
        // SQL query
        $sql = "SELECT 
        cdc.id_client_Facture, 
        cdc.Numero_Facture,  
        cdc.societe, 
        cdc.nom_complet, 
        cdc.prix_total_ttc, 
        cdc.date_d_entree, 
        cdc.du_date, 
        cdc.a_tel_date,  
        cdc.id_client_devis, 
        cdc.objet, 
        cdc.id_client  
    FROM  
        (SELECT 
            id_client_Facture, 
            Numero_Facture, 
            prix_total_ttc, 
            cd.date_d_entree, 
            objet, 
            du_date, 
            a_tel_date,  
            cdc.id_client, 
            cdc.id_client_devis,  
            cdc.utilisateurs, 
            societe, 
            nom_complet  
        FROM 
            client_facture_client cdc 
        JOIN 
            client_devis cd 
        ON 
            cdc.id_client_devis = cdc.id_client_Facture
        JOIN 
            clients cs 
        ON 
            cs.id_client = cdc.id_client 
        ) cdc 
    WHERE 
        cdc.id_client = :id_client 
        AND cdc.id_client_Facture = cdc.id_client_Facture
    ORDER BY 
        cdc.Numero_Facture DESC;";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':id_client', $idClient, PDO::PARAM_STR);
        // }
        // else {
        //     $sql = "SELECT cdc.Numero_Facture  , cdc.societe , cdc.nom_complet , cdc.prix_total_ttc , cdc.date_d_entree, cdc.du_date, cdc.a_tel_date  ,  cdc.id_client_devis ,  cdc.objet cdc.id_client    FROM 
        //     (SELECT Numero_Facture, prix_total_ttc , cd.date_d_entree, du_date, a_tel_date , objet  , cdc.id_client_devis ,  cdc.id_client , cdc.utilisateurs  , societe , nom_complet  FROM client_facture_client cdc JOIN client_devis cd ON cdc.id_client_devis = cd.id_client_devis JOIN clients cs ON cs.id_client = cdc.id_client ) cdc 
        //     WHERE cdc.id_client = :id_client AND cdc.utilisateurs = :id_user
        //     ORDER BY cdc.Numero_Facture DESC;";
        //           $stmt = $conn->prepare($sql);
        //           $stmt->bindParam(':id_client', $idClient, PDO::PARAM_STR);
        //           $stmt->bindParam(':id_user', $_SESSION['id_user'], PDO::PARAM_STR);
        // }
        
    }
    else
    {
        //if($_SESSION['profil'] == 'Administrateur system' )
        // {
        // // SQL query
        $sql = "SELECT 
        cdc.id_client_Facture, 
        cdc.Numero_Facture,  
        cdc.societe, 
        cdc.nom_complet,  
        cdc.prix_total_ttc, 
        cdc.date_d_entree, 
        cdc.du_date, 
        cdc.a_tel_date,  
        cdc.id_client_devis, 
        cdc.objet, 
        cdc.id_client  
    FROM 
        (SELECT 
            id_client_Facture, 
            Numero_Facture, 
            prix_total_ttc, 
            cd.date_d_entree, 
            objet, 
            du_date, 
            a_tel_date,  
            cdc.id_client_devis,  
            cdc.id_client, 
            cdc.utilisateurs, 
            societe, 
            nom_complet  
        FROM 
            client_facture_client cdc 
        JOIN 
            client_devis cd 
        ON 
        cdc.id_client_Facture = cd.id_client_devis 
        JOIN 
            clients cs 
        ON 
            cs.id_client = cdc.id_client
        ) cdc 
    WHERE 
        cdc.id_client_Facture  = cdc.id_client_Facture
    ORDER BY 
        cdc.Numero_Facture DESC;

    ";
                $stmt = $conn->prepare($sql);
        // }
        // else {
            // $sql = "SELECT cdc.Numero_Facture , cdc.societe , cdc.nom_complet  , cdc.prix_total_ttc , cdc.date_d_entree, cdc.du_date, cdc.a_tel_date , id_client_devis ,  cdc.objet  , cdc.id_client   FROM 
            // (SELECT Numero_Facture, prix_total_ttc , cd.date_d_entree, du_date, a_tel_date , objet  , cdc.id_client_devis ,  cdc.id_client , cdc.utilisateurs  , societe , nom_complet  FROM client_facture_client cdc JOIN client_devis cd ON cdc.id_client_devis = cd.id_client_devis JOIN clients cs ON cs.id_client = cdc.id_client ) cdc 
            // WHERE  cdc.utilisateurs = :id_user
            // ORDER BY cdc.Numero_Facture DESC;";
            //     $stmt = $conn->prepare($sql);
            //     $stmt->bindParam(':id_user', $_SESSION['id_user'], PDO::PARAM_STR);
    // }

    }

    // Prepare and execute the statement
    try {
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo '<thead>
            <tr>
                <th>Numéro Facture</th>
                <th>Société</th>
                <th>Prix Total TTC</th>
                <th>Date d\'Entrée</th>
                <th>Du Date</th>
                <th>A Tel Date</th>
                <th>Objet</th>
                <th>Opération</th>
            </tr>
        </thead>';
    
        foreach ($result as $row) {
            $societe_value = $row['societe'] ?? $row['nom_complet'];
            $prix_total_ttc = number_format((float)$row['prix_total_ttc'], 2, '.', '');
    
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row['Numero_Facture']) . '</td>';
            echo '<td>' . htmlspecialchars($societe_value) . '</td>';
            echo '<td>' . $prix_total_ttc . ' DH</td>';
            echo '<td>' . htmlspecialchars($row['date_d_entree']) . '</td>';
            echo '<td>' . htmlspecialchars($row['du_date']) . '</td>';
            echo '<td>' . htmlspecialchars($row['a_tel_date']) . '</td>';
            echo '<td>' . htmlspecialchars($row['objet']) . '</td>';
            echo '<td>
                    <div style="display: flex; gap: 5px;">
                        <a href="../Ressources/index.php?page_name=devis_creation&page=Devis_client_id&id_client=' . htmlspecialchars($row['id_client']) . '&societe=' . urlencode($societe_value) . '&De_Fa=Facture&numero_facture=' . urlencode($row['Numero_Facture']) . '&id_client_devis=' . urlencode($row['id_client_devis']) . '&id_client_facture=' . urlencode($row['id_client_Facture']) . '" 
                            style="color: white;">
                            <button style="background: #eb8034;" data-toggle="tooltip" data-placement="left" title="Editer la facture" class="btn">
                                <i class="notika-icon notika-edit"></i>
                            </button>
                        </a>
                        <a target="_blank" href="../Ressources/Document.php?prix_ttc=' . $prix_total_ttc . '&id_client=' . htmlspecialchars($row['id_client']) . '&societe=' . urlencode($societe_value) . '&De_Fa=Facture&numero_devis=' . urlencode($row['Numero_Facture']) . '" 
                            style="color: white;">
                            <button style="background: #0035d3;" data-toggle="tooltip" data-placement="left" title="Aperçu/Telecharger" class="btn">
                                <i class="notika-icon notika-sent"></i>
                            </button>
                        </a>
                    </div>
                  </td>';
            echo '</tr>';
        }
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
    
    ?>
