<?php

 /*
    EXERCICE :
    Exploiter les résultats enregistrés via le formulaire8.php
 */


    
        $fichier = "contact.txt";

        $lignes=file($fichier); //la fonction file() fait tout le travail en retournant chaque ligne du fichier dans un ARRAY

        foreach($lignes as $ligne){ //2 arguments suffisent : l'ARRAY + le résultat attendu
            echo $ligne . '<br>';
        }
    