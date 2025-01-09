<?php         
session_start();
if (!isset($_SESSION['id_user'])) {
    include("../Ressources/se_connecter.php");
    exit();
}
include '../Ressources/header.php';


function int2str($a){
    $convert = explode('.',$a);
    if (isset($convert[1]) && $convert[1]!=''){
    return int2str($convert[0]).' Dirhams'.' et '.int2str($convert[1]).' Centimes' ;
    }
    if ($a<0) return 'moins '.int2str(-$a);
    if ($a<17){
    switch ($a){
    case 0: return 'zero';
    case 1: return 'un';
    case 2: return 'deux';
    case 3: return 'trois';
    case 4: return 'quatre';
    case 5: return 'cinq';
    case 6: return 'six';
    case 7: return 'sept';
    case 8: return 'huit';
    case 9: return 'neuf';
    case 10: return 'dix';
    case 11: return 'onze';
    case 12: return 'douze';
    case 13: return 'treize';
    case 14: return 'quatorze';
    case 15: return 'quinze';
    case 16: return 'seize';
    }
    } else if ($a<20){
    return 'dix-'.int2str($a-10);
    } else if ($a<100){
    if ($a%10==0){
    switch ($a){
    case 20: return 'vingt';
    case 30: return 'trente';
    case 40: return 'quarante';
    case 50: return 'cinquante';
    case 60: return 'soixante';
    case 70: return 'soixante-dix';
    case 80: return 'quatre-vingt';
    case 90: return 'quatre-vingt-dix';
    }
    } elseif (substr($a, -1)==1){
    if( ((int)($a/10)*10)<70 ){
    return int2str((int)($a/10)*10).'-et-un';
    } elseif ($a==71) {
    return 'soixante-et-onze';
    } elseif ($a==81) {
    return 'quatre-vingt-un';
    } elseif ($a==91) {
    return 'quatre-vingt-onze';
    }
    } elseif ($a<70){
    return int2str($a-$a%10).'-'.int2str($a%10);
    } elseif ($a<80){
    return int2str(60).'-'.int2str($a%20);
    } else{
    return int2str(80).'-'.int2str($a%20);
    }
    } else if ($a==100){
    return 'cent';
    } else if ($a<200){
    return int2str(100).' '.int2str($a%100);
    } else if ($a<1000){
    return int2str((int)($a/100)).' '.int2str(100).' '.int2str($a%100);
    } else if ($a==1000){
    return 'mille';
    } else if ($a<2000){
    return int2str(1000).' '.int2str($a%1000).' ';
    } else if ($a<1000000){
    return int2str((int)($a/1000)).' '.int2str(1000).' '.int2str($a%1000);
    }
    else if ($a==1000000){
    return 'millions';
    }
    else if ($a<2000000){
    return int2str(1000000).' '.int2str($a%1000000).' ';
    }
    else if ($a<1000000000){
    return int2str((int)($a/1000000)).' '.int2str(1000000).' '.int2str($a%1000000);
    }
}

?>

<style>
.tab_devis td {
    font-size: 15px !important;
    font-weight: 500 !important;
}

@media print {
    .myDivToPrint {
      display: none;
    }
    .etape_3
    {
        min-width:900px !important; 
        max-width:900px !important;
         margin-top: -30px;
    }
    .le_devis
    {
        background-color: #a8d08d !important;
        print-color-adjust: exact; 
    }
    .salles_espaces
    {
        background-color: #a8d08d !important;
        print-color-adjust: exact; 
    }
    .tab_devis td {
    font-size: 17px !important;
    font-weight: 500 !important;
    }
    .range_d
    {
        font-size: 17px !important;
    }
    .logo_imp
    {
        width: 180px !important;
    }
}
@page { size:  auto; margin: 100px;   }

</style>
<script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>

<body>
<div class="container myDivToPrint">
   <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 justfy_centre">
             <button id="print-pdf"  class="btn notika-btn-deeppurple btn-reco-mg btn-button-mg" style="color:white !important; float: right;   margin-top: 12px; width: 100%; background: chocolate;" >Imprimer <?php echo isset($_GET['De_Fa']) ? $_GET['De_Fa'] : ''; ?></button>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 justfy_centre">
            <button id="generate-pdf"  class="btn notika-btn-deeppurple btn-reco-mg btn-button-mg" style="color:white !important; float: right;   margin-top: 12px; width: 100%; " >Telecharger <?php echo isset($_GET['De_Fa']) ? $_GET['De_Fa'] : ''; ?></button>
        </div>
   </div>
</div>
<br/>
<div class="container etape_3" id="etape_3" style="padding: 13px;background: white; box-shadow: 0 2px 5px rgba(0,0,0,.16), 0 2px 10px rgba(0,0,0,.12); min-width:1170px;" >
        <div class="breadcomb-report">
            <?php if (isset($_GET['De_Fa'])) : ?>
                <button data-toggle="tooltip" id="edit_open_doc" onclick="edit_entete_doc()" data-placement="left" title="Éditer l'entête" class="btn">
                    <i class="notika-icon notika-edit"></i>
                </button>
                <button data-toggle="tooltip" id="edit_close_doc" style="display:none; background:red;" onclick="terminer_edit_entete_doc()" data-placement="left" title="Terminer l'édition" class="btn">
                    <i class="notika-icon notika-close"></i>
                </button>
            <?php endif; ?>
        </div>
        <div id="journee_du" style="width: 164px; position: absolute;font-size: small; font-weight: 900; " >
        <?php  if($_GET['De_Fa'] !=  'Devis')
                    {
                       echo '<div>
                         SOPHATOUR<br>
                         Filiale d\'Union Holding
                       </div>';
                    }
         ?>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 justfy_centre">
                <img src="../Ressources/entreprise_logo/logo (1).png"  class="logo_imp" style="width: 12%;"/>
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
                        <input type="date" class="form-control" id="input_date_de_devis_01" value="<?php echo isset($client_devis['le_devis']) ? $client_devis['le_devis'] : ''; ?>" onchange="update_devis_field(this, 'date_devis' , '<?php echo $_GET['De_Fa']; ?>')">
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 justfy_centre">
                <div class="le_devis">
                <div id="value_numero_devis">
                 <?php echo  isset($_GET['Proformat']) ? 'Facture PROFORMA ' . $_GET['numero_devis']  : (isset($_GET['De_Fa']) ? $_GET['De_Fa'] . ' Nº: ' .$_GET['numero_devis'] : ''); ?>
                    </div>
                </div>
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-lg-=5 col-md-5 col-sm-5 col-xs-5 ">
                <div class="head_devis" >
                    <div id="a_devis_value">
                        A : <?php echo isset($client_devis['a_devis']) ? $client_devis['a_devis'] : '________'; ?>
                    </div>
                    <div id="a_devis_input" style="display:none;">
                        <div class="nk-int-st">
                            A : <input type="text" class="form-control" id="a_devis_field" value="<?php echo isset($client_devis['a_devis']) ? $client_devis['a_devis'] : '' ?>" onchange="update_devis_field(this, 'a_devis' , '<?php echo $_GET['De_Fa']; ?>')">
                        </div>
                    </div>
                    <div id="objet_value">
                        Objet : ____________
                    </div>
                            
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 ">
            </div>
         
            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 ">
            <?php  if($_GET['De_Fa'] ==  'Devis')
                    {
                        echo '  <div class="head_devis" id="head_devis_right" style="text-align: right;">
                        Votre contrat au Palais des Congres Rabat Bouregreg
                        <br>
                    M. <span style="font-weight: 700;">'. $_SESSION['nom'] . ' ' .  $_SESSION['prenom'] .'</span>  Tel : <span style="font-weight: 700;"> ' .$_SESSION['telephone'] .'</span>
                        </div>';
                    }
            ?>
            
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 justfy_centre table_to_append">
            
            </div>
        </div>
        <br/>
        <br/>
        <?php   
                 if($_GET['De_Fa'] ==  'Devis')

                    {
                        echo '<p style="border: 1px solid #a8d08d; font-size:small; padding:5px;" class="range_d" > Nous restons à votre disposition pour toute information complémentaire et Afin de confirmer la réservation, nous vous prions de bien vouloir nous retourner l\'offie signée et cachetée avec mention " BON POUR ACCORD ET EXECUTION DU DEVIS </p> ';
                    

                        echo '<p style="border: 1px solid #a8d08d; font-size:small; padding:5px;" class="range_d" > Modalités de Paiement: 50 % du montant à la confirmation et 50 % 7 jours avant l\'évènement </p> ';

                        echo '<p style="border: 1px solid #a8d08d; font-size:small; padding:5px;" class="range_d" > Condition de Paiement: Selon Contrat et en commun accord avec le client </p> ';
                    
                    
                    }
                    else
                    {
                     
                       echo'<p style="border: 1px solid #a8d08d; font-size:small;   padding:5px;  background-color: #ffffff !important; print-color-adjust: exact;  padding:5px;" class="range_d" >OBSERVATION :<span id="chiffre_all" style ="font-weight: 600;"></span> </p> ';
                        
                        echo '<p style="border: 1px solid #a8d08d; font-size:small;   padding:5px;  background-color: #a8d08d !important; print-color-adjust: exact;  padding:5px;" class="range_d" >Arrêter le montant à la somme de <span id="chiffre_all" style ="font-weight: 600;">'.int2str(number_format($_GET['prix_ttc'], 2, '.', '')).'</span> Dirhams TTC </p> ';

                        echo '<p style="border: 1px solid #a8d08d; font-size:small;  padding:5px;" class="range_d" > Modalités de Paiement: 50 % du montant à la confirmation et 50 % 7 jours avant l\'évènement </p> ';

                        echo '<p style="border: 1px solid #a8d08d; font-size:small; padding:5px;" class="range_d" > Condition de Paiement: Selon Contrat et en commun accord avec le client </p> ';
                    }
            ?>
            
        <br/>
        <br/>

     
</div>

</body>
<?php         
include '../Ressources/footer.php';
?>
<script src="https://rawgit.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
<script src="./update_document/document.js"></script>
<script>



    var numero_devis_facture = "<?php echo isset($_GET['numero_devis']) ? $_GET['numero_devis'] : ''; ?>";
    var id_client = <?php echo isset($_GET['id_client']) ? $_GET['id_client'] : ''; ?>;
    var version = <?php echo isset($_GET['version']) ? $_GET['version'] : '0'; ?>;
    var devis_facture = "<?php echo isset($_GET['De_Fa']) ? $_GET['De_Fa'] : ''; ?>";



    function renderContent(divId) {
            var element = document.getElementById(divId);
            var pdfPreviewIframe = document.getElementById('pdf-preview-iframe');

            element.style.overflow = "hidden";

            // Generate PDF and display the preview in the iframe
            html2pdf(element, {
                margin: [5, 5],
                filename: numero_devis_facture + '.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 3, width: 1170, dpi: 300 },
                jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' },
                callback: function (pdf) {
                  // Convert PDF to data URL
                    var pdfDataUrl = pdf.output('datauristring');

                    // Create an iframe with the PDF as the source
                    var iframe = document.createElement('iframe');
                    iframe.src = pdfDataUrl;
                    iframe.style.display = 'none';
                    document.body.appendChild(iframe);

                    // Wait for the iframe to load and then trigger print
                    iframe.onload = function () {
                        iframe.contentWindow.print();

                        // Remove the iframe after printing
                        document.body.removeChild(iframe);
                    };
                }
            });
        }


        

        document.getElementById('generate-pdf').addEventListener('click', function () {
            // Cacher le bouton d'édition avant le téléchargement
            const editButton = document.getElementById('edit_open_doc');
            if (editButton) {
                editButton.style.display = 'none';
            }
        
            // Appeler la fonction pour générer le PDF
            renderContent('etape_3');
        
            // Réafficher le bouton d'édition après un délai pour s'assurer que le PDF est généré
            setTimeout(() => {
                if (editButton) {
                    editButton.style.display = 'inline-block';
                }
            }, 1000); // Ajustez le délai si nécessaire
        });


        document.getElementById('print-pdf').addEventListener('click', function () {
          
            window.print();
        });







    var client_devis_factrue_client ;

     var client_devis ;

     var client_ligne_devis_1 = [];
     var client_ligne_devis_2 = [];
     var client_ligne_devis_3 = [];

     var ligneSallesEspaces =  1 ;
     var ligneTechReg =  1 ;
     var ligneSupplementaire = 1;

  // Make a GET request to retrieve data
  fetch('../Controllers/get_document.php?numero_devis_facture='+numero_devis_facture+'&id_client='+id_client+'&version='+version+'&devis_facture='+devis_facture, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);

            // Assuming the returned data structure matches your variable structures
            client_devis_factrue_client = data.client_devis_factrue_client;
        
                client_devis_factrue_client = data.client_devis_factrue_client;
                client_devis_factrue_client.id_client_devis = '';
                client_devis_factrue_client.version_devis = parseInt(client_devis_factrue_client.version_devis) + 1;
            
            client_devis = data.client_devis;
            client_ligne_devis_1 = data.client_ligne_devis_1;
            client_ligne_devis_2 = data.client_ligne_devis_2;
            client_ligne_devis_3 = data.client_ligne_devis_3;
            ligneSallesEspaces = client_ligne_devis_1.length == 0 ? 1 : client_ligne_devis_1.length;
            ligneTechReg = client_ligne_devis_2.length == 0 ? 1 : client_ligne_devis_2.length;
            ligneSupplementaire = client_ligne_devis_3.length == 0 ? 1 : client_ligne_devis_3.length;
           
            console.log("Data pour document : ");
            console.log(client_devis);

            // client_devis.du_date =  DateToValueFromDate(new Date(client_devis.du_date));
            // client_devis.a_tel_date =  DateToValueFromDate(new Date(client_devis.a_tel_date));
           
            
           // console.log('date ' + client_devis);
            
            $("#objet_value").text('Objet : ' +  client_devis.objet ); 
            console.log(DateToValueFromDate(new Date(client_devis.du_date)));
            $("#Du").val(DateToValueFromDate(new Date(client_devis.du_date)));
            $("#au").val(DateToValueFromDate(new Date(client_devis.a_tel_date)));
            console.log('date ' + client_devis.le_devis);
            $("#input_date_de_devis_01").val(DateToValueFromDate(new Date(client_devis.le_devis)));
            $("#value_date_de_devis").text('LE ' + DateToValueFromDate(new Date(client_devis.le_devis)));


            document.getElementById("a_devis_value").innerText = 'A : ' + ((client_devis.a_devis == null ||  client_devis.a_devis == '') ? "<?php echo $_GET["societe"]; ?>" : client_devis.a_devis);
            console.log(client_devis);
            $("#a_devis_field").attr("value", client_devis.a_devis);

            console.log("pre-inverse : " + client_devis.le_devis);
            client_devis.du_date = inverseFormeDate(client_devis.du_date);
            client_devis.a_tel_date = inverseFormeDate(client_devis.a_tel_date);
            //client_devis.le_devis = inverseFormeDate(client_devis.le_devis);
            console.log("post-inverse : " + client_devis.le_devis);


          
            changetable( 0, 0, 0 );
            


            // Now you can use the retrieved data as needed
            // For example, you can update the UI or perform other operations
        })
        .catch((error) => {
            console.error('Error fetching data:', error);
        });


        function DateToValue()
       {
           var currentDate = new Date();
    
           var day = currentDate.getDate();
           var month = currentDate.getMonth() + 1; 
           var year = currentDate.getFullYear();
    
    
           var formattedDate = (month < 10 ? '0' : '') + month + '/' + (day < 10 ? '0' : '') + day + '/' + year;
           return formattedDate;
    
       }
   
   
   
   
       //Convertir la date de "MM/DD/YYYY" -> "DD/MM/YYYY" 
       function convertDateFormat(inputDate) {
        // Split the date into components using "/"
        var dateComponents = inputDate.split('/');
    
        // Rearrange the components to the "DD/MM/YYYY" format
        var outputDate = dateComponents[1] + '/' + dateComponents[0] + '/' + dateComponents[2];
    
        return outputDate;
    }
  


        function DateToValueFromDate(currentDate)
            {
                var day = currentDate.getDate();
                var month = currentDate.getMonth() + 1; 
                var year = currentDate.getFullYear();


                var formattedDate =  (day < 10 ? '0' : '') + day + '/' + (month < 10 ? '0' : '') + month +  '/' + year;
                return formattedDate;

            }

            function inverseFormeDate(dateString)
            {
                const dateObject = new Date(dateString);

                // Obtention des composants de la date
                const year = dateObject.getFullYear();
                const month = String(dateObject.getMonth() + 1).padStart(2, '0'); // Mois commence à 0
                const day = String(dateObject.getDate()).padStart(2, '0');

                // Formatage de la date en "28/05/2005"
                const formattedDate = `${day}/${month}/${year}`;
                return formattedDate
            }

    function changetable(SallesEspaces,TechReg, Supp, index) {
        //    if(content != null)
        //    {
        //         client_devis_factrue_client = content.client_devis_factrue_client;
        //         client_devis = content.client_devis;
        //         client_ligne_devis_1 = content.client_ligne_devis_1;
        //         client_ligne_devis_2 = content.client_ligne_devis_2;
        //    }
           if((ligneSallesEspaces > 1 && SallesEspaces < 0) || ( SallesEspaces > 0))
           ligneSallesEspaces = ligneSallesEspaces + SallesEspaces;
          
           if(SallesEspaces < 0)
           {
            delete_ligne_devis_1(index);
           }
           
           if((ligneTechReg > 1 && TechReg < 0) || ( TechReg > 0))
           ligneTechReg = ligneTechReg + TechReg;


           if(TechReg < 0)
           {
            delete_ligne_devis_2(index);
           }

           if((ligneSupplementaire > 1 && Supp < 0) || ( Supp > 0))
           ligneSupplementaire = ligneSupplementaire + Supp;


           if(Supp < 0)
           {
            delete_ligne_devis_3(index);
           }

           var sommeTotalHT = 0;
           for(var i = 0 ; i < ligneSallesEspaces ; i++) 
           {
                if(client_ligne_devis_1.length > i)
                {
                    sommeTotalHT += parseFloat(client_ligne_devis_1[i].pt_ht);
                }
           
           }
           console.log(sommeTotalHT);
           for(var i = 0 ; i < ligneTechReg ; i++) 
           {
                if(client_ligne_devis_2.length > i)
                {
                    sommeTotalHT += parseFloat(client_ligne_devis_2[i].pt_ht);
                }
           }

           console.log(sommeTotalHT);
           for(var i = 0 ; i < ligneSupplementaire ; i++) 
           {
                if(client_ligne_devis_3.length > i)
                {
                    sommeTotalHT += parseFloat(client_ligne_devis_3[i].pt_ht);
                }
           }

           var sommeTva = sommeTotalHT != 0 ?  sommeTotalHT * (parseInt( client_devis.TVA.toString().split(' ').length > 0  ? client_devis.TVA.toString().split(' ')[0] : client_devis.TVA )/100) : 0;
        
         

         console.log('hii')
           console.log(client_ligne_devis_2)
           
       

            var body =  `<table class="tab_devis" style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th>Journée du</th>
                            <th style="width: 50%;">Désignation</th>
                            <th>Unité</th>
                            <th   style="width: 7%;">Nbre d'article</th>
                            <th>PU/HT</th>
                            <th>PT/HT</th>
                            <!-- <th style="background-color: #a8d08d; border-bottom: none;"></th> -->
                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6" class="salles_espaces" style="border-top: none;"> Désignation </td>
                        </tr>`;
                      
                        for(var i = 0 ; i < ligneSallesEspaces ; i++) 
                        {  
                            body += `<tr>`
                            if(i == 0)     
                            {
                                // body += `<td style="height:${ligneSallesEspaces * 90}px; width: 100px;" rowspan="${ligneSallesEspaces}">   
                                body += `<td style="height:90px; width: 100px; border-bottom:none;" >   
                                        Du ${client_devis.du_date} <br/>au ${ client_devis.a_tel_date}
                                        </td>`;
                            }
                            else 
                            {
                                body += `<td style="height:120px; width: 100px; border-top:none; border-bottom:none;" >   
                                        </td>`;
                            
                            }
                            
                            if(client_ligne_devis_1.length > i)
                            {
                                body += `<td >
                                         ${client_ligne_devis_1[i].prestation}
                                        </td>
                                        <td>
                                        ${client_ligne_devis_1[i].unite}
                                        </td>
                                        <td>
                                        ${client_ligne_devis_1[i].nbr_jour}
                                        </td>
                                        <td>
                                        ${client_ligne_devis_1[i].pu_ht}
                                        </td>
                                        <td>    
                                        ${client_ligne_devis_1[i].pt_ht}
                                        </td>
                                     
                                    </tr>`;
                            }
                            else
                            {
                                body +=  `<td >
                                          <div class="cmp-tb-hd bsc-smp-sm">
                                        
                                        <div class="text_align_center">
                                        </div>
                                        <div class="html-editor-click">
                                            
                                        </div> 
                                        </td>
                                        <td>
                                        
                                        </td>
                                        <td>
                                            
                                        </td>
                                        <td>
                                            
                                        </td>
                                        <td>    
                                        
                                        </td>
                                      
                                        </tr>`;
                            }
                        }
                       
                        if(client_ligne_devis_2.length > 0)
                        {
                            body += `<tr>
                            <td colspan="6" class="salles_espaces">TECHNICIENS & RÉGISSEURS</td>
                                </tr>`;
                                for(var i = 0 ; i < ligneTechReg ; i++) 
                                {
                                
                                    body +=`<tr>`;
                                    if(i == 0)     
                                    {
                                           //body += ` <td style="height:${ligneTechReg * 90}px; width:100px;" rowspan="${ligneTechReg}">

                                            body += ` <td style="height:120px; width:100px; border-bottom:none;" >
                                            Du ${client_devis.du_date} <br/>au ${ client_devis.a_tel_date}
                                            </td>`;
                                    }
                                    else 
                                    {
                                        body += `<td style="height:90px; width: 100px; border-top:none; border-bottom:none;" >   
                                                </td>`;
                                    
                                    }
                                    if(client_ligne_devis_2.length > i)
                                    {
                                        body += `<td >
                                                ${client_ligne_devis_2[i].prestation}
                                                </td>
                                                <td>
                                                ${client_ligne_devis_2[i].unite}
                                                </td>
                                                <td>
                                                ${client_ligne_devis_2[i].nbr_jour}
                                                </td>
                                                <td>
                                                ${client_ligne_devis_2[i].pu_ht}
                                                </td>
                                                <td>    
                                                ${client_ligne_devis_2[i].pt_ht}
                                                </td>
                                            
                                            </tr>`;
                                    }
                                    else
                                    {
                                        body +=  `<td >
                                                <div class="cmp-tb-hd bsc-smp-sm">
                                                
                                                <div class="text_align_center">
                                                </div>
                                                <div class="html-editor-click">
                                                    
                                                </div> 
                                                </td>
                                                <td>
                                                
                                                </td>
                                                <td>
                                                    
                                                </td>
                                                <td>
                                                    
                                                </td>
                                                <td>    
                                                
                                                </td>
                                            
                                            </tr>`;
                                    }
                                
                                }
                            }
                        if(client_ligne_devis_3.length > 0)
                        {
                            console.log("Len 3eme ligne devis ", client_ligne_devis_3.length);
                            body += `<tr>
                            <td colspan="6" class="salles_espaces">PRESTATIONS SUPPLÉMENTAIRES</td>
                                </tr>`;
                                for(var i = 0 ; i < ligneSupplementaire ; i++) 
                                {
                                    console.log("L'iterateur i ",i);
                                    
                                    body +=`<tr>`;
                                    if(i == 0)     
                                    {
                                           //body += ` <td style="height:${ligneTechReg * 90}px; width:100px;" rowspan="${ligneTechReg}">

                                            body += ` <td style="height:120px; width:100px; border-bottom:none;" >
                                            Du ${client_devis.du_date} <br/>au ${ client_devis.a_tel_date}
                                            </td>`;
                                    }
                                    else 
                                    {
                                        body += `<td style="height:90px; width: 100px; border-top:none; border-bottom:none;" >   
                                                </td>`;
                                    
                                    }
                                    if(client_ligne_devis_3.length > i)
                                    {
                                        body += `<td >
                                                ${client_ligne_devis_3[i].prestation}
                                                </td>
                                                <td>
                                                ${client_ligne_devis_3[i].unite}
                                                </td>
                                                <td>
                                                ${client_ligne_devis_3[i].nbr_jour}
                                                </td>
                                                <td>
                                                ${client_ligne_devis_3[i].pu_ht}
                                                </td>
                                                <td>    
                                                ${client_ligne_devis_3[i].pt_ht}
                                                </td>
                                            
                                            </tr>`;
                                    }
                                    else
                                    {
                                        body +=  `<td >
                                                <div class="cmp-tb-hd bsc-smp-sm">
                                                
                                                <div class="text_align_center">
                                                </div>
                                                <div class="html-editor-click">
                                                    
                                                </div> 
                                                </td>
                                                <td>
                                                
                                                </td>
                                                <td>
                                                    
                                                </td>
                                                <td>
                                                    
                                                </td>
                                                <td>    
                                                
                                                </td>
                                            
                                            </tr>`;
                                    }
                                
                                }
                            }
                        

                        body +=  `<tr> 
                        <td colspan=5 style="text-align: center;">
                           Total Séminaire Restauration HT
                        </td>        
                             
                        <td>    
                              ${sommeTotalHT.toFixed(2)}  
                        </td>
                     
                        </tr>`;


                        body +=  `<tr> 
                        <td colspan=5 style="text-align: center;">
                          TVA  ${client_devis.TVA} %  
                        </td>        
                             
                        <td>    
                              ${sommeTva.toFixed(2)}  
                        </td>
                    
                        </tr>`;

                        body +=  `<tr> 
                        <td colspan=5 style="text-align: center;">
                          Total Séminaire TTC
                        </td>        
                       
                        <td>    
                              ${parseFloat(client_devis_factrue_client.prix_total_ttc).toFixed(2)}  
                        </td>
                      
                        </tr>`;

                        body +=`</tbody>
                            </table>`;
                  $(".table_to_append").text('');
                  $(".table_to_append").append(body);




                  

            }
         

</script>

