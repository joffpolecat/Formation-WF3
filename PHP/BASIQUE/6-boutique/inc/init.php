<?php

// Ouverture de la session
    session_start();



// Initialisation du PDO : discution avec la BDD
    $dsn = 'mysql:host=localhost; dbname=boutique';
    $login = 'root';
    $pwd = '';
    $attributes = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];

    $pdo = new PDO($dsn, $login, $pwd, $attributes);


    

// Définition de CONSTANTE
    
    define('URL', 'http://localhost/php/6-boutique/');
    
    /*
        On définit l'URL du site afin de renvoyer automatiquement l'URL partout sans avoir besoin de modifier un à un les liens
    */

    define('RACINE_SITE', $_SERVER['DOCUMENT_ROOT'] . '/php/6-boutique/');
    /*
        On définit la racine de notre site grâce à la superglobale $_SERVER
    */



// Déclaration de variable
    $msg_erreur = '';
    $page = '';
    $contenu = '';


    require_once('fonction.php');
