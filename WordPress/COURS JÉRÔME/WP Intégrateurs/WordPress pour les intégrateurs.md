# WordPress pour les intégrateurs (44)

## Objectifs

 * Comprendre la structure des fichiers d'un thème existant
 * Connaître l'arborescence des fichiers (wphierarchy.com)
 * Être initié aux contenus des fichiers (functions.php, style.css, index.php, etc.)
 * Hacker un thème avec les thèmes enfants
 * Comprendre l'utilité des thèmes enfants
 * Savoir comment créer un thème enfant simple
 * Créer un thème avec les thèmes blancs
 * Comprendre l'utilité des thèmes blancs (html5blank, bones, etc.)
 * Savoir modifier un thème blanc (directement dans le code)

**Intégration HTML/CSS sous WordPress**
 * Savoir répartir le html dans les fichiers de thèmes
 * Connaître les principaux template tags


##Comment modifier un thème

 * Mettre à jour un thème si on en est l'auteur
 * Possibilité de modifier un thème existant mais on ne DOIT plus le mettre à jour (sous peine de perdre ses modifications)
 * Travailler sur un thème enfant (pour pouvoir continuer de mettre à jour le thème parent)
 * Partir d'un thème de démarrage (blank theme) WP Joints, Bones, **Understrap**...
 
##Différents types de thèmes
 * e-commerce, entreprise, portfolio, blog...
 * gratuits ou payants (dit 'Premium')
 * Les thèmes présents sur le dépôt Wordpress sont gratuits.
 * D'autres répertoires de thèmes : 
    - https://themeforest.net,
    - http://www.templatemonster.com,
    - https://creativemarket.com/themes/wordpress
 * Thème à modifier/éditer :
    - **thème classique** basique, personnalisable via le menu 'personnaliser'
    - **thème prêts à l'emploi** parfois gratuit mais souvent premium avec 'content builder' et 'démos de contenus'
    - **thème enfant**: permettent de modifier un thème tout en conservant le bénéfice des mises à jour du thème parent
    - **thème de démarrage** (thème blanc, blank theme, starter theme) partir d'une base sans avoir à tout recréer, à modifier pour créer son propre thème
    - **framework de développement de thème** idem que les thèmes de démarrage mais plus orienté développeur (basé sur bootstrap, fondation...) ils son plus complexes à utiliser. Apporte des séries de fonctionnalités pour créer la base d'un thème.

##Editer son thème

### Edition avec le menu apparence du back office
 * Permet de gérer le thème et les options visuelles de votre site web
 * Les options sont différentes d'un thème à l'autre en fonction des options développées par l'auteur du thème
 * Par défaut Wordpress permet toujours d'accéder à :
    - **Thèmes :** la liste des thèmes installés et la possibilité d'ajouter d'autres thèmes
    - **Personnaliser :** la possibilité de modifier visuellement certaines options du thème choisi
    - **Editeur :** un éditeur de code qui vous permettra de modifier les fichiers source du thème
 * Toujours avec un 'child thème' ou thème enfant sur un thème dont on n'est pas l'auteur
     - pour pouvoir continuer à bénéficier des futures mises à jour du thème par l'auteur
     - pour une meilleur lisibilité du code
 * L'éditeur fourni dans le backoffice peut être amélioré par une extension comme 'WP Editor' (coloration du code...)

### Quel type de thème choisir ?
 * Selon le budget
 * Selon le degré de fonctionnalité et d'intégration
 * Selon le type de site à créer (e-commerce, blog, présentation, porfolio, social...)

Les thèmes par défaut de Wordpress sont également à considérer comme de bons thèmes de démarrage et la méthode du "thème enfant" permet d'en modifier totalement l'apparence tout en gardant le même fonctionnement.
Dans le cas d'un thème woocommerce, il y a également le thème 'storefront' développé avec un thème enfant par woocommerce.


### Mettre à jour le thème
 * toujours faire une sauvegarde complète de la base de donnée et des fichiers
 * Faire un test de la mise à jour sur une copie locale en développement avant de l'appliquer sur un site en production

---

## Les thèmes enfants
 * Permet de créer des modifications à partir d'un thème existant (si la fonctionnalité est implémentée)
 * Conserve vos modifications en cas de mise à jour du thème parent
 * modifier styles, fonctionnalités, templates du thème parent dans le thème enfant

### Fichiers nécessaires pour créer un thème enfant

Créer un nouveau dossier de thème vis à vis du thème parent, trois fichiers sont nécessaires :

 * **screenshot.png** -> la prévisualisation du thème dans la zone d'admin
 * **style.css** -> déclaration du thème avec le commentaire en tête et styles spécifiques au thème enfant
 * **functions.php** fonctionnalités du thème enfant

**ATTENTION** : si le fichier style remplace son homologue du thème parent, le fichier functions du thème enfant est chargé AVANT celui du thème parent.

À ces fichiers de base peuvent s'ajouter des fichiers de template du thème parent. À copier dans le thème enfant pour les modifier. **Il faut veiller à reproduire l'arborescence des dossiers du thème parent.**

#### Ordre de chargement des fichiers dans un thème enfant
 * style.css (enfant) supplante le style.css (parent)
 * functions.php (enfant) se charge avant le functions.php (parent)
 * Si l'on souhaite conserver la feuille de style du parent, il est donc nécessaire de l'importer dans le thème (via css ou via functions.php)

**Pour réutiliser les styles de base du thème parent, 2 solutions s'offrent à vous :**

 * Via le fichier `functions.php` avec la fonction `wp_enqueue_style()`
 * Via la css dans votre propre fichier `style.css` en utilisant la méthode `@import`.

---

## Les thèmes de démarrage

### Qu'est-ce qu'un thème de démarrage ?
 * Une base de thème à personnaliser entièrement contenant déjà des fonctionnalités et des styles.
 * Twenty-Twelve est fourni comme thème d'apprentissage, à ce titre il peut être considéré comme un thème de démarrage
 * Les thèmes de démarrage sont également appelés : "starter themes", "blank themes", "thèmes blancs" ou "thèmes vides".
 * Ne pas les confondre avec les thème enfants
 * Thème à modifier complètement
 * Certains sont complètement vides tandis que d'autres contiennent déjà une base de design responsive, comme Bones ou Skeleton.
 * Peuvent être basés sur des framework CSS comme Bootstrap, Boilerplate, Fondation...

### Quelques thèmes de démarrage
 
 * [underscores.me](http://underscores.me) : code HTML5 propre, bon usage sémantique, CSS propre.
 * [understrap.com](https://understrap.com) : underscore + bootstrap 
 * [roots.io](https://roots.io) : avec les thèmes Sage (Bootstrap) ou Bedrock (qui tient plus du framework que du thème)
 * [JointsWP](http://jointswp.com) : un starter theme basé sur le framework Foundation
 * [Bones](http://themble.com/bones/) : un starter theme au design déjà un peu travaillé.
...

---

## Hiérarchie des fichiers d'un thème Wordpress

Les thèmes sont composés de **fichiers de base** :
 * **screenshot.png** -> la prévisualisation du thème dans la zone d'admin
 * **style.css** -> déclaration du thème avec le commentaire en tête et styles spécifiques au thème enfant
 * **functions.php** -> en quelque sorte le 'plugin du thème' qui permet la déclaration et l'ajout de fonctionnalités à notre notre thème

De **fichiers de templates** : 
 * index.php
 * page.php
 * singular.php ou single.php
 * archive.php
 * category.php
 * author.php
 * front-page.php
 * search.php
 * 404.php
 * ...

D'**includes** qui sont des portions de template :
 * header.php
 * footer.php
 * sidebar.php
 * searchform.php
 * loop.php
 * comments.php

### La hérarchie des templates

 * Les templates font partie d'un hiérarchie de templates
 * voir [wphierarchy.com](https://wphierarchy.com), chaque template est lié à sa rubrique correspondante dans le Codex de Wordpress.
 * Le template le plus global est `index.php`
 * Si un template plus précis correspondant à la hiérarchie est trouvé dans le dossier du thème (par exemple `front-page.php` ou `category.php`, celui-ci est utilisé en lieu et place du template plus global sur la page concernée
 * Par exemple, pour créer un template spécifique aux pages, on utilisera un fichier nomé `page.php`. On peut également créer un template pour une page spécifique en utilisant son slug `page-contact.php` ou son id `page-23.php`.

### Quelques templates possibles :
 * `home.php` ou `front-page.php` pour un template spécifique à la page d'accueil du site.
 * `404.php` pour un template spécifique à la page d'erreur 404.
 * `search.php` pour un template spécifique à l'affichage des résultats de recherche
 * `singular.php` (depuis la version 4.3) pour l'affichage détaillé d'un contenu de type Page ou Article.
 * `archive.php` pour l'affichage des listes d'articles.
 
### Le template singular.php

Ce template regroupe deux autres templates qui peuvent être détaillés comme suit :
 * `single.php` pour l'affichage du contenu détaillé d'un Article
 * `page.php` pour l'affichage du contenu d'une Page

### Le template archive.php
Ce template regroupe plusieurs autres templates qui peuvent être détaillés comme suit :
 * `category.php` pour l'affichage des archives de Catégories
 * `tag.php` pour l'affichage des archives d'Etiquettes
 * `author.php` pour l'affichage des archives d'Auteur
 * `date.php` pour l'affichage des archives par Date
 * `attachment.php` pour l'affichage des archives de Commentaires


## Les Conditionnal Tags

Ces tags conditionnels permettent de vérifier au sein même du code PHP sur quel type de page on se trouve.

En voici quelques-uns :

* si on est sur la page d’accueil `is_home()`
* si on est dans une archive `is_archive, is_tag, is_category, is_date`…
* si on est sur une page auteur `is_author`
* si on est dans la boucle `in_the_loop`
* si un plugin est activé `is_plugin_active`
* si votre thème possède une certaine fonction `current_theme_supports`
* Et un exemple d'utilisation d'un conditionnal tag

```
<?php if ( is_home() ) { ?>
    <p>Vous êtes sur la page d'accueil !</p>
<?php } ?>
```

On peut bien sûr coupler les conditions 

```
<?php if ( is_home() && is_admin() ) {
    echo "<p>Vous êtes sur la page d'accueil en tant qu'administrateur.</p>";
}
?>
```

---

# EXERCICES

 * Créer un thème enfant pour le thème twentysixteen
     - apporter des modifications à la CSS
     - apporter des modifications au contenu du footer
     - apporter des modifications dans l'affichage du single.php
     - créer un nouvel exerpt length
 * Créer un thème blank à partir de understrap
     - mettre en place le thème avec npm, gulp et bower
     - analyse de la structure et des fonctions du thème
     - utiliser les fichiers saas pour modifier le thème et les variables de bootstrap
     - ajouter des zones de widgets dans le footer avec `register_sidebar()` et `dynamic_sidebar`
     - créer une nouvelle taille d'image avec `add_image_size()` et appeler cette nouvelle taille d'image avec `the_post_thumbnail()`
     - ajouter un menu avec `register_nav_menu`et l'afficher dans le footer avec `wp_nav_menu`
     - modifier le template de la page d'accueil `home.php` pour ajouter un bloc avec `get_template_part()`
     - créer le template_part de la page d'accueil avec une grande image et un lien qui fait appel à la page contact du site avec `get_permalink()`
     - créer un nouveau page template
 * Intégrer la maquette html fournie dans le thème understrap