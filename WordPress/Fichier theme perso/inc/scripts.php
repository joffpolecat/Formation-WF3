<?php


/**
 * Proper way to enqueue scripts and styles.
 */
function wpdocs_theme_name_scripts() 
{
    // Inclure les styles du template 


    wp_enqueue_style( 'normalize', get_template_directory_uri() . '/css/normalize.css' );
    wp_enqueue_style( 'google-font', 'https://fonts.googleapis.com/css?family=Roboto|Roboto+Condensed:400,700|Roboto+Slab:400,700' );
    wp_enqueue_style( 'main-styles', get_template_directory_uri() . '/css/styles.css?v=' . uniqid() );
    // wp_enqueue_script( 'script-name', get_template_directory_uri() . '/js/example.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'wpdocs_theme_name_scripts' );

