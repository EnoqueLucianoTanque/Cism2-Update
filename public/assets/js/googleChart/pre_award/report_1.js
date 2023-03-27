function drawMonthlyChart(chart_data, chart_main_title) {
    let jsonData = chart_data;

    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Estado');
    data.addColumn('number', 'Total');

    $.each(jsonData, (i, jsonData)=>{

        let state = jsonData.estado;
        let projet_total = parseInt($.trim(jsonData.projeto));
        data.addRows([
            [state, projet_total]
        ]);

    });

    var options = {
        title: 'Taxa de sucesso de propostas submetidas ',
        hAxis:{
            title: "Estado"
        },
        vAxis:{
            title: "Numero de projetos"
        },
        colors:['#016428','#FDC501', '#fff'],
        chartArea: {
            width: '60%',
            height: '80%'
        },
        is3D: true,
        legend: 'left'
    };

    var chart = new google.visualization.ColumnChart(document.getElementById('piechart_3d'));
    chart.draw(data, options);


}
function load_year_data(year, title){
    const temp_title = title+' '+year;
    $.ajax({
        url: '{{url("admin/chart/data")}}',
        method: "POST",
        data: {
            "_token": '{{csrf_token()}}',
            'year': year,
        },
        datatype: "JSON",
        success: function(data){
            drawMonthlyChart(JSON.parse(data), temp_title);
            $("#chart-example").show();
        }
    })
  }
