<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Highcharts Example</title>

        <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.1.js"></script>
        <script type="text/javascript" src="http://code.highcharts.com/highcharts.js"></script>

    </head>
    <?php
	if(!is_numeric($_GET["id"])) {
		echo "ID must be numeric";
		exit;
	}
	$id=$_GET["id"];

	echo "<center><a href=index.php?id=$id>Historic Graph</a> |<a href=rt.php?id=$id>Real Time Table View</a> | <a href=rtg.php?id=$id>Real Time Graph</a> | <a href=csv.php?id=$id>Export</a></center>";
    ?>


	<script>
	//Adapted from: https://stackoverflow.com/questions/43572318/live-data-from-mysql-with-highchart
	var chart; 
    		
    		function requestData() {
    			$.ajax({
			url: 'live-server-data.php?id= <?php echo $id; ?>', 
    				success: function(point) {
    					var series = chart.series[0],
    						shift = series.data.length > 20; // shift if the series is longer than 20
    		
    					chart.series[0].addPoint(eval(point), true, shift);
    					
    					// call it again after one second
    					setTimeout(requestData, 1000);	
    				},
    				cache: false
    			});
    		}
    			
    		$(document).ready(function() {
    			chart = new Highcharts.Chart({
    				chart: {
    					renderTo: 'container',
    					defaultSeriesType: 'spline',
    					events: {
    						load: requestData
    					}
    				},
    				title: {
				text: 'Live data from s1 (ID=<?php echo $id; ?>)'
    				},
    				xAxis: {
    					type: 'datetime',
    					tickPixelInterval: 150,
    					maxZoom: 20 * 1000
    				},
    				yAxis: {
    					minPadding: 0.2,
    					maxPadding: 0.2,
    					title: {
    						text: 'Value',
    						margin: 80
    					}
    				},
    				series: [{
    					name: 'Live data',
    					data: []
    				}]
    			});		
    		});
	</script>
    <body>
        <div id="container" style="width: 800px; height: 400px; margin: 0 auto"></div>
    </body>
</html>
