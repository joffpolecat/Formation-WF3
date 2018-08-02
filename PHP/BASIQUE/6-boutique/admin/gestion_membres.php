<?php
    require_once('inc/header.php');

    $resultat = $pdo->query("SELECT id_membre, pseudo, nom, prenom, email, civilite, ville, code_postal, adresse, statut FROM membre");
    $membres = $resultat->fetchAll();

    $contenu .= '<a name="modifier" id="modifier" class="btn btn-warning mb-4" href="' . URL . 'admin/create_admin.php' . '" role="button">Ajouter un nouvel administrateur</a>';
    $contenu .= "<table class='table'>";
    $contenu .= "<thead><tr class='text-center'>";

    for ($i = 0; $i < $resultat->columnCount(); $i++) 
    {
        $champs = $resultat->getColumnMeta($i);

        if($champs['name'] == "id_membre")
        {
            $contenu .= "<th style='display: none'>" . $champs['name'] . "</th>";
        }
        else
        {
            $contenu .= "<th>" . $champs['name'] . "</th>";
        }
        
    }

    $contenu .= '<th colspan="2">Actions</th>';
    $contenu .= "</tr></thead><tbody>";

    foreach ($membres as $membre) 
    {
        $contenu .= "<tr class='text-center'>";

        foreach ($membre as $key => $value) 
        {
            if($key == "id_membre")
            {
                $contenu .= "<td style='display: none'>" . $value . "</td>";
            }
            else
            {
            $contenu .= "<td>" . $value . "</td>";
            }
        }

        $contenu .= '<td><a name="modifier" id="modifier" class="btn btn-info" href="' . URL . "admin/statut_membre.php?id=" . $membre['id_membre'] . '" role="button">Modifier statut</a></td>'; 
        $contenu .= '<td><a name="modifier" id="modifier" class="btn btn-danger" href="' . URL . "admin/suppression_membre.php?id=" . $membre['id_membre'] . '" role="button">Supprimer</a></td>';
        $contenu .= '</tr>';
    }

    $contenu .= '</tbody></table>';


?>

<h1>Liste des membres</h1>

<?= $contenu ?>

<?php require_once('inc/footer.php'); ?>