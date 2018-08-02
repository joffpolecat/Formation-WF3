<?php 
    session_start();

    /*
        la fonction de session_start() nous permet d'initier une session. Si elle ne trouve aucun fichier, elle le créé elle-même.
    */

    $_SESSION['prenom'] = "Florian";
    $_SESSION['nom'] = 'Antonio';

    /*
        Nous pouvons reconnaître le détenteur d'une session grâce au cookie créé en parallèle via notre navigateur. Ce cookie détiendra l'identification de ce fichier de session (xampp/tmp OU wamp/tmp).
        Pour rappel, on a accès à ce fichier temporaire car nous simulons nous-même le serveur.
    */

    echo '<pre>';
    print_r($_SESSION);
    echo '</pre>';
    
    // session_destroy(); // Cette fonction détruit toutes valeurs en lien avec ma session. Je ne garde rien en mémoire !

    unset($_SESSION['nom']); // La fonction unset() nous permet de retirer des éléments liés à notre fichier temporaire de session
    // Exemple pour un ecommerce : cette méthode est à prévilégier en enlevant les valeurs de pseudo et mdp, je garde ainsi en mémoire le panier de l'utilisateur 

    // une session est un garde-mémoire pratique en supplément de la BDD
?>