# Architecture MVC

## Description : 
- Présentation du concept Modèle View Controller. 
- Architecturer un projet informatique 
- Développement avec séparation des couches 
- Etudier le principe de route 
- Comprendre comment différents éléments peuvent être intégré à un projet informatique sans en changer l’architecture.

## Les contrôleurs
### Principe

Le **Contrôleur** fait le lien entre la Vue et le Modèle d'une application.

Le modèle est la partie du code qui connaît les informations La vue est la partie du code qui montre les informations que le modèle connaît Le contrôleur est la partie du code qui **reçoit les commandes de l'utilisateur** et **dit à la vue ce qu'elle doit afficher** et **ce que le modèle doit connaître**.

Exemple d'une télévision : On peut comparer les chaînes, qui sont diffusées par un fournisseur de cable, au **Modèle**. L'écran de TV représente la **Vue**. La télécommande permet de changer les chaînes et d'interagir avec le programme, c'est le **Contrôleur**.

Le **Contrôleur** reçoit les actions de l'utilisateur, c'est à dire l'accès à certaines URL, et décide quelle vue doit être utilisée, quels modèles solliciter, et articule ces deux autres parties avant d'envoyer la réponse HTTP au client, composée du contenu de la vue.

Le diagramme suivant présente un échange standard entre le client et le serveur.

- `Requête HTTP` : La partie la plus à gauche, le client, commence par envoyer une requête au site web. Imaginons que nous accédions à la page index.php?action=getorders, qui affiche une liste de commandes. C'est le Contrôleur qui reçoit cette requête.

- `Demande de données` : Le `Contrôleur` demande des informations au `Modèle`, c'est-à-dire la liste des commandes. Le `Modèle` accède à la base de données, et récupère cette liste.

- `Retour de données` : Le `Modèle` renvoie la liste de commandes au `Contrôleur`.

- `Envoi de données provenant du modèle` : Le `Contrôleur` envoie à la vue la liste de commandes

- `Retour formaté` : La `Vue` renvoie du HTML, provenant certainement d'un moteur de templates.

- `Réponse HTTP` : Le `Contrôleur` peut maintenant répondre au client et lui envoyer le HTML généré.
```
+--------------+          +--------------+         +--------------+         +--------------+
|    Client    |          | Contrôleur   |         |     Modèle   |         |      Vue     |
+-----+--+-----+          +------++------+         +------++------+         +------++------+
     |  |                       ||                       ||                       ||
     |  |                       ||                       ||                       ||
     |  |                       ||                       ||                       ||
     |  |    Requête HTTP   `.  ||                       ||                       ||
     |  |---------------------;++++                      ||                       ||
     |  |                   ,' |  |                      ||                       ||
     |  |                      |  |Demande de données`.  ||                       ||
     |  |                      |  |--------------------;++++                      ||
     |  |                      |  |                  ,' |  |                      ||
     |  |                      |  |                     |  |                      ||
     |  |                      |  |                     |  |                      ||
     |  |                      |  | .' Retour de données|  |                      ||
     |  |                      |  |:--------------------++++                      ||
     |  |                      |  | `.                   ||                       ||
     |  |                      |  |                      ||                       ||
     |  |                      |  |                      ||                       ||
     |  |                      |  |                      ||                       ||
     |  |                      |  |                      ||                       ||
     |  |                      |  |                      ||                       ||
     |  |                      |  |   Envoi des donnnées provenant du modèle  `.  ||
     |  |                      |  +---------------------------------------------;++++
     |  |                      |  |                      ||                   ,' |  |
     |  |                      |  |                      ||                      |  |
     |  |                      |  |                      ||                      |  |
     |  |                      |  | .'       Retour formaté  (HTML)              |  |
     |  |                      |  |:---------------------------------------------++++
     |  |                      |  | `.                   ||                       ||
     |  | .'  Réponse HTTP     |  |                      ||                       ||
     |  |:---------------------++++                      ||                       ||
     |  | `.                    ||                       ||                       ||
     |  |                       ||                       ||                       ||
     |  |                       ||                       ||                       ||
     |  |                       ||                       ||                       ||
     |  |                       ||                       ||                       ||
     +--+                       ||                       ||                       ||
```
Voici une représentation de ce qui peut se passer dans la classe `OrderController` :

```php
public function getOrders()
{
    $model  = new OrdersModel();    // Création du modèle
    $orders = $model->getOrders();  // Récupération en DB
    $view   = new OrdersListView(); // Création de la vue
    $view->setOrders($orders);      // Envoi des commandes à la vue
    $html   = $view->getHTML();     // Récupération du HTML
    echo $html;
}
```

## Les modèles
### Principe


Dans l'architecture MVC, la couche **Modèle** regroupe :

- Des `Data Mappers` : la logique d'accès à la source des données (généralement une base de données, dans une application web)
- Des `Domain Objects` : Un conteneur d'information du domaine (du problème). Généralement, une entité logique du domaine. C'est ici qu'on peut stocker la logique de validation. Les objets de domaine n'ont aucun lien avec le mécanisme d'enregistrement ou la persistance des données.

Par exemple, si on souhaite modéliser un taxi, on pourra créer :

- Une classe `TaxiModel`
- Une classe `TaxiTable`

La classe `TaxiModel` permettra d'instancier des objets de type taxi, qui auront leurs propres propriétés (immatriculation, numéro de licence, puissance fiscale..) et leurs propres méthodes (démarrer moteur, démarrer compteur, recevoir paiement..). C'est ce qu'on appelle un **objet de domaine**.

La classe `TaxiTable` permettra de communiquer avec la table `Taxis` de la base de données. On pourrait par exemple la programmer de manière à accepter des instances de TaxiModel afin de les sauvegarder en base de données, et de renvoyer des instances de cette même classe.

Le **Modèle** est la partie du code qui **connaît** les informations. La **Vue** est la partie du code qui **montre** les informations que le modèle connaît.

On peut faire un parallèle entre la vue et le modèle, d'un côté, et un code HTML et une feuille CSS, de l'autre. Le HTML **contient les données**, le CSS les affiche. Bien sûr, à la différence du HTML, le modèle ne peut pas être consulté simplement en ouvrant le fichier. Le navigateur, qui articule ces deux concepts différents, peut être comparé au **Contrôleur**.

### Data Mapper et Active Record
Afin de communiquer avec la base de données, il existe deux patterns de conception populaires :

- Data Mapper : La logique d'accès en base de données est implémentée dans des objets séparés des objets de domaine.

```
+--------------------------+             +-----------------------------+                             _________
|  TaxiModel               |             |  TaxiMapper                 |                     _,,--'''         `'`--._
+--------------------------+             +-----------------------------+                    +                        `.
|  plate                   |             |  dbConnexion                |                    |.                      _,|
|  licence                 +--  ----  ---+-----------------------------+---  ----  ----  ---| ``--..._______,,..,--'  |
|  power                   |             |  insert(taxi)               |                    |                         |
+--------------------------+             |  delete(taxi)               |                    `.       Database       _,
|  counterStart()          |             |  update(taxi)               |                      ``--..._______,,..,--'
|  engineStart()           |             |  getById(id)                |
+--------------------------+             +-----------------------------+
```
Exemple de création d'un taxi et de sauvegarde en base de données :

```php
$taxi = new TaxiModel();
$taxi->engineStart();
$taxiMapper = new TaxiMapper();
$taxiMapper->insert($taxi);
```

- Active Record : La logique d'accès en base est placée dans l'objet de domaine, généralement l'objet de domaine hérite de ces fonctionnalités d'accès.

```
+--------------------------+             +-----------------------------+                             _________
|  TaxiModel               |             |  Recorder                   |                     _,,--'''         `'`--._
+--------------------------+        |.   +-----------------------------+                    +                        `.
|  plate                   |        | `. |  dbConnexion                |                    |.                      _,|
|  licence                 +--------+   ::-----------------------------+---  ----  ----  ---| ``--..._______,,..,--'  |
|  power                   |        | .' |  insert()                   |                    |                         |
+--------------------------+        |'   |  delete()                   |                    `.       Database       _,
|  counterStart()          |             |  update()                   |                      ``--..._______,,..,--'
|  engineStart()           |             +-----------------------------+
|  getById(id)             |
+--------------------------+
```
Même exemple que pour le data mapper, création d'un taxi et sauvegarde en base de données :

```php
$taxi = new TaxiModel();
$taxi->engineStart();
$taxi->insert();
```

Remarquez que les méthodes n'ont pas la même signature que pour le pattern data mapper.

En général, dans un modèle MVC, on suit cette règle : Pour chaque table en base de données, il y a un data mapper, et pour chaque data mapper, un domain object.


## Les vues
### Principe

Dans une architecture MVC, le code d'une application est divisé en trois "couches" : La couche **Modèle**, la couche **Vue** et la couche **Contrôleur**.

C'est particulièrement la mise en pratique de cette architecture qui vous permettra de comprendre le rôle de chacune des couches.

Commençons par la division la plus simple, et la plus naturelle : la **Vue**.

Nous avons compris que pour une meilleure lisibilité du code, il est mieux de séparer la partie "logique" de la partie "affichage". Ainsi, nous codons maintenant nos pages PHP sur ce modèle :

```php
<?php
    $var = 'Blob';

    /* Code PHP... */
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
</head>
<body>
    Bonjour <?php echo $var ?>    
</body>
</html>
```

La partie logique est située en haut de la page, la partie affichage à la suite. Cette séparation permet une meilleure lisibilité, et une meilleure maintenabilité du programme.

Le principe de **Vue** structure cette bonne pratique, en plaçant le code d'affichage dans des fichiers à part.

Nous pouvons donc donner cette définition : l'ensemble des fichiers permettant l'affichage du site web constitue la couche **Vue** de l'architecture.

La **Vue** n'effectue pas de traitement, son seul rôle est d'**afficher** les pages du site, généralement en s'appuyant sur des variables qui lui sont passées.

La page web ci-dessus, avec la partie **Vue** séparée :

`page.php`

```php
<?php
    $var = 'Blob';

    /* Code PHP... */

    require 'view/page.php'; // Inclusion de la vue
```

`view/page.php`

```php
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
</head>
<body>
    Bonjour <?php echo $var ?>    
</body>
</html>
```
La partie **Vue** regroupe l'ensemble des pages qui génèrent le HTML du site, mais aussi les fichiers JS, CSS, etc. qui sont passés au client. C'est la partie du site web qui 'interagit' avec l'utilisateur.

### Templates
Un moteur de template permet de séparer la logique d'affichage des fonctionnalités du site, ce qui correspond à la définition de la **Vue**. On se sert donc généralement de ce genre de moteur lorsqu'on développe une application sur le modèle MVC.

Un moteur de template utilise des `templates`, ou gabarits, pour afficher les pages. Les `templates` peuvent être vus comme des 'textes à trous', qui seront remplis en fonction des variables qui leur sont envoyées.

Principe de fonctionnement d'un moteur de template :

```
     +----------------------+
     | Fichiers de template |                  +---------+
     +----------+-----------+                  | Données |
                |                              +---.-----+
                |                                  |
             `. | .'                               '
     +---------`.'------------+                 ,-'
     |                        | ,'         _,.-'
     |  Moteur de templates   ._---------''
     |                        | `.
     +----------+-------------+
                |
                |
                |
                |
             `. | .'
       +-------`.'-----+
       |  Pages HTML   |
       +---------------+
```

Des scripts PHP ainsi que des données, sous forme de variables, sont envoyées au moteur de template, qui se charge d'assembler les deux afin de produire du contenu HTML.

Les fichiers de template peuvent contenir des structures conditionnelles, mais ils se cantonnent à la **présentation** du contenu. On utilise pas de logique complexe dans ces fichiers, comme des déclarations de fonction, etc.

L'avantage étant de pouvoir modifier l'apparence du site sans risquer de produire des bugs par inadvertance. Il est également plus facile de repérer à quel endroit se trouve le code qui génèrera le HTML, s'il est réparti dans une série de fichiers situés dans le même dossier, plutôt que disséminé dans différentes sources. Différentes personnes (intégrateur, développeur..) peuvent également travailler sur les mêmes fonctionnalités sans se gêner l'un l'autre en modifiant un unique fichier.

Les templates sont également réutilisables et cumulables, on poura par exemple utiliser le même template d'entête pour toutes les pages du site, des templates spécifiques pour le corps de la page, et un autre template commun pour le pied de page.

Étant donné qu'ils servent uniquement à la présentation des pages, les pages passées au moteur de template font partie de la partie **Vue** d'une application MVC.


## Contrôleur frontal
### Principe

La stratégie du contrôleur frontal (`Front Controller`) consiste à n'avoir qu'un seul point d'entrée pour toute l'application.

Le contrôleur frontal sera sollicité à chaque requête du client, et appelera lui-même le bon contrôleur. C'est lui qui est responsable de traiter toutes les requêtes faites à l'application, en fonction des URL qui lui parviennent.

Sans contrôleur frontal :
```
+--------+                       `. +----------------+
| Client +-------------------------:: TaxiController |
+--------+----------.            .' +----------------+
                    \
                    ;
                    `.          `. +--------------------+
                      `-.---------:: TaxiRideController |
                                .' +--------------------+
```

Avec un contrôleur frontal :

```
+--------+       `. +--------------------+       `. +----------------+
| Client +---------:: Contrôleur frontal +---------:: TaxiController |
+--------+       .' +--------.-----------+       .' +----------------+
                            |
                             `.
                               `._              `. +--------------------+
                                  `''`----........:: TaxiRideController |
                                                .' +--------------------+
```

### Exemple

Exemple de contrôleur frontal minimaliste : `index.php`

```php
if($_SERVER['REQUEST_URI'] == '/taxi') {
    $controller = new TaxiController();
} elseif($_SERVER['REQUEST_URI'] == '/taxiride') {
    $controller = new TaxiRideController();
}

$controller->display();

/*
    On imagine que la méthode display() est implémentée dans chacun des contrôleurs et qu'elle affiche le contenu d'une vue déterminée par le contrôleur
*/
```
Ce mécanisme permet :

- De masquer la structure interne du site (le nom des fichiers en PHP n'apparaît plus).
- D'appliquer à tous les contrôleurs les mêmes politiques d'autentification, de sécurité, etc.

Il est possible de mettre en place une hiérarchie de contrôleurs, par exemple :

- `FrontController`
    - `BlogController`
        - `PostController`
        - `CategoryController`
        - `CommentController`
    - `SettingsController`
        - `UserController`

## La réécriture d'URL
### Principe

Le principe de la réécriture d'URLs dans le cadre d'une application MVC consiste à rediriger toutes les requêtes vers le contrôleur frontal, qui lui se chargera d'analyser les URLs envoyées par le client afin de solliciter les bons contrôleurs.

Cette réécriture doit être opérée par le serveur lui-même, elle consiste en un ensemble de directives qui doivent être écrites dans un fichier portant le nom `.htaccess`.

Le fichier `.htaccess` sera placé à la racine du projet, généralement ou est situé le point d'entrée du site. Exemple d'arborescence :

```
-rw-r--r-- 1 John Doe 197610 123 janv.  7 22:20 .htaccess
drwxr-xr-x 1 John Doe 197610   0 janv.  8 00:05 assets/
-rw-r--r-- 1 John Doe 197610 334 janv.  7 22:19 index.php
-rw-r--r-- 1 John Doe 197610 339 janv.  7 21:35 README.md
```

Ici, le point d'entrée du site est `index.php`.


Exemple de contenu du fichier `.htaccess` si on souhaite rediriger toutes les requêtes faites au serveur vers la page `index.php` :

```php
RewriteEngine on
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . index.php [L,QSA]
```

Lorsque le serveur Apache accèdera au dossier public du projet, il lira interprètera forcément le contenu de ce fichier. La première ligne indique au serveur qu'il doit activer le module de réécriture d'URL. Les deuxièmes et troisièmes lignes sont des **conditions de réécriture**, et elles vont de paire avec la quatrième, qui est la **règle d'écriture**.

Si toutes les conditions de réécriture spécifiées au-dessus de la règle sont réunies, le serveur prendra en compte cette règle.

### Syntaxe d'une condition de réécriture :
`RewriteCond CHAINE_A_TESTER CONDITION`

- `CHAINE_A_TESTER` : Une variable serveur, comme `%{REQUEST_FILENAME}`, `%{REQUEST_METHOD}`, etc.

Ici, `%{REQUEST_FILENAME}` correspond au chemin complet demandé par le client, dans le système de fichiers. Par exemple, `/users/john-doe`

- `CONDITION` : Une expression régulière, ou une comparaison de chaîne.

Ici, `%{REQUEST_FILENAME}` est lié à `!-f` et `!-d`, ce qui signifie qu'il ne doit être, ni un fichier existant, ni un dossier.

### Syntaxe d'une règle de réécriture :
`RewriteRule PATTERN CIBLE [DRAPEAUX]`

- `PATTERN` : Une expression régulière, à laquelle on comparera l'URL demandée.

Ici, on a écrit un point (`.`), ce qui signifie que toutes les chaines seront acceptées.

- `CIBLE` : L'URL cible. On peut écrire un nom de fichier, comme on l'a fait ici, pour rediriger toutes les requêtes vers le fichier `index.php`.
- `[DRAPEAUX]` : Les options de la règle. Ici, `L` (`Last`) signifie que cette règle sera la dernière à être appliquée (dans le cas où d'autres règles sont écrites à la suite du fichier). QSA (`Query String Append`) signifie que le serveur doit conserver les paramètres passés dans l'URL.

L'appel au contrôleur frontal sera placé dans le fichier `index.php`, et ainsi toutes les requêtes faites au site transiteront par cette page.

Autre exemple : Supression du `www` devant un nom de domaine :

```
RewriteEngine on
RewriteCond %{HTTP_HOST} !^mon-site.fr$ [NC]                # La règle ne s'appliquera que si l'hôte demandé est différent du nom de domaine actuel ('mon-site.fr')
RewriteRule . http://mon-site.fr%{REQUEST_URI} [R=301,L]    # On ajoute %{REQUEST_URI}, le chemin qui suit le nom de domaine. On génère en même temps un entête de type 301 (redirection permanente)
```

Les possibilités sont nombreuses avec le module de réécriture d'Apache. [Voir la documentation pour plus d'informations](https://httpd.apache.org/docs/current/fr/mod/mod_rewrite.html).


## Le routage
### Principe

Dans une application web, les URLs différentes peuvent vite se multiplier, par exemple : `http://www.monsite.fr/article.php?id=128` `http://www.monsite.fr/users.php?id=14` `http://www.monsite.fr/users.php?id=14&action=edit`

Le problème de ce genre d'URLs est qu'elles ne sont pas facilement mémorisables, et que leur rôle ne saute pas forcément aux yeux de l'utilisateur.

Sur les sites web modernes, on trouve souvent ce type d'URLs, à la place des précédentes : `http://www.monsite.fr/nom-de-l-article` `http://www.monsite.fr/users/14` `http://www.monsite.fr/users/edit/14`

La lecture de l'URL permet alors de déduire la page à laquelle elle donne accès. Ainsi, on peut construire une hiérarchie d'URLs qui ressemble, de près ou de loin, à la navigation du site web :

`http://www.monsite.fr/users/` pour gérer les utilisateurs `http://www.monsite.fr/articles/` pour voir tous les articles `http://www.monsite.fr/moncompte/` pour accéder à mon compte, etc.

On appelle parfois ces URLs des URLs **sémantiques**.

Mais cela n'implique pas forcément de créer des dossiers `/users`, `articles` ou `/moncompte` sur le serveur. En fait, il se peut même que certaines pages soient accessibles depuis plusieurs URLs différentes.

Il est possible, à l'aide de la réécriture d'URL, de rediriger toutes les requêtes vers une seule page, vers le contrôleur frontal de l'application.

Le principe du **routage** permet de faire le lien entre ces URLs "lisibles" et l'accès à une partie de l'application.

### Exemple de routage

Imaginons que nous ayons deux contrôleurs dans notre application : `Users`, qui donne accès aux méthodes `List` et `DisplayById($id)` `Index`, qui donne accès aux méthodes `Home` et `Contact`

On imagine la table de correspondance suivante :

```
+----------------------------------------+------------+---------------------------+
|                  URL                   | Contrôleur |          Méthode          |
+----------------------------------------+------------+---------------------------+
| monsite.fr/users                       | Users      | List                      |
| monsite.fr/users/details/[identifiant] | Users      | DisplayById($identifiant) |
| monsite.fr                             | Index      | Home                      |
| monsite.fr/contact                     | Index      | Contact                   |
+----------------------------------------+------------+---------------------------+
```

Dans le contrôleur frontal, il est par exemple possible de lire le contenu de la variable `$_SERVER['REQUEST_URI']`, qui correspond à l'URL qui a été passée au navigateur. Le serveur Apache n'oublie pas cette URL, même s'il n'accède pas vraiment au contenu vers lequel elle semble pointer (puisque nous avons **réécrit** l'URL).

D'après cette variable, on pourra appeler le bon contrôleur et la bonne action, en fonction de l'URL envoyée par le client.

En pratique, un framework MVC contient généralement un module de routage au sein de son architecture. Le framework W, par exemple, utilise une librairie existante : "AltoRouter".

Dans le framework `W`, les routes sont à paramétrer dans le fichier `routes.php`, dans un tableau PHP. Ce tableau PHP est utilisé par AltoRouter.

Exemple d'utilisation d'AltoRouter (sans le framework `W`) :

```php
$router = new AltoRouter();

$router->addRoutes(array(
    array('GET',    '/users',                           'Users#List',           'users_list'),
    array('GET',    '/users/details/[:identifiant]',    'Users#DisplayById',    'user_details'),
    array('GET',    '/',                                'Index#Home',           'home'),
    array('GET',    '/contact',                         'Index#Contact',        'contact'),
));

// Retrouve la bonne route
$match = $router->match();

// Appelle la méthode ou génère une 404
if( $match && is_callable( $match['target'] ) ) {
    call_user_func_array( $match['target'], $match['params'] ); 
} else {
    // Si aucune route n'a été trouvée
    header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}
```

La première case de chaque tableau contient la méthode (pour une page qui accepte des soumissions de formulaire POST, on utilisera par exemple `GET|POST`). La deuxième contient l'URL envoyée par le client, avec entre crochets ce qui doit être considéré par l'application comme un paramètre. Ce paramètre sera envoyé à la méthode du contrôleur lors de son appel. La troisième contient la route, au format `ClasseControleur#Methode`. La dernière case contient le nom de la route, qui doit être unique. On s'en servira par exemple pour générer une URL à partir d'une route (par exemple, dans le cas de l'affichage de l'action d'un formulaire).