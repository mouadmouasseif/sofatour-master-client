var dataResult = "";

document.addEventListener("DOMContentLoaded", function() {
    fetch('../Controllers/list_mode_paiement.php')
        .then(response => response.json())
        .then(data => {
            dataResult = data;
            console.log(dataResult);
        })
        .catch(error => console.error('Error fetching data:', error));
});

// Handles live/dynamic element events, i.e. for newly created trash buttons
$(document).on("click", ".PaiementCreationTable-trash", function () {
	// Remove selected row from table
	$(this).closest("tr").remove();
});

$(".PaiementCreationTable-new-row").on("click", function () {
    var tableBody = $(this).closest("tbody"),
        trNew = '<tr class="PaiementCreationRow">' +
            '<td class="PaiementCreationTable-name">' +
            '<select class="dropdown_custom" name="PaiementCreationTable-name[]" required>' +
            '<option value="">*Choisissez le mode...</option>';
            
    for (const id in dataResult) {
        const key = id; 
        const value = dataResult[id]; 
        trNew += '<option value="'+key+'">'+value+'</option>';
    }
    
    trNew += '</select>' +
            '</td><td class="PaiementCreationTable-data">' +
            '<input class="PaiementCreationTable-input" type="text" name="PaiementCreationTable-data[]"  required>' +
            '</td><td class="PaiementCreationTable-document">' +
            '<input class="PaiementCreationTable-input file_type" type="file" accept=".pdf, .jpeg, .jpg, .png" name="PaiementCreationTable-document[]" required>' +
            '</td><td class="PaiementCreationTable-exonerer">' +
            '<input class="PaiementCreationTable-input" type="checkbox" name="PaiementCreationTable-exonerer[]" >' +
            '</td><td class="PaiementCreationTable-trash"><i class="fa fa-trash" aria-hidden="true"></i></td></tr>';
    tableBody.find("tr:last").before(trNew);
});

// Add form submit event listener

// onchange="mode_piem_change(this);" 
// function mode_piem_change(ele)
// {
//     if(ele.value != "1")
//     {
//         ele.parentNode.parentNode.querySelector('.file_type').setAttribute("required", "");
//     }
// }



document.getElementById('paymentForm').addEventListener('submit', async (event) => {
    event.preventDefault();
    const formData = new FormData(document.getElementById('paymentForm'));

    const files = document.querySelectorAll('input[type="file"]');
    let valid = true;
 

      // Check payment details
      const amounts = document.querySelectorAll('input[name="PaiementCreationTable-data[]"]');
      const modes = document.querySelectorAll('select[name="PaiementCreationTable-name[]"]');
      amounts.forEach(amountInput => {
         
            const amountValue = parseFloat(amountInput.value);
            if (isNaN(amountValue) || amountValue <= 0) {
                valid = false;
                cuteToast({
                    type:  'error', // or 'info', 'error', 'warning'
                    title:  'error' ,
                    message: "Le montant doit être un nombre positif valide.",
                    timer: 3000
                    });
                return;
            }
          
      });
      modes.forEach(modeSelect => {
          if (!modeSelect.value.trim()) {
              valid = false;
              cuteToast({
                type:  'error', // or 'info', 'error', 'warning'
                title:  'error' ,
                message: "Le mode de paiement doit être sélectionné",
                timer: 3000
                });
          }
      });



// Check file sizes
    files.forEach(fileInput => {
        for (let i = 0; i < fileInput.files.length; i++) {
            if (fileInput.files[i].size > 1.2 * 1024 * 1024) { // 4 MB
                valid = false;
                //alert('Chaque fichier doit être inférieur à 4 Mo');
                cuteToast({
                    type:  'error', // or 'info', 'error', 'warning'
                    title:  'error' ,
                    message: "Chaque fichier doit être inférieur à 1.2 Mo",
                    timer: 3000
                    });
                break;
            }
        }
    });

    if (!valid) return;

    try {
        const response = await fetch('../Controllers/save_payment.php', {
            method: 'POST',
            body: formData
        });

        const result = await response.json();
        console.log(result);
        for(let i = 0 ; i < result.length ; i++)
            {
             
                cuteToast({
                    type: result[i].status, // or 'info', 'error', 'warning'
                    title: result[i].status ,
                    message:  result[i].message,
                    timer: 5000
                    });
            }
            $('#myModalone').modal('hide');
    } catch (error) {
        console.error('Error:', error);
    }
});

// form.addEventListener('submit', function(event) {
//     event.preventDefault(); // Prevent default submission
    
//     //+++++++++++++++++++++++++++++ Responsable / Interlocuteur
//     var paiements = []; // = new responsable_interlocuteur();
//     var forms_respon = this.document.querySelectorAll('.PaiementCreationRow');
//     for(let i = 0 ; i < forms_respon.length ; i++)
//     {
//      var item = new paiements();
//     //  if(verifier_value(forms_respon[i].querySelector('[name="type_responsable_interlocuteur"]').value) 
//     //  || verifier_value(forms_respon[i].querySelector('[name="email"]').value) 
//     //   || verifier_value(forms_respon[i].querySelector('[name="nom_complet"]').value) 
//     //  || !window.intlTelInputGlobals.getInstance(forms_respon[i].querySelector('[name="telephone"]')).isValidNumber())
//     //  {
//     //      if(!window.intlTelInputGlobals.getInstance(forms_respon[i].querySelector('[name="telephone"]')).isValidNumber())
//     //      {
//     //          form_validation_telephone = false;
//     //      }

//     //      form_validation = false;
//     //      break;
//     //  }
//     //  else
//     //  {
//          item.nom_complet =  forms_respon[i].querySelector('[name="nom_complet"]').value;
//          item.email =  forms_respon[i].querySelector('[name="email"]').value;
//          item.c_responsable_interlocuteur =  forms_respon[i].querySelector('[name="type_responsable_interlocuteur"]').value;
//          item.numero_telephone = window.intlTelInputGlobals.getInstance(forms_respon[i].querySelector('[name="telephone"]')).getNumber(); 
//          item.clients = 'ID_client'; // ID_client
//      }
//         paiements.push(item);
//     // }
//       console.log(paiements);
//      //+++++++++++++++++++++++++++++ Responsable / Interlocuteur

//     // // Perform verification
//     // const paymentMode = document.getElementById('payment_mode').value;
//     // const paymentData = document.getElementById('payment_data').value;

//     // if (!paymentMode) {
//     //     alert('Please select a payment mode.');
//     //     return;
//     // }

//     // if (!paymentData) {
//     //     alert('Please enter payment data.');
//     //     return;
//     // }

//     // // If verification is successful, submit the form programmatically
//     // form.submit();
// });
