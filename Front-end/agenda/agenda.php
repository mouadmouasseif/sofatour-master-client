<div class="spinner spiinneeeer">
  <div class="rect1"></div>
  <div class="rect2"></div>
  <div class="rect3"></div>
  <div class="rect4"></div>
  <div class="rect5"></div>
</div>
 <div class="container" style="    background: white; padding: 15px;">
      <?php 
       
   //  if($_SESSION['profil'] == 'Administrateur system' )
   //  {
   //     $result = '<h1 style="font-size: medium; font-weight: 500;">Chiffre d\'affaire global (test): <span  style="font-size: large; font-weight: 700;   color: white;  background: #1c1f42;padding: 3px;">';

   //     include '../Controllers/connection_database.php';

   //      $sql = "SELECT  SUM(cdc.prix_total_ttc) as somme FROM 
   //      (SELECT Numero_devis, prix_total_ttc , date_d_entree, objet ,du_date, a_tel_date , version_devis , id_client , utilisateurs FROM client_devis_client cdc JOIN client_devis cd ON cdc.id_client_devis = cd.id_client_devis) cdc , 
   //      (SELECT Numero_devis , MAX(version_devis) devis_max , id_client , id_client_devis , utilisateurs FROM client_devis_client GROUP BY Numero_devis) max_verson 
   //      WHERE max_verson.Numero_devis = cdc.Numero_devis AND cdc.id_client = max_verson.id_client AND version_devis = devis_max;";
   //              $stmt = $conn->prepare($sql);
   //              $stmt->execute();

   //              // Fetch the results
   //              while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
   //                  $formattedAmount = number_format($row['somme'], 2, '.', ' ');
   //                  $result .= $formattedAmount . ' DH';
   //                 }
               
   
   //      $result .= '</span></h1>';
   //      echo  $result;
   //  }
      ?>

        <!-- Ajout du filtre par société -->
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
    <?php 
    include '../Controllers/connection_database.php';

    // Récupération de l'id_profile (assurez-vous que cette variable est bien définie dans votre contexte)


    if ($_SESSION['profil'] == 'Administrateur system') {
    ?>
        <label for="societe_filter" style="font-weight: bold;">Filtrer par société :</label>
        <select class="dropdown_custom" id="societe_filter" style="width: 200px; height: 30px; font-size: medium;" name="societe_filter" onchange="updateAgendaBySociete()">
            <option value="0">Toutes les sociétés</option>
            <?php
            $query = "SELECT id_societe, societe_name FROM societes";
            $stmt = $conn->query($query);
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<option value="' . $row['id_societe'] . '">' . $row['societe_name'] . '</option>';
            }
            ?>
        </select>
    <?php 
    } 
    ?>
</div>

        </div>
      </div>
      <h1 style="font-size: medium; font-weight: 500;">Detail Événements : <span id="detail_event" style="    /* font-size: large; */
    font-weight: 700;
    /* color: white; */
    /* background: #1c1f42; */
    padding: 3px;"></span></h1> 
         
      <div class="row">
      <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
         <div id='calendar'>
         </div>
      </div>
      <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
      <br/>
      <br/> <br/>
         <h1 class="titre_agenda">Liste agenda Devis</h1>
         

            <p><div class="Devis_c" style="background: #00a56e;" id="active_001" onclick="supp_affi(this)"></div> <div class="titre_Devis">  Confirmé </div></p>
            <p><div class="Devis_c" style="background: #f4ff50;" id="active_002" onclick="supp_affi(this)"></div> <div class="titre_Devis" >  Non Confirmé </div></p>
            <p><div class="Devis_c" style="background: #f3b600;" id="active_003" onclick="supp_affi(this)"></div> <div class="titre_Devis" >  Non Confirmé -7j  </div></p>
            <p><div class="Devis_c" style="background: #ff5050;" id="active_004" onclick="supp_affi(this)"></div> <div class="titre_Devis" >  Annuler </div></p>

            

      </div>
            
      </div>
 </div>

 <div class="modal fade" id="myModalone" role="dialog"  >
                                    <div class="modal-dialog modals-default">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <h2>Société : <span id="title_event_00"> </span></h2>
                                                <p><span id="du_event_00" class="date_agenda01"> </span> <span style="font-weight: 900; font-size: larger;" > >> </span><span id="a_tel_event_00"  class="date_agenda02"></span></p>
                                                <p>Detail Événements : <span id="det_event_00" class="date_agenda01"> </span></p>
                                                <p>créé par : <span id="creer_par_event_00" style="    font-weight: 700;"> </span>  </p>

                                                <p>Url source : <span id="url_ev_001" class="date_agenda01">
                                                </span></p>
                                                
                                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group ic-cmp-int">
                                            <div class="form-ic-cmp">
                                                <i class="notika-icon notika-edit"></i>
                                            </div>
                                            <div class="nk-int-st">
                                            <select class="dropdown_custom"  name="anuulation" id='anuulation_01' onchange="changeValueOfAnnulation(this)" >
                                                <option value="0">*Choisissez l'annulation raison ...</option>
                                                <?php  
                                                   include '../Controllers/connection_database.php';
                                                   $query = "SELECT id_annulation_cause  , libeller  FROM annulation_cause";
                                                   $stmt = $conn->query($query);
                                                   while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                    echo '<option value="' . $row['id_annulation_cause'] . '">' . $row['libeller'] . '</option>';
                                                   }
                                                ?>
                                                 
                                            </select>              
                                                                         
                                                <!-- <input type="textarea" class="form-control" name="Nom_societe" placeholder="*Prestation" > -->
                                            </div>
                                        </div>
                                    </div>
                                   </div>
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="form-group ic-cmp-int">
                                                                    <div class="form-ic-cmp">
                                                                        <i class="notika-icon notika-edit"></i>
                                                                    </div>
                                                                    <div class="nk-int-st">
                                                                    <textarea class="form-control" name="anuulation_libeller"  id='anuulation_libeller_01' placeholder="*Prestation" rows="7" >
                                                                    </textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                         

                                            </div>
                                            <div class="modal-footer">
                                            <button class="btn btn-info waves-effect confirmer_b" id = "" onclick="confirmer_devis(this);" >Confirmer</button> </td>
                                            <button class="btn btn-danger waves-effect annuler_b" id = "" onclick="annuler_devis(this);" >Annuler</button> </td>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                  


 <script src="../Front-end/agenda/agenda.js"></script>



                    
