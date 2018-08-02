<?php

namespace Maison;

class Piece
{
    private $nom;
    private $surface;
    private $hauteur;
    private $nbFenetres;

    public function __construct($nomPiece, $surface, $hauteur, $nbFenetres = 0)
    {
        $this -> setNom($nomPiece);
        $this -> setSurface($surface);
        $this -> setHauteur($hauteur);
        $this -> setNbFenetres($nbFenetres);
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        if(strlen($nom) > 3)
        {
            $this->nom = $nom;
        }
        else
        {
            trigger_error("Le nom doit comporter au moins 3 caractères.", E_USER_WARNING);
        }

        return $this;
    }

    public function getSurface()
    {
        return $this->surface;
    }

    public function setSurface($surface)
    {
        if($surface > 0)
        {
            $this->surface = $surface;
        }
        else
        {
            trigger_error("La surface doit être supérieure à 0.");
        }

        return $this;
    }

    public function getHauteur()
    {
        return $this->hauteur;
    }

    public function setHauteur($hauteur)
    {
        if($hauteur > 0)
        {
            $this->hauteur = $hauteur;
        }
        else
        {
            trigger_error("La hauteur doit être supérieure à 0.");
        }

        return $this;
    }

    public function getNbFenetres()
    {
        return $this->nbFenetres;
    }

    public function setNbFenetres($nbFenetres)
    {
        if($nbFenetres >= 0)
        {
            $this->nbFenetres = $nbFenetres;
        }
        else
        {
            trigger_error("Il ne peux pas y avoir de nombre négatif.");
        }

        return $this;
    }
}