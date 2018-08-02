# Mémo géant

Plutôt que de fouiller dans TOUS les dossiers pour retrouver TOUS mes mémos, tout sera écrit ici. 

La structure de ce fichier sera la suivante : 

**SOMMAIRE GÉNÉRAL**

- LIEN VERS LE LANGUAGE 1
- LIEN VERS LE LANGUAGE 2
- LIEN VERS LE LANGUAGE 3

[...]

**SOMMAIRE LANGUAGE 1**

- THEME 1 
- THEME 2 
- THEME 3


---
---


## SOMMAIRE

- [AJAX](https://github.com/Piotezaza/CoursNumericall/blob/master/M%C3%A9mo%20g%C3%A9ant.md#ajax)
- [BOOTSTRAP](https://github.com/Piotezaza/CoursNumericall/blob/master/M%C3%A9mo%20g%C3%A9ant.md#bootstrap)
- [CSS](https://github.com/Piotezaza/CoursNumericall/blob/master/M%C3%A9mo%20g%C3%A9ant.md#css)
- [HTML](https://github.com/Piotezaza/CoursNumericall/blob/master/M%C3%A9mo%20g%C3%A9ant.md#html)
- [JAVASCRIPT](https://github.com/Piotezaza/CoursNumericall/blob/master/M%C3%A9mo%20g%C3%A9ant.md#javascript)
- [JQUERY](https://github.com/Piotezaza/CoursNumericall/blob/master/M%C3%A9mo%20g%C3%A9ant.md#jquery)
- [PHP](https://github.com/Piotezaza/CoursNumericall/blob/master/M%C3%A9mo%20g%C3%A9ant.md#php)
- [SQL](https://github.com/Piotezaza/CoursNumericall/blob/master/M%C3%A9mo%20g%C3%A9ant.md#sql)
- [SYMPHONY](https://github.com/Piotezaza/CoursNumericall/blob/master/M%C3%A9mo%20g%C3%A9ant.md#symphony)
- [AUTRES LIENS UTILES](https://github.com/Piotezaza/CoursNumericall/blob/master/M%C3%A9mo%20g%C3%A9ant.md#autres-liens-utiles)

---
---


## AJAX

### SOMMAIRE

- [COURS](https://github.com/Piotezaza/CoursNumericall/blob/master/M%C3%A9mo%20g%C3%A9ant.md#cours)
- [AVEC JAVASCRIPT](https://github.com/Piotezaza/CoursNumericall/blob/master/M%C3%A9mo%20g%C3%A9ant.md#avec-javascript)
    - [CODE TYPE](https://github.com/Piotezaza/CoursNumericall/blob/master/M%C3%A9mo%20g%C3%A9ant.md#code-type)
- [AVEC JQUERY](https://github.com/Piotezaza/CoursNumericall/blob/master/M%C3%A9mo%20g%C3%A9ant.md#avec-jquery)
    - [CODE TYPE](https://github.com/Piotezaza/CoursNumericall/blob/master/M%C3%A9mo%20g%C3%A9ant.md#code-type-1)

### COURS

- [OPENCLASSROOMS - Introduction à AJAX](https://openclassrooms.com/courses/1916641-dynamisez-vos-sites-web-avec-javascript/1920925-quest-ce-que-lajax)

### AVEC JAVASCRIPT 
- `var hxr = new XMLHttpRequest` : fais un appel AJAX en natif
- `xhr.open(METHOD, URL, ASYNC)` : prépare la requête
- `this.status` : status de la réponse serveur
- `this.readyState` : état de la requête, 200 = OK // 4 = requête finie, le serveur a répondu
- `this.responseText` : contenu de la réponse
- `JSON.parse(STRING)` : transforme une chaîne (JSON) en objet JS
- `JSON.stringify(OBJECT)` : transforme un objet en chaîne (JSON)
- `xhr.send()` : envoi de la requête

#### CODE TYPE

```javascript
var hxr = new XMLHttpRequest;

xhr.open(METHOD, URL, ASYNC);

xhr.onreadystatechange = function()
{
    this.status;
    this.readyState;
    this.responseText;
    JSON.parse(STRING);
    JSON.stringify(OBJECT);
}

xhr.send();
```

### AVEC JQUERY

- `url: ''` : lien vers le script à appeler
- `method: 'POST'` : ou GET
- `data: {}` : **OBJET** `{ username: 'Bob', password: '1234' }` ou **CHAÎNE** `( "username=Bob&password=1234" )`
- `dataType: 'html'` : ou JSON
- `console.log(data);` : affichage du contenu de la réponse

#### CODE TYPE

```javascript
$.ajax({

    url: '',
    method: 'POST',
    data: {},
    dataType: 'html',
    beforeSend: function(){

    },
}).done(function(data){

    console.log(data);

}).fail(function(xhr, textStatus){

    // Erreur

});
```

---

#### Permet de paramétrer toutes les prochaînes requêtes AJAX (et donc de gagner du temps)


```javascript
$.ajaxSetup({
    url: 'script.php'
});

$.ajax({}).done(...);
```

---

#### Requête GET & POST

```javascript
$.get(URL, DATA, function(data){}, DATATYPE); // Requête GET
$.post(URL, DATA, function(data){}, DATATYPE); // Requête POST
$.getJSON(URL, DATA, function(data){}); // Requête GET type JSON
$.post(URL, DATA, function(data){}, 'json'); // Requête GET type JSON
```

--- 

- `$('form').serialize()` : retourne les données d'un formulaire sous forme de chaîne encodée pour les URL

---
---


## BOOTSTRAP

### SOMMAIRE

- [STARTER TEMPLATE](https://github.com/Piotezaza/CoursNumericall/blob/master/M%C3%A9mo%20g%C3%A9ant.md#starter-template)
- [FORMULAIRE TEMPLATE](https://github.com/Piotezaza/CoursNumericall/blob/master/M%C3%A9mo%20g%C3%A9ant.md#formulaire-template)

### STARTER TEMPLATE

```html
<!doctype html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <h1>Hello, world!</h1>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  </body>
</html>
```

### FORMULAIRE TEMPLATE

```html
<form>
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  <div class="form-group form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
```

---
---


## CSS

### SOMMAIRE & LIENS

- [FLEXBOX FROGGY](http://flexboxfroggy.com/#fr)
- [CSS ZEN GARDEN](http://www.csszengarden.com/)

### TITRE

---
---


## HTML

### SOMMAIRE

- []()

### TITRE

---
---


## JAVASCRIPT

### SOMMAIRE

- []()

### TITRE

---
---


## JQUERY

### SOMMAIRE

- []()

### CDN JQUERY

```html
<script src="http://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
``` 

---
---


## PHP

### SOMMAIRE

- [FONCTIONS DE BASE](https://github.com/Piotezaza/CoursNumericall/blob/master/M%C3%A9mo%20g%C3%A9ant.md#fonctions-de-base)
- [BASIQUE]()
    - [Enregistrer des informations dans un fichier](https://github.com/Piotezaza/CoursNumericall/blob/master/M%C3%A9mo%20g%C3%A9ant.md#enregistrer-des-informations-dans-un-fichier)
- [POO](https://github.com/Piotezaza/CoursNumericall/blob/master/M%C3%A9mo%20g%C3%A9ant.md#orient%C3%89-objet)
    - [AUTOLOAD](https://github.com/Piotezaza/CoursNumericall/blob/master/M%C3%A9mo%20g%C3%A9ant.md#autoload)
    - [ESPACE DE NOM / NAMESPACE](https://github.com/Piotezaza/CoursNumericall/blob/master/M%C3%A9mo%20g%C3%A9ant.md#espace-de-nom--namespace)
    - [STARTER TEMPLATE CRÉATION OBJET](https://github.com/Piotezaza/CoursNumericall/blob/master/M%C3%A9mo%20g%C3%A9ant.md#starter-template-cr%C3%89ation-objet)
    - [TESTER LE TYPE D'ATTRIBUT (string, array, ...)](https://github.com/Piotezaza/CoursNumericall/blob/master/M%C3%A9mo%20g%C3%A9ant.md#tester-le-type-dattribut-string-array-)

### FONCTIONS DE BASE

- `PHP_EOL` : permet de sauter une ligne dans un fichier
- `require_once("fichier.txt")` : bloque l'execution du code si le fichier n'est pas trouvé
- `strlen()` retourne la longueur d'une chaîne 
- `` 

### BASIQUE

#### ENREGISTRER DES INFORMATIONS DANS UN FICHIER

```php
// VERSION À FAIRE À CHAQUE FOIS (methode dans if et ensuite le reste dans le if)
    if($_POST)
    {
        if(empty($_POST['pseudo']))
        {
            echo "Pas de pseudo renseigné";
        }
        else 
        {
            echo "Bienvenue sur le site " .$_POST['pseudo'];
        }
    }

    extract($_POST); // Cette fonction nous permet de créer des variables via les indices du tableau et affecte leur valeur

    echo '<br>';

    echo $pseudo . " - " . $email;


    # On souhaite inscrire les valeurs récupérées par le formulaire dans un fichier externe.

    $f = fopen("liste.txt", "a"); //on enregistre dans une variable l'opération d'ouverture d'un fichier. 'a' nous permet d'ouvrir le fichier et s'il n'existe pas, de le créer. La fonction fopen prend 2 arguments : nom du fichier + méthodoligie

    /*
        r  => lecture seule du fichier, début de fichier
        r+ => lecture et écriture du fichier, début de fichier
        w  => écriture seule, écrase le reste du fichier
        w+ => lecture et écriture, écrase le reste du fichier
        a  => écriture seule, fin du fichier
        a+ => lecture et écriture, fin du fichier
    */

    fwrite($f, $_POST['pseudo'] . ' - ');
    fwrite($f, $_POST['email'] . "\n");

    $f = fclose($f); // pas indispensable mais libère de la ressource

```


### ORIENTÉ OBJET

- `$this` 
- `self::` représente l'objet depuis lequel il est appelé. Peut également s'écrire de la manière suivante (pas trop recommandée) > `::objet`. À utiliser **uniquement** sur les `const` et les `static`.
- [COURS MADE IN MAZA](https://github.com/Piotezaza/CoursNumericall/tree/master/PHP/POO#petites-explications-maison)

#### **AUTOLOAD**

[Doc PHP.NET](http://php.net/manual/fr/function.spl-autoload-register.php)

```php
spl_autoload_register(function($className)
{
    // /* remplacer les \ par des / mac OS X UNIQUEMENT */ $className = str_replace('\\', '/', $className); 

    if(file_exists($className . '.php'))
    {
        require_once($className . '.php');
    }
});
```
---
#### **ESPACE DE NOM / NAMESPACE**

[Cours rapide Openclassrooms](https://openclassrooms.com/courses/les-espaces-de-noms-namespace) | Pour plus de détails sur le code ci-dessous : [PHP.NET - Utilisation des espaces de noms : importation et alias](http://php.net/manual/fr/language.namespaces.importing.php)

À savoir : 

-> Ça regroupe des variables et des fonctions, des classes, tout ce que vous voulez dans un même ensemble. 

-> Il doit TOUJOURS être au début de la requête, sinon une erreur fatale va apparaître

```php
namespace foo;
use My\Full\Classname as Another;

// Ceci est la même chose que use My\Full\NSname as NSname
use My\Full\NSname;

// importation d'une classe globale
use ArrayObject;

// importation d'une function (PHP 5.6+)
use function My\Full\functionName;

// alias d'une fonction (PHP 5.6+)
use function My\Full\functionName as func;

// importation d'une constante (PHP 5.6+)
use const My\Full\CONSTANT;

// instantie un objet de la classe foo\Another
$obj = new namespace\Another;

// instantie un objet de la classe My\Full\Classname
$obj = new Another;

// appelle la fonction My\Full\NSname\subns\func
NSname\subns\func();

// instantie un objet de la classe ArrayObject
$a = new ArrayObject(array(1));

// Sans l'instruction "use ArrayObject" nous aurions instantié un objet de la classe foo\ArrayObject
func(); // Appel la fonction My\Full\functionName

// affiche la valeur de My\Full\CONSTANT
echo CONSTANT; 
```
---
#### **STARTER TEMPLATE CRÉATION OBJET**

```php
<?php

namespace ;

class OBJET /* extends PARENT*/
{
    // private $attribut; //Ne pas oublier de faire le getter & setter en fonction du cas d'utilisation de l'attribut
    // public $attribut;
    // protected $attribut;

    /*public | private | protected | static*/ function __construct(/*ARGUMENTS*/)
    {
        # CODE ...
    }

}
```
---
#### **TESTER LE TYPE D'ATTRIBUT (string, array, ...)**

```php
public function setAttribut(string $attribut)
{
    $this->attribut = $attribut;

    return $this;
}

```

---
---


## SQL

### SOMMAIRE

- []()

### TITRE

---
---


## SYMPHONY

### SOMMAIRE

- []()

### TITRE

---
---

## AUTRES LIENS UTILES

- [GRAFIKART - Tuto JSON](https://www.grafikart.fr/tutoriels/jquery/json-77)
- [FUNDATION](https://foundation.zurb.com/) | Framework Boostrap like