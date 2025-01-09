<?php
session_start();
if (!isset($_SESSION['id_user'])) {
    include("../Ressources/se_connecter.php");
    exit();
}

include 'connection_database.php';

try {

    $conn->beginTransaction(); // Begin the transaction
    function clean_input($input) {
        return htmlspecialchars(strip_tags($input), ENT_QUOTES, 'UTF-8');
    }

    $id_societe = $_GET['id_societe']; 
    if (!$id_societe) {
        throw new Exception("L'ID de la société est introuvable.");
    }

    error_log("id societe : ". $id_societe);
    // Inclure la connexion à la base de données ici
    $De_Fa = $_GET['De_Fa'];

    // Récupérer les données du corps de la requête
    $data = json_decode(file_get_contents("php://input"), true);

    // Nettoyer les données
    $client_devis_factrue_client = $data['client_devis_factrue_client'];
    $client_devis = $data['client_devis'];
    $client_ligne_devis_1 =  $data['client_ligne_devis_1'];
    $client_ligne_devis_2 = $data['client_ligne_devis_2'];
    $client_ligne_devis_3 = $data['client_ligne_devis_3'];
    $dateTimeObject = new DateTime(); 
    $currentDateTimeObject = $dateTimeObject->format("d/m/Y");
     
    if($De_Fa == 'Devis')
    {
        
        if($client_devis_factrue_client['version_devis'] == 1)
        {
            $query_dernier_numero_devis = " SELECT d.numero_devis_facture, d.annee FROM dernier_numero_devis_facture d JOIN societes s ON d.id_societe = s.id_societe WHERE type = 'Devis' AND  s.id_societe = :id_societe";
            $stmt = $conn->prepare($query_dernier_numero_devis);
            $stmt->bindParam(':id_societe', $id_societe, PDO::PARAM_INT);
            $stmt->execute();
            $dernier_numero_devis_result = $stmt->fetch(PDO::FETCH_ASSOC);

                $numero_devis_formatte = '';
                if ($dernier_numero_devis_result) {
                    $annee_actuelle = date("Y");
                    $type = "DE";

                    if ($dernier_numero_devis_result['annee'] == $annee_actuelle) {
                        // Si l'année est la même, incrémentez le numéro existant
                        $numero_devis = (int)$dernier_numero_devis_result['numero_devis_facture'] + 1;
                    } else {
                        // Si l'année est différente, commencez avec le numéro 1 pour cette année
                        $numero_devis = 1;
                    }

                    // Formatage du numéro de devis
                    $numero_devis_formatte = $type . "-" . $annee_actuelle . "-" . str_pad($numero_devis, 5, "0", STR_PAD_LEFT);

                    // Utilisez $numero_devis_formatte comme nécessaire dans votre application
                }

                
                $query_verify = 'SELECT * FROM client_devis_client WHERE id_client = :id_client AND Numero_devis = :Numero_devis AND version_devis = :version_devis ' ;
                $stmtverify= $conn->prepare($query_verify);

                $stmtverify->bindParam(':id_client',   $client_devis_factrue_client['id_client'] , PDO::PARAM_INT);
                $stmtverify->bindParam(':Numero_devis',   $numero_devis_formatte , PDO::PARAM_STR);
                $stmtverify->bindParam(':version_devis',   $client_devis_factrue_client['version_devis'] , PDO::PARAM_INT);
                
                $stmtverify->execute();
                $verify_result = $stmtverify->fetch(PDO::FETCH_ASSOC);

        }
        else 
        {
                $query_verify = 'SELECT * FROM client_devis_client WHERE id_client = :id_client AND Numero_devis = :Numero_devis AND version_devis = :version_devis ' ;
                $stmtverify= $conn->prepare($query_verify);

                $stmtverify->bindParam(':id_client',   $client_devis_factrue_client['id_client'] , PDO::PARAM_INT);
                $stmtverify->bindParam(':Numero_devis',   $client_devis_factrue_client['Numero_devis']  , PDO::PARAM_STR);
                $stmtverify->bindParam(':version_devis',   $client_devis_factrue_client['version_devis'] , PDO::PARAM_INT);
                
                $stmtverify->execute();
                $verify_result = $stmtverify->fetch(PDO::FETCH_ASSOC);
        }
        




    }
    else
    {
        $query_dernier_numero_facture = " SELECT d.numero_devis_facture, d.annee
                                        FROM dernier_numero_devis_facture d
                                        JOIN societes s ON d.id_societe = s.id_societe
                                        WHERE d.type = 'Facture' AND s.id_societe = :id_societe;" ;
        $stmtdernier_numero_facture= $conn->prepare($query_dernier_numero_facture);
        $stmtdernier_numero_facture->bindParam(':id_societe', $id_societe, PDO::PARAM_INT);
        $stmtdernier_numero_facture->execute();
        $dernier_numero_facture_result = $stmtdernier_numero_facture->fetch(PDO::FETCH_ASSOC);
        $numero_facture_formatte = '';
        if ($dernier_numero_facture_result) {
            $annee_actuelle = date("Y");
            $type = "FA";

            if ($dernier_numero_facture_result['annee'] == $annee_actuelle) {
                // Si l'année est la même, incrémentez le numéro existant
                $numero_facture = (int)$dernier_numero_facture_result['numero_devis_facture'] + 1;
            } else {
                // Si l'année est différente, commencez avec le numéro 1 pour cette année
                $numero_facture = 1;
            }
            // Formatage du numéro de devis
            $numero_facture_formatte = $type . "-" . $annee_actuelle . "-" . str_pad($numero_facture, 5, "0", STR_PAD_LEFT);
            // Utilisez $numero_devis_formatte comme nécessaire dans votre application
            } 



            
            $query_verify = 'SELECT * FROM client_facture_client WHERE Numero_Facture = :Numero_Facture ';
            $stmtverify= $conn->prepare($query_verify);

            $stmtverify->bindParam(':Numero_Facture',   $numero_facture_formatte  , PDO::PARAM_STR);
            $stmtverify->execute();
            $verify_result = $stmtverify->fetch(PDO::FETCH_ASSOC);

            
        }

        if ($verify_result) {
            // Data exists, return an error message
            echo json_encode(['success' => false, 'message' => 'Numéro de devis ou facture déjà existant ! Veuillez changer le numéro de devis ou facture']);
        } else {
                error_log("valeur recu : " . $client_devis['a_devis']);
                // Insérer les données dans la table client_devis
                $insertDevisQuery = " INSERT INTO client_devis (le_devis, a_devis,  date_d_entree, TVA, Observation) 
                                        VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($insertDevisQuery);
                $stmt->execute([
                    $client_devis['le_devis'],
                    $client_devis['a_devis'],
                   // $client_devis['objet'],
                     $client_devis['date_d_entree'],
                    // $client_devis['du_date'],
                    // $client_devis['a_tel_date'],
                    $client_devis['TVA'],
                    // $client_devis['devis_objet'],
                    $client_devis['Observation']
                ]); 
                $lastInsertedDevisId = $conn->lastInsertId();
                
                if($De_Fa == 'Devis')
                {
                    // Insérer les données dans la table client_devis_client
                        $insertClientDevisClientQuery = "INSERT INTO client_devis_client (id_client_devis, id_client, utilisateurs, version_devis, Numero_devis, prix_total_ttc) VALUES (?, ?, ?, ?, ?, ?)";
                        $stmt = $conn->prepare($insertClientDevisClientQuery);
                        $stmt->execute([
                            $lastInsertedDevisId,
                            $client_devis_factrue_client['id_client'],
                            $client_devis_factrue_client['utilisateurs'],
                            $client_devis_factrue_client['version_devis'],
                            ($client_devis_factrue_client['version_devis'] == 1 ? $numero_devis_formatte : $client_devis_factrue_client['Numero_devis']),
                            $client_devis_factrue_client['prix_total_ttc'],
                        ]);
                        if($client_devis_factrue_client['version_devis'] == 1)
                        {
                            $query_update = "UPDATE dernier_numero_devis_facture  SET numero_devis_facture = :numero_devis  , annee = :annee  WHERE type = 'Devis' AND societe_id = :id_societe";
                            $stmt_update = $conn->prepare($query_update);
                            $stmt_update->bindParam(':numero_devis',  $numero_devis, PDO::PARAM_INT);
                            $stmt_update->bindParam(':annee', $annee_actuelle, PDO::PARAM_STR);
                            $stmt_update->bindParam(':id_societe', $id_societe, PDO::PARAM_INT);
                            $stmt_update->execute();
                        }
                    
                }else {
                
                    
                        $insertClientDevisClientQuery = "INSERT INTO client_facture_client (id_client_Facture , id_client_devis, id_client, utilisateurs, Numero_Facture, prix_total_ttc) VALUES (?, ?, ?, ?, ?, ?)";
                        $stmt = $conn->prepare($insertClientDevisClientQuery);
                        $stmt->execute([
                            $lastInsertedDevisId,
                            $client_devis_factrue_client['id_client_devis'],
                            $client_devis_factrue_client['id_client'],
                            $client_devis_factrue_client['utilisateurs'],
                            $numero_facture_formatte,
                            $client_devis_factrue_client['prix_total_ttc'],
                        ]);

                        $query_update = "UPDATE dernier_numero_devis_facture  SET numero_devis_facture = :numero_devis  , annee = :annee  WHERE type = 'Facture' AND societe_id = :id_societe";
                        $stmt_update = $conn->prepare($query_update);
                        $stmt_update->bindParam(':numero_devis', $numero_facture, PDO::PARAM_INT);
                        $stmt_update->bindParam(':annee', $annee_actuelle, PDO::PARAM_STR);
                        $stmt_update->bindParam(':id_societe', $id_societe, PDO::PARAM_INT);
                        $stmt_update->execute();
                }

                // Insérer les données dans la table client_ligne_devis
                if($client_ligne_devis_1 != null)
                {
                    foreach ($client_ligne_devis_1 as $client_ligne) {
                        $insertClientLigneDevisQuery = "INSERT INTO client_ligne_devis (prestation, unite, nbr_jour, pu_ht, pt_ht, client_ligne_devis_type_prestation, client_devis,ligne_devis_prestation) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                        $stmt = $conn->prepare($insertClientLigneDevisQuery);
                        $stmt->execute([
                            $client_ligne['prestation'],
                            $client_ligne['unite'],
                            $client_ligne['nbr_jour'],
                            $client_ligne['pu_ht'],
                            $client_ligne['pt_ht'],
                            $client_ligne['client_ligne_devis_type_prestation'],
                            $lastInsertedDevisId,
                            $client_ligne['ligne_devis_prestation']

                        ]);

                    

                    }
                }


                if($client_ligne_devis_2 != null)
                {
                    foreach ($client_ligne_devis_2 as $client_ligne) {
                        $insertClientLigneDevisQuery = "INSERT INTO client_ligne_devis (prestation, unite, nbr_jour, pu_ht, pt_ht, client_ligne_devis_type_prestation, client_devis,ligne_devis_prestation) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                        $stmt = $conn->prepare($insertClientLigneDevisQuery);
                        $stmt->execute([
                            $client_ligne['prestation'],
                            $client_ligne['unite'],
                            $client_ligne['nbr_jour'],
                            $client_ligne['pu_ht'],
                            $client_ligne['pt_ht'],
                            $client_ligne['client_ligne_devis_type_prestation'],
                            $lastInsertedDevisId,
                            $client_ligne['ligne_devis_prestation']
                        ]);
                    }
                }

                if($client_ligne_devis_3 != null)
                {
                    foreach ($client_ligne_devis_3 as $client_ligne) {
                        $insertClientLigneDevisQuery = "INSERT INTO client_ligne_devis (prestation, unite, nbr_jour, pu_ht, pt_ht, client_ligne_devis_type_prestation, client_devis,ligne_devis_prestation) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                        $stmt = $conn->prepare($insertClientLigneDevisQuery);
                        $stmt->execute([
                            $client_ligne['prestation'],
                            $client_ligne['unite'],
                            $client_ligne['nbr_jour'],
                            $client_ligne['pu_ht'],
                            $client_ligne['pt_ht'],
                            $client_ligne['client_ligne_devis_type_prestation'],
                            $lastInsertedDevisId,
                            $client_ligne['ligne_devis_prestation']
                        ]);
                    }
                }


               
  

                // Répondre avec un statut de succès
                     $conn->commit();
                    if($De_Fa == 'Devis')
                    {
                        if($client_devis_factrue_client['version_devis'] == 1)
                        {
                            echo json_encode(['success' => true , 'numero' =>  $numero_devis_formatte]);
                        } 
                        else 
                        {
                
                            echo json_encode(['success' => true , 'numero' =>  $client_devis_factrue_client['Numero_devis']]);
                        }
                    }
                    else
                    {
                        echo json_encode(['success' => true , 'numero' => $numero_facture_formatte]);
                    }
            
            
        }
    }
     catch (Exception $e) {
            // An error occurred, roll back the transaction
            $conn->rollBack();
            echo json_encode(['success' => false, 'message' => 'Transaction failed: ' . $e->getMessage()]);
        } finally {
            // Close the connection
            $conn = null;
        }
?>