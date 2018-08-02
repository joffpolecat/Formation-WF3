<?php

    /*
        Je souhaite voir toutes les classes dispo dans PHP
    */

    // echo '<pre>';
    // print_r(get_declared_classes());
    // echo '</pre>';

    /*
        Array
        (
            ...
            
            [108] => PDOException
            [109] => PDO
            [110] => PDOStatement
            [111] => PDORow
            
           	...
        )
    */

    
    $pdo = new PDO(
        "mysql:host=localhost;
        dbname=entreprise", 
        "root", "",
        // OPTIONNEL
        array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
            // quand il y a une erreur, ERRMODE_WARNING permet d'afficher les erreurs sur la page
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
        )
    );
    
    /*
        On instancie l'objet $pdo de la CLASS PDO.
        Elle prend 4 à 5 arguments  :
            - Le serveur hôte
            - Le nom de la BDD
            - Le login
            - Le mot de passe
            - Les attributs que l'on souhaite (optionnel)
    */

    $dsn = "mysql:host=localhost; dbname=entreprise"; // nom serveur + nom BDD
    $login = "root";
    $password = "";
    $attribute = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];

    $pdo = new PDO($dsn, $login, $password, $attribute);

    // var_dump($pdo);
    // je vérifie que tout fonctionne et que j'instancie bien mon OBJET $pdo


    // echo '<pre>';
    // print_r(get_class_methods($pdo));
    // echo '</pre>';


    /*
        QUERY :
        Utilisation pour des requêtes de sélection

            Valeur de retour : SELECT (fonctionne aussi pour INSERT/UPDATE/DELETE mais ce n'est pas conventionnel)

            > succès : PDOSTATEMENT (objet)
            > echec : FALSE (bool)

        EXEC :
        Utilisation si on ne retourne pas de résultat (INSERT/UPDATE/DELETE)

            Valeur de retour : 
            
            > succès : INTEGER (nombre de résultat)
            > echec : FALSE (bool)
    */


    // $pdo->exec('INSERT INTO employes (prenom) VALUES ("Jean-Michel")'); // la flècge précédant exec() nous permet d'appeler la méthode


    $pdo->exec("UPDATE employes SET prenom='Arnold' WHERE id_employes=13");

    $r = $pdo->exec("DELETE FROM employes WHERE id_employes=13");

    // echo $r;
    // Retour de la commande

    $pdostatement= $pdo->query("SELECT * FROM employes WHERE prenom='Lancelot'");

    // var_dump($pdostatement);
    // Nous appelons ce noubel OBJET PDOstatement

    echo '<br>';

    // echo '<pre>';
    // print_r(get_class_methods($pdo));
    // print_r(get_class_methods($pdostatement));
    // echo '</pre>';


    $employe = $pdostatement->fetch(PDO::FETCH_ASSOC);

    // echo '<pre>';
    // var_dump($employe);
    // echo '</pre>';

    /*
        L'exportation des données se fait donc en 3 étapes :
            1- Connexion à la BDD en instanciant un OBJET $pdo de la CLASS PDO
            2- Appel à la METHOD query de l'OBJET $pdo. Il nous retourne un nouvel OBJET PDOstatement
            3- Conversion de cet OBJET PDOstatement en ARRAY $employe via la METHOD fetch()
    */

    foreach ($employe as $key => $value) {
        echo $value . '<br>';
    }

    // Exploitation des données manuellement
    echo $employe["nom"] . '<br>';


    # TEST : peut-on insérer une donnée via la méthode QUERY ?
    //Ça fonctionne, mais ça n'est pas conventionnel

    // $testInsertion = $pdo->query("INSERT INTO employes (prenom) VALUES ('Jean-Michel')");

    // var_dump($testInsertion);


    $r = $pdo->query('SELECT * FROM employes');

    $employes = $r->fetch(PDO::FETCH_ASSOC);  

    // var_dump($employes);


    # Exploitation du résultat

        # Solution 1 : WHILE

        echo '<ul>';

            // Je n'ai pas besoin de mettre en argument du fetch PDO::FETCH_ASSOC car je l'ai mis en attribut automatique lors de ma connexion à la BDD
            while ($employes = $r->fetch()){
                echo '<li>' . $employes["prenom"] . " " . $employes["nom"] . '</li>';
            }

        echo '</ul>';



        # Solution 2 : FOREACH

        $res = $pdo->query("SELECT * FROM employes");

        // echo '<pre>';
        // var_dump(get_class_methods($res));
        // echo '</pre>';

        $employes = $res->fetchAll();
        // Nous ne remettons pas en argument le PDO::FETCH_ASSOC car nous l'avons déjà placé en attribut lors de notre connexion à la BDD

        // echo '<pre>';
        // var_dump($employes);
        // echo '</pre>';


        /*

        foreach ($employes as $employe) {

            // echo '<pre>';
            // var_dump($employe);
            // echo '</pre>';

            # Affichage de façon manuelle
        
            // echo $employe['prenom'] . ' ' . $employe['nom'] . '<br>';



            #Affichage de façon automatique

            foreach ($employe as $indice => $valeur) {

                echo $indice . ': <strong>' . $valeur . '</strong><br>';
            }

            echo '<hr>';
        }

        */


        # Représenter la table sous forme de tableau

        $tableau = $pdo->query('SELECT * FROM employes');

        echo '<table border="1">';
        
            echo '<tr>';
            
                // La fonction columnCount() nous retourne le nombre de colonnes
                for($i=0 ; $i < $tableau->columnCount() ; $i++){

                    $colonne = $tableau->getColumnMeta($i);
                    // La METHOD getColumnMeta() nous retourne le titre des champs de la table 
                    
                    // echo '<pre>';
                    // print_r($colonne);
                    // echo '</pre>';

                    echo '<th>' . ucfirst(str_replace('_', ' ', $colonne['name'])) . '</th>';
                }
            echo '</tr>';

            # WHILE 

            while ($infos = $tableau->fetch()){
                
                echo '<tr>';

                    foreach ($infos as $key => $value) {
                        echo '<td>' . $value . '</td>';
                    }

                echo '</tr>';

            }

            # FOREACH 

            foreach ($employes as $employe) {

                echo '<tr>';

                    foreach ($employe as $key => $value) {
                        echo '<td>' . $value . '</td>';
                    }

                echo '</tr>';

            }


        echo '</table>';
       


        
?>