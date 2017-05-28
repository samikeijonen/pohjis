<?php

// Add the 'insta' section.
$wp_customize->add_section(
	'insta',
	array(
		'title'    => esc_html__( 'Instagram', 'pohjis' ),
		'priority' => 5,
	)
);

// Add the insta access token setting.
$wp_customize->add_setting(
	'insta_access_token',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

// Add the insta access token control.
$wp_customize->add_control(
	'insta_access_token',
	array(
		'label'    => esc_html__( 'Instagram access token', 'pohjis' ),
		'section'  => 'insta',
		'priority' => 10,
		'type'     => 'text'
	)
);
