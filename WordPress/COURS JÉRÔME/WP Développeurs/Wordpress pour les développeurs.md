# Wordpress pour les développeurs

## La Boucle Wordpress

Wordpress a été initialement conçu comme un éditeur de blog, la page d'accueil affichait une liste d'articles et l'on pouvait également afficher des Pages statique de type "A propos de l'auteur" ou "Contact".

Si désormais Wordpress permet de concevoir tout type de site, il a conservé ce fonctionnement basé sur 2 types de contenus : les Articles et les Pages.

Lorsqu'on veut afficher une liste d'Articles, on utilise la boucle Wordpress. Cette boucle exécute une série d'instructions permettant d'afficher tout ou partie du contenu de chaque article enregistré dans la base de données.

Si, par défaut, la boucle utilise certains critères (tous les articles de toutes les catégories paginés - 10 articles par page), on peut modifier ces critères au niveau du code des templates.

### Exemple de code standard

Par défaut, la boucle de Wordpress fonctionne comme ceci :

	<?php if (have_posts()) : ?>
		<!-- S'il y a des articles à afficher -->
		<p class="title">
			Il y a des Articles à afficher !
		</p>
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
					<?php the_content(); ?>
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

### Création d'une boucle modifiée dans un template

C'est grâce aux paramètres de la fonction `query_posts` que nous pouvons modifier la boucle principale de Wordpress.

Prenons l'exemple du template `category.php` . Si nous souhaitons que ce template affiche une liste paginée de 20 articles maximum, voilà comment nous appellerons la boucle Wordpress :

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

La fonction `WP_Query` permet de créer des boucles multiples mais est plus complexe à paramétrer car elle crée des objets. 

Selon la documentation officielle, on peut parfaitement utiliser la fonction `query_posts()` à condition de la réinitialiser grâce à la fonction `wp_reset_postdata()` .

## Les types de contenus personnalisés

Wordpress contient, par défaut, 2 types de contenus :

**les Articles** 

qui sont des contenus "dynamiques" qui peuvent être listés selon différentes clés de tri : date, auteur, catégorie, étiquette...

**les Pages** 

qui sont des contenus plus "statiques" peuvent être hiérarchisées et ordonnées.

Voir dans le codex: [register_post_type](https://codex.wordpress.org/Function_Reference/register_post_type) 

Si les Articles sont des types de contenus adaptables à de multiples cas de figures, vous pouvez créer des types de contenus personnalisés dans Wordpress.

Par exemple, vous souhaitez créer un type de contenu intitulé 'projet' qui listera tous les projets auxquels a contribué une entreprise ou une personne.

C'est dans le fichier `functions.php ` que nous allons déclarer et activer notre nouveau type de contenu personnalisé.

C'est la propriété `capability_type` qui détermine si votre nouveau contenu fonctionnera comme `post` (un article) ou bien comme `page` (une page).

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

## Les catégories et étiquettes personnalisées

C'est la propriété hierarchical qui permet de déterminer si la nouvelle taxonomie créée est une catégorie (true) ou une étiquette (false).

De la même façon que pour un contenu personnalisé, on déclare les nouvelles catégories ou étiquettes juste après la fonction `register_post_type`.

Dans l'exemple ci-dessous, nous allons étoffer le contenu précédemment créé (les projets) par une nouvelle catégorie "type de projet" et une nouvelle étiquette une "couleur".

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

La fonction `the_taxonomies()` de Wordpress permet d'afficher toutes les taxonomies personnalisés associées à un post.

La fonction `the_terms($post_id, 'nomdetaxonomie', 'début html', 'séparateur', 'fin html')` de Wordpress permet d'afficher l'une des taxonomies personnalisés associées à un post. Il faut spécifier ici la taxonomie que l'on souhaite afficher en deuxième argument de la fonction.


## Custom metas ou champs personnalisés

De la même façon que l'on crée des types de contenus personnalisés, on peut également créer des champs personnalisés dans Wordpress.

Les champs personnalisés permettent d'ajouter des métadonnées supplémentaires dans vos contenus, qu'il s'agisse d'Articles, de Pages ou de Contenus personnalisés. Ces métadonnées sont gérées par des paires clés/valeurs, où la clé représente le nom de la méta-donnée et la valeur contient l'information associée à cette métadonnée.

Les métadonnées ainsi créées pourront être affichées dans les contenus ou gardées en mémoire dans la base de données pour une utilisation en back-office. Par exemple, on peut utiliser ces métadonnées pour indiquer la date d'expiration d'un article pour la gestion du cache...

C'est encore dans le fichier `functions.php` que nous allons déclarer et activer un Champ personnalisé.

### Exemple de déclaration d'un nouveau champ

Dans l'exemple ci-dessous, nous ajoutons un champ personnalisé à tous les contenus SAUF les pages (il est tout à fait possible de créer plusieurs champs personnalisés, il suffira de "dupliquer" la fonction `add_post_meta` autant de fois que nécessaire.

	<?php
	
	add_action('wp_insert_post', 'mes_champs_personnalises');
	
	function mes_champs_personnalises ($post_id) {
		if ( $_GET['post_type'] != 'page' ) {
			add_post_meta($post_id, 'champ_perso_1', 'valeur_par_defaut', true);
		}
		return true;
	}
	?>

-  La fonction `add_post_meta` comprend plusieurs paramètres :
-  `$post_id` est le numéro identifiant l'article dont vous voulez récupérer les métadonnées.
-  `champ_perso_1` est la chaine de caractère qui correspond au nom de la métadonnée.
-  `valeur_par_defaut` peut être vide et indique la valeur par défaut du champ personnalisé créé. Si vous ne souhaitez pas de valeur par défaut, laissez simplement les deux apostrophes vides.
-  `true` dans ce cas, la méta donnée est unique.


### Utilisation des champs personnalisés

Pour utiliser et afficher ces métadonnées dans un template Wordpress, on appelle la fonction suivante : `<?php the_meta(); ?>` 

 **ATTENTION :** cette balise est à utiliser impérativement au sein de la Boucle Wordpress.

La fonction `the_meta()` de Wordpress permet d'afficher les champs personnalisés sous forme de **liste non ordonnée** :

	<ul class='post-meta'>
		<li><span class='post-meta-key'>Votre champ personnalisé : </span> Valeur du champ personnalisé</li>
	</ul>

### Récupérer les champs personnalisés

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


## Les requêtes personnalisées

Wordpress implémente une classe wpdb qui contient de nombreuses méthodes permettant de manipuler les données de la base en toute sécurité. Cette classe permet aux développeurs de thèmes ou de plugins d'interfacer leur code avec la base de données.

### La classe wpdb

La classe wpdb est toujours instanciée au chargement de Wordpress, elle est stockée dans une variable globale `$wpdb` . Pour des raisons de performance et de sécurité, n'utilisez jamais un autre objet pour communiquer avec la base de données. Pour l'utiliser dans votre code, il suffit d'utiliser l'instruction suivante :

	<?php
		global $wpdb;
	 ?>

### La propriété prefix

C'est la première propriété de `$wpdb` à connaître. En effet, une installation sécurisée de Wordpress commence par une modification du prefixe des tables par défaut proposé par Wordpress. 

Si je souhaite accéder à la table posts dans toutes les situations (préfixe de table modifié ou non) ** j'utiliserais l'instruction suivante** :

	<?php
	 $query = "SELECT * FROM {$wpdb->prefix}posts";
		/*
	 	Interroger la base de données avec get_results()
	 	On utilise la fonction get_results() pour interroger directement 
	 la base de données.
	 
	 	La requête ci-dessous permet d'afficher une liste présentant 
			le titre de chacun des articles enregistré dans la base de données
	 suivi d'un retour-ligne.
	 */
	 // Interrogation de la base de données
	 $resultats = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}posts") ;
	
	// Parcours des resultats obtenus
	 foreach ($resultats as $post) {
		 echo $post->post_title;
		 echo '<br/>';
	 }
	
	?>

### Sécuriser ses requêtes Wordpress

Wordpress permet de préparer ses requêtes. En effet, il faut penser à sécuriser un peu les données qui sont envoyées, à l’aide de la fonction prepare() qui va se charger de faire en sorte que les données envoyées sont bien du type attendu et d’échapper les chaînes de caractère afin d’éviter des injections SQL malintentionnées. 

L’idée est de remplacer dans toute requête les valeurs par des placeholders qui vont indiquer :

-  si la donnée est de type chaîne de caractères ( `%s` ), nombre entier ( `%d` ) ou nombre à virgule flottante ( `%f` ),
-  d’indiquer ensuite quelles seront les valeurs correspondantes, les unes après les autres.
-  C’est cette requête préparée qui est exécutée. Attention le caractère « `%` » devient problématique, il faut donc l’échapper en le remplaçant par « `%%` ».

**Voici, ci-après une requête préparée :** 

	<?php
		//récupération des lignes de la table
		$id = $_GET['id'];
		$resultats = $wpdb->get_results(
			$wpdb->prepare(
				"SELECT * FROM {$wpdb->prefix}ma_table WHERE id = %d",
				$id
			)
		);
		//Manipuler des données : ajouter, modifier, supprimer un enregistrement
		//$wpdb->insert() permet l'ajout d'enregistrement à la base de données,
		//$wpdb->update() permet la modification d'un enregistrement,
		//$wpdb->delete() permet de supprimer un enregistrement.
		 
		$wpdb->insert(
		 	$wpdb->prefix.'ma_table',
			array(
				'nom' => 'Machin',
				'prenom' => 'Paul',
				'date_naiss' => '1992-01-25',
				'nb_matchs' => 4
			),
			array(
				'%s',
				'%s',
				'%s',
				'%d'
			)
		);
	?>

## Functions.php et les extensions Wordpress

Le fichier `functions.php` contient toutes les fonctions personnalisées de votre site et agit comme s'il était le plugin principal de votre site Wordpress.

### Dans Wordpress, il faut distinguer plusieurs choses :

-  **les Widgets :** contiennent généralement 1 seule fonctionnalité que l'on peut afficher dans l'une des zones du thème prévue à cet effet. (généralement la sidebar ou le footer).
-  **les Extensions ou Plugins :** contiennent généralement une seule ou plusieurs fonctionnalités" permettant d'ajouter des fonctions à Wordpress _(par exemple : l'affichage des images dans une Lightbox)_ .
-  **Les Plugins** ont l'avantage de pouvoir être réutilisables sur plusieurs sites Wordpress. Certains plugins permettent également l'ajout de Widgets.
-  **le fichier** `functions.php` : permet d'ajouter les fonctionnalités directement dans le thème Wordpress sans passer par le biais d'un Widget ou d'un Plugin.

### Pourquoi choisir de développer un plugin plutôt que d'ajouter la fonction au fichier functions.php ?

Si vous êtes amenés à travailler sur un grand nombre de projets Wordpress qui nécessitent les mêmes fonctions, vous pouvez choisir de développer un plugin qu'il vous suffira de réinstaller pour pouvoir bénéficier des mêmes fonctions dans tous les sites Wordpress que vous serez amenés à développer.

### Modifier le code de Wordpress : Shortcodes et Hooks (actions et filtres)

### Les Shortcodes

Les shortcodes sont des bouts de code entre crochets que l'on peut directement insérer dans les contenus Wordpress. Certains shortcodes sont directement intégrés à Wordpress et d'autres sont ajoutés par certains plugins (comme Jetpack).

Un shortcode se présente ainsi `[nomDuShortcode attribut="valeur"]` 

Dans l'exemple ci-dessous, nous allons créer un shortcode dans le fichier `functions.php` . 

Le shortcode `[bonjour]` permettra d'afficher la phrase suivante : "Bonjour, ce texte a été écrit grâce à un shortcode !".

	<?php
		function sc_Bonjour($atts) {
			return '<p>Bonjour, ce texte a été écrit grâce à un shortcode !</p>';
		}
		add_shortcode("bonjour", "scBonjour");
	?>

### Les "hooks" Wordpress

Les développeurs de Wordpress permettent d'ajouter ses propres fonctionnalités ou de modifier les fonctionnalités d'origine par le biais de "hooks" (crochets ou hameçons en français).

Il existe 2 types de hooks : les **hooks d'actions** et les **hooks de filtres** .

-  **Les actions** permettent d'ajouter des fonctionnalités à un endroit précis durant le chargement d'une page (ex : ajouter un widget).
-  **Les filtres** permettent de modifier des données après le chargement de la page (ex : ajouter une classe CSS, modifier certains blocs HTML...).

**Exemple de hook action** 

L'action ci-dessous permet d'ajouter un bloc de texte promotionnel après le header de la page d'accueil :

	<?php
	
	//dans fonctions.php
	
	// Ajouter du texte après le header
	add_action( '__apres_header' , 'ajouter_texte_promo' );
	function ajouter_texte_promo() {
		// Vérifier qu'on est sur la page d'accueil
		if ( is_front_page() ) {
			echo "<div>Promotion du jour...</div>";
		}
	}
	
	?>

**Exemple de filtre :** 

	<?php
		//Le filtre ci-dessous permet de censurer certains mots dans le texted'un commentaire :
		function filtrer_mots_deplaces( $content ) {
			$motsAFiltrer = array('merde','con','...');
			$content = str_ireplace( $motsAFiltrer, '{censuré}', $content );
			return $content;
		}
		add_filter( 'comment_text', 'filtrer_mots_deplaces' );
	?>


## Mettre en ligne son site Wordpress

Mettre en ligne un site Wordpress c'est :

-  **transférer les fichiers du répertoire local au répertoire distant** (via un logiciel FTP).
-  **modifier le fichier** `wp-config.php` qui contient les identifiants qui permettent à Wordpress d'accéder à la base de données. Vous remplacerez les données d'accès locales par les infos d'accès à la base de données distante.
-  **tranférer la base de données locale vers la base de données distante** après l'avoir manuellement modifiée. En effet, la base de données contient les références absolues des URL de tous vos fichiers, articles, etc... Vous devrez modifier les adresses de chacune de ces références !

### PREMIERE METHODE : Transférer son site Wordpress en 5 mn avec Duplicator

Un plugin Wordpress sorti récemment permet désormais de transférer son site en quelques clics. Le plugin [Duplicator](https://fr.wordpress.org/plugins/duplicator/) est d'une efficacité sans pareille et résout tous les problèmes précédents de transfert de site.

Ce problème qui était un handicap pour Wordpress face à ses concurrents Drupal et Joomla est désormais résolu et on peut transférer son site en 5mn sans le moindre souci.



### AUTRE METHODE : Mettre à jour sa base de donnée avec Search Replace Database Script


1. Transférer les fichiers du site via FTP sur le serveur distant
2. Mettre à jour sur le serveur distant les fichiers `wp-config.php` et `.htaccess` avec les données du site distant (information de la base de donnée et chemin relatif du fichier index.php dans le .htaccess)
3. Dans le phpmyadmin du site local : Faire un export des données de la BDD du site local
4. Dans le phpmyadmin du site distant : Faire un import de la base de donnée
5. Télécharger le dossier du script Search-Replace Database 

Télécharger les fichiers à cette adresse :
https://github.com/interconnectit/Search-Replace-DB

6. Placer les fichiers du script à la racide du dossier d'installation de Wordpress (distant) dans un dossier `srdb` sur le serveur et se rendre à l'adresse suivante : http://nomdusite.com/srdb/ 
7. Effectuer l'assistant de mise à jour de la base de donnée en recherchant l'ancienne url du site et en la remplaçant par la nouvelle :

Exemple :

ancienne url : http://localhost/monsite
nouvelle url : http://www.monsite.com

8. Pour plus de sécurité, utiliser la fonction 'dry run' pour faire un test de remplacement. Puis faire un 'live-run' lorsqu'on est prêt.
9. Une fois ces opérations terminées, supprimer les fichiers du dossier `srdb` pour éviter les failles de sécurité !!!
10. Se connecter à son nouveau site à l'adresse http://www.monsite.com/wp-admin/ et aller à nouveau enregistrer la structure des permaliens dans la page Réglages/permaliens `options-permalink.php`

La migration est achevée.


