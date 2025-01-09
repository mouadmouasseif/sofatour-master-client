
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
										<i class="notika-icon notika-"></i>
									</div>
									<div class="breadcomb-ctn">
										<h2>Chiffre D'affaires Par Employé</h2>
										<p>Rapport <span class="bread-ntd"></span></p>
									</div>
								</div>
							</div>
						    <!-- Sélecteurs -->
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        	<select class="dropdown_custom" name="year" id="year" aria-label="Sélectionner une année" onchange="executerfetchdata()x">
                            <option value="0">*Sélectionner Année...</option>
                            <?php
                            include '../Controllers/connection_database.php';
                            $queryDate = "SELECT year FROM `year`;";
                            $stmt = $conn->query($queryDate);
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo '<option value="' . htmlspecialchars($row['year']) . '">' . htmlspecialchars($row['year']) . '</option>';
                            }
                            ?>
                        </select>
                   			 </div>

                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <select class="dropdown_custom" name="DeFa" id="DeFa_001" aria-label="Sélectionner type de document" onchange="executerfetchdata()">
                            <option value="D">Devis confirmé</option>
                            <option value="F">Facture</option>
                        </select>
                   		 </div>

                   		 <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <select class="dropdown_custom" name="id_societe" id="id_societe" aria-label="Sélectionner l'entreprise" onchange="executerfetchdata()">
                            <option value="0">*Sélectionner l'entreprise...</option>
                            <?php
                            $query = "SELECT id_societe, societe_name FROM societes";
                            $stmt = $conn->query($query);
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo '<option value="' . htmlspecialchars($row['id_societe']) . '">' . htmlspecialchars($row['societe_name']) . '</option>';
                            }
                            ?>
                        </select>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<br/>


<div class="container" id="results-container">
        <!-- Les résultats seront insérés ici -->
    </div>


    <div class="container">
    <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="bar-chart-wp">
                        <canvas  width="180vw" id="barc01"></canvas>
                    </div>
                </div>
            </div>
    </div>


    <script src="../Front-end/Chiffre_d_affaire_par_personnel/Chiffre_d_affaire_par_personnel.js"></script> 

  