
$(document).ready(function() {

    var societe = document.getElementsByName('societe')[0].content;
    var devis_version = document.getElementsByName('devis_version')[0].content;

    var id_user = document.getElementsByName('id_user')[0].content;
    var numero_facture = document.getElementsByName('numero_facture')[0].content;
    var numero_devis = document.getElementsByName('numero_devis')[0].content;

    //var id_client_facture =  document.getElementsByName('id_client_facture')[0].content;
    var  id_client_devis = document.getElementsByName('id_client_devis')[0].content;
    var De_Fa = document.getElementsByName('De_Fa')[0].content;




    console.log('societe : ' + societe);
    console.log('id_user : ' + id_user);
    if(societe == '')
    {
        $("#etape_1").show();
        $("#etape_2").hide();
        $("#etape_3").hide();
        $("#etape_3_button").hide();

 
        //older-event selected
        $('#choix_client').addClass('older-event');
        $('#choix_client').toggleClass('selected');
        $('.filling-line').css('transform', 'scaleX(0.281506)');

        
        $('.filling-line').css('transform', 'scaleX(0.09)');

       
    }
    else if(devis_version == '' && id_client_devis == '')
    {
        
        $("#etape_1").hide();
        $("#etape_2").show();
        $("#etape_3").hide();
        $("#etape_3_button").hide();

        $('#choix_client').toggleClass('selected');

        $('#choix_client').addClass('older-event');
        $('#choix_devis').toggleClass('selected');

        
        $('.filling-line').css('transform', 'scaleX(0.19)');

        $('#value_numero_devis').addClass('older-event');
        


    }
    else
    {
        $("#etape_1").hide();
        $("#etape_2").hide();
        $("#etape_3").show();
        $("#etape_3_button").show();

        $('#choix_client').addClass('older-event');
        $('#choix_client').addClass('selected');

        $('#choix_devis').addClass('older-event');
        $('#choix_devis').addClass('selected');

        $('#creer_facture_devis').addClass('selecteolder-eventd');
        $('#creer_facture_devis').addClass('selected');
        
        $('.filling-line').css('transform', 'scaleX(0.29)');


       
       if (!numero_facture) {
           $("#value_numero_devis").text(De_Fa +' Nº: ' + numero_devis); 
       }else{
           $("#value_numero_devis").text(De_Fa +' Nº: ' + numero_facture); 
       }


    }

   $('#Nouveau_devis_sans_choix').click(function() {

       devis = 'new';
       $("#etape_1").hide();
       $("#etape_2").hide();
       $("#etape_3").show();
       $("#etape_3_button").show();


       $('#choix_devis').addClass('older-event');

       $('#creer_facture_devis').addClass('older-event');
       $('#creer_facture_devis').toggleClass('selected');


       $('.filling-line').css('transform', 'scaleX(0.29)');

   });

   if(numero_devis == '')
   {
    $("#Du").val(DateToValue());
    $("#au").val(DateToValue());
    $("#input_date_de_devis_01").val(DateToValue());
    $("#value_date_de_devis").text('LE ' + convertDateFormat(DateToValue()));
   }



   //Initialiser la date sous la forme MM/DD/YYYY
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
  


    
});



//Assurer la forme 0D/0M/YYYY
function DateToValueFromDate(currentDate)
{
    var day = currentDate.getDate();
    var month = currentDate.getMonth() + 1; 
    var year = currentDate.getFullYear();


    var formattedDate =  (day < 10 ? '0' : '') + day + '/' + (month < 10 ? '0' : '') + month +  '/' + year;
    return formattedDate;

}



// .filling-line

var id_user = document.getElementsByName('id_user')[0].content;
var id_societe = document.getElementsByName('id_societe')[0].content;
var De_Fa = document.getElementsByName('De_Fa')[0].content;
var id_client_devis =  document.getElementsByName('id_client_devis')[0].content;
var id_client_facture =  document.getElementsByName('id_client_facture')[0].content;
var id_client =  document.getElementsByName('id_client')[0].content;
var numero_facture = document.getElementsByName('numero_facture')[0].content;
var numero_devis = document.getElementsByName('numero_devis')[0].content;
var devis_version = document.getElementsByName('devis_version')[0].content;
var societe = document.getElementsByName('societe')[0].content;
var id_client_devis = document.getElementsByName('id_client_devis')[0].content;

console.log("societe id : ", id_societe);

    var client_devis_factrue_client = De_Fa == "Devis" ?  {
        'id_client_devis' : '',
        'id_client' : id_client,
        'utilisateurs' : id_user,
        'version_devis' : devis_version == '' ? '1' : devis_version+1,
        'Numero_devis' : numero_devis == '' ? '' : numero_devis,
        'prix_total_ttc' : ''
     } :  {
        'id_client_Facture' : id_client_facture || '',
        'id_client_devis' : '',
        'id_client' : id_client,
        'utilisateurs' : id_user,
        'Numero_Facture' : numero_facture || '',
        'prix_total_ttc' : ''
     };

     //preparation d'un devis
     var client_devis = {
        'le_devis' : new Date(),
        'a_devis' : '',
        'objet' : '',
        'date_d_entree' : new Date(),
        'du_date' : '',
        'a_tel_date' : '',
        'TVA' : '',
        'devis_objet' : ''
     };

     var client_ligne_devis_1 = [];
     var client_ligne_devis_2 = [];
     var client_ligne_devis_3 = [];

     var ligneSallesEspaces =  1 ;
     var ligneTechReg =  1 ;
     var ligneSupplementaires = 1;
     console.log(numero_devis);
   



     if( De_Fa == "Facture" )
     {
        $('#head_devis_right').hide();
        client_devis_factrue_client.id_client_devis = id_client_devis;
     }


    function edit_entete()
    {
        $("#edit_open").hide(); 
        $("#edit_close").show(); 

        if(numero_devis == '' || id_client_devis != '')
        {
            // $("#input_numero_devis").show(); 
            // $("#value_numero_devis").hide(); 
        }

        $("#a_devis_input").show();
        $("#a_devis_value").hide(); 

        // $("#input_date_de_devis").show();
        // $("#value_date_de_devis").hide(); 
        
        $("#objet_input").show();
        $("#objet_value").hide(); 


        $("#journee_du").show();


    }

    function terminer_edit_entete()
    {
        $("#edit_open").show(); 
        $("#edit_close").hide(); 

        $("#input_numero_devis").hide(); 
        $("#value_numero_devis").show(); 

        $("#a_devis_input").hide();
        $("#a_devis_value").show(); 

        $("#input_date_de_devis").hide();
        $("#value_date_de_devis").show(); 


        $("#objet_input").hide();
        $("#objet_value").show(); 


        $("#journee_du").hide();

        changetable(0,0,0);


    }

    function devis_change(element)
    {
        if(element.name == "Numero_devis")
        {
            if( De_Fa == "Devis" )
            {
                client_devis_factrue_client.Numero_devis = element.value;
                $("#value_numero_devis").text(De_Fa +' Nº: ' + client_devis_factrue_client.Numero_devis); 
            }
            else
            {
                client_devis_factrue_client.Numero_Facture = element.value;
                $("#value_numero_devis").text(De_Fa +' Nº: ' + client_devis_factrue_client.Numero_Facture); 
            }
        }
        else if(element.name == "a_devis")
        {
            client_devis.a_devis = element.value;
            $("#a_devis_value").text('A : ' +  client_devis.a_devis ); 
            console.log("valeur modifie : ", client_devis.a_devis);
        }
        else if(element.name == "objet")
        {
            client_devis.devis_objet = element.value.split('---')[0];
            client_devis.objet = element.value.split('---')[1];
            
            $("#objet_value").text('Objet : ' +  element.value.split('---')[1]); 
        } 
        else if(element.name == "du_date")
        {
            client_devis.du_date = convertDateFormat(element.value);
        }  
        else if(element.name == "a_tel_date")
        {
            client_devis.a_tel_date = convertDateFormat(element.value);
        }
        else if(element.name == "TVA")
        {
            console.log(element.value);
            client_devis.TVA = element.value;
        }
        else if(element.name == "input_date_de_devis")
        {
            client_devis.le_devis = convertDateFormat(element.value);
            $("#value_date_de_devis").text('LE ' +  client_devis.le_devis ); 
        }
        console.log(client_devis_factrue_client);
        console.log(client_devis);
      
    }


    function tojsDate(inputDateString)
    {
        // const  Content = inputDateString.split('/')
       // console.log(': : ' + Content.length + '   ' + inputDateString.split('/')[1]);
        if (typeof inputDateString === 'string') 
        {
            var dateComponents = inputDateString.split('/');

            var jsDate = new Date(dateComponents[2], dateComponents[0] - 1, dateComponents[1]);

            return jsDate
        }
        return inputDateString;
    }


    function changeValueOfprestation_salles(element,id)
    {
        var prestation_id = element.value;
        document.querySelector("#" + id + " textarea[name='Prestation']").value = prestation_id.split('---')[1];
    }
    
    function changeValueOfprestation_tech(element,id)
    {
        var prestation_id = element.value;
        document.querySelector("#" + id + " textarea[name='Prestation']").value = prestation_id.split('---')[1];
    }

    function changeValueOfprestation_sup(element,id)
    {
        var prestation_id = element.value;
        document.querySelector("#" + id + " textarea[name='Prestation']").value = prestation_id.split('---')[1];
    }

    var update_ligne = false;
    var index_all = 0;


    function add_ligne_devis(id) {
        // Si on met à jour une ligne existante
        if (update_ligne == true) {
            var prestation_id = document.querySelector("#" + id + " select[name='designation']").value;
            var prestation = document.querySelector("#" + id + " textarea[name='Prestation']").value;
            var unite = document.querySelector("#" + id + " input[name='Unite']").value;
            var pu_ht = document.querySelector("#" + id + " input[name='PU/HT']").value;
            var nbr_jour = document.querySelector("#" + id + " input[name='nbr_jour']").value;
            var client_ligne_devis_type_prestation = document.querySelector("#" + id + " input[name='client_ligne_devis_type_prestation']").value;

            if (client_ligne_devis_type_prestation == 1) {
                client_ligne_devis_1[index_all] = {
                    ...client_ligne_devis_1[index_all],
                    prestation: prestation,
                    unite: unite,
                    nbr_jour: nbr_jour,
                    pu_ht: pu_ht,
                    pt_ht: pu_ht * unite * nbr_jour,
                    client_ligne_devis_type_prestation: client_ligne_devis_type_prestation,
                    ligne_devis_prestation: prestation_id.split('---')[0],
                    more_info: prestation_id,
                };
            } else if (client_ligne_devis_type_prestation == 2) {
                client_ligne_devis_2[index_all] = {
                    ...client_ligne_devis_2[index_all],
                    prestation: prestation,
                    unite: unite,
                    nbr_jour: nbr_jour,
                    pu_ht: pu_ht,
                    pt_ht: pu_ht * unite * nbr_jour,
                    client_ligne_devis_type_prestation: client_ligne_devis_type_prestation,
                    ligne_devis_prestation: prestation_id.split('---')[0],
                    more_info: prestation_id,
                };
            } else if (client_ligne_devis_type_prestation == 3) {
                client_ligne_devis_3[index_all] = {
                    ...client_ligne_devis_3[index_all],
                    prestation: prestation,
                    unite: unite,
                    nbr_jour: nbr_jour,
                    pu_ht: pu_ht,
                    pt_ht: pu_ht * unite * nbr_jour,
                    client_ligne_devis_type_prestation: client_ligne_devis_type_prestation,
                    ligne_devis_prestation: prestation_id.split('---')[0],
                    more_info: prestation_id,
                };
            }

            update_ligne = false;
            index_all = 0;
            changetable(0, 0, 0);
        } 
        // Si on ajoute une nouvelle ligne
        else {
            var prestation_id = document.querySelector("#" + id + " select[name='designation']").value;
            var prestation = document.querySelector("#" + id + " textarea[name='Prestation']").value;
            var unite = document.querySelector("#" + id + " input[name='Unite']").value;
            var pu_ht = document.querySelector("#" + id + " input[name='PU/HT']").value;
            var nbr_jour = document.querySelector("#" + id + " input[name='nbr_jour']").value;
            var client_ligne_devis_type_prestation = document.querySelector("#" + id + " input[name='client_ligne_devis_type_prestation']").value;

            if (client_ligne_devis_type_prestation == 1) {
                client_ligne_devis_1.push({
                    prestation: prestation,
                    unite: unite,
                    nbr_jour: nbr_jour,
                    pu_ht: pu_ht,
                    pt_ht: pu_ht * unite * nbr_jour,
                    client_ligne_devis_type_prestation: client_ligne_devis_type_prestation,
                    client_devis: 'client_devis_ID',
                    ligne_devis_prestation: prestation_id.split('---')[0],
                    more_info: prestation_id,
                });
            } else if (client_ligne_devis_type_prestation == 2) {
                client_ligne_devis_2.push({
                    prestation: prestation,
                    unite: unite,
                    nbr_jour: nbr_jour,
                    pu_ht: pu_ht,
                    pt_ht: pu_ht * unite * nbr_jour,
                    client_ligne_devis_type_prestation: client_ligne_devis_type_prestation,
                    client_devis: 'client_devis_ID',
                    ligne_devis_prestation: prestation_id.split('---')[0],
                    more_info: prestation_id,
                });
            } else if (client_ligne_devis_type_prestation == 3) {
                client_ligne_devis_3.push({
                    prestation: prestation,
                    unite: unite,
                    nbr_jour: nbr_jour,
                    pu_ht: pu_ht,
                    pt_ht: pu_ht * unite * nbr_jour,
                    client_ligne_devis_type_prestation: client_ligne_devis_type_prestation,
                    client_devis: 'client_devis_ID',
                    ligne_devis_prestation: prestation_id.split('---')[0],
                    more_info: prestation_id,
                });
            }

            console.log(client_ligne_devis_1);
            console.log(client_ligne_devis_2);
            console.log(client_ligne_devis_3);

            changetable(0, 0, 0);
        }
    }



    function open_prestation(index, category) {
        console.log(category);

        if (category == "SALLES_ESPACES") {
            var allOptions = document.getElementById('designation_01').options;

            for (var i = 0; i < allOptions.length; i++) {
                if (allOptions[i].value.split('---')[0] == client_ligne_devis_1[index].ligne_devis_prestation) {
                    $("#designation_01").val(allOptions[i].value);
                    break;
                }
            }

            $("#prestation_01").val(client_ligne_devis_1[index].prestation);
            $("#unite_01").val(client_ligne_devis_1[index].unite);
            $("#nbr_jour_01").val(client_ligne_devis_1[index].nbr_jour);
            $("#PU_01").val(client_ligne_devis_1[index].pu_ht);
        } 
        else if (category == "TECHNICIENS_REGISSEURS") {
            var allOptions = document.getElementById('designation_02').options;

            for (var i = 0; i < allOptions.length; i++) {
                if (allOptions[i].value.split('---')[0] == client_ligne_devis_2[index].ligne_devis_prestation) {
                    $("#designation_02").val(allOptions[i].value);
                    break;
                }
            }

            $("#prestation_02").val(client_ligne_devis_2[index].prestation);
            $("#unite_02").val(client_ligne_devis_2[index].unite);
            $("#nbr_jour_02").val(client_ligne_devis_2[index].nbr_jour);
            $("#PU_02").val(client_ligne_devis_2[index].pu_ht);
        } 
        else if (category == "PRESTATIONS_SUPPLEMENTAIRES") {
            var allOptions = document.getElementById('designation_03').options;

            for (var i = 0; i < allOptions.length; i++) {
                if (allOptions[i].value.split('---')[0] == client_ligne_devis_3[index].ligne_devis_prestation) {
                    $("#designation_03").val(allOptions[i].value);
                    break;
                }
            }

            $("#prestation_03").val(client_ligne_devis_3[index].prestation);
            $("#unite_03").val(client_ligne_devis_3[index].unite);
            $("#nbr_jour_03").val(client_ligne_devis_3[index].nbr_jour);
            $("#PU_03").val(client_ligne_devis_3[index].pu_ht);
        } 
        else {
            console.error("Category not recognized:", category);
        }

        index_all = index;
        update_ligne = true;
    }



    function delete_ligne_devis_1(index)
    {
        client_ligne_devis_1.splice(index, 1);
    }


    function delete_ligne_devis_2(index)
    {
        client_ligne_devis_2.splice(index, 1);
    }

    function delete_ligne_devis_3(index)
    {
        client_ligne_devis_3.splice(index, 1);
    }

    function convertDateFormat(inputDate) {
        // Split the date into components using "/"
        var dateComponents = inputDate.split('/');
    
        // Rearrange the components to the "DD/MM/YYYY" format
        var outputDate = dateComponents[1] + '/' + dateComponents[0] + '/' + dateComponents[2];
    
        return outputDate;
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

    if(numero_devis != '' || id_client_devis != '')
     {
        const endpoint = De_Fa === 'Facture' && numero_facture !== ''
            ? `../Controllers/FactureController/get_facture.php?numero_facture=${numero_facture}&id_client=${id_client}`
            : `../Controllers/get_devis_creation.php?numero_devis=${numero_devis}&id_client=${id_client}&version=${devis_version}`;

        fetch(endpoint, {
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
            if(id_client_devis != '')
            {
                client_devis_factrue_client = {
                    'id_client_Facture' : '',
                    'id_client_devis' : data.client_devis_factrue_client.id_client_devis,
                    'id_client' : data.client_devis_factrue_client.id_client,
                    'utilisateurs' : id_user,
                    // 'Numero_Facture' : data.client_devis_factrue_client.Numero_devis,
                    'prix_total_ttc' : data.client_devis_factrue_client.prix_total_ttc
                 };
            }
            else 
            {
                client_devis_factrue_client = data.client_devis_factrue_client;
                client_devis_factrue_client.id_client_devis = '';
                client_devis_factrue_client.version_devis = parseInt(client_devis_factrue_client.version_devis) + 1;
            }
            client_devis = data.client_devis;
            client_ligne_devis_1 = data.client_ligne_devis_1;
            client_ligne_devis_2 = data.client_ligne_devis_2;
            client_ligne_devis_3 = data.client_ligne_devis_3;

            ligneSallesEspaces = client_ligne_devis_1.length == 0 ? 1 : client_ligne_devis_1.length;
            ligneTechReg = client_ligne_devis_2.length == 0 ? 1 : client_ligne_devis_2.length;
            ligneSupplementaires = client_ligne_devis_3.length == 0 ? 1 : client_ligne_devis_3.length; 

            console.log(client_devis);

            // client_devis.du_date =  DateToValueFromDate(new Date(client_devis.du_date));
            // client_devis.a_tel_date =  DateToValueFromDate(new Date(client_devis.a_tel_date));
           
            
           // console.log('date ' + client_devis);
            
            $("#objet_value").text('Objet : ' +  client_devis.objet ); 
            $("#Du").val(DateToValueFromDate(new Date(client_devis.du_date)));
            $("#au").val(DateToValueFromDate(new Date(client_devis.a_tel_date)));
            $("#input_date_de_devis_01").val(DateToValueFromDate(new Date(client_devis.le_devis)));
            $("#value_date_de_devis").text('LE ' + DateToValueFromDate(new Date(client_devis.le_devis)));



            client_devis.du_date = inverseFormeDate(client_devis.du_date);
            client_devis.a_tel_date = inverseFormeDate(client_devis.a_tel_date);
            client_devis.le_devis = inverseFormeDate(client_devis.le_devis);



          
            changetable(0, 0, 0);
            


            // Now you can use the retrieved data as needed
            // For example, you can update the UI or perform other operations
        })
        .catch((error) => {
            console.error('Error fetching data:', error);
        });
     }
     
     function du_a_date(inputDateString)
     {
        if (typeof inputDateString === 'string') 
        {
            const dateParts = inputDateString.split('/');
            return `${dateParts[2]}-${dateParts[1]}-${dateParts[0]}`;
        }
        return inputDateString;
     }

    function updateFacture(){

        $("#etape_3_butt").prop("disabled", true);

        if (
            client_devis.du_date == '' ||
            client_devis.a_tel_date == '' ||
            client_devis.TVA == '' ||
            client_devis.objet == '' ||
            client_devis.devis_objet == '' ||
            client_devis_factrue_client.numero_devis == ''
        ) {
            cuteToast({
                type: "error",
                title: "Erreur",
                message: 'Remplissez tous les champs avant d\'enregistrer.',
                timer: 5000
            });
            $("#etape_3_butt").prop("disabled", false);
            return null;
        }

        if (client_devis.du_date == 'undefined//undefined' || client_devis.a_tel_date == 'undefined//undefined') {
            cuteToast({
                type: "error",
                title: "Erreur",
                message: 'Il y a une erreur dans les dates de l\'événement, veuillez les remplir !',
                timer: 5000
            });
            $("#etape_3_butt").prop("disabled", false);
            return null;
        }

        const currentDate = new Date();
        const currentYear = currentDate.getFullYear();

        if (
            parseInt(client_devis.du_date.split('/')[2]) < currentYear ||
            parseInt(client_devis.a_tel_date.split('/')[2]) < currentYear
        ) {
            cuteToast({
                type: "error",
                title: "Erreur",
                message: 'L\'année ' +
                    (parseInt(client_devis.du_date.split('/')[2]) < currentYear ? client_devis.du_date.split('/')[2] : client_devis.a_tel_date.split('/')[2]) +
                    ' est déjà clôturée !',
                timer: 5000
            });
            $("#etape_3_butt").prop("disabled", false);
            return null;
        }

        const duDateFormatted = client_devis.du_date.split('/').reverse().join('/');
        const aTelDateFormatted = client_devis.a_tel_date.split('/').reverse().join('/');

        if (new Date(duDateFormatted) > new Date(aTelDateFormatted)) {
            cuteToast({
                type: "error",
                title: "Erreur",
                message: 'La date de début de l\'événement ne peut pas être postérieure à sa date de fin !',
                timer: 5000
            });
            $("#etape_3_butt").prop("disabled", false);
            return null;
        }

        // Vérifier si au moins une prestation est ajoutée
        if (client_ligne_devis_1.length == 0 && client_ligne_devis_2.length == 0 && client_ligne_devis_3.length == 0) {
            cuteToast({
                type: "error",
                title: "Erreur",
                message: 'Il faut au moins entrer une prestation avant d\'enregistrer.',
                timer: 5000
            });
            $("#etape_3_butt").prop("disabled", false);
            return null;
        }

        client_devis_update = client_devis;
        client_devis_update.du_date = du_a_date(client_devis.du_date);
        client_devis_update.a_tel_date = du_a_date(client_devis.a_tel_date);
        client_devis_update.le_devis = du_a_date(client_devis.le_devis);

        if(De_Fa == "Facture"){
            client_devis_factrue_client.id_client_devis = id_client_devis;
            client_devis_factrue_client.id_client_Facture = id_client_facture;
            client_devis_factrue_client.Numero_Facture = numero_facture;
        }

        console.log("Data For Update : ")
        console.log(client_devis_factrue_client);
        console.log(client_devis_update);

        console.log(client_ligne_devis_1);
        console.log(client_ligne_devis_2);
        console.log(client_ligne_devis_3);

        //POST request to the endpoint to update data

        fetch('../Controllers/FactureController/update_facture.php?De_Fa=' + De_Fa, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                client_devis_factrue_client: client_devis_factrue_client,
                client_devis: client_devis_update,
                client_ligne_devis_1: client_ligne_devis_1,
                client_ligne_devis_2: client_ligne_devis_2,
                client_ligne_devis_3: client_ligne_devis_3 
            })
        })
        .then(response => response.json())
            .then(data => {
                console.log(data);
                if (data.success) {
                    cuteToast({
                        type: "success",
                        title: "Succès",
                        message: 'Formulaire soumis avec succès !',
                        timer: 2000
                    });

                    $("#etape_3_quit").show();
                    //$("#value_numero_devis").text(De_Fa + ' Nº: ' + data.numero);
                    //$("#value_numero_devis_div").addClass("anim_numero_devis");
                } else {
                    cuteToast({
                        type: "error",
                        title: "Erreur",
                        message: data.message,
                        timer: 5000
                    });
                }
            })
            .catch((error) => {
                console.error('Erreur lors de l\'envoi des données:', error);
                cuteToast({
                    type: "error",
                    title: "Erreur",
                    message: 'Une erreur s\'est produite lors de la soumission du formulaire.',
                    timer: 5000
                });
            });
    }
     
   

    function enregistrerDevis() {
        $("#etape_3_butt").prop("disabled", true);

        // Validation des champs obligatoires
        if (
            client_devis.du_date == '' ||
            client_devis.a_tel_date == '' ||
            client_devis.TVA == '' ||
            client_devis.objet == '' ||
            client_devis.devis_objet == '' ||
            client_devis_factrue_client.numero_devis == ''
        ) {
            cuteToast({
                type: "error",
                title: "Erreur",
                message: 'Remplissez tous les champs avant d\'enregistrer.',
                timer: 5000
            });
            $("#etape_3_butt").prop("disabled", false);
            return null;
        }

        if (client_devis.du_date == 'undefined//undefined' || client_devis.a_tel_date == 'undefined//undefined') {
            cuteToast({
                type: "error",
                title: "Erreur",
                message: 'Il y a une erreur dans les dates de l\'événement, veuillez les remplir !',
                timer: 5000
            });
            $("#etape_3_butt").prop("disabled", false);
            return null;
        }

        const currentDate = new Date();
        const currentYear = currentDate.getFullYear();

        if (
            parseInt(client_devis.du_date.split('/')[2]) < currentYear ||
            parseInt(client_devis.a_tel_date.split('/')[2]) < currentYear
        ) {
            cuteToast({
                type: "error",
                title: "Erreur",
                message: 'L\'année ' +
                    (parseInt(client_devis.du_date.split('/')[2]) < currentYear ? client_devis.du_date.split('/')[2] : client_devis.a_tel_date.split('/')[2]) +
                    ' est déjà clôturée !',
                timer: 5000
            });
            $("#etape_3_butt").prop("disabled", false);
            return null;
        }

        const duDateFormatted = client_devis.du_date.split('/').reverse().join('/');
        const aTelDateFormatted = client_devis.a_tel_date.split('/').reverse().join('/');

        if (new Date(duDateFormatted) > new Date(aTelDateFormatted)) {
            cuteToast({
                type: "error",
                title: "Erreur",
                message: 'La date de début de l\'événement ne peut pas être postérieure à sa date de fin !',
                timer: 5000
            });
            $("#etape_3_butt").prop("disabled", false);
            return null;
        }

        // Vérifier si au moins une prestation est ajoutée
        if (client_ligne_devis_1.length == 0 && client_ligne_devis_2.length == 0 && client_ligne_devis_3.length == 0) {
            cuteToast({
                type: "error",
                title: "Erreur",
                message: 'Il faut au moins entrer une prestation avant d\'enregistrer.',
                timer: 5000
            });
            $("#etape_3_butt").prop("disabled", false);
            return null;
        }

        // Formatage des dates pour l'envoi
        client_devis_v2 = client_devis;
        client_devis_v2.du_date = du_a_date(client_devis.du_date);
        client_devis_v2.a_tel_date = du_a_date(client_devis.a_tel_date);
        client_devis_v2.le_devis = du_a_date(client_devis.le_devis);

        if (De_Fa == 'Facture') {
            client_devis_factrue_client.id_client_devis = id_client_devis;
        }

        // Afficher les données avant envoi
        console.log(client_devis_factrue_client);
        console.log(client_devis_v2);

        // Envoi des données via fetch
        fetch('../Controllers/devis_creation.php?De_Fa=' + De_Fa+'&id_societe='+id_societe, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                client_devis_factrue_client: client_devis_factrue_client,
                client_devis: client_devis_v2,
                client_ligne_devis_1: client_ligne_devis_1,
                client_ligne_devis_2: client_ligne_devis_2,
                client_ligne_devis_3: client_ligne_devis_3 
            }),
        })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                if (data.success) {
                    cuteToast({
                        type: "success",
                        title: "Succès",
                        message: 'Formulaire soumis avec succès !',
                        timer: 2000
                    });

                    $("#etape_3_quit").show();
                    $("#value_numero_devis").text(De_Fa + ' Nº: ' + data.numero);
                    $("#value_numero_devis_div").addClass("anim_numero_devis");
                } else {
                    cuteToast({
                        type: "error",
                        title: "Erreur",
                        message: data.message,
                        timer: 5000
                    });
                }
            })
            .catch((error) => {
                console.error('Erreur lors de l\'envoi des données:', error);
                cuteToast({
                    type: "error",
                    title: "Erreur",
                    message: 'Une erreur s\'est produite lors de la soumission du formulaire.',
                    timer: 5000
                });
            });
    }


    function Quitter_etape_3()
    {
        if(De_Fa === 'Facture'){
            
            window.location.href = '../Ressources/index.php?page_name=toutes_les_factures&page=Devis_client_id&De_Fa='+De_Fa;
        }else{
            
            location.href = '../Ressources/index.php?page_name=devis_creation&page=Devis_client_id&id_client='+id_client+'&societe='+societe+'&De_Fa='+De_Fa; 
        }
    }
    

    function changetable(SallesEspaces, TechReg, Supplementaires, index) {
        if ((ligneSallesEspaces > 1 && SallesEspaces < 0) || SallesEspaces > 0)
            ligneSallesEspaces += SallesEspaces;

        if (SallesEspaces < 0) {
            delete_ligne_devis_1(index);
        }

        if ((ligneTechReg > 1 && TechReg < 0) || TechReg > 0)
            ligneTechReg += TechReg;

        if (TechReg < 0) {
            delete_ligne_devis_2(index);
        }

        if ((ligneSupplementaires > 1 && Supplementaires < 0) || Supplementaires > 0)
            ligneSupplementaires += Supplementaires;

        if (Supplementaires < 0) {
            delete_ligne_devis_3(index);
        }

        let sommeTotalHT = 0;

        for (let i = 0; i < ligneSallesEspaces; i++) {
            if (client_ligne_devis_1.length > i) {
                sommeTotalHT += parseFloat(client_ligne_devis_1[i].pt_ht);
            }
        }

        for (let i = 0; i < ligneTechReg; i++) {
            if (client_ligne_devis_2.length > i) {
                sommeTotalHT += parseFloat(client_ligne_devis_2[i].pt_ht);
            }
        }

        for (let i = 0; i < ligneSupplementaires; i++) {
            if (client_ligne_devis_3.length > i) {
                sommeTotalHT += parseFloat(client_ligne_devis_3[i].pt_ht);
            }
        }

        const sommeTva = sommeTotalHT !== 0
            ? sommeTotalHT * (parseInt(client_devis.TVA.toString().split(' ')[0] || client_devis.TVA) / 100)
            : 0;

        client_devis_factrue_client.prix_total_ttc = sommeTva + sommeTotalHT;

        let body = `
            <table class="tab_devis" style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr>
                        <th>Journée du</th>
                        <th style="width: 50%;">Prestation</th>
                        <th>Unité</th>
                        <th style="width: 7%;">Nbre de jours</th>
                        <th>PU/HT</th>
                        <th>PT/HT</th>
                        <th>Operation</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="7" class="salles_espaces" style="border-top: none;">SALLES & ESPACES</td>
                    </tr>`;

        // Ajouter les lignes pour SALLES & ESPACES
        body += renderTableRows(ligneSallesEspaces, client_ligne_devis_1, "SALLES_ESPACES", 1);

        // Ajouter les lignes pour TECHNICIENS & RÉGISSEURS
        body += `<tr>
                    <td colspan="7" class="salles_espaces">TECHNICIENS & RÉGISSEURS</td>
                </tr>`;
        body += renderTableRows(ligneTechReg, client_ligne_devis_2, "TECHNICIENS_REGISSEURS", 2);

        // Ajouter les lignes pour PRESTATIONS SUPPLÉMENTAIRES
        body += `<tr>
                    <td colspan="7" class="salles_espaces">PRESTATIONS SUPPLÉMENTAIRES</td>
                </tr>`;
        body += renderTableRows(ligneSupplementaires, client_ligne_devis_3, "PRESTATIONS_SUPPLEMENTAIRES", 3);

        body += `
            <tr>
                <td colspan="5" style="text-align: center;">Total Séminaire Restauration HT</td>
                <td>${sommeTotalHT.toFixed(2)}</td>
                <td></td>
            </tr>
            <tr>
                <td colspan="5" style="text-align: center;">TVA ${client_devis.TVA}</td>
                <td class="${client_devis.TVA === '' ? 'anim_clio' : ''}">
                    ${!isNaN(sommeTva.toFixed(2)) ? sommeTva.toFixed(2) : 'TVA est null'}
                </td>
                <td></td>
            </tr>
            <tr>
                <td colspan="5" style="text-align: center;">Total Séminaire TTC</td>
                <td class="${client_devis.TVA === '' ? 'anim_clio' : ''}">
                    ${!isNaN(client_devis_factrue_client.prix_total_ttc.toFixed(2))
                        ? client_devis_factrue_client.prix_total_ttc.toFixed(2)
                        : 'TVA est null'}
                </td>
                <td></td>
            </tr>
        </tbody></table>`;

        $(".table_to_append").html(body);
    }   

    function renderTableRows(rowCount, ligneData, modalId, prestationType) {
        let rows = '';
        for (let i = 0; i < rowCount; i++) {
            rows += `<tr>`;
            if (i === 0) {
                rows += `
                    <td style="height:${rowCount * 114}px; width:100px;" rowspan="${rowCount}" class="${client_devis.du_date === '' || client_devis.a_tel_date === '' ? 'anim_clio' : ''}">
                        Du ${client_devis.du_date} <br/>au ${client_devis.a_tel_date}
                    </td>`;
            }
            if (ligneData.length > i) {
                rows += `
                    <td>${ligneData[i].prestation}</td>
                    <td>${ligneData[i].unite}</td>
                    <td>${ligneData[i].nbr_jour}</td>
                    <td>${ligneData[i].pu_ht}</td>
                    <td>${ligneData[i].pt_ht}</td>
                    <td style="text-align: center;">
                        ${i === rowCount - 1 ? `<button class="button_plus" onclick="changetable(${prestationType === 1 ? 1 : 0}, ${prestationType === 2 ? 1 : 0}, ${prestationType === 3 ? 1 : 0}, ${i})">+</button>` : ''}
                        <button class="button_moins" onclick="changetable(${prestationType === 1 ? -1 : 0}, ${prestationType === 2 ? -1 : 0}, ${prestationType === 3 ? -1 : 0}, ${i})">-</button>
                        <button class="button_update" data-toggle="modal" data-target="#${modalId}" onclick="open_prestation(${i}, '${modalId}')">Edit</button>
                    </td>`;
            } else {
                rows += `
                    <td><div class="cmp-tb-hd bsc-smp-sm">
                        <div class="text_align_center">
                            <button type="button" class="btn btn-info" data-toggle="modal" style="background:#000000;" data-target="#${modalId}">Ajouter votre prestation</button>
                        </div>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="text-align: center;">
                        ${i === rowCount - 1 ? `<button class="button_plus" onclick="changetable(${prestationType === 1 ? 1 : 0}, ${prestationType === 2 ? 1 : 0}, ${prestationType === 3 ? 1 : 0}, ${i})">+</button>` : ''}
                        <button class="button_moins" onclick="changetable(${prestationType === 1 ? -1 : 0}, ${prestationType === 2 ? -1 : 0}, ${prestationType === 3 ? -1 : 0}, ${i})">-</button>
                    </td>`;
            }
            rows += `</tr>`;
        }
        return rows;
    }


    if(numero_devis == '')
    {
        changetable(0, 0, 0);
    }


        