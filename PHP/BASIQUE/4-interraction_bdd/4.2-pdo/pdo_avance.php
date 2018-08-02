<?php

    $dsn = "mysql:host=localhost; dbname=entreprise";
    $login = "root";
    $pwd = "";
    $attributes = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];

    /*
        Gestion des erreurs :

        > ERRMODE_SILENT : 
            Par défaut. Il n'affiche pas les erreurs (parfait pour la production)

        > ERRMODE_WARNING : 
            Nous affiche dans la page l'erreur (pratique si on travail seul)
        
        > ERRMODE_EXCEPTION :
            Retourne l'erreur via la CLASS PDOexception, donc plus de détails (voir ci-dessous)
    */

    $pdo = new PDO($dsn, $login, $pwd, $attributes);

    /*
        EXEC + QUERY :
            Voir dans le fichier : pdo.php

        PREPARE / EXECUTE 
            -> Pratique pour des requêtes incluant des données sensibles (POST/GET => de l'utilisateur) pour éviter les injections SQL
            
        SELECT, INSERT, UPDATE, DELETE
            Valeur de retour :
                > succès : PDOSTATEMENT (objet)
                > échec : FALSE (bool)
    */

    $resultat = $pdo->prepare('SELECT * FROM employes WHERE nom= :nom');

    $resultat->bindValue(':nom', 'Jasmin', PDO::PARAM_STR);
    
    /*
        On peut aussi utiliser la méthode bindParam() mais l'avantage de bindValue() c'est qu'on peut aussi passer des INT en paramètre.

        # bindValue() & bindParam() prennent 3 paramètres :
            - Marqueur
            - Valeur
            - Méthode de sécurité (PDO::PARAM_STR ou PDO::PARAM_INT par exemple)
    */ 

    $resultat->execute();

    //     echo '<pre>';
    //     var_dump($resultat);
    //     echo '</pre>';

    $donnees = $resultat->fetch();

    //     echo '<pre>';
    //     var_dump($donnees);
    //     echo '</pre>';
    
    /*
        Plusieurs intérêts pour cette méthode :

            > Optimiser le temps de réponse de la BDD
            > Rendre dynamique la requête en changeant la valeur dans bindValue()
            > Sécurise notre code et la connexion à la BDD grâce à 3 arguments

        Elle est particulièrement adaptée pour une requête avec données sensibles (venant de l'utilisateur : GET/POST) >> éviter les injections SQL
    */



    /*
        QUESTION / REPONSE :

            QUERY, EXEC ou PREPARE/EXECUTE ?

                SELECT * FROM employes =>  QUERY



                    $resultat = $pdo->query("SELECT * FROM employes");



                -------

                SELECT * FROM employes WHERE prenom='Gertrude' => QUERY



                      $resultat = $pdo->query("SELECT * FROM employes WHERE prenom = 'Gertrude'");



                -------

                SELECT * FROM employes WHERE id_employes=$_GET[id] => PREPARE/EXECUTE



                    Puisque nous sommes en $_GET, il faut rajouter ?id=1 à la fin de l'URL :
                    4-interraction_bdd/4.2-pdo/pdo_avance.php?id=1


                    $resultat = $pdo->prepare('SELECT * FROM employes WHERE id_employes = :id');

                    $resultat->bindValue(':id', $_GET['id'], PDO::PARAM_INT);

                    $resultat->execute();

                    $donnees = $resultat->fetch();



                -------

                INSERT INTO employes (prenom, nom) VALUES ('toto', 'tata') => EXEC

                    
                    
                    $resultat = $pdo -> exec("INSERT INTO employes (prenom, nom) VALUES ('toto','tata')");



                -------

                INSERT INTO employes (prenom, nom) VALUES ('$_POST[prenom]', '$_POST[nom]') => PREPARE/EXECUTE


                    $_POST['prenom'] : = 'John';
                    $_POST['nom'] : = 'Stark';

                    $resultat = $pdo->prepare("INSERT INTO employes (prenom, nom) VALUES (:prenom, :nom");

                    $resultat->bindValue(':prenom', $_POST['prenom'], PDO::PARAM_STR);
                    $resultat->bindValue(':nom', $_POST['nom'], PDO::PARAM_STR);

                    $resultat->execute();



                -------

    */





    # Test de la méthode ERRMODE_EXCEPTION via le try & catch
    
    try {

        //$resultat = $pdo->query("frgrgrgrgrgr");

        $resultat=$pdo->exec("UPDATE employes SET salaire = (salaire + 100)");
        echo 'Nombre de lignes affectées : ' . $resultat . '<br><br>';

        if($resultat != FALSE){ 
            echo '(ﾉ◕ヮ◕)ﾉ*:･ﾟ✧ Félicitation, vous gagnez tous 100€ de plus ! ✧ﾟ･: *ヽ(◕ヮ◕ヽ)';
        }
    }

    // Grâce au PDO::ERRMODE_EXCEPTION, je peux afficher les détails de l'erreur de code
    catch(PDOException $e){

        echo '<div style="background-color: red; color: white; padding: 20px;">';
            echo '<p> ERREUR SQL :</p>';
            echo 'Message : '. $e->getMessage() . '<br>';
            echo 'Code : '. $e->getCode() . '<br>';
            echo 'File : '. $e->getFile() . '<br>';
            echo 'Ligne : '. $e->getLine() . '<br>';
        echo '</div>';
        
        /*
            Je tiens un journal de bord des erreurs :
        */

        $f = fopen('error.txt', "a");

        $erreur = date('d/m/Y - W - H:i:s') . '-Erreur SQL :' . "\r\n";
        $erreur .= 'Message : ' . $e->getMessage() . "\r\n\r\n";

        fwrite($f, $erreur);
        fclose($f);
        exit;
    }



    # Passage d'arguments avec PREPARE/EXECUTE

        # Avec le marqueur '?'

        $_POST['prenom'] = 'Mickael';
        // $_POST['nom'] = 'Jordan';
        // $_POST['sexe'] = 'M';
        // $_POST['service'] = 'sport';
        // $_POST['date_embauche'] = '1998-02-17';
        // $_POST['salaire'] = '10000';



        $resultat = $pdo->prepare("SELECT * FROM employes WHERE prenom = ?");  //AND nom = ?
        // ? est un marqueur comme :nom par exemple. 

        $resultat->bindValue('?', $_POST['prenom'], PDO::PARAM_STR);
        // $resultat->bindValue('?', $_POST['nom'], PDO::PARAM_STR);

        $r =$resultat->execute(array($_POST['prenom']));

        var_dump($r);

        /*
            ? VERSUS NOMINATIF

            La grande différence entre les deux, c'est que le nominatif se fiche de l'ordre de nos argument. 
            Quant à lui, le '?' demande à être extrêmement rigoureux dans l'ordre d'appel de nos paramètres  qui doivent concorder avec notre table dans la BDD.
            En résumé, la façon nominative est plus permissive !
        */


        $_POST['prenom'] = 'Gertrude';
        $_POST['nom'] = 'Clochard';

        $resultat = $pdo->prepare("SELECT * FROM employes WHERE prenom=:prenom AND nom=:nom");
        $r = $resultat->execute($_POST);
        
        var_dump($r);



        # Utilisation de bindParam() & bindValue()

        $_POST['prenom'] = 'Gertrude';
        $_POST['nom'] = 'Clochard';

        $resultat = $pdo->prepare("SELECT * FROM employes WHERE prenom=:prenom AND nom=:nom");

        $resultat->bindParam(':prenom', $_POST['prenom'], PDO::PARAM_STR);
        $resultat->bindParam(':nom', $_POST['nom'], PDO::PARAM_STR);

        $r = $resultat->execute();

        var_dump($r);

        # -------------------------------------------------------

        $_GET['id']='7';

        $resultat =$pdo->prepare("SELECT * FROM employes WHERE id_employes = :id");
        $resultat->bindValue(':id', $_GET['id'], PDO::PARAM_INT);

        $r = $resultat->execute();

        var_dump($r);



        /*
            bindValue() & bindParam() sont mon dernier rempart de sécurité !

            L'avantage de bindValue() c'est qu'il accepte plus de valeurs, les INT nottament.
        */

        # Placer le FETCH directement dans la requête 

        $resultat = $pdo->query("SELECT * FROM employes", PDO::FETCH_ASSOC);
        // Au cas où je n'ai pas placé le FETCH_ASSOC en paramètre par défaut lors de la connexion à la BDD, je peux l'appeler directement après ma requête.


            echo '<pre>';
            var_dump($resultat);
            // N'affiche que ma requête, pas le deuxième paramètre FETCH_ASSOC >> ça marche :)
            echo '</pre>';

        while($infos = $resultat -> fetch()){

            // echo '<pre>';
            // var_dump($infos);
            // echo '</pre>';

            foreach ($infos as $key => $value) {
                echo $value . '<br>';
            }
        }


        # Retourner l'ID du dernier enregistrement

        $resultat = $pdo->exec("INSERT INTO employes (nom, prenom) VALUES ('Zidane', 'Zinedine')");

        echo "ID du dernier enregistrement : " . $pdo->lastInsertId();