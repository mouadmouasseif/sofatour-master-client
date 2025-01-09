var global_current_element;

function open_paiements(current_element)
{
   //alert(current_element.id.split(';')[0]);
   global_current_element = current_element.id;
   $('#myModalone').modal('show');

  document.querySelector(".commentaire").value="";

}
function confirmer_paiement(current_element)
{
   console.log("current_element.id");
   console.log(global_current_element);
   
    let updateData = {
        numero_paiement: global_current_element,
        confirmer: 'Payé',
        commentaire :  document.querySelector(".commentaire").value
    };

    console.log(updateData);
    
    // Convert the JavaScript object to JSON string
    let jsonData = JSON.stringify(updateData);
    
    // Make a POST request to your server-side script (e.g., update_devis.php)
    fetch('../Controllers/listes_paiement_confirmer.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: jsonData
    })
    .then(response => response.json())
    .then(data => {
        console.log(data.message);
        cuteToast({
            type: "success", // or 'info', 'error', 'warning'
            title: "success",
            message: data.message,
            timer: 5000
            });
            setTimeout(() => {
                location.reload();
            },600)
    })
    .catch((error) => {
        console.error('Error updating data:', error);
        cuteToast({
            type: "success", // or 'info', 'error', 'warning'
            title: "success",
            message: error.message,
            timer: 5000
            });
    });
}


function refuser_paiement(current_element)
{
   console.log("current_element.id");
   console.log(global_current_element);
   
    let updateData = {
        numero_paiement: global_current_element,
        confirmer: 'Impayé',
        commentaire :  document.querySelector(".commentaire").value
    };

    console.log(updateData);
    
    // Convert the JavaScript object to JSON string
    let jsonData = JSON.stringify(updateData);
    
    // Make a POST request to your server-side script (e.g., update_devis.php)
    fetch('../Controllers/listes_paiement_confirmer.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: jsonData
    })
    .then(response => response.json())
    .then(data => {
        console.log(data.message);
        cuteToast({
            type: "success", // or 'info', 'error', 'warning'
            title: "success",
            message: data.message,
            timer: 5000
            });
            setTimeout(() => {
                location.reload();
            },600)
    })
    .catch((error) => {
        console.error('Error updating data:', error);
        cuteToast({
            type: "success", // or 'info', 'error', 'warning'
            title: "success",
            message: error.message,
            timer: 5000
            });
    });
}



function en_attente_paiement(current_element)
{
   console.log("current_element.id");
   console.log(global_current_element);
   
    let updateData = {
        numero_paiement: global_current_element,
        confirmer: 'En attente',
        commentaire :  document.querySelector(".commentaire").value
    };

    console.log(updateData);
    
    // Convert the JavaScript object to JSON string
    let jsonData = JSON.stringify(updateData);
    
    // Make a POST request to your server-side script (e.g., update_devis.php)
    fetch('../Controllers/listes_paiement_confirmer.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: jsonData
    })
    .then(response => response.json())
    .then(data => {
        console.log(data.message);
        cuteToast({
            type: "success", // or 'info', 'error', 'warning'
            title: "success",
            message: data.message,
            timer: 5000
            });
            setTimeout(() => {
                location.reload();
            },600)
    })
    .catch((error) => {
        console.error('Error updating data:', error);
        cuteToast({
            type: "success", // or 'info', 'error', 'warning'
            title: "success",
            message: error.message,
            timer: 5000
            });
    });
}





function afficher_doc(ele)
{
   //alert(ele.id);
   $('#myModalone_2').modal('show');
   document.querySelector('._iframe').src= ele.id

}