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
$devis_annuler = isset($_GET['devis_annuler']) ? $_GET['devis_annuler'] : '';


$page_name = isset($_GET['page_name']) ? $_GET['page_name'] : '';

if($idClient != '')
{
  
    $sql = "SELECT cdc.Numero_devis , cdc.societe , cdc.nom_complet  , cdc.prix_total_ttc , cdc.date_d_entree, cdc.du_date, cdc.a_tel_date , cdc.version_devis , cdc.id_client_devis , cdc.objet , cdc.confirmer  ,cdc.id_client ,  count_fact ,  cdc.annuler

    FROM 
        (SELECT Numero_devis, prix_total_ttc , cd.date_d_entree, objet ,du_date, a_tel_date , version_devis , cdc.id_client , cdc.utilisateurs , confirmer , societe , nom_complet , cdc.id_client_devis , count_fact , cdc.annuler FROM client_devis_client cdc JOIN client_devis cd ON cdc.id_client_devis = cd.id_client_devis JOIN clients cs ON cs.id_client = cdc.id_client left join (SELECT COUNT(*) as count_fact , id_client_devis FROM client_facture_client GROUP BY id_client_devis) f_count on f_count.id_client_devis = cdc.id_client_devis ) cdc , 
      
       
        (SELECT Numero_devis , MAX(version_devis) devis_max , id_client , id_client_devis , utilisateurs FROM client_devis_client GROUP BY Numero_devis) max_verson 
        
        WHERE max_verson.Numero_devis = cdc.Numero_devis AND cdc.id_client = max_verson.id_client AND version_devis = devis_max  AND cdc.id_client = :id_client 
        ORDER BY cdc.Numero_devis DESC;";
              $stmt = $conn->prepare($sql);
              $stmt->bindParam(':id_client', $idClient, PDO::PARAM_STR);
}
else
{
    // if($_SESSION['profil'] == 'Administrateur system' )
    // {
    // SQL query
    $sql = "SELECT cdc.Numero_devis , cdc.societe , cdc.nom_complet  , cdc.prix_total_ttc , cdc.date_d_entree, cdc.du_date, cdc.a_tel_date , cdc.version_devis , cdc.id_client_devis , cdc.objet , cdc.confirmer  ,cdc.id_client ,  count_fact ,  cdc.annuler

    FROM 
        (SELECT Numero_devis, prix_total_ttc , cd.date_d_entree, objet ,du_date, a_tel_date , version_devis , cdc.id_client , cdc.utilisateurs , confirmer , societe , nom_complet , cdc.id_client_devis , count_fact  ,  cdc.annuler FROM client_devis_client cdc JOIN client_devis cd ON cdc.id_client_devis = cd.id_client_devis JOIN clients cs ON cs.id_client = cdc.id_client left join (SELECT COUNT(*) as count_fact , id_client_devis FROM client_facture_client GROUP BY id_client_devis) f_count on f_count.id_client_devis = cdc.id_client_devis ) cdc , 
      
       
        (SELECT Numero_devis , MAX(version_devis) devis_max , id_client , id_client_devis , utilisateurs FROM client_devis_client GROUP BY Numero_devis) max_verson 
        
        WHERE max_verson.Numero_devis = cdc.Numero_devis AND cdc.id_client = max_verson.id_client AND version_devis = devis_max ". ($devis_annuler == "true" ? "  AND cdc.annuler = 1 AND  cdc.confirmer = 0 " : " ") .
        "ORDER BY cdc.Numero_devis DESC;";
            $stmt = $conn->prepare($sql);

         
    // }
    // else {
    //     $sql = "SELECT cdc.Numero_devis , cdc.societe , cdc.nom_complet  , cdc.prix_total_ttc , cdc.date_d_entree, cdc.du_date, cdc.a_tel_date , cdc.version_devis , id_client_devis ,  cdc.objet , cdc.confirmer ,cdc.id_client    FROM 
    //     (SELECT Numero_devis, prix_total_ttc , cd.date_d_entree, du_date, a_tel_date , objet ,  version_devis , cdc.id_client , cdc.utilisateurs ,confirmer   , societe , nom_complet FROM client_devis_client cdc JOIN client_devis cd ON cdc.id_client_devis = cd.id_client_devis JOIN clients cs ON cs.id_client = cdc.id_client )  cdc , 
    //     (SELECT Numero_devis , MAX(version_devis) devis_max , id_client , id_client_devis , utilisateurs FROM client_devis_client GROUP BY Numero_devis) max_verson 
    //     WHERE max_verson.Numero_devis = cdc.Numero_devis AND cdc.id_client = max_verson.id_client AND version_devis = devis_max AND cdc.utilisateurs = :id_user
    //     ORDER BY cdc.date_d_entree DESC;";
    //         $stmt = $conn->prepare($sql);
    //         $stmt->bindParam(':id_user', $_SESSION['id_user'], PDO::PARAM_STR);
    // }

}

// Prepare and execute the statement
try {
 
    $stmt->execute();

    // Fetch the results
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Output the results in an HTML table
    echo '<thead>
            <tr>
                <th>Numero Devis</th>
                <th>Société</th>
                <th>Prix Total TTC</th>
                <th>Date d\'Entree</th>
                <th>Du Date</th>
                <th>A Tel Date</th>
                <th>Version Devis</th>
                <th>Objet</th>
                <th>Opération</th>
            </tr>    
           </thead>';
            

    foreach ($result as $row) {
        echo '<tr>';
        $version = '';
        $Numero_devis = '';
        foreach ($row as $key => $value) {
            if($key !== 'id_client_devis' && $key !== 'confirmer' &&  $key !== 'id_client' &&  $key !== 'societe'  &&  $key !== 'nom_complet'  && $key !== 'count_fact'   && $key !== 'annuler')
            {
                if($key === 'prix_total_ttc')
                echo '<td>' . number_format((double)$value, 2, '.', '')  . ' DH</td>';
                else
                echo '<td>' . $value . '</td>';
            }

            if($key === 'id_client_devis')
            {
                $id_client_devis = $value;
            }
            if ($key === 'version_devis') {
                $version = $value;
            }
            if ($key === 'Numero_devis') {
                $Numero_devis = $value;
            }
            if ($key === 'confirmer') {
                $confirmer = $value;
            }
            if ($key === 'id_client') {
                $idClient_value = $value;
            }
            if ($key === 'societe') {
                $societe_value = $value;

                if($societe_value != null)
                echo '<td>' . $value . '</td>';
            }
            if ($key === 'nom_complet') {
                $nom_complet_value = $value;

                if($nom_complet_value != null &&  $societe_value == null)
                echo '<td>' . $value . '</td>';
            }
            if ($key === 'prix_total_ttc') {
                $prix_total_ttc = $value;
            }
            if ($key === 'count_fact') {
                $Facture_exist = $value;
            }
            if ($key === 'annuler') {
                $annuler = $value;
            }
        }
        if($page_name != 'tous_les_devis')
        {
            if($De_Fa == 'Devis')
            {
                if( $Facture_exist == null)
                {
                   echo '<td>
                   <table style="text-align:right;"><tr>';
                   if( $confirmer == true)
                   echo '<td><span class="confirmer"> Confirmé </span></td>';
                
                   echo '<td>
                   <a href = "../Ressources/index.php?page_name=devis_creation&page=Devis_client_id&id_client='.$idClient_value.'&societe='.($societe_value != null ? $societe_value : $nom_complet_value).'&De_Fa=Devis&numero_devis='.$Numero_devis.'&version='.$version.'" style="color: white;"><button class="btn btn-info waves-effect" >+ version</button></a>
                   </td>
                   <td>
                   <a  target="_blank" href = "../Ressources/Document.php?prix_ttc='.$prix_total_ttc.'&id_client='.$idClient_value.'&societe='.($societe_value != null ? $societe_value : $nom_complet_value).'&De_Fa=Devis&numero_devis='.$Numero_devis.'&version='.$version.'"  style="color: white; background:green;">
									<button style="background: #0035d3;" data-toggle="tooltip" data-placement="left" title="Aperçu/Telecharger" class="btn"><i class="notika-icon notika-sent"></i></button>
								</a>
                   <td>
                   </td>
                   </tr></table></td>';
                }
                else
                {
                    echo '<td>
                    <table style="text-align:right;"><tr>';

                    if( $confirmer == true)
                    echo '<td><span class="confirmer"> Confirmé </span></td>';

                    echo '
                    <td>
                    <a  target="_blank"   href = "../Ressources/Document.php?prix_ttc='.$prix_total_ttc.'&id_client='.$idClient_value.'&societe='.($societe_value != null ? $societe_value : $nom_complet_value).'&De_Fa=Devis&numero_devis='.$Numero_devis.'&version='.$version.'"  style="color: white; background:green;">	
                    <button style="background: #0035d3;" data-toggle="tooltip" data-placement="left" title="Aperçu/Telecharger" class="btn"><i class="notika-icon notika-sent"></i></button>
                     </a>
                     <td>
                        <a  target="_blank"   href = "../Ressources/Document.php?prix_ttc='.$prix_total_ttc.'&id_client='.$idClient_value.'&societe='.($societe_value != null ? $societe_value : $nom_complet_value).'&De_Fa=Devis&numero_devis='.$Numero_devis.'&version='.$version.'&Proformat=true"  style="color: white; background:green;">	
                        <button style="background: #c72ff7;" data-toggle="tooltip" data-placement="left" title="Aperçu/Telecharger Facture PROFORMA" class="btn"><i class="notika-icon notika-sent"></i></button>
                        </a>
                        </td>
                     </td>
                     </tr></table></td>';
                }
            }
            else if($De_Fa == 'Facture' && $confirmer == true)
            {
                echo '<td>
                <table style="text-align:right;"><tr>';
                if( $Facture_exist == null)
                {
                echo '<td>
                <a href = "../Ressources/index.php?page_name=devis_creation&page=Devis_client_id&id_client='.$idClient_value.'&societe='.($societe_value != null ? $societe_value : $nom_complet_value).'&De_Fa=Facture&numero_devis='.$Numero_devis.'&version='.$version.'&id_client_devis='.$id_client_devis.'" style="color: white;"><button class="btn btn-info waves-effect" > + Facture</button></a>
                </td>';
                }
                echo '<td>
                <a  target="_blank"   href = "../Ressources/Document.php?prix_ttc='.$prix_total_ttc.'&id_client='.$idClient_value.'&societe='.($societe_value != null ? $societe_value : $nom_complet_value).'&De_Fa=Devis&numero_devis='.$Numero_devis.'&version='.$version.'"  style="color: white; background:green;">	
                <button style="background: #0035d3;" data-toggle="tooltip" data-placement="left" title="Aperçu/Telecharger" class="btn"><i class="notika-icon notika-sent"></i></button>
                 </a>
                </td>
               
                </tr></table></td>';
            }
            else
            {
                echo '<td>
                <table style="text-align:right;"><tr><td>
                <span class="confirmer" style ="background:red;"> Non confirmé.</span>
                </td>
                <td>
                <a  target="_blank"   href = "../Ressources/Document.php?prix_ttc='.$prix_total_ttc.'&id_client='.$idClient_value.'&societe='.($societe_value != null ? $societe_value : $nom_complet_value).'&De_Fa=Devis&numero_devis='.$Numero_devis.'&version='.$version.'"  style="color: white; background:green;">	
                <button style="background: #0035d3;" data-toggle="tooltip" data-placement="left" title="Aperçu/Telecharger" class="btn"><i class="notika-icon notika-sent"></i></button>
                 </a>
                </td>
                </tr></table></td>';
            }
        }
        else
        {
            if($De_Fa == 'Devis')
            {
                if( $confirmer ==  false )
                {
                    echo '<td><table style="text-align:right;"><tr>';
                    if( $annuler ==  false )
                echo '<td>
                        <a href = "#"  style="color: white; background:green;"><button class="btn btn-info waves-effect" id = "'.$Numero_devis.'" onclick="confirmer_devis(this);" >Confirmer</button></a> </td>';
           
                        if( $annuler ==  true )
                    echo '<td> <span class="annuler"> Annuler </span>  </td>';
                else 
                echo '<td><a href = "#"  style="color: white; background:green;"><button class="btn btn-danger waves-effect" id = "'.$Numero_devis.'" onclick="annuler_devis(this);" >Annuler</button></a> </td>';

           
                    echo '<td> <a  target="_blank" href = "../Ressources/Document.php?prix_ttc='.$prix_total_ttc.'&id_client='.$idClient_value.'&societe='.($societe_value != null ? $societe_value : $nom_complet_value).'&De_Fa=Devis&numero_devis='.$Numero_devis.'&version='.$version.'"  style="color: white; background:green;">
									<button style="background: #0035d3;" data-toggle="tooltip" data-placement="left" title="Aperçu/Telecharger" class="btn"><i class="notika-icon notika-sent"></i></button>
								</a></td>
            </tr></table></td>';
                }
                else
                {
                    echo '<td><table style="text-align:right;"><tr>';
                    
                    echo '<td> 	
                        <button class="btn btn-success waves-effect" id = "'.$Numero_devis . ';' . $version .';'.$id_client_devis.'"  data-toggle="tooltip" data-placement="left" onclick="open_paiements(this)"  title="paiements" ><i class="notika-icon notika-dollar"></i></button>   
                      </td>';


                    echo '<td><span class="confirmer"> Confirmé </span>  </td>
                    <td> <a  target="_blank"   href = "../Ressources/Document.php?prix_ttc='.$prix_total_ttc.'&id_client='.$idClient_value.'&societe='.($societe_value != null ? $societe_value : $nom_complet_value).'&De_Fa=Devis&numero_devis='.$Numero_devis.'&version='.$version.'"  style="color: white; background:green;">	
                    <button style="background: #0035d3;" data-toggle="tooltip" data-placement="left" title="Aperçu/Telecharger" class="btn"><i class="notika-icon notika-sent"></i></button>
               </a></td>
               <td>
                <a  target="_blank"   href = "../Ressources/Document.php?prix_ttc='.$prix_total_ttc.'&id_client='.$idClient_value.'&societe='.($societe_value != null ? $societe_value : $nom_complet_value).'&De_Fa=Devis&numero_devis='.$Numero_devis.'&version='.$version.'&Proformat=true"  style="color: white; background:green;">	
                   <button style="background: #c72ff7;" data-toggle="tooltip" data-placement="left" title="Aperçu/Telecharger Facture PROFORMA" class="btn"><i class="notika-icon notika-sent"></i></button>
                 </a>
                </td>
               </tr></table></td>';
                }
            }
        }
        echo '</tr>';
    }



} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

// Close the connection
$pdo = null;

?>
