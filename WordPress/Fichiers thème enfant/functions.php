<?php

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since Twenty Fifteen 1.0
 */

function twentyfifteen_setup() {

    /*
        * Make theme available for translation.
        * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/twentyfifteen
        * If you're building a theme based on twentyfifteen, use a find and replace
        * to change 'twentyfifteen' to the name of your theme in all the template files
        */
    load_theme_textdomain( 'twentyfifteen' );

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
    set_post_thumbnail_size( 825, 510, true );

    // This theme uses wp_nav_menu() in two locations.
    register_nav_menus(
        array(
            'primary' => __( 'Primary Menu', 'twentyfifteen' ),
            'social'  => __( 'Social Links Menu', 'twentyfifteen' ),
            'footer'  => __( 'Footer Menu', 'twentyfifteen' ) // Ajout d'un menu FOOTER
        )
    );

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

    /*
        * Enable support for Post Formats.
        *
        * See: https://codex.wordpress.org/Post_Formats
        */
    add_theme_support(
        'post-formats', array(
            'aside',
            'image',
            'video',
            'quote',
            'link',
            'gallery',
            'status',
            'audio',
            'chat',
        )
    );

    /*
        * Enable support for custom logo.
        *
        * @since Twenty Fifteen 1.5
        */
    add_theme_support(
        'custom-logo', array(
            'height'      => 248,
            'width'       => 248,
            'flex-height' => true,
        )
    );

    $color_scheme  = twentyfifteen_get_color_scheme();
    $default_color = trim( $color_scheme[0], '#' );

    // Setup the WordPress core custom background feature.

    /**
     * Filter Twenty Fifteen custom-header support arguments.
     *
     * @since Twenty Fifteen 1.0
     *
     * @param array $args {
     *     An array of custom-header support arguments.
     *
     *     @type string $default-color          Default color of the header.
     *     @type string $default-attachment     Default attachment of the header.
     * }
     */
    add_theme_support(
        'custom-background', apply_filters(
            'twentyfifteen_custom_background_args', array(
                'default-color'      => $default_color,
                'default-attachment' => 'fixed',
            )
        )
    );

    /*
        * This theme styles the visual editor to resemble the theme style,
        * specifically font, colors, icons, and column width.
        */
    add_editor_style( array( 'css/editor-style.css', 'genericons/genericons.css', twentyfifteen_fonts_url() ) );

    // Indicate widget sidebars can use selective refresh in the Customizer.
    add_theme_support( 'customize-selective-refresh-widgets' );
}