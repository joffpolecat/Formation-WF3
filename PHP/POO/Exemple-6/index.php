<?php

// require_once('Vehicule.php');
// require_once('Voiture.php');
// require_once('Moto.php');

spl_autoload_register(function($className)
{
    if(file_exists($className . '.php'))
    {
        require_once($className . '.php');
    }
});

// $vehicule = new Vehicule("#990000");
// $vehicule->setCouleur();
// echo $vehicule->toString();

$voiture = new Voiture("#890000");
$voiture2 = new Voiture("#865425");

// echo $voiture -> toString();
// $voiture->setNombrePortes(4);
// Voiture::klaxonner();

$moto = new Moto("#654218");
echo Vehicule::$counter . ' Véhicule(s)';