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
$read = '';

if(isset($_POST["hi"])){

$data = $_POST["hi"];

$serial = new phpSerial();

$serial->deviceSet($comPort);

$serial->confBaudRate(9600);

$serial->confParity("none");

$serial->confCharacterLength(8);

$serial->confStopBits(1);

$serial->deviceOpen();

sleep(2); //Unfortunately this is nessesary, arduino requires a 2 second delay in order to receive the message

$serial->sendMessage($data);

	while ($read == '') {
	        $read = $serial->readPort();
}

$serial->deviceClose();

$msg = "You message has been sent! WOHOO! Read data: ".$read."";

}

?>

<html>

<head>

<title>Arduino control</title>

</head>

<body>

<form method="POST">

<input type="text" name="hi" value="Name"><br>
<input type="submit" value="Send">

</form><br>

<?=$msg?>

</body>

</html>