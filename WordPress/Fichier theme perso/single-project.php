<?php get_header(); ?>

<section id="section-hentry" class="wrapper">
	
		
		
		<?php # ici, on va chercher the loop sur le codex 
	
		// la requête WP remplit un objet et des fonctions avec des paramètres préétablis qui permet d'afficher le contenu des articles/pages dans la boucle

		// teste s'il y a des articles/pages à afficher :  
		if ( have_posts() ) {
			// tant qu'il reste des choses à afficher :
			while ( have_posts() ) {
				// définit le contenu courant de l'article :
				the_post(); 
				
				# Post Content here

		?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<!-- utilisation des template tags à l'intérieur de la boucle pour afficher les contenus dynamiques de l'article en cours de génération :	 -->
			<h1><?php the_title(); ?></h1>
			
            <p class="metas">Mis en ligne le <?= get_the_date(); ?> par <?php the_author(); ?> dans <?php the_category(' / ') ?></p>
            
            <h5><?php the_terms( get_the_ID(), 'project_type', 'Catégories de projets : ', ' / ' ); ?></h5>

			<?php the_post_thumbnail('marble-inside', 
			array('class'=> 'article-thumbnail')
			); ?>

			<p><?php the_content(); ?></p>

			<!-- Liste tous les champs personnalisés associés à l'article osus la forme d'une liste non-ordonnées : -->
			<!-- ?php the_meta(); ?> -->

			<!-- Affiche la valeur du champ perso 'project_year' : -->
			<!-- <p>Année de réalisation :?=	get_post_meta( get_the_ID(), 'project_year', true );?></p> -->

			<?php
				//Get raw date
				$date = get_field('date_de_realisation', false, false);

				// Make date object
				$date = new DateTime($date);

			?>

			<p>Date du projet: <?php echo $date->format('j M Y'); ?></p>
			<p>Lieu de réalisation: <?php the_field('lieu_de_realisation'); ?></p>

			
		</article>

		<?php 				
			} # end while
		} # end if

		
		?>

	
</section>

<?php get_footer(); ?>