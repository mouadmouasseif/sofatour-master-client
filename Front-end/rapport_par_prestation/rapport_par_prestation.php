<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, minimum-scale=1.0, user-scalable=yes">

<div class="spinner spiinneeeer">
  <div class="rect1"></div>
  <div class="rect2"></div>
  <div class="rect3"></div>
  <div class="rect4"></div>
  <div class="rect5"></div>
</div>

<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="breadcomb-list">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="breadcomb-wp">
									<div class="breadcomb-icon">
										<i class="notika-icon notika-bar-chart"></i>
									</div>
									<div class="breadcomb-ctn">
										<h2>Rapport Des Prestations</h2>
										<p>Rapport <span class="bread-ntd"></span></p>
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
								<select class="dropdown_custom" name="annee" id="annee_001" >
                                               <option value="0">*Sélectionner Annee... ...</option>
                                                <?php
                                                    include '../Controllers/connection_database.php';
                                                    $queryDate = "SELECT DISTINCT YEAR(le_devis) AS year FROM client_devis WHERE le_devis IS NOT NULL ORDER BY year ASC;";            
                                                    $stmt = $conn->query($queryDate);
                                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                        echo '<option value="' . $row['year'] . '">' . $row['year'] . '</option>';
                                                    }
                                                ?>
                                </select>
								<!-- <div class="breadcomb-report">
									<button data-toggle="tooltip" data-placement="left" title="Download Report" class="btn"><i class="notika-icon notika-sent"></i></button>
								</div> -->
							</div>
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                            <select class="dropdown_custom" name="DeFa" id="DeFa_001">
                                                <option value="D">Devis confirmé</option>
                                                <option value="F">Facture</option>
                                            </select>
								<!-- <div class="breadcomb-report">
									<button data-toggle="tooltip" data-placement="left" title="Download Report" class="btn"><i class="notika-icon notika-sent"></i></button>
								</div> -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
        <br>
<div class="container_2" id="etape_2" style="text-align: center;">
<div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                <div class="data-table-list">
				<select class="form-control mb-3"  name="id_societe" id='id_societe'>
                    <option value="0">Sélectionner l'entreprise</option>
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
				<h1 style="margin-top: 12px; text-align: left; font-size: small;">Choisissez les prestations que vous voulez </h1>
 
				<?php  
					include '../Controllers/connection_database.php';
					$query = "SELECT id_ligne_devis_prestation, designation, prestation FROM ligne_devis_prestation";
					$stmt = $conn->query($query);
					
					echo '<select name="prestation[]" class="form-control mb-3" style="height: 490px; overflow-x: auto; display: block; border: 1px solid #b9b9b9; border-radius: 2px;" id="listePrestations" multiple>';
					while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
						echo '<option value="' . $row['id_ligne_devis_prestation'].'">';
						echo $row['designation'];
						echo '</option>';
					}
					echo '</select>';
				?>

            
                  
                </div>
            </div>
			<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
			<br/>
			<br/>
			<br/>
			<br/>
			<br/>
			<br/>
			<br/>
			<br/>
			<button type="button" class="btn notika-btn-deeppurple btn-reco-mg btn-button-mg waves-effect" style="color:white;" data-dismiss="modal" onclick="rechercher();"> Rechercher </button> 
			<br/>
			<br/>
			<button type="button" class="btn notika-btn-deeppurple btn-reco-mg btn-button-mg waves-effect" style="color:white; background: #f94e54;" data-dismiss="modal" onclick="reset_data();">&nbsp;&nbsp;&nbsp;&nbsp; Reset &nbsp;&nbsp;&nbsp;&nbsp;</button> 
	
			</div>

			<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8"   >
			<div class="data-table-list" style="min-height: 552px;">
             <h1 style="    color: #e9e9e9; font-size: medium;" id="pas_data">Aucun resultat...</h1>

			 <div id="is_data">
			    <h1 style="    text-align: left;  font-size: medium;">Resultat</h1>

				<table class="tt_rapp" >
					<thead>
						<tr>
							<th style="border-left:black;">Designation</th>
							<th>Prestation</th>
							<th style="border-right:black;">Total Prix</th>
							<th style="border-right:black;">Opérations</th>

						</tr>
					</thead>
					<tbody id="resultatsTableauBody">
						<!-- Les lignes de résultat seront ajoutées ici par JavaScript -->
					</tbody>
				</table>
			</div>


			<div id="is_data_detail">
			    <h1 style="  margin-top: 10px;  text-align: left;  font-size: medium;">Detail</h1>

				<table class="tt_rapp" >
					<thead>
						<tr>
							<th style="border-left:black;">Designation</th>
							<th>N Devis/Facture</th>
							<th>Client</th>
							<th>du</th>
							<th>a</th>
							<th style="border-right:black;">Total Prix</th>
						</tr>
					</thead>
					<tbody id="resultatsTableauBody_detail">
						<!-- Les lignes de résultat seront ajoutées ici par JavaScript -->
					</tbody>
				</table>
			</div>




				</div>
			</div>
</div>


<script src="../Front-end/rapport_par_prestation/rapport_par_prestation.js"></script> 
