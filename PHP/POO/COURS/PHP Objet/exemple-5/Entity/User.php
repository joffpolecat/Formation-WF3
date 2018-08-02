<?php 

/*
    - Une classe est un modèle de données avec des attributs et des méthodes qui va définir le    comportement d'un objet

    - Un objet est une instance de classe, c'est donc une variable que l'on peut utiliser comme 
      le modèle le défini

    - Une classe est un moule et un objet est un gateau (le moule indique qu'il faut des 
      ingrédients, l'objet indique lesquels)

    - La pseudo variable $this peut se traduire par "TON" ou "TA" (utilise TON premier   
      ingrédient avec TON deuxième et appelle TA méthode "Mélanger")
*/

/*
 id
 username
 password
 email
*/

namespace Entity;

//use Traits\ValidationTrait;

class User 
{
    use \Traits\ValidationTrait;

    // Attributs
    private $id;
    private $username;
    private $password;
    private $email;
    private $pays;
    private $sexe;
    private $presentation;

    public function __construct()
    {
    }

    // Méthodes
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
 
    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        if ($this->isStringLength($username, 3, 20)) {
            $this->username = $username;
        } else {
            trigger_error("Le nom d'utilisateur n'est pas valide");
        }

        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = md5($password);

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        if ($this->isMail($email)) {
            $this->email = $email;
        } else {
            trigger_error("L'adresse email n'est pas valide");
        }

        return $this;
    }

    public function getPays()
    {
        return $this->pays;
    }
    public function setPays($pays)
    {
        $this->pays = strToUpper($pays);

        return $this;
    }

    public function getPresentation()
    {
        return $this->presentation;
    }

    public function setPresentation($presentation)
    {
        $this->presentation = $presentation;

        return $this;
    }

    public function getSexe()
    {
        return $this->sexe;
    }

    public function setSexe($sexe)
    {
        $this->sexe = $sexe;

        return $this;
    }
}