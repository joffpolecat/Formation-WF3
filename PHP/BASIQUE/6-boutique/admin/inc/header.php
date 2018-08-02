<?php 
  require_once('../inc/init.php');

  // Check si user n'est pas admin
  if(!userAdmin())
  {
    header('location:' . URL . 'index.php');
    exit();
  }
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Backoffice MaBoutique.com</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/dashboard/">

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

    <!-- CSS PERSO -->
    <link href="assets/css/style.css" rel="stylesheet">

  </head>
  </head>

  <body>
    <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top navbar-dark bg-dark">
      <button class="navbar-toggler navbar-toggler-right hidden-lg-up" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="#">BackOffice MaBoutique.com</a>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="<?= URL ?>admin/">Statistiques</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= URL ?>">Accès au site</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= URL ?>index.php?a=deconnect">Déconnexion</a>
          </li>
        </ul>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-sm-3 col-md-2 hidden-xs-down bg-faded sidebar">
          <ul class="nav nav-pills flex-column">
            <li class="nav-item">
              <a class="nav-link" href="<?= URL ?>admin/liste_produit.php">Liste produits</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= URL ?>admin/gestion_produit.php">Ajouter un produit</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= URL ?>admin/gestion_commandes.php">Gestion commandes</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= URL ?>admin/gestion_membres.php">Gestion membres</a>
            </li>
          </ul>
        </nav>

        <main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">

        BRANCHE "Partie-Maza"