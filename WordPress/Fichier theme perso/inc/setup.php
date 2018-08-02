<?php

/*
    Configuration des options et des capacités du thème
*/ 
function marble_setup()
{
    /*
        Déclarer les menus du thème avec register_nav_menu()
        Plus tard dans le thème pour afficher les menus on utilisera wp_nav_menu()
    */
    register_nav_menus( array (
        'main_menu' => 'Menu principal',
        'footer_menu' => 'Menu du pied de page'
    ));


    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );


    /*
    * Let WordPress manage the document title.
    * By adding theme support, we declare that this theme does not use a
    * hard-coded <title> tag in the document head, and expect WordPress to
    * provide it for us.
    */
    add_theme_support( 'title-tag' );


    /*
    * Enable support for Post Thumbnails on posts and pages.
    *
    * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
    */
    add_theme_support( 'post-thumbnails' );
    add_image_size( 'marble-thumbnail', 350, 200, 1 );
    add_image_size( 'marble-title', 1170, 300, 1 );
    add_image_size( 'marble-home-thumbnail', 380, 270, 1 );


    /*
    * Switch default core markup for search form, comment form, and comments
    * to output valid HTML5.
    */
    add_theme_support(
        'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        )
    );


}
add_action( 'after_setup_theme', 'marble_setup');







/*
    Changer le rendu du texte [...] de l'excerpt (résumé de l'article)

    @param string $more le texte par défaut de l'excerpt "more"
    @return string une nouvelle chaîne HTML pour l'excerpt "more"
*/
function marble_excerpt($more)
{
    global $post;
    return '<p><a class="more-link" href="' . get_permalink($post->ID) . '">Lire la suite</a></p>';
}
add_filter( 'excerpt_more', 'marble_excerpt' );







/**
 * Déclaration d'une zone de widget pour la sidebar
 */
function marble_widgets_init() {

    // Sidebar principale
    register_sidebar( array(
        'name' => 'Sidebar principale',
        'id' => 'main-sidebar',
        'description' => 'La Sidebar qui apparaît à droite du contenu sur les pages de liste d\'actualité',
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget'  => '</li>',
        'before_title'  => '<h2 class="widgettitle">',
        'after_title'   => '</h2>',
    ) );

    // Sidebar du footer
    register_sidebar( array(
        'name' => 'Sidebar du footer',
        'id' => 'footer-sidebar',
        'description' => 'La Sidebar qui apparaît à droite du contenu sur les pages de liste d\'actualité',
        'before_widget' => '<div id="%1$s" class="widget %2$s col">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widgettitle">',
        'after_title'   => '</h4>',
    ) );
}
add_action( 'widgets_init', 'marble_widgets_init' );