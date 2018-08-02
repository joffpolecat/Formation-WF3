<?php

class Article
{
    private $name = "Nom";

    public function getData()
    {
        return "DATA";
    }

    // Appelée lors de l'instanciation
    public function __construct()
    {
        echo "Objet article créé </br>";
    }

    // Appelée lors de la destruction (fin du script)
    public function __destruct()
    {
        echo "Objet article détruit </br>";
    }

    // Appelée lors d'un appel d'une méthode inaccessible 
    public function __call($name, $attr)
    {
        if(strlen($name) == strlen("getData"))
        {
            trigger_error("La méthode " . $name . " n'existe pas, voulez-vous dire getData ?");
        }
        echo "Méthode " . $name . " appelée </br>";
    }

    // Pour une méthode statique
    public static function __callStatic($name, $attr)
    {
        echo "Méthode statique " . $name . " appelée </br>";
    }

    // Appelée lors de la lecture d'une propriété inaccessible
    public function __get($name)
    {
        echo "Propriété " . $name . " est appelée </br>";

        $method = 'get' . ucfirst($name);

        if(method_exists($this, $method))
        {
            return $this->$method();
        }
    }

    // Appelée lors de la modification d'une propriété inaccessible
    public function __set($name, $value)
    {
        echo "Propriété " . $name . " est modifiée </br>";

        $method = 'set' . ucfirst($name);

        if(method_exists($this, $method))
        {
            return $this->$method($value);
        }
    }

    // Appelée lors de la conversion de l'objet en chaîne 
    public function __toString()
    {
        return $this->name;
    }

    // Lors de l'appel de la méthode isset ou empty sur une propriété
    public function __isset($name){
        echo "L'attribut " . $name . " est testé </br>";
    }

    // Lors d'une linéaeisation
    public function __sleep()
    {
        echo "Linéarisation </br>";
        return ["name"];
    }

    // Lors d'une délinéarisation
    public function __wakeup()
    {
        echo "Délinéarisation </br>";
    }

    //Lors de l'utilisation de l'objet comme méthode
    public function __invoke()
    {
        echo "Utilisation de l'objet comme une méthode </br>";
    }
    
    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}