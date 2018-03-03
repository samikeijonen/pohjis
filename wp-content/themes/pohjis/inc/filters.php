<?php
/**
 * Filters used in theme.
 *
 * @package Pohjis
 */

/**
 * Change [...] to just "...".
 *
 * @since  1.0.0
 * @return string $more
 */
function pohjis_excerpt_more() {
	/* Translators: The &hellip; is mark after excerpt. */
	$more = esc_html__( '&hellip;', 'pohjis' );

	return $more;
}
add_filter( 'excerpt_more', 'pohjis_excerpt_more' );

/**
 * Excerpt lenght.
 *
 * @since  1.0.0
 *
 * @param  integer $length Excerpt lenght.
 * @return integer $length
 */
function pohjis_excerpt_length( $length ) {
	return 45;
}
add_filter( 'excerpt_length', 'pohjis_excerpt_length' );

/**
 * Filters `get_the_archve_title` to add better archive titles than core.
 *
 * @since  1.0.0
 *
 * @param  string $title Archive title.
 * @return string
 */
function pohjis_archive_title_filter( $title ) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_tax() ) {
		$title = single_term_title( '', false );
	} elseif ( is_author() ) {
		$title = get_the_author_meta( 'display_name', absint( get_query_var( 'author' ) ) );
	} elseif ( is_search() ) {
		/* translators: %s is searc string. */
		$title = sprintf( esc_html__( 'Search results for &#8220;%s&#8221;', 'pohjis' ), get_search_query() );
	} elseif ( is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );
	} elseif ( is_month() ) {
		$title = single_month_title( ' ', false );
	}

	return apply_filters( 'pohjis_archive_title', $title );
}
add_filter( 'get_the_archive_title', 'pohjis_archive_title_filter', 5 );

/**
 * Filters `get_the_archve_description` to add better archive descriptions than core.
 *
 * @since  1.0.0
 *
 * @param  string $desc Archive description.
 * @return string
 */
function pohjis_archive_description_filter( $desc ) {
	if ( is_category() ) {
		$desc = get_term_field( 'description', get_queried_object_id(), 'category', 'raw' );
	} elseif ( is_tag() ) {
		$desc = get_term_field( 'description', get_queried_object_id(), 'post_tag', 'raw' );
	} elseif ( is_tax() ) {
		$desc = get_term_field( 'description', get_queried_object_id(), get_query_var( 'taxonomy' ), 'raw' );
	} elseif ( is_author() ) {
		$desc = get_the_author_meta( 'description', get_query_var( 'author' ) );
	} elseif ( is_post_type_archive() ) {
		$desc = get_post_type_object( get_query_var( 'post_type' ) )->description;
	}

	return apply_filters( 'pohjis_archive_description', $desc );
}
add_filter( 'get_the_archive_description', 'pohjis_archive_description_filter', 5 );

/**
 * Set same template for Jetpack and Custom Content Portfolio categories and tags.
 *
 * @since  1.0.0
 * @param  string $template Template for displaying archive page.
 * @return string $template
 */
function pohjis_portfolio_taxonomy_template( $template ) {
	// Custom content portfolio template.
	if ( is_tax( 'portfolio_category' ) || is_tax( 'portfolio_tag' ) ) {
		$new_template = locate_template( array( 'archive-portfolio_project.php' ) );
		if ( '' !== $new_template ) {
			return $new_template;
		}
	}

	return $template;
}
add_filter( 'taxonomy_template', 'pohjis_portfolio_taxonomy_template', 99 );

/**
 * Add menu description to featured menu.
 *
 * @param  string $title The menu item's title.
 * @param  object $item  The current menu item.
 * @param  array  $args  An array of wp_nav_menu() arguments.
 * @param  int    $depth Depth of menu item. Used for padding.
 * @return string $title The menu item's title with description.
 */
function pohjis_desc_to_menu_link( $title, $item, $args, $depth ) {
	if ( 'featured' === $args->theme_location && $item->description ) {
		// Button class.
		$button_class = ( 0 !== $item->menu_order % 2 ) ? 'button' : 'button button-sec';

		// Add description and button class to menu item.
		$title = '<span class="menu-item-description">' . $item->description . '</span> <span class="menu-item-link ' . esc_attr( $button_class ) . '">' . $title . '</span>';
	}

	return $title;
}
add_filter( 'nav_menu_item_title', 'pohjis_desc_to_menu_link', 10, 4 );

/**
 * Modifies tag cloud widget arguments to have all tags in the widget same font size.
 *
 * @param  array $args Arguments for tag cloud widget.
 * @return array A new modified arguments.
 */
function pohjis_widget_tag_cloud_args( $args ) {
	$args['largest']  = 1;
	$args['smallest'] = 1;
	$args['unit']     = 'em';
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'pohjis_widget_tag_cloud_args' );

/**
 * Image sizes array.
 *
 * @param  array $sizes Image sizes.
 * @return array A new modified arguments.
 */
function pohjis_show_image_sizes( $sizes ) {
	$sizes['pohjis-small'] = esc_html__( 'Pohjis thumbnail', 'pohjis' );

	return $sizes;
}
add_filter( 'image_size_names_choose', 'pohjis_show_image_sizes' );

/**
 * Duplicate 'the_content' filters.
 *
 * @since  1.0.0
 * @return void
 */
add_filter( 'pohjis_the_content', 'wptexturize' );
add_filter( 'pohjis_the_content', 'convert_smilies' );
add_filter( 'pohjis_the_content', 'convert_chars' );
add_filter( 'pohjis_the_content', 'wpautop' );
add_filter( 'pohjis_the_content', 'shortcode_unautop' );
add_filter( 'pohjis_the_content', 'do_shortcode' );
add_filter( 'pohjis_the_content', 'prepend_attachment' );
add_filter( 'pohjis_the_content', 'capital_P_dangit' );

// Add filters for oEmbed.
global $wp_embed;
add_filter( 'pohjis_the_content', array( $wp_embed, 'autoembed' ), 8 );

/**
 * Pohjois-Tapiolan lukio Instagram hashtag feed.
 */
add_filter( 'dude-insta-feed/access_token/user=4024202001', function() {
	return esc_attr( get_theme_mod( 'insta_access_token' ) );
} );

/**
 * Limit Instagram feed items
 */
add_filter( 'dude-insta-feed/user_images_parameters', function( $parameters ) {
	$parameters['count'] = '7';
	return $parameters;
} );
