<?php get_header(); ?>

		<section class="jumbotron">
			<div class="wrapper">
				<h2>We are digital &amp; branding agency based in London.</h2>
				<h3>We love to turn great ideas into beautiful products.</h3>
				<a href="#" class="button">See portfolio</a>
			</div>
		</section>
		<!-- ./jumbotron -->

		
		<section id="section-icons" class="wrapper">
			<div class="container"><?php
					/*
						Créer une requête personnalisée pour interroger la BDD et sortir les 3 derniers post de type 'post' (actualité)
					*/
					$args = array( 
						'post_type' => 'items',
						'posts_per_page' => 4
					);
					$the_query = new WP_Query( $args );

					// Afficher les 3 derniers articles dans une boucle

					// The Query
					$the_query = new WP_Query( $args );

					// The Loop
					if ( $the_query->have_posts() ) {

						while ( $the_query->have_posts() ) {
							
							$the_query->the_post();
						//Code html de l'article 
				?>
							<div class="col">
								<i class="icon lamp"></i>
								<h4><?php the_title(); ?></h4>
								<!-- Lister les termes de la custom taxonomie 'project-type' pour le post courant de type 'project' -->
								<h5><?php the_terms( get_the_ID(), 'project_type', 'Type de projet : ', ', '); ?></h5>
								<p><?php the_excerpt(); ?></p>
							</div>
							

				<?php
						}
						/* 
							Restaure les données de la boucle standard
							Réinitialisation des données de la requête à la fin de chaque appel de la boucle personnalisée
						*/
						wp_reset_postdata();
					} else {
						// no posts found
						echo '<p>Pas d\'article pour l\'instant</p>';
					}
				?>
			</div>	
			<hr/>

		</section>



		<section id="section-latest-work" class="wrapper">
			<h3>Our latest works</h3>
			<div class="container">
				<?php
					/*
						Créer une requête personnalisée pour interroger la BDD et sortir les 3 derniers post de type 'post' (actualité)
					*/
					$args = array( 
						'post_type' => 'project',
						'posts_per_page' => 3
					);
					$the_query = new WP_Query( $args );

					// Afficher les 3 derniers articles dans une boucle

					// The Query
					$the_query = new WP_Query( $args );

					// The Loop
					if ( $the_query->have_posts() ) {

						while ( $the_query->have_posts() ) {
							
							$the_query->the_post();
						//Code html de l'article 
				?>
							<article class="col">
							<?php 
								if( has_post_thumbnail() )
								{
									the_post_thumbnail('marble-home-thumbnail'); 
								}
								else
								{
									echo '<img src="' . get_template_directory_uri() . '/img/image1.jpg" alt="Business Card">';
								}
							?>
								<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
								<!-- Lister les termes de la custom taxonomie 'project-type' pour le post courant de type 'project' -->
								<h5><?php the_terms( get_the_ID(), 'project_type', 'Type de projet : ', ', '); ?></h5>
								<p><?php the_excerpt(); ?></p>
							</article>

				<?php
						}
						/* 
							Restaure les données de la boucle standard
							Réinitialisation des données de la requête à la fin de chaque appel de la boucle personnalisée
						*/
						wp_reset_postdata();
					} else {
						// no posts found
						echo '<p>Pas d\'article pour l\'instant</p>';
					}
				?>
			</div>
		</section>



		
		<section id="section-latest-article" class="wrapper">
			<h3>Our latest news</h3>
			<div class="container">
				<?php
					/*
						Créer une requête personnalisée pour interroger la BDD et sortir les 3 derniers post de type 'post' (actualité)
					*/
					$args = array( 
						'post_type' => 'post',
						'posts_per_page' => 3
					);
					$the_query = new WP_Query( $args );

					// Afficher les 3 derniers articles dans une boucle

					// The Query
					$the_query = new WP_Query( $args );

					// The Loop
					if ( $the_query->have_posts() ) {

						while ( $the_query->have_posts() ) {
							
							$the_query->the_post();
						//Code html de l'article 
				?>
							<article class="col">
							<?php 
								if( has_post_thumbnail() )
								{
									the_post_thumbnail('marble-home-thumbnail'); 
								}
								else
								{
									echo '<img src="' . get_template_directory_uri() . '/img/image1.jpg" alt="Business Card">';
								}
							?>
								<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
								<h5><?php the_category(', '); ?></h5>
								<p><?php the_excerpt(); ?></p>
							</article>

				<?php
						}
						/* 
							Restaure les données de la boucle standard
							Réinitialisation des données de la requête à la fin de chaque appel de la boucle personnalisée
						*/
						wp_reset_postdata();
					} else {
						// no posts found
						echo '<p>Pas d\'article pour l\'instant</p>';
					}
				?>
				<!-- <article class="col">
					<img src="?= get_template_directory_uri() ?>/img/image1.jpg" alt="Business Card">
					<h4>Nobis Business Card</h4>
					<h5>Business Cards, Graphics</h5>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
				</article>

				<article class="col">
					<img src="?= get_template_directory_uri() ?>/img/image2.jpg" alt="New fun project">
					<h4>New fun project</h4>
					<h5>Webdesign, Application</h5>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
				</article>
				
				<article class="col">
					<img src="?= get_template_directory_uri() ?>/img/image3.jpg" alt="Passionaries Branding Cover">
					<h4>Passionaries Branding Cover</h4>
					<h5>Branding, Graphic Design</h5>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
				</article> -->
			</div>
		</section>

<?php get_footer(); ?>