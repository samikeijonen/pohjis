<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Pohjis
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'pohjis' ); ?></a>

	<header id="masthead" class="site-header" role="banner">

		<div id="site-branding-menu-wrapper" class="site-branding-menu-wrapper">
			<div class="wrapper">
				<div class="grid-wrapper">
					<div class="site-branding">
						<?php
						// Site title.
						if ( is_front_page() && is_home() ) : ?>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php else : ?>
							<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php endif; ?>
					</div><!-- .site-branding -->

					<?php
						get_template_part( 'menus/menu', 'primary' ); // Loads the menus/menu-primary.php template.
					?>

				</div><!-- .grid-wrapper -->
			</div><!-- .wrapper -->
		</div><!-- .site-branding-menu-wrapper -->

		<?php if ( ! is_singular( array( 'post', 'page' ) ) || is_page_template() ) : ?>
		<div id="site-header-image" class="site-header-image">
			<div class="wrapper">
				<div class="grid-wrapper">
					<div class="header-image-content">
					<?php
					// Page title.
					if ( is_archive() ) :
						the_archive_title( '<h1 class="page-title">', '</h1>' );
						the_archive_description( '<p class="archive-description">', '</p>' );

					elseif ( is_search() ) : ?>

						<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'pohjis' ), '<span>' . get_search_query() . '</span>' ); ?></h1>

						<?php elseif ( is_singular() || is_home() ) : ?>
							<h1 class="page-title"><?php single_post_title(); ?></h1>
							<?php
							if ( function_exists( 'the_subtitle' ) ) :
								the_subtitle( '<p class="entry-subtitle archive-description">', '</p>' );
							endif;

							// Call to action.
							$cta_text = pohjis_get_post_meta( $id, 'header_cta_text' );
							$cta_link = pohjis_get_post_meta( $id, 'header_cta_link' );

							if ( isset( $cta_text ) && $cta_text && isset( $cta_link ) && $cta_link ) :
								echo '<p class="center-block"><a class="button button-3" href="' . esc_url( $cta_link ) . '">' . esc_html( $cta_text ) . '</a></p>';
							endif;
						endif;
						?>
					</div><!-- .header-image-content -->
				</div><!-- .grid-wrapper -->
			</div><!-- .wrapper -->

			<?php
			// Breadcrumb Trail.
			if ( function_exists( 'breadcrumb_trail' ) ) :
				breadcrumb_trail( array(
					'show_on_front' => false,
					'show_browse' => false,
				) );
			endif;
			?>

		</div><!-- .site-header-image -->
	<?php endif; ?>

	</header><!-- #masthead -->

	<div id="content" class="site-content">
