<?php 
    require_once("inc/header.php"); 

    if(!userConnect())
    {
        header('location:connexion.php');
        exit();
    }

    $page = 'Bienvenue ' . $_SESSION['membre']['pseudo'] . ' !';

    // if(!isset($_SESSION['membre']))
    // {
    //     header('location:connexion.php');
    // }

    
?>

    <div class="text-center">
        <h1><?= $page?></h1>
        <p class="lead">Voici vos informations:</p>
        
        <ul class="list-unstyled">
            <li class="p-2">Votre nom: <?= $_SESSION['membre']['nom']?></li>
            <li class="p-2">Votre prénom: <?= $_SESSION['membre']['prenom']?></li>
            <li class="p-2">Votre email: <?= $_SESSION['membre']['email']?></li>
        </ul>
    </div>
       
<?php require_once("inc/footer.php"); ?>