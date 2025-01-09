<?php 
require_once '../connection_database.php';

$output = array('data' => array());

try {
    $sql = "
        SELECT 
            p.id_ligne_devis_prestation AS prestation_id,
            p.designation,
            p.prestation,
            t.ligne_devis_type_prestation AS type,
            s.societe_name AS societe
        FROM ligne_devis_prestation p
        LEFT JOIN client_ligne_devis_type_prestation t 
            ON p.client_ligne_devis_type_prestation = t.id_client_ligne_devis_type_prestation
        LEFT JOIN societe_prestations sp 
            ON p.id_ligne_devis_prestation = sp.id_prestation
        LEFT JOIN societes s 
            ON sp.id_societe = s.id_societe
    ";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($result) > 0) { 
        foreach ($result as $row) {
            $prestationId = $row['prestation_id'];

            $button = '
            <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Action <span class="caret"></span>
                </button>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a type="button" data-toggle="modal" id="editPrestationModalBtn" data-target="#editPrestationModal" onclick="editPrestation(' . $prestationId . ')">
                        <i class="glyphicon glyphicon-edit"></i> Modifier</a></li>
                    <li><a type="button" data-toggle="modal" data-target="#removePrestationModal" id="removePrestationModalBtn" onclick="removePrestation(' . $prestationId . ')">
                        <i class="glyphicon glyphicon-trash"></i> Supprimer</a></li>
                </ul>
            </div>';

            $output['data'][] = array(
                $row['designation'],
                $row['prestation'], 
                $row['type'],       
                $row['societe'],     
                $button              
            );
        } 
    } 

    
    echo json_encode($output);

} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
