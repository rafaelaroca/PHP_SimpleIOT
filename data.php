<?php
require('database.php');

$con = mysqli_connect($db_host,$db_user,$db_pass);

if (!$con) {
  die('Could not connect: ' . mysqli_error());
}

mysqli_select_db($con, $db_name);


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
        exit;
}

if(!is_numeric($_GET["id"])) {
        exit;
}

$id=$_GET["id"];


$W = "WHERE 1=1 AND id_sensor=$id";
$from = $_GET["from"];
$to = $_GET["to"];
if(isset($_GET["from"])) {
        if(isset($_GET["to"]))  {
		$W = "WHERE ts <= \"$to\" AND ts >= \"$from\" AND id_sensor=$id";
        }
}

$sth = mysqli_query($con,"SELECT s1 FROM sensors $W");
$rows = array();
$rows['name'] = $l1;
while($r = mysqli_fetch_array($sth)) {
    $rows['data'][] = $r['s1'];
}

$sth = mysqli_query($con,"SELECT s2 FROM sensors $W");
$rows2 = array();
$rows2['name'] = $l2;
while($r = mysqli_fetch_array($sth)) {
    $rows2['data'][] = $r['s2'];
}

$sth = mysqli_query($con,"SELECT s3 FROM sensors $W");
$rows3 = array();
$rows3['name'] = $l3;
while($r = mysqli_fetch_array($sth)) {
    $rows3['data'][] = $r['s3'];
}
$result = array();
array_push($result,$rows);
array_push($result,$rows2);
array_push($result,$rows3);


print json_encode($result, JSON_NUMERIC_CHECK);

mysqli_close($con);
?>
