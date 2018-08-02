<?php 

class Piece 
{
    private $nom;
    private $surface;
    private $hauteur;
    private $nbFenetres;

    public function __construct(string $nom, $surface, $hauteur)
    {
        $this->setNom($nom);
        $this->setSurface($surface);
        $this->setHauteur($hauteur);
        $this->nbFenetres = 0;
    }

    /**
     * Get the value of nom
     */ 
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */ 
    public function setNom(string $nom)
    {
        if (strlen($nom) > 3) {
            $this->nom = $nom;
        } else {
            trigger_error("Le nom de la pièce doit être plus grand que 3", E_USER_WARNING);
        }
    
        return $this;
    }

    /**
     * Get the value of surface
     */ 
    public function getSurface()
    {
        return $this->surface;
    }

    /**
     * Set the value of surface
     *
     * @return  self
     */ 
    public function setSurface($surface)
    {
        if ($surface > 0) {
            $this->surface = $surface;
        } else {
            trigger_error("La surface doit être plus grande que 0", E_USER_WARNING);
        }

        return $this;
    }

    /**
     * Get the value of hauteur
     */ 
    public function getHauteur()
    {
        return $this->hauteur;
    }

    /**
     * Set the value of hauteur
     *
     * @return  self
     */ 
    public function setHauteur($hauteur)
    {
        if ($hauteur > 0) {
            $this->hauteur = $hauteur;
        } else {
            trigger_error("La hauteur doit être plus grande que 0", E_USER_WARNING);
        }

        return $this;
    }

    /**
     * Get the value of nbFenetres
     */ 
    public function getNbFenetres()
    {
        return $this->nbFenetres;
    }

    /**
     * Set the value of nbFenetres
     *
     * @return  self
     */ 
    public function setNbFenetres($nbFenetres)
    {
        if ($nbFenetres >= 0) {
            $this->nbFenetres = $nbFenetres;
        } else {
            trigger_error("Le nombre de fenêtre doit être supérieur ou égale à 0", E_USER_WARNING);
        }

        return $this;
    }
}