
   
 
         
getevent();    

            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
               locale: 'FR',
               views: {
                   month: {
                           type: 'dayGridMonth',
                           buttonText: 'Mois'
                       },
                       week: {
                           type: 'timeGridWeek',
                           duration: { days: 7 },
                           buttonText: 'Semaine'
                       },
                       day: {
                           type: 'timeGridDay',
                           duration: { days: 1 },
                           buttonText: 'Jour'
                       },
                       liste: {
                           type: 'listWeek',
                           buttonText: 'Par liste'
                       }
                   },
                   headerToolbar: {
                       left: 'prev,next today',
                       center: 'title',
                       right: 'month,week,day,liste'
                   },
                   initialView: 'month',
                   buttonText: {
                   today: 'Aujourd\'hui' // Customized today button text
                   },
                   eventMouseEnter: function(info) {
                   // var tooltip = new Tooltip(info.el, {
                   //     title: info.event.extendedProps.description,
                   //     placement: 'top',
                   //     trigger: 'hover',
                   //     container: 'body'
                   // },'');
                //    console.log("hi");
                   $('#detail_event').text(info.event.extendedProps.description);
                   },
                   eventSources: [
                       {
                           events: getevent,
                           id: "custom"
                       },
                    ],
                    eventClick: function (info) {
                        document.querySelector("#anuulation_libeller_01").parentElement.parentElement.style.display = "none";
                        document.querySelector("#anuulation_libeller_01").value = '';
                        document.querySelector("#anuulation_01").value = 0;

                       console.log(info.event);
                      // $('#title_event_00').modal('show');
                       $('#myModalone').modal('show');

                       let inputString = info.event.extendedProps.description;
                       let keywords = ['Du', 'A', 'Société', 'créé par'];

                       let extractedInfo = extractInfo(inputString, keywords);
                       console.log(extractedInfo);

                       $('#title_event_00').text(extractedInfo['Société']);
                       $('#du_event_00').text(extractedInfo['Du']);
                       $('#a_tel_event_00').text(extractedInfo['A']);
                       $('#creer_par_event_00').text(extractedInfo['créé par']);
                       $('#det_event_00').text(info.event._def.title);
                       //$('#url_ev_001').text( )
                       sendDevisData();
                       //https://sophatour.ma/MA/Ressources/Document.php?prix_ttc=8800&id_client=157&societe=SMT&De_Fa=Devis&numero_devis=001/2023&version=1


                       
                    //    console.log("From Date:", extractedInfo);
        
                       console.log(info.event);
                        document.querySelector('.confirmer_b').id = info.event._def.publicId;
                        document.querySelector('.annuler_b').id = info.event._def.publicId;
                    }
                   // events :  events
               
               });
           calendar.render();

var value_filter = [true , true , true];

function supp_affi(current_element)
{
    var colors = ['#00a56e' , '#f3b600' , '#ff5050']
    for(let i = 1 ; i < 4 ; i++)
    {
        if(current_element.id == 'active_00' + i ) 
        {
            $('#active_00'+ i).css('background', '#fff');
            $('#active_00'+ i).attr('id', 'desactive_00' + i);
            value_filter[i-1] = false;
            break;
    
        }
        else if(current_element.id == 'desactive_00' + i)
        {
            $('#desactive_00'+ i).css('background', colors[i-1]);
            $('#desactive_00'+ i).attr('id', 'active_00' + i);
            value_filter[i-1] = true;
            break;
        }
    }
    
    calendar.refetchEvents();
}

function extractInfo(inputString, keywords) {
    let info = {};

    for (const keyword of keywords) {
        let regex = new RegExp(keyword + '\\s+-([^/]+)');
        let matches = inputString.match(regex);
        if (matches) {
            let value = matches[1].trim();
            // Check if there's another keyword after this one
            let nextKeywordIndex = inputString.indexOf(keyword, matches.index + matches[0].length);
            if (nextKeywordIndex !== -1) {
                // If another keyword is found, only take the part before it
                value = value.substring(0, nextKeywordIndex - matches.index).trim();
            }
            info[keyword] = value;
        } else {
            info[keyword] = null;
        }
    }

    // Adjust "créé par" if it's part of the "Société" value
    if (info['Société'] && info['créé par']) {
        let sociétéParts = info['Société'].split(' créé par ');
        if (sociétéParts.length > 1) {
            info['Société'] = sociétéParts[0].trim();
            info['créé par'] = sociétéParts[1].trim();
        }
    }

    return info;
}



function getevent(info , successCallback , failureCallback)
{
    $(".spiinneeeer").show();
     // Process the received data and display it on the page

    const societeFilter = document.getElementById('societe_filter');
    const selectedSociete = societeFilter ? societeFilter.value : '0'; 

     var events = [];
     fetch('../Controllers/agenda.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({societe: selectedSociete})
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
       
    })
        .then(data => {
            const events = [];

            // Process the received data and display it on the page
            for (let i = 0; i < data.length; i++) {
                const event = data[i];

                if (event.confirmer && value_filter[0] && !event.annuler) {
                    events.push({
                        id: event.Numero_devis,
                        title: `${event.Numero_devis} ${event.objet}`,
                        description: `Du - ${event.du_date} / A - ${event.a_tel_date} / Société - ${event.societe} créé par - ${event.nom} ${event.prenom}`,
                        start: event.du_date,
                        end: event.a_tel_date,
                        color: '#00a56e',
                        textColor: 'white'
                    });
                } else if (!event.confirmer && !event.annuler) {
                    const duDate = new Date(event.du_date);
                    const currentDate = new Date();
                    const timeDifferenceInDays = (duDate - currentDate) / (1000 * 60 * 60 * 24);

                    if (timeDifferenceInDays > -6 && timeDifferenceInDays < 0 && value_filter[2]) {
                        events.push({
                            id: event.Numero_devis,
                            title: `${event.Numero_devis} ${event.objet}`,
                            description: `Du - ${event.du_date} / A - ${event.a_tel_date} / Société - ${event.societe} créé par - ${event.nom} ${event.prenom}`,
                            start: event.du_date,
                            end: event.a_tel_date,
                            color: '#f3b600',
                            textColor: 'black'
                        });
                    } else if ((timeDifferenceInDays < -6 || timeDifferenceInDays > 0) && value_filter[1]) {
                        events.push({
                            id: event.Numero_devis,
                            title: `${event.Numero_devis} ${event.objet}`,
                            description: `Du - ${event.du_date} / A - ${event.a_tel_date} / Société - ${event.societe} créé par - ${event.nom} ${event.prenom}`,
                            start: event.du_date,
                            end: event.a_tel_date,
                            color: '#f4ff50',
                            textColor: 'black'
                        });
                    }
                } else if (event.annuler) {
                    events.push({
                        id: event.Numero_devis,
                        title: `${event.Numero_devis} ${event.objet}`,
                        description: `Du - ${event.du_date} / A - ${event.a_tel_date} / Société - ${event.societe} créé par - ${event.nom} ${event.prenom}`,
                        start: event.du_date,
                        end: event.a_tel_date,
                        color: '#ff5050',
                        textColor: 'white'
                    });
                }
            }

            successCallback(events);

            $(".spiinneeeer").hide();
        })
        .catch(error => {
            console.error('Error fetching data:', error);
            failureCallback(error);
        });
}

function updateAgendaBySociete() {
    const societeId = document.getElementById('societe_filter').value;

    $(".spiinneeeer").show();

    calendar.refetchEvents();
}

// document.getElementById('societe_filter').addEventListener('change', updateAgendaBySociete);

function convertdate(dateString)
{

    // Create a new Date object for the end date and set it to one day after the start date
    var endDate = new Date(dateString);
    endDate.setDate(endDate.getDate() + 1);

    // Adjust the time to midnight for both start and end dates
    endDate.setHours(0, 0, 0, 0);

    var endYear = endDate.getFullYear();
    var endMonth = endDate.getMonth() + 1; // Months are zero-based, so add 1
    var endDay = endDate.getDate();

    return endYear + "-" + endMonth + "-" + endDay;
}


function relancerCalendrier()
{

        // Process the received data and display it on the page
        // console.log(data);
        var events = [];
        for(let i = 0 ; i < data.length ; i++)
        {
            if(data[i].confirmer == true && value_filter[0] == true && data[i].annuler == false)
            {
               
                events.push({
                title:  data[i].Numero_devis + ' ' + data[i].objet  ,
                description: 'Du -' + data[i].du_date + '/ A -' + data[i].a_tel_date +'/ Société -'+data[i].societe + ' créé par -' + data[i].nom + ' ' + data[i].prenom  ,
                start: data[i].du_date  , 
                end: data[i].a_tel_date ,
                color: '#00a56e',
                textColor: 'white' 
                })
            }
             if(data[i].confirmer == false && data[i].annuler == false)
            {
               
                var duDate = new Date(data[i].du_date);
                var currentDate = new Date();
                var timeDifferenceInMilliseconds = duDate - currentDate;
                var timeDifferenceInDays = timeDifferenceInMilliseconds / (1000 * 60 * 60 * 24);
                //var absoluteTimeDifferenceInDays = Math.abs(timeDifferenceInDays);

                // console.log(data[i].Numero_devis , timeDifferenceInDays);

                if (timeDifferenceInDays > -6 && timeDifferenceInDays < 0 && value_filter[2] == true) {
                    events.push({
                    title:  data[i].Numero_devis + ' ' + data[i].objet  ,
                    description: 'Du -' + data[i].du_date + '/ A -' + data[i].a_tel_date +'/ Société -'+data[i].societe + ' créé par -' + data[i].nom + ' ' + data[i].prenom  ,
                    start: data[i].du_date  , 
                    end: data[i].a_tel_date ,
                    color: '#f3b600',
                    textColor: 'black' 
                    });
                }else if( (timeDifferenceInDays < -6 || timeDifferenceInDays > 0) && value_filter[1] == true)
                {
                    events.push({
                    title:  data[i].Numero_devis + ' ' + data[i].objet  ,
                    description: 'Du -' + data[i].du_date + '/ A -' + data[i].a_tel_date +'/ Société -'+data[i].societe + ' créé par -' + data[i].nom + ' ' + data[i].prenom  ,
                    start: data[i].du_date  , 
                    end: data[i].a_tel_date ,
                    color: '#f4ff50',
                    textColor: 'black' 
                    });
                }
            }

            if(data[i].annuler == true)
            {
                events.push({
                    title:  data[i].Numero_devis + ' ' + data[i].objet  ,
                    description: 'Du -' + data[i].du_date + '/ A -' + data[i].a_tel_date +'/ Société -'+data[i].societe + ' créé par -' + data[i].nom + ' ' + data[i].prenom  ,
                    start: data[i].du_date  , 
                    end: data[i].a_tel_date ,
                    color: '#ff5050',
                    textColor: 'white' 
                    })
            }
         
        }
        // console.log(events);
        // return events;
        // var calendarEl = document.getElementById('calendar');
        // var calendar = new FullCalendar.Calendar(calendarEl, {
        //     locale: 'FR',
        //     views: {
        //         month: {
        //                 type: 'dayGridMonth',
        //                 buttonText: 'Mois'
        //             },
        //             week: {
        //                 type: 'timeGridWeek',
        //                 duration: { days: 7 },
        //                 buttonText: 'Semaine'
        //             },
        //             day: {
        //                 type: 'timeGridDay',
        //                 duration: { days: 1 },
        //                 buttonText: 'Jour'
        //             },
        //             liste: {
        //                 type: 'listWeek',
        //                 buttonText: 'Par liste'
        //             }
        //         },
        //         headerToolbar: {
        //             left: 'prev,next today',
        //             center: 'title',
        //             right: 'month,week,day,liste'
        //         },
        //         initialView: 'month',
        //         buttonText: {
        //         today: 'Aujourd\'hui' // Customized today button text
        //         },
        //         eventMouseEnter: function(info) {
        //         // var tooltip = new Tooltip(info.el, {
        //         //     title: info.event.extendedProps.description,
        //         //     placement: 'top',
        //         //     trigger: 'hover',
        //         //     container: 'body'
        //         // },'');
        //         console.log("hi");
        //         $('#detail_event').text(info.event.extendedProps.description);
        //         },
        //         // eventSources: [
        //         //     {
        //         //         events: getEvent(),
        //         //         id: "custom"
        //         //     },
        //         //  ]
        //         events :  getEvent()
            
        //     });
        calendar.refetchEvents()
            //calendar.fullCalendar('refetchEvents');
   
  
}


function confirmer_devis(current_element)
{
    let updateData = {
        numero_devis: current_element.id,
        confirmer: true
    };

    console.log(updateData);
    
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
            calendar.refetchEvents();
            // setTimeout(() => {
            //     location.reload();
            // },600)
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
   var anuulation =  document.querySelector("#anuulation_01").value ;
   var cause =  document.querySelector("#anuulation_libeller_01").value ;

    if((anuulation > 0 && cause != '')|| (anuulation == 4 && cause == ''))
    {
            let updateData = {
                numero_devis: current_element.id,
                annuler: true,
                annulation : anuulation,
                cause : cause
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
                    calendar.refetchEvents();

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
    else
    {
        cuteToast({
            type: "error", // or 'info', 'error', 'warning'
            title: "error",
            message: "Remplir la cause d'annulation",
            timer: 5000
            });
    }
}


function sendDevisData() {
    var detEventValue = document.getElementById("det_event_00").innerText.split(' ')[0]; // Get the value of 'det_event_00'

    // Use fetch to send the value to the PHP back-end
    fetch('../Controllers/path_devis.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'det_event=' + encodeURIComponent(detEventValue)  // Send the data in the body
    })
    .then(response => response.text())  // Handle the response as text
    .then(data => {
        console.log(data);  // Log the server response or do something with it
        // Optionally, update the page with the returned content
        document.getElementById('url_ev_001').innerHTML = data;  // Insert the returned link in the page
    })
    .catch(error => console.error('Error:', error));
}


function changeValueOfAnnulation(element,id)
{
    var annulation_id = element.value;
    document.querySelector("#anuulation_libeller_01").parentElement.parentElement.style.display = "";

    if(annulation_id == 1)
    {
       document.querySelector("#anuulation_libeller_01").value = '';
       document.querySelector("#anuulation_libeller_01").placeholder = 'Veuillez préciser la date ici ex: 02/12/1993....';
    }
    else if(annulation_id == 2)
    {
        document.querySelector("#anuulation_libeller_01").value = '';
        document.querySelector("#anuulation_libeller_01").placeholder = 'Veuillez préciser où ....';
    }
    else if(annulation_id == 3)
    {
        document.querySelector("#anuulation_libeller_01").value = '';
        document.querySelector("#anuulation_libeller_01").placeholder = 'Veuillez préciser raison ....';
    }
    else if(annulation_id == 4)
    {
        document.querySelector("#anuulation_libeller_01").value = '';
        document.querySelector("#anuulation_libeller_01").parentElement.parentElement.style.display = "none";
    }
    else if(annulation_id == 5)
    {
        document.querySelector("#anuulation_libeller_01").value = '';
        document.querySelector("#anuulation_libeller_01").placeholder = 'Descrition ....';
    }
}

document.querySelector("#anuulation_libeller_01").parentElement.parentElement.style.display = "none";


$('#myModalone').on('hidden.bs.modal', function () {
    // Hide or remove the first modal backdrop here
    $('.modal-backdrop').first().hide(); // or $('.modal-backdrop').first().remove();

});