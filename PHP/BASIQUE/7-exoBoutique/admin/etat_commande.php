<?php
    require_once('inc/header.php');

    if($_POST)
    {

        if(empty($msg_erreur))
        {
            $resultat = $pdo->prepare("UPDATE commande SET etat = :etat WHERE id_commande = :id_commande");

            $resultat->bindValue(':id_commande', $_POST['id_commande'], PDO::PARAM_INT);
            $resultat->bindValue(':etat', $_POST['etat'], PDO::PARAM_STR);

           $resultat->execute();
           header('location:' . URL . 'admin/gestion_commandes.php');
        }
    }


    // Vérification si il existe le $_GET['id'] + il est rempli + c'est un chiffre
    if(isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id']))
    {
        $req = "SELECT * FROM commande WHERE id_commande = :id";

        $resultat = $pdo->prepare($req);
        $resultat->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
        $resultat->execute();

        if($resultat->rowCount() > 0)
        {
            $commande = $resultat->fetch();
        }
    }

    $etat = (isset($commande)) ? $commande['etat'] : '';
    $id_commande = (isset($commande)) ? $commande['id_commande'] : '';
    
?>

<h1>Modifier état commande</h1>
<form action="" method="post" enctype="multipart/form-data" class="mb-4">

    <?= $msg_erreur ?>

    <div class="row">
        <div class="form-group col-12">
            <input type="hidden" class="form-control" name="id_commande" id="id_commande" aria-describedby="helpId" placeholder="Identifiant commande" value="<?= $id_commande ?>">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-12">
            <select name="etat" class="form-control" id="etat">
                <option <?php if(empty($etat)){echo 'selected';}?> disabled>-- Choisissez l'état --</option>
                <option <?php if($etat == "preparation"){echo 'selected';}?> value="preparation">preparation</option>
                <option <?php if($etat == "en cour de livraison"){echo 'selected';}?> value="en cour de livraison">en cours de livraison</option>
                <option <?php if($etat == "livré"){echo 'selected';}?> value="livré">livré</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <button type="submit" class="btn btn-block btn-success">Mettre à jour</button>
        </div>
    </div>
</form>


<?php require_once('inc/footer.php'); ?>