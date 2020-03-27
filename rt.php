
<head>
  <meta http-equiv="refresh" content="1">
</head>


<?php
require('database.php');

if(!is_numeric($_GET["id"])) {
	echo "ID must be numeric";
        exit;
}
$id=$_GET["id"];

echo "<center><a href=index.php?id=$id>Historic Graph</a> |<a href=rt.php?id=$id>Real Time Table View</a> | <a href=rtg.php?id=$id>Real Time Graph</a> | <a href=csv.php?id=$id>Export</a></center>";

echo "<br>";

$con = mysqli_connect($db_host,$db_user,$db_pass);

if (!$con) {
  die('Could not connect: ' . mysqli_error());
}

mysqli_select_db($con, $db_name);


$q = "SELECT * FROM sensors order by ts desc limit 10";
if(isset($_GET["id"])) {
	if(is_numeric($_GET["id"])) {
		$id=$_GET["id"];
		echo "<center>Filter by ID = $id</center>";
		$q="SELECT * FROM sensors WHERE id_sensor=" . $id . " order by ts desc limit 10";
	}
}


$sth = mysqli_query($con,$q);

echo "<center>";
echo "<table border=1>";
echo "<tr><td><center>ID</center></td><td><center>Sent from IP</center</td><td><center>Sensor ID</center></td><td><center>Date and time</center></td><td>S1</td><td>S2</td>";
echo "<td>S3</td><td>S4</td>";
echo "</tr>";
while($r = mysqli_fetch_array($sth)) {
	echo "<tr>";
	echo "<td>";
    echo $r['id'];
	echo "</td><td>";
    echo $r['IP'];
	echo "</td><td>";
    echo $r['id_sensor'];
	echo "</td><td>";
    echo $r['ts'];
	echo "</td><td>";
    echo $r['s1'];
	echo "</td><td>";
    echo $r['s2'];
	echo "</td><td>";
    echo $r['s3'];
	echo "</td><td>";
    echo $r['s4'];
	echo "</td>";
	echo "</tr>";
}


mysqli_close($con);
?>

</table>

</body>
</html>
