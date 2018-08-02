<?php
    require_once('inc/header.php');

    $resultat = $pdo->query("SELECT * FROM produit");
    $produits = $resultat->fetchAll();

    $contenu .= "<div class='container'>";
    $contenu .= "<tr class='text-center'>";

    for ($i = 0; $i < $resultat->columnCount(); $i++) 
    {
        $champs = $resultat->getColumnMeta($i);
        $contenu .= "<th>" . $champs['name'] . "</th>";
    }

    $contenu .= '<th colspan="2">Actions</th>';
    $contenu .= "</tr>";

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
        $contenu .= '</tr>';
    }

    $contenu .= '</div>';


?>

<h1>Liste des produits</h1>


<?= $contenu ?>

<?php require_once('inc/footer.php'); ?>