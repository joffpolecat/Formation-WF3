<?php

require_once('inc/header.php');

// Vérification si il existe le $_GET['id'] + il est rempli + c'est un chiffre
if(isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id']))
{
    $req = "SELECT * FROM produit WHERE id_produit = :id";

    $resultat = $pdo->prepare($req);
    $resultat->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
    $resultat->execute();

    if($resultat->rowCount() > 0)
    {
        $produit = $resultat->fetch();

        $req2 = "DELETE FROM produit WHERE id_produit = $produit[id_produit]";

        $resultat2 = $pdo->exec($req2);

        if($resultat !== FALSE)
        {
            $chemin_photo_suppression = RACINE_SITE . 'assets/uploads/img/' . $produit['photo'];

            // Cette fonction permet de vérifier s'il existe bien un fichier dans notre dossier serveur
            if(file_exists($chemin_photo_suppression) && $produit['photo'] != 'default.png')
            {
                // Cette fonction nous permet de supprimer le fichier sélectionné
                unlink($chemin_photo_suppression);
            }

            header('location:' . URL . 'admin/liste_produit.php');
        }
    }
    else
    {
        header('location:' . URL . 'admin/liste_produit.php');
    }
}
else
{
    header('location:' . URL . 'admin/liste_produit.php');
}