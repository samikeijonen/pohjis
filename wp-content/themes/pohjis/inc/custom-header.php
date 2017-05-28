<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Pohjis
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses pohjis_header_style()
 */
function pohjis_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'pohjis_custom_header_args', array(
		'default-image'      => '',
		'default-text-color' => '181818',
		'width'              => 1600,
		'height'             => 500,
		'flex-height'        => true,
		'wp-head-callback'   => 'pohjis_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'pohjis_custom_header_setup' );

/**
 * Styles the header image and text displayed on the blog.
 *
 * @see pohjis_custom_header_setup().
 */
function pohjis_header_style() {
	$header_text_color = get_header_textcolor();

	// Header image.
	$header_image = esc_url( get_header_image() );

	// Featured image can overwrite header image in singular pages.
	$id = get_queried_object_id();
	if ( is_singular() && has_post_thumbnail( $id ) ) {
		$img_array = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'full', true );

		// width and url.
		$width = $img_array[1];
		$url   = $img_array[0];

		// Set new header image if it's at least 1600px wide.
		if ( 1599 < $width ) {
			$header_image = esc_url( $url );
		}
	}

	// Start header styles.
	$style = '';

	// Header images styles.
	if ( ! empty( $header_image ) ) {
		$style .= ".site-header {
			background-image: linear-gradient( 45deg, rgba(0, 102, 204, 1) 0%, rgba(0, 102, 204, 0.80) 50% ),
					url({$header_image});
			}";

			$style .= ".home .site-header {
				background-image: linear-gradient( 90deg, rgba(0, 102, 204, 0.90) 30%, rgba(0, 102, 204, 0.60) 70% ),
						url({$header_image});
				}";

				$style .= "@media screen and (min-width: 58em) {
						.home .site-header {
							background-image: linear-gradient( 90deg, rgba(0, 102, 204, 0.90) 30%, rgba(0, 102, 204, 0.60) 80% ),
								url({$header_image});
							}
						}";
	}

	// Echo styles if it's not empty.
	if ( ! empty( $style ) ) {
		echo "\n" . '<style type="text/css" id="site-header-css">' . trim( $style ) . '</style>' . "\n";
	}
}
