<?php
/**
 * Featured menu.
 *
 * @package Pohjis
 */
?>

<?php if ( has_nav_menu( 'featured' ) ) : // Check if there's a menu assigned to the 'featured' location. ?>

	<div class="menu-featured-section front-page-section section">
		<div class="wrapper wrapper-smaller-center">
			<nav class="menu-featured menu-navigation menu clear" role="navigation" aria-label="<?php esc_attr_e( 'Featured Menu', 'pohjis' ); ?>">

				<?php wp_nav_menu(
					array(
						'theme_location'  => 'featured',
						'container_class' => 'featured-menu-wrapper',
						'menu_id'         => '',
						'menu_class'      => 'menu-featured-items',
						'depth'           => 1,
					)
				); ?>

			</nav><!-- .menu-featured -->
		</div><!-- .menu-featured-section -->
	</div><!-- .wrapper -->

<?php endif; // End check for menu.
