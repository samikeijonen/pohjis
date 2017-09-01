<?php
/**
 * Blog posts area.
 *
 * @package Pohjis
 */

// Blog query args.
$blog_args = apply_filters( 'pohjis_blog_posts_arguments', array(
	'posts_per_page'         => 5,
	'post_type'              => 'post',
	'post_status'            => 'publish',
	'update_post_meta_cache' => false,
	'no_found_rows'          => true, // Skip SQL_CALC_FOUND_ROWS for performance (no pagination).
) );

// Start WP Query.
$blog_query = new WP_Query( $blog_args );
if ( $blog_query->have_posts() ) : ?>

	<div class="blog-area-section front-page-section section">
		<div class="wrapper">
			<div class="grid-wrapper grid-wrapper-2cl grid-gap">
				<div class="news-section wrapper-bottom">
				<?php
				// Get blog title from the options.
				$blog_title_option = get_option( 'page_for_posts' );
				$blog_title        = ( 'page' === get_option( 'show_on_front' ) && 0 !== $blog_title_option ) ? get_the_title( absint( $blog_title_option ) ) : esc_html__( 'News', 'pohjis' );

				echo '<h2 class="page-title">' . esc_html( $blog_title ) . '</h2>';
				?>

				<ul class="blog-post-list">
				<?php
				while ( $blog_query->have_posts() ) : $blog_query->the_post();

					the_title( '<li><h3 class="entry-title heading-medium no-margin-bottom"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3></li>' );

				endwhile; ?>
				</ul>
			</div><!-- .news-section -->

			<div class="news-section">
				<?php
				echo '<h2 class="page-title">' . esc_html__( 'Pohjis Magazine', 'pohjis' ) . '</h2>';

				// Online magazine query.
				$magazine_args = array(
					'posts_per_page' => 5,
					'post_type'      => 'post',
					'orderby'        => 'date',
					'order'          => 'DESC',
				);

				// Turn $magazine_args into query string and fetch the posts.
				$query_str = build_query( $magazine_args );

				// Check for transient, if none, grab remote URL.
				$magazine_posts = get_transient( 'pohjis_magazine_posts' );

				if ( false === $magazine_posts ) :
					// Get latest posts from magazine.
					$response  = wp_remote_get( esc_url_raw( 'https://pohjiksenverkkolehti.fi/wp-json/wp_query/args/?' . $query_str ) );

					// Get array of Post Objects.
					if ( ! is_wp_error( $response ) ) :
						$magazine_posts = json_decode( wp_remote_retrieve_body( $response ) );
					endif;

					// Store remote HTML file in transient, expire after 2 hours.
					set_transient( 'pohjis_magazine_posts', $magazine_posts, 2 * HOUR_IN_SECONDS );
				endif;

				if ( ! is_wp_error( $magazine_posts ) ) : ?>
					<ul class="blog-post-list">
						<?php foreach ( $magazine_posts as $item ) :
							echo '<li><h3 class="entry-title heading-medium no-margin-bottom"><a href="' . esc_url( $item->link ) . '">' . esc_html( $item->title->rendered ) . '</a></h3></li>';
						endforeach; ?>
					</ul>
				<?php endif; ?>
			</div><!-- .news-section -->

			</div><!-- .grid-wrapper -->
		</div><!-- .wrapper -->
	</div><!-- .blog-section -->

<?php
endif;

// Reset post data.
wp_reset_postdata();
