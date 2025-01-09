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
										<h2>Bilan Générale</h2>
										<p>Rapport <span class="bread-ntd"></span></p>
									</div>
								</div>
							</div>
              <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                            <select class="dropdown_custom" name="year" id="year" onchange="executerfetchdata();">
                                               <option value="0">*Sélectionner Annee... ...</option>
                                                <?php
                                                    include '../Controllers/connection_database.php';
                                                    $queryDate = "SELECT DISTINCT YEAR(le_devis) AS year FROM client_devis WHERE le_devis IS NOT NULL ORDER BY year ASC;";            
                                                    $stmt = $conn->query($queryDate);
                                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                        echo '<option value="' . $row['year'] . '">' . $row['year'] . '</option>';
                                                    }
                                                ?>
                                                <!-- <option value="2023">2023</option>
                                                <option value="2024">2024</option>
                                                <option value="2025">2025</option> -->
                                            </select>
								<!-- <div class="breadcomb-report">
									<button data-toggle="tooltip" data-placement="left" title="Download Report" class="btn"><i class="notika-icon notika-sent"></i></button>
								</div> -->
							</div>
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">  
							<select class="dropdown_custom"  name="id_societe" id="id_societe" onchange="executerfetchdata();">
                                                <option value="0">*Sélectionner l'entreprise... ...</option>
                                                <?php  
                                                   include '../Controllers/connection_database.php';
                                                   $query = "SELECT id_societe  , societe_name  FROM societes" ;

                                                   $stmt = $conn->query($query);
                                                   while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                    echo '<option value="' . $row['id_societe'] . '">' . $row['societe_name'] . '</option>';
                                                   }
                                                ?>
                                                 
                                            </select>        
							</div>
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
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="data-table-list">
                  
                    <div class="table-responsive ">


                    <!-- <button onclick="exportToExcel()">Export to Excel</button> -->

    
                      <table class="tt_rapp">

                       <tr>
                        <th rowspan="2">  Mois  </th>
                        <th colspan="5">  CHIFFRE D'AFFAIRES  </th>
                        <th  colspan="5">  ENCAISSEMENTS  </th>
                        <th  colspan="5"> IMPAYES </th>
                       </tr>

                       <tr>
                       
                        <th>  SALLES & ESPACES </th>
                        <th>  TECHNICIENS & RÉGISSEURS </th>
                        <th>  PRESTATIONS SUPPLÉMENTAIRES </th>
                        <th>  TOTAL </th>
                        <th>  CUMUL </th>
                     

                     
                        <th colspan="3">  TOTAL </th>
                        <th>  CUMUL </th>
                        <th>  % </th>

                        <th colspan="3">  TOTAL </th>
                        <th>  CUMUL </th>
                        <th>  % </th>

                 
                       </tr>


                       <tr id = "janvier">
                       
                       <th > Janvier </th>
                        <td> 0 </td>
                        <td> 0 </td>
                        <td> 0 </td>
                        <td> 0 </td>
                        <td> 0 </td>
                        

               
                     
                      <td colspan="3"> 0 </td>
                      <td> 0 </td>
                      <td> 0 </td>
                  
                      <td colspan="3"> 0 </td>
                      <td> 0 </td>
                      <td> 0 </td>
               
                
                      </tr>

                      <tr  id = "fevrier"> 
                       
                        <th> Février </th>
                        <td> 0 </td>
                        <td> 0 </td>
                        <td> 0 </td>
                        <td> 0 </td>
                        <td> 0 </td>

                     
                      <td colspan="3"> 0 </td>
                      <td> 0 </td>
                      <td> 0 </td>
                  
                      <td colspan="3"> 0 </td>
                      <td> 0 </td>
                      <td> 0 </td>
               
                
                      </tr>


                      <tr id = "mars">
                       
                       <th> Mars </th>
                        <td> 0 </td>
                        <td> 0 </td>
                        <td> 0 </td>
                        <td> 0 </td>
                        <td> 0 </td>

              
                     
                      <td colspan="3"> 0 </td>
                      <td> 0 </td>
                      <td> 0 </td>
                  
                      <td colspan="3"> 0 </td>
                      <td> 0 </td>
                      <td> 0 </td>
               
               
                     </tr>


                     <tr id = "avril">
                       
                       <th> Avril </th>
                        <td> 0 </td>
                        <td> 0 </td>
                        <td> 0 </td>
                        <td> 0 </td>
                        <td> 0 </td>

                
                     
                      <td colspan="3"> 0 </td>
                      <td> 0 </td>
                      <td> 0 </td>
                  
                      <td colspan="3"> 0 </td>
                      <td> 0 </td>
                      <td> 0 </td>
               
                     </tr>


                     <tr id = "mai">
                       
                       <th> Mai </th>
                        <td> 0 </td>
                        <td> 0 </td>
                        <td> 0 </td>
                        <td> 0 </td>
                        <td> 0 </td>

                      
                     
                      <td colspan="3"> 0 </td>
                      <td> 0 </td>
                      <td> 0 </td>
                  
                      <td colspan="3"> 0 </td>
                      <td> 0 </td>
                      <td> 0 </td>
               
               
                     </tr>


                     <tr id = "juin">
                       
                       <th> Juin </th>
                        <td> 0 </td>
                        <td> 0 </td>
                        <td> 0 </td>
                        <td> 0 </td>
                        <td> 0 </td>

                      
                     
                      <td colspan="3"> 0 </td>
                      <td> 0 </td>
                      <td> 0 </td>
                  
                      <td colspan="3"> 0 </td>
                      <td> 0 </td>
                      <td> 0 </td>
               
                     </tr>


                     <tr  id = "juillet">
                       
                       <th> Juillet </th>
                        <td> 0 </td>
                        <td> 0 </td>
                        <td> 0 </td>
                        <td> 0 </td>
                        <td> 0 </td>

                    
                    
                      <td colspan="3"> 0 </td>
                      <td> 0 </td>
                      <td> 0 </td>
                  
                      <td colspan="3"> 0 </td>
                      <td> 0 </td>
                      <td> 0 </td>
               
                     </tr>


                     <tr  id = "aout">
                       
                       <th> Août </th>
                        <td> 0 </td>
                        <td> 0 </td>
                        <td> 0 </td>
                        <td> 0 </td>
                        <td> 0 </td>
               
                     
                      <td colspan="3"> 0 </td>
                      <td> 0 </td>
                      <td> 0 </td>
                  
                      <td colspan="3"> 0 </td>
                      <td> 0 </td>
                      <td> 0 </td>
               
               
                     </tr>


                     <tr id = "september">
                       
                       <th> September </th>
                        <td> 0 </td>
                        <td> 0 </td>
                        <td> 0 </td>
                        <td> 0 </td>
                        <td> 0 </td>

               
                     
                      <td colspan="3"> 0 </td>
                      <td> 0 </td>
                      <td> 0 </td>
                  
                      <td colspan="3"> 0 </td>
                      <td> 0 </td>
                      <td> 0 </td>
               
                     </tr>


                     <tr  id = "octobre">
                       
                       <th> Octobre </th>
                        <td> 0 </td>
                        <td> 0 </td>
                        <td> 0 </td>
                        <td> 0 </td>
                        <td> 0 </td>

              
                     
                      <td colspan="3"> 0 </td>
                      <td> 0 </td>
                      <td> 0 </td>
                  
                      <td colspan="3"> 0 </td>
                      <td> 0 </td>
                      <td> 0 </td>
                     </tr>


                     <tr  id = "novembre">
                       
                       <th> Novembre </th>
                        <td> 0 </td>
                        <td> 0 </td>
                        <td> 0 </td>
                        <td> 0 </td>
                        <td> 0 </td>

                  
                     
                      <td colspan="3"> 0 </td>
                      <td> 0 </td>
                      <td> 0 </td>
                  
                      <td colspan="3"> 0 </td>
                      <td> 0 </td>
                      <td> 0 </td>
               
               
                     </tr>


                     <tr id = "decembre">
                       
                       <th> Décembre </th>
                       <td> 0 </td>
                        <td> 0 </td>
                        <td> 0 </td>
                        <td> 0 </td>
                        <td> 0 </td>

             
                     
                      <td colspan="3"> 0 </td>
                      <td> 0 </td>
                      <td> 0 </td>
                  
                      <td colspan="3"> 0 </td>
                      <td> 0 </td>
                      <td> 0 </td>
               
               
                     </tr>


                     <tr id = "totale">
                       
                       <th> Total </th>
                       <td> 0 </td>
                        <td> 0 </td>
                        <td> 0 </td>
                        <td> 0 </td>
                        
                        <td style="background-image: repeating-conic-gradient(#000000 0% 25%, #d6d6d6 0% 50%);
                        background-position: 0 0, 32px 32px;
                        background-size: 10px 10px;
                        background-color: #e3e3e3;
                    ">  </td>
             
                     
                      <td colspan="3"> 0 </td>
                      <td style="background-image: repeating-conic-gradient(#000000 0% 25%, #d6d6d6 0% 50%);
                        background-position: 0 0, 32px 32px;
                        background-size: 10px 10px;
                        background-color: #e3e3e3;
                    ">  </td>
                      <td> 0 </td>
                  
                      <td colspan="3"> 0 </td>
                      <td style="background-image: repeating-conic-gradient(#000000 0% 25%, #d6d6d6 0% 50%);
                        background-position: 0 0, 32px 32px;
                        background-size: 10px 10px;
                        background-color: #e3e3e3;
                    ">  </td>
                      <td> 0 </td>
               
               
                     </tr>

                    

                          
                      </table>
                    </div>
                </div>
            </div>
    </div>
</div>
<script src="../Front-end/Rapports_bilan_generale/Rapports_bilan_generale.js"></script>





