<?php
echo exec('whoami');
?>

<?php

ini_set('display_errors', '1');
error_reporting(E_ALL);
include "PhpSerial.php";

$comPort = "/dev/ttyACM0"; //The com port address. This is a debian address

$msg = '';
$data = '';
$read = array();
$buff = '';
$cnt = 1;
$rcv = '';

if(isset($_GET["hi"])){

$data = $_GET["hi"];

$serial = new phpSerial();

$serial->deviceSet($comPort);

$serial->confBaudRate(9600);

$serial->confParity("none");

$serial->confCharacterLength(8);

$serial->confStopBits(1);

$serial->deviceOpen();

sleep(2); //Unfortunately this is nessesary, arduino requires a 2 second delay in order to receive the message

$serial->sendMessage($data);


	$read[$cnt] = $serial->readPort();	

	while(substr($read[$cnt],-1,1) != "a")
	{
		$cnt++;
		$read[$cnt] = $serial->readPort();
	}

	for($i = 1; $i < $cnt+1 ; $i++)
	{
		$rcv = $rcv . $read[$i];
	}

	$rcv = rtrim($rcv,"a");
	
$serial->deviceClose();

$msg = "You message has been sent! WOHOO! Read data: ".$rcv." And Last : ".$read[$cnt]."";

}

?>

<html>

<head>

<title>Arduino control</title>

</head>

<body>

<form method="GET">

<input type="text" name="hi" value="a"><br>
<input type="submit" value="Send">

</form><br>

<?=$msg?>

</body>

</html>