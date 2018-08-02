<?php

    // Ouverture de session
    session_start();

    $dsn = 'mysql:host=localhost; dbname=tchat';
    $login = 'root';
    $pwd = '';
    $attributes = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];

    $pdo = new PDO($dsn, $login, $pwd, $attributes);



    // echo '<pre>';
    // print_r($_POST);
    // print_r($_FILES);
    // echo '</pre>';

    $msg_inscription = '';
    $msg_connexion = '';



    if ($_POST) {

        
        
        // Nous vérifions que nous entrons dans le cas de l'inscription
        if(isset($_POST['inscription'])){

            //Traitement de l'inscription
            if(empty($_POST['pseudo']) || empty($_POST['password']) || empty($_POST['email']) ){
                
                $msg_inscription .= '<div class="alert alert-danger" role="alert">Merci de <strong>remplir</strong> tous les champs. ಠ_ಠ</div>';
            
            }

            $avatar_traite = md5(uniqid($_FILES['avatar']['name']));
                
            if(!empty($_FILES['avatar']['name'])){

                copy($_FILES['avatar']['tmp_name'], 'assets/uploads/img/'.$avatar_traite);
                
                /*
                    La fonction copy() prend 2 arguments :
                        - la provenance de la copie
                        - dossier dans lequel je vais coller l'image

                    La fonction md5() est une méthode de sécurité qui va mixer une STR originale pour me la transformer.
                    
                    La fonction uniqid() me renvoit un ID unique pour chaque fichier
                */
            }

            if(empty($msg_inscription)){

                $resultat = $pdo -> prepare("INSERT INTO membre (pseudo, password, email, avatar) VALUES (:pseudo, :password, :email, :avatar)");

                // Méthode de salage via MD5
                $salage = md5("Il était une fois dans une galaxie lointaine, très lointaine...");
                $secured_password = md5($_POST['password'] . $salage);

                $resultat -> bindValue(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
                $resultat -> bindValue(':password', $secured_password, PDO::PARAM_STR);
                $resultat -> bindValue(':avatar', $avatar_traite, PDO::PARAM_STR);
                $resultat -> bindValue(':email', $_POST['email'], PDO::PARAM_STR);

                if($resultat->execute()){

                    $msg_inscription = '<div class="alert alert-success" role="alert">(ﾉ◕ヮ◕)ﾉ*:･ﾟ✧ Félicitations, vous êtes <strong>inscrit</strong> !</div>';
                }
            }
            
        }

        

        // Traitement de la connexion
        if(isset($_POST['connexion'])){

            // Méthode de salage via MD5
            $salage = md5("Il était une fois dans une galaxie lointaine, très lointaine...");
            $test_password = md5($_POST['password'] . $salage);

            $resultat = $pdo -> prepare("SELECT * FROM membre WHERE pseudo = :pseudo AND password = :password");

            $resultat -> bindValue(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
            $resultat -> bindValue(':password', $test_password, PDO::PARAM_STR);

            $resultat->execute();

            if($resultat->rowCount() > 0){
                
                // OK, il y a une ligne correspondante dans la BDD => bon pseudo + bon mdp
                $membre = $resultat->fetch();

                $_SESSION['pseudo'] = $membre['pseudo'];
                $_SESSION['id_membre'] = $membre['id_membre'];
                $_SESSION['email'] = $membre['email'];
                $_SESSION['avatar'] = $membre['avatar'];

                // ici nous venons d'enregistrer les résultats tirés de notre BDD dans notre session : nous allons donc pouvoir passer les informations dans la page que nous avons choisie

                header("location:message.php");
                // La fonction header() nous permet de rediriger l'internaute sur une autre page suite au traitement de ses données (lignes $_SESSION)

            } else {
                $msg_connexion .= '<div class="alert alert-danger" role="alert">Erreur d\'identification. ಠ_ಠ</div>';
            }
        }


        
    }
?>




<!doctype html>
<html lang="fr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB"
        crossorigin="anonymous">

    <!-- CSS personnalisé -->
    <link rel="stylesheet" href="assets/CSS/style.css">

    <title>Venez tchatter avec nous !</title>
</head>

<body>
    <div class="container">


        <h1 class="m-5 text-center">Bienvenue sur le tchat le plus cool du monde !</h1>

        <div class="row">
            <div class="inscription col-md-6 mb-4 p-1">
                <h2>Inscription</h2>
                <p>Créez votre compte :</p>
                <?= $msg_inscription ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="text" class="form-control" name="pseudo" id="" aria-describedby="helpId" placeholder="Votre pseudo">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" id="" aria-describedby="helpId" placeholder="Votre mot de passe">
                    </div>
                    <div class="form-group row">
                        <label class="col-5" for="avatar">Téléchargez votre avatar</label>
                        <input class="col-7" type="file" class="form-control-file" name="avatar" id="avatar" placeholder="Téléchargez votre photo de profil">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" id="" aria-describedby="helpId" placeholder="Votre email">
                    </div>
                    <button type="submit" class="btn btn-dark mt-4 btn-block" name="inscription" value="inscription">Inscription</button>
                </form>
            </div>


            <div class="connexion col-md-6">
                <h2>Connexion</h2>
                <p>Connectez-vous si vous possédez déjà un compte :</p>
                <?= $msg_connexion ?>
                <form action="" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" name="pseudo" id="" aria-describedby="helpId" placeholder="Votre pseudo">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" id="" aria-describedby="helpId" placeholder="Votre mot de passe">
                    </div>
                    <button type="submit" class="btn btn-dark mt-4 btn-block" name="connexion" value="connexion">Connexion</button>
                </form>

            </div>
        </div>


    </div>
</body>

</html>