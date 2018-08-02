<?php

    session_start();
    // on récupère les informations enregistrées grâce à $_SESSION


    $dsn = 'mysql:host=localhost; dbname=tchat';
    $login = 'root';
    $pwd = '';
    $attributes = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];

    $pdo = new PDO($dsn, $login, $pwd, $attributes);
    
    
    // INSERTION DU MESSAGE DANS LA BDD
    if($_POST && !empty($_POST['message'])){

        $resultat = $pdo->prepare("INSERT INTO commentaire (id_membre, pseudo, message, date_enregistrement) VALUES ('$_SESSION[id_membre]',' $_SESSION[pseudo]', :message, NOW())");

        $resultat->bindValue(":message", $_POST['message'], PDO::PARAM_STR);

        if($resultat->execute()){
            header('location: message.php');
        }

    }


    // RECUPERATION DE TOUS LES MESSAGES POUR L'AFFICHAGE
    $req = "SELECT mem.*, c.* FROM commentaire c, membre mem WHERE mem.id_membre = c.id_membre ORDER BY c.date_enregistrement ASC"; // ASC -> ascendant 

    // var_dump($req);

    $resultat = $pdo->query($req);

    // var_dump($resultat);

    $messages = $resultat->fetchAll();

    // echo '<pre>';
    // var_dump($messages);
    // echo '</pre>';


    /*
         On s'occupe de la déconnexion
         On vérifie que $_GET avec l'indice 'action' existe et qu'il est égal à 'deconnexion'
    */

    if(isset($_GET['action']) && $_GET['action']== 'deconnexion'){

        // session_destroy() nous permet de supprimer notre fichier de session
        session_destroy();

        // header() nous redirige vers la page d'accueil à la déconnexion
        header('location: index.php');
    }


?>


<!doctype html>
<html lang="fr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB"
        crossorigin="anonymous">

    <!-- CSS personnalisé -->
    <link rel="stylesheet" href="assets/CSS/style.css">

    <title>Tchat - Vos messages</title>
</head>

<body>
    <div class="container-fluid ">
        <div class="row text-right m-4">
            <div class="col-12">
                <a name="" id="" class="btn btn-secondary" href="?action=deconnexion" role="button">Déconnexion</a>
            </div>

        </div>

        <div class="row">
            <div class="col-md-7">
                <h4 class="m-4">Vos messages :</h4>
                <?php foreach ($messages as $message) : ?>
                <?php extract($message) ?>
                <?php if($id_membre == $_SESSION['id_membre']) : ?>
                <div class="row mt-4 align-items-center">
                    <div class="col-2 d-none d-sm-block text-center">
                        <div class="img">
                            <img class="rounded-circle shadow" src="assets/uploads/img/<?= $avatar?>" alt="" height="70px">
                        </div>
                    </div>
                    <div class="content col-sm-10">
                        <p class="auteur font-italic">Par
                            <strong>
                                <?= $pseudo ?>
                            </strong>, le
                            <?= $date_enregistrement?>
                        </p>
                        <p class="message p-3 mb-2 bg-primary text-white rounded shadow-sm">
                            <?= $message?>
                        </p>
                    </div>
                </div>
                <?php else : ?>
                <div class="row mt-4 align-items-center">
                    <div class="content col-sm-10">
                        <p class="auteur font-italic">Par
                            <strong>
                                <?= $pseudo ?>
                            </strong>, le
                            <?= $date_enregistrement?>
                        </p>
                        <p class="p-3 mb-2 bg-light rounded shadow-sm">
                            <?= $message?>
                        </p>
                    </div>
                    <div class="col-2 d-none d-sm-block text-center">
                        <div class="img">
                            <img class="rounded-circle shadow" src="assets/uploads/img/<?= $avatar?>" alt="" height="70px">
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <div class="col-md-4 mb-3">
                <h4 class="m-4">Nouveau message :</h4>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <textarea class="form-control" name="message" id="message" rows="3" placeholder="Votre message..."></textarea>
                    </div>
                    <button type="submit" class="btn-block btn btn-success">Envoyer</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>