<?php

session_start();
require_once('utils.php');

$pdo = dbConnect();
$user = getUser();

$messages = getLastMessages($pdo, $_GET['lastId']);

header("Content-Type: application/json");

echo json_encode(array(
    'messages' => $messages,
    'user' => $user
), JSON_PRETTY_PRINT);