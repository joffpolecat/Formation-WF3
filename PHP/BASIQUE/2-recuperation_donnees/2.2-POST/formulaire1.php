<?php

    /*
    #OBJECTIF : 
    Récupérer l'envoi d'informations de façon "discrète" pour un formulaire d'inscription.
    Envoyer, enregistrer dans une BDD, dans un fichier...
    */

    if ($_POST){
            echo 'pseudo :' . $_POST['pseudo'] . '<br>';
            // L'indice pseudo est récupéré via l'attribut NAME

            echo 'description :' . $_POST['description'] . '<br><hr>';
    }

?>

<form action="" method="post">
<!--
    METHOD demande l'argument POST ou GET
    L'action sert de redirection après le submit. (Si vide, reste sur la page)
 -->

    <div>
        <label for="pseudo">Pseudo</label>
    </div>
    <div>
        <input type="text" name="pseudo" id="pseudo" placeholder="Inscrivez votre pseudo ici...">
        <!--
            L'attribut ID est en lien avec l'attribut FOR du label.
            L'attribut name nous permet de nommer l'indice du tableau récupéré par la suite.
        -->
    </div>
    <div>
        <label for="description">Description</label>
    </div>
    <div>
        <textarea name="description" id="desciption" cols="30" rows="10" placeholder="Décrivez-vous en quelques mots..."></textarea>
    </div>
    <input type="submit" value="Envoyer">
</form>