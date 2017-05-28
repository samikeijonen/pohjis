<?php
/**
 * Portfolio projects area.
 *
 * @package Pohjis
 */

// Project query args.
$project_args = apply_filters( 'pohjis_portfolio_projects_posts_arguments', array(
	'posts_per_page'         => 3,
	'post_type'              => 'portfolio_project',
	'post_status'            => 'publish',
	'update_post_meta_cache' => false,
	'no_found_rows'          => true, // Skip SQL_CALC_FOUND_ROWS for performance (no pagination).
) );

// Start WP Query.
$project_query = new WP_Query( $project_args );
if ( $project_query->have_posts() ) :
	echo '<div class="project-section padding-bottom-section grid-wrapper grid-wrapper-3cl">';

	while ( $project_query->have_posts() ) : $project_query->the_post();
		get_template_part( 'template-parts/content', 'portfolio_project' );
	endwhile;

	echo '</div><!-- .project-section -->';
endif;

// Reset post data.
wp_reset_postdata();
