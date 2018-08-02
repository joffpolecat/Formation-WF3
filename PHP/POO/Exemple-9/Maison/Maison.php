<?php

namespace Maison;

class Maison
{
    private $materiauxStructure;
    private $materiauxToiture;
    public $pieces;

    private const TYPE_MATERIAUX_STRUCTURE = ["Briques", "Bois", "Ciment", "Mousse"];
    private const TYPE_MATERIAUX_TOITURE = ["Tuiles", "Ardoise", "Branches"];

    public function __construct(string $materiauxStructure, string $materiauxToiture)
    {
        $this -> setMateriauxStructure($materiauxStructure);
        $this -> setMateriauxToiture($materiauxToiture);
    }

    public function getMateriauxStructure()
    {
        return $this->materiauxStructure;
    }

    public function setMateriauxStructure(string $materiauxStructure)
    {
        if(in_array($materiauxStructure, self/* == Maison (objet) */::TYPE_MATERIAUX_STRUCTURE))
        {
            $this->materiauxStructure = $materiauxStructure;
        }
        else
        {
            trigger_error("Le matériaux de la structure n'est pas valide.");
        }
        return $this;
    }

    public function getMateriauxToiture()
    {
        return $this->materiauxToiture;
    }
 
    public function setMateriauxToiture(string $materiauxToiture)
    {
        if(in_array($materiauxToiture, self::TYPE_MATERIAUX_TOITURE))
        {
            $this->materiauxToiture = $materiauxToiture;
        }
        else
        {
            trigger_error("Le matériaux de la toiture n'est pas valide.");
        }
        
        return $this;
    }

    public function getPieces()
    {
        return $this->pieces;
    }

    public function setPieces(array $pieces)
    {
        $this->pieces = $pieces;

        return $this;
    }

    public function getInfos()
    {
        $pieces = array();

        foreach ($this->getPieces() as $key => $value) 
        {
            $pieces[] = array(
                "nom" => $value->getNom(),
                "surface" => $value->getSurface(),
                "hauteur" => $value->getHauteur(),
                "nbFenetres" => $value->getNbFenetres(),
            );
        }

        $infos = array(
            "matStructure" => $this -> getMateriauxStructure(),
            "matToiture" => $this -> getMateriauxToiture(),
            "pieces" => $pieces
        );

        return $infos;
    }
}