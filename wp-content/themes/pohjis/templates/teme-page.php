<?php
/**
 * Template name: TeMe Page
 *
 * The template for displaying the Teatterin ja median linja.
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
			$intro    = pohjis_get_post_meta( $id, 'teme_intro' );
			$column_1 = pohjis_get_post_meta( $id, 'teme_column_1' );
			$column_2 = pohjis_get_post_meta( $id, 'teme_column_2' );

			if ( isset( $intro ) && $intro ) :
				echo '<div class="section">';
					echo '<div class="wrapper center-block">';
						echo '<p class="bigger-text text-align-center">' . esc_html( $intro ) . '</p>';
					echo '</div>';
				echo '</div>';
			endif;

			if ( isset( $column_1 ) && $column_1 && isset( $column_2 ) && $column_2 ) :
				echo '<div class="before-content-section teme-page-section section">';
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
			get_template_part( 'template-parts/content', 'project-area' );

			// After content.
			$courses_1 = pohjis_get_post_meta( $id, 'teme_courses_1' );
			$courses_2 = pohjis_get_post_meta( $id, 'teme_courses_2' );
			$courses_3 = pohjis_get_post_meta( $id, 'teme_courses_3' );

			if ( isset( $courses_1 ) && $courses_1 && isset( $courses_2 ) && $courses_2 ) :
				echo '<div class="courses-content-section teme-page-section padding-bottom-section section">';
					echo '<div class="wrapper">';
						echo '<div class="grid-wrapper grid-wrapper-2cl grid-gap">';

							echo '<div class="content-1">';
								echo apply_filters( 'pohjis_the_content', ( wp_kses_post( $courses_1 ) ) );
							echo '</div><!-- .content-1 -->';

							echo '<div class="content-2">';
								echo apply_filters( 'pohjis_the_content', ( wp_kses_post( $courses_2 ) ) );
							echo '</div><!-- .content-2 -->';

						echo '</div><!-- .grid-wrapper -->';
					echo '</div><!-- .wrapper -->';
				echo '</div><!-- .courses-content-section -->';
			endif;

			// Testimonials.
			get_template_part( 'template-parts/content', 'testimonial-area' );

			// Apply.
			$teme_apply = pohjis_get_post_meta( $id, 'teme_apply' );

			if ( isset( $teme_apply ) && $teme_apply ) :
				echo '<div class="apply-section teme-page-section padding-bottom-section center-block section">';
					echo '<div class="wrapper wrapper-smaller">';

						echo apply_filters( 'pohjis_the_content', ( wp_kses_post( $teme_apply	 ) ) );

					echo '</div><!-- .wrapper -->';
				echo '</div><!-- .before-content-section -->';
			endif;

			// Instagram feed.
			get_template_part( 'template-parts/content', 'insta-feed' );
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
