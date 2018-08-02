<?php 
    require_once("inc/init.php"); 

    // On supprime seulement la partie membre de la SESSION et on garde le reste
    unset($_SESSION['membre']);

    header('location:index.php');
?>