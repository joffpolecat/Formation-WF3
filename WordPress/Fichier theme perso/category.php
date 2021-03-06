<?php get_header(); ?>

		<div id="contenu-blog">
			<section id="section-hentry" class="wrapper">
                <header>
                    <h1><?php single_cat_title( 'Catégorie : ' ); ?></h1>
                </header>
				<?php 
				/*
					Avant tout ça, il y a la query (qu'on ne voit pas)
					La requête de WordPress remplit un objet et des fonctions avec des paramètres préétablis qui permet d'afficher le contenu d'un ou plusieurs articles dans la boucle

                    Modifier les paramètres de la boucle principale
                */ 

                    // CHANGER LE NOMBRE D'ARTICLES DANS LA PAGE

                    // $args = array(
                    //     'posts_per_page' => 2
                    // );

                    // ATTENTION, ne pas utiliser dans un thème ou alors redéfinir sois-même tous les arguments de la boucle
                    query_posts( 'posts_per_page=2' );

                   

					if ( have_posts() ) 
					{
						// Tant qu'il reste quelque chose à afficher, continue
						while ( have_posts() ) 
						{
							// Définit le contenu courant de l'article
							the_post(); 
				?>
							<article id="post-<?php the_ID(); ?>" <?php post_class();?>>
								<div class="hentry-container">
									<?php 
										the_post_thumbnail(
											'marble-thumbnail', 
											array
											(
											'class'=>'hentry-thumbnail'
											)
										); 
									?>
									<div class="hentry-text">
										<!-- 
										On utilise les templates tags à l'intérieur de la boucle pour afficher les contenue dynamiques de l'article en cours de génération
									-->
									<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
									<p class="metas">Mise en ligne le: <?php the_date();?> / par: <?php the_author();?> / Dans: <?php the_category(', '); ?></p>

									<p><?php the_excerpt(); ?></p>
									</div>									
								</div>
							</article>
				<?php			
						} // end while
				?>
				<div class="pagination container">
					<div class="col">
						<?php 
							if( get_previous_posts_link() ) :
								previous_posts_link( 'Page précédente', 0 );
							endif;
						?>
					</div>
					<div class="col" style="text-align: right">
						<?php
							if( get_next_posts_link() ) :
								next_posts_link( 'Page suivante', 0 );
							endif;
						?>
					</div>

					
				</div>
				<?php
					} 
					// Si aucun article est publié :
					else
					{
						echo '<p>Pas d\'articles pour le moment </p>';
                    } // end if
                    
                    // Rétablissement des paramètres de la boucle par défaut
                    wp_reset_postdata();
				?>
			</section>
			<div class="sidebar">
			<!-- /?php get_sidebar('nice-bar'); ?> -->
			<?php dynamic_sidebar( 'main-sidebar' ); ?> 
			</div>
		</div>
		

<?php get_footer(); ?>