$(".spiinneeeer").hide();
function exportToExcel() {
    // Sample data
    const data = [
        ["Name", "Age", "Email"],
        ["John Doe", 30, "john.doe@example.com"],
        ["Jane Smith", 25, "jane.smith@example.com"],
        ["Jake White", 35, "jake.white@example.com"]
    ];

    // Create a new workbook and a worksheet
    const wb = XLSX.utils.book_new();
    const ws = XLSX.utils.aoa_to_sheet(data);

    // Append the worksheet to the workbook
    XLSX.utils.book_append_sheet(wb, ws, "Sheet1");

    // Export the workbook to a file
    XLSX.writeFile(wb, "data.xlsx");
}


// function fetchData(year, typePrestation) {
//     fetch(`../Controllers/Rapports_bilan_generale_Controller.php?year=${year}&type_prestation=${typePrestation}`)
//         .then(response => {
//             if (!response.ok) {
//                 throw new Error('Network response was not ok ' + response.statusText);
//             }
//             return response.json();
//         })
//         .then(data => {
//             console.log(data);
//             // Additional processing can go here
//         })
//         .catch(error => {
//             console.error('There has been a problem with your fetch operation:', error);
//         });
// }


// async function fetchData(year, typePrestation) {
//     try {
//         const response = await fetch(`../Controllers/Rapports_bilan_generale_Controller.php?year=${year}&type_prestation=${typePrestation}`);
//         if (!response.ok) {
//             throw new Error('Network response was not ok ' + response.statusText);
//         }
//         const data = await response.json();
//         console.log(data);
//         // Additional processing can go here
//     } catch (error) {
//         console.error('There has been a problem with your fetch operation:', error);
//     }
// }


// // Example usage:
// fetchData(2023, 1);
// fetchData(2023, 2);


async function executerfetchdata()
{
    const annee = document.getElementById('year').value;
    const id_societe = document.getElementById('id_societe').value;

    console.log('ID société :', id_societe);
    console.log('Année :', annee);
    $(".spiinneeeer").show();
            const response_1 = await fetch(`../Controllers/Rapports_bilan_generale_Controller.php?year=${annee}&type_prestation=1&id_societe=${id_societe}`);
            if (!response_1.ok) {
                throw new Error('Network response was not ok ' + response_1.statusText);
            }
            const data_salle_espace = await response_1.json();
              console.log('data salle',data_salle_espace);

            const response_2 = await fetch(`../Controllers/Rapports_bilan_generale_Controller.php?year=${annee}&type_prestation=2&id_societe=${id_societe}`);
            if (!response_2.ok) {
                throw new Error('Network response was not ok ' + response_2.statusText);
            }
            const data_tech = await response_2.json();
            console.log('data tech',data_tech);


           const response_3 = await fetch(`../Controllers/Rapports_bilan_generale_encaiss_Controller.php?year=${annee}&type_prestation=3&id_societe=${id_societe}`);
           if (!response_3.ok) {
               throw new Error('Network response was not ok ' + response_3.statusText);
           }
           const data_supliment = await response_3.json();
           console.log( 'data sup',data_supliment );
           const response_4 = await fetch(`../Controllers/Rapports_bilan_generale_encaiss_Controller.php?year=${annee}&id_societe=${id_societe}`);
           if (!response_4.ok) {
               throw new Error('Network response was not ok ' + response_4.statusText);
           }
           const totales_enc = await response_4.json();
           console.log(totales_enc);


        
           $(".spiinneeeer").hide();


    // const data_salle_espace = await fetch(`../Controllers/Rapports_bilan_generale_Controller.php?year=${ele}&type_prestation=1`)
    var mois_bilan=[
        {mois : 'janvier' , val : "01"},
        {mois : 'fevrier' , val : "02"},
        {mois :'mars'  , val: "03"},
        {mois :'avril'  , val: "04"},
        {mois :'mai' , val : "05"},
        {mois :'juin'  , val: "06"},
        {mois :'juillet' , val : "07"},
        {mois :'aout' , val : "08"},
        {mois :'september' , val : "09"},
        {mois :'octobre' , val : "10"},
        {mois :'novembre' , val : "11"},
        {mois :'decembre' , val : "12"}
    ]
    var formatter = new Intl.NumberFormat('fr-FR', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    });


        for(let j = 0 ; j < mois_bilan.length ; j++ )
        {
            for(let r = 0 ; r <  document.querySelector('#'+mois_bilan[j].mois).querySelectorAll('td').length ; r++)
                {
                    document.querySelector('#'+mois_bilan[j].mois).querySelectorAll('td')[r].innerHTML = '0,00';
                }
        }


      var data_all = [];
        

   // ++++++++++++++++++++++++++++++++++++++++++ chiffre d affaire ++++++++++++++++++++++++++++++++++++++++++++ //
   // ++++++++++++++++++++++++++++++++++++++++++  chiffre d affaire  ++++++++++++++++++++++++++++++++++++++++++++ //
   // ++++++++++++++++++++++++++++++++++++++++++  chiffre d affaire  ++++++++++++++++++++++++++++++++++++++++++++ //


//-------Salle espace 
   
    for(let j = 0 ; j < mois_bilan.length ; j++ )
        {
                var inside = 0;
                for(let i = 0 ; i < data_salle_espace.length ; i++)
                {
                   
                        if(mois_bilan[j].val == data_salle_espace[i].month_year.split('-')[1])
                        {

                                data_all.push({
                                    salle : parseFloat(data_salle_espace[i].total_prix_total_ttc),
                                    tech : 0 ,
                                    supliment :0,
                                    total : 0,
                                    cumul : 0,
                                    total_enc : 0, 
                                    cumul_enc : 0,
                                    mois_bilan : mois_bilan[j]
                                });
                                document.querySelector('#'+mois_bilan[j].mois).querySelectorAll('td')[0].innerHTML =formatter.format( parseFloat(data_salle_espace[i].total_prix_total_ttc).toFixed(2));
                                document.querySelector('#'+mois_bilan[j].mois).querySelectorAll('td')[0].style.backgroundColor = '#ffff0087';
                                inside++;
                        }

                       
                 }

                 if(inside == 0)
                    {
                        data_all.push({
                            salle : 0,
                            tech : 0 ,
                            supliment :0,
                            total : 0,
                            cumul : 0,
                            total_enc : 0, 
                            cumul_enc : 0,
                            per_enc : 0,
                            total_imp : 0, 
                            cumul_imp : 0,
                            per_imp : 0,
                            mois_bilan : mois_bilan[j],
                           
                        });
                        
                        document.querySelector('#'+mois_bilan[j].mois).querySelectorAll('td')[0].style.backgroundColor = '#ffff0087';
                    }
                    inside = 0;


              
        }
//---------- Supliment
for(let j = 0 ; j < mois_bilan.length ; j++ )
    {
        var inside = 0;
        for(let i = 0 ; i < data_supliment.length ; i++)
            {
                if(mois_bilan[j].val == data_tech[i].month_year.split('-')[1])
                    {

                     
    
                        data_all[j].supliment = parseFloat(data_supliment[i].total_prix_total_ttc);

                        if(mois_bilan[j].val == '01')
                            {
                                data_all[j].cumul = parseFloat(data_tech[i].total_prix_total_ttc)+ parseFloat(data_all[j].supliment) + parseFloat(data_all[j].salle);
                            }
                            else
                            {
                                data_all[j].cumul = data_all[j-1].cumul +parseFloat(data_supliment[i].total_prix_total_ttc)+  parseFloat(data_tech[i].total_prix_total_ttc) + parseFloat(data_all[j].salle);
                            }
                            
                        
                      
                        document.querySelector('#'+mois_bilan[j].mois).querySelectorAll('td')[2].innerHTML = formatter.format( parseFloat(data_supliment[i].total_prix_total_ttc).toFixed(2) );
                        document.querySelector('#'+mois_bilan[j].mois).querySelectorAll('td')[2].style.backgroundColor = '#ffff0087';


                        inside++;
                     
                    }
            }

            if(inside == 0)
                {
                    document.querySelector('#'+mois_bilan[j].mois).querySelectorAll('td')[2].style.backgroundColor = '#ffff0087';
                    data_all[j].total = 0 + parseFloat(data_all[j].salle);

                   
                    if(mois_bilan[j].val == '01')
                        {
                            data_all[j].cumul = 0 + parseFloat(data_all[j].salle);
                        }
                        else
                        {
                            data_all[j].cumul = data_all[j-1].cumul + 0 + parseFloat(data_all[j].tech) + parseFloat(data_all[j].salle);
                        }
                }
                inside = 0;

                document.querySelector('#'+mois_bilan[j].mois).querySelectorAll('td')[3].innerHTML = formatter.format(data_all[j].total.toFixed(2));
                document.querySelector('#'+mois_bilan[j].mois).querySelectorAll('td')[3].style.backgroundColor = '#ffff0087';


                document.querySelector('#'+mois_bilan[j].mois).querySelectorAll('td')[4].innerHTML = formatter.format(data_all[j].cumul.toFixed(2));
                document.querySelector('#'+mois_bilan[j].mois).querySelectorAll('td')[4].style.backgroundColor = '#ffff0087';


    }



//------------tech

        for(let j = 0 ; j < mois_bilan.length ; j++ )
        {
            var inside = 0;
            for(let i = 0 ; i < data_tech.length ; i++)
                {
                    if(mois_bilan[j].val == data_tech[i].month_year.split('-')[1])
                        {

                         
        
                            data_all[j].tech = parseFloat(data_tech[i].total_prix_total_ttc);
                            data_all[j].total = parseFloat(data_tech[i].total_prix_total_ttc) + parseFloat(data_all[j].salle);

                            if(mois_bilan[j].val == '01')
                                {
                                    data_all[j].cumul = parseFloat(data_tech[i].total_prix_total_ttc) + parseFloat(data_all[j].salle);
                                }
                                else
                                {
                                    data_all[j].cumul = data_all[j-1].cumul +  parseFloat(data_tech[i].total_prix_total_ttc) + parseFloat(data_all[j].salle);
                                }
                                
                            
                          
                            document.querySelector('#'+mois_bilan[j].mois).querySelectorAll('td')[1].innerHTML = formatter.format( parseFloat(data_tech[i].total_prix_total_ttc).toFixed(2) );
                            document.querySelector('#'+mois_bilan[j].mois).querySelectorAll('td')[1].style.backgroundColor = '#ffff0087';


                            inside++;
                         
                        }
                }

                if(inside == 0)
                    {
                        document.querySelector('#'+mois_bilan[j].mois).querySelectorAll('td')[1].style.backgroundColor = '#ffff0087';
                        data_all[j].total = 0 + parseFloat(data_all[j].salle);

                       
                        if(mois_bilan[j].val == '01')
                            {
                                data_all[j].cumul = 0 + parseFloat(data_all[j].salle);
                            }
                            else
                            {
                                data_all[j].cumul = data_all[j-1].cumul +  0 + parseFloat(data_all[j].salle);
                            }
                    }
                    inside = 0;

                    document.querySelector('#'+mois_bilan[j].mois).querySelectorAll('td')[3].innerHTML = formatter.format(data_all[j].total.toFixed(2));
                    document.querySelector('#'+mois_bilan[j].mois).querySelectorAll('td')[3].style.backgroundColor = '#ffff0087';


                    document.querySelector('#'+mois_bilan[j].mois).querySelectorAll('td')[4].innerHTML = formatter.format(data_all[j].cumul.toFixed(2));
                    document.querySelector('#'+mois_bilan[j].mois).querySelectorAll('td')[4].style.backgroundColor = '#ffff0087';


        }


   // ++++++++++++++++++++++++++++++++++++++++++ chiffre d affaire ++++++++++++++++++++++++++++++++++++++++++++ //
                // ++++++++++++++++++++++++++++++++++++++++++  chiffre d affaire  ++++++++++++++++++++++++++++++++++++++++++++ //
                 // ++++++++++++++++++++++++++++++++++++++++++  chiffre d affaire  ++++++++++++++++++++++++++++++++++++++++++++ //




    // ++++++++++++++++++++++++++++++++++++++++++ Encaissement ++++++++++++++++++++++++++++++++++++++++++++ //
                // ++++++++++++++++++++++++++++++++++++++++++ Encaissement ++++++++++++++++++++++++++++++++++++++++++++ //
                 // ++++++++++++++++++++++++++++++++++++++++++ Encaissement ++++++++++++++++++++++++++++++++++++++++++++ //



              

                 for(let j = 0 ; j < mois_bilan.length ; j++ )
                    {
                        var inside = 0;
                        for(let i = 0 ; i < totales_enc.length ; i++)
                            {
                                if(mois_bilan[j].val == totales_enc[i].month_year.split('-')[1])
                                    {
            
                                     
                    
                                        data_all[j].total_enc = parseFloat(totales_enc[i].total_prix_total_ttc);
            
                                        if(mois_bilan[j].val == '01')
                                            {
                                                data_all[j].cumul_enc = parseFloat(totales_enc[i].total_prix_total_ttc);
                                            }
                                            else
                                            {
                                                data_all[j].cumul_enc = data_all[j-1].cumul_enc +  parseFloat(totales_enc[i].total_prix_total_ttc);
                                            }
                                            
                                        
                                      
                                        document.querySelector('#'+mois_bilan[j].mois).querySelectorAll('td')[5].innerHTML = formatter.format( parseFloat(totales_enc[i].total_prix_total_ttc).toFixed(2) );
                                        document.querySelector('#'+mois_bilan[j].mois).querySelectorAll('td')[5].style.backgroundColor = '#10a50061';

            
                                        inside++;
                                     
                                    }
                            }
            
                            if(inside == 0)
                                {
                                    data_all[j].total_enc =  parseFloat(data_all[j].total_enc);
            
                                    if(mois_bilan[j].val == '01')
                                        {
                                            data_all[j].cumul_enc =  0;
                                        }
                                        else
                                        {
                                            data_all[j].cumul_enc = data_all[j-1].cumul_enc +  0 + parseFloat(data_all[j].total_enc);
                                        }

                                        document.querySelector('#'+mois_bilan[j].mois).querySelectorAll('td')[5].style.backgroundColor = '#10a50061';

                                }
                                inside = 0;
            
            
            
                                document.querySelector('#'+mois_bilan[j].mois).querySelectorAll('td')[6].innerHTML = formatter.format(data_all[j].cumul_enc.toFixed(2));
                                document.querySelector('#'+mois_bilan[j].mois).querySelectorAll('td')[6].style.backgroundColor = '#10a50061';

            
            
                    }




               // ++++++++++++++++++++++++++++++++++++++++++ Encaissement ++++++++++++++++++++++++++++++++++++++++++++ //
                // ++++++++++++++++++++++++++++++++++++++++++ Encaissement ++++++++++++++++++++++++++++++++++++++++++++ //
                 // ++++++++++++++++++++++++++++++++++++++++++ Encaissement ++++++++++++++++++++++++++++++++++++++++++++ //



                var total_salle = 0;
                var total_tech = 0;
                var total_sup =0;
                var total_enc = 0;
                var total_imp = 0;
                var total_perc_enc = 0 ;
                var total_perc_imp = 0 ;
              
                
                 for(let j = 0 ; j < data_all.length ; j++ )
                {
                    data_all[j].total_imp = data_all[j].supliment+ data_all[j].salle + data_all[j].tech - data_all[j].total_enc;


                     total_salle +=  data_all[j].salle;
                     total_tech +=  data_all[j].tech;
                     total_sup += data_all[j].supliment;
                     total_enc +=  data_all[j].total_enc;
                     total_imp +=  data_all[j].total_imp;


                  
                       if(data_all[j].total > 0)
                        {
                            data_all[j].per_enc =  data_all[j].total_enc * 100 / data_all[j].total;
                            data_all[j].per_imp =  data_all[j].total_imp * 100 / data_all[j].total;
                        }
                

                     if(data_all[j].mois_bilan.val == '01')
                        {
                            data_all[j].cumul_imp =  data_all[j].salle + data_all[j].tech - data_all[j].total_enc;
                        }
                        else
                        {
                            data_all[j].cumul_imp = data_all[j-1].cumul_imp +  data_all[j].total_imp ;
                        }

                        document.querySelector('#'+data_all[j].mois_bilan.mois).querySelectorAll('td')[8].innerHTML = formatter.format(data_all[j].total_imp.toFixed(2));
                        document.querySelector('#'+data_all[j].mois_bilan.mois).querySelectorAll('td')[8].style.backgroundColor = '#e2282861';
                        document.querySelector('#'+data_all[j].mois_bilan.mois).querySelectorAll('td')[9].innerHTML = formatter.format(data_all[j].cumul_imp.toFixed(2));
                        document.querySelector('#'+data_all[j].mois_bilan.mois).querySelectorAll('td')[9].style.backgroundColor = '#e2282861';


                        document.querySelector('#'+data_all[j].mois_bilan.mois).querySelectorAll('td')[7].innerHTML = formatter.format(data_all[j].per_enc.toFixed(2)) + ' %';
                        document.querySelector('#'+data_all[j].mois_bilan.mois).querySelectorAll('td')[7].style.backgroundColor = '#10a50061';
                        document.querySelector('#'+data_all[j].mois_bilan.mois).querySelectorAll('td')[10].innerHTML = formatter.format(data_all[j].per_imp.toFixed(2)) + ' %';
                        document.querySelector('#'+data_all[j].mois_bilan.mois).querySelectorAll('td')[10].style.backgroundColor = '#e2282861';

                   
                }

                 total_all_ch = total_salle + total_tech;
                if(total_all_ch> 0)
                    {
                         total_perc_enc = total_enc * 100  / total_all_ch ;
                         total_perc_imp =  total_imp * 100  / total_all_ch;
                    }

                    document.querySelector('#totale').querySelectorAll('td')[0].innerHTML = formatter.format(total_salle.toFixed(2)) ;
                    document.querySelector('#totale').querySelectorAll('td')[0].style.backgroundColor = '#ffff0087';


                    document.querySelector('#totale').querySelectorAll('td')[1].innerHTML = formatter.format(total_tech.toFixed(2)) ;
                    document.querySelector('#totale').querySelectorAll('td')[1].style.backgroundColor = '#ffff0087';

                    document.querySelector('#totale').querySelectorAll('td')[2].innerHTML = formatter.format(total_sup.toFixed(2)) ;
                    document.querySelector('#totale').querySelectorAll('td')[2].style.backgroundColor = '#ffff0087';
                    document.querySelector('#totale').querySelectorAll('td')[3].innerHTML = formatter.format(total_all_ch.toFixed(2)) ;
                    document.querySelector('#totale').querySelectorAll('td')[3].style.backgroundColor = '#ffff0087';


                    document.querySelector('#totale').querySelectorAll('td')[5].innerHTML = formatter.format(total_enc.toFixed(2)) ;
                    document.querySelector('#totale').querySelectorAll('td')[5].style.backgroundColor = '#10a50061';

                    document.querySelector('#totale').querySelectorAll('td')[7].innerHTML = formatter.format(total_perc_enc.toFixed(2)) + ' %';
                    document.querySelector('#totale').querySelectorAll('td')[7].style.backgroundColor = '#10a50061';


                    document.querySelector('#totale').querySelectorAll('td')[8].innerHTML = formatter.format(total_imp.toFixed(2)) ;
                    document.querySelector('#totale').querySelectorAll('td')[8].style.backgroundColor = '#e2282861';

                    document.querySelector('#totale').querySelectorAll('td')[10].innerHTML = formatter.format(total_perc_imp.toFixed(2)) + ' %';
                    document.querySelector('#totale').querySelectorAll('td')[10].style.backgroundColor = '#e2282861';



                    

              

        console.log(data_all);




}

