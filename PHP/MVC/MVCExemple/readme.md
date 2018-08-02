# Exemple MVC

Exemple simple d'application avec une architecture MVC

## Installation

L'installation de composer est indispensable
[Composer](https://getcomposer.org/) - Site de Composer

- [Composer.exe](https://getcomposer.org/Composer-Setup.exe) | (cocher developper mode et ne pas mettre de proxy)

Exécuter la commande suivante pour installer les bibliothèques tières

```
composer install
```

**ATTENTION AUX SLASH !!!**

Dans le fichier `index.php`, une variable globale "BASEPATH" est définie comme le chemin du projet (attention il ne faut pas d'espace dans le lien)
`define('BASEPATH', "CoursNumericall/PHP/MVC/MVCExemple")`

Faire de même pour le fichier `.htaccess`
`RewriteBase /CoursNumericall/PHP/MVC/MVCExemple/`

Dans Visual Studio Code, penser à installer l'extension **Apache Conf**

## Une fois le site opérationnel

Tester en ajoutant à l'URL : `/article/index`