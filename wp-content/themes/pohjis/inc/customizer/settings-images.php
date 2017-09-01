<?php

// Add the 'images' section.
$wp_customize->add_section(
	'images',
	array(
		'title'           => esc_html__( 'Images', 'pohjis' ),
		'priority'        => 9,
	)
);

// Add the portfolio header image setting.
$wp_customize->add_setting(
	'portfolio_header_img',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw'
	) );

//  Add the service header image control.
$wp_customize->add_control(
	new WP_Customize_Image_Control(
	$wp_customize,
		'portfolio_header_img',
			array(
				'label'    => esc_html__( 'Portfolio header image', 'pohjis' ),
				'section'  => 'images',
				'priority' => 7,
			)
	)
);
