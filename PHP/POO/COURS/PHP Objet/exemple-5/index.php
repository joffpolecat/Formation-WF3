<?php 
session_start();
require_once('Include/header.php');

/*function autoLoad ($className) {
    // "Entity\User.php" => "Entity/User.php" 
    if (file_exists($className . '.php')) {
        require_once($className . '.php');
    }
    //echo "Classe appelée: ".$className."<br/>";
}
spl_autoload_register('autoLoad');
callable
*/

spl_autoload_register(function($className){ // "Form\TextItem"
    // "Entity\User.php" => "Entity/User.php" 
    if (file_exists($className . '.php')) {
        require_once($className . '.php');
    }
    //echo "Classe appelée: ".$className."<br/>";
});

/*
function spl_autoload_register(callable $func)
{
    $func('User');
}
 */
use Entity\User;
use Form\Form;
use Form\TextItem;
use Form\SelectItem;
use Form\TextareaItem;
use DataBase\UserManager;

$userManager = new UserManager();
if ($_POST) {
    $user = $userManager->findById(1);
    foreach ($_POST as $key => $value) {
        if ($value == "password") {
            continue;
        }
        $methode = 'set' . ucfirst($key);
        if (method_exists($user, $methode)) {
            $user->$methode($value);
        }
    }
    $userManager->save($user);
}
$user = $userManager->findById(1);
$myForm = new Form("login", "POST", "", array("class" => "form", "id" => "login-form"));
$myForm->setData($user);
$myForm->addItem(new TextItem("username", "Nom d'utilisateur"));
$myForm->addItem(new TextItem("email", "Adresse email"));
$myForm->addItem(new SelectItem("sexe", "Sexe", array("Homme" => "h", "Femme" => "f", "Autre" => "a")));
$myForm->addItem(new SelectItem("pays", "Pays", array("France" => "FR", "Allemagne" => "DE", "Italie" => "IT")));
$myForm->addItem(new TextareaItem("presentation", "Présentation"));
echo $myForm->createView();

/*echo $myForm->getItem('username')->getValue();
echo "<br/>";
$newForm = clone($myForm);
$newForm->setName("nouveau");
echo $newForm->getName();
echo "<br/>";
echo $myForm->getName();
$newForm->getItem("username")->setValue("Plop");
echo "<br/>";
echo $newForm->getItem("username")->getValue();
echo "<br/>";
echo $myForm->getItem("username")->getValue();
echo "<br/>";*/
/*$formStr =  serialize($myForm);
$newForm = unserialize($formStr);

echo $newForm->getName();
$newForm->setName("Nouveau");
echo "<br/>";
echo $newForm->getName();
echo "<br/>";
echo $myForm->getName();*/
//$_SESSION['form'] = $myForm;
//echo $_SESSION['form'];


require_once('Include/footer.php');