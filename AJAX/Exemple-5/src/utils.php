<?php

function dbConnect()
{
    $attributes = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];

    return new PDO('sqlite:' . __DIR__ . '/../data/data.db', null, null, $attributes);
}

function register($pdo, $post, $files) //$post => $_POST, $files => $_FILES
{
    if( empty($post['username']) || empty($post['email']) || empty($post['password']) )
    {
        return array(
            'success' => false,
            'message' => 'Merci de remplir tous les champs'
        );
    }

    // Test si l'utilisateur existe
    $checkUser = checkUser($pdo, $post);
    if(!$checkUser['success'])
    {
        return $checkUser;
    }

    // Cryptage du mot de passe
    $password = md5($post['password'] . "WF3");

    // Upload de l'avatar
    $avatar = uniqid() . $files['avatar']['name'];
    if( !empty($files['avatar']['name']) )
    {
        copy($files['avatar']['tmp_name'], 'uploads/' . $avatar);
    }

    $query = $pdo->prepare("INSERT INTO user (username, password, email, avatar) VALUES (:username, :password, :email, :avatar)");
    $query -> bindValue(':username', $post['username'], PDO::PARAM_STR);
    $query -> bindValue(':password', $password, PDO::PARAM_STR);
    $query -> bindValue(':email', $post['email'], PDO::PARAM_STR);
    $query -> bindValue(':avatar', $avatar, PDO::PARAM_STR);

    if($query->execute())
    {
        return array(
            'success' => true, 
            'message' => "Bienvenue"
        );
    }

    return array(
        'success' => false, 
        'message' => "Impossible de créer ce compte"
    );
}

function checkUser($pdo, $post)
{
    $query = $pdo -> prepare("SELECT * FROM user WHERE username = :username OR email = :email");
    $query->bindValue('username', $post['username']);
    $query->bindValue('email', $post['email']);
    $query -> execute();

    if($query->fetch())
    {
        return array(
            'success' => false, 
            'message' => "Le nom d'utilisateur ou le mail existe déjà"
        );
    }

    return array(
        'success' => true, 
        'message' => ""
    );
}

function login($pdo, $post)
{
    if( empty($post['username']) || empty($post['username']) )
    {
        return array(
            'success' => false,
            'message' => "Vous devez entrer un nom d'utilisateur et un mot de passe."
        );
    }

    $password = md5($post['password'] . "WF3");
    $query = $pdo->prepare("SELECT * FROM user WHERE username = :username AND password = :password");
    $query -> execute(array(':username' => $post['username'], ':password' => $password));
    
    // var_dump($query->fetch());
    // var_dump($pdo->errorInfo());
    // $user = $query -> fetch();
    // if($user){ ... }
    if($user = $query->fetch())
    {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['username'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_avatar'] = $user['avatar'];

        return array(
            'success' => true, 
            'message' => "",
        );
    }
}  

function getUser()
{
    if(isset($_SESSION['user_id']))
    {
        return array(
            'id' => $_SESSION['user_id'],
            'username' => $_SESSION['user_name'],
            'email' => $_SESSION['user_email'],
            'avatar' => $_SESSION['user_avatar']
        );
    }

    return false;
}

function logout()
{
    if(isset($_SESSION['user_id']))
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_avatar']);
    }
}

function getLastMessages($pdo, $lastId)
{
    // Premier chargement de la page
    if($lastId == 0)
    {
        $count = 5;
        $query = $pdo->prepare("SELECT message.*, user.username, user.avatar FROM message JOIN user ON user.id = message.user ORDER BY id DESC LIMIT :limit");
        $query->bindValue(':limit', $count, PDO::PARAM_INT);
        $query->execute();

        return array_reverse($query->fetchAll());
    }
    else
    {
        $query = $pdo->prepare("SELECT  message.*, user.username, user.avatar FROM message JOIN user ON user.id = message.user WHERE message.id > :lastId ORDER BY id ASC");
        $query->bindParam(':lastId', $lastId, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll();
    }
}

function postMessage($pdo, $user, $message)
{
    $query = $pdo->prepare("INSERT INTO message (content, user, date) VALUES (:content, :userId, :date)");
    $query->bindValue(':content', strip_tags($message), PDO::PARAM_STR);
    $query->bindValue(':userId', $user['id'], PDO::PARAM_INT);
    $query->bindValue(':date', time('now'), PDO::PARAM_STR);

    if($query->execute())
    {
        return array(
            'success' => true, 
            'message' => ""
        );
    }

    return array(
        'success' => false, 
        'message' => "Impossible d'envoyer le message."
    );
}