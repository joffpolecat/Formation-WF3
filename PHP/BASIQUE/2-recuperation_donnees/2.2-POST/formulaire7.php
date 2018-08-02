<?php

    /* 
        Exercice :
        Faire une newsletter pour la startup MARECETTE.FR qui envoit des recettes de cuisine. 
        Pour favoriser l'inscription et avoir une belle BDD de mail, elle ne veut récupérer que le nom + prénom + mail
    */

    ini_set('sendmail_from', 'contact@marecette.fr'); //initier l'adresse d'envoi de la newsletter

    date_default_timezone_set('Europe/Paris'); //Renseignement de la zone géographique

    if($_POST){
        /*
        echo '<pre>';
            var_dump($_POST);
        echo '</pre>';
        */

        $header="TO : " . $_POST['mail'] . "\r\n";
        $header.="FROM : MaRecette.fr <contact@marecette.fr> \r\n";
        $header.="MIME-Version: 1.0 \r\n";
        $header.="Content-type: text/html; charset=iso-8859-1 \r\n";
        $header.="X-Mailer; PHP/" . phpversion() . '<hr>';

        $sujet="MaRecette.fr : réussissez une magnifique crème brûlée !";

        // Appel à la fonction utf8_decode() afin de bien afficher tous les caractères
        $message=utf8_decode("
        <!doctype html>
        <html>
            <head>
                <meta name='viewport' content='width=device-width'>
                <meta http-equiv='Content-type' content='text/html;charset=UTF-8'>
                <title>Votre recette personnalisée MARECETTE.FR</title>
            </head>

            <body>
                    <table border='0' cellpadding='0' style='width: 100%;'>

                        <tr style='text-align:center;'>
                            <td style='color: red;'>
                            	Bonjour <strong>". $_POST['firstname'] . ' ' . $_POST['lastname'] . "</strong>.
                            </td>
                        </tr>
                        <tr style='text-align:center;>
                        	<td style='width: 50%;'>
                            	<img style='border: 1px blue solid blue;' src='https://risibank.fr/cache/stickers/d150/15066-full.png' alt='les clients en raffolent !'>
                            </td>
                        	<td style='width: 50%;'>
                            	Nous vous remercions pour votre inscription à notre newsletter mensuelle.
                            </td>
                        </tr>
                        <tr style='width: 100%;'>
                        	<td>
                            	Pour bien réussir votre crème brûlée, suivez les étapes suivantes :
                            </td>
                            <td>
                                <ul>
                                    <li>Etape 1
                                Faire bouillir le lait, ajouter la crème et le sucre hors du feu. Ajouter les jaunes d'oeufs, mettre à chauffer tout doucement (surtout ne pas bouillir), puis verser dans de petits plats individuels.</li>
                                    <li>Etape 2
                                Mettre au four au bain marie et laisser cuire doucement à 180°C environ 50 minutes.</li>
                                    <li>Etape 3
                                Laisser refroidir puis mettre dessus du sucre roux et le brûler avec un petit chalumeau de cuisine.</li>
                                </ul>
                                FINITO !!!
                            </td>
                        </tr>
                        <tr style='text-align:center; width: 100%;'>
                        	<td style='font-weight: bold; width:50%'>
                            	À très bientôt sur MARECETTE.FR !
                            </td>
                            <td style='font-familt: cursive; width:50%;'>
                            	Captain RECETTE
                             </td>
						</tr>
                    </table>
            </body>
        </html>
        ");

        if(mail($_POST['mail'], $sujet, $message, $header)) {
        	echo "<div style='background : green;'> Merci, vous êtes bien inscrit à notre newsletter ! </div>";
        }
    }


?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ma newsletter</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="text" name="firstname" id="firstname" placeholder="Votre prénom">
        <input type="text" name="lastname" id="lastname" placeholder="Votre nom">
        <input type="email" name="mail" id="mail" placeholder="Votre adresse mail">
        <input type="submit" value="Envoyer">
    </form>
</body>
</html>