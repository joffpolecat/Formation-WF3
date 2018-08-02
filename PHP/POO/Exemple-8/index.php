<?php

// Autoload
spl_autoload_register(function($className)
{
    if(file_exists($className . '.php'))
    {
        require_once($className . '.php');
    }
});


// Singleton

// Me permet de ne pas mettre \Singleton\ devant ma classe en dessous. Peut être utile lors de l'appel de beaucoup de classes.
use Singleton\Singleton; 

$singleton = /* à mettre si je n'utilise pas use Singleton\Singleton :  \Singleton\ */ Singleton::getInstance("NOM");
$singleton2 = /* à mettre si je n'utilise pas use Singleton\Singleton :  \Singleton\ */ Singleton::getInstance("NOM");


echo '<hr/>';

$formItem = \Factory\Factory::create("select");

echo '<hr/>';

// Patern observer : permet d'avoir des classes indépendantes
$messagerie = new \Observer\Messagerie();
$notification = new \Observer\Notification();

$messagerie->attach($notification); // Si commenté, tout fonctionne, juste la notification n'est pas envoyée.
$messagerie->envoyerMessage("HELLO");