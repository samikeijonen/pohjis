<?php
/**
 * Template part for displaying any background image post (any post type).
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Pohjis
 */

// Get background image.
$bg = pohjis_get_post_thumbnail(); ?>
<div class="entry-inner entry-inner-bg"<?php if ( has_post_thumbnail() ) : ?> style="background-image:url('<?php echo esc_url( $bg[0] ); ?>');"<?php endif; ?>>
	<div class="bg-wrapper">
		<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
			<header class="entry-header">
				<?php the_title( '<h2 class="entry-title no-margin-bottom">', '</h2>' ); ?>
			</header>
		</a>
	</div>
</div>
