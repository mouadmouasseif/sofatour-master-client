<?php
if (!isset($_SESSION['id_user'])) {
    include("../Front-end/se_connecter/se_connecter.php");
    exit();
}

include 'connection_database.php';

try {
    $sql = "
    SELECT 
        p.designation AS Designation,
        p.prestation AS Prestation,
        t.ligne_devis_type_prestation AS Type,
        s.societe_name AS Societe,
        p.id_ligne_devis_prestation AS ID
    FROM ligne_devis_prestation p
    LEFT JOIN client_ligne_devis_type_prestation t 
        ON p.client_ligne_devis_type_prestation = t.id_client_ligne_devis_type_prestation
    LEFT JOIN societe_prestations sp 
        ON p.id_ligne_devis_prestation = sp.id_prestation
    LEFT JOIN societes s 
        ON sp.id_societe = s.id_societe
    ORDER BY p.designation ASC;
    ";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo '<thead>
            <tr>
                <th>Designation</th>
                <th>Prestation</th>
                <th>Type</th>
                <th>Société</th>
                <th>Opérations</th>
            </tr>
          </thead>';
    
    foreach ($result as $row) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($row['Designation']) . '</td>';
        echo '<td>' . htmlspecialchars($row['Prestation']) . '</td>';
        echo '<td>' . htmlspecialchars($row['Type']) . '</td>';
        echo '<td>' . htmlspecialchars($row['Societe']) . '</td>';
        echo '<td>
                 <button onclick="editPrestation(' . $row['ID'] . ')" class="btn btn-warning">Éditer</button>
              </td>';
        echo '</tr>';
    }
    

} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

$conn = null;
?>

<script>

function editPrestation(id) {
    window.location.href = 'edit_prestation.php?id=' + id;
}
</script>
