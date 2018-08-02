<?php
session_start();
require_once('src/utils.php');
$pdo = dbConnect();

$template = "login";
$registrationError = "";
$loginError = "";

// INSCRIPTION
if(isset($_POST['register']))
{
    $result = register($pdo, $_POST, $_FILES);

    if(!$result['success'])
    {
        $registrationError = $result['message'];
    }
}
// CONNEXION
elseif(isset($_POST['login']))
{
    $result = login($pdo, $_POST);

    if(!$result['success'])
    {
        $loginError = $result['message'];
    }
}

if($user = getUser())
{
    // Page messenger
    $template = "messenger";
}

require_once('view/header.php');
require_once('view/' . $template . '.php');
require_once('view/footer.php');