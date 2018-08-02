<?php

    $fichier = "liste.txt";

    $lignes=file($fichier); //la fonction file() fait tout le travail en retournant chaque ligne du fichier dans un ARRAY

    print'<pre>';
    print_r($lignes);
    print'</pre>';

    foreach($lignes as $ligne){ //2 arguments suffisent : l'ARRAY + le résultat attendu
        echo $ligne . '<br>';
    }

    echo '<hr>';


    echo implode($lignes, '<br>'); //la fonction implode() rassemble un ARRAY en STRING avec 2 arguments : nom de l'ARRAY + règle d'assemblage

    //fonction explode() pour séparer une STRING en ARRAY avec 3 arguments : séparateur, la STRING concernée & la limite dans la string

    #supression du fichier >>
    // unlink ($fichier);