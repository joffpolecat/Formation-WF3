# Développer un thème WordPress

## Pourquoi créer un thème ?

- Créer un style unique pour son site internet
- Maîtriser parfaitement le code de son site
- Savoir créer des templats de page pour créer des mises en page spécifiques que ne proposent pas de thèmes standards


> Extension Visual Studio Code : Wordpress Devlopment


## Récap fonctions

- `<?php get_header(); ?>` **Permet d'inclule le fichier `header.php` dans le template**
- `<?php get_footer(); ?>` **Permet d'inclule le fichier `footer.php` dans le template**
- `<?php language_attributes(); ?>` **TEXT**
- `<?php bloginfo( 'charset' ); ?>` **TEXT**
- `<?php bloginfo( 'pingback_url' ); ?>` **Permet d'autoriser les liens de notification d’autres blogs (pings et rétroliens) sur les nouveaux articles**
- `<?php echo esc_url( get_template_directory_uri() ); ?>` **Fonction de protection**
- `<?php wp_head(); ?>` **Pour que WordPress fonctionne correctement**
- `<?php body_class(); ?>` **Permet de générer les classes dynamiquement**
- `<?php wp_footer(); ?>` **Génère les scripts js qui seront dans le pied de page (et d'autres include,...)**