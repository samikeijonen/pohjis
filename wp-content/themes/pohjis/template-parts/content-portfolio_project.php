<?php
/**
 * Template part for displaying portfolio_project post type.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Pohjis
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( is_singular() && ! is_page_template( 'templates/teme-page.php' )  && ! is_page_template( 'templates/intro-page.php' ) ) : ?>

		<div class="entry-content">
			<?php
				the_content();
			?>
		</div><!-- .entry-content -->

	<?php else :

		get_template_part( 'template-parts/content', 'bg-post' );

	endif; ?>
</article><!-- #post-## -->
