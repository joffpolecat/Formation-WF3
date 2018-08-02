<?php

session_start();
require_once('utils.php');

$pdo = dbConnect();

if($user = getUser())
{
    $result = postMessage($pdo, $user, $_POST['message']);
}
else
{
    $result = array(
        'success' => false, 
        'message' => "Vous n'êtes pas connecté"
    );
}

header("Content-Type: application/json");
echo json_encode( $result );