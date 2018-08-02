<?php


    # TESTER LA BDD


    /*
        Exemple 1 :
        > Pseudo : Guy'#
        --- Le # nous permet de mettre la suite de la requête en commentaire. On recherche uniquement le pseudo GUY.
        


        Exemple 2 :
        > mdp : ' OR id='1
        --- On met le reste de la requête en condition non nécessaire (OR) et on demande l'ID membre n°1.



        Exemple 3 :
        > pseudo : <p style="color:red;">TEST</p>
        --- Injection de code qui a été interprété en tant que tel. J'aurai pu injecter du JS par exemple.



        Exemple 4 :
        > mdp : ' OR 1='1
        --- On met le reste de la requête en condition non nécessaire (OR) et 1='1', SQL ne comprend pas et nous retourne le permier membre (souvent l'administrateur)
    */



    /*
        1ERE ETAPE : CONNEXION A LA BASE DE DONNEES
    */

    $pdo = new PDO('mysql:host=localhost;dbname=securite', 'root', '');

    // var_dump($pdo);

    if($_POST){
        
        echo '<pre>';
        print_r($_POST);
        echo '</pre>';

        echo 'Pseudo: ' . $_POST['pseudo'] . '<br>';
        echo 'Mot de passe: ' . $_POST['mdp'] . '<hr>';


        /*
            Nous devons nettoyer les valeurs entrées par l'internaute
        */

        $pseudo = htmlentities(addslashes($_POST['pseudo']));
        $mdp = htmlentities(addslashes($_POST['mdp'])); # WARINING sur la fonction HTMLENTITIES

        // Fonction addslashes() nous permet d'interpréter tous les caractères sans stopper notre requête


        $req = "SELECT * FROM membre WHERE pseudo='$pseudo' AND mdp='$mdp'";


        /*
            2EME ETAPE : REQUÊTE
        */
        $resultat = $pdo->query($req);



        echo 'Requête :' . $req . '<hr>';

        // var_dump($resultat);

        // La METHOD rowCount() nous sert à compter le nombre de ligne en resultat
        if($resultat->rowCount()>0){ // ou !=0 ou >=11
        
            /*
                On rentre donc dans la condition SI on a une correspondance dans la BDD sur le mot de passe et le pseudo
            */


            /*
                3EME ETAPE : OBTENTION DE L'ARRAY
            */
            $membre = $resultat->fetch(PDO::FETCH_ASSOC);

            
            echo '<div style="background:green;padding:5px;color:white;">';

                echo '<h5>Félicitation</h5>';
                echo '<p>Vous êtes connecté</p>';

                echo '<ul>';
                    echo '<li>Pseudo :' . $membre['pseudo'] . '</li>';
                    echo '<li>Mot de passe :' . $membre['mdp'] . '</li>';
                    echo '<li>Carte :' . $membre['carte'] . '</li>';
                echo '</ul>';

            echo '</div>';
        }else {
            echo '<p style="background:red;padding:5px;color:white;">Erreur d\'identification.</p>';
        }
    }
?>




<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test de sécurité</title>
</head>
<body>
    <h1>Connexion</h1>
    <form action="" method="post">
        <div>
            <label for="pseudo">Pseudo</label>   
        </div>
        <div>
            <input type="text" name="pseudo" id="pseudo">
        </div>
        <div>
            <label for="mdp">Mot de passe</label>
        </div>
        <div>
            <input type="password" name="mdp" id="mdp">
        </div>
        <input type="submit" value="Envoyer">
    </form>
</body>
</html>