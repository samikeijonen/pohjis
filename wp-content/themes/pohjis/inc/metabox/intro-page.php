<?php
/**
 * Metaboxes for Intro page.
 *
 * @package Pohjis
 */

function pohjis_register_intro_meta_fields( $butterbean, $post_type ) {
	// Check that we are on a page.
	if ( 'page' !== $post_type ) {
		return;
	}

	// Get ID.
	$post_id = '';
	if ( isset( $_GET['post'] ) ) {
		$post_id = absint( $_GET['post'] );
	}

	// Bail if not on Intro Page Template.
	if ( 'templates/intro-page.php' !== get_page_template_slug( $post_id ) ) {
		//return;
	}

	// Get prefix.
	$prefix = pohjis_metabox_prefix();

	$butterbean->register_manager(
		'pohjis_intro',
		array(
			'label'     => esc_html__( 'Intro', 'pohjis' ),
			'post_type' => 'page',
			'context'   => 'normal',
			'priority'  => 'high',
		)
	);

	$manager = $butterbean->get_manager( 'pohjis_intro' );

	$manager->register_section(
		'intro_section_1',
		array(
			'label' => esc_html__( 'Before the content', 'pohjis' ),
			'icon'  => 'dashicons-admin-generic',
			'active_callback' => false,
		)
	);

	$manager->register_control(
		$prefix . 'intro_column_1', // Same as setting name.
		array(
			'type'    => 'textarea',
			'section' => 'intro_section_1',
			'label'   => esc_html__( 'Column 1', 'pohjis' ),
			'attr'    => array( 'class' => 'widefat' ),
		)
	);

	$manager->register_setting(
		$prefix . 'intro_column_1', // Same as control name.
		array(
			'sanitize_callback' => 'wp_filter_post_kses',
		)
	);

	$manager->register_control(
		$prefix . 'intro_column_2', // Same as setting name.
		array(
			'type'    => 'textarea',
			'section' => 'intro_section_1',
			'label'   => esc_html__( 'Column 2', 'pohjis' ),
			'attr'    => array( 'class' => 'widefat' ),
		)
	);

	$manager->register_setting(
		$prefix . 'intro_column_2', // Same as control name.
		array(
			'sanitize_callback' => 'wp_filter_post_kses',
		)
	);

	// Courses.
	$manager->register_section(
		'intro_section_2',
		array(
			'label' => esc_html__( 'Courses', 'pohjis' ),
			'icon'  => 'dashicons-admin-generic',
		)
	);

	$manager->register_control(
		$prefix . 'intro_courses_1', // Same as setting name.
		array(
			'type'    => 'textarea',
			'section' => 'intro_section_2',
			'label'   => esc_html__( 'Courses column 1', 'pohjis' ),
			'attr'    => array( 'class' => 'widefat' ),
		)
	);

	$manager->register_setting(
		$prefix . 'intro_courses_1', // Same as control name.
		array(
			'sanitize_callback' => 'wp_filter_post_kses',
		)
	);

	$manager->register_control(
		$prefix . 'intro_courses_2', // Same as setting name.
		array(
			'type'    => 'textarea',
			'section' => 'intro_section_2',
			'label'   => esc_html__( 'Courses column 2', 'pohjis' ),
			'attr'    => array( 'class' => 'widefat' ),
		)
	);

	$manager->register_setting(
		$prefix . 'intro_courses_2', // Same as control name.
		array(
			'sanitize_callback' => 'wp_filter_post_kses',
		)
	);

	$manager->register_control(
		$prefix . 'intro_courses_3', // Same as setting name.
		array(
			'type'    => 'textarea',
			'section' => 'intro_section_2',
			'label'   => esc_html__( 'Courses column 3', 'pohjis' ),
			'attr'    => array( 'class' => 'widefat' ),
		)
	);

	$manager->register_setting(
		$prefix . 'intro_courses_3', // Same as control name.
		array(
			'sanitize_callback' => 'wp_filter_post_kses',
		)
	);

	// More info.
	$manager->register_section(
		'intro_section_3',
		array(
			'label' => esc_html__( 'More info', 'pohjis' ),
			'icon'  => 'dashicons-admin-generic',
		)
	);

	$manager->register_control(
		$prefix . 'intro_more_info', // Same as setting name.
		array(
			'type'    => 'textarea',
			'section' => 'intro_section_3',
			'label'   => esc_html__( 'More info about studies', 'pohjis' ),
			'attr'    => array( 'class' => 'widefat' ),
		)
	);

	$manager->register_setting(
		$prefix . 'intro_more_info', // Same as control name.
		array(
			'sanitize_callback' => 'wp_filter_post_kses',
		)
	);
}
add_action( 'butterbean_register', 'pohjis_register_intro_meta_fields', 10, 2 );
