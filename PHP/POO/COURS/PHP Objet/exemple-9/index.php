<html>
<body>
<?php
/*
    Création d'un application de gestion d'énérgie d'une maison

    1 - Modèlisation de la maison

        Une Maison contient des PIECES 
        Créer une classe Maison avec les attributs privés suivants:
            - materiauStructure | type string "Briques" ou "Agglos"
            - materiauToit | type string "Tuiles" ou "Ardoises"
            - pieces | type array

        La classe Maison contient 1 ou plusieur objets Piece
        Créer une classe Piece avec les attributs privés suivants:
            - nom | string longueur > 3
            - surface | > 0
            - hauteur | > 0
            - nbFenetres | >= 0
        
        Créer les setter et getter pour valider les données
        
        Créer un objet Maison qui va contenir plusieurs objets Piece (dans index.php)

        Créer un autoload

        Info: une classe par fichier avec le même nom !

        2 - Affiner nos classes
        Créer des constructeurs avec les attributs obligatoires:
            Maison : materiauxStructure, materiauToit
            Piece : nom, surface, hauteur
            
        Dans Maison, les materiaux doivent être prédéfinies dans un array de type constante pour valider les données (avec in_array) 

        3 - Ecrire une méthode getInfos dans la classe Maison qui va retourner un array avec        toutes les informations (y compris les pièces)
            Ecrire un commentaire doc qui décrit la méthode (@return ...)
        
 */
spl_autoload_register(function($class) {
    if (file_exists($class.'.php')) {
        require_once($class.'.php');
    }
});

$maison = new Maison("Briques", "Tuiles");
//$maison->setMateriauStructure("Briques");
$chambre1 = new Piece("Chambre 1", 16, 2.5);
$cuisine = new Piece("Cuisine", 20, 2.5);

$pieces = [$chambre1, $cuisine];
$maison->setPieces($pieces);

$infos = $maison->getInfos();

?>
<input type="text" name="nom" placeholder="Nom de la maison" /><br/>
<input type="text" name="matStruct" value="<?= $infos["matStructure"] ?>" /><br/>
<input type="text" name="matToit" value="<?= $infos["matToit"] ?>" /><br/>
<textarea name="pieces" cols="80" rows="20">
<?php 
    foreach ($infos['pieces'] as $key => $value) {
        echo "PIECES $key 
        ";
        echo "Nom: " . $value['nom'] ."
        ";
        echo "Surface: " . $value['surface'] . "
        ";
        echo "Hauteur: " . $value['hauteur'] . "
        ";
        echo "Nombre de fenêtre: " . $value['nbFenetres'] . "
            ";
    }
?>
</textarea>
<script
  src="http://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>
  <script>

  </script>
</body>
</html>