<?php

require_once('DVD.php');
require_once('Livre.php');

$monDVD = new DVD(9.99, 1);
$monDVD->setPrix(12.99);
echo $monDVD->getPrix();
echo '</br>';
echo $monDVD->getPoids();

$monDVD->setActeurs(array(
    'Schwarzenegger',
    'Stallone'    
));

echo '</br>';

foreach ($monDVD->getActeurs() as $key => $acteur) {
    echo $acteur . '</br>';
}

$livre = new Livre(9.99, 200, '684684-54');
echo $livre->getIsbn();