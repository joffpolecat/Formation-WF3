<?php 

require_once('EntityManager.php');

$produit = new Produit;
$client = new Client;

EntityManager::supprimerEntity($client);