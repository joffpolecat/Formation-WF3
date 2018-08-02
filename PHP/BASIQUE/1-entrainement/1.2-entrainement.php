<h1>12. ARRAY</h1>

<?php
$couleur = 'bleu';
$couleur .= ' - vert';

echo $couleur;

    echo '<br>';

$tableau = array('bleu', 'vert', 'jaune');

echo '<pre>';
print_r($tableau);
    echo '<br>';
var_dump($tableau);
echo '</pre>';

echo $tableau[1];

    echo '<br>';

$tableau2 = ['rouge', 'bleu', 'violet'];

echo $tableau2[2];

    echo '<br><br>';

$tableau3[] = 'France';
$tableau3[] = 'Suisse';
$tableau3[] = 'Australie';
$tableau3[] = 'Italie';

echo '<pre>';
print_r($tableau3);
echo '</pre>';

echo $tableau3[3];

    echo '<br>';

$tableau3[] = 'Ouganda';

    echo '<br>';

# Comment faire ressortir toutes les valeurs ?


// La boucle FOREACH est spécifique aux ARRAY. Il prend 2 à 3 arguments : l'ARRAY + l'indice + la valeur
foreach ($tableau3 as $indice => $valeur) {
    echo "$indice - $valeur <br>";
}

    echo '<br>';

echo count($tableau3) . '<br>';
echo sizeof($tableau3) . '<br>';
//function count() et sizeof() permettent de retourner la longueur de l'array

$tableau3[] = 'Canada';
echo count($tableau3) . '<br>';

    echo '<br>';

echo implode($tableau3, ' - '); // La fonction implode() prend 2 arguments : l'ARRAY + la règle de découpage du tableau


echo '<h3>Tableaux multidimensionnels</h3>';


$tab_multi=[
    [
        'prenom' => 'Chloé',
        'nom' => 'SEILER'
    ],
    [
        'prenom' => 'Vivien',
        'nom' => 'MICHOT'
    ]
];


$tab_multi2 = array(
    0 => array (
        'prenom' => 'Chloé',
        'nom' => 'SEILER'
    ),
    1 => array(
        'prenom' => 'Vivien',
        'nom' => 'MICHOT'
    )
);


echo '<pre>';
    print_r($tab_multi);
        echo '<br>';
    var_dump($tab_multi2);
echo '</pre>';

echo $tab_multi[0]['prenom'];

?>

<hr>

<h1>13. CLASSE / OBJET </h1>

<?php

// Le rôle d'une classe est de regrouper des informations. Pour cet exemple, toutes les fonctionnalités liées à un compte étudiant.
class Etudiant {
    public $prenom = 'Olivia'; //Une variable dans une classe est appelée PROPRIETE 

    # on a 3 types pour classer nos propriétés : public, private et protected

    public $age = 25;

    public function  pays() { // une fonction dans une classe est appelée METHODE
        return 'France';
    }
}

$etudiant = new Etudiant; // Le mot clé new nous permet d'instancier un nouvel objet

echo '<pre>';
var_dump($etudiant);
echo '</pre>';

# Comment appeler les élements de mon objet ?

echo $etudiant -> prenom . '<br>';
echo $etudiant -> age . '<br>';
echo $etudiant -> pays() . '<br>';


?>