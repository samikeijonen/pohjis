<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Pohjis
 */

get_header(); ?>

	<div class="section">
		<div class="wrapper wrapper-smaller">
			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">

				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content', get_post_type() );

				endwhile; // End of the loop.

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
				?>

				</main><!-- #main -->
			</div><!-- #primary -->
		</div><!-- .wrapper -->
	</div><!-- .section -->

<?php
// Instagram feed.
get_template_part( 'template-parts/content', 'insta-feed' );

// Blog posts.
get_template_part( 'template-parts/content', 'blog-area' );

get_footer();
