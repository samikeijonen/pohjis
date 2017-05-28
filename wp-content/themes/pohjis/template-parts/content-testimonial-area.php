<?php
/**
 * Testimonial in a carousel.
 *
 * @package Pohjis
 */

// Start testimonial section.
$testimonial_bg = '';

$bg_style = '';
if ( $testimonial_bg ) :
	$bg_style = ' style = "
		background: linear-gradient( rgba(0, 102, 204, 0.80), rgba(0, 102, 204, 0.80) ),
			rgba(0, 102, 204, 0.80) url(' . esc_url( $testimonial_bg ) . ' ) no-repeat top center;
		"';
endif;

// Testimonial query args.
$testimonial_args = apply_filters( 'pohjis_testimonial_posts_arguments', array(
	'posts_per_page'         => 6,
	'post_type'              => 'testimonial',
	'post_status'            => 'publish',
	'orderby'                => 'rand',
	'update_post_meta_cache' => false,
	'no_found_rows'          => true, // Skip SQL_CALC_FOUND_ROWS for performance (no pagination).
) );

// Start WP Query.
$testimonial_query = new WP_Query( $testimonial_args );
if ( $testimonial_query->have_posts() ) :

	echo '<div class="testimonial-section front-page-section section"' . $bg_style . '>';
		echo '<div class="wrapper">';
			echo '<div class="grid-wrapper">'; ?>
				<div class="testimonial-content center-block" data-flickity='{ "wrapAround": true }'>
				<?php
				// Loop testimonials.
				while ( $testimonial_query->have_posts() ) : $testimonial_query->the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="entry-summary">
							<?php
								// Quote icon.
								echo pohjis_get_svg( array( 'icon' => 'quotes-left' ) );

								// The content.
								the_content();
							?>
						</div><!-- .entry-summary -->

						<div class="entry-footer">
							<?php
								the_title( '<p class="entry-title">', '</p>' );
							?>
						</div><!-- .entry-footer -->
					</article>
				<?php
				endwhile;

				echo '</div><!-- .testimonial-content -->';
			echo '</div><!-- .grid-wrapper -->';
		echo '</div><!-- .wrapper -->';
	echo '</div><!-- .testimonial-section -->';

endif;

// Reset post data.
wp_reset_postdata();
