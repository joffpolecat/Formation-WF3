<?php

if(!empty($_POST))
{
    if(empty($_POST['nom']) || empty($_POST['matStructure']) || empty($_POST['matToiture']) || empty($_POST['pieces']))
    {
        $result = array(
            "code" => "error",
            "message" => "Les données ne doivent pas être vide"
        );
    }
    else
    {
        /**
         * $pdo = new PDO('mysql:host=localhost;dbname=test', $user, $pass);
         * $query = $pdo->prepare('INSERT INTO maison (...) VALUES (...)');
         * $query->bindValue(':...', $var);
         * $query->execute();
         */
        $str =  "Maison: " . strip_tags($_POST['nom']) . PHP_EOL
            . "Matériaux structure: " . strip_tags($_POST['matStructure']) . PHP_EOL
            . "Matériaux toiture: " . strip_tags($_POST['matToiture']) . PHP_EOL
            . "Pièces: " . strip_tags($_POST['pieces']) . PHP_EOL
            ;
    
        $file = fopen($_POST['nom'] . '.txt', 'w');
        fwrite($file, $str);
        fclose($file);

        $result = array(
            "code" => "success",
            "message" => "Les données ont été envoyées"
        );
    }
    
}
else 
{
    $result = array(
        "code" => "error",
        "message" => "Les données n'ont pas été envoyées"
    );
}

header("Content-Type: application/json");
echo json_encode($result, JSON_PRETTY_PRINT);
// echo JSON