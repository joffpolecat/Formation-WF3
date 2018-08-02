<?php 

require_once('DVD.php');
require_once('Livre.php');

$monDVD = new DVD(12.99, 2);

echo $monDVD->getPrix();
echo '<br/>';
echo $monDVD->getPoids();
echo '<br/>';
$monDVD->setActeurs(array(
    'Schwarzenegger',
    'Stallone',
));

foreach ($monDVD->getActeurs() as $key => $acteur) {
    echo $acteur . '<br/>';
}

$livre = new Livre(9.99, 200, '684684-54');
echo $livre->getIsbn();