<?php

ini_set('display_errors', '1');
error_reporting(E_ALL);
include "PhpSerial.php";

$msg = '';
$data = '';
$read = array();
$buff = '';
$cnt = 1;
$rcv = '';

// Get The recoit une request demmare la boucle
if(isset($_GET["hi"])){

	//connexion
	$serial = new phpSerial();
	$serial->deviceSet("/dev/ttyACM0");
	$serial->confBaudRate(9600);
	$serial->confParity("none");
	$serial->confCharacterLength(8);
	$serial->confStopBits(1);
	$serial->deviceOpen();
	
	// arduino requires a 2 second delay in order to receive the message
	sleep(2);
	
	
	// Si c'est une request hi on allumera la led
	
	$data = $_GET["hi"];
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

	
	// Si c'est une request temperature on renvoiera la température (voir index.php pour le retour de valeur) 
	// afficher température sur le bobox
	
	// Si c'est une request heure on affiche l'heure sur le bobox (pas besoin sur téléphone
	
	
	// Variation de lumière -> quelqun dans la piece ! notification téléphone ? a voir...
	
	
	
	
	HttpResponse::setCache(true);
	HttpResponse::setContentType('text/plain');
	HttpResponse::setData($rcv);
	HttpResponse::send();
	
		
	$serial->deviceClose();

}

?>