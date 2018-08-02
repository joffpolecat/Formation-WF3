<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mon site</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <main class="conteneur">
        <header>
            <img src="assets/img/logo.png" alt="Logo de ma page">
            <h1>Mon slogan <?php echo "- $nom";?></h1>
        </header>
        <nav>
            <ul>
                <li><a href="accueil.php">Accueil</a></li>
                <li><a href="actualites.php">Actualités</a></li>
                <li><a href="identite.php">Qui sommes-nous?</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
    </main>
    
</body>
</html>