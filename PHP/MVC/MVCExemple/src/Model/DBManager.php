<?php 

namespace Model;

abstract class DBManager
{
    protected $pdo;
    protected $tableName;
    protected $className = __CLASS__;

    public function __construct()
    {
        $this->pdo = new \PDO('sqlite:' . __DIR__ . '/../../data/db/database.db');
        $className = explode('\\', self::class);
        $this->tableName = $this->fromCamelCase($className[count($className) - 1]);
    }

    public function save(Entity $entity)
    {
        $data = $entity::DB_DATA;
        
        if ($entity->getId() > 0) 
        { // Update

            $setters = "";

            foreach ($data as $key => $value) 
            {
                $setters .= $value . " = :".$value.",";
            }

            $setters = substr($setters, 0, strlen($setters) - 1); // Supprime le dernier ','
            $queryStr = "UPDATE " . $this->tableName  . " SET " . $setters . " WHERE id=".$entity->getId();
        } 
        else 
        {
            $attributes = "";
            $values = "";

            foreach ($data as $key => $value) 
            {
                $attributes .= $value . ',';
                $values .= ':' . $value . ',';
            }

            $attributes = substr($attributes, 0, strlen($attributes) - 1); // Supprime le dernier ','
            $values = substr($values, 0, strlen($values) - 1); // Supprime le dernier ','
            $queryStr = "INSERT INTO " . $this->tableName  . " (" . $attributes . ") VALUES (" . $values . ")";
        }

        $query = $this->pdo->prepare($queryStr);

        // Boucle pour appeler les méthodes accesseurs (getUsername())
        foreach ($data as $key => $value) 
        {
            $methode = "get" . ucfirst($value);
            $get = $entity->$methode();

            if ($get instanceof \DateTime) 
            {
                $get = $get->format('Y-m-d H:i:s');
            }

            $query->bindValue(':' . $value, $get);
        }

        $query->execute();
    }

    public function findById($id)
    {
        $query = $this->pdo->prepare('SELECT * FROM ' . $this->tableName . ' WHERE id=?');
        $query->execute([$id]);
        return $query->fetchObject($this->className);
    }

    public function findAll()
    {
        $query = $this->pdo->prepare('SELECT * FROM ' . $this->tableName);
        $query->execute();
        $entities = [];

        while ($entity = $query->fetchObject($this->className)) 
        {
            $entities[] = $entity;
        }

        return $entities;
    }

    public function delete(Entity $entity)
    {
        $query = $this->pdo->prepare('DELETE FROM ' . $this->tableName . ' WHERE id=?');
        $query->execute([$entity->getId()]);
    }

    /**
     * Converti une chaine en snake_case
     * @param string $input Chaîne à convertir
     * @return string
     */
    protected function fromCamelCase(string $input) 
    {
        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
        $ret = $matches[0];

        foreach ($ret as &$match) 
        {
          $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
        }

        return implode('_', $ret);
    }
}