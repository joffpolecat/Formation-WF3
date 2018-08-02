<?php

namespace Factory;

class Factory
{
    public static function create($name)
    {
        // Il y a deux \\ car il se peut qu'il interprete l'unique \ comme un caractère spécial et que donc cela ne fonctionne pas (c'est pas clair je sais)
        $className = "Form\\" . ucfirst($name) . "Item";

        if(class_exists($className))
        {
            return new $className;
        }

        echo "Création d'un objet " . $className . "</br>.";
        
        return null;
    }
}