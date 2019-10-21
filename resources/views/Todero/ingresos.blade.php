@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 3%">
        <div class="row">
            <div class="col-md-12" align="center">
                <h1><i class="fas fa-search-dollar iconColor"></i>Tus ingresos son de : ${{$ingresos}} pesos</h1>
                <br><br>
                <a href=""><i class="fas fa-hand-holding-usd fa-4x iconColorBlack"></i></a>
                <p>Click para solicitar retiro</p>
            </div>
        </div>
        <br><br>
        <div class="row">
            <div class="col-md-6">
                <div id="chart_div"></div>
            </div>
            <div class="col-md-6">
                <div id="curve_chart"></div>
            </div>
        </div>
    </div>

@endsection
@section('contentScript')
    <script>
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Year', 'Sales', 'Expenses'],
                ['2013',  1000,      400],
                ['2014',  1170,      460],
                ['2015',  660,       1120],
                ['2016',  1030,      540]
            ]);

            var options = {
                title: 'Company Performance',
                hAxis: {title: 'Year',  titleTextStyle: {color: '#333'}},
                vAxis: {minValue: 0}
            };

            var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }

        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart2);

        function drawChart2() {
            var data = google.visualization.arrayToDataTable([
                ['Year', 'Sales', 'Expenses'],
                ['2004',  1000,      400],
                ['2005',  1170,      460],
                ['2006',  660,       1120],
                ['2007',  1030,      540]
            ]);

            var options = {
                title: '',
                curveType: 'function',
                legend: { position: 'bottom' },
                backgroundColor: { fill:'transparent' }
            };

            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

            chart.draw(data, options);
        }
    </script>
@endsection
