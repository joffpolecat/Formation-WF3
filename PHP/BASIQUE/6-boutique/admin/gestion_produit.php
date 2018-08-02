<?php
    require_once('inc/header.php');

    // debug($_POST);
    // debug($_FILE);

    if($_POST)
    {

        // Je regarde si une photo est uploadée
        if(!empty($_FILES['photo']['name']))
        {
            // Je donne une référence aléatoire unique au nom de ma photo
            $nom_photo = $_POST['reference'] . '_' . time() . '_' . rand(1,999) . '_' . $_FILES['photo']['name'];

            // On enregistre dans cette variable le chemin définitif de ma photo
            $chemin_photo = RACINE_SITE . 'assets/uploads/img/' . $nom_photo;

            // Vérification de la taille de la photo
            if($_FILES['photo']['size'] > 2000000)
            {
                $msg_erreur .= "<div class='alert alert-danger'>Veuillez sélectionner un fichier de 2Mo maximum.</div>";
            }

            // Vérification du type de fichier
            $tab_type = ['image/jpeg', 'image/png', 'image/gif'];

            // On regarde que le type de photo envoyé avec $_FILES est conforme aux types rentrés dans $tab_type
            if(!in_array($_FILES['photo']['type'], $tab_type))
            {
                $msg_erreur .= "<div class='alert alert-danger'>Veuillez sélectionner un fichier JPEG/JPG, PNG ou GIF.</div>";
            }
            
            // 4) Si tout est ok et pdt enregistré en BDD, copier image dans notre dossier photo => APRES VERIFICATION (sauvegarder espace serveur)

        } 
        elseif(isset($_POST['photo_actuelle'])) { // si je suis en train de modifier un produit alors photo_actuelle existe et je prend sa valeur pour la mettre dans nom_photo afin qu'elle soit enregistrée dans la BDD
            $nom_photo = $_POST['photo_actuelle'];
        }
        else {
            // $msg .= '<div class="erreur">Veuillez sélectionner une photo</div>';
            $nom_photo = 'default.jpg';
        }



        // Vérification des autres champs : champs remplis, nombre de caractères, informations numériques en stock/prix...


        if(empty($msg_erreur))
        {
            // On enregistre la modification
            if(!empty($_POST['id_produit']))
            {
                $resultat = $pdo->prepare("REPLACE INTO produit (id_produit, reference, categorie, titre, description, couleur, taille, public, photo, prix, stock) VALUES (:id_produit, :reference, :categorie, :titre, :description, :couleur, :taille, :public, :photo, :prix, :stock)");

                $resultat->bindValue(':id_produit', $_POST['id_produit'], PDO::PARAM_INT);

                // $nom_photo = (isset($_POST['photo'])) ? $_POST['photo'] : '' ;
            }
            // On enregistre dans la BDD pour la première fois
            else
            {
                $resultat = $pdo->prepare("INSERT INTO produit (reference, categorie, titre, description, couleur, taille, public, photo, prix, stock) VALUES (:reference, :categorie, :titre, :description, :couleur, :taille, :public, :photo, :prix, :stock)");
            }

            
            $resultat->bindValue(':reference', $_POST['reference'], PDO::PARAM_STR);
            $resultat->bindValue(':categorie', $_POST['categorie'], PDO::PARAM_STR);
            $resultat->bindValue(':titre', $_POST['titre'], PDO::PARAM_STR);
            $resultat->bindValue(':description', $_POST['description'], PDO::PARAM_STR);
            $resultat->bindValue(':couleur', $_POST['couleur'], PDO::PARAM_STR);
            $resultat->bindValue(':taille', $_POST['taille'], PDO::PARAM_STR);
            $resultat->bindValue(':public', $_POST['public'], PDO::PARAM_STR);
            $resultat->bindValue(':photo', $nom_photo, PDO::PARAM_STR);
            $resultat->bindValue(':prix', $_POST['prix'], PDO::PARAM_STR);
            $resultat->bindValue(':stock', $_POST['stock'], PDO::PARAM_INT);
            
            // Si la requête est bien enregistrée en BDD
            if($resultat->execute())
            {
                if(!empty($_FILES['photo']['name']))
                {
                    copy($_FILES['photo']['tmp_name'], $chemin_photo);
                }               
            }
        }
    }


    // Vérification si il existe le $_GET['id'] + il est rempli + c'est un chiffre
    if(isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id']))
    {
        $req = "SELECT * FROM produit WHERE id_produit = :id";

        $resultat = $pdo->prepare($req);
        $resultat->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
        $resultat->execute();

        if($resultat->rowCount() > 0)
        {
            $produit_actuel = $resultat->fetch();
        }
    }

    $reference = (isset($produit_actuel)) ? $produit_actuel['reference'] : '';
    $categorie = (isset($produit_actuel)) ? $produit_actuel['categorie'] : '';
    $titre = (isset($produit_actuel)) ? $produit_actuel['titre'] : '';
    $description = (isset($produit_actuel)) ? $produit_actuel['description'] : '';
    $couleur = (isset($produit_actuel)) ? $produit_actuel['couleur'] : '';
    $taille = (isset($produit_actuel)) ? $produit_actuel['taille'] : '';
    $public = (isset($produit_actuel)) ? $produit_actuel['public'] : '';
    $photo = (isset($produit_actuel)) ? $produit_actuel['photo'] : '';
    $prix = (isset($produit_actuel)) ? $produit_actuel['prix'] : '';
    $stock = (isset($produit_actuel)) ? $produit_actuel['stock'] : '';

    $action = (isset($produit_actuel)) ? 'Modifier' : 'Ajouter';

    $id_produit = (isset($produit_actuel)) ? $produit_actuel['id_produit'] : '';
    
?>

<h1><?= $action?> un produit</h1>
<form action="" method="post" enctype="multipart/form-data" class="mb-4">

    <?= $msg_erreur ?>

    <div class="row">
        <div class="form-group col-12">
            <input type="hidden" class="form-control" name="id_produit" id="id_produit" aria-describedby="helpId" placeholder="Identifiant produit" value="<?= $id_produit ?>">
        </div>
    </div>
    

    <div class="row">
        <div class="form-group col-md-4">
            <input type="text" class="form-control" name="reference" id="reference" aria-describedby="helpId" placeholder="Référence produit" value="<?= $reference ?>">
        </div>
        <div class="form-group col-md-4">
            <input type="text" class="form-control" name="categorie" id="categorie" aria-describedby="helpId" placeholder="Catégorie produit" value="<?= $categorie ?>">
        </div>
        <div class="form-group col-md-4">
            <input type="text" class="form-control" name="titre" id="titre" aria-describedby="helpId" placeholder="Titre du produit" value="<?= $titre ?>">
        </div>
    </div>

    <div class="form-group">
        <textarea class="form-control" name="description" id="description" rows="10" cols="30" placeholder="Description du produit"><?= $description ?></textarea>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <select name="couleur" class="form-control" id="couleur">
                <option <?php if(empty($couleur)){echo 'selected';}?> disabled>-- Choisissez la couleur --</option>
                <option <?php if($couleur == "noir"){echo 'selected';}?> value="noir">Noir</option>
                <option <?php if($couleur == "blanc"){echo 'selected';}?> value="blanc">Blanc</option>
                <option <?php if($couleur == "gris"){echo 'selected';}?> value="gris">Gris</option>
                <option <?php if($couleur == "rouge"){echo 'selected';}?> value="rouge">Rouge</option>
                <option <?php if($couleur == "jaune"){echo 'selected';}?> value="jaune">Jaune</option>
                <option <?php if($couleur == "vert"){echo 'selected';}?> value="vert">Vert</option>
                <option <?php if($couleur == "violet"){echo 'selected';}?> value="violet">Violet</option>
                <option <?php if($couleur == "moutarde"){echo 'selected';}?> value="moutarde">Moutarde</option>
                <option <?php if($couleur == "rose"){echo 'selected';}?> value="rose">Rose</option>
                <option <?php if($couleur == "saumon"){echo 'selected';}?> value="saumon">Saumon</option>
            </select>
        </div>
        <div class="form-group col-md-4">
            <select name="taille" class="form-control" id="taille">
                <option <?php if(empty($taille)){echo 'selected';}?> disabled>-- Choisissez la taille --</option>
                <option <?php if($taille == "xs"){echo 'selected';}?> value="xs">XS</option>
                <option <?php if($taille == "s"){echo 'selected';}?> value="s">S</option>
                <option <?php if($taille == "m"){echo 'selected';}?> value="m">M</option>
                <option <?php if($taille == "l"){echo 'selected';}?> value="l">L</option>
                <option <?php if($taille == "xl"){echo 'selected';}?> value="XL">XL</option>
            </select>
        </div>
        <div class="form-group col-md-4">
            <select name="public" class="form-control" id="public">
                <option <?php if(empty($public)){echo 'selected';}?> disabled>-- Choisissez le publique --</option>
                <option <?php if($public == "homme"){echo 'selected';}?> value="homme">Homme</option>
                <option <?php if($public == "femme"){echo 'selected';}?> value="femme">Femme</option>
                <option <?php if($public == "mixte"){echo 'selected';}?> value="mixte">Mixte</option>
            </select>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-12">
            <label for="photo">Photo du produit</label>
            <input type="file" class="form-control-file" id="photo" name="photo">
            <?php
                // Si je modifie un produit
                if(isset($produit_actuel))
                {
                    echo "<input name='photo_actuelle' value=" . $photo . " type='hidden'>";
                    echo "<img style='width:20%;' src='" . URL . "assets/uploads/img/" . $photo . "'>";
                }
            ?>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <!-- 
            /!\ ALERTE /!\ 

            Si FLOAD en BDD, alore le type doit être en TEXT
        -->
            <input type="text" class="form-control" name="prix" id="prix" aria-describedby="helpId" placeholder="Prix du produit" value="<?= $prix ?>">
        </div>
        <div class="form-group col-md-6">
            <input type="text" class="form-control" name="stock" id="stock" aria-describedby="helpId" placeholder="Stock du produit" value="<?= $stock ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <button type="submit" class="btn btn-block btn-success"><?= $action ?></button>
        </div>
    </div>
</form>


<?php require_once('inc/footer.php'); ?>