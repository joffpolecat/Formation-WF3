<?php

class Produit
{
    protected $prix;
    protected $poids;
    
    public function __construct($prix, $poids)
    {
        $this->setPrix($prix);
        $this->setPoids($poids);
    }
    
    public function getPrix()
    {
        return $this->prix;
    }

    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    public function getPoids()
    {
        return $this->poids;
    }

    public function setPoids($poids)
    {
        $this->poids = $poids;

        return $this;
    }
}