<?php
require_once('client.php');
require_once('produit.php');
class EntityManager
{
	public static function supprimerEntity(supprimable $entity)
	{
		$entity->supprimer();
	}
}