<?php
/**
 * The template is for displaying portfolio project archive.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Pohjis
 */

get_header(); ?>

<div class="section-portfolio-archives">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="grid-wrapper grid-wrapper-3cl wrapper-archive">

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

				else :

					get_template_part( 'template-parts/content', 'none' ); ?>

				<?php endif; ?>

			</div><!-- .grid-wrapper -->

		<?php
		// Previous/next page navigation. Function is located in inc/template-tags.php.
		pohjis_posts_pagination();
		?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .section -->

<?php
get_footer();
