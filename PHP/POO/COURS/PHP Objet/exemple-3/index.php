<?php 

require_once('Carre.php');
require_once('Cercle.php');

$maforme = new Carre(10, 10, 120);
$monCercle = new Cercle(10, 10, 80);

function afficheInfos(Forme $forme)
{
    echo 'Aire: '. $forme->aire() . '<br/> Périmètre: ' . $forme->perimetre();
}

afficheInfos($maforme);
echo '<br/>';
afficheInfos($monCercle);