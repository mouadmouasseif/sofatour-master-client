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

$sql ="";
if($idClient != '')
{
    $sql = "SELECT client_devis_client.Numero_devis ,  devis_paiements.id_devis_paiements , devis_paiements.statut , devis_paiements.Montant ,  devis_mode_paiements.libeller AS mode_paiement, devis_paiements.created
    FROM devis_paiements
    JOIN devis_mode_paiements ON devis_paiements.devis_mode_paiements = devis_mode_paiements.id_devis_mode_paiements
    JOIN client_devis_client ON devis_paiements.client_devis_client = client_devis_client.id_client
    WHERE client_devis_client.id_client = :id_client;";
    
} else {
    $sql = "SELECT  devis_paiements.id_devis_paiements  ,  client_devis_client.Numero_devis , devis_paiements.statut , devis_paiements.Montant ,  devis_mode_paiements.libeller AS mode_paiement , document.file_path , devis_paiements.created , commentaire
    FROM devis_paiements 
    JOIN devis_mode_paiements ON devis_paiements.devis_mode_paiements = devis_mode_paiements.id_devis_mode_paiements
    JOIN  client_devis_client ON client_devis_client.id_client_devis = devis_paiements.client_devis_client
    JOIN  document ON document.document_id = devis_paiements.document ORDER  BY created DESC";
}

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_client', $idClient, PDO::PARAM_STR);
    $stmt = $conn->prepare($sql);
    $stmt->execute();
// Prepare and execute the statement
try {
 
    

    // Fetch the results
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Output the results in an HTML table
    echo '<thead>
            <tr>
                <th>Numero Devis</th>
                <th>Statut</th>
                <th>Montant</th>
                <th>Methode Paiement</th>
                <th>lien du document</th>
                <th>Date de paiement</th>
                <th>Commentaire</th>
                <th>Opération</th>
            </tr>    
           </thead>';
    
    foreach ($result as $row) {
        echo '<tr';
        // Check if the status is 'Payé' and add a CSS class accordingly
        // if ($row['statut'] == 'Payé') {
        //     echo ' style="  background-color: #14f32587; "';
        // }
        // else if ($row['statut'] == 'En attente') {
        //     echo ' style="background-color: #ebdb1554;"';
        // }
        echo '>';
        $paiementId = '';
        $statut = '';
        foreach ($row as $key => $value) {
            if($key === 'id_devis_paiements')
            {
                $paiementId = $value;
               // echo '<td>' . $value . '</td>';
            }
            if ($key === 'Numero_devis') {
                $numero_devis = $value;
                echo '<td>' . $value . '</td>';
            } 
            if ($key === 'statut') {
                $statut = $value;
                if( $value == 'Payé')
                echo '<td><span style="    background-color: #5cb85c;
                padding: 5px;
                border-radius: 10px;
                color: white;
                font-weight: 700;">' . $value . '</span></td>';
                else if( $value == 'En attente')
                {
                    echo '<td><span style="    background-color: #000000;
                    padding: 5px;
                    border-radius: 10px;
                    color: white;
                    font-weight: 700;">' . $value . '</span></td>';
                }
                else
                {
                    echo '<td><span style="background-color: #ff2a2a;
                    padding: 5px;
                    border-radius: 10px;
                    color: white;
                    font-weight: 700;">' . $value . '</span></td>';
                }
                
            } 
            if ($key === 'Montant') {
                echo '<td>' . $value . '</td>';
            } 
            if ($key === 'mode_paiement') {
                echo '<td>' . $value . '</td>';
            }
            if ($key === 'file_path') {
                echo '<td><a href="#" id="' . $value . '" onclick="afficher_doc(this)">lien...</a></td>';
            }
            if ($key === 'created') {
                echo '<td>' . $value . '</td>';
            }
            if ($key === 'commentaire') {
                echo '<td>' . $value . '</td>';
            }
         
        }
        // echo '<td><a href = "#"  style="color: white; background:green;"><button class="btn btn-info waves-effect" id = "'.$Numero_Facture.'"  ></button></a> </td>';
        if($statut == 'Payé')
        echo '<td> 
            <button class="btn btn-success waves-effect" disabled ><i class="notika-icon notika-dollar"></i></button>
        </td>';
        else {
            echo '<td> 
                <button class="btn btn-success waves-effect" id = "'.$paiementId . '"  data-toggle="tooltip" data-placement="left" onclick="open_paiements(this)"  title="valider" ><i class="notika-icon notika-dollar"></i></button>
            </td>';
        }

        echo '</tr>';
    }



} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

// Close the connection
$pdo = null;

?>
