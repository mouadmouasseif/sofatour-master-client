$("#pas_data").show();
$("#is_data").hide();
$("#is_data_detail").hide();

$(".spiinneeeer").hide();


function rechercher()
{
    $(".spiinneeeer").show();
        let annee = document.getElementById('annee_001');
        let DeFa = document.getElementById('DeFa_001');

        // Supposons que 'listePrestations' est une référence à la liste déroulante (select) des prestations
        let listePrestations = document.getElementById('listePrestations');

        // Récupérer les valeurs sélectionnées dans la liste déroulante des prestations
        let prestationsSelectionnees = [];
        for (let option of listePrestations.options) {
            if (option.selected) {
                prestationsSelectionnees.push(option.value);
            }
        }

        // Construire l'objet à envoyer en tant que corps de la requête POST
        let formData = {
            annee: annee.value,
            prestation: prestationsSelectionnees,
            DeFa: DeFa.value
        };

        // URL du script PHP à appeler
        let url = '../Controllers/rapport_par_prestation.php';

        // Envoi de la requête fetch
        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            // Manipulation des données de réponse ici
            console.log(data);
            afficherResultats(data.data);
            $(".spiinneeeer").hide();
        })
        .catch(error => {
            console.error('Erreur lors de la requête fetch :', error);
        }); 
}





function Detail(event)
{
     // Get the tbody element
     let tbody = document.getElementById('resultatsTableauBody');
    
     // Get all tr elements within the tbody
     let rows = tbody.getElementsByTagName('tr');
     
     // Loop through each tr element and set its background color to white
     for (let i = 0; i < rows.length; i++) {
         rows[i].style.backgroundColor = 'white';
     }
    event.parentNode.parentNode.style.background = '#ffcc00';
    $(".spiinneeeer").show();
        let annee = document.getElementById('annee_001');
        let DeFa = document.getElementById('DeFa_001');
        
        // Supposons que 'listePrestations' est une référence à la liste déroulante (select) des prestations
        let prestationsSelectionnees =  event.id;

       

        // Construire l'objet à envoyer en tant que corps de la requête POST
        let formData = {
            annee: annee.value,
            prestation: prestationsSelectionnees,
            DeFa: DeFa.value
        };

        // URL du script PHP à appeler
        let url = '../Controllers/rapport_par_prestation_detail.php';

        // Envoi de la requête fetch
        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            // Manipulation des données de réponse ici
            console.log(data);
            afficherResultatsDetail(data.data);
            $(".spiinneeeer").hide();
        })
        .catch(error => {
            console.error('Erreur lors de la requête fetch :', error);
        }); 
}




function afficherResultats(data) {

    if(data.length > 0)
        {
            $("#pas_data").hide();
            $("#is_data_detail").hide();
           $("#is_data").show();
        }

    var formatter = new Intl.NumberFormat('fr-FR', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    });
    // Référence vers le corps du tableau dans le HTML
    let tbody = document.getElementById('resultatsTableauBody');
    tbody.innerHTML = ''; // Effacer le contenu précédent du tableau
    var totale = 0;
    // Parcourir les données et créer les lignes du tableau
    data.forEach(item => {
        let row = `<tr>
                      <td  style="text-align: left;">${item.designation}</td>
                      <td  style="text-align: left;">${item.prestation}</td>
                      <td>${formatter.format(item.total_prix)}</td>
                       <td><button style="background: #0035d3;" data-toggle="tooltip" data-placement="left" title="Detail" id="${item.id_ligne_devis_prestation}" onclick="Detail(this);"  class="btn"><i style ="color:white;" class="notika-icon notika-edit"></i></button></td>
                  </tr>`;
        tbody.innerHTML += row;
        totale += parseFloat(item.total_prix);
    });
    tbody.innerHTML += `<tr>
                      <td colspan="2" style="text-align: center; background:black; color:white;" > Totale TTC </td>
                     
                      <td>${formatter.format(totale)}</td>
                     </tr>`
}



function afficherResultatsDetail(data) {

    if(data.length > 0)
        {
            $("#pas_data").hide();
           $("#is_data_detail").show();
        }

    var formatter = new Intl.NumberFormat('fr-FR', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    });
    // Référence vers le corps du tableau dans le HTML
    let tbody = document.getElementById('resultatsTableauBody_detail');
    tbody.innerHTML = ''; // Effacer le contenu précédent du tableau
    var totale = 0;
    // Parcourir les données et créer les lignes du tableau
    data.forEach(item => {
        let row = `<tr>
                      <td  style="text-align: left;">${item.designation}</td>
                       <td  style="text-align: left;">${item.Numero_devis}</td>
                      <td  style="text-align: left;">${(item.societe == null) ? '' : item.societe} ${(item.nom_complet == null) ? '' : item.nom_complet}</td>
                      <td  style="text-align: left;">${item.du_date}</td>
                      <td  style="text-align: left;">${item.a_tel_date}</td>
                      <td>${formatter.format(item.total_prix)}</td>
                  </tr>`;
        tbody.innerHTML += row;
        totale += parseFloat(item.total_prix);
    });
    tbody.innerHTML += `<tr>
                      <td colspan="5" style="text-align: center; background:black; color:white;" > Totale TTC </td>
                     
                      <td>${formatter.format(totale)}</td>
                     </tr>`
}




function reset_data() {
     // Récupérer la référence vers la liste déroulante des prestations
     let listePrestations = document.getElementById('listePrestations');

     // Désélectionner toutes les options
     for (let option of listePrestations.options) {
         option.selected = false;
     }

     $("#pas_data").show();
     $("#is_data").hide();
     $("#is_data_detail").hide();
}

document.addEventListener("DOMContentLoaded", function () {
    const societeDropdown = document.getElementById('id_societe');
    const prestationsDropdown = document.getElementById('listePrestations');

    societeDropdown.addEventListener('change', function () {
        const selectedSociete = this.value;
        // console.log(selectedSociete);

        if (selectedSociete !== "0") {
            fetchPrestationsBySociete(selectedSociete);
        } else {
            resetPrestationsDropdown();
        }
    });

    function fetchPrestationsBySociete(id_societe) {
        fetch(`../Controllers/get_prestations_by_societe.php?id_societe=${id_societe}`)
            .then(response => response.json())
            .then(data => {
                // console.log(data);
                prestationsDropdown.innerHTML = '';
                data.forEach(prestation => {
                    const option = document.createElement('option');
                    option.value = prestation.id_ligne_devis_prestation;
                    option.textContent = prestation.designation;
                    prestationsDropdown.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Erreur lors de la récupération des prestations:', error);
                resetPrestationsDropdown();
            });
    }

    function resetPrestationsDropdown() {
        prestationsDropdown.innerHTML = '<option value="0">Aucune prestation trouvée</option>';
    }
});
