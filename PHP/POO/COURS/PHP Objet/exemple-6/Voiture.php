<?php 
require_once('Vehicule.php');

final class Voiture extends Vehicule
{
    public function __construct($couleur)
    {
        parent::__construct($couleur);
        $this->type = "Voiture";
    }

    public function toString()
    {
        return parent::toString();
    }

    public static function klaxonner()
    {
        echo "Tutuuut !";
    }
}