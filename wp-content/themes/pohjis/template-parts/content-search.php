<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Pohjis
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-inner-wrapper">
		<header class="entry-header">
			<?php
			// Post thumbnail.
			if ( has_post_thumbnail() ) :
				echo '<p class="entry-author">';
					the_post_thumbnail( 'pohjis-small' );
				echo '</p>';
			endif;

			the_title( '<h2 class="entry-title heading-medium"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			?>
		</header><!-- .entry-header -->

		<div class="entry-summary">
			<?php
				the_excerpt();
			?>
		</div><!-- .entry-summary -->

		<div class="entry-footer">
			<?php echo valter_excerpt_more_link(); // Function can be found in inc/template-tags.php. ?>
		</div><!-- .entry-footer -->

	</div><!-- .entry-inner-wrapper -->
</article><!-- #post-## -->
