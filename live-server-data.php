<?php

require('database.php');

if(!is_numeric($_GET["id"])) {
	echo "ID must be numeric";
	exit;
}
$id=$_GET["id"];

$con = mysqli_connect($db_host,$db_user,$db_pass);

if (!$con) {
  die('Could not connect: ' . mysqli_error());
}

mysqli_select_db($con, $db_name);

$sql = "SELECT s1 FROM sensors where id_sensor = $id ORDER BY ts desc LIMIT 1";

$result_1=$con->query($sql);
while($row = $result_1->fetch_assoc()){
    $y = floatval($row['s1']);
}

$con->close();

 header("Content-type: text/json");
 $x = time() * 1000;
 $ret = array($x, $y);
 echo json_encode($ret);
?>
