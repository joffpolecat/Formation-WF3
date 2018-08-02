<?php

    require_once("inc/init.php");

?>


<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mazarine">
    <link rel="icon" href="../../../../favicon.ico">

    <title>MaBoutique.com</title>

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB"
        crossorigin="anonymous">

    <!-- FONTAWESOME -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

    <!-- CSS PERSO -->
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body id="body">

    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="<?= URL ?>">MaBoutique</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="<?= URL ?>">Accueil</a>
                </li>
                <li class="nav-item">
                    <!-- ATTENTION LIEN A FAIRE EVOLUER -->
                    <a class="nav-link" href="<?= URL ?>"><i class="fas fa-shopping-cart"></i> Boutique</a>
                </li>

                <?php if(userConnect()) : ?>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= URL ?>profil.php"><i class="fas fa-user"></i> Profil</a>
                    </li>

                <?php else : ?>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="https://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"><i class="fas fa-user"></i> Mon compte</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown01">
                            <a class="dropdown-item" href="<?= URL ?>connexion.php">Connexion</a>
                            <a class="dropdown-item" href="<?= URL ?>inscription.php">Inscription</a>
                        </div>
                    </li>

                <?php endif; ?>

                <li class="nav-item">
                    <!-- ATTENTION LIEN A FAIRE EVOLUER -->
                    <a class="nav-link" href="<?= URL ?>">Contact</a>
                </li>

                <?php if(userAdmin()) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= URL ?>admin/">Accès à BackOffice</a>
                    </li>
                <?php endif; ?>

                <?php if(userConnect()) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= URL ?>deconnexion.php">Déconnexion</a>
                    </li>
                <?php endif; ?>
            </ul>
            <!-- <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form> -->
        </div>
    </nav>

    <main role="main" class="container">