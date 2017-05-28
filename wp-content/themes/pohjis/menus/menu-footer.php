<?php
/**
 * Footer menu.
 *
 * @package Pohjis
 */

if ( has_nav_menu( 'footer' ) ) : // Check if there's a menu assigned to the 'footer' location. ?>

	<nav id="bottom-navigation" class="bottom-navigation menu-navigation" role="navigation" aria-label="<?php esc_html_e( 'Bottom navigation', 'pohjis' ); ?>">
		<?php
			wp_nav_menu(
				array(
					'theme_location'  => 'footer',
					'container_class' => 'bottom-menu-wrapper',
					'menu_id'         => 'bottom-menu',
					'menu_class'      => 'bottom-menu',
					'depth'           => 1,
				)
			);
		?>
	</nav><!-- .bottom-navigation -->

<?php endif; // End check for menu.
