<?php
/**
 * Primary menu.
 *
 * @package Checathlon
 */

if ( has_nav_menu( 'primary' ) ) : // Check do we have primary menu. ?>
	<button id="menu-toggle" class="menu-toggle transparency-button" aria-controls="primary-menu" aria-expanded="false"><span class="burger-icon" aria-hidden="true"></span><span class="screen-reader-text"><?php esc_html_e( 'Menu', 'pohjis' ); ?></span></button>

	<nav id="site-navigation" class="site-navigation main-navigation menu-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary navigation', 'pohjis' ); ?>">
		<?php
			wp_nav_menu(
				array(
					'theme_location'  => 'primary',
					'container_class' => 'primary-menu-wrapper',
					'container_id'    => 'primary-menu-wrapper',
					'menu_id'         => 'primary-menu',
					'menu_class'      => 'primary-menu',
				)
			);
		?>
	</nav><!-- .site-navigation -->
<?php endif; // End check for primary menu.
