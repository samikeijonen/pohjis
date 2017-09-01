<?php
/**
 * Metaboxes for TeMe page.
 *
 * @package Pohjis
 */

function pohjis_register_teme_meta_fields( $butterbean, $post_type ) {
	// Check that we are on a page.
	if ( 'page' !== $post_type ) {
		return;
	}

	// Get ID.
	$post_id = '';
	if ( isset( $_GET['post'] ) ) {
		$post_id = absint( $_GET['post'] );
	}

	// Bail if not on TeMe Page Template.
	if ( 'templates/teme-page.php' !== get_page_template_slug( $post_id ) ) {
		//return;
	}

	// Get prefix.
	$prefix = pohjis_metabox_prefix();

	$butterbean->register_manager(
		'pohjis_teme',
		array(
			'label'     => esc_html__( 'TeMe', 'pohjis' ),
			'post_type' => 'page',
			'context'   => 'normal',
			'priority'  => 'high',
		)
	);

	$manager = $butterbean->get_manager( 'pohjis_teme' );

	$manager->register_section(
		'teme_section_cta',
		array(
			'label'           => esc_html__( 'Callout link', 'pohjis' ),
			'icon'            => 'dashicons-admin-generic',
			'active_callback' => false,
		)
	);

	$manager->register_control(
		$prefix . 'header_cta_text', // Same as setting name.
		array(
			'type'            => 'text',
			'section'         => 'teme_section_cta',
			'label'           => esc_html__( 'Callout text', 'pohjis' ),
			'attr'            => array( 'class' => 'widefat' ),
		)
	);

	$manager->register_setting(
		$prefix . 'header_cta_text', // Same as control name.
		array(
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$manager->register_control(
		$prefix . 'header_cta_link', // Same as setting name.
		array(
			'type'            => 'text',
			'section'         => 'teme_section_cta',
			'label'           => esc_html__( 'Callout link', 'pohjis' ),
			'attr'            => array( 'class' => 'widefat' ),
		)
	);

	$manager->register_setting(
		$prefix . 'header_cta_link', // Same as control name.
		array(
			'sanitize_callback' => 'esc_url_raw',
		)
	);

	$manager->register_section(
		'teme_section_1',
		array(
			'label'           => esc_html__( 'Before the content', 'pohjis' ),
			'icon'            => 'dashicons-admin-generic',
			'active_callback' => false,
		)
	);

	$manager->register_control(
		$prefix . 'teme_intro', // Same as setting name.
		array(
			'type'    => 'text',
			'section' => 'teme_section_1',
			'label'   => esc_html__( 'Intro', 'pohjis' ),
			'attr'    => array( 'class' => 'widefat' ),
		)
	);

	$manager->register_setting(
		$prefix . 'teme_intro', // Same as control name.
		array(
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$manager->register_control(
		$prefix . 'teme_column_1', // Same as setting name.
		array(
			'type'            => 'textarea',
			'section'         => 'teme_section_1',
			'label'           => esc_html__( 'Column 1', 'pohjis' ),
			'attr'            => array( 'class' => 'widefat' ),
		)
	);

	$manager->register_setting(
		$prefix . 'teme_column_1', // Same as control name.
		array(
			'sanitize_callback' => 'wp_filter_post_kses',
		)
	);

	$manager->register_control(
		$prefix . 'teme_column_2', // Same as setting name.
		array(
			'type'    => 'textarea',
			'section' => 'teme_section_1',
			'label'   => esc_html__( 'Column 2', 'pohjis' ),
			'attr'    => array( 'class' => 'widefat' ),
		)
	);

	$manager->register_setting(
		$prefix . 'teme_column_2', // Same as control name.
		array(
			'sanitize_callback' => 'wp_filter_post_kses',
		)
	);

	// TeMe courses.
	$manager->register_section(
		'teme_section_2',
		array(
			'label' => esc_html__( 'TeMe courses', 'pohjis' ),
			'icon'  => 'dashicons-admin-generic',
		)
	);

	$manager->register_control(
		$prefix . 'teme_courses_1', // Same as setting name.
		array(
			'type'    => 'textarea',
			'section' => 'teme_section_2',
			'label'   => esc_html__( 'Courses column 1', 'pohjis' ),
			'attr'    => array( 'class' => 'widefat' ),
		)
	);

	$manager->register_setting(
		$prefix . 'teme_courses_1', // Same as control name.
		array(
			'sanitize_callback' => 'wp_filter_post_kses',
		)
	);

	$manager->register_control(
		$prefix . 'teme_courses_2', // Same as setting name.
		array(
			'type'    => 'textarea',
			'section' => 'teme_section_2',
			'label'   => esc_html__( 'Courses column 2', 'pohjis' ),
			'attr'    => array( 'class' => 'widefat' ),
		)
	);

	$manager->register_setting(
		$prefix . 'teme_courses_2', // Same as control name.
		array(
			'sanitize_callback' => 'wp_filter_post_kses',
		)
	);

	// Apply.
	$manager->register_section(
		'teme_section_3',
		array(
			'label' => esc_html__( 'Apply', 'pohjis' ),
			'icon'  => 'dashicons-admin-generic',
		)
	);

	$manager->register_control(
		$prefix . 'teme_apply', // Same as setting name.
		array(
			'type'    => 'textarea',
			'section' => 'teme_section_3',
			'label'   => esc_html__( 'How to apply', 'pohjis' ),
			'attr'    => array( 'class' => 'widefat' ),
		)
	);

	$manager->register_setting(
		$prefix . 'teme_apply', // Same as control name.
		array(
			'sanitize_callback' => 'wp_filter_post_kses',
		)
	);
}
add_action( 'butterbean_register', 'pohjis_register_teme_meta_fields', 10, 2 );
