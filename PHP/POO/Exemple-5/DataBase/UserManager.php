<?php

namespace DataBase;

use Entity\User;

class UserManager extends DBManager
{

    private $data = ["username", "password", "email", "pays", "sexe", "presentation"];

    /*
    
    ANCIENNE VERSION REMPLACÉE PAR LA NOUVELLE JUSTE EN DESSOUS
    
    public function save(User $user)
    {
        // $query = $this->pdo->prepare("INSERT INTO user (username, password, email, pays, sexe, presentation) VALUES (:username, :password, :email, :pays, :sexe, :presentation)");

        // $query->bindValue(':username', $user->getUsername());
        // $query->bindValue(':password', $user->getPassword());
        // $query->bindValue(':email', $user->getEmail());
        // $query->bindValue(':pays', $user->getPays());
        // $query->bindValue(':sexe', $user->getSexe());
        // $query->bindValue(':presentation', $user->getPresentation());
        
        // $query->execute();

        $data = $this->data;
        $attributes = "";
        $values = "";

        // Boucle sur les données pour créer la requête (username, email,...) VALUES (:username, :email,...)
        foreach ($data as $key => $value) 
        {
            $attributes .= $value . ',';
            $values .= ':' . $value . ',';
        }

        // Supprime le dernier ',' sur $attributes & $values
        $attributes = substr($attributes, 0, strlen($attributes) -1); 
        $values = substr($values, 0, strlen($values) -1);

        $queryStr = "INSERT INTO user (" . $attributes . ") VALUES (" . $values . ")";

        $query = $this->pdo->prepare($queryStr);

        // Boucle pour appeler les méthodes accesseurs (getUsername())
        foreach ($data as $key => $value) 
        {
            $methode = "get" . ucfirst($value);
            $query->bindValue(':' . $value, $user->$methode());
        }

        $query->execute();
    }
    */

    // VERSION DE LOIC
    public function save(User $user)
    {
        /*$query = $this->pdo->prepare("INSERT INTO user (username, password, email, pays, sexe, presentation) VALUES (:username, :password, :email, :pays, :sexe, :presentation)");
        $query->bindValue(':username', $user->getUsername());
        $query->bindValue(':password', $user->getPassword());
        $query->bindValue(':email', $user->getEmail());
        $query->bindValue(':pays', $user->getPays());
        $query->bindValue(':sexe', $user->getSexe());
        $query->bindValue(':presentation', $user->getPresentation());

        $query->execute();*/

        $data = $this->data;
        
        // Update
        if ($user->getId() > 0) 
        {
            $setters = "";
            
            foreach ($data as $key => $value) 
            {
                $setters .= $value . " = :".$value.",";
            }
            
            // Supprime le dernier ','
            $setters = substr($setters, 0, strlen($setters) - 1); 

            $queryStr = "UPDATE user SET " . $setters . " WHERE id=".$user->getId();
        } 
        else 
        {
            $attributes = "";
            $values = "";

            // Boucle sur les données pour créer la requête (username, email ...) VALUES (:username, :email ...)
            foreach ($data as $key => $value) 
            {
                $attributes .= $value . ',';
                $values .= ':' . $value . ',';
            }

            $attributes = substr($attributes, 0, strlen($attributes) - 1); // Supprime le dernier ','
            $values = substr($values, 0, strlen($values) - 1); // Supprime le dernier ','
            $queryStr = "INSERT INTO user (" . $attributes . ") VALUES (" . $values . ")";
        }

        $query = $this->pdo->prepare($queryStr);
        
        // Boucle pour appeler les méthodes accesseurs (getUsername())
        foreach ($data as $key => $value) 
        {
            $methode = "get" . ucfirst($value);
            $query->bindValue(':' . $value, $user->$methode());
        }

        $query->execute();
        
    }

    public function findById($id)
    {
        $queryStr = "SELECT * FROM user WHERE id = :id";
        $query = $this->pdo->prepare($queryStr);
        $query->bindParam(':id', $id, \PDO::PARAM_INT);
        $query->execute();

        /*
            if($userData = $query->fetch()) est la même chose que :
            
            $userData = $query->fetch();
            if($userData){};
        */
        if($userData = $query->fetch())
        {
            $user = new User();
            $user->setID($userData['id']);

            foreach ($this->data as $key => $value) 
            {

                $methode = "set" . ucfirst($value);

                if(method_exists($user, $methode))
                {
                    $user->$methode($userData[$value]);
                }
            }

            return $user;
        }

        return new User();
    }
}