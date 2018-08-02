<?php

session_start();

require_once('Include/header.php');

// require_once('Form/Form.php');
// require_once('Form/TextItem.php');
// require_once('Form/SelectItem.php');
// require_once('Entity/User.php');

spl_autoload_register(function($className)
{
    // "Entity\User.php => "Entity\User
    if(file_exists(/*'Entity/' .*/ $className . '.php'))
    {
        require_once(/*'Entity/' .*/ $className . '.php');
    }
    // else if(file_exists('Form/' . $className . '.php'))
    // {
    //     require_once('Form/' . $className . '.php');
    // }

    // echo "Classe appelée :" . $className . "</br>";
});

use Entity\User;
// use Form\{
//     Form,
//     TextItem,
//     SelectItem  
//   };
use Form\Form;
use Form\TextItem;
use Form\SelectItem;
use Form\TextareaItem;
use DataBase\UserManager;

// $user = new User("Piote", "Azerty", "superemail@gmail.com", "IT");
// $user->setPresentation("Si t'efface il y a un placeholder ◉_◉");

$userManager = new UserManager();
// $userManager->save($user);

// if($_POST)
// {
//     $user = new User();

//     foreach ($_POST as $key => $value) 
//     {
//         $methode = 'set' . ucfirst($key); // $key contient le nom du champ

//         if(method_exists($user, $methode))
//         {
//             $user->$methode($value);
//         }
//     }

//     $userManager->save($user);
// }

if ($_POST) 
{
    $user = $userManager->findById(1);

    foreach ($_POST as $key => $value) 
    {
        if ($value == "password") 
        {
            continue;
        }

        $methode = 'set' . ucfirst($key);

        if (method_exists($user, $methode)) 
        {
            $user->$methode($value);
        }
    }

    $userManager->save($user);
}

$user = $userManager->findById(1);

$myForm = new Form ("login", "POST", "", array("class" => "form", "id" => "login-form"));
$myForm->setData($user);
$myForm->addItem(new TextItem("username", "Nom d'utilisateur"));
$myForm->addItem(new TextItem("email", "Adresse email"));
$myForm->addItem(new TextItem("rien", "Rien"));
$myForm->addItem(new SelectItem("sexe", "Sexe", array("Homme" => "h", "Femme" => "f", "Autre" => "a")));
$myForm->addItem(new SelectItem("pays", "Pays", array("Pologne" => "PL", "France" => "FR", "Allemagne" => "DE", "Italie" => "IT")));
$myForm->addItem(new TextareaItem("presentation", "Présentation"));
echo $myForm->createView();

// echo $myForm->getItem('username')->getValue();
// echo '</br>';
// $newForm = clone($myForm);
// $newForm->setName("nouveau");
// echo $newForm->getName();
// echo '</br>';
// echo $myForm->getName();
// $newForm->getItem("username")->setValue("Plop");
// echo '</br>';
// echo $newForm->getItem("username")->getValue();
// echo '</br>';
// echo $myForm->getItem("username")->getValue();

// $formStr = serialize($myForm);
// $newForm = unserialize($formStr);

// echo $newForm -> getName();
// $newForm -> setName("Nouveau");
// echo '<hr>';
// echo $newForm -> getName();
// echo '<hr>';
// echo $myForm -> getName();
// echo '<hr>';
// $_SESSION['form'] = $myForm;


require_once('Include/footer.php');