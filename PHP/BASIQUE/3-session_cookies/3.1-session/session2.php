<?php 

session_start();
echo $_SESSION['prenom'];

//La fonction session_start() nous permet de lire toutes les informations liées à ma session (exemple: test_session.php)

// Par exemple, l'ouverture de session nous permet de conserver les infos d'un panier (ecommerce)