<?php 

namespace Model;

class ArticleManager extends DBManager
{
    public function __construct()
    {
        parent::__construct();
        $this->tableName = "article";
        $this->className = Article::class;
    }
}