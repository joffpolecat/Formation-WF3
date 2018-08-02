<?php 
    require_once("inc/header.php"); 
    $page = 'Bienvenue';

    if(isset($_GET['a']) && $_GET['a'] == 'deconnect')
    {
        unset($_SESSION['membre']);
        header('location: index.php');
    }
?>

    <div class="text-center">
        <h1><?= $page?></h1>
        <p class="lead">Super e-commerce</p>
    </div>
       
<?php require_once("inc/footer.php"); ?>