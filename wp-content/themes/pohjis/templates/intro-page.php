<?php
/**
 * Template name: Intro Page
 *
 * The template for introduction of our school.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Pohjis
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			// Before content.
			$column_1 = pohjis_get_post_meta( $id, 'intro_column_1' );
			$column_2 = pohjis_get_post_meta( $id, 'intro_column_2' );

			if ( isset( $column_1 ) && $column_1 && isset( $column_2 ) && $column_2 ) :
				echo '<div class="before-content-section intro-page-section section">';
					echo '<div class="wrapper">';
						echo '<div class="grid-wrapper grid-wrapper-2cl grid-gap">';

							echo '<div class="content-1">';
								echo apply_filters( 'pohjis_the_content', ( wp_kses_post( $column_1 ) ) );
							echo '</div><!-- .content-1 -->';

							echo '<div class="content-2">';
								echo apply_filters( 'pohjis_the_content', ( wp_kses_post( $column_2 ) ) );
							echo '</div><!-- .content-2 -->';

						echo '</div><!-- .grid-wrapper -->';
					echo '</div><!-- .wrapper -->';
				echo '</div><!-- .before-content-section -->';
			endif;

			// Page content.
			while ( have_posts() ) : the_post();
				echo '<div class="main-content-section front-page-section section">';
					echo '<div class="wrapper wrapper-smaller">';

						get_template_part( 'template-parts/content', get_post_type() );

					echo '</div><!-- .wrapper -->';
				echo '</div><!-- .main-content-section -->';
			endwhile; // End of the loop.

			// Projects.
			//get_template_part( 'template-parts/content', 'project-area' );

			// Courses info.
			$courses_1 = pohjis_get_post_meta( $id, 'intro_courses_1' );
			$courses_2 = pohjis_get_post_meta( $id, 'intro_courses_2' );
			$courses_3 = pohjis_get_post_meta( $id, 'intro_courses_3' );

			if ( isset( $courses_1 ) && $courses_1 && isset( $courses_2 ) && $courses_2 && isset( $courses_3 ) && $courses_3 ) :
				echo '<div class="courses-content-section intro-page-section padding-bottom-section background-color-section section-content section">';
					echo '<div class="wrapper">';
						echo '<div class="grid-wrapper grid-wrapper-3cl grid-gap">';

							echo '<div class="content-1">';
								echo apply_filters( 'pohjis_the_content', ( wp_kses_post( $courses_1 ) ) );
							echo '</div><!-- .content-1 -->';

							echo '<div class="content-2">';
								echo apply_filters( 'pohjis_the_content', ( wp_kses_post( $courses_2 ) ) );
							echo '</div><!-- .content-2 -->';

							echo '<div class="content-3">';
								echo apply_filters( 'pohjis_the_content', ( wp_kses_post( $courses_3 ) ) );
							echo '</div><!-- .content-3 -->';

						echo '</div><!-- .grid-wrapper -->';
					echo '</div><!-- .wrapper -->';
				echo '</div><!-- .courses-content-section -->';
			endif;

			// More info.
			$more_info = pohjis_get_post_meta( $id, 'intro_more_info' );

			if ( isset( $more_info ) && $more_info ) :
				echo '<div class="more-info-section intro-page-section section-content section">';
					echo '<div class="wrapper wrapper-smaller">';

						echo apply_filters( 'pohjis_the_content', ( wp_kses_post( $more_info ) ) );

					echo '</div><!-- .wrapper -->';
				echo '</div><!-- .before-content-section -->';
			endif;

			// Instagram feed.
			get_template_part( 'template-parts/content', 'insta-feed' );

			// Testimonials.
			get_template_part( 'template-parts/content', 'testimonial-area' );

			// Blog posts.
			get_template_part( 'template-parts/content', 'blog-area' );
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
