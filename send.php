<?php
// Tue Feb 13 19:11:36 -02 2018
// Rafael Aroca <aroca@ufscar.br>

// Function to get the client ip address
function get_client_ip_server() {
    $ipaddress = '';
    if ($_SERVER['HTTP_CLIENT_IP'])
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if($_SERVER['HTTP_X_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if($_SERVER['HTTP_X_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if($_SERVER['HTTP_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if($_SERVER['HTTP_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if($_SERVER['REMOTE_ADDR'])
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
 
    return $ipaddress;
}

require('database.php');

$con = mysqli_connect($db_host,$db_user,$db_pass);

if (!$con) {
  die('Could not connect: ' . mysqli_error());
}

mysqli_select_db($con, $db_name);



//Usage
//https://<<your domain>>/send.php?id=1&s1=1
//https://<<your domain>>/send.php?id=1&s1=1&s2=12

if(!isset($_GET["s1"])) 
	exit;

if(!isset($_GET["id"])) 
	exit;

echo "Variables OK <br>";

if(!is_numeric($_GET["s1"])) 
	exit;

if(!is_numeric($_GET["id"])) 
	exit;



echo "Numeric OK <br>";

$s2=0;
if(is_numeric($_GET["s2"])) {
	$s2 = $_GET["s2"];
} 

$s3=0;
if(is_numeric($_GET["s3"])) {
	$s3 = $_GET["s3"];
}

$s4=0;
if(is_numeric($_GET["s4"])) {
	$s4 = $_GET["s4"];
}

$s1 = $_GET["s1"];
$id = $_GET["id"];


// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$IP = get_client_ip_server();
echo "IP = $IP <BR>";
$sql = "INSERT INTO sensors (IP, ts, id_sensor, s1, s2, s3, s4) VALUES (\"$IP\", now(), $id, $s1, $s2, $s3, $s4)";

if (mysqli_query($con, $sql)) {
    echo "Success!";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($con);
?>
