<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Pohjis
 */

/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function pohjis_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
	/* translators: 1: Posted on string 2: post author */
	esc_html_x( '%1$s %2$s', 'post date', 'pohjis' ),
	'<span class="screen-reader-text">' . esc_html__( 'Posted on', 'pohjis' ) . '</span>',
	'<a class="soft-color" href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'pohjis' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

}

/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function pohjis_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'pohjis' ) );
		if ( $categories_list && pohjis_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'pohjis' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'pohjis' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'pohjis' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'pohjis' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'pohjis' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}

/**
 * Prints author avatar.
 */
function pohjis_entry_author() {
	// Avatar.
	$author_avatar_size = apply_filters( 'pohjis_author_avatar_size', 240 );

	printf( '<span class="byline"><span class="author vcard">%1$s<span class="screen-reader-text">%2$s </span> <a class="url fn n" href="%3$s">%4$s</a></span></span>',
		get_avatar( get_the_author_meta( 'user_email' ), $author_avatar_size ),
		esc_html_x( 'Author', 'Used before post author name.', 'pohjis' ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		get_the_author()
	);
}

/**
 * Display post pagination.
 *
 * Use WordPress native the_posts_pagination function.
 */
function pohjis_posts_pagination() {
	the_posts_pagination( array(
		'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'pohjis' ) . ' </span>',
	) );
}

/**
 * Custom "Read more" link.
 *
 * @since  1.0.0
 * @return string $output
 */
function valter_excerpt_more_link() {
	/* Translators: The %s is the post title shown to screen readers. */
	$text = sprintf( esc_attr__( 'Read article %s', 'pohjis' ), '<span class="screen-reader-text">' . get_the_title() ) . '</span>';
	$link = sprintf( '<p><a class="button button-sec" href="%s" class="more-link">%s</a></p>', esc_url( get_permalink() ), $text );
	return $link;
}

/**
 * Get post thumbnail URL.
 *
 * @since 1.0.0
 */
function pohjis_get_post_thumbnail( $post_thumbnail = '', $id = '' ) {
	// Set default size.
	if ( empty( $post_thumbnail ) ) {
		$post_thumbnail = 'post-thumbnail';
	}

	// Set default ID.
	if ( empty(  $id ) ) {
		$id = get_the_ID();
	}

	// Returns an array (url, width, height, is_intermediate) if it's set, else return false.
	$bg = false;
	if ( has_post_thumbnail( $id ) ) {
		$thumb_url_array = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), esc_attr( $post_thumbnail ), true );
		$bg              = $thumb_url_array;
	}
	return $bg;
}

/**
 * Get social sharing links.
 *
 * @link: http://sharingbuttons.io/
 *
 * @since 1.0.0
 */
function pohjis_get_social_links() {
	$output = '';
	$output .= '<ul class="social-sharing">';

	$output .= '<li class="share-list-item share-text">' . esc_html__( 'Share:', 'pohjis' ) . '</li>';

	// Facebook.
	$output .= '<li class="share-list-item share-link">';
		$output .= '<a href="https://facebook.com/sharer/sharer.php?u=' . esc_url( get_permalink() ) . '&t=' . urlencode( the_title_attribute( 'echo=0' ) ) . '" target="_blank">';
			$output .= pohjis_get_svg( array( 'icon' => 'facebook' ) );
			$output .= '<span class="screen-reader-text">' . esc_html__( 'Share on Facebook', 'pohjis' ) . '</span>';
		$output .= '</a>';
	$output .= '</li>';

	// Twitter.
	$output .= '<li class="share-list-item share-link">';
		$output .= '<a href="https://twitter.com/intent/tweet/?url=' . esc_url( get_permalink() ) . '&text=' . urlencode( the_title_attribute( 'echo=0' ) ) .'" target="_blank">';
			$output .= pohjis_get_svg( array( 'icon' => 'twitter' ) );
			$output .= '<span class="screen-reader-text">' . esc_html__( 'Share on Twitter', 'pohjis' ) . '</span>';
		$output .= '</a>';
	$output .= '</li>';

	// Linkedin
	$output .= '<li class="share-list-item share-link">';
		$output .= '<a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=' . esc_url( get_permalink() ) . '&amp;title=' . urlencode( the_title_attribute( 'echo=0' ) ) . '&amp;summary=' . urlencode( the_title_attribute( 'echo=0' ) ) . '&amp;source=' . esc_url( get_permalink() ) . '" target="_blank">';
			$output .= pohjis_get_svg( array( 'icon' => 'linkedin' ) );
			$output .= '<span class="screen-reader-text">' . esc_html__( 'Share on Linkedin', 'pohjis' ) . '</span>';
		$output .= '</a>';
	$output .= '</li>';

	return $output;
}

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function pohjis_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'pohjis_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'pohjis_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so pohjis_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so pohjis_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in pohjis_categorized_blog.
 */
function pohjis_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'pohjis_categories' );
}
add_action( 'edit_category', 'pohjis_category_transient_flusher' );
add_action( 'save_post',     'pohjis_category_transient_flusher' );
