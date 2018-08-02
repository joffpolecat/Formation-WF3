<?php
    require_once('inc/header.php');

    $resultat = $pdo->query("SELECT c.id_commande, c.date_enregistrement, c.montant, c.etat, m.id_membre, m.pseudo, m.nom, m.prenom, m.adresse, m.code_postal, m.ville FROM commande c, membre m WHERE c.id_membre = m.id_membre");
    
    $commandes = $resultat->fetchAll();

    $ca = 0;

    foreach ($commandes as $commande) 
    {
        $ca += $commande['montant'];

        $contenu .= '<div class="border border-secondary p-2 mb-3">';
        $contenu .= '<h3>Infos commande</h3>';
        $contenu .= '<p>id commande : ' . $commande['id_commande'] . ' | date d\'enregistrement : ' . $commande['date_enregistrement'] . ' | Montant : ' . $commande['montant'] . ' | État de la commande : ' . $commande['etat'] . '</p>';
        $contenu .= '<a class="btn btn-info" href="'. URL . '/admin/etat_commande.php?id=' . $commande['id_commande'] .'" role="button">Modifier l\'état de la commande</a>';
        $details = $pdo->prepare("SELECT d.id_produit, p.reference, p.titre, p.photo, d.quantite, p.couleur, p.taille, p.public FROM details_commande d, produit p WHERE d.id_produit = p.id_produit AND d.id_commande = :id_commande");
        $details->bindValue(':id_commande', $commande['id_commande'], PDO::PARAM_STR);
        $details->execute();
        
        $detailcommande = $details->fetchAll();

        $contenu .= '<h3 class="mt-4">Infos produits</h3>';
        $contenu .= "<table class='table mt-4'>";
        $contenu .= "<thead><tr class='text-center'>";

        for ($i = 0; $i < $details->columnCount(); $i++) 
        {
            $champs = $details->getColumnMeta($i);
            $contenu .= "<th>" . $champs['name'] . "</th>";
        }

        $contenu .= "</tr></thead><tbody>";

        foreach ($detailcommande as $produit) 
        {
            $contenu .= "<tr class='text-center'>";
            
                foreach ($produit as $key => $value) 
                {
                    if ($key == 'photo') 
                    {
                        $contenu .= '<td><img height="50" src="'. URL . 'assets/uploads/img/' . $produit['photo'] . '"/></td>';
                    } 
                    else 
                    {
                        $contenu .= "<td>" . $value . "</td>";
                    }
                }

            $contenu .= "</tr>";
            
        }
        $contenu .= '</tbody></table>';

        $membres = $pdo->prepare("SELECT m.id_membre, m.pseudo, m.nom, m.prenom, m.adresse, m.code_postal, m.ville FROM membre m, commande c WHERE m.id_membre = c.id_membre AND c.id_membre = :id_membre");
        $membres->bindValue(':id_membre', $commande['id_membre'], PDO::PARAM_STR);
        $membres->execute();
        
        $membre = $membres->fetchAll();

        $contenu .= '<h3 class="mt-4">Infos membre</h3>';
        $contenu .= "<table class='table mt-4'>";
        $contenu .= "<thead><tr class='text-center'>";

        for ($i = 0; $i < $membres->columnCount(); $i++) 
        {
            $champs = $membres->getColumnMeta($i);
            $contenu .= "<th>" . $champs['name'] . "</th>";
        }

        $contenu .= "</tr></thead><tbody>";

        foreach ($membre as $detail) 
        {
            $contenu .= "<tr class='text-center'>";
            
                foreach ($detail as $key => $value) 
                {
                    $contenu .= "<td>" . $value . "</td>";
                }

            $contenu .= "</tr>";
            
        }
        $contenu .= '</tbody></table>';
        $contenu .= '</div>';
    }

    


?>

<h1>Gestion des commandes</h1>

<div class="alert alert-success" role="alert">
  <h5 class="alert-heading">Chiffre d'affaire total</h4>
  <p><?= $ca ?>€</p>
</div>

<?= $contenu ?>

<?php require_once('inc/footer.php'); ?>