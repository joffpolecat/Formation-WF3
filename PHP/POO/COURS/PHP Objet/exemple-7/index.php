<?php 

require_once('Article.php');

$article = new Article;
$article->getDate();
Article::getCounter();
echo $article->name;
echo "<br/>";
$article->name = "Nom";
echo $article;
isset($article->name);
$str = serialize($article);
unserialize($str);
$article();