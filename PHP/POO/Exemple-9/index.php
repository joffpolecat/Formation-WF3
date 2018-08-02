<!doctype html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="exemple-9/style.css">
    <title>Exercice 9</title>
  </head>
  <body>
    <div class="container mt-3">

<?php

spl_autoload_register(function($className)
{
    if(file_exists($className . '.php'))
    {
        require_once($className . '.php');
    }
});


use \Maison\Maison;
use \Maison\Piece;

$maison = new Maison("Bois", "Tuiles");
// $maison -> setMateriauxStructure("Briques");

$chambre1 = new Piece("Chambre 1", 16, 2.5);
$cuisine = new Piece("Cuisine", 20, 2.5);

$pieces = [$chambre1, $cuisine];
$maison->setPieces($pieces);

// echo $maison -> getMateriauxStructure();
// echo '<hr/>';
// echo $maison -> getMateriauxToiture();

// var_dump($maison->getInfos());
$infos = $maison->getInfos();



?>
<div class="message">

</div>
<form method="POST" action="enregistrerAjax.php">
<div class="form-group">
  <input type="text" class="form-control" name="nom" placeholder="Nom de la maison">
</div>
<div class="form-group">
  <input type="text" class="form-control" name="matStructure" value"<?= $infos['matStructure'] ?>" placeholder="Matériaux de la structure">
</div>
<div class="form-group">
  <input type="text" class="form-control" name="matToiture" value"<?= $infos['matToiture'] ?>" placeholder="Matériaux de la toiture">
</div>
<div class="form-group">
    <textarea class="form-control" name="pieces" id="pieces" rows="3">

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
</div>
<button type="submit" class="btn btn-primary">Envoyer</button>
</form>

</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="http://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <script>
      $form=$("form");

      function postForm()
      {
        
          //e.preventDefault(); // Pout être sûr qu'il n'y aura pas d'autres méthodes submit appelées
          
          /* 
          $.ajax({ 

              url: '...', 
              method: 'POST', 
              data: $form.serialize()
          })
          .done(function(data){})
          */

          $.post(
              'enregistrerAjax.php', 
              $form.serialize() /* {Form: $Form.val(), ...} */, 
              function(data)
              {
                $('.message').html('<span class="' + data.code + '">' + data.message + '</span>');
              }
              , 'json'
          );

          return false; // évite le rechargement de la page
      }

      $form.submit(postForm);
    </script>
  </body>
</html>