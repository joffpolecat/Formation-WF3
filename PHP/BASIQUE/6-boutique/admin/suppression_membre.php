<?php

require_once('inc/header.php');

// Vérification si il existe le $_GET['id'] + il est rempli + c'est un chiffre
if(isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id']))
{
    $req = "SELECT * FROM membre WHERE id_membre = :id";

    $resultat = $pdo->prepare($req);
    $resultat->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
    $resultat->execute();

    if($resultat->rowCount() > 0)
    {
        $membre = $resultat->fetch();

        $req2 = "DELETE FROM membre WHERE id_membre = $membre[id_membre]";

        $resultat2 = $pdo->exec($req2);

        header('location:' . URL . 'admin/gestion_membres.php');
    }
    else
    {
        header('location:' . URL . 'admin/gestion_membres.php');
    }
}
else
{
    header('location:' . URL . 'admin/gestion_membres.php');
}





// INSERT INTO `membre` (`id_membre`, `pseudo`, `mdp`, `nom`, `prenom`, `email`, `civilite`, `ville`, `code_postal`, `adresse`, `statut`) VALUES (NULL, 'pseudo2', 'pseudo2', 'pseudo2', 'pseudo2', 'pseudo2', 'm', 'pseudo2', '55555', 'pseudo2', '0');