<?php
/**
 * Template name: Calculate grades
 *
 * Template for calculating grades.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Pohjis
 */

get_header(); ?>

<div class="section">
	<div class="wrapper wrapper-smaller">
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) :
				the_post();
				?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<div class="entry-content">
					<?php
					the_content();

					if ( function_exists( 'Calculate_Grades\form' ) ) :
						Calculate_Grades\form();
					endif;
					?>
					</div><!-- .entry-content -->
				</article><!-- #post-## -->

				<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

			</main><!-- #main -->
		</div><!-- #primary -->
	</div><!-- .wrapper -->
</div><!-- .section -->

<?php
get_footer();
