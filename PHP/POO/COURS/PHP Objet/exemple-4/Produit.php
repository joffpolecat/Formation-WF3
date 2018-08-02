<?php 
require_once('Supprimable.php');
require_once('Entity.php');

class Produit extends Entity implements Supprimable
{
    public function supprimer()
    {
        echo "Suppression du produit";
    }
}