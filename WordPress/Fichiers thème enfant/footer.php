<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>

	</div><!-- .site-content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<?php
				/**
				 * Fires before the Twenty Fifteen footer text for footer customization.
				 *
				 * @since Twenty Fifteen 1.0
				 */
				do_action( 'twentyfifteen_credits' );
			?>
			<?php
			if ( function_exists( 'the_privacy_policy_link' ) ) {
				the_privacy_policy_link( '', '<span role="separator" aria-hidden="true"></span>' );
			}
			?>
			<a href="http://www.webforce3.com" target="blank">Fièrement créé par Webforce3</a>

			<!-- COPIÉ-COLLÉ DE LA FONCTION PRÉSENTE DANS SIDEBAR.PHP -->
			<?php if ( has_nav_menu( 'footer' ) ) : ?>
				<nav id="site-navigation" class="footer-navigation" role="navigation">
					<?php
						// footer navigation menu.
						wp_nav_menu(
							array(
								'menu_class'     => 'nav-menu',
								'theme_location' => 'footer',
							)
						);
					?>
				</nav><!-- .footer-navigation -->
			<?php endif; ?>


		</div><!-- .site-info -->
	</footer><!-- .site-footer -->

</div><!-- .site -->

<?php wp_footer(); ?>

</body>
</html>
