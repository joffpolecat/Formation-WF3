<?php

/*
    EXERCICE :
    Formulaire qui va récupérer le nom + le prénom + le mail de l'utilisateur.
    Si une des cases est vide, il faut que ça affiche une erreur.
    Le pseudo soit composé d'au moins 3 caractères.
    Si tout est validé, enregistrement dans un nouveau fichier contact.txt
*/

    if($_POST){

        if (iconv_strlen($_POST['prenom'])<3){
            echo "Le pseudo doit avoir au moins 3 lettres";
        }else {
            $f = fopen("contact.txt", "a"); 

            fwrite($f, $_POST['prenom'] . ' - ');
            fwrite($f, $_POST['nom'] . ' - ');
            fwrite($f, $_POST['mail'] . "\n");

            $fichier = "contact.txt";

            $lignes=file($fichier); //la fonction file() fait tout le travail en retournant chaque ligne du fichier dans un ARRAY

            foreach($lignes as $ligne){ //2 arguments suffisent : l'ARRAY + le résultat attendu
                echo $ligne . '<br>';
            }
        }
        
    }

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Formulaire 8</title>
    </head>
    <body>
        <form action="" method="post">

            <!-- PRENOM -->
            <div><label for="prenom">Prénom</label></div>
            <div><input type="text" name="prenom" id="prenom" placeholder:"Votre prénom"></div>

            <!-- NOM -->
            <div><label for="nom">Nom</label></div>
            <div><input type="text" name="nom" id="nom" placeholder:"Votre nom"></div>
            
            <!-- EMAIL -->
            <div><label for="mail">Mail</label></div>
            <div><input type="email" name="mail" id="mail" placeholder:"Votre mail"></div>

            <div><input type="submit" value="Envoyer"></div>
        </form>
    </body>
</html>