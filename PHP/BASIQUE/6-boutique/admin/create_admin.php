<?php 
    require_once("inc/header.php");

    if($_POST)
    {
        // Vérification pseudo
        if(!empty($_POST['pseudo']))
        {

            $verif_pseudo = preg_match('#^[a-zA-Z0-9-._]{3,20}$#', $_POST['pseudo']);
             
            if(!$verif_pseudo)
            {
                $msg_erreur .= "<div class='alert alert-danger'>Votre pseudo doit comporter de 3 à 20 caractères (majuscules, minuscules, chiffres et signes '.', '_', '-' acceptés) </div>";
            }
            
        }
        else
        {
            $msg_erreur .= "<div class='alert alert-danger'>Veuillez entrer un pseudo valide</div>";
        }
        // Fin vérification pseudo





        // Vérification mot de passe
        if (!empty($_POST['mdp'])) 
        {
            $verif_mdp = preg_match('#^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[-+!*\'\?$@%_])([-+!*\?$\'@%_\w]{6,15})$#', $_POST['mdp']); 
    
            if(!$verif_mdp)
            {
                $msg_erreur .= "<div class='alert alert-danger'>Votre mot de passe doit comporter de 6 à 15 caractères dont une majuscules, une minuscules, un chiffres et un caractère spécial minimum.</div>";
            }
    
        }
        else
        {
            $msg_erreur .= "<div class='alert alert-danger'>Veuillez entrer un mot de passe valide</div>";
        }
        // Fin vérification mot de passe





        // Vérification email
        if (!empty($_POST['email'])) 
        {
            $verif_email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL); 

            $dom_interdit=[
                'mailinator.com',
                'yopmail.com',
                'mail.com'
            ];

            $dom_email = explode('@', $_POST['email']);
            
            if(!$verif_email || in_array($dom_email[1], $dom_interdit))
            {
                $msg_erreur .= "<div class='alert alert-danger'>Veuillez renseigner un email valide</div>";
            }
    
        }
        else 
        {
            $msg_erreur .= "<div class='alert alert-danger'>Veuillez renseigner un email valide</div>";
        }
        // Fin vérification email




        if(!isset($_POST['civilite']) || ($_POST['civilite'] !== "m" && $_POST['civilite'] !== "f" && $_POST['civilite'] !== "o"))
        {
            $msg_erreur .= "<div class='alert alert-danger'>Veuillez rentrer une civilité valide</div>";
        }




        // AUTRES VÉRIFS POSSIBLES
        if(empty($msg_erreur))
        {
            // Vérification si pseudo libre
            $resultat = $pdo->prepare("SELECT * FROM membre WHERE pseudo = :pseudo");
            $resultat->bindValue(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
            $resultat->execute();

            // Si on a une ligne de résultat dans la BDD
            if($resultat->rowcount() > 0)
            {
                $msg_erreur .= "<div class='alert alert-danger'>Le pseudo " . $_POST['pseudo'] . " n'est malheureusement pas disponible. Veuillez en choisir un autre.</div>";
            }

            // Pas de ligne en retour, je peux inscrire l'utilisateur
            else
            {
                $resultat = $pdo->prepare("INSERT INTO membre (pseudo, mdp, nom, prenom, email, civilite, ville, code_postal, adresse, statut) VALUES (:pseudo, :mdp, :nom, :prenom, :email, :civilite, :ville, :code_postal, :adresse, 1)");

                $mdp_crypte = password_hash($_POST['mdp'], PASSWORD_BCRYPT);
                /*
                    La fonction password_hash() nous permet de sécuriser l'enregistrement du mdp en BDD.
                    Elle prend 2 arguments : 
                        - L'élement à hasher
                        - La méthodologie d'hashage
                */

                $resultat->bindValue(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
                $resultat->bindValue(':mdp', $mdp_crypte, PDO::PARAM_STR);
                $resultat->bindValue(':nom', $_POST['nom'], PDO::PARAM_STR);
                $resultat->bindValue(':prenom', $_POST['prenom'], PDO::PARAM_STR);
                $resultat->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
                $resultat->bindValue(':civilite', $_POST['civilite'], PDO::PARAM_STR);
                $resultat->bindValue(':ville', $_POST['ville'], PDO::PARAM_STR);
                $resultat->bindValue(':code_postal', $_POST['code_postal'], PDO::PARAM_INT);
                $resultat->bindValue(':adresse', $_POST['adresse'], PDO::PARAM_STR);

                if($resultat->execute())
                {
                    header('location:' . URL . 'admin/gestion_membres.php');
                }

            }
        }


    }


    // Traitement pour ré-afficher les valeurs rentrées en cas de rechargement de la page erreur d'inscription
    $pseudo = (isset($_POST['pseudo'])) ? $_POST['pseudo'] : '';
    $nom = (isset($_POST['nom'])) ? $_POST['nom'] : '';
    $prenom = (isset($_POST['prenom'])) ? $_POST['prenom'] : '';
    $email = (isset($_POST['email'])) ? $_POST['email'] : '';
    $ville = (isset($_POST['ville'])) ? $_POST['ville'] : '';
    $code_postal = (isset($_POST['code_postal'])) ? $_POST['code_postal'] : '';
    $adresse = (isset($_POST['adresse'])) ? $_POST['adresse'] : '';
    /*
        Ici nous mettons une condition :
            Si on reçoit un POST, alors ma variable contiendra la valeur envoyée, sinon la valeur sera vide
    */
?>

    
        <h1>Ajouter un nouvel administrateur</h1>

        
        
        <form action="" method="post">
            <?= $msg_erreur ?>
            <div class="row">
                <div class="form-group col-md-6">
                    <input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="Pseudo" value="<?= $pseudo ?>">
                </div>
                <div class="form-group col-md-6">
                    <input type="password" class="form-control" name="mdp" id="mdp" placeholder="Mot de passe">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-3">
                    <input type="text" class="form-control" name="nom" id="nom" placeholder="Nom" value="<?= $nom ?>">
                </div>
                <div class="form-group col-md-3">
                    <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Prénom" value="<?= $prenom ?>">
                </div>
                <div class="form-group col-md-3">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?= $email ?>">
                </div>
                <div class="form-group col-md-3">
                        <select name="civilite" class="form-control">
                            <option selected disabled>-- Choisissez la civilité --</option>
                            <option value="m">M.</option>
                            <option value="f">Mme</option>
                            <option value="o">Autre</option>
                        </select>
                </div>
            </div>
            <div class="row">
                
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" name="ville" id="ville" placeholder="Ville" value="<?= $ville ?>">
                </div>
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" name="code_postal" id="code_postal" placeholder="Code postal" value="<?=$code_postal?>">
                </div>
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" name="adresse" id="adresse" placeholder="Adresse" value="<?= $adresse ?>">
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <button type="submit" class="btn btn-block btn-success">Créer</button>
                </div>
            </div>

        </form>

<?php require_once("inc/footer.php"); ?>