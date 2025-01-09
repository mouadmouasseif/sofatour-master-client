function executerfetchdata() {
    const year = document.getElementById('year').value;
    const id_societe = document.getElementById('id_societe').value;
    const DeFa = document.getElementById('DeFa_001').value;
    console.log('id_societe ', id_societe);
    console.log('year ',year);        

    $(".spiinneeeer").show();

    fetch('../Controllers/Chiffre_d_affaire_par_personnel.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ year, DeFa, id_societe })
    })
        .then(response => response.json())
        .then(data => {
            const formatter = new Intl.NumberFormat('fr-FR', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
            console.log('Data reçu du serveur:', data); 
            const container = document.getElementById('results-container');
            container.innerHTML = ''; // Clear previous results

            let rowDiv = document.createElement('div');
            rowDiv.className = 'row';

            const data_chart = [];
            const data_chart_value = [];

            data.forEach((item, index) => {
                const colDiv = document.createElement('div');
                colDiv.className = 'col-lg-3 col-md-3 col-sm-3 col-xs-12';

                const cardDiv = document.createElement('div');
                cardDiv.className = 'card mb-4 add_card';

                const cardBodyDiv = document.createElement('div');
                cardBodyDiv.className = 'card-body';

                const cardTitle = document.createElement('h5');
                cardTitle.className = 'card-title add_h5';
                cardTitle.textContent = `${item.nom} ${item.prenom}`;

                data_chart.push(`${item.nom} ${item.prenom}`);
                data_chart_value.push(parseFloat(item.total_prix).toFixed(2));

                const cardText = document.createElement('p');
                cardText.className = 'card-text';
                cardText.textContent = 'CH :';

                const cardTextSpan = document.createElement('span');
                cardTextSpan.className = 'add_span';
                cardTextSpan.textContent = ` ${formatter.format(item.total_prix)} DH`;

                cardText.appendChild(cardTextSpan);
                cardBodyDiv.appendChild(cardTitle);
                cardBodyDiv.appendChild(cardText);
                cardDiv.appendChild(cardBodyDiv);
                colDiv.appendChild(cardDiv);
                rowDiv.appendChild(colDiv);

                if ((index + 1) % 4 === 0) {
                    container.appendChild(rowDiv);
                    rowDiv = document.createElement('div');
                    rowDiv.className = 'row';
                }
            });

            container.appendChild(rowDiv); // Append the last row

            const ctx = document.getElementById('barc01');
            if (data_chart.length > 0) {
                ctx.style.display = 'block';

                const existingChart = Chart.getChart(ctx);
                if (existingChart) {
                    existingChart.destroy();
                }

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: data_chart,
                        datasets: [
                            {
                                label: "Chiffre d'affaire",
                                data: data_chart_value,
                                backgroundColor: 'rgba(72, 179, 1, 0.5)',
                                borderColor: 'rgba(255, 99, 132, 1)',
                                borderWidth: 1
                            }
                        ]
                    },
                    options: {
                        plugins: {
                            legend: {
                                display: false
                            },
                            datalabels: {
                                display: true,
                                align: 'center',
                                anchor: 'center'
                            }
                        }
                    }
                });
            } else {
                ctx.style.display = 'none';
            }

            $(".spiinneeeer").hide();
        })
        .catch(error => {
            console.error('Error:', error);
            $(".spiinneeeer").hide();
        });
}

$(document).ready(function () {
$(".spiinneeeer").hide();



// Load initial data for the current year
executerfetchdata();

// Add event listeners for inputs if needed
document.getElementById('year').addEventListener('change', executerfetchdata);
document.getElementById('id_societe').addEventListener('change', executerfetchdata);
document.getElementById('DeFa_001').addEventListener('change', executerfetchdata);
});
