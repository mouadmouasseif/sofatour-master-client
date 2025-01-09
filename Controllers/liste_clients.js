$(document).ready(function() {
    // Perform an Ajax request to get client details
    $.ajax({
        url: '../Controllers/liste_clients.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            // Process the received data and display it on the page
            console.log(data);
            displayClients(data);
        },
        error: function(error) {
            console.error('Error fetching data:', error);
        }
    });

    function displayClients(clients) {
        if(clients.length > 0)
        {
            var i = 0;
            //<td>${interlocutor.email}</td>
        clients.forEach(function(client) {
            // Create a new contact element for each client
            var interlocutorsString = client.interlocutors.map(function(interlocutor) {
            return `<tr><td>${interlocutor.type_responsable_interlocuteur}</td><td>${interlocutor.nom_complet}</td><td>${interlocutor.numero_telephone}</td></tr>`;
            }).join('');
            var modalite_piement;
            if(client.payment_modalities_avance.length > 0)
            {
                modalite_piement =  `<br/>
                            <table class="table_respon">
                            <thead>
                            <tr><th colspan="4" style="text-align: center;">Modalités de paiement</th></tr>
                            <tr><th>Avec Avance</th><th>Pourcentage</th><th>Etalonage</th></thead>`;
                modalite_piement += client.payment_modalities_avance.map(function(payment_modalities) {
                return `<tr><td>Oui</td><td>${payment_modalities.pourcentage}</td><td>${payment_modalities.etalonage}${payment_modalities.mois == 0 ? 'mois' : 'semaines'}</td></tr>`;
                }).join('');
                modalite_piement += `</table>`;
            }
            else
            { 
                modalite_piement =  `<br/>
                            <table class="table_respon">
                            <thead>
                            <tr><th colspan="4" style="text-align: center;">Modalités de paiement</th></tr>
                            <tr><th>Avec Avance</th><th>Totalite</th><th>Etalonage</th></tr></thead>`;
                modalite_piement += client.payment_modalities_sans_avance.map(function(payment_modalities) {
                    return `<tr><td>Non</td><td>${payment_modalities.Totalite == 1 ? 'Oui' : 'Non'  }</td><td>${payment_modalities.etalonage}${payment_modalities.mois == 0 ? 'mois' : 'semaines'}</td></tr>`;
                }).join('');
                modalite_piement += `</table>`;
            }
            
          
      
            console.log("SOCIETEE: ", client.societe);

             var contactElement = `
              
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="contact-list">
                            <div class="contact-win">
                                <div class="contact-img">
                                    <!-- <img src="img/post/1.jpg" alt="" /> -->
                                </div>
                                <div class="conct-sc-ic">
                                    <a class="btn" href="../Ressources/index.php?page_name=devis_creation&page=Devis_client_id&id_client=${client.id_client}&societe=${client.societe}"><i class="notika-icon notika-edit"></i></a>
                                </div>
                            </div>
                            <div class="contact-ctn">
                                <div class="contact-ad-hd">
                                    <h2>${client.societe}</h2>
                                    <p class="ctn-ads">${client.adresse}</p>
                                </div>`;
                                if(client.client_type != 'Personne Morale')
                                contactElement +=`<p>-<span style ="font-weight: 800;">Nom complet : </span> <br> ${client.nom_complet}`;

                                if(client.client_secteur != 3)
                                contactElement +=`<p>-<span style ="font-weight: 800;">ICE:</span> ${client.ice}<br><span style ="font-weight: 800;">-RC:</span> ${client.rc}</p>`;

                              

                                
                                contactElement += `</div>
                            <div class="social-st-list">
                                <div class="social-sn">
                                    <h2>Type client </h2>
                                    <p>${client.client_type}</p>
                                </div>
                              
                                <div class="social-sn">
                                    <h2>Date d'entrée :</h2>
                                    <p>${client.date_d_entree}</p>
                                </div>
                                
                                
                            </div>
                            <br/>
                            <table class="table_respon">
                            <thead>
                            <tr><th colspan="4" style="text-align: center;">Responsable / Interlocuteur</th></tr>
                            <tr><th>Poste</th><th>Nom Complet</th><th>Telephone</th></tr></thead>
                            ${interlocutorsString}
                            </table>
                           
                            ${modalite_piement}
                        
                        </div>
                    </div>
               
            `;

            // Append the contact element to the clients-container div
            $('#clients-container').append(contactElement);


            if(i % 3 == 0 && i > 0)
            {
                
                // $('#clients-container').append(`${i}</div>`);
            }
            if(i % 3 == 0 && i > 0)
            {
                
                $('#clients-container').append(`&nbsp;<br/><br/><br/><br/><div class="row">`);
            }


            if(i == 0)
            i = i + 2;
            else
            i++;
        });
       }
       else
       {
        var contactElement = ` <h1 class="message_null">Aucun client n'a été trouvé... </h1> `;
        $('#clients-container').append(contactElement);
       }
    }
});