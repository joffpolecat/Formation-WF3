<?php

require_once('Vehicule.php');

class Moto extends Vehicule
{
    public function __construct($couleur)
    {
        parent::__construct($couleur);
        $this->estMotorise = true;
        $this->nombrePortes = 0;
        $this->nombreRoues = 2;
    }

    public function toString()
    {
        return "Moto " . parent::toString();
        $this->type = "Moto";
    }

    public static function klaxonner()
    {
        echo "tut";
    }
}
