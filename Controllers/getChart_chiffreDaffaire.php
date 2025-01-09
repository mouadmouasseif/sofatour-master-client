<?php
session_start();
if (!isset($_SESSION['id_user'])) {
    include("../Front-end/se_connecter/se_connecter.php");
    exit();
}
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
include 'connection_database.php';
// Replace 'value' with the actual id_client you want to retrieve
$annee = isset($_GET['annee']) ? $_GET['annee'] : '';



            // SQL query
            $sql = "SELECT 
            EXTRACT(MONTH FROM cdc.du_date) AS mois,
            SUM(cdc.prix_total_ttc) AS somme_prix_total
            FROM 
                (
                    SELECT 
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
                        JOIN client_devis cd ON cdc.id_client_devis = cd.id_client_devis
                        JOIN client_ligne_devis cld ON cld.client_devis = cd.id_client_devis
                    GROUP BY 
                          Numero_devis, date_d_entree, objet, du_date, a_tel_date, version_devis, id_client, utilisateurs, confirmer, annuler
                ) cdc
                JOIN (
                    SELECT 
                        Numero_devis, 
                        MAX(version_devis) devis_max, 
                        id_client, 
                        id_client_devis, 
                        utilisateurs
                    FROM 
                        client_devis_client
                    GROUP BY 
                        Numero_devis
                ) max_version ON max_version.Numero_devis = cdc.Numero_devis 
                            AND cdc.id_client = max_version.id_client 
                            AND cdc.version_devis = max_version.devis_max
            WHERE 
                EXTRACT(YEAR FROM cdc.du_date) = :annee
                AND cdc.confirmer = 1
                AND cdc.annuler  = 0
            GROUP BY 
                mois
            ORDER BY 
                mois;";
              $stmt = $conn->prepare($sql);
              $stmt->bindParam(':annee',$annee, PDO::PARAM_INT);
              $stmt->execute();
       

              // Fetch the results
              $result = $stmt->fetchAll(PDO::FETCH_ASSOC);




              $sql_2 = "SELECT 
              EXTRACT(MONTH FROM cdc.du_date) AS mois,
              SUM(cdc.prix_total_ttc) AS somme_prix_total
              FROM 
                  (
                     SELECT 
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
                        JOIN client_devis cd ON cdc.id_client_devis = cd.id_client_devis
                        JOIN client_ligne_devis cld ON cld.client_devis = cd.id_client_devis
                    GROUP BY 
                          Numero_devis, date_d_entree, objet, du_date, a_tel_date, version_devis, id_client, utilisateurs, confirmer, annuler
                  ) cdc
                  JOIN (
                      SELECT 
                          Numero_devis, 
                          MAX(version_devis) devis_max, 
                          id_client, 
                          id_client_devis, 
                          utilisateurs
                      FROM 
                          client_devis_client
                      GROUP BY 
                          Numero_devis
                  ) max_version ON max_version.Numero_devis = cdc.Numero_devis 
                              AND cdc.id_client = max_version.id_client 
                              AND cdc.version_devis = max_version.devis_max
              WHERE 
                  EXTRACT(YEAR FROM cdc.du_date) = :annee
                  AND cdc.confirmer = 0
                  AND cdc.annuler  = 0
              GROUP BY 
                  mois
              ORDER BY 
                  mois;";


            $stmt2 = $conn->prepare($sql_2);
            $stmt2->bindParam(':annee',$annee, PDO::PARAM_INT);
            $stmt2->execute();


            // Fetch the results
            $result2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);



            $sql_3 = "SELECT 
            EXTRACT(MONTH FROM cdc.du_date) AS mois,
            SUM(cdc.prix_total_ttc) AS somme_prix_total
            FROM 
                (
                   SELECT 
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
                        JOIN client_devis cd ON cdc.id_client_devis = cd.id_client_devis
                        JOIN client_ligne_devis cld ON cld.client_devis = cd.id_client_devis
                    GROUP BY 
                          Numero_devis, date_d_entree, objet, du_date, a_tel_date, version_devis, id_client, utilisateurs, confirmer, annuler
                ) cdc
                JOIN (
                    SELECT 
                        Numero_devis, 
                        MAX(version_devis) devis_max, 
                        id_client, 
                        id_client_devis, 
                        utilisateurs
                    FROM 
                        client_devis_client
                    GROUP BY 
                        Numero_devis
                ) max_version ON max_version.Numero_devis = cdc.Numero_devis 
                            AND cdc.id_client = max_version.id_client 
                            AND cdc.version_devis = max_version.devis_max
            WHERE 
                EXTRACT(YEAR FROM cdc.du_date) = :annee
            GROUP BY 
                mois
            ORDER BY 
                mois;";

          $stmt3 = $conn->prepare($sql_3);
          $stmt3->bindParam(':annee',$annee, PDO::PARAM_INT);
          $stmt3->execute();

            // Fetch the results
            $result3 = $stmt3->fetchAll(PDO::FETCH_ASSOC);
       
          $sql_4 = "SELECT 
          EXTRACT(MONTH FROM cdc.du_date) AS mois,
          SUM(cdc.prix_total_ttc) AS somme_prix_total
          FROM 
              (
                 SELECT 
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
                        JOIN client_devis cd ON cdc.id_client_devis = cd.id_client_devis
                        JOIN client_ligne_devis cld ON cld.client_devis = cd.id_client_devis
                    GROUP BY 
                          Numero_devis, date_d_entree, objet, du_date, a_tel_date, version_devis, id_client, utilisateurs, confirmer, annuler
              ) cdc
              JOIN (
                  SELECT 
                      Numero_devis, 
                      MAX(version_devis) devis_max, 
                      id_client, 
                      id_client_devis, 
                      utilisateurs
                  FROM 
                      client_devis_client
                  GROUP BY 
                      Numero_devis
              ) max_version ON max_version.Numero_devis = cdc.Numero_devis 
                          AND cdc.id_client = max_version.id_client 
                          AND cdc.version_devis = max_version.devis_max
          WHERE 
              EXTRACT(YEAR FROM cdc.du_date) = :annee
              AND cdc.annuler  = 1
          GROUP BY 
              mois
          ORDER BY 
              mois;";

        $stmt4 = $conn->prepare($sql_4);
        $stmt4->bindParam(':annee',$annee, PDO::PARAM_INT);
        $stmt4->execute();


          // Fetch the results
          $result4 = $stmt4->fetchAll(PDO::FETCH_ASSOC);



          $sql_5 = "SELECT 
                 EXTRACT(MONTH FROM cdc.le_devis) AS mois,
                SUM(dp.Montant) AS somme_prix_total 
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
                        annuler,
                        le_devis
                    FROM 
                        client_devis_client cdc 
                        JOIN client_devis cd ON cdc.id_client_devis = cd.id_client_devis
                ) cdc
            JOIN 
                devis_paiements dp ON cdc.id_client_devis = dp.client_devis_client 
            WHERE dp.client_devis_client is NOT NULL 
            AND EXTRACT(YEAR FROM cdc.le_devis) = :annee
            AND dp.statut = 'Payé'
            GROUP BY mois ORDER BY mois;";

        $stmt5 = $conn->prepare($sql_5);
        $stmt5->bindParam(':annee',$annee, PDO::PARAM_INT);
        $stmt5->execute();


          // Fetch the results
          $result5 = $stmt5->fetchAll(PDO::FETCH_ASSOC);



          $sql_6 = "SELECT 
               EXTRACT(MONTH FROM cdc.du_date) AS mois,
              SUM(cdc.prix_total_ttc) AS somme_prix_total 
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
            WHERE dp.client_devis_client is NULL 
            AND EXTRACT(YEAR FROM cdc.du_date) = :annee
            GROUP BY mois ORDER BY mois;";

        $stmt6 = $conn->prepare($sql_6);
        $stmt6->bindParam(':annee',$annee, PDO::PARAM_INT);
        $stmt6->execute();


        // Fetch the results
        $result6 = $stmt6->fetchAll(PDO::FETCH_ASSOC);




          


            $Globale_result['confirmer'] =  $result;

            $Globale_result['non_confirmer'] =  $result2 ;

            $Globale_result['totale'] =  $result3 ;

            $Globale_result['annuler'] =  $result4 ;

            $Globale_result['paye'] =  $result5;
            $Globale_result['impaye'] =  $result6;


            echo json_encode( $Globale_result );



?>