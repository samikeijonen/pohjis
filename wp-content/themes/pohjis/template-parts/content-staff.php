<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Pohjis
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( is_singular() && ! is_front_page() && ! is_singular( array( 'service' ) ) ) : ?>

		<header class="entry-header">
			<?php
				the_title( '<h1 class="entry-title">', '</h1>' );
			?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php
				the_content( sprintf(
					/* translators: %s: Name of current post. */
					wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'pohjis' ), array( 'span' => array( 'class' => array() ) ) ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				) );
			?>
		</div><!-- .entry-content -->

	<?php else : ?>

		<div class="entry-inner-contact">
			<header class="entry-header">
				<?php
				// Staff thumbnail.
				if ( has_post_thumbnail() ) :
					echo '<p class="entry-author">';
						the_post_thumbnail( 'pohjis-small' );
					echo '</p>';
				endif;

				// Title.
				the_title( '<p class="entry-title no-margin-bottom">', '</p>' );
				?>
			</header><!-- .entry-header -->

			<div class="entry-summary">
				<?php
					the_content();
				?>
			</div><!-- .entry-summary -->

		</div><!-- .entry-inner-wrapper -->

	<?php endif; ?>
</article><!-- #post-## -->
