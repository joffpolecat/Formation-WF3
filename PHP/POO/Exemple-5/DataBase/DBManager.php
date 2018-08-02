<?php

namespace DataBase;

class DBManager
{
    protected $pdo;

    public function __construct()
    {
        $attributes = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
        ];
        $this->pdo = new \PDO('sqlite:' . __DIR__ . '/data.db', null, null, $attributes);
    }
}