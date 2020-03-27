<?php


if(isset($_GET["l1"])) {
	$l1 = $_GET["l1"];
} else {
	$l1 = "Sensor 1";
}

if(isset($_GET["l2"])) {
	$l2 = $_GET["l2"];
} else {
	$l2 = "Sensor 2";
}


if(isset($_GET["l3"])) {
	$l3 = $_GET["l3"];
} else {
	$l3 = "Sensor 3";
}


if(!isset($_GET["id"])) {
	echo "Select an ID. For example: ";
	echo "<br><br><a href=index.php?id=10>index.php?id=10</a>";
        exit;
}

if(!is_numeric($_GET["id"])) {
	echo "ID must be numeric";
        exit;
}

$id=$_GET["id"];
echo "<center><h2>BIPES IOT Monitoring (id=$id)</h2></center>";
echo "<center><a href=index.php?id=$id>Historic Graph</a> |<a href=rt.php?id=$id>Real Time Table View</a> | <a href=rtg.php?id=$id>Real Time Graph</a> | <a href=csv.php?id=$id>Export</a></center>";

$date = new DateTime();
$t=date_format($date, 'Y-m-d H:i:s');
//$f="2018-01-21 00:00:00";
$f=date('Y-m-d H:i:s', strtotime('-350 minutes'));

$url = "data.php?id=$id&l1=$l1&l2=$l2&l3=$l3&from=$f&to=$t";

if(isset($_GET["from"])) { 
	if(isset($_GET["to"]))  {
		$f = $_GET["from"];
		$t = $_GET["to"];
		$url = "data.php?id=$id&l1=$l1&l2=$l2&l3=$l3&from=$f&to=$t";
	}
}


?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Monitoramento IOT</title>

		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<script type="text/javascript">
$(function () {
    var chart;
    $(document).ready(function() {
        $.getJSON("<?php echo $url; ?>", function(json) {
	    
		    chart = new Highcharts.Chart({
	            chart: {
	                renderTo: 'container',
	                type: 'line',
	                marginRight: 130,
	                marginBottom: 25
	            },
	            title: {
	                text: 'Data from the last 300 min',
	                x: -20 //center
	            },
	            subtitle: {
	                text: '',
	                x: -20
	            },
	            xAxis: {
	                //categories: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12']
		    	      type: 'datetime',
	            },
	            yAxis: {
	                title: {
	                    text: 'Leitura'
	                },
	                plotLines: [{
	                    value: 0,
	                    width: 1,
	                    color: '#808080'
	                }]
	            },
	            tooltip: {
	                formatter: function() {
	                        return '<b>'+ this.series.name +'</b><br/>'+
	                        this.x +': '+ this.y;
	                }
	            },
	            legend: {
	                layout: 'vertical',
	                align: 'right',
	                verticalAlign: 'top',
	                x: -10,
	                y: 100,
	                borderWidth: 0
	            },
	            series: json
	        });
	    });
    
    });
    
});
		</script>
	</head>
	<body>
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>

<div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>

<br>
<form action=index.php>
<center>
Sensor ID: 
<input type=text name=id value="<?php echo $id;?>"> 
Filter data from: 
<input type=text name=from value="<?php echo $f;?>"> to <input type=text name=to value="<?php echo $t;?>">
<br>
Data labels: 
Sensor 1: <input type=text name=l1 value="<?php echo $l1;?>"> 
Sensor 2: <input type=text name=l2 value="<?php echo $l2;?>">
Sensor 3: <input type=text name=l3 value="<?php echo $l3;?>">

<br>
<input type=submit value="Apply">
<input type=button value="Reset" onClick="window.open("index.php?id=<?php echo $id;?>")">
</form>

<br>
<form action=index.php>

</form>
<hr>
<br>
	</body>
</html>
