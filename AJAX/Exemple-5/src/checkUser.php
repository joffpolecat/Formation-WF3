<?php

require_once('utils.php');
$pdo = dbConnect();

/*
    json_encode($array); >> Retourne une chaîne de caractères (string)
    $myJSON = json_decode($string, true); >> Retourne un objet php standard ou un tableau si tout est passé en 2nd paramètre
    $myJSON['value']; >> (tableau)
*/ 

header('Content-Type: application/json');
echo json_encode(checkUser($pdo, $_GET), JSON_PRETTY_PRINT);