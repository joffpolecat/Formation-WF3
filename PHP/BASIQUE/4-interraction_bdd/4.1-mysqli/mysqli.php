<?php
    
    $mysqli = new Mysqli('localhost', 'root', '', 'entreprise'); 

    /*

        $mysqli représente notre connexion à la BDD. Il prend 4 arguments:
        nom du serveur + login + password (XAMPP sous windows n'en prend pas) + nom de la BDD

        On instancie un objet $mysqli de la CLASS Mysqli

    */

    // echo '<pre>';
    // var_dump($mysqli); 
    // on voit que l'objet $mysqli possède des méthodes (fonction) et des propriétés (variable)
    // var_dump(get_class_methods($mysqli));
    // echo '</pre>';


    /*
    
        L'objet $mysqli possède notamment la méthode query() qui va nous permettre d'effectuer les requêtes SQL auprès de la BDD

        Valeur de retour :
            SELECT / SHOW
            > succès => Mysqli_result (objet)
            > échec => FALSE (bool)

            INSERT / DELETE / UPDATE
            > succès => TRUE (bool)
            > échec => FALSE (bool)
    */


    // $mysqli->query("egirgjiprgjipegjiperg");
    

    /*
        Par défaut les erreurs SQL ne s'affichent pas. Il faut faire appel à une propriété de l'OBJET $mysqli
    */


    // echo $mysqli->error;





#   ---------------------------------------------
    # 1 - Requête : INSERT (DELETE, UPDATE)
#   ---------------------------------------------


    // $mysqli->query("INSERT INTO employes (prenom, nom, sexe, service, date_embauche, salaire) VALUES('Seraphin', 'Claus', 'M', 'commercial', CURDATE(), '2000')");

    // echo $mysqli->error;
    // echo 'Ligne(s) affectée(s) : ' . $mysqli->affected_rows;

    // $mysqli->query("DELETE FROM employes WHERE nom='claus'");
    // echo $mysqli->error;
    // echo 'Ligne(s) affectée(s) : ' . $mysqli->affected_rows;

    
    // $mysqli->query("UPDATE employes SET prenom='FREIDRICH' WHERE id_employes='3'");
    // echo $mysqli->error;
    // echo 'Ligne(s) affectée(s) : ' . $mysqli->affected_rows;






#   ---------------------------------------------
    # 2 - Requête : SELECT (un seul résultat)
#   ---------------------------------------------


    $resultat = $mysqli->query("SELECT * FROM employes WHERE id_employes = 10"); 
    // Pour les requêtes SELECT il faut obligatoirement stocker le résultat dans une variable 
    


    // echo '<pre>';
    // var_dump($resultat);
    // echo '</pre>';

    /*
        La variable nous retourne un OBJET : inexploitable tel quel :

        object(mysqli_result)[2]
        public 'current_field' => int 0
        public 'field_count' => int 7
        public 'lengths' => null
        public 'num_rows' => int 1
        public 'type' => int 0
    */



    // echo '<pre>';
    // var_dump(get_class_methods($resultat));
    // echo '</pre>';


    /*
        array (size=14)
        0 => string '__construct' (length=11)
        1 => string 'close' (length=5)
        2 => string 'free' (length=4)
        3 => string 'data_seek' (length=9)
        4 => string 'fetch_field' (length=11)
        5 => string 'fetch_fields' (length=12)
        6 => string 'fetch_field_direct' (length=18)
        7 => string 'fetch_all' (length=9)
        8 => string 'fetch_array' (length=11)
        9 => string 'fetch_assoc' (length=11)
        10 => string 'fetch_object' (length=12)
        11 => string 'fetch_row' (length=9)
        12 => string 'field_seek' (length=10)
        13 => string 'free_result' (length=11)
    */

    

    # Comment convertir cet OBJET en ARRAY ?


    $employe = $resultat->fetch_assoc(); 

    /*
        fetch_assoc() : permet d'indéxer de manière associative (càd que les champs des tables deviennent les indices de l'ARRAY)
        fetch_row() : permet d'indexer de manière numérique
        fetch_array() : permet d'indéxer de manière numérique + associative
    */



    // echo '<pre>';
    // print_r($employe);
    // echo '</pre>';

    /*
        Array
        (
            [id_employes] => 10
            [prenom] => Albus-Ryan
            [nom] => Dumbledore
            [sexe] => M
            [service] => informatique
            [date_embauche] => 1850-01-01
            [salaire] => 20000
        )
    */


    echo 'Bonjour ' . $employe['prenom'] . ' voici vos informations : <br><br>';


    foreach ($employe as $indice => $valeur) {
        echo $indice . ': <strong>' . $valeur . '</strong><br>';
    } 





#   ---------------------------------------------
    # 3 - Requête : SELECT (plusieurs résultats)
#   ---------------------------------------------


    $resultat = $mysqli->query("SELECT * FROM employes");



    // echo '<pre>';
    // print_r($resultat);
    // echo '</pre>';

    /*
        mysqli_result Object
        (
            [current_field] => 0
            [field_count] => 7
            [lengths] => 
            [num_rows] => 10
            [type] => 0
        )
    */


    
    // $employes = $resultat->fetch_assoc();



    // echo '<pre>';
    // print_r($employes);
    // echo '</pre>';

    /*
        Array
        (
            [id_employes] => 1
            [prenom] => Gertrude
            [nom] => Clochard
            [sexe] => F
            [service] => direction
            [date_embauche] => 1968-05-17
            [salaire] => 6000
        )
    */


    // while($employes = $resultat->fetch_assoc()){
    //     echo '<pre>';
    //     print_r($employes);
    //     echo '</pre>';
    // }


    /*
        Renvoie tous les array des employés 
    */



    echo '<br>';


#   ---------------------------------------------
    # 4 - Dupliquer une table SQL en tableau HTML
#   ---------------------------------------------

    $resultat = $mysqli->query("SELECT * FROM employes");

    echo 'Nombre d\'employé(s) : ' . $resultat->num_rows;

    echo '<br><br>';

    echo "<table border='1'>";
        echo '<tr>';

            // La méthode fetch_field() nous retourne le nom des champs sélectionnés 
            while($colonne = $resultat->fetch_field()){

                // echo '<pre>';
                // print_r($colonne);
                // echo '</pre>';

                echo '<th>' . ucfirst(str_replace('_', ' ', $colonne->name)) . '</th>';

                /*
                    La fonction ucfirst() permet de mettre en majuscule la première lette du sujet sélectionné
                    
                    La fonction str_replace() prend 3 arguments :
                        L'élément à chercher
                        La façon de le remplacer
                        Sujet sélectionné 
                */ 
            }

        echo '</tr>';

        while ($infos = $resultat->fetch_assoc()) {
            
            echo '<tr>';
            
                foreach ($infos as $key => $value) {
                    echo '<td>' . $value . '</td>';
                }

            echo '</tr>';
        }

    echo '</table>';