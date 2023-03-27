
function drawBarChart(x_values, y_values, div_id, total, title){

    const ctx = document.getElementById(div_id).getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: x_values,
            datasets: [{
                label: title + ': '+total,
                data: y_values,
                backgroundColor: [
                    '#FDC501',
                    '#016428',
                    '#FDC501',
                    '#1118f0',
                    '#ba074f',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    '#FDC501',
                    '#016428',
                    '#FDC501',
                    '#1118f0',
                    '#ba074f',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

function drawPieChart(x_values, y_values, div_id, total){
    const ctx = document.getElementById(div_id).getContext('2d');
    const chart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: x_values,
            datasets: [{
                label: 'Número de Projetos '+total,
                data: y_values,
                backgroundColor: [
                    '#FDC501',
                    '#016428',
                    '#FDC501',
                    '#1118f0',
                    '#ba074f',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    '#FDC501',
                    '#016428',
                    '#FDC501',
                    '#1118f0',
                    '#ba074f',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            title: {
                display: true,
                text: "Evolução número dos projetos ativos"
              }
        }
      });
}
function drawPieChartWithPercent(x_values, y_values, div_id, total){
    var data = [
        {
            labels: x_values,
            datasets: [{
                label: 'Número de Projetos '+total,
                data: y_values,
                backgroundColor: [
                    '#FDC501',
                    '#016428',
                    '#FDC501',
                    '#1118f0',
                    '#ba074f',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    '#FDC501',
                    '#016428',
                    '#FDC501',
                    '#1118f0',
                    '#ba074f',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
    ];
      
      var options = {
        tooltips: {
          enabled: true
        },
        plugins: {
          datalabels: {
            formatter: (value, ctx) => {
      
              let sum = total;
              let percentage = (value * 100 / sum).toFixed(2) + "%";
              return percentage;
      
      
            },
            color: '#fff',
          }
        }
      };
      
      
      const ctx = document.getElementById(div_id).getContext('2d');
      var myChart = new Chart(ctx, {
        type: 'pie',
        data: data,
        options: options
      });
}



