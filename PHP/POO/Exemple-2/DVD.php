<?php 

require_once('Produit.php');

class DVD extends Produit
{
    private $acteurs;
    private $zone;
    
    public function __construct($prix, $zone)
    {
        $this->setZone($zone);
        parent::__construct($prix, 110);
    } 

    public function getActeurs()
    {
        return $this->acteurs;
    }

    public function setActeurs(array $acteurs)
    {
        $this->acteurs = $acteurs;

        return $this;
    }

    public function getZone()
    {
        return $this->zone;
    }

    public function setZone($zone)
    {
        $this->zone = $zone;

        return $this;
    }
}