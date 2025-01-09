function confirmer_devis(current_element)
{
    let updateData = {
        numero_devis: current_element.id,
        confirmer: true
    };
    
    // Convert the JavaScript object to JSON string
    let jsonData = JSON.stringify(updateData);
    
    // Make a POST request to your server-side script (e.g., update_devis.php)
    fetch('../Controllers/listes_devis_confirmer.php', {
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


function annuler_devis(current_element)
{
    let updateData = {
        numero_devis: current_element.id,
        annuler: true
    };
    
    // Convert the JavaScript object to JSON string
    let jsonData = JSON.stringify(updateData);
    
    // Make a POST request to your server-side script (e.g., update_devis.php)
    fetch('../Controllers/listes_devis_annuler.php', {
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



function changeValueOfFilterDevis(element)
{
   var ele = element.value;
   if(ele == 0)
   {
       // Get the current URL
        const currentUrl = new URL(window.location.href);

        // Add a new parameter to the URL
        currentUrl.searchParams.set('devis_annuler', 'false');

        // Update the browser's address bar without reloading the page
        window.history.pushState({}, '', currentUrl);

        window.location.href = currentUrl.href;

        // Log the new URL to the console
        console.log(currentUrl.href);
   }
   else
   {
        // Get the current URL
        const currentUrl = new URL(window.location.href);

        // Add a new parameter to the URL
        currentUrl.searchParams.set('devis_annuler', 'true');

        // Update the browser's address bar without reloading the page
        window.history.pushState({}, '', currentUrl);

        window.location.href = currentUrl.href;

        // Log the new URL to the console
        console.log(currentUrl.href);
   }
}


// Get the current URL
const currentUrl = new URL(window.location.href);

// Get the value of a specific parameter
const paramValue = currentUrl.searchParams.get('devis_annuler');

// Log the parameter value to the console


if(paramValue == "true")
{
    document.querySelector("#filter_devis_01").value = "1";
}
else
{
    document.querySelector("#filter_devis_01").value = "0";
}



function open_paiements(current_element)
{
  // alert(current_element.id.split(';')[0]);

   $('#myModalone').modal('show');

   document.querySelector(".devis_id").innerHTML = current_element.id.split(';')[0];
   document.querySelector(".input_devis_id").value = current_element.id.split(';')[2];


}