<?php
    
    if($_POST){
        
        echo 'Ville : ' . $_POST['ville'] . '<br>';
        echo 'Code postal : ' . $_POST['CP'] . '<br>';
        echo 'Adresse : ' . $_POST['adresse'] . '<br><hr>';

    }

    // POUR VÉRIFIER SI ON RÉCUPÈRE BIEN LES INFORMATIONS
        // var_dump($_POST);

?>

<form action="" method="post">

    <!-- VILLE -->
    <div><label for="ville">Ville</label></div>
    <div><input type="text" name="ville" id="ville" placeholder="Entrez le nom de votre ville"></div>

    <!-- CODE POSTAL -->
    <div><label for="CP">Code Postal</label></div>
    <div><input type="text" name="CP" id="CP" placeholder="Saisissez votre code postal"></div>
    
    <!-- ADRESSE -->
    <div><label for="adresse">Adresse</label></div>
    <div><textarea name="adresse" id="adresse" cols="30" rows="10" placeholder="Entrez votre adresse"></textarea></div>
    
    <!-- SUBMIT -->
    <div><input type="submit" value="Valider"></div>
</form>