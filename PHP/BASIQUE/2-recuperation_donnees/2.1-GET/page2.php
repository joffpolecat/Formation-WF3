<h1>Page 2</h1>
<hr>

<!-- 
    LIENS 
-->
<a href="page1.php">Page 1</a>
<br>
<a href="page2.php">Page 2 (sans long url)</a>
<br>
<a href='page2.php?produit=jean&couleur=bleu&prix=50'>Page 2 (avec long url)</a>
<br>

<!-- 
    PHP 
-->
<?php

    echo '<pre>';
        var_dump($_GET);
    echo '</pre>';

    /*
    if(!empty($_GET)){
        echo $_GET['produit'] . '<br>';
        echo $_GET['couleur'] . '<br>';
        echo $_GET['prix'] . '<br>';
    }
    (!empty()) est facultatif, l'exemple ci-dessous est préférable
    */

    if($_GET){
        echo $_GET['produit'] . '<br>';
        echo $_GET['couleur'] . '<br>';
        echo $_GET['prix'] . '<br>';
    }

?>