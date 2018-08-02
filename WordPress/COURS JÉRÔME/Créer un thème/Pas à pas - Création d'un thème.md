# importer un template dans un theme Wordpress

## Création du thème

### créer les fichiers de base du thème

* style.css
* screenshot.png
* functions.php

* Copier le fichier `index.html` et ses dépendances
* renommer `index.html` en `index.php` pour en faire notre template de base
* Dans `index.php` Modifier les liens relatifs du document en ajoutant la fonction :

```
    get_template_directory_uri		//-> theme parent
    get_stylesheet_directory_uri	//-> theme enfant
```

exemple :

```
    <img src="<?= get_template_directory_uri(); ?>/img/image.jpg" alt="mon image">
```

Ne pas oublier le '/' après l'appel de la fonction


### créer des includes

On sépare le code de header et de footer dans des fichiers d'includes

```
    header.php
    footer.php
```

* On remplace dans index.php le code du header par <?php get_header(); ?>
et le code du footer par <?php get_footer(); ?>
* Utiliser les templates tag de wordpress pour inclure les scripts dans le head et juste avant la fermeture de balise BODY dans les nouveaux includes header.php et footer.php
 
```
    <?php wp_head(); ?> 	//-> en fin de balise head
    <?php wp_footer(); ?> 	//-> en fin de balise body
```

* Transférer le chargement des scripts et des styles dans une fonction
* utiliser la méthode Wordpress dans functions.php
* https://developer.wordpress.org/reference/functions/wp_enqueue_style/
* https://codex.wordpress.org/Plugin_API/Action_Reference/wp_enqueue_scripts

```
    wp_register_script()
    wp_enqueue_script()
    wp_enqueue_style()
```


### Ajouter une navigation

```
    register_nav_menu() -> déclare le menu dans le fichier functions.php
    wp_nav_menu() 		-> utilisation dans les templates
```

* https://codex.wordpress.org/Function_Reference/register_nav_menu/
* https://developer.wordpress.org/reference/functions/wp_nav_menu/

### Template de page d'accueil et template index.php pour la boucle

Créé un template `front-page.php` pour la page d'accueil après avoir défini une page et modifié les préférences d'affichage de Wordpress : reglages -> lecture -> page d'accueil statique en précisant la page 'accueil' créée pour l'occasion.

    index.php      -> nouveau contenu avec la boucle (voir ci-dessous)
    front-page.php -> contenu actuel de index.php
    header.php
    footer.php

Dans `index.php` on a modifié le contenu pour se servire de la boucle de Wordpress :

    <?php if (have_posts()) : ?>
        <!-- S'il y a des articles à afficher -->
        
        <?php while (have_posts()) : the_post(); ?>
            <!-- Tant qu'il trouvera des articles, il exécutera les instructions suivantes pour chaque article -->
            <div class="post">
                <h3 class="post-title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h3>
                <p class="post-info">
                    Posté le <?php the_date(); ?> dans <?php the_category(', '); ?> par <?php the_author(); ?>.
                </p>
                <div class="post-content">
                    <?php if(is_single() || is_page() ) {
                        the_content();
                    } else {
                        the_excerpt();
                    }
                    ?>
                </div>
            </div>
        <?php endwhile; ?>
        <!-- Fin de la boucle while -->
    <?php else : ?>
        <!-- S'il n'y a pas d'articles à afficher -->
        <p class="nothing">
            Il n'y a pas d'Articles à afficher !
        </p>
    <?php endif; ?> 

* liste des templates tags:
* https://codex.wordpress.org/Template_Tags

### Templates pour les pages,et les articles

On peut utiliser `index.php` pour gérer l'ensemble des affichages, mais on peut également créer des templates pour chaque type de post (page détail)

Création des templates pour des affichages spécifiques :

    single.php
    page.php

Une fois ces fichiers créés, on peut personnalisé l'affichage de chaque template.

### Templates pour les catégories et les tags

    archive.php

Ce template permet de modifier l'affichage des listes d'articles (posts)



### Ajouté des zones de widgets dans le footer (sidebar)

    `register_sidebar()`  //-> déclare la sidebar dans le fichier functions.php
    `dynamic_sidebar()`   //-> utilisation dans les templates. 

Ne pas confondre avec `get_sidebar()` qui récupère le template `sidebar.php`


### Post thumbnails

Pour rendre notre thème compatible avec les images à la une, il faut déclarer le support de la fonction dans le fichier `functions.php`

* https://developer.wordpress.org/reference/functions/add_theme_support/
* Dans `functions.php` ajouter le support des thumbnails

```
    add_theme_support( 'post-thumbnails', array( 'post' ) );
    // le deuxième paramètre définit dans quels type de post la fonction est activée, ici uniquement les 'post' (pas les pages)
```

* Pour afficher les images dans un template (ici single.php)

```
    <?php 
        //affiche l'image de l'article
        if ( has_post_thumbnail() ) {
            the_post_thumbnail();
        }
     ?>
```

* Pour créer un format d'image spécifique au thème :

dans `functions.php` :
    
```
    add_image_size( 'post-wide-thumbnail', 400, 140, true );
    //(slug de l'image, largeur, hauteur, recadrage);
```

* Il faut ensuite regénérer les thumbnails avec l'aide de l'extension 'regenerate thumbnails' (à installer) pour recréer toutes les miniatures avec les nouvelles tailles d'image
* On précise dans le template le slug de la taille d'image que l'on souhaite utiliser (ici dans `single.php`):
 
```
    the_post_thumbnail('post-wide-thumbnail');
```

* Il faut ensuite ajouter des images à la une dans le champ correspondant dans les page d'éditions des articles, dans l'administration de Wordpress.

### Template de page

* On crée un template `sidebar.php` pour pouvoir l'appeler dans notre template de page
* On modifie le du template `page.php` ainsi :

```
    <?php get_header(); ?>
    <section>
        <div class="wrapper">
            <div class="container">
                <article class="page-content">
                
                <?php if (have_posts()) : ?>
                <!-- S'il y a des articles à afficher -->
                
                    <?php while (have_posts()) : the_post(); ?>
                        <!-- Tant qu'il trouvera des articles, il exécutera les instructions suivantes pour chaque article -->
                        <div class="post">
                            <h3 class="post-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>
                            
                            <div class="post-content">
                                <?php 
                                    the_content();
                                ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                    
                <?php endif; ?>
                </article>
                <aside class="sidebar">
                    <!-- ici on inclus le template de la sidebar -->
                    <?php get_sidebar(); ?>
                </aside>
            </div>
            
        </div>
    </section>
    <?php get_footer(); ?>
```

Il faut ensuite créer une nouvelle zone de widget dans function.php et l'appeler dans notre sidebar.php pour afficher les widgets.


### Création d'une boucle modifiée dans un template

C'est grâce aux paramètres de la fonction `query_posts` que nous pouvons modifier la boucle principale de Wordpress.

Prenons l'exemple du template `category.php` . Si nous souhaitons que ce template affiche une liste paginée de 20 articles maximum, voilà comment nous appellerons la boucle Wordpress :

```
    <!-- Include appelant le fichier header.php -->
    <?php get_header(); ?>
    
    <div class="content">
        <?php query_posts('posts_per_page=20'); ?>
        <!-- On modifie la requête par défaut de la boucle Wordpress -->
        <!-- On demande à la boucle par défaut d'afficher 20 articles par page -->
        <?php get_template_part('loop'); ?>
        <!-- On appelle la boucle : loop.php -->
    </div>
    
    <?php wp_reset_postdata(); ?>
    <!-- On restaure la boucle à son fonctionnement par défaut -->
    
    <?php get_sidebar(); ?>
    <?php get_footer(); ?>
```

La fonction `WP_Query` permet de créer des boucles multiples mais est plus complexe à paramétrer car elle crée des objets. 

Selon la documentation officielle, on peut parfaitement utiliser la fonction `query_posts()` à condition de la réinitialiser grâce à la fonction `wp_reset_postdata()` .

## Les types de contenus personnalisés

Wordpress contient, par défaut, 2 types de contenus :

**les Articles (post)** 

qui sont des contenus "dynamiques" qui peuvent être listés selon différentes clés de tri : date, auteur, catégorie, étiquette...

**les Pages** 

qui sont des contenus plus "statiques" peuvent être hiérarchisées et ordonnées.

Voir dans le codex: [register_post_type](https://codex.wordpress.org/Function_Reference/register_post_type)

Par exemple, vous souhaitez créer un type de Contenu intitulé Projets qui listera tous les projets auxquels a contribué une entreprise ou une personne.

Dans functions.php on utilise register_post_type()

C'est la propriété `capability_type` qui détermine si votre nouveau contenu fonctionnera comme `post` (un article) ou bien comme `page` (une page).

Dans `functions.php` :

```
    <?php
        /*enregistrement d'un nouveau custom post type*/
        add_action('init', 'my_custom_init');
        function my_custom_init() {
            register_post_type(
                'projet',
                array(
                    'label' => 'Projets',
                    'labels' => array(
                    'name' => 'Projets',
                    'singular_name' => 'Projet',
                    'all_items' => 'Tous les projets',
                    'add_new_item' => 'Ajouter un projet',
                    'edit_item' => 'Éditer le projet',
                    'new_item' => 'Nouveau projet',
                    'view_item' => 'Voir le projet',
                    'search_items' => 'Rechercher parmi les projets',
                    'not_found' => 'Pas de projet trouvé',
                    'not_found_in_trash'=> 'Pas de projet dans la corbeille'
                ),
                'public' => true,
                'capability_type' => 'post', //définit le type hérité de post ou page
                'supports' => array(
                    'title',
                    'editor',
                    'thumbnail'
                ),
                'has_archive' => true
            )
        );
    }
    
    ?>
```

## custom taxonomies

Pour créer des custom taxonomies :  `register_taxonomy();`
Dans `functions.php` :

```
        <?php
        /*
            création d'une custom taxonomy 'type'
            pour le custom post type 'projet'
        */
        register_taxonomy(
            'type',
            'projet',
            array(
                'label' => 'Types',
                'labels' => array(
                    'name' => 'Types',
                    'singular_name' => 'Type',
                    'all_items' => 'Tous les types',
                    'edit_item' => 'Éditer le type',
                    'view_item' => 'Voir le type',
                    'update_item' => 'Mettre à jour le type',
                    'add_new_item' => 'Ajouter un type',
                    'new_item_name' => 'Nouveau type',
                    'search_items' => 'Rechercher parmi les types',
                    'popular_items' => 'Types les plus utilisés'
                ),
                'hierarchical' => true
            )
        );
        /*
            création d'une custom taxonomy 'couleur'
            pour le custom post type 'projet'
        */
        register_taxonomy(
            'couleur',
            'projet',
            array(
                'label' => 'Couleurs',
                'labels' => array(
                    'name' => 'Couleurs',
                    'singular_name' => 'Couleur',
                    'all_items' => 'Toutes les couleurs',
                    'edit_item' => 'Éditer la couleur',
                    'view_item' => 'Voir la couleur',
                    'update_item' => 'Mettre à jour la couleur',
                    'add_new_item' => 'Ajouter une couleur',
                    'new_item_name' => 'Nouvelle couleur',
                    'search_items' => 'Rechercher parmi les couleurs',
                    'popular_items' => 'Couleurs les plus utilisées'
                ),
                'hierarchical' => false
            )
        );
        
        //On crée les liens entre les taxonomies et le custom post type
        register_taxonomy_for_object_type( 'type', 'projet' );
        register_taxonomy_for_object_type( 'couleur', 'projet' );
        
    ?>
```

### Exemple de déclaration d'un nouveau champ

Dans l'exemple ci-dessous, nous ajoutons un champ personnalisé à tous les contenus SAUF les Pages (il est tout à fait possible de créer plusieurs champs personnalisés, il suffira de "dupliquer" la fonction `add_post_meta` autant de fois que nécessaire

```
    <?php
    
        add_action('wp_insert_post', 'mes_champs_personnalises');
        
        function mes_champs_personnalises ($post_id) {
            if ( $_GET['post_type'] != 'page' ) {
                add_post_meta($post_id, 'champ_perso_1', 'valeur_par_defaut', true);
            }
            return true;
        }
    ?>
```

Ne pas oublier de modifier les capabilities du custom-post pour qu'il puisse afficher les custom-fieds

Dans la déclaration du custom post :

    'supports' => array(
        'title',
        'editor',
        'thumbnail',
        'custom-fields' //<--- ici on ajoute le support des custom-fields
    ),

-  La fonction `add_post_meta` comprend plusieurs paramètres :
-  `$post_id` est le numéro identifiant l'article il est passé dynamiquement à la fonction
-  `champ_perso_1` est la chaine de caractère qui correspond au nom de la métadonnée.
-  `valeur_par_defaut` peut être vide et indique la valeur par défaut du champ personnalisé créé. Si vous ne souhaitez pas de valeur par défaut, laissez simplement les deux apostrophes vides.
-  `true` dans ce cas, la fonction renverra un résultat simple sous la forme d'une chaîne de caractère.

### Utilisation des champs personnalisés

Pour utiliser et afficher ces métadonnées dans un template Wordpress, on appelle la fonction suivante : `<?php the_meta(); ?>` 

 **ATTENTION :** cette balise est à utiliser impérativement au sein de la Boucle Wordpress.

La fonction `the_meta()` de Wordpress permet d'afficher les champs personnalisés sous forme de **liste non ordonnée** :

    <ul class='post-meta'>
        <li><span class='post-meta-key'>Votre champ personnalisé : </span> Valeur du champ personnalisé</li>
    </ul>

Pour pouvoir récupérer les informations d'un champ personnalisé, on utilise la fonction suivante:

    <?php
        get_post_meta($post_id, $cle, $unique);
    ?>

-  `$post_id` est le numéro identifiant l'article dont vous voulez récupérer les métadonnées.
-  `$cle` est la chaine de caractère qui contient le nom de la métadonnée dont vous voulez récupérer la valeur.
-  `$unique` peut être soit `true` (vrai) ou `false` (faux). Si la valeur est vraie, la fonction renverra un résultat simple sous la forme d'une chaîne de caractère. Si la valeur est fausse ou non précisée, la fonction renverra un tableau.

### Gestion des métas avancées avec ADF

https://www.advancedcustomfields.com

Advanced Custom Fields est une extension de Wordpress payante, mais également disponible avec des fonctionnalités restreintes en version gratuite.
Elle permet une meilleure gestion des champs personnalisés dans Wordpress.

Par exemple, pour créer un champ personnalisé de type texte :

https://www.advancedcustomfields.com/resources/text/

Utilisation du champ dans le template :

    <h2><?php the_field('text'); ?></h2>

Ici `text` est à remplacer par le nom du champ défini dans l'interface d'administration du plugin.


