<?php
/**
 * Pohjis Theme Customizer
 *
 * @package Pohjis
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function pohjis_customize_register( $wp_customize ) {
	// Load different part of the Customizer.
	require_once get_template_directory() . '/inc/customizer/settings-insta.php';
	require_once get_template_directory() . '/inc/customizer/settings-images.php';

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'pohjis_customize_register' );

/**
 * Checks when if we're on school post type archive.
 *
 * @since  1.0.0
 * @return boolean
 */
function pohjis_is_school_archive() {
	return is_post_type_archive( 'school' );
}

/**
 * Checks when if we're on school post type archive.
 *
 * @since  1.0.0
 * @return boolean
 */
function pohjis_is_service_archive() {
	return is_post_type_archive( 'service' );
}
