# L'architecture MVC

MVC signifie **Modèle Vue Contrôleur**, c'est une manière d'organiser un programme en séparant les couches présentation, traitement et accès aux données.

- **Modèle** : s'occupe des accès à la base de données
- **Vue** : contient les fichiers qui affichent le code HTML
- **Contrôleur** : traitement des requêtes clients

## Le système de routing

Lors du développement d'un site web en PHP, le fichier `index.php` définit la page à afficher en fonction des valeurs get.

Pour le lien `monsite.com/index.php?page=editarticle&id=23` on utilise généralement un **switch** sur la valeur page pour afficher l'édition d'un article.

Le principe des **routes** permet d'avoir des liens plus jolis mais surtout plus explicites et adaptés pour le *SEO*.

Ainsi la route pour le lien orécédent devient `monsite.com/article/edit/23`.

Les routes affichent une arborescence qui n'existe pas physiquement sur le serveur, le **contrôleur frontal** interprète ces routes.

Afin de rediriger les routes vers le fichier `index.php` un fichier .gtaccess doit être mis à la racine du projet

```
# Activation de la réécriture

RewriteEngine on
RewriteBase /Lien/Vers/MonProjet/

# Conditions de réécriture, ne doit pas être un fichier ou un dossier existant

RewriteCond ${REQUEST_FILENAME} !-f
RewriteCond ${REQUEST_FILENAME} !-d

# Redirection de tout autres liens vers index.php

RewriteRule . index.php [L, QSA] // QSA : on renvoie les paramètres
```

## Le contrôleur frontal

Le **contrôleur frontal** (Front Controller) appelle le bon contrôleur applicatif en fonction de la requête émise par l'utilisateur.

Il a pour but d'analyser le lien que l'on appelle route et en résulte un nom de contrôleur, d'action et de paramètres.

Par exemple, lors de l'appel de la route `article/edit/23`, le contrôleur frontal doit appeler l'objet contrôleur 

**[...] J'AI PAS LA SUITE**


## Le moteur de templates

Le but d'une architecture MVC est de faciliter le travail en équipe, ainsi les vues seront développées principalepment pour un développeur front.

L'utilisation du language PHP dans du code HTML fait perdre en lisibilité et peur être compliqué pour un dev front.

Le moteur de template permet de développer des vues en proposant un **language simplifié** spécialement conçus pour l'affichage de données (et non le traitement)

Il propose également un système de cache.


## Des objets comme les modèles

Dans une architecture MVC, les données sont représentées par des objets appelés **entités** (Entity ou Domain Objects).

Des managers ou **repositories** permettent de faire la transition entre les entités et la base de données (Data Mappers).


---

## Liens utiles 

- [Exemple d'architecture MVC à télécharger](https://github.com/Oviglo/MVCExemple/archive/master.zip)
- [Composer.exe](https://getcomposer.org/Composer-Setup.exe) | (cocher developper mode et ne pas mettre de proxy)
- [Packagist](https://packagist.org/)