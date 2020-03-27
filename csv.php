<?php

require('database.php');

$con = mysqli_connect($db_host,$db_user,$db_pass);

if (!$con) {
  die('Could not connect: ' . mysqli_error());
}

mysqli_select_db($con, $db_name);


$q ="SELECT * FROM sensors";
if(isset($_GET["id"])) {
        if(is_numeric($_GET["id"])) {
                $id=$_GET["id"];
                $q="SELECT * FROM sensors WHERE id_sensor=" . $id . " order by ts";
        }
}


$sth = mysqli_query($con,$q);



while($r = mysqli_fetch_array($sth)) {
    echo $r['id'];
	echo ",";
    echo $r['id_sensor'];
	echo ",";
    echo $r['IP'];
	echo ",";
    echo $r['ts'];
	echo ",";
    echo $r['s1'];
	echo ",";
    echo $r['s2'];
	echo ",";
    echo $r['s3'];
	echo ",";
    echo $r['s4'];
    echo "<br>";
}


mysqli_close($con);
?>
