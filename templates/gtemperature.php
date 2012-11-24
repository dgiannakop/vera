<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Vera Home Monitoring</title>
	<link rel="icon" href="/vera/favicon.png">	
	<link href="/vera/bootstrap/css/bootstrap.css" rel="stylesheet">
	<link href="/vera/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>	
	<script type="text/javascript" src="/vera/bootstrap/js/bootstrap.min.js"></script>
	<script src="../js/highstock.js"></script>
	<script type="text/javascript">
	$(function() {
	
	$.getJSON('http://kamaji/vera/temp/temp_365.json', function(data) {

		Highcharts.setOptions({
	lang: {
		months: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 
			'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
		weekdays: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi']
	}
	});
		// Create the chart
		window.chart = new Highcharts.StockChart({
			chart : {
				renderTo : 'container'
			},
			xAxis: {
                    type: 'datetime',
				dateTimeLabelFormats: {
            	day: '%A',
            	hour: '%H:00',
       			 }
                },
			yAxis: {
                    title: {
						text:'Température en °C',
					
					},
					plotLines : [{
                    value : 21,
                    color : 'red',
                    dashStyle : 'shortdash',
                    width : 1,
                    label : {
                        text : 'Confort Haut',
						align: 'right',
                    }
                }, {
                    value : 18,
                    color : 'blue',
                    dashStyle : 'shortdash',
                    width : 1,
                    label : {
                        text : 'Confort Bas',
						align: 'right',
                    	y: 12,
                    }
                }]					
                },
			rangeSelector : {
				buttons: [
					{
						type: 'day',
						count: 1,
						text: '1d'
					},
					{
						type: 'day',
						count: 15,
						text: '15d'
					},
					{
						type: 'month',
						count: 1,
						text: '1m'
					}, {
						type: 'month',
						count: 3,
						text: '3m'
					}, {
						type: 'month',
						count: 6,
						text: '6m'
					}, {
						type: 'ytd',
						text: 'YTD'
					}, {
						type: 'year',
						count: 1,
						text: '1y'
					}, {
						type: 'all',
						text: 'All'
					}],
				selected : 1
			},
			tooltip: {
                xDateFormat: '%d/%m/%Y %H:%M',
				ySuffix:'°C',
				valueDecimals: 1

            },
			title : {
				text : ''
			},
			legend: {
            enabled: true,
            align: 'right',
            //backgroundColor: '#FCFFC5',
            borderColor: 'black',
            borderWidth: 2,
            layout: 'vertical',
            verticalAlign: 'top',
            y: 100,
            shadow: true
        },

			
			series : data,
					});
	});

});
	</script>
<style>
.well:hover{
	background-color: #eee;
}
</style>
</head>
<body>
<div class="container">
	<div class="navbar">
	  <div class="navbar-inner">
		<div class="container">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </a>
		<span class="brand">
			<img src="/vera/img/leaf.png"> Vera Monitoring
		</span>
			<ul class="nav nav-collapse">
				<li><a href="/vera">Home</a></li>
				<li><a href="/vera/console">Console</a></li>
				<li><a href="/vera/graph/temperature">Températures</a></li>
				<li><a href="/vera/graph/energy">Energie</a></li>
				<li><a href="/vera/graph/hum">Humidité</a></li>
				<li><a href="/vera/admin">admin</a></li>
			</ul>
		</div>
	  </div>
	</div>
</div>
<div class="container">
		<h2>Courbe des Températures</h2>
		<div id="container" style="height: 500px; min-width: 500px"></div>
</div>
</body>
</html>