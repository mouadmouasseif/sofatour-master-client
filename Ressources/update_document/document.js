function edit_entete_doc() {
    $("#edit_open_doc").hide();
    $("#edit_close_doc").show();

    $("#input_date_de_devis").show();
    $("#value_date_de_devis").hide();

    $("#a_devis_input").show();
    $("#a_devis_value").hide();

    $("#input_date_de_devis_01").val( $("#value_date_de_devis").text().split(' ')[1].split('/')[2] + '-' + $("#value_date_de_devis").text().split(' ')[1].split('/')[1] + '-' + $("#value_date_de_devis").text().split(' ')[1].split('/')[0]  ) ;
   

    $("#a_devis_field").val( $("#a_devis_value").text().split('A : ')[1])

}

let modificationsEffectuees = false; 

$("#a_devis_input, #input_date_de_devis").on("input change", function() {
    modificationsEffectuees = true;
});

function terminer_edit_entete_doc() {
    $("#edit_open_doc").show();
    $("#edit_close_doc").hide();

    $("#input_date_de_devis").hide();
    $("#value_date_de_devis").show();

    $("#a_devis_input").hide();
    $("#a_devis_value").show();

    if (modificationsEffectuees) {
        window.location.reload();
        modificationsEffectuees = false; 
    }
}


function update_devis_field(element, field , defa) {
    const value = element.value;

    const a_devis = $("#a_devis_field").val();
    const le_devis = $("#input_date_de_devis_01").val(); 


    const data = { a_devis: a_devis, le_devis: le_devis , De_Fa: defa };

    console.log(data);

    fetch('../Controllers/document.php?numero_devis_facture=' + numero_devis_facture, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data),
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                if (field === 'date_devis') {
                    $("#value_date_de_devis").text('LE ' + le_devis);
                } else if (field === 'a_devis') {
                    $("#a_devis_value").text('A : ' + a_devis);
                }
                console.log("Modifications enregistrées avec succès :", data.message);
            } else {
                console.error("Erreur lors de l'enregistrement :", data.message);
            }
        })
        .catch(error => {
            console.error("Erreur lors de l'envoi des données :", error);
        });



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
}
