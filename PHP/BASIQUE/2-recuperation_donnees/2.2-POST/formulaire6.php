<?php

    /*
        OBJECTIF :
        Envoyer un email au format texte (parfait pour un site perso)
    */

    if ($_POST) {

        echo '<pre>';
        print_r($_POST);
        echo '</pre>';

        extract($_POST);

        /*
            SORTIE DE EXTRACT

            Array
            (
                [nameDestinataire] => destinataire
                [nameExpediteur] => name
                [emailExpediteur] => paul@email.com
                [sujet] => sujet
                [contenu] => contenu du message
            )
        
        */

        //print_r($sujet);

        $header = "From : $nameExpediteur - $emailExpediteur \r\n";
        $header .= "Replt-to : $nameDestinataire \r\n";
        $header .= "MIME-Version 1.0 \r\n"; //MINE = Multiporpose Internet Mail Extensions. C'est un standard afin d'étendre les possibilités limitées d'un mail traditionnel (insertion image, sons...)
        $header .= "Content-type : text/html; charset=iso-8859-1 \r\n";
        $header .= "X-Mailer : PHP/" . phpversion();


        $contenu = "<h1> $sujet | FROM $nameExpediteur, $emailExpediteur </h1>";
        $contenu .= "<ul>";
        $contenu .= "<li>Nom : $nameExpediteur</li>";
        $contenu .= "<li>Email : $emailExpediteur</li>";
        $contenu .= "</ul>";


		//S'il y a des bugs, commenter mail() pour vérifier le code. ┬┴┬┴┤ ͜ʖ ͡°) ├┬┴┬┴
        
        //mail($destinataire, $sujet, $contenu, $header); // la fonction mail() permet d'envoyer des mails, elle attend 4 arguments : Destinataire + sujet/objet du mail + contenu du mail + (optionnel) en-tête du mail
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Envoi d'une newsletter</title>
</head>
<body>
    <h1>Envoi d'une newsletter via formulaire</h1>

    <form action="" method="post" enctype="multipart/form-data">

        <!-- DESTINATAIRE -->
        <div><label for="destinataire">Destinataire</label></div>
        <div><input type="text" name="nameDestinataire" id="destinataire" placeholder="Destinataire" value="Destinataire"></div>

        <!-- NOM EXPEDITEUR -->
        <div><label for="name">Nom de l'expéditeur</label></div>
        <div><input type="text" name="nameExpediteur" id="name" placeholder="Nom de l'expéditeur" value="Nom de l'expediteur"></div>

        <!-- EMAIL -->
        <div><label for="email">Email</label></div>
        <div><input type="email" name="emailExpediteur" id="email" placeholder="Votre email" value="texteTest@email.com"></div>

        <!-- SUJET -->
        <div><label for="sujet">Sujet:</label></div>
        <div><input type="text" name="sujet" id="sujet"  placeholder="Sujet" value="Sujet test"></div>

        <!-- CONTENU -->
        <div><label for="contenu">Contenu</label></div>
        <div><textarea name="contenu" id="contenu" cols="30" rows="10"  placeholder="Contenu de votre message...">Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit.</textarea></div>

        <!-- BOUTON -->
        <input type="submit" value="Envoyer">
    </form>
</body>
</html>