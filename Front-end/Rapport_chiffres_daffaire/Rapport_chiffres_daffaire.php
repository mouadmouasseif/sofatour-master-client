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
										<i class="notika-icon notika-bar-chart"></i>
									</div>
									<div class="breadcomb-ctn">
										<h2>Chiffre d'affaires</h2>
										<p>Suivi <span class="bread-ntd"></span></p>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
                            <select class="dropdown_custom" name="annee" id="annee_001">
                                                <option value="2023">2023</option>
                                                <option value="2024">2024</option>
                                                <option value="2025">2025</option>
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
    <div class="bar-chart-area">
        <div class="container">
        <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
           <p style="background: rgb(72 179 1 / 50%);  padding: inherit; box-shadow: rgba(100, 100, 111, 0.2) 0px 3px 3px 0px; text-align: center;" >CA confirmer: <span id="CA_01" style="font-size: larger; font-weight: 800;"></span></p> 
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
           <p style="background: rgba(255  197  0  / 50%);  padding: inherit; box-shadow: rgba(100, 100, 111, 0.2) 0px 3px 3px 0px; text-align: center;" >CA non confirmés: <span id="CA_02" style="font-size: larger; font-weight: 800;"></span></p>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
           <p style="background: rgb(255 0 0 / 50%);  padding: inherit; box-shadow: rgba(100, 100, 111, 0.2) 0px 3px 3px 0px; text-align: center;" >CA annuler: <span id="CA_04" style="font-size: larger; font-weight: 800;"></span></p>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
           <p style="background: rgb(255 141 219 / 50%);  padding: inherit; box-shadow: rgba(100, 100, 111, 0.2) 0px 3px 3px 0px; text-align: center;">CA devis emis: <span id="CA_03" style="font-size: larger; font-weight: 800;"></span></p>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
           <p style="background:rgb(0 108 48 / 50%);  padding: inherit; box-shadow: rgba(100, 100, 111, 0.2) 0px 3px 3px 0px; text-align: center;">CA Payé: <span id="CA_05" style="font-size: larger; font-weight: 800;"></span></p>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
           <p style="background: rgb(255 3 3 / 50%);  padding: inherit; box-shadow: rgba(100, 100, 111, 0.2) 0px 3px 3px 0px; text-align: center;">CA Impayé: <span id="CA_06" style="font-size: larger; font-weight: 800;"></span></p>
        </div>
        </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="bar-chart-wp">
                        <canvas  width="180vw" id="barc01"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
	<!-- Breadcomb area End-->

    <script>
        $(document).ready(function(){
        var ctx = document.getElementById("barc01");

        function calculer_chiffres_daffire(annee)
        {
            fetch('../Controllers/getChart_chiffreDaffaire.php?annee=' +annee, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                  console.log(data);
                  var somme_prix_confirmer = 0;
                  var somme_prix_non_confirmer = 0;
                  var somme_prix_annuler = 0;
                  var somme_prix_paye = 0;
                  var somme_prix_impaye = 0;

                  var cahrt_element_confirmer = [];
                  for(let i = 1 ; i < 13 ; i++)
                  {
                    var r = 0;
                    for(let j = 0 ; j < data.confirmer.length ; j++)
                    {
                        if(data.confirmer[j].mois == i)
                        {
                            cahrt_element_confirmer.push( parseFloat(data.confirmer[j].somme_prix_total).toFixed(2) ) ;
                            r++;
                            somme_prix_confirmer += parseFloat(data.confirmer[j].somme_prix_total) ;
                        }
                    }

                    if(r == 0)
                    {
                        cahrt_element_confirmer.push(0);
                    }
                    r = 0;
                       
                  }

                  var cahrt_element_non_confirmer = [];
                  for(let i = 1 ; i < 13 ; i++)
                  {
                    var r = 0;
                    for(let j = 0 ; j < data.non_confirmer.length ; j++)
                    {
                        if(data.non_confirmer[j].mois == i)
                        {
                            cahrt_element_non_confirmer.push( parseFloat(data.non_confirmer[j].somme_prix_total).toFixed(2) ) ;
                            r++;
                            somme_prix_non_confirmer += parseFloat(data.non_confirmer[j].somme_prix_total) ;
                        }
                    }

                    if(r == 0)
                    {
                        cahrt_element_non_confirmer.push(0);
                    }
                    r = 0;
                       
                  }

                  var cahrt_element_Totale = [];
                  for(let i = 1 ; i < 13 ; i++)
                  {
                    var r = 0;
                    for(let j = 0 ; j < data.totale.length ; j++)
                    {
                        if(data.totale[j].mois == i)
                        {
                            cahrt_element_Totale.push( parseFloat(data.totale[j].somme_prix_total).toFixed(2) ) ;
                            r++;
                        }
                    }

                    if(r == 0)
                    {
                        cahrt_element_Totale.push(0);
                    }
                    r = 0;
                       
                  }


                  var cahrt_element_annuler = [];
                  for(let i = 1 ; i < 13 ; i++)
                  {
                    var r = 0;
                    for(let j = 0 ; j < data.annuler.length ; j++)
                    {
                        if(data.annuler[j].mois == i)
                        {
                            cahrt_element_annuler.push( parseFloat(data.annuler[j].somme_prix_total).toFixed(2) ) ;
                            r++;
                            somme_prix_annuler += parseFloat(data.annuler[j].somme_prix_total) ;
                        }
                    }

                    if(r == 0)
                    {
                        cahrt_element_annuler.push(0);
                    }
                    r = 0;
                       
                  }


                  var cahrt_element_paye = [];
                  for(let i = 1 ; i < 13 ; i++)
                  {
                    var r = 0;
                    for(let j = 0 ; j < data.paye.length ; j++)
                    {
                        if(data.paye[j].mois == i)
                        {
                            cahrt_element_paye.push( parseFloat(data.paye[j].somme_prix_total).toFixed(2) ) ;
                            r++;
                            somme_prix_paye += parseFloat(data.paye[j].somme_prix_total) ;
                        }
                    }

                    if(r == 0)
                    {
                        cahrt_element_paye.push(0);
                    }
                    r = 0;
                       
                  }



                   var cahrt_element_impaye = [];
                //   for(let i = 1 ; i < 13 ; i++)
                //   {
                //     var r = 0;
                //     for(let j = 0 ; j < data.impaye.length ; j++)
                //     {
                //         if(data.impaye[j].mois == i)
                //         {
                //             cahrt_element_impaye.push( parseFloat(data.impaye[j].somme_prix_total).toFixed(2) ) ;
                //             r++;
                //             somme_prix_impaye += parseFloat(data.impaye[j].somme_prix_total) ;
                //         }
                //     }

                //     if(r == 0)
                //     {
                //         cahrt_element_impaye.push(0);
                //     }
                //     r = 0;
                       
                //   }



                 for(let i = 0 ; i < cahrt_element_paye.length ; i++)
                 {
                    cahrt_element_impaye.push(cahrt_element_confirmer[i] - cahrt_element_paye[i]);
                    somme_prix_impaye += cahrt_element_confirmer[i] - cahrt_element_paye[i];
                 }


        

                  
                  $("#CA_01").text(somme_prix_confirmer.toLocaleString('en-US', { minimumFractionDigits: 2,maximumFractionDigits: 2,}) + ' DH');
                  $("#CA_02").text(somme_prix_non_confirmer.toLocaleString('en-US', { minimumFractionDigits: 2,maximumFractionDigits: 2,}) + ' DH');
                  $("#CA_03").text((somme_prix_confirmer + somme_prix_non_confirmer + somme_prix_annuler).toLocaleString('en-US', { minimumFractionDigits: 2,maximumFractionDigits: 2,}) + ' DH');
                  $("#CA_04").text((somme_prix_annuler).toLocaleString('en-US', { minimumFractionDigits: 2,maximumFractionDigits: 2,}) + ' DH');

                  $("#CA_05").text((somme_prix_paye).toLocaleString('en-US', { minimumFractionDigits: 2,maximumFractionDigits: 2,}) + ' DH');
                  $("#CA_06").text((somme_prix_impaye).toLocaleString('en-US', { minimumFractionDigits: 2,maximumFractionDigits: 2,}) + ' DH');



                  var existingChart = Chart.getChart(ctx);
                    if (existingChart) {
                        existingChart.destroy();
                    }

                  var barchart1 = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ["janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre"],
                        datasets: [
                            {
                            label: 'Devis confirmer',  
                            data: cahrt_element_confirmer,
                            backgroundColor: 'rgb(72 179 1 / 50%)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                            },
                            {
                                label: 'Devis non confirmés',  
                                data: cahrt_element_non_confirmer,
                                backgroundColor: 'rgba(255  197  0  / 50%)',
                                borderColor: 'rgba(255, 99, 132, 1)',
                                borderWidth: 1
                            },
                            {
                                label: 'Devis annuler',  
                                data: cahrt_element_annuler,
                                backgroundColor: 'rgb(255 0 0 / 50%)',
                                borderColor: 'rgba(255, 99, 132, 1)',
                                borderWidth: 1
                            },
                            {
                                label: 'devis emis',  
                                data: cahrt_element_Totale,
                                backgroundColor: 'rgb(255 141 219 / 50%)',
                                borderColor: 'rgba(255, 99, 132, 1)',
                                borderWidth: 1
                            },
                            {
                                label: 'CA Payé',  
                                data: cahrt_element_paye,
                                backgroundColor: 'rgb(0 108 48 / 50%)',
                                borderColor: 'rgba(255, 99, 132, 1)',
                                borderWidth: 1
                            },
                            {
                                label: 'CA Impayé',  
                                data: cahrt_element_impaye,
                                backgroundColor: 'rgb(255 3 3 / 50%)',
                                borderColor: 'rgba(255, 99, 132, 1)',
                                borderWidth: 1
                            }
                        ]
                    },
                    plugins: {
                        legend: {
                            display: false,
                        },
                        datalabels: {
                            display: true,
                            align: 'center',
                            anchor: 'center',
                        },
                    },
                    
                    
                    
                });


            })
            .catch((error) => {
                console.error('Error updating data:', error);
                cuteToast({
                    type: "error", // or 'info', 'error', 'warning'
                    title: "error",
                    message: error.message,
                    timer: 5000
                    });
            });
           
        }
        
        calculer_chiffres_daffire(2023);
 


        $('#annee_001').change(function(){
            calculer_chiffres_daffire($(this).val());
        });
        
    });

    </script>