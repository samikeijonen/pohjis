<?php
/**
 * Metabox related functions.
 *
 * @package Pohjis
 */

// Add meta fields.
require get_template_directory() . '/inc/metabox/teme-page.php';
require get_template_directory() . '/inc/metabox/intro-page.php';

/**
 * Helper function for getting `pohjis_` prefix for metabox files.
 *
 * @since  1.0.0
 * @return string
 */
function pohjis_metabox_prefix() {
	return '_pohjis_';
}

/**
 * Helper function for getting post meta.
 *
 * @since  1.0.0
 *
 * @param  integer $id ID of post meta.
 * @param  string  $key The meta key to retrieve.
 * @return mixed Post meta.
 */
function pohjis_get_post_meta( $id = '', $key ) {
	$prefix = pohjis_metabox_prefix();

	if ( empty( $id ) ) {
		$id = get_the_ID();
	}

	return get_post_meta( $id, $prefix . $key, true );
}

/**
 * Helper function for getting term meta.
 *
 * @since  1.0.0
 *
 * @param  int    $id  Term ID.
 * @param  string $key The meta key to retrieve.
 * @return mixed Term meta.
 */
function pohjis_get_term_meta( $id = '', $key ) {
	$prefix = pohjis_metabox_prefix();

	if ( empty( $id ) ) {
		$id = get_queried_object_id();
	}

	return get_term_meta( $id, '_' . $prefix . $key, true );
}
