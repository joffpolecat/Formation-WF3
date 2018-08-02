<?php
    require_once('inc/header.php');

    $resultat = $pdo->query("SELECT * FROM produit");
    $produits = $resultat->fetchAll();

    $contenu .= "<table class='table'>";
    $contenu .= "<thead><tr class='text-center'>";

    for ($i = 0; $i < $resultat->columnCount(); $i++) 
    {
        $champs = $resultat->getColumnMeta($i);
        $contenu .= "<th>" . $champs['name'] . "</th>";
    }

    $contenu .= '<th colspan="2">Actions</th>';
    $contenu .= "</tr></thead><tbody>";

    foreach ($produits as $produit) 
    {
        $contenu .= "<tr class='text-center'>";

        foreach ($produit as $key => $value) 
        {
            if ($key == 'photo') 
            {
                $contenu .= '<td><img height="100" src="'. URL . 'assets/uploads/img/' . $produit['photo'] . '"/></td>';
            } 
            else 
            {
                $contenu .= "<td>" . $value . "</td>";
            }
        }

        $contenu .= '<td><a name="modifier" id="modifier" class="btn btn-info" href="' . URL . "admin/gestion_produit.php?id=" . $produit['id_produit'] . '" role="button">Modifier</a></td>'; 
        $contenu .= '<td><a name="modifier" id="modifier" class="btn btn-danger" href="' . URL . "admin/suppression_produit.php?id=" . $produit['id_produit'] . '" role="button">Supprimer</a></td>'; 
        $contenu .= '</tr>';
    }

    $contenu .= '</tbody></table>';


?>

<h1>Liste des produits</h1>


<?= $contenu ?>

<?php require_once('inc/footer.php'); ?>