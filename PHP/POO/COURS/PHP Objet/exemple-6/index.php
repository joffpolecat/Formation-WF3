<?php 

require_once('Vehicule.php');
require_once('Voiture.php');
require_once('Moto.php');

//$vehicule = new Vehicule("#990000");
//$vehicule->setCouleur("#990000");
//echo $vehicule->toString();

$voiture = new Voiture("#548467");
$voiture2 = new Voiture("#546953");
/*echo "<br/>";
echo $voiture->toString();
$voiture->setNombrePortes(4);*/
//Voiture::klaxonner();
echo Vehicule::$counter . ' Véhicule(s)';
$moto = new Moto("#000000");