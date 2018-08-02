# Développer un thème Wordpress

## Pourquoi créer un thème ?

 - Créer un style unique pour son site internet
 - Maîtriser parfaitement le code de son site
 - Savoir créer des templates de page pour créer des mises en pages spécifiques que ne proposent pas des thèmes standards
 - Séparation des concepts : présentation et contenu (la présentation c'est le thème qui gère, les contenus sont dans la base de donnée)
 - Permet de 'customizer' l'aspect de son site
 - C'est fun
 
## Anatomie d'un thème

 - les thèmes sont placés dans le dossier `wp-content/themes/` de votre installation Wordpress (Un thème = un dossier)
    *  **obligatoirement** un fichier `style.css` pour contrôler l'aspect graphique
    *  un `screenshot.png` pour générer la prévisualisation dans l'interface d'admin **(1200x900px)**
    *  **obligatoirement** au moins un fichier de template Wordpress (généralement plusieurs fichiers) `index.php` voir [hiérarchie des templates](https://wphierarchy.com)
    *  un fichier `functions.php` (optionnel) qui est un peu le plugin du thème
    *  des fichiers images, javascripts... en fonction des besoins du thème

Voir [ce graphique](http://yoast.com/wordpress-theme-anatomy/) pour une réprésentation visuelle.

### style.css

Le fichier style, en plus de porter vos informations de css, doit comporter obligatoirement un commentaire de ce type en début de fichier pour que vos fichiers soient reconnus comme un thème :

    /*
    Theme Name: Twenty Thirteen
    Theme URI: http://wordpress.org/themes/twentythirteen
    Author: the WordPress team
    Author URI: http://wordpress.org/
    Description: The 2013 theme for WordPress takes us back to the blog, featuring a full range of post formats, each displayed beautifully in their own unique way. Design details abound, starting with a vibrant color scheme and matching header images, beautiful typography and icons, and a flexible layout that looks great on any device, big or small.
    Version: 1.0
    License: GNU General Public License v2 or later
    License URI: http://www.gnu.org/licenses/gpl-2.0.html
    Tags: black, brown, orange, tan, white, yellow, light, one-column, two-columns, right-sidebar, flexible-width, custom-header, custom-menu, editor-style, featured-images, microformats, post-formats, rtl-language-support, sticky-post, translation-ready
    Text Domain: twentythirteen
    This theme, like WordPress, is licensed under the GPL.
    Use it to make something cool, have fun, and share what you've learned with others.
    */
   
Ces informations se retrouvent dans l'admin du site sur la page du thème.


### functions.php

Un thème peut faire appel à un fichier functions.php (optionnel). Ce fichier fonctionne basiquement comme un plugin, s'il est présent, il est utilisé et chargé par Wordpress pendant la phase d'initialisation de l'affichage d'une page (admin ou front).
Il est utile pour :
 - ajouter des chargements de fichiers scripts ou css (javascript, css, ) [voir wp_enqueue_scripts](https://codex.wordpress.org/Plugin_API/Action_Reference/wp_enqueue_scripts)
 - activer des 'features' de thème comme :
 - [des zones de widgets](https://codex.wordpress.org/Sidebars)
 - [des menus](https://codex.wordpress.org/Navigation_Menus)
 - [des tailles d'images personnalisées](https://codex.wordpress.org/Post_Thumbnails)
 - [des formats de post](https://codex.wordpress.org/Post_Formats)
 - [des headers personnalisés](https://codex.wordpress.org/Custom_Headers)
 - [des backgrounds personnalisés](https://codex.wordpress.org/Custom_Backgrounds)
 - Définir des menus d'options, et des options de personnalisation du thème
 - Définir des fonctions à utiliser dans votre thème comme par exemple redéfinir la longeur de l'exerpt (résumé) d'un article, 
 - Ajouter des customs posts, custom taxonomies, custom metas
 - Ajouter des pages et menus dans l'administration
 - ...


### Fichiers de templates

 - Les fichiers de templates sont des fichiers source écrits en php utilisés pour générer les pages demandées sur le site. Ils génèrent des fichiers HTML.
 - Il sont constitués de code HTML, de code PHP avec les [templates tags](https://codex.wordpress.org/Template_Tags) de Wordpress.


### Principaux fichiers d'un thème

**style.css**
La feuille de style principale du thème, elle doit inclure la déclaration de votre thème en commentaire.

**rtl.css**
Optionnelle, cette feuille de style est utilisée lorsque l'option de lecture du texte de droite à gauche est activée dans l'administration. Elle peut être générée par l'utilisation du plugin RTLer.

**index.php**
Le template principal, si votre thème fournit des templates, celui-ci doit être présent.

**comments.php**
L'include pour l'affichage des commentaires.

**front-page.php**
Le template de la page d'accueil, lorsque l'option utiliser une page statique est cochée.

**home.php**
Le template de la page d'accueil des articles.


**single.php**
Le template utilisé pour afficher le contenu d'un article lorsque l'on en lit le détail. Si ce template n'est pas présent, Wordpress utilise `singular.php` ou `index.php` à la place.

**single-{post-type}.php**
Le template utilisé pour afficher un article d'un certain type : par exemple si l'article a l'option post-format 'book' coché, Wordpress utilisera un fichier nommé `single-book.php` pour l'affichage. Si ce template n'est pas présent, Wordpress utilise `index.php` à la place.

**page.php**
Le template utilisé pour afficher le contenu d'une page.

**category.php**
Le template utilisé pour afficher les articles classés par catégorie.

**tag.php**
Le template utilisé pour afficher les articles par tags.

**taxonomy.php**
Le template utilisé pour afficher les articles lorsqu'une 'custom taxonomy' est demandée.

**author.php**
Le template pour afficher la liste des articles par auteur.

**date.php**
Le template utilisé pour afficher les articles classés par date.

**archive.php**
Le template d'archive est utilisé lorsqu'une catégorie, un auteur ou une date est affichée. Ce template sera surclassé si les templates respectifs correspondants existent (category.php, author.php, date.php)

**search.php**
Le template pour afficher le résultat d'une recherche

**attachment.php**
Template utilisé pour afficher un fichier attaché à un post (image, pdf...)

**image.php**
Template utilisé pour afficher un fichier attaché de type image. Si ce template n'est pas présent, Wordpress utilisera `attachment.php`

**404.php**
Le template de page 404, utilisé lorsqu'un lien est brisé et que Wordpress n'arrive pas à trouver la page.

...


### Thème basique

 - style.css
 - index.php
 - functions.php
 - screenshot.png

### Custom Page Templates

On peut créer des templates de page avec de nouveaux fichiers dans le thème, ils doivent simplement comporter ce commentaire en début de fichier :

    <?php
    /*
    Template Name: <Nom du template ici>
    */
    ?>

Le nouveau template apparaîtra alors dans l'édition d'une page dans l'encadré **page template**.


### Templates basés sur des requêtes

Il y a plusieurs moyens d'intervenir sur l'affichage des templates :
 - À travers la [hiérarchie des templates](https://wphierarchy.com) : Wordpress charge des templates en fonction de la requête formulée à travers l'url (permalien). L'URL indique le type de donnée affichée, puis Wordpress choisi à travers la hérarchie des templates le fichier à afficher.
 - À travers l'utilisation de **conditionals tags** à l'intérieur de la boucle

### Template tags

Le langage de template tags de Wordpress se réparti en différentes parties :
 - **Tags généraux**: `get_header(), get_footer(), get_sidebar(), get_template_part(), get_search_form(), wp_title(), single_cat_title()`...
 - **Tags d'auteurs** : `the_author(), get_the_author(), the_author_meta(), the_author_posts()`,...
 - **Tags de category** : `the_category(), category_description(), single_cat_title()`...
 - **Tags de commentaires** : `comment_author(), comment_date(), comment_form()`...
 - **Tags de liens** : `the_permalink(), get_permalink(), home_url(), site_url(), get_search_link(), get_edit_link(), get_attachment_link()`...
 - **Tags de posts** : next_post_link(), next_posts_link(), the_category(), the_content(), the_excerpt(), the_ID(), the_title(), the_date(), the_author()...
 - **Tags de Miniatures de Post** : `has_post_thumbnail(), get_post_thumbnail_id(), the_post_thumbnail(), get_the_post_thumbnail()`
 - **Tags de menus de navigation** : `wp_nav_menu()`
 - Voir la [liste complète des tags](https://codex.wordpress.org/Template_Tags)


### conditionals tags

Un [conditional tag](https://codex.wordpress.org/Conditional_Tags) (tag conditionnel) vérifie si une condition renvoie `true` ou `false` et permet de varier l'affichage d'un contenu en fonction de cette condition :

    <?php
    if ( is_category( '9' ) ) {
        get_template_part( 'single2' ); // looking for posts in category with ID of '9'
    } else {
        get_template_part( 'single1' ); // put this on every other category post
    }
    ?>

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


### includes

Les **includes** sont des portions de template :
 * header.php
 * footer.php
 * sidebar.php
 * searchform.php
 * loop.php
 * comments.php

Ils peuvent être appelés de deux manières :
- avec un template tag : `get_header()`
- à l'aide de la fonction `get_template_part()`


### Chemins des fichiers dans un thème

Si dans une feuille de style, les fichiers sont relatifs à la feuille de style et ne posent pas de problèmes d'inclusion, il en va autrement des fichiers liés à un template php. Par exemple si vous incluez des images d'un dossier `images/` dans votre thème, vous devez spécifier le chemin jusqu'au thème pour éviter les liens brisés :

    <?php echo get_theme_file_uri( 'images/logo.png' ); ?>

    <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" width="" height="" alt="" />

    <!-- pour un thème enfant -->
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.png" width="" height="" alt="" />


### métadonées globales

Wordpress stock des informations globales telles que le titre du site, la description, l'encodage, la langue, le dossier du template... dans une fonction appelée `bloginfo()` [voir ici](https://developer.wordpress.org/reference/functions/bloginfo/)

    <h1><?php bloginfo( 'name' ); ?></h1>

    <a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a>

### Theme Customization API

Depuis Wordpress 3.4, il est possible d'utiliser la fonction de personnalisation du thème fournie par Wordpress. elle fonctionne essentiellement par l'ajout du support d'une fonctionnalité déclarée dans le fichier `functions.php` via la fonction `add_theme_support()` [voir ici](https://developer.wordpress.org/reference/functions/add_theme_support/)

### Fonction de sécurisation des données

 Il est important de protéger les données dynamiques pour éviter les hacks, pour cette raison, les textes générés dynamiquement doivent être passées dans des fonctions d'échapement :
 - `esc_attr()`
 - `esc_html()`
 - `esc_url()`
Voir la [validation des données](https://codex.wordpress.org/Data_Validation#Attribute_Nodes)


### Classes du thème

 - [body_class()](https://codex.wordpress.org/Function_Reference/body_class)
 - [post_class()](https://codex.wordpress.org/Function_Reference/post_class)
 - [comment_class()](https://codex.wordpress.org/Function_Reference/comment_class)

### header, footer et bonnes pratiques

Wordpress a besoin de certaines déclaration dans le header et le footer pour fonctionner correctement.

**header :**

    <!DOCTYPE html>
    <html <?php language_attributes(); ?>>
        <head>
            <meta charset="<?php bloginfo( 'charset' ); ?>" />
            <title><?php wp_title(); ?></title>
            <link rel="profile" href="http://gmpg.org/xfn/11" />
            <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
            <?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
            <?php wp_head(); ?>
        </head>

**footer :**

    <?php wp_footer(); ?>
    </body>
    </html>

 - Utiliser le bon DOCTYPE.
 - Le tag `<html>` ouvrant doit include les `language_attributes()` générés par Wordpress
 - Le charset `<meta>` doit être inclus avant tout texte y compris la balise `<title>`.
 - Utiliser `bloginfo()` pour générer la description dans la balise meta
 - Utiliser `wp_title()` pour générer le titre dynamiquement
 - Ajouter les liens de RSS automatiques
 - Ajouter un appel à la fonction `wp_head()` juste avant la fermeture de balise `</head>`. Les plugins utilisent ce tag pour ajouter leurs scripts et feuilles de style
 - Ne pas include de feuille de style directement dans le head Préférer utiliser plutôt la fonction `wp_enqueue_scripts` dans le fichier `functions.php`
 - Utiliser la fonction `wp_footer()` dans le pied de page, juste avant la fermeture de balise `</body>`
