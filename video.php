<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
include ('headerV1.php');
   
?>

<!-- <script type="text/javascript" src="scripts/d3.v4.min.js"></script>
<script type="text/javascript" src="scripts/d3.v2.js"></script>
<script type="text/javascript" src="scripts/gauge.js"></script> -->
<input type="button" value="start gauge chart" onClick="initialize()">


    <span id="memoryGaugeContainer"></span>
		<span id="cpuGaugeContainer"></span>
		<span id="networkGaugeContainer"></span>
		<span id="testGaugeContainer"></span>







  <video id="video" width="720" height="560" autoplay muted> </video>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <!-- <script type="text/javascript" src="scripts/face-api.min.js"></script> -->
    <script type='text/javascript'>




      /////////////////////////////////////////////////////
      /////////////////////////////////////////////////////
			
				
var gauges = [];
			
			function createGauge(name, label, min, max)
			{
				var config = 
				{
					size: 240,
					label: label,
					min: undefined != min ? min : 0,
					max: undefined != max ? max : 100,
					minorTicks: 5
				}
				
        var range = config.max - config.min;
        
        config.greenZones = [{ from: config.min, to: config.min + range*0.65 }];
				config.yellowZones = [{ from: config.min + range*0.65, to: config.min + range*0.9 }];
				config.redZones = [{ from: config.min + range*0.9, to: config.max }];
				
				gauges[name] = new Gauge(name + "GaugeContainer", config);
				gauges[name].render();
			}
			
			function createGauges()
			{
				createGauge("memory", "TO");
				createGauge("cpu", "GP");
				createGauge("network", "COSTS");
			}
			
			function updateGauges()
			{
				for (var key in gauges)
				{
					var value = getRandomValue(gauges[key])
					gauges[key].redraw(value);
				}
			}
			
			function getRandomValue(gauge)
			{
				var overflow = 0; //10;
				return gauge.config.min - overflow + (gauge.config.max - gauge.config.min + overflow*2) *  Math.random();
			}
			
			function initialize()
			{
				createGauges();
				setInterval(updateGauges, 500);
      }
      

      /////////////////////////////////////////////////////
      /////////////////////////////////////////////////////





 


      google.charts.load('current', {'packages':['annotationchart']});
      google.charts.setOnLoadCallback(drawChart);

      google.charts.load('current', {'packages':['gauge']});
      google.charts.setOnLoadCallback(drawChart2);

      google.charts.load('current', {'packages':['gantt']});
      google.charts.setOnLoadCallback(drawChart3);

      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('date', 'Date');
        data.addColumn('number', 'Opex');
        data.addColumn('string', 'Kepler title');
        data.addColumn('string', 'Kepler text');
        data.addColumn('number', 'CAPEX');
        data.addColumn('string', 'Gliese title');
        data.addColumn('string', 'Gliese text');
        data.addRows([
          [new Date(2314, 2, 15), 12400, undefined, undefined,
                                  10645, undefined, undefined],
          [new Date(2314, 2, 16), 24045, 'Antalis', 'Antalist',
                                  12374, undefined, undefined],
          [new Date(2314, 2, 17), 35022, 'Antalis', 'Promotion',
                                  15766, 'Epicor', 'Pricing'],
          [new Date(2314, 2, 18), 12284, 'Antalis', 'Factoring',
                                  34334, 'Epicor', 'Cash manager'],
          [new Date(2314, 2, 19), 8476, 'Antalis', 'iScala',
                                  66467, 'Epicor', 'LV WMS'],
          [new Date(2314, 2, 20), 0, 'Antalis', 'Pivotal',
                                  79463, 'Epicor', 'Service connect']
        ]);

        var chart = new google.visualization.AnnotationChart(document.getElementById('chart_div'));

        var options = {
          displayAnnotations: true
        };

        chart.draw(data, options);
      }




      function drawChart2() {

      var data = google.visualization.arrayToDataTable([
        ['Label', 'Value'],
        ['TET',50],
        ['VIDERA', 55],
        ['EDISOFT',50],
        ['BAGUA', 115],
        ['ANDARES',3],
        ['CONSAFE', 55],
        ['Epicor', 68]
      ]);

      var options = {
        width: 1200, height: 240,
        redFrom: 80, redTo: 100,
        yellowFrom:65, yellowTo: 80,
        greenFrom:0, greenTo: 65,
        minorTicks: 5
      };

      var chart = new google.visualization.Gauge(document.getElementById('chart_div2'));

      chart.draw(data, options);

      setInterval(function() {
        data.setValue(0, 1, 40 + Math.round(60 * Math.random()));
        chart.draw(data, options);
      }, 13000);
      setInterval(function() {
        data.setValue(1, 1, 40 + Math.round(60 * Math.random()));
        chart.draw(data, options);
      }, 5000);
      setInterval(function() {
        data.setValue(2, 1, 60 + Math.round(20 * Math.random()));
        chart.draw(data, options);
      }, 26000);
      }



      function daysToMilliseconds(days) {
      return days * 24 * 60 * 60 * 1000;
    }

    function drawChart3() {

      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Task ID');
      data.addColumn('string', 'Task Name');
      data.addColumn('string', 'Resource');
      data.addColumn('date', 'Start Date');
      data.addColumn('date', 'End Date');
      data.addColumn('number', 'Duration');
      data.addColumn('number', 'Percent Complete');
      data.addColumn('string', 'Dependencies');

      data.addRows([
        ['Research', 'MI2', null,
         new Date(2020, 0, 27), new Date(2020, 4, 5), null,  100,  null],
        ['Write', 'LV Astro', 'write',
         null, new Date(2020, 7, 9), daysToMilliseconds(30), 25, 'Research,Outline'],
        ['Cite', 'EE iScala upgrade', 'write',
         null, new Date(2020,6, 7), daysToMilliseconds(100), 20, 'Research'],
        ['Complete', 'LT iScala upgrade', 'complete',
         null, new Date(2020,7, 10), daysToMilliseconds(50), 0, 'Cite,Write'],
        ['Outline', 'RU Invoice EDI', 'write',
         null, new Date(2020, 6, 6), daysToMilliseconds(70), 100, 'Research']
      ]);

      var options = {
        height: 275
      };

      var chart = new google.visualization.Gantt(document.getElementById('chart_div3'));

      chart.draw(data, options);
    }

</script>
<table border=1 cellpadding='20'>
  <tr><td>
  <div id="chart_div2" style="width: 1200px; height: 240px;"></div>
  <tr><td>
  <div id="chart_div3" style="width: 1500px; height: 240px;"></div>
  <tr ><td >
  <div id='chart_div' style='width: 900px; height: 500px;'></div>
  </table>


<?php

include ('footerV1.php');

?>