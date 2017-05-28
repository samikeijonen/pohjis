<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Pohjis
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<?php
				// Footer title and text.
				$footer_title = get_theme_mod( 'footer_title' );
				$footer_text  = get_theme_mod( 'footer_text' );

				// If Polylang plugin is used, get translations also.
				if ( function_exists( 'pll__' ) ) :
					if ( $footer_title ) :
						echo '<h2 class="footer-title heading-one">' . esc_html( pll__( $footer_title ) ) . '</h2>';
					endif;

					if ( $footer_text ) :
						echo '<p class="footer-text">' . esc_html( pll__( $footer_text ) ) . '</p>';
					endif;

				else :
					if ( $footer_title ) :
						echo '<h2 class="footer-title">' . esc_html( $footer_title ) . '</h2>';
					endif;

					if ( $footer_text ) :
						echo '<p class="footer-text">' . esc_html( $footer_text ) . '</p>';
					endif;
				endif;
			?>

			<?php
				// Featured menu.
				get_template_part( 'menus/menu', 'featured' );

				// Social menu.
				get_template_part( 'menus/menu', 'social' );

				// Footer menu.
				get_template_part( 'menus/menu', 'footer' );
			?>

		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
