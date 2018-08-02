<?php 

// Autoload
spl_autoload_register(function($class){
    if (file_exists($class.'.php')) {
        require_once($class.'.php');
    }
});

// Singleton
$singleton = \Singleton\Singleton::getInstance("NOM");

$singleton2 = \Singleton\Singleton::getInstance("NOM");

echo "<hr/>";

$formItem = \Factory\Factory::create("select");

echo "<hr/>";
$messagerie = new \Observer\Messagerie();
$notification = new \Observer\Notification();

$messagerie->attach($notification);
$messagerie->envoyerMessage("HELLO");