    function handleChangeSecteur(selectElement)
    {
        if(selectElement.value == "1")
        {
            $("#Agence_id1").show();
        }
        else
        {
            $("#Agence_id1").hide();
        }
        if(selectElement.value == "3")
        {
            $("#ICE").hide();
            $("#RC").hide();
            $("input[name='ICE']").val("");
            $("input[name='RC']").val("");
        }
        else
        {
            $("#ICE").show();
            $("#RC").show();
            $("input[name='ICE']").val("");
            $("input[name='RC']").val("");
        }
    }

    var index = 1;
    function addDynamicForm() {
        // Clone the last row
        var clonedRow = $("#dynamic-form-container .row:last").clone();
        $("#dynamic-form-container .row:last .button_plus").hide();
        $("#dynamic-form-container .row:last .button_moins").show();
        // Clear input values in the cloned row
        clonedRow.find('input[type="text"]').val('');

        var inputToRemove = clonedRow.find('.iti').val('');
        inputToRemove.remove();

        var telephoneDiv = clonedRow.find(".telephone");
        telephoneDiv.append('<input type="text" class="form-control" id="phone0" name="telephone" onchange="doite(this)" placeholder="*Numéro de téléphone">');


     
        // Append the cloned row to the container
        $("#dynamic-form-container .form-element-list").append(clonedRow);

        $("#dynamic-form-container .row:last #phone0").attr("id", "phone"+index);

        var input = document.querySelector("#phone" + index);
         window.intlTelInput(input, {
            initialCountry: 'ma',
           utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/utils.js",
         });
        
        index++;
        
         
    }

    function removeDynamicForm(button) {
        // Get the parent row of the clicked button
        var rowToRemove = $(button).closest('.row');

        // Check if there is more than one row (keeping at least one row)
        if ($("#dynamic-form-container .row").length > 1) {
            // Remove the selected dynamic form row
            rowToRemove.remove();
        }
    }
    
        function handleChangeResponsableInterlocuteur(selectElement) {
            var selectedValue = selectElement.value;
            // Do something with the selected value, such as calling another function or performing an action
           // console.log("Selected value:", selectedValue);
        }
        document.addEventListener('DOMContentLoaded', function() {
            function handleChange(selectElement) {
                var selectedValue = selectElement.value;
                // Do something with the selected value, such as calling another function or performing an action
                //console.log("Selected value:", selectedValue);
            }
        });


    function get_page_name() {
        const urlParams = new URLSearchParams(window.location.search);
        const client_type = urlParams.get('page_name');

        switch (client_type) {
            case "Personne_Physique":
                $("#personne_physique_01").show();
                $("#personne_physique_02").hide();
                $("#ICE").hide();
                $("#RC").hide();
                break;

            case "Personne_Individuelle":
                $("#personne_physique_01").show();
                $("#personne_physique_02").hide();
                $("#ICE").hide();
                $("#RC").hide();
                break;

            case "Personne_Morale":
                $("#personne_physique_01").hide();
                $("#personne_physique_02").show();
                $("#ICE").show();
                $("#RC").show();
                break;

            default:
                $("#personne_physique_01").hide();
                $("#personne_physique_02").hide();
                $("#ICE").hide();
                $("#RC").hide();
                break;
        }

        return client_type === "Personne_Physique"
            ? 2
            : client_type === "Personne_Individuelle"
            ? 3
            : client_type === "Personne_Morale"
            ? 1
            : null; 
    }
    get_page_name();


//+++++++++++modalite de piements
    var ModaliteSansAvance = true;
    function handleChangeModaliteAvanceSansAvance(selectElement) {
        var selectedValue = selectElement.checked;
        // Do something with the selected value, such as calling another function or performing an action
        if(selectedValue == false)
        { 
            ModaliteSansAvance = true;
            $("#Totalite_model").show();
            $("#Porcentage_model").hide();
        }
        else
        {
            ModaliteSansAvance = false;
            $("#Totalite_model").hide();
            $("#Porcentage_model").show();
        }
      //  console.log("Selected value:", selectedValue);
    }

    var ModaliteMois = true;
    function handleChangeModaliteMoisSemaine(selectElement) {
        var selectedValue = selectElement.checked;
        // Do something with the selected value, such as calling another function or performing an action
        if(selectedValue == false)
        { 
            ModaliteMois = true;
            $("#semaine_mois_id").text('mois');
        }
        else
        {
            ModaliteMois = false;
            $("#semaine_mois_id").text('semaine');
        }
        console.log("Selected value:", selectedValue);
    }

    var Totalite = false;
    function handleChangeModaliteTotalite(selectElement) {
        var selectedValue = selectElement.checked;
        Totalite = selectedValue;
        // Do something with the selected value, such as calling another function or performing an action
       // console.log("Selected value:", selectedValue);
    }


//+++++++++++modalite de piements



     function etalonnage_change(selectElement)
    {
        var selectedValue = selectElement.value;
        $("#value_range_id").text(selectedValue);
    }

    function resetForm() {
        // Reset input elements
        document.querySelector("#form_01").querySelectorAll('input').forEach(input => {
            if (input.type !== 'hidden' && input.type !== 'checkbox') {
                input.value = '';
            } else if (input.type === 'checkbox') {
                input.checked = false;
            }
        });
    
        // Reset select elements
        document.querySelectorAll('select').forEach(select => {
            select.selectedIndex = 0; // Set it to the first option (assuming the first option is the default)
        });

        document.querySelectorAll('range').forEach(select => {
            select.value = 0; // Set it to the first option (assuming the first option is the default)
        });
    
    }

    
    function submit_forms()
    {
        const urlParams_gl = new URLSearchParams(window.location.search);
        const client_type = urlParams_gl.get('page_name');
       var form_validation = true;
       var form_validation_telephone = true;
    //+++++++++++++++++++++++++++++ Information Globale
        var clients = new client();
        var forms_INFO = this.document.querySelector('#Information_Globale01');
        var forms_INFO = this.document.querySelector('#Information_Globale01');

        if((verifier_value(forms_INFO.querySelector('[name="Nom_societe"]').value)  && client_type != 'Personne_Physique' && client_type != 'Personne_Individuelle')
        || ((verifier_value(forms_INFO.querySelector('[name="secteur"]').value) || forms_INFO.querySelector('[name="secteur"]').value == '0') &&  client_type != 'Personne_Physique' && client_type != 'Personne_Individuelle')
        || ((verifier_value(forms_INFO.querySelector('[name="id_societe"]').value) || forms_INFO.querySelector('[name="id_societe"]').value == '0')) 
        // || (forms_INFO.querySelector('[name="secteur"]').value != '3' && verifier_value(forms_INFO.querySelector('[name="ICE"]').value))
        // || (forms_INFO.querySelector('[name="secteur"]').value != '3' && verifier_value(forms_INFO.querySelector('[name="RC"]').value))
        || verifier_value(forms_INFO.querySelector('[name="Adresse"]').value))
            {
                form_validation = false;
            }
            else
            {
                const urlParams = new URLSearchParams(window.location.search);
                const client_type = urlParams.get('page_name');
                clients.societe = forms_INFO.querySelector('[name="Nom_societe"]').value;
                clients.client_type = get_page_name();
                clients.nom_complet = get_page_name() == 2 ? forms_INFO.querySelector('[name="Nom_Complet"]').value : '';
                clients.ice = forms_INFO.querySelector('[name="secteur"]').value != 3 ? forms_INFO.querySelector('[name="ICE"]').value  : null;
                clients.rc = forms_INFO.querySelector('[name="secteur"]').value != 3 ? forms_INFO.querySelector('[name="RC"]').value : null;
                clients.adresse = forms_INFO.querySelector('[name="Adresse"]').value;
                clients.societe = forms_INFO.querySelector('[name="Nom_societe"]').value;
                clients.client_secteur = forms_INFO.querySelector('[name="secteur"]').value ;
                clients.date_d_entree = new Date();
                clients.utilisateurs = this.document.querySelector('#utilisateurs_01').value;
                clients.Agence_evementiel = this.document.querySelector('[name="Agence_evementiel"]').checked;
                clients.avance = !ModaliteSansAvance;
                clients.id_societe = forms_INFO.querySelector('[name="id_societe"]').value ;

            }
        console.log(clients);
        //+++++++++++++++++++++++++++++ Information Globale

       
       
       //+++++++++++++++++++++++++++++ Responsable / Interlocuteur
       var responsable_interlocuteurs = []; // = new responsable_interlocuteur();
       var forms_respon = this.document.querySelectorAll('#dynamic-form-container .row');
       for(let i = 0 ; i < forms_respon.length ; i++)
       {
        var item = new responsable_interlocuteur();
        if(verifier_value(forms_respon[i].querySelector('[name="type_responsable_interlocuteur"]').value) 
        //|| verifier_value(forms_respon[i].querySelector('[name="email"]').value) 
         || verifier_value(forms_respon[i].querySelector('[name="nom_complet"]').value) 
        || !window.intlTelInputGlobals.getInstance(forms_respon[i].querySelector('[name="telephone"]')).isValidNumber() || (client_type !== "Personne_Physique" && verifier_value(forms_respon[i].querySelector('[name="email"]').value) )) 
        {
            if(!window.intlTelInputGlobals.getInstance(forms_respon[i].querySelector('[name="telephone"]')).isValidNumber())
            {
                form_validation_telephone = false;
            }

            form_validation = false;
            break;
        }
        else
        {
            item.nom_complet =  forms_respon[i].querySelector('[name="nom_complet"]').value;
            var email = forms_respon[i].querySelector('[name="email"]').value.trim();
            item.email =  email !== "" ? email : null;
            item.c_responsable_interlocuteur =  forms_respon[i].querySelector('[name="type_responsable_interlocuteur"]').value;
            item.numero_telephone = window.intlTelInputGlobals.getInstance(forms_respon[i].querySelector('[name="telephone"]')).getNumber(); 
            item.clients = 'ID_client'; // ID_client
        }
            responsable_interlocuteurs.push(item);
       }
         console.log(responsable_interlocuteurs);
        //+++++++++++++++++++++++++++++ Responsable / Interlocuteur


        //+++++++++++++++++++++++++++++modalite_payement
        var client_modalite_payement_sans_avances = new client_modalite_payement_sans_avance();
        var client_modalite_payement_avances = new client_modalite_payement_avance();
        var forms_modalite_payement = this.document.querySelector('#modalite_piement_01');

       
        if(ModaliteSansAvance == true)
        {
            if( (Totalite == true && forms_modalite_payement.querySelector('[name="etalonage"]').value > 0) || (Totalite == false && forms_modalite_payement.querySelector('[name="etalonage"]').value == 0))
            {
                form_validation = false;
            }
            
            client_modalite_payement_sans_avances.Totalite = Totalite;
            client_modalite_payement_sans_avances.etalonage = forms_modalite_payement.querySelector('[name="etalonage"]').value;
            client_modalite_payement_sans_avances.semaine = !ModaliteMois;
            client_modalite_payement_sans_avances.mois = ModaliteMois;
            client_modalite_payement_sans_avances.clients = 'ID_client';

            console.log(client_modalite_payement_sans_avances);
        }
        else
        {
            if(verifier_value(forms_modalite_payement.querySelector('[name="pourcentage"]').value))
            {
                form_validation = false;
            }
            if(forms_modalite_payement.querySelector('[name="etalonage"]').value == 0)
            {
                form_validation = false;
            }
            client_modalite_payement_avances.pourcentage = forms_modalite_payement.querySelector('[name="pourcentage"]').value;
            client_modalite_payement_avances.etalonage = forms_modalite_payement.querySelector('[name="etalonage"]').value;
            client_modalite_payement_avances.semaine = !ModaliteMois;
            client_modalite_payement_avances.mois = ModaliteMois;
            client_modalite_payement_avances.clients = 'ID_client';

            console.log(client_modalite_payement_avances);
        }
        
        //+++++++++++++++++++++++++++++modalite_payement

       console.log(form_validation);
        if(form_validation == false)
        {
            if(ModaliteSansAvance == true && Totalite == true && forms_modalite_payement.querySelector('[name="etalonage"]').value > 0)
            {
                cuteToast({
                    type: "error", // or 'info', 'error', 'warning'
                    title: "Error",
                    message: 'Vous avez coché Totalité et étalonnage supérieur à 0. Ce n\'est pas logique, veuillez corriger cela, s\'il vous plaît !',
                    timer: 5000
                    });
            }else if(ModaliteSansAvance == true && Totalite == false && forms_modalite_payement.querySelector('[name="etalonage"]').value == 0)
            {
                cuteToast({
                    type: "error", // or 'info', 'error', 'warning'
                    title: "Error",
                    message: 'Vous avez pas coché Totalité et étalonnage égal egale 0. Ce n\'est pas logique, veuillez corriger cela, s\'il vous plaît !',
                    timer: 5000
                    });
            }else if(ModaliteSansAvance == false  && forms_modalite_payement.querySelector('[name="etalonage"]').value == 0)
            {
                cuteToast({
                    type: "error", // or 'info', 'error', 'warning'
                    title: "Error",
                    message: 'Avec avance et étalonnage egale 0. Ce n\'est pas logique, veuillez corriger cela, s\'il vous plaît !',
                    timer: 5000
                    });
            }
            else if(form_validation_telephone == false)
            {
                cuteToast({
                    type: "error", // or 'info', 'error', 'warning'
                    title: "Error",
                    message: 'Veuillez vérifier la validation des numéros de téléphone avant de soumettre le formulaire !',
                    timer: 5000
                    });
            }
            else
            {
                cuteToast({
                    type: "error", // or 'info', 'error', 'warning'
                    title: "Error",
                    message: 'Veuillez vérifier les valeurs entrées (telephone des Responsable / Interlocuteur , ect...) et assurez-vous de remplir complètement le formulaire !',
                    timer: 5000
                    });
            }
         
        }
        else
        {
            console.log({
                clients: clients,
                responsable_interlocuteurs: responsable_interlocuteurs,
                client_modalite_payement_sans_avances: client_modalite_payement_sans_avances,
                client_modalite_payement_avances: client_modalite_payement_avances
            });
                fetch('../Controllers/personne_morale_physique.php?client_type='+client_type, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        clients: clients,
                        responsable_interlocuteurs: responsable_interlocuteurs,
                        client_modalite_payement_sans_avances: client_modalite_payement_sans_avances,
                        client_modalite_payement_avances: client_modalite_payement_avances
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    if (data.success) {
                        // Success handling
                        cuteToast({
                            type: "success",
                            title: "Succès",
                            message: 'Formulaire soumis avec succès !',
                            timer: 5000
                        });
                        resetForm();
                    } else {
                        // Error handling
                        // console.error('Erreur lors de l\'envoi des données:', data.error);
                        cuteToast({
                            type: "error",
                            title: "Erreur",
                            message: 'Une erreur s\'est produite lors de la soumission du formulaire : le nom de la société, le numéro ICE et le numéro RC doivent être uniques !!',
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
    }


    function validatePhoneNumber(phoneNumber) {
        var phoneRegex = /^[0-9]{10}$/;
    
        if (phoneRegex.test(phoneNumber)) {
            return false;
        } else {
            return true;
        }
    }

    function verifier_value(element)
    {
        if(element == null || element != '' || element == undefined)
         return false;
        else
         return true;
    }

    $(document).ready( function () {
        $('#myTable').DataTable({
            "language": {
                "sUrl": "../Ressources/data-tables/fr.json" // Replace 'French' with your desired language
            }
        });
    });