<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
<input type="hidden" value="<?php echo $_SESSION['id_user']; ?>" Id="utilisateurs_01">
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
										<h2>Création Client</h2>
										<p style="font-weight: 700;font-size: large;"><?php echo str_replace("_", " ", $page_name); ?></p>
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
    <div id="form_01">
	<!-- Breadcomb area End-->
    <div class="form-element-area">
        <div class="container">
            <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-element-list" id="Information_Globale01">
                            <div class="basic-tb-hd">
                                <h2>Information Globale</h2>
                                <p></p>
                            </div>
                            <!-- <div class="cmp-tb-hd bcs-hd">
                                <h2>Basic Example</h2>
                                <p>Place one add-on or button on either side of an input. You may also place one on both sides of an input. </p>
                            </div> -->

                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group ic-cmp-int">
                                        <div class="form-ic-cmp">
                                            <i class="notika-icon notika-edit"></i>
                                        </div>
                                        <div class="nk-int-st">
                                            <select class="dropdown_custom"  name="id_societe" id='id_societe'   >
                                                <option value="0">*Sélectionner l'entreprise... ...</option>
                                                <?php  
                                                   include '../Controllers/connection_database.php';
                                                   if($_SESSION['profil'] != 'Administrateur system')
                                                   $query = "SELECT s.id_societe  , societe_name  FROM societes s JOIN utilisateur_societes us ON us.id_societe = s.id_societe WHERE us.id_user	= ".$_SESSION['id_user'];
                                                   else 
                                                   $query = "SELECT id_societe  , societe_name  FROM societes" ;

                                                   $stmt = $conn->query($query);
                                                   while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                    echo '<option value="' . $row['id_societe'] . '">' . $row['societe_name'] . '</option>';
                                                   }
                                                ?>
                                                 
                                            </select>              
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row" id="personne_physique_01" style="display:none;">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group ic-cmp-int">
                                        <div class="form-ic-cmp">
                                            <i class="notika-icon notika-edit"></i>
                                        </div>
                                        <div class="nk-int-st">
                                            <input type="text" class="form-control" name="Nom_Complet" placeholder="*Nom et Prénom" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="personne_physique_02">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group ic-cmp-int">
                                        <div class="form-ic-cmp">
                                            <i class="notika-icon notika-edit"></i>
                                        </div>
                                        <div class="nk-int-st">
                                            <input type="text" class="form-control" name="Nom_societe" placeholder="*Nom société" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                
                                    <!-- <div class="bootstrap-select fm-cmp-mg"> -->
                                        <select class="dropdown_custom" name="secteur" onchange="handleChangeSecteur(this)" >
                                                <option value="0">*Choisissez le secteur...</option>
                                                <option value ="1">Privé</option>
                                                <option value="2">Semi-Public</option>
                                                <option value="3">Public</option>
                                            </select>
                                    <!-- </div> -->

                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"> 
                                    <div class="toggle-select-act mg-t-30" >
                                        <div class="nk-toggle-switch" data-ts-color="amber" id="Agence_id1" style="margin-top:-23px; display:none;" >
                                                <label for="ts15" class="ts-label">*Agence événementielle</label>
                                                <input id="ts15" type="checkbox" name="Agence_evementiel" hidden="hidden"  >
                                                <label for="ts15" class="ts-helper"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group ic-cmp-int" id="ICE">
                                        <div class="form-ic-cmp">
                                        <i class="notika-icon notika-tax"></i>
                                        </div>
                                        <div class="nk-int-st">
                                            <input type="text" class="form-control" placeholder="*ICE" name= "ICE" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group ic-cmp-int" id="RC">
                                        <div class="form-ic-cmp">
                                        <i class="notika-icon notika-tax"></i>
                                        </div>
                                        <div class="nk-int-st">
                                            <input type="text" class="form-control" placeholder="*RC" name= "RC" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group ic-cmp-int">
                                        <div class="form-ic-cmp">
                                            <i class="notika-icon notika-house"></i>
                                        </div>
                                        <div class="nk-int-st">
                                            <input type="text" class="form-control" placeholder="*Adresse"  name= "Adresse">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group nk-datapk-ctm form-elet-mg" id="data_3">
                                        <label>Date de création*</label>
                                        <div class="input-group date nk-int-st">
                                            <span class="input-group-addon"></span>
                                            <input type="text" class="form-control" value="<?php $dateTimeObject = new DateTime(); $currentDateTimeObject = $dateTimeObject->format("Y-m-d H:i:s"); echo $currentDateTimeObject; ?>" disabled>
                                        </div>
                                    </div>
                                </div>
                            
                            </div>
                        </div>
                    </div>
            </div>
            
        </div>
    </div>
    <br/>
    <div class="form-element-area">
        <div class="container">
            <div class="row" id="dynamic-form-container">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-element-list">
                            <div class="basic-tb-hd">
                                <h2>Responsable / Interlocuteur</h2>
                                <p></p>
                            </div>
                            <!-- <div class="cmp-tb-hd bcs-hd">
                                <h2>Basic Example</h2>
                                <p>Place one add-on or button on either side of an input. You may also place one on both sides of an input. </p>
                            </div> -->

                            <div class="row" >
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                     <!-- <div class="bootstrap-select fm-cmp-mg"> -->
                                     <select class="dropdown_custom" name="type_responsable_interlocuteur" onchange="handleChangeResponsableInterlocuteur(this)">
                                            <?php 
                                                include '../Controllers/connection_database.php';
                                                
                                                $query = "SELECT id_c_responsable_interlocuteur, type_responsable_interlocuteur FROM c_responsable_interlocuteur";
                                                $stmt = $conn->query($query);

                                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                    echo '<option value="' . $row['id_c_responsable_interlocuteur'] . '">' . $row['type_responsable_interlocuteur'] . '</option>';
                                                   }
                                            ?>
                                        </select>
                                    <!-- </div> -->
                                </div>
                                 <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                
                                    <div class="form-group ic-cmp-int">
                                            <div class="form-ic-cmp">
                                            <i class="notika-icon notika-support"></i>

                                            </div>
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control" name="nom_complet" placeholder="*Nom et Prénom">
                                            </div>
                                     </div>
                                  
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                
                                    <div class="form-group ic-cmp-int">
                                            <div class="form-ic-cmp">
                                            <i class="notika-icon notika-support"></i>

                                            </div>
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control" name="email" placeholder="*Email">
                                            </div>
                                     </div>
                                  
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <div class="form-group ic-cmp-int">
                                            <div class="form-ic-cmp">
                                            <i class="notika-icon notika-phone"></i>

                                            </div>
                                            <div class="nk-int-st telephone">
                                                <input type="text" class="form-control" id="phone0" name="telephone" onchange="doite(this)" placeholder="*Numéro de téléphone">
                                            </div>
                                     </div>
                                </div>
                                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                    <div class="form-group ic-cmp-int">
                                          <button class="button_plus" onclick="addDynamicForm()">+</button>
                                          <button class="button_moins" style="display:none;" onclick="removeDynamicForm(this)">-</button>
                                     </div>
                                </div>
                            </div>
                         
                          
                        </div>
                    </div>
            </div>
           
        </div>
    </div>
    <br/>
    <div class="form-element-area">
        <div class="container">
            <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-element-list" id="modalite_piement_01">
                            <div class="basic-tb-hd">
                                <h2>Modalités de paiement</h2>
                                <p></p>
                            </div>
                            <!-- <div class="cmp-tb-hd bcs-hd">
                                <h2>Basic Example</h2>
                                <p>Place one add-on or button on either side of an input. You may also place one on both sides of an input. </p>
                            </div> -->

                            <div class="row" >
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    
                                   <div class="toggle-select-act mg-t-30">
                                            <div class="nk-toggle-switch" data-ts-color="purple">
                                                <label for="ts8" class="ts-label sous_label">*Sans / Avec avance <br><span class="sous_info">(default sans avance)</label>
                                                <input id="ts8" type="checkbox" name="ts8"  onchange="handleChangeModaliteAvanceSansAvance(this)">
                                                <label for="ts8" class="ts-helper"></label>
                                            </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                
                                <div class="toggle-select-act mg-t-30">
                                        <div class="nk-toggle-switch" data-ts-color="cyan">
                                            <label for="ts9" class="ts-label sous_label">*Mois / Semaine <br><span class="sous_info">(default mois)</span></label>
                                            <input id="ts9"  type="checkbox" hidden="hidden" onchange="handleChangeModaliteMoisSemaine(this)">
                                            <label for="ts9" class="ts-helper"></label>
                                        </div>
                                    </div>
                                  
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                
                                <div class="toggle-select-act mg-t-30">
                                            
                                            <div class="nk-toggle-switch" data-ts-color="amber" id="Totalite_model">
                                                <label for="ts10" class="ts-label">*Totalité</label>
                                                <input id="ts10" type="checkbox" hidden="hidden" onchange="handleChangeModaliteTotalite(this)">
                                                <label for="ts10" class="ts-helper"></label>
                                            </div>
                                            <div class="form-group ic-cmp-int" id="Porcentage_model" style="display:none; margin-top: -15px;">
                                                <div class="form-ic-cmp">
                                                <i class="notika-icon notika-dollar"></i>

                                                </div>
                                                <div class="nk-int-st">
                                                    <input type="text" class="form-control" name="pourcentage" data-mask="99 %"  placeholder="Pourcentage">
                                                </div>
                                            </div>
                                            
                                    </div>
                                  
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                  	<div class="themesaller-forms mg-t-30">
                                        <div class="spacer-b16a">
                                            <label for="bedrooms">*Étalonnage : <span id="value_range_id" class="etalonage_value">0</span> <span id="semaine_mois_id" class="etalonage_semaine_mois" > mois</span></label>
                                            <input type="range" min="0" max="20" name="etalonage" onchange="etalonnage_change(this)" value="0" class="slider-input">
                                        </div>

								    </div>
                                </div>
                             
                            </div>
                         
                          
                        </div>
                    </div>
            </div>
            <br/>
            <button class="btn notika-btn-deeppurple btn-reco-mg btn-button-mg" style="color:white !important; float: right;" onclick="submit_forms()">Enregistrer</button>
            <br/>
            <br/>
            <br/>
            <br/>
        </div>
        
    </div>
    </div>
    

   <!-- </br>
    <div class="form-element-area">
        <div class="container">
        <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-element-list">
                                <div class="basic-tb-hd">
                                    <h2>Listes des clients</h2>
                                    <p></p>
                                </div>
                    <table id="myTable" class="display">
                            <thead>
                                <tr>
                                    <th>Column 1</th>
                                    <th>Column 2</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Row 1 Data 1</td>
                                    <td>Row 1 Data 2</td>
                                </tr>
                                <tr>
                                    <td>hdsds</td>
                                    <td>Rsdsds</td>
                                </tr>
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div> -->

<script>
  const input = document.querySelector("#phone0");
  window.intlTelInput(input, {
    initialCountry: 'ma',
    utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/utils.js",
  });

</script>    
<script src="../Front-end/personne_morale_physique/personne_morale_physique.js"></script>

