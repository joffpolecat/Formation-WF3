# PHP Orienté Objet

## Sommaire

- [Liens de cours](https://github.com/Piotezaza/CoursNumericall/tree/master/PHP/POO#liens-de-cours)
- [Résumé des explications du prof](https://github.com/Piotezaza/CoursNumericall/tree/master/PHP/POO#r%C3%A9sum%C3%A9-des-explications-du-prof)
- [Petites explications maison](https://github.com/Piotezaza/CoursNumericall/tree/master/PHP/POO#petites-explications-maison)
    - [Les Attributs](https://github.com/Piotezaza/CoursNumericall/tree/master/PHP/POO#les-attributs)
        - [`Public`](https://github.com/Piotezaza/CoursNumericall/tree/master/PHP/POO#lattribut-public)
        - [`Private`](https://github.com/Piotezaza/CoursNumericall/tree/master/PHP/POO#lattribut-private-)
        - [`Protected`](https://github.com/Piotezaza/CoursNumericall/tree/master/PHP/POO#lattribut-protected-)
    - [Les Méthodes](https://github.com/Piotezaza/CoursNumericall/tree/master/PHP/POO#les-m%C3%A9thodes)
    - [Utiliser une classe](https://github.com/Piotezaza/CoursNumericall/tree/master/PHP/POO#utiliser-une-classe)
- [Mémo](https://github.com/Piotezaza/CoursNumericall/tree/master/PHP/POO#m%C3%A9mo)

---
## Liens de cours

- [OPENCLASSROOMS - Programmez en orienté objet en PHP](https://openclassrooms.com/courses/programmez-en-oriente-objet-en-php/introduction-a-la-poo)
- [GRAFIKART - La POO en PHP](https://www.grafikart.fr/formations/programmation-objet-php)
- [PHP.NET - Les classes et les objets](http://php.net/manual/fr/language.oop5.php)
- [PHP.NET - NAMESPACE](http://php.net/manual/fr/language.namespaces.rationale.php)
- [EXPLICATION : DESIGN PATTERN / SINGLETON](https://apprendre-php.com/tutoriels/tutoriel-45-singleton-instance-unique-d-une-classe.html)

---
## Résumé des explications du prof 

Une **classe** c'est un **modèle de donnée** avec **attributs** & des **méthodes** qui va définir le comportement d'un objet.

Un **objet** est une **instance de classe**, c'est donc une variable que l'on peut utiliser comme le modèle le définit.

Une **classe** est un **moule** et un **objet** est un **gateau** (le moule indique qu'il faut des ingrédients, l'objet indique lesquels)

La pseudo variable `$this` peut se traduite par **"TON"** ou **"TA"** (utilise **TON** premier ingrédient avec **TON** deuxième et appelle **TA** méthode "mélanger")

`self::` fait référence à la **classe** contrairement à `$this` qui fait référence à **l'instance**

---

"encapsulation" définir si les propriétés sont publiques, privées, protected...

Le constructeur `__construct` est une méthode magique (appelée automatiquement par PHP)

Les constantes `const` sont des valeurs qui ne peuvent pas varier.

Une classe abstraite est une classe qui va contenir au moins une fonction abstraite. Elle ne peut pas être instanciée, elle est obligatoirement héritée.


**Opérateur ternaire**

```
$value == "val" ? "OUI" : "NON"
if($value == "val"){$result = "OUI";} else {$result = "NON";}
```

---
## Petites explications maison

> J'suis pas douée mais le peu que je sais je veux bien tenter d'expliquer.

Une **classe** c'est ce qui va contenir l'objet (un peu comme un moule) et l'**objet** c'est ce qui définit ton moule (s'il est carré, rond, etc.).

Elle va contenir pas mal de choses comme des **attributs** ou encore des **méthodes**.


### Les attributs

[Explication Openclassrooms](https://openclassrooms.com/courses/programmez-en-oriente-objet-en-php/introduction-a-la-poo#/id/r-1669226).

Les attributs ont des **status de visibilité différents**. Ils indiquent à partir d'où on peut y avoir **accès**. La déclaration d'attributs dans une classe se fait en écrivant le nom de l'attribut à créer, précédé de sa visibilité. On peut **initialiser** les attributs lorsqu'on les déclare (par exemple, leur mettre une valeur de 0 ou autre)

**ATTENTION**

La valeur que vous leur donnez par défaut doit être une **expression scalaire statique**.

Par conséquent, leur valeur ne peut *par exemple* **pas** être issue d'un appel à une fonction `private $_attribut = strlen('azerty')` ou d'une variable, superglobale ou non `private $_attribut = $_SERVER['REQUEST_URI']`.

Si votre version de PHP est *antérieure à la 5.6*, vous ne pouvez spécifier que des valeurs statiques, ce qui rend *impossible* l'assignation du résultat d'une opération.

Par exemple, vous ne pouvez pas faire de `private $_attribut = 1 + 1` ou bien `private $_attribut = 'Hello ' . 'world !'` .


#### L'attribut `public`

On peut y avoir accès depuis n'importe où, depuis l'intérieur de l'objet (dans les méthodes qu'on a créées), comme depuis l'extérieur


#### L'attribut `private` : 

Impose quelques restrictions : on n'aura accès aux attributs et méthodes seulement depuis l'intérieur de la classe, c'est-à-dire que seul le code voulant accéder à un attribut privé ou une méthode privée écrit(e) à l'intérieur de la classe fonctionnera. Pour s'y retrouver correctement dans le code, il est préférable d'utiliser la notation `PEAR` qui dit que chaque nom d'élément privé (ici il s'agit d'attributs, il peut aussi s'agir de méthodes) doit être précédé d'un underscore. Exemple : `$_attribut`.


#### L'attribut `protected` :

Ce type de visibilité est, au niveau restrictif, à placer entre `public` et private. Le type de visibilité `protected` est en fait une petite modification du type `private` : il a exactement les mêmes effets que `private`, à l'exception que toute classe fille aura accès aux éléments protégés.


**EXEMPLE :**

```php
<?php
class ClasseMere
{
  protected $attributProtege;
  private $_attributPrive;
  
  public function __construct()
  {
    $this->attributProtege = 'Hello world !';
    $this->_attributPrive = 'Bonjour tout le monde !';
  }
}

class ClasseFille extends ClasseMere
{
  public function afficherAttributs()
  {
    echo $this->attributProtege; // L'attribut est protégé, on a donc accès à celui-ci.
    echo $this->_attributPrive; // L'attribut est privé, on n'a pas accès celui-ci, donc rien ne s'affichera (mis à part une notice si vous les avez activées).
  }
}

$obj = new ClasseFille;

echo $obj->attributProtege; // Erreur fatale.
echo $obj->_attributPrive; // Rien ne s'affiche (ou une notice si vous les avez activées).

$obj->afficherAttributs(); // Affiche « Hello world ! » suivi de rien du tout ou d'une notice si vous les avez activées.
```

### Les méthodes

Pour la déclaration de méthodes, il suffit de faire précéder le mot-clé `function` à la visibilité de la méthode. Les types de visibilité des méthodes sont les mêmes que les attributs. Les méthodes n'ont en général pas besoin d'être masquées à l'utilisateur, vous les mettrez souvent en `public` (à moins que vous teniez absolument à ce que l'utilisateur ne puisse pas appeler cette méthode, par exemple s'il s'agit d'une fonction qui simplifie certaines tâches sur l'objet mais qui ne doit pas être appelée n'importe comment).
 
- `static` : toutes les variables appelées dans la fonction ne peuvent être modifiées 


### Utiliser une classe

- Créer un objet

On va utiliser notre classe afin qu'elle nous fournisse un objet.

```php
$perso = new Personnage;
```


- Appeler les méthodes de l'objet

Pour appeler une méthode d'un objet, il va falloir utiliser un opérateur : il s'agit de l'opérateur -> (une flèche composée d'un tiret suivi d'un chevron fermant). Celui-ci s'utilise de la manière suivante. À gauche de cet opérateur, on place l'objet que l'on veut utiliser. Dans l'exemple pris juste au-dessus, cet objet aurait été$perso. À droite de l'opérateur, on spécifie le nom de la méthode que l'on veut invoquer.

```php
<?php
// Nous créons une classe « Personnage ».
class Personnage
{
  private $_force;
  private $_localisation;
  private $_experience;
  private $_degats;
        
  // Nous déclarons une méthode dont le seul but est d'afficher un texte.
  public function parler()
  {
    echo 'Je suis un personnage !';
  }
}
    
$perso = new Personnage; // Création d'un nouvel objet Personnage >> $perso
$perso->parler(); // signifie « va chercher l'objet $perso, et invoque la méthode parler() sur cet objet »
```

- Le constructeur

Comme son nom l'indique, le constructeur sert à construire l'objet. Si des attributs doivent être initialisés ou qu'une connexion à la BDD doit être faite, c'est par ici que ça se passe. Le constructeur est exécuté **dès la création** de l'objet et par conséquent, **aucune valeur ne doit être retournée**, même si ça ne génèrera aucune erreur. Bien sûr, une classe fonctionne très bien sans constructeur, il n'est en rien obligatoire ! Si vous n'en spécifiez pas, cela revient au même que si vous en aviez écrit un vide (sans instruction à l'intérieur).

```php
public function __construct($force, $degats) // Constructeur demandant 2 paramètres
  {
    echo 'Voici le constructeur !'; // Message s'affichant une fois que tout objet est créé.
    $this->setForce($force); // Initialisation de la force.
    $this->setDegats($degats); // Initialisation des dégâts.
    $this->_experience = 1; // Initialisation de l'expérience à 1.
  }
```

---
## Mémo

- **Autoload**

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
- **Espace de nom / Namespace**

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
- **STARTER TEMPLATE CRÉATION OBJET**

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
- **Tester le type d'attribut (string, array,...)**

```php
public function setAttribut(string $attribut)
{
    $this->attribut = $attribut;

    return $this;
}

```
