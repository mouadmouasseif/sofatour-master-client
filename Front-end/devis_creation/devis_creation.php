
<!-- Breadcomb area Start-->
<div class="breadcomb-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="breadcomb-list">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="breadcomb-wp">
									<div class="breadcomb-icon">
                                       <i class="notika-icon notika-form"></i>
									</div>
									<div class="breadcomb-ctn">
										<h2><?php echo isset($_GET['De_Fa']) ? $_GET['De_Fa'] : '';  ?> </h2> 
										<p> Client : <span class="bread-ntd" style="font-weight: 700;"> <?php echo isset($_GET['societe']) ? $_GET['societe'] : 
                                        'Aucun...';  ?></span></p>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
								<div class="breadcomb-report">
									<!-- <button data-toggle="tooltip" data-placement="left" title="Download Report" class="btn"><i class="notika-icon notika-sent"></i></button> -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

    <div class="container">
<div class="row">
    <div class="col-lg-12" style="height: 36px;">
        <div class="card">
            <div class="body">
                <div class="cd-horizontal-timeline loaded">
                    <div class="timeline">
                        <div class="events-wrapper" style="margin-top: -69px;">
                            <div class="events" style="width: 1800px;">
                                <ol>
                                    <li><a href="#0" id="choix_client" class="" style="left: 120px;">Choix Client</a></li>
                                    <li><a href="#0"  id="choix_devis"  style="left: 300px;" class="">Choix Devis</a></li>
                                    <?php
                                        if (isset($_GET['De_Fa']) && $_GET['De_Fa'] === 'Facture' && !empty($_GET['numero_facture'])) {
                                            echo '<li><a href="#0" id="creer_facture_devis" style="left: 480px;" class="">Modifier Facture</a></li>';
                                        } else {
                                            $de_fa = isset($_GET['De_Fa']) ? $_GET['De_Fa'] : ''; 
                                            echo '<li><a href="#0" id="creer_facture_devis" style="left: 480px;" class="">Créer ' . $de_fa . '</a></li>';
                                        }
                                    ?>
                                    <!-- <li><a href="#0" id="creer_facture_devis"   style="left: 480px;" class=""> Créer <?php //echo isset($_GET['De_Fa']) ? $_GET['De_Fa'] : '';  ?></a></li> -->
                                </ol>
                                <span class="filling-line" aria-hidden="true" style="transform: scaleX(0.281506);"></span>
                            </div>
                            <!-- .events -->
                        </div>
                        <!-- .events-wrapper -->
                        <ul class="cd-timeline-navigation">
                            <!-- <li><a href="#0" class="prev inactive">Prev</a></li>
                            <li><a href="#0" class="next">Next</a></li> -->
                        </ul>
                        <!-- .cd-timeline-navigation -->
                    </div>
                    <!-- .timeline -->
                  
                </div>
            </div>
        </div>
    </div>
</div>
</div>
	<!-- Breadcomb area End-->
        <div class="container" id="etape_1" style="text-align: center; display:none;">
                  <span class="bread-ntd" style="font-weight: 700;"> <?php echo isset($_GET['societe']) ? $_GET['societe'] : 
                        '<button type="button" class="btn btn-info" data-toggle="modal" style="background:#000000;" data-target="#client_choix">Choisissez d\'abord un client.</button> ';  ?></span></p>
        </div>

        <div class="container" id="etape_2" style="text-align: center; display:none;">

             
                <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="data-table-list">
                                <div class="basic-tb-hd">
                                    <h2>Choisissez le devis</h2>
                                    <p>
                                    <?php echo $_GET['De_Fa'] == 'Devis' ? 'Soit vous choisissez un devis pour créer une nouvelle version, soit un nouveau Devis <button type="button" id="Nouveau_devis_sans_choix" class="btn btn-info" data-toggle="modal" style="background:#000000;"  >Nouveau</button>' :'choisissez-vous un devis pour créer une nouvelle Facture '; ?>
                                </p>
                                </div>
                                <div class="table-responsive ">
                                    <table id="data-table-basic" class="table table-striped data_table_custom">
                                    <?php isset($_GET['id_client']) ? include '../Controllers/list_devis.php' : ''; ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                </div>
   
                
        </div>



        <div class="container" id="etape_3" style="padding: 13px;background: white; box-shadow: 0 2px 5px rgba(0,0,0,.16), 0 2px 10px rgba(0,0,0,.12); display:none;"  >
            <div class="breadcomb-report">

                <button data-toggle="tooltip" id="edit_open" onclick="edit_entete()" data-placement="left" title="edit en-tere" class="btn"><i class="notika-icon notika-edit"></i></button> 
                <button data-toggle="tooltip" id="edit_close" style="display:none; background:red;"  onclick="terminer_edit_entete()" data-placement="left" title="terminer edit en-tere" class="btn"><i class="notika-icon notika-close"></i></button> 

                <button id="etape_3_quit" class="btn notika-btn-deeppurple btn-reco-mg btn-button-mg"  style="color:white !important; float: left; background: #ff1d3a; display:none;" onclick="Quitter_etape_3()">Quitter</button>

                <?php echo !isset($_GET['id_client_devis']) ? isset($_GET['version'])  ? '<p style="color:#a3a2a2; font-size: 13px;"> version :  '.$_GET['version'] + 1 .'</p>'  :  '<p style="color:#a3a2a2; font-size: 13px;"> version : 1 </p>' : ''; ?>
            </div>
            <div id="journee_du" style="width: 164px; position: absolute; display:none;" >
           
                    
                              <div class="form-group nk-datapk-ctm form-elet-mg" id="data_1">
                                    <label>Du  </label>
                                    <div class="input-group date nk-int-st">
                                        <span class="input-group-addon"></span>
                                        <input type="text" class="form-control" id="Du" name ="du_date" onchange={devis_change(this)} >
                                    </div>
                                </div>
                                <div class="form-group nk-datapk-ctm form-elet-mg" id="data_1">
                                    <label>au </label>
                                    <div class="input-group date nk-int-st">
                                        <span class="input-group-addon"></span>
                                        <input type="text" class="form-control" id="au" name ="a_tel_date" onchange={devis_change(this)} >
                                    </div>
                                </div>
                                <br/>

                                           <div class="form-group ic-cmp-int" id="Porcentage_model" style="z-index:1; left: -9px; top: -13px;">
                                                <div class="form-ic-cmp">
                                                <i class="notika-icon notika-dollar"></i>

                                                </div>
                                                <div class="nk-int-st">
                                                    <input type="text" class="form-control" name="TVA"  onchange={devis_change(this)} placeholder="tva...">
                                                </div>
                                            </div>
                            
                             
                 
             </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 justfy_centre">
                    <img src="
                    <?php 
                         if(isset($_GET['id_client']))
                         {
                            include '../Controllers/connection_database.php';
                            $quer2y = "SELECT s.id_societe, s.all_name, s.path_image FROM societes s JOIN clients c ON s.id_societe = c.id_societe WHERE c.id_client =".$_GET['id_client'];
                            $societe_id;
                            $societe_name;
                            $stmt2 = $conn->query($quer2y);
                            while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                            echo  $row2['path_image'];
                            $societe_id = $row2['id_societe'];
                            $societe_name =  $row2['all_name'];
                            }
                        }                    
                    ?>
                    " style="width: 12%;"/>
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 justfy_centre">
            
                    <div class="le_devis">
                        <div id="value_date_de_devis">
                        LE ____________
                            </div>
                            <div id="input_date_de_devis" style="display:none;">
                                <div class="nk-int-st">
                                    <!-- <input type="text" class="form-control" name="input_date_de_devis" onchange={devis_change(this)} placeholder="*Numero <?php echo isset($_GET['De_Fa']) ? $_GET['De_Fa'] : '';  ?>"> -->
                                    <div class="input-group date nk-int-st">
                                        <span class="input-group-addon"></span>
                                        <!-- <input type="text" class="form-control" name ="input_date_de_devis" placeholder="le..." onchange={devis_change(this)} > -->
                                        <div class="form-group nk-datapk-ctm form-elet-mg" id="data_1">
                                            <div class="input-group date nk-int-st">
                                                <span class="input-group-addon"></span>
                                                <input type="date" class="form-control" id="input_date_de_devis_01" name ="input_date_de_devis" onchange={devis_change(this)} >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <!-- LE <?php //$dateTimeObject = new DateTime(); $currentDateTimeObject = $dateTimeObject->format("d/m/Y"); echo $currentDateTimeObject; ?>  -->
                    </div>
            </div>
          
          
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 justfy_centre">
                    <div class="le_devis" id="value_numero_devis_div">
                    <div id="value_numero_devis">
                   <?php  echo $_GET['De_Fa'] . ' Nº: ' .'Après l\'enregistrement...'; ?>
                        </div>
                        <!-- <div id="input_numero_devis" style="display:none;">
                            <div class="nk-int-st">
                                <input type="text" class="form-control" name="Numero_devis" onchange={devis_change(this)} placeholder="*Numero <?php echo isset($_GET['De_Fa']) ? $_GET['De_Fa'] : '';  ?>">
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-lg-=5 col-md-5 col-sm-5 col-xs-5 ">
                <div class="head_devis" >
                        <div id="a_devis_value">
                        A : <?php echo isset($_GET['societe']) ? $_GET['societe'] : '___________';  ?> <!--  HERE -->
                        </div>
                        <div id="a_devis_input" style="display:none;">
                            <div class="nk-int-st">
                            A : <input type="text" class="form-control" name="a_devis" value="<?php echo isset($_GET['societe']) ? $_GET['societe'] : '';  ?>" onchange={devis_change(this)} placeholder="*Societe">
                            </div>
                        </div>
                    
                    <div id="objet_value">
                        Objet : ____________
                            </div>
                            <div id="objet_input" style="display:none;">
                                <div class="nk-int-st">
                                Objet : 
                                <div class="form-group ic-cmp-int">
                                            <div class="form-ic-cmp">
                                                <i class="notika-icon notika-edit"></i>
                                            </div>
                                            <div class="nk-int-st">
                                            <select class="dropdown_custom" name="objet" onchange={devis_change(this)} >
                                                <option value="0">*Choisissez Objet...</option>
                                                <?php  
                                                   include '../Controllers/connection_database.php';
                                                   $query = "SELECT id_devis_objet , nom_objet FROM devis_objet";
                                                   $stmt = $conn->query($query);
                                                   while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                    echo '<option value="' . $row['id_devis_objet'] .'---'. $row['nom_objet'] . '">' . $row['nom_objet'] . '</option>';
                                                   }
                                                ?>
                                                 
                                            </select>              
                                                <!-- <input type="textarea" class="form-control" name="Nom_societe" placeholder="*Prestation" > -->
                                            </div>
                                        </div>                                
                                <!-- <input type="text" class="form-control" name="objet" onchange={devis_change(this)} placeholder="*Objet"> -->
                                </div>
                            </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 ">
                </div>
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 ">
                    <div class="head_devis" id="head_devis_right" style="text-align: right;">
                    Votre contrat au <?php echo $societe_name; ?>
                    <br>
                    M. <span style="font-weight: 700;"><?php  echo $_SESSION['nom'] . ' ' .  $_SESSION['prenom']; ?></span>  Tel : <span style="font-weight: 700;"> <?php  echo  $_SESSION['telephone']; ?></span>
                    </div>
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 justfy_centre table_to_append">
                
                </div>
            </div>
        </div>
        <br/>
        <div class="container" id="etape_3_button" style="display:none;"> 
            <?php 
                if(isset($_GET['numero_facture'])){
                    echo '<button id="etape_3_butt" class="btn notika-btn-orange btn-reco-mg btn-button-mg"  style="color:white !important; float: right;" onclick="updateFacture()">Editer</button>';
                }else {
                    echo '<button id="etape_3_butt" class="btn notika-btn-deeppurple btn-reco-mg btn-button-mg"  style="color:white !important; float: right;" onclick="enregistrerDevis()">Enregistrer</button>';
                }
            ?>
            <br/>
            <br/>
            <!-- <button id="generate-pdf">Generate PDF Preview</button> -->

        </div>

       


    <div class="modal fade" id="client_choix" role="dialog">
        <div class="modal-dialog modals-default" style="width: 96%;">
            <div class="modal-content" style="background: #f4f4f4;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <h2>Choisissez le client</h2>
                    <div class="form-group ic-cmp-int">
                                            <div class="form-ic-cmp">
                                                <i class="notika-icon notika-search"></i>
                                            </div>
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control" id="Societe_search" name="Societe" placeholder="Société" >
                                            </div>
                                        </div>
                
                        <div  id="clients-container" >
                        
                        </div>
                        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->

                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-default" data-dismiss="modal" onclick="add_ligne_devis('Information_SALLES')">Save changes</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="SALLES_ESPACES" role="dialog">
        <div class="modal-dialog modals-default">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <h2>Ajouter prestation (SALLES & ESPACES)</h2>
                    <div class="row" id="Information_SALLES">
                        <input type="hidden" name="client_ligne_devis_type_prestation" value="1"/>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-element-list" >
                            <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group ic-cmp-int">
                                            <div class="form-ic-cmp">
                                                <i class="notika-icon notika-edit"></i>
                                            </div>
                                            <div class="nk-int-st">
                                            <select class="dropdown_custom"  name="designation" id='designation_01' onchange="changeValueOfprestation_salles(this ,'Information_SALLES')" >
                                                <option value="0">*Choisissez la prestation ...</option>
                                                <?php

                                                    include '../Controllers/connection_database.php';

                                                    if ($societe_id) {
                                                        $query = "SELECT lp.id_ligne_devis_prestation, lp.designation, lp.prestation
                                                        FROM ligne_devis_prestation lp
                                                        INNER JOIN societe_prestations sp 
                                                        ON lp.id_ligne_devis_prestation = sp.id_prestation
                                                        WHERE sp.id_societe =$societe_id 
                                                        AND lp.client_ligne_devis_type_prestation = 4";

                                                        $stmt = $conn->query($query);

                                                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                            echo '<option value="' . $row['id_ligne_devis_prestation'] . '---' . $row['prestation'] . '---' . $row['designation'] . '">' . $row['designation'] . '</option>';
                                                        }
                                                    } else {
                                                        echo '<option value="0">Aucune prestation disponible</option>';
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
                                            <textarea class="form-control" name="Prestation"  id='prestation_01' placeholder="*Prestation" rows="7" >
                                            </textarea>
                                                <!-- <input type="textarea" class="form-control" name="Nom_societe" placeholder="*Prestation" > -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"> 
                                    <div class="form-group ic-cmp-int">
                                            <div class="form-ic-cmp">
                                            <i class="notika-icon notika-tax"></i>
                                            </div>
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control" placeholder="*Unité" id='unite_01' name= "Unite" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <div class="form-group ic-cmp-int">
                                            <div class="form-ic-cmp">
                                            <i class="notika-icon notika-dollar"></i>
                                            </div>
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control"  placeholder="*Nombre de jour" id='nbr_jour_01' name= "nbr_jour" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <div class="form-group ic-cmp-int">
                                            <div class="form-ic-cmp">
                                            <i class="notika-icon notika-dollar"></i>
                                            </div>
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control"  placeholder="*PU/HT" id='PU_01' name= "PU/HT" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"  data-dismiss="modal" onclick="add_ligne_devis('Information_SALLES')">Save changes</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    

    


<meta name="societe" content="<?php echo isset($_GET['societe'])  ? $_GET['societe'] : ''; ?>" />
<meta name="id_societe" content="<?php echo isset($societe_id) ? $societe_id : 0 ; ?>" />
<meta name="id_user" content="<?php echo $_SESSION['id_user']; ?>" />
<meta name="id_client" content="<?php echo isset($_GET['id_client'])  ? $_GET['id_client'] : ''; ?>" />
<meta name="devis_version" content="<?php echo isset($_GET['version'])  ? $_GET['version'] : ''; ?>" />
<meta name="De_Fa" content="<?php echo isset($_GET['De_Fa']) ? $_GET['De_Fa'] : ''; ?>" />
<meta name="id_client_facture" content="<?php echo isset($_GET['id_client_facture'])  ? $_GET['id_client_facture'] : ''; ?>" />
<meta name="id_client_devis" content="<?php echo isset($_GET['id_client_devis']) ? $_GET['id_client_devis'] : ''; ?>" />
<meta name="numero_facture" content="<?php echo isset($_GET['numero_facture']) ? $_GET['numero_facture'] : ''; ?>" />
<meta name="numero_devis" content="<?php echo isset($_GET['numero_devis']) ? $_GET['numero_devis'] : ''; ?>" />
<!-- <meta name="id_client_devis" content="<?php //echo isset($_GET['id_client_devis'])  ? $_GET['id_client_devis'] : ''; ?>" /> -->
<meta name="prestation_value" content="<?php echo $stmt->fetch(PDO::FETCH_ASSOC) != null  ?  $stmt->fetch(PDO::FETCH_ASSOC) : ''; ?>" />


<script src="../Front-end/devis_creation/devis_creation.js"></script> 

 <script src="../Front-end/liste_clients/liste_clients.js"></script> 


