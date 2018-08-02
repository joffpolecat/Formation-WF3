<?php 
    require_once("inc/header.php"); 
    $page = 'Connexion';

    if($_POST)
    {
        // debug($_POST);

        $req = "SELECT * FROM membre WHERE pseudo = :pseudo";

        $resultat = $pdo->prepare($req);
        $resultat->bindValue(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
        $resultat->execute();

        // Si on trouve un résultat pour le pseudo
        if($resultat->rowCount() > 0)
        {
            $membre = $resultat->fetch();

            // debug($membre);

            /*
                La fonction password_verify() est liée à password_hash() et nous permet de vérifier la correspondance entre un mot de passe et un mot de passe hashé.
                Elle prend 2 paramètres :
                    - Le MDP venant du formulaire
                    - Le MDP en BDD
            */
            if(password_verify($_POST['mdp'], $membre['mdp']))
            {
                // $_SESSION['pseudo'] = $membre['pseudo'];
                // $_SESSION['id_membre'] = $membre['id_membre'];

                foreach ($membre as $key => $value) 
                {
                    if($key != "mdp")
                    {
                        $_SESSION['membre'][$key] = $value;

                        header('location:profil.php');
                        
                    }
                }
                // debug($_SESSION);
            }
            else
            {
                $msg_erreur .= "<div class='alert alert-danger'>Erreur d'itentification. Veuillez réessayer !</div>";
            }
        }
        else
        {
            $msg_erreur .= "<div class='alert alert-danger'>Erreur d'itentification. Veuillez réessayer !</div>";
        }
    }
?>

    <div class="container text-center">
        <h1><?= $page?></h1>

        <p class="lead">Super e-commerce</p>

        <form action="" method="post" class="mt-3 pt-5 border-bottom pb-5">
            <?= $msg_erreur ?>
            <div class="row">
                <div class="form-group col-md-6">
                    <input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="Votre pseudo">
                </div>
                <div class="form-group col-md-6">
                    <input type="password" class="form-control" name="mdp" id="mdp" placeholder="Votre mot de passe">
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <button type="submit" class="btn btn-block btn-success">Se connecter</button>
                </div>
            </div>

        </form>

        <p class="mt-5">Si vous n'avez pas de compte ? Inscrivez-vous !</p>
        <a name="" id="" class="btn btn-success mt-2" href="<?= URL ?>inscription.php" role="button">S'inscrire</a>
    </div>
       
<?php require_once("inc/footer.php"); ?>