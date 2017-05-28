<?php
/**
 * Get child posts for current post type.
 *
 * @package Pohjis
 */

global $post;

// Child posts arguments.
$child_pages_args = array(
	'post_type'   => get_post_type(),
	'sort_column' => 'menu_order',
	'title_li'    => '',
	'echo'        => false,
);

// Use post parent or post ID.
if ( $post->post_parent ) :
	$child_pages_args['child_of'] = $post->post_parent;
else :
	$child_pages_args['child_of'] = $post->ID;
endif;

// Get child posts.
$child_pages = wp_list_pages( $child_pages_args );

// Output child posts in a list if there are any.
if ( $child_pages ) :
	$output = '<div class="child-posts-section section">';
		$output .= '<div class="wrapper">';
			$output .= '<ul class="child-posts">' . $child_pages . '</ul>';
		$output .= '</div>';
	$output .= '</div>';

	echo $output;
endif;
