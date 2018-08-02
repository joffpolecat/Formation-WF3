<?php

    /*
        QU'EST-CE QU'UN COOKIE ?
        C'est un fichié placé sur l'ordi de l'internaute sur lequel ce dernier a le contrôle (possibilité de modification ou suppression)

        Attention avec la nouvelle norme RGPD

        
        Utilisation de la superglobale $_COOKIE

        Cas d'utilisation: 
        > Fournir du contenu personnalisé ou se rappeler de la dernière page associée à un produit
        > Enregistrer les préférences utilisateur (langue, pays, ...)
        > Diffuser des publicités et du contenu adapté aux centres d'intérêts (ex: Criteo)
        > Fournir des analyses générales en interne ou pour un client
        > Gérer des informations de façon identifiable ou anonyme
        > Audit pour améliorer le contenu, les produits, les services...
        > Mise en oeuvre de mesures de sécurité par exemple en déconnectant un compte après une certaine période d'inactivité 
        > Identifier des activités potentiellement illicites
        > ...

    */

    /*
    echo '<pre>';
    print_r($_GET);
    echo '</pre>';
    */

    if(isset($_GET['pays'])){
        $pays = $_GET['pays'];
    }else if(isset($_COOKIE['pays'])){
        $pays = $_COOKIE['pays'];
    } else {
        $pays = "fr";
    }
    
    setcookie('pays', $pays, time()+365*24*3600); 
    /* la fonction setCookie() nous permet d'enregistrer un cookie et prend 3 arguments : nom du cookie + sa valeur + durée de vie. 
    setcookie() remplacera le cookie déjà existant à chaque visite > 1 visite = 1 an de plus
    */
?>

<h1>Choisissez votre langue :</h1>
<ul>
    <li><a href="?pays=fr">Français</a></li>
    <li><a href="?pays=es">Español</a></li>
    <li><a href="?pays=uk">English</a></li>
    <li><a href="?pays=it">Italiano</a></li>
</ul>

<?php 

    switch ($pays) {
        case 'fr':
            echo "Bonjour, vous visitez actuellement le site en Français \o/";
            break;
        case 'es':
            echo "Hola, en este momento estais visitando el sitio en español \o/";
            break;
        case 'uk':
            echo "Hello, you are currently visiting the site in English \o/";
            break;
        case 'it':
            echo "Bongiorno, in questo momento state visitando il sito in lingua italiana \o/";
            break;
        
        default:
            echo "Choissez votre langue...";
            break;
    }

?>