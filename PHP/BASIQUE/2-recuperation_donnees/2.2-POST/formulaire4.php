<?php

    
/*
    if(empty($_POST['pseudo'])){
        echo "Veuillez renseigner un pseudo";
    } else {
        echo '<pre>';
            print_r($_POST);
        echo '</pre>';
        echo "Thanks bro !";
    }
*/

    // VERSION À FAIRE À CHAQUE FOIS (methode dans if et ensuite le reste dans le if)
    if($_POST){
        if(empty($_POST['pseudo'])){
            echo "Pas de pseudo renseigné";
        } else {
            echo "Bienvenue sur le site " .$_POST['pseudo'];
        }
    }

    extract($_POST); // Cette fonction nous permet de créer des variables via les indices du tableau et affecte leur valeur

    echo '<br>';

    echo $pseudo . " - " . $email;


    # On souhaite inscrire les valeurs récupérées par le formulaire dans un fichier externe.

    $f = fopen("liste.txt", "a"); //on enregistre dans une variable l'opération d'ouverture d'un fichier. 'a' nous permet d'ouvrir le fichier et s'il n'existe pas, de le créer. La fonction fopen prend 2 arguments : nom du fichier + méthodoligie

    /*
        r  => lecture seule du fichier, début de fichier
        r+ => lecture et écriture du fichier, début de fichier
        w  => écriture seule, écrase le reste du fichier
        w+ => lecture et écriture, écrase le reste du fichier
        a  => écriture seule, fin du fichier
        a+ => lecture et écriture, fin du fichier
    */

    fwrite($f, $_POST['pseudo'] . ' - ');
    fwrite($f, $_POST['email'] . "\n");

    $f = fclose($f); // pas indispensable mais libère de la ressource
?>