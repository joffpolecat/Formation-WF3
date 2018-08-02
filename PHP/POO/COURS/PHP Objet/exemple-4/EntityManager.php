<?php 
require_once('Client.php');
require_once('Produit.php');

class EntityManager
{
    public static function supprimerEntity(Supprimable $entity)
    {
        $entity->supprimer();
    }
}