<?php
/**
 * Polylang related functions and strings.
 *
 * @package Pohjis
 */

/**
 * Register strings for translation.
 */
if ( function_exists( 'pll_register_string' ) ) {
	pll_register_string( esc_html__( 'Footer title', 'pohjis' ), get_theme_mod( 'footer_title' ), 'pohjis' );
	pll_register_string( esc_html__( 'Footer text', 'pohjis' ), get_theme_mod( 'footer_text' ), 'pohjis', true );
	pll_register_string( esc_html__( 'School title', 'pohjis' ), get_theme_mod( 'school_title' ), 'pohjis' );
	pll_register_string( esc_html__( 'School description', 'pohjis' ), get_theme_mod( 'school_desc' ), 'pohjis', true );
	pll_register_string( esc_html__( 'School extra title', 'pohjis' ), get_theme_mod( 'school_extra_title' ), 'pohjis' );
	pll_register_string( esc_html__( 'School extra description', 'pohjis' ), get_theme_mod( 'school_extra_desc' ), 'pohjis', true );
	pll_register_string( esc_html__( 'Service title', 'pohjis' ), get_theme_mod( 'service_title' ), 'pohjis' );
	pll_register_string( esc_html__( 'Service description', 'pohjis' ), get_theme_mod( 'service_desc' ), 'pohjis', true );
	pll_register_string( esc_html__( 'Service extra title', 'pohjis' ), get_theme_mod( 'service_extra_title' ), 'pohjis' );
	pll_register_string( esc_html__( 'Service extra description', 'pohjis' ), get_theme_mod( 'service_extra_desc' ), 'pohjis', true );
}
