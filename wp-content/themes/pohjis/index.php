<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Pohjis
 */

get_header(); ?>

<div class="section section-archives">
	<div class="wrapper">
			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">

				<?php if ( have_posts() ) :

					/* Start the Loop */
					while ( have_posts() ) : the_post();

						/*
						 * Include the Post-Type-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'template-parts/content', get_post_type() );

					endwhile;

					// Previous/next page navigation. Function is located in inc/template-tags.php.
					pohjis_posts_pagination();

				else :

					get_template_part( 'template-parts/content', 'none' ); ?>

				<?php endif; ?>

				</main><!-- #main -->
			</div><!-- #primary -->
	</div><!-- .wrapper -->
</div><!-- .section -->

<?php
get_footer();
